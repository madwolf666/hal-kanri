<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./global.php');
require_once($GLOBALS['g_EXCEL_LIB_PATH']."PHPExcel.php");
require_once($GLOBALS['g_EXCEL_LIB_PATH']."PHPExcel/IOFactory.php");

require_once('./10100-com.php');

$a_sRet = "<font color='#0000ff'>アップロードが行われました！</font>";
$a_sTrace = "";
//$a_sRet = $_FILES["file"]["tmp_name"];

//$dir = $_POST["dir"];
$a_consumption_tax = $_POST['consumption_tax'];   //[2017.12.01]消費税率
#echo '消費税率：'.$a_consumption_tax.'<br>';

$cr_id_array = [];

try {
    /**/
    if ($_FILES["file"]["tmp_name"]) {
        list($file_name,$file_type) = explode(".",$_FILES['file']['name']);
        //ファイル名を日付と時刻にしている。
        $name = date("YmdHis").".".$file_type;
        //$file = "./tmp";
        $file = $GLOBALS['g_EXCEL_TMP_PATH'];
        //読み書きするファイルのパスを設定
        $target_file = $file.$name;
        //$a_sRet = $target_file;
        //ディレクトリを作成してその中にアップロードしている。
        if(!file_exists($file)){
            mkdir($file,0755);
        }
        if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
            chmod($target_file, 0644);
            //var_dump($dir."/".$name);
        }
    /**/
        //$target_file = $GLOBALS['g_EXCEL_TMP_PATH']."time-table.xlsx";
        $a_sTrace = $target_file.'<br>';
        try{
            //DBからユーザ情報取得
            $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
            $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //1. リーダーを作成して既存ファイルを読み込む
            $obj_reader = PHPExcel_IOFactory::createReader('Excel2007');
            $obj_book   = $obj_reader->load($target_file);
            if ($obj_book == NULL){
                $a_sTrace = 'book is null<br>';
            }
            $obj_sheet = $obj_book->getSheetByName("勤務表");
            if ($obj_sheet == NULL){
                $a_sTrace = 'sheet is null<br>';
            }
            //PHPExcelでは、rowは1始まり、colは0始まりのようである。
            //エンジニアNo.を取得
            $a_engineer_no = $obj_sheet->getCellByColumnAndRow(10, 3)->getCalculatedValue();
            #$a_engineer_no = $obj_sheet->getCellByColumnAndRow(9, 2)->getCalculatedValue();
            $a_sTrace = 'エンジニアNo.：'.$a_engineer_no.'<br>';
            //報告日範囲を取得
            $a_time_table_year = $obj_sheet->getCellByColumnAndRow(0, 6)->getCalculatedValue();
            $a_time_table_month = $obj_sheet->getCellByColumnAndRow(3, 6)->getCalculatedValue();
            #$a_time_table_year = $obj_sheet->getCellByColumnAndRow(0, 6)->getCalculatedValue();
            #$a_time_table_month = $obj_sheet->getCellByColumnAndRow(2, 6)->getCalculatedValue();
            $a_sTrace = '年：'.$a_time_table_year.'<br>';
            $a_sTrace = '月：'.$a_time_table_month.'<br>';
            $a_row = 9;
            
            //報告日が空になるまで繰り返す。
            $a_time_table_day_last = '';
            $a_time_table_day = strval($obj_sheet->getCellByColumnAndRow(0, $a_row)->getCalculatedValue());
            while ($a_time_table_day != ''){
                $a_sTrace = '----------------------------------------<br>';
                $a_sTrace = '日付：'.$a_time_table_day.'<br>';
                $a_time_table_day_last = $a_time_table_day;
                //合致する契約レポートから情報を抽出する
                $a_bRet =
                        _getContractReport(
                                $a_conn,
                                $a_engineer_no,
                                $a_time_table_year,
                                $a_time_table_month,
                                $a_time_table_day
                                );
                if ($a_bRet == true){
                    $a_work_time_contract = 0;
                    $a_break_time_contract = 0;

                    $a_time_start_hour_src = '';
                    $a_time_start_minute_src = '';
                    $a_time_end_hour_src = '';
                    $a_time_end_minute_src = '';
                    
                    $a_time_start_minute_dst_bill = '';
                    $a_time_end_minute_dst_bill = '';

                    $a_time_start_minute_dst_pay1 = '';
                    $a_time_end_minute_dst_pay1 = '';

                    $a_time_start_minute_dst_pay2 = '';
                    $a_time_end_minute_dst_pay2 = '';
                    
                    $a_work_time_actualy_bill = 0;
                    $a_break_time_actualy_bill = 0;
                    $a_deduction_time_actualy_bill = 0;
                    $a_over_time_actualy_bill = 0;

                    $a_work_time_actualy_pay1 = 0;
                    $a_break_time_actualy_pay1 = 0;
                    $a_deduction_time_actualy_pay1 = 0;
                    $a_over_time_actualy_pay1 = 0;

                    $a_work_time_actualy_pay2 = 0;
                    $a_break_time_actualy_pay2 = 0;
                    $a_deduction_time_actualy_pay2 = 0;
                    $a_over_time_actualy_pay2 = 0;

                    //時間刻み「日次」の値で作業開始・作業終了を調整する。
                    _adjustmentWorkTime(
                            $obj_sheet,
                            $a_row,
                            $a_time_table_year,
                            $a_time_table_month,
                            $a_time_table_day,
                            $a_work_time_contract,
                            $a_break_time_contract,
                            $a_time_start_hour_src,
                            $a_time_start_minute_src,
                            $a_time_end_hour_src,
                            $a_time_end_minute_src,
                            $a_time_start_minute_dst_bill,
                            $a_time_end_minute_dst_bill,
                            $a_time_start_minute_dst_pay1,
                            $a_time_end_minute_dst_pay1,
                            $a_time_start_minute_dst_pay2,
                            $a_time_end_minute_dst_pay2,
                            $a_work_time_actualy_bill,
                            $a_break_time_actualy_bill,
                            $a_deduction_time_actualy_bill,
                            $a_over_time_actualy_bill,
                            $a_work_time_actualy_pay1,
                            $a_break_time_actualy_pay1,
                            $a_deduction_time_actualy_pay1,
                            $a_over_time_actualy_pay1,
                            $a_work_time_actualy_pay2,
                            $a_break_time_actualy_pay2,
                            $a_deduction_time_actualy_pay2,
                            $a_over_time_actualy_pay2
                            );

                    $a_conn->beginTransaction();  //トランザクション開始
                    
                    //DBから該報告日のレコードを削除
                    $a_sql = "DELETE FROM ".$GLOBALS['g_DB_t_time_table'];
                    $a_sql .= " WHERE (engineer_no=:engineer_no)";
                    $a_sql .= " AND (work_day=:work_day);";
                    $a_stmt = $a_conn->prepare($a_sql);
                    $a_stmt->bindParam(':engineer_no', $a_engineer_no, PDO::PARAM_STR);
                    com_pdo_bindValue($a_stmt,':work_day', $a_time_table_year."/".$a_time_table_month."/".$a_time_table_day);
                    $a_stmt->execute();
                    
                    //DBから該報告日のレコードを削除
                    $a_sql = "INSERT INTO ".$GLOBALS['g_DB_t_time_table'].
                            "(engineer_no,
                              work_day,
                              cr_id,
                              work_time_contract,
                              break_time_contract,
                              start_hour_src,
                              start_minute_src,
                              end_hour_src,
                              end_minute_src,
                              start_minute_dst_bill,
                              end_minute_dst_bill,
                              start_minute_dst_pay1,
                              end_minute_dst_pay1,
                              start_minute_dst_pay2,
                              end_minute_dst_pay2,
                              work_time_actualy_bill,
                              break_time_actualy_bill,
                              deduction_time_actualy_bill,
                              over_time_actualy_bill,
                              work_time_actualy_pay1,
                              break_time_actualy_pay1,
                              deduction_time_actualy_pay1,
                              over_time_actualy_pay1,
                              work_time_actualy_pay2,
                              break_time_actualy_pay2,
                              deduction_time_actualy_pay2,
                              over_time_actualy_pay2
                            )VALUES(";
                    $a_sql .= ":engineer_no,
                              :work_day,
                              :cr_id,
                              :work_time_contract,
                              :break_time_contract,
                              :start_hour_src,
                              :start_minute_src,
                              :end_hour_src,
                              :end_minute_src,
                              :start_minute_dst_bill,
                              :end_minute_dst_bill,
                              :start_minute_dst_pay1,
                              :end_minute_dst_pay1,
                              :start_minute_dst_pay2,
                              :end_minute_dst_pay2,
                              :work_time_actualy_bill,
                              :break_time_actualy_bill,
                              :deduction_time_actualy_bill,
                              :over_time_actualy_bill,
                              :work_time_actualy_pay1,
                              :break_time_actualy_pay1,
                              :deduction_time_actualy_pay1,
                              :over_time_actualy_pay1,
                              :work_time_actualy_pay2,
                              :break_time_actualy_pay2,
                              :deduction_time_actualy_pay2,
                              :over_time_actualy_pay2
                            );";
                    $a_stmt = $a_conn->prepare($a_sql);
                    $a_stmt->bindParam(':engineer_no', $a_engineer_no, PDO::PARAM_STR);
                    com_pdo_bindValue($a_stmt,':work_day', $a_time_table_year."/".$a_time_table_month."/".$a_time_table_day);
                    com_pdo_bindValue($a_stmt, ':cr_id', $GLOBALS['cr_id']);
                    com_pdo_bindValue($a_stmt, ':work_time_contract', $a_work_time_contract);
                    com_pdo_bindValue($a_stmt, ':break_time_contract', $a_break_time_contract);

                    $a_stmt->bindParam(':start_hour_src', $a_time_start_hour_src, PDO::PARAM_STR);
                    $a_stmt->bindParam(':start_minute_src', $a_time_start_minute_src, PDO::PARAM_STR);
                    $a_stmt->bindParam(':end_hour_src', $a_time_end_hour_src, PDO::PARAM_STR);
                    $a_stmt->bindParam(':end_minute_src', $a_time_end_minute_src, PDO::PARAM_STR);

                    $a_stmt->bindParam(':start_minute_dst_bill', $a_time_start_minute_dst_bill, PDO::PARAM_STR);
                    $a_stmt->bindParam(':end_minute_dst_bill', $a_time_end_minute_dst_bill, PDO::PARAM_STR);

                    $a_stmt->bindParam(':start_minute_dst_pay1', $a_time_start_minute_dst_pay1, PDO::PARAM_STR);
                    $a_stmt->bindParam(':end_minute_dst_pay1', $a_time_end_minute_dst_pay1, PDO::PARAM_STR);

                    $a_stmt->bindParam(':start_minute_dst_pay2', $a_time_start_minute_dst_pay2, PDO::PARAM_STR);
                    $a_stmt->bindParam(':end_minute_dst_pay2', $a_time_end_minute_dst_pay2, PDO::PARAM_STR);

                    com_pdo_bindValue($a_stmt, ':work_time_actualy_bill', $a_work_time_actualy_bill);
                    com_pdo_bindValue($a_stmt, ':break_time_actualy_bill', $a_break_time_actualy_bill);
                    com_pdo_bindValue($a_stmt, ':deduction_time_actualy_bill', $a_deduction_time_actualy_bill);
                    com_pdo_bindValue($a_stmt, ':over_time_actualy_bill', $a_over_time_actualy_bill);

                    com_pdo_bindValue($a_stmt, ':work_time_actualy_pay1', $a_work_time_actualy_pay1);
                    com_pdo_bindValue($a_stmt, ':break_time_actualy_pay1', $a_break_time_actualy_pay1);
                    com_pdo_bindValue($a_stmt, ':deduction_time_actualy_pay1', $a_deduction_time_actualy_pay1);
                    com_pdo_bindValue($a_stmt, ':over_time_actualy_pay1', $a_over_time_actualy_pay1);

                    com_pdo_bindValue($a_stmt, ':work_time_actualy_pay2', $a_work_time_actualy_pay2);
                    com_pdo_bindValue($a_stmt, ':break_time_actualy_pay2', $a_break_time_actualy_pay2);
                    com_pdo_bindValue($a_stmt, ':deduction_time_actualy_pay2', $a_deduction_time_actualy_pay2);
                    com_pdo_bindValue($a_stmt, ':over_time_actualy_pay2', $a_over_time_actualy_pay2);

                    $a_stmt->execute();
                    
                    $a_conn->commit();    //コミット
                }

                //日毎に作業時間を調整する。
                $a_row++;
                $a_time_table_day = $obj_sheet->getCellByColumnAndRow(0, $a_row)->getCalculatedValue();
            }
            
            //print_r($GLOBALS['cr_id_array']);
            $a_sTrace = '<br>';

            //給与の計算
            foreach ($GLOBALS['cr_id_array'] as $a_cr_id){
                _calcAllowance(
                        $a_conn,
                        $a_engineer_no,
                        $a_time_table_year,
                        $a_time_table_month,
                        $a_time_table_day_last,
                        $a_cr_id
                        );
            }

        } catch (PDOException $e){
            if ($a_conn) {
                $a_conn->rollBack();  //ロールバック
            }
            $a_sRet = 'Error:'.$e->getMessage();
            //$a_sRet .= $a_sql;
        }
        $a_conn = null;
    /**/    
        unlink($target_file);   //ファイル削除
    }
    /**/
} catch (Exception $e) {
    if ($a_conn) {
        $a_conn->rollBack();  //ロールバック
    }
    $a_sRet = 'Error:'.$e->getMessage();
}

echo $a_sRet;

//契約レポート情報取得
function _getContractReport(
    $h_conn,
    $h_engineer_no,
    $h_time_table_year,
    $h_time_table_month,
    $h_time_table_day
    ){
    $a_bRet = false;
    try{
        $a_day = $h_time_table_year."/".$h_time_table_month."/".$h_time_table_day;
        //$GLOBALS['a_sTrace'] = '日付：'.$a_day.'<br>';
        $a_sql = set_10100_selectDB();
        $a_sql .= " WHERE (claim_agreement_start<=:claim_agreement_start) AND (claim_agreement_end>=:claim_agreement_end) AND (engineer_number=:engineer_number);";
        //$GLOBALS['a_sTrace'] = $a_sql.'<br>';
        $a_stmt = $h_conn->prepare($a_sql);
        com_pdo_bindValue($a_stmt, ':claim_agreement_start', $a_day);
        com_pdo_bindValue($a_stmt, ':claim_agreement_end', $a_day);
        $a_stmt->bindParam(':engineer_number', $h_engineer_no, PDO::PARAM_STR);
        $a_stmt->execute();

        while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
            $GLOBALS['a_sTrace'] = '契約レポート検出！<br>';
            $a_bRet = true;
            set_10100_fromDB($a_result);
        }
        
        //給与計算対象の契約レポートのリストを退避
        $a_isFound = false;
        foreach ($GLOBALS['cr_id_array'] as $a_cr_id){
            if ($a_cr_id == $GLOBALS['cr_id']){
                $a_isFound = true;
            }
        }
        if ($a_isFound == false){
            array_push($GLOBALS['cr_id_array'], $GLOBALS['cr_id']);
        }
        
    } catch (Exception $e) {
        echo 'Error:'.$e->getMessage();
    }
    return $a_bRet;
}

function _adjustmentWorkTime(
        $h_obj_sheet,
        $h_row,
        $h_time_table_year,
        $h_time_table_month,
        $h_time_table_day,
        &$h_work_time_contract,
        &$h_break_time_contract,
        &$h_time_start_hour_src,
        &$h_time_start_minute_src,
        &$h_time_end_hour_src,
        &$h_time_end_minute_src,
        &$h_time_start_minute_dst_bill,
        &$h_time_end_minute_dst_bill,
        &$h_time_start_minute_dst_pay1,
        &$h_time_end_minute_dst_pay1,
        &$h_time_start_minute_dst_pay2,
        &$h_time_end_minute_dst_pay2,
        &$h_work_time_actualy_bill,
        &$h_break_time_actualy_bill,
        &$h_deduction_time_actualy_bill,
        &$h_over_time_actualy_bill,
        &$h_work_time_actualy_pay1,
        &$h_break_time_actualy_pay1,
        &$h_deduction_time_actualy_pay1,
        &$h_over_time_actualy_pay1,
        &$h_work_time_actualy_pay2,
        &$h_break_time_actualy_pay2,
        &$h_deduction_time_actualy_pay2,
        &$h_over_time_actualy_pay2
        ){
    try{
        //--------------------------------------------------------------------------
        //時間刻み「日次」の値で作業開始・作業終了を調整する。
        //--------------------------------------------------------------------------
        $h_time_start_hour_src = strval($h_obj_sheet->getCellByColumnAndRow(5, $h_row)->getCalculatedValue());
        $h_time_start_minute_src = strval($h_obj_sheet->getCellByColumnAndRow(6, $h_row)->getCalculatedValue());
        $h_time_end_hour_src = strval($h_obj_sheet->getCellByColumnAndRow(7, $h_row)->getCalculatedValue());
        $h_time_end_minute_src = strval($h_obj_sheet->getCellByColumnAndRow(8, $h_row)->getCalculatedValue());
        /*$h_time_start_hour_src = strval($h_obj_sheet->getCellByColumnAndRow(4, $h_row)->getCalculatedValue());
        $h_time_start_minute_src = strval($h_obj_sheet->getCellByColumnAndRow(5, $h_row)->getCalculatedValue());
        $h_time_end_hour_src = strval($h_obj_sheet->getCellByColumnAndRow(6, $h_row)->getCalculatedValue());
        $h_time_end_minute_src = strval($h_obj_sheet->getCellByColumnAndRow(7, $h_row)->getCalculatedValue());*/

        //請求サイド
        $GLOBALS['a_sTrace'] = '### 請求サイド ###<br>';
        _adjustmentWorkTimeSub1(
                $h_obj_sheet,
                $h_row,
                $GLOBALS['opt_m_contract_time_inc_bd'],
                $h_time_start_hour_src,
                $h_time_start_minute_src,
                $h_time_end_hour_src,
                $h_time_end_minute_src,
                $h_time_start_minute_dst_bill,
                $h_time_end_minute_dst_bill
                );
        //支払いサイド①
        $GLOBALS['a_sTrace'] = '### 支払いサイド① ###<br>';
        _adjustmentWorkTimeSub1(
                $h_obj_sheet,
                $h_row,
                $GLOBALS['opt_m_contract_time_inc_pd'],
                $h_time_start_hour_src,
                $h_time_start_minute_src,
                $h_time_end_hour_src,
                $h_time_end_minute_src,
                $h_time_start_minute_dst_pay1,
                $h_time_end_minute_dst_pay1
                );
        //支払いサイド②
        $GLOBALS['a_sTrace'] = '### 支払いサイド② ###<br>';
        _adjustmentWorkTimeSub1(
                $h_obj_sheet,
                $h_row,
                $GLOBALS['opt_m_contract_time_inc_pd'],
                $h_time_start_hour_src,
                $h_time_start_minute_src,
                $h_time_end_hour_src,
                $h_time_end_minute_src,
                $h_time_start_minute_dst_pay2,
                $h_time_end_minute_dst_pay2
                );

        //----------------------------------------------------------
        //契約の作業時間「開始」「終了」と休憩時間「開始」「終了」と①をコンペアし、再計算する。
        //（残業時間・控除時間も算出する）
        //----------------------------------------------------------
        //契約の勤務時間を算出
        $h_work_time_contract =
            com_time_diff(
                strtotime($h_time_table_year."-".$h_time_table_month."-".$h_time_table_day." ".$GLOBALS['inp_kaishi1'].":00"),
                strtotime($h_time_table_year."-".$h_time_table_month."-".$h_time_table_day." ".$GLOBALS['inp_syuryo1'].":00"),
                "m"
                );
        $GLOBALS['a_sTrace'] = '契約の勤務時間：'.strval($h_work_time_contract).'<br>';

        //契約の休憩時間を算出
        $h_break_time_contract =
            com_time_diff(
                strtotime($h_time_table_year."-".$h_time_table_month."-".$h_time_table_day." ".$GLOBALS['inp_kaishi2'].":00"),
                strtotime($h_time_table_year."-".$h_time_table_month."-".$h_time_table_day." ".$GLOBALS['inp_syuryo2'].":00"),
                "m"
                );
        $GLOBALS['a_sTrace'] = '契約の休憩時間：'.strval($h_break_time_contract).'<br>';
        $h_work_time_contract -= $h_break_time_contract;
        $GLOBALS['a_sTrace'] = '契約の作業時間：'.strval($h_work_time_contract).'<br>';

        //請求サイド
        $GLOBALS['a_sTrace'] = '### 請求サイド ###<br>';
        _adjustmentWorkTimeSub2(
                $h_obj_sheet,
                $h_row,
                $h_time_table_year,
                $h_time_table_month,
                $h_time_table_day,
                $h_work_time_contract,
                $h_time_start_hour_src,
                $h_time_start_minute_src,
                $h_time_end_hour_src,
                $h_time_end_minute_src,
                $h_time_start_minute_dst_bill,
                $h_time_end_minute_dst_bill,
                $h_work_time_actualy_bill,
                $h_break_time_actualy_bill,
                $h_deduction_time_actualy_bill,
                $h_over_time_actualy_bill
                );
        //支払いサイド①
        $GLOBALS['a_sTrace'] = '### 支払いサイド① ###<br>';
        _adjustmentWorkTimeSub2(
                $h_obj_sheet,
                $h_row,
                $h_time_table_year,
                $h_time_table_month,
                $h_time_table_day,
                $h_work_time_contract,
                $h_time_start_hour_src,
                $h_time_start_minute_src,
                $h_time_end_hour_src,
                $h_time_end_minute_src,
                $h_time_start_minute_dst_pay1,
                $h_time_end_minute_dst_pay1,
                $h_work_time_actualy_pay1,
                $h_break_time_actualy_pay1,
                $h_deduction_time_actualy_pay1,
                $h_over_time_actualy_pay1
                );
        //支払いサイド②
        $GLOBALS['a_sTrace'] = '### 支払いサイド② ###<br>';
        _adjustmentWorkTimeSub2(
                $h_obj_sheet,
                $h_row,
                $h_time_table_year,
                $h_time_table_month,
                $h_time_table_day,
                $h_work_time_contract,
                $h_time_start_hour_src,
                $h_time_start_minute_src,
                $h_time_end_hour_src,
                $h_time_end_minute_src,
                $h_time_start_minute_dst_pay2,
                $h_time_end_minute_dst_pay2,
                $h_work_time_actualy_pay2,
                $h_break_time_actualy_pay2,
                $h_deduction_time_actualy_pay2,
                $h_over_time_actualy_pay2
                );
    } catch (Exception $ex) {
        echo 'Error:'.$e->getMessage();
    }
}

function _adjustmentWorkTimeSub1(
        $h_obj_sheet,
        $h_row,
        $h_divid,
        $h_time_start_hour_src,
        $h_time_start_minute_src,
        $h_time_end_hour_src,
        $h_time_end_minute_src,
        &$h_time_start_minute_dst,
        &$h_time_end_minute_dst
        ){
    try{
        if (ctype_digit($h_divid) == TRUE){
            $GLOBALS['a_sTrace'] = '時間刻み（日次）：'.$h_divid.'<br>';        //作業開始時間の調整
            $a_inc_bd = intval($h_divid);
            if (ctype_digit($h_time_start_minute_src) == TRUE){
                $a_minute = intval($h_time_start_minute_src);
                $a_syo = floor($a_minute / $a_inc_bd);
                $a_amari = $a_minute % $a_inc_bd;
                $a_time_start_minute_dst_dig = 0;
                if ($a_amari != 0){
                    $a_time_start_minute_dst_dig += $a_inc_bd;
                }
                $a_time_start_minute_dst_dig += $a_inc_bd * $a_syo;
                $h_time_start_minute_dst = str_pad(strval($a_time_start_minute_dst_dig), "2", "0", STR_PAD_LEFT);
                $GLOBALS['a_sTrace'] = '作業開始時間：'.$h_time_start_hour_src.":".$h_time_start_minute_dst.'<br>';
            }else{
                //$GLOBALS['a_sTrace'] = $a_time_start_minute_src.'なんで？<br>';
            }

            //作業終了時間の調整
            if (ctype_digit($h_time_end_minute_src) == TRUE){
                $a_minute = intval($h_time_end_minute_src);
                $a_syo = floor($a_minute / $a_inc_bd);
                $a_amari = $a_minute % $a_inc_bd;
                $a_time_end_minute_dst_dig = 0;
                $a_time_end_minute_dst_dig += $a_inc_bd * $a_syo;
                $h_time_end_minute_dst = str_pad(strval($a_time_end_minute_dst_dig), "2", "0", STR_PAD_LEFT);
                $GLOBALS['a_sTrace'] = '作業終了時間：'.$h_time_end_hour_src.":".$h_time_end_minute_dst.'<br>';
            }else{
                //$GLOBALS['a_sTrace'] = $a_time_start_minute_src.'なんで？<br>';
            }

        }else{
            $GLOBALS['a_sTrace'] = '時間刻み（日次）：なし<br>';
        }        
    } catch (Exception $ex) {
        echo 'Error:'.$e->getMessage();
    }
}

function _adjustmentWorkTimeSub2(
        $h_obj_sheet,
        $h_row,
        $h_time_table_year,
        $h_time_table_month,
        $h_time_table_day,
        $h_work_time_contract,
        $h_time_start_hour_src,
        $h_time_start_minute_src,
        $h_time_end_hour_src,
        $h_time_end_minute_src,
        $h_time_start_minute_dst,
        $h_time_end_minute_dst,
        &$h_work_time_actualy,
        &$h_break_time_actualy,
        &$h_deduction_time_actualy,
        &$h_over_time_actualy
        ){
    try{
        //$GLOBALS['a_sTrace'] = $h_time_start_hour_src.'#'.$h_time_start_minute_dst.'#'.$h_time_end_hour_src.'#'.$h_time_end_minute_dst.'<br>';
        if (($h_time_start_hour_src != '') && ($h_time_start_minute_dst != '') && ($h_time_end_hour_src != '') && ($h_time_end_minute_dst != '')){
            //実際の勤務時間を算出
            $h_work_time_actualy =
                com_time_diff(
                    strtotime($h_time_table_year."-".$h_time_table_month."-".$h_time_table_day." ".str_pad($h_time_start_hour_src, 2, "0", STR_PAD_LEFT).":".str_pad($h_time_start_minute_dst, 2, "0", STR_PAD_LEFT).":00"),
                    strtotime($h_time_table_year."-".$h_time_table_month."-".$h_time_table_day." ".str_pad($h_time_end_hour_src, 2, "0", STR_PAD_LEFT).":".str_pad($h_time_end_minute_dst, 2, "0", STR_PAD_LEFT).":00"),
                    "m"
                    );
            $GLOBALS['a_sTrace'] = '実際の勤務時間：'.strval($h_work_time_actualy).'<br>';

            //実際の休憩時間を算出
            $h_break_time_actualy = 0;
            $a_break_time_actualy_str = strval($h_obj_sheet->getCellByColumnAndRow(9, $h_row)->getCalculatedValue());
            #$a_break_time_actualy_str = strval($h_obj_sheet->getCellByColumnAndRow(8, $h_row)->getCalculatedValue());
            if (ctype_digit($a_break_time_actualy_str) == TRUE){
                $h_break_time_actualy += intval($a_break_time_actualy_str) * 60;
            }
            $a_break_time_actualy_str = strval($h_obj_sheet->getCellByColumnAndRow(10, $h_row)->getCalculatedValue());
            #$a_break_time_actualy_str = strval($h_obj_sheet->getCellByColumnAndRow(9, $h_row)->getCalculatedValue());
            if (ctype_digit($a_break_time_actualy_str) == TRUE){
                $h_break_time_actualy += intval($a_break_time_actualy_str);
            }
            $GLOBALS['a_sTrace'] = '実際の休憩時間：'.strval($h_break_time_actualy).'<br>';
            $h_work_time_actualy -= $h_break_time_actualy;
            $GLOBALS['a_sTrace'] = '実際の作業時間：'.strval($h_work_time_actualy).'<br>';

            //控除時間の算出
            $h_deduction_time_actualy =  $h_work_time_contract - $h_work_time_actualy;
            if ($h_deduction_time_actualy <= 0){
                //0以下の場合は0とする。（控除なし）
                $h_deduction_time_actualy = 0;
            }
            $GLOBALS['a_sTrace'] = '控除時間：'.strval($h_deduction_time_actualy).'<br>';

            //残業時間の算出
            $h_over_time_actualy = 0;
            if ($h_work_time_actualy > $h_work_time_contract){
                //実際の作業時間が契約の作業時間よりも多い場合
                $h_over_time_actualy = 
                    com_time_diff(
                        strtotime($h_time_table_year."-".$h_time_table_month."-".$h_time_table_day." ".$GLOBALS['inp_syuryo1'].":00"),
                        strtotime($h_time_table_year."-".$h_time_table_month."-".$h_time_table_day." ".str_pad($h_time_end_hour_src, 2, "0", STR_PAD_LEFT).":".str_pad($h_time_end_minute_dst, 2, "0", STR_PAD_LEFT).":00"),
                        "m"
                        );
                if ($h_over_time_actualy <= 0){
                    //0より小さい場合は0とする。
                    $h_over_time_actualy = 0; 
                }
            }
            $GLOBALS['a_sTrace'] = '残業時間：'.strval($h_over_time_actualy).'<br>';
        }
    } catch (Exception $ex) {
        echo 'Error:'.$e->getMessage();
    }
}
        

//給与計算
function _calcAllowance(
        $h_conn,
        $h_engineer_no,
        $h_time_table_year,
        $h_time_table_month,
        $h_time_table_day_last, //未使用？
        $h_cr_id
        ){
    try{
        $a_day = $h_time_table_year."/".$h_time_table_month."/".$h_time_table_day_last;

        $a_sql = set_10100_selectDB();
        $a_sql .= " WHERE (cr_id=:cr_id);";
        $a_stmt = $h_conn->prepare($a_sql);
        com_pdo_bindValue($a_stmt, ':cr_id', $h_cr_id);
        $a_stmt->execute();

        while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
            $GLOBALS['a_sTrace'] = '契約レポート検出！<br>';
            $a_bRet = true;
            set_10100_fromDB($a_result);
        }
        
        //----------------------------------------------------------------------
        //請求サイドの計算
        //----------------------------------------------------------------------
        $GLOBALS['a_sTrace'] = '--請求サイドの計算--------------------------------------<br>';
        $a_calc_day_start_bill = 0;
        $a_calc_day_end_bill = 0;
        $a_unit_bill = 0;
        $a_work_time_actualy_bill_src = 0;
        $a_work_time_actualy_bill_dst = 0;
        $a_deduction_time_actualy_bill = 0;
        $a_over_time_actualy_bill = 0;
        $a_charge_deduction_bill = 0;
        $a_charge_over_bill = 0;
        $a_charge_bill = 0;
        _calcAllowanceSub(
                $h_conn,
                $h_engineer_no,
                $h_time_table_year,
                $h_time_table_month,
                $GLOBALS['opt_m_contract_time_inc_bm'],
                $GLOBALS['opt_contract_tighten_b'],
                0,
                $a_calc_day_start_bill,
                $a_calc_day_end_bill,
                $a_unit_bill,
                $a_work_time_actualy_bill_src,
                $a_work_time_actualy_bill_dst,
                $a_deduction_time_actualy_bill,
                $a_over_time_actualy_bill,
                $a_charge_deduction_bill,
                $a_charge_over_bill,
                $a_charge_bill
                );

        $GLOBALS['a_sTrace'] = '--支払いサイド①の計算--------------------------------------<br>';
        $a_calc_day_start_pay1 = 0;
        $a_calc_day_end_pay1 = 0;
        $a_unit_pay1 = 0;
        $a_work_time_actualy_pay1_src = 0;
        $a_work_time_actualy_pay1_dst = 0;
        $a_deduction_time_actualy_pay1 = 0;
        $a_over_time_actualy_pay1 = 0;
        $a_charge_deduction_pay1 = 0;
        $a_charge_over_pay1 = 0;
        $a_charge_pay1 = 0;
        //支払い計算も請求サイドの締日で行う。
        _calcAllowanceSub(
                $h_conn,
                $h_engineer_no,
                $h_time_table_year,
                $h_time_table_month,
                $GLOBALS['opt_m_contract_time_inc_pm'],
                $GLOBALS['opt_contract_tighten_b'], #$GLOBALS['opt_contract_tighten_p'],
                1,
                $a_calc_day_start_pay1,
                $a_calc_day_end_pay1,
                $a_unit_pay1,
                $a_work_time_actualy_pay1_src,
                $a_work_time_actualy_pay1_dst,
                $a_deduction_time_actualy_pay1,
                $a_over_time_actualy_pay1,
                $a_charge_deduction_pay1,
                $a_charge_over_pay1,
                $a_charge_pay1
                );
        $GLOBALS['a_sTrace'] = '--支払いサイド②の計算--------------------------------------<br>';
        $a_calc_day_start_pay2 = 0;
        $a_calc_day_end_pay2 = 0;
        $a_unit_pay2 = 0;
        $a_work_time_actualy_pay2_src = 0;
        $a_work_time_actualy_pay2_dst = 0;
        $a_deduction_time_actualy_pay2 = 0;
        $a_over_time_actualy_pay2 = 0;
        $a_charge_deduction_pay2 = 0;
        $a_charge_over_pay2 = 0;
        $a_charge_pay2 = 0;
        //支払い計算も請求サイドの締日で行う。
        _calcAllowanceSub(
                $h_conn,
                $h_engineer_no,
                $h_time_table_year,
                $h_time_table_month,
                $GLOBALS['opt_m_contract_time_inc_pm'],
                $GLOBALS['opt_contract_tighten_b'], #$GLOBALS['opt_contract_tighten_p'],
                2,
                $a_calc_day_start_pay2,
                $a_calc_day_end_pay2,
                $a_unit_pay2,
                $a_work_time_actualy_pay2_src,
                $a_work_time_actualy_pay2_dst,
                $a_deduction_time_actualy_pay2,
                $a_over_time_actualy_pay2,
                $a_charge_deduction_pay2,
                $a_charge_over_pay2,
                $a_charge_pay2
                );
        
        //----------------------------------------------------------------------
        //DBに登録
        //----------------------------------------------------------------------
        $h_conn->beginTransaction();  //トランザクション開始

        $a_sql = "DELETE FROM ".$GLOBALS['g_DB_t_charge_calc'];
        $a_sql .= " WHERE (engineer_no=:engineer_no)";
        $a_sql .= " AND (cr_id=:cr_id)";
        $a_sql .= " AND (calc_day_start_bill=:calc_day_start_bill);";
        //$GLOBALS['a_sTrace'] = $a_sql.'<br>';
        $a_stmt = $h_conn->prepare($a_sql);
        $a_stmt->bindParam(':engineer_no', $h_engineer_no, PDO::PARAM_STR);
        com_pdo_bindValue($a_stmt,':cr_id', $h_cr_id);
        com_pdo_bindValue($a_stmt, ':calc_day_start_bill', $a_calc_day_start_bill);
        $a_stmt->execute();

        $a_sql = "INSERT INTO ".$GLOBALS['g_DB_t_charge_calc'].
                "(engineer_no,
                  cr_id,
                  calc_day_start_bill,
                  calc_day_end_bill,
                  unit_bill,
                  work_time_actualy_bill_src,
                  work_time_actualy_bill_dst,
                  deduction_time_actualy_bill,
                  over_time_actualy_bill,
                  charge_deduction_bill,
                  charge_over_bill,
                  charge_bill,
                  calc_day_start_pay1,
                  calc_day_end_pay1,
                  unit_pay1,
                  work_time_actualy_pay1_src,
                  work_time_actualy_pay1_dst,
                  deduction_time_actualy_pay1,
                  over_time_actualy_pay1,
                  charge_deduction_pay1,
                  charge_over_pay1,
                  charge_pay1,
                  calc_day_start_pay2,
                  calc_day_end_pay2,
                  unit_pay2,
                  work_time_actualy_pay2_src,
                  work_time_actualy_pay2_dst,
                  deduction_time_actualy_pay2,
                  over_time_actualy_pay2,
                  charge_deduction_pay2,
                  charge_over_pay2,
                  charge_pay2
                )VALUES(";
        $a_sql .= ":engineer_no,
                  :cr_id,
                  :calc_day_start_bill,
                  :calc_day_end_bill,
                  :unit_bill,
                  :work_time_actualy_bill_src,
                  :work_time_actualy_bill_dst,
                  :deduction_time_actualy_bill,
                  :over_time_actualy_bill,
                  :charge_deduction_bill,
                  :charge_over_bill,
                  :charge_bill,
                  :calc_day_start_pay1,
                  :calc_day_end_pay1,
                  :unit_pay1,
                  :work_time_actualy_pay1_src,
                  :work_time_actualy_pay1_dst,
                  :deduction_time_actualy_pay1,
                  :over_time_actualy_pay1,
                  :charge_deduction_pay1,
                  :charge_over_pay1,
                  :charge_pay1,
                  :calc_day_start_pay2,
                  :calc_day_end_pay2,
                  :unit_pay2,
                  :work_time_actualy_pay2_src,
                  :work_time_actualy_pay2_dst,
                  :deduction_time_actualy_pay2,
                  :over_time_actualy_pay2,
                  :charge_deduction_pay2,
                  :charge_over_pay2,
                  :charge_pay2
                );";
        $a_stmt = $h_conn->prepare($a_sql);
        $a_stmt->bindParam(':engineer_no', $h_engineer_no, PDO::PARAM_STR);
        com_pdo_bindValue($a_stmt, ':cr_id', $GLOBALS['cr_id']);
        
        com_pdo_bindValue($a_stmt, ':calc_day_start_bill', $a_calc_day_start_bill);
        com_pdo_bindValue($a_stmt, ':calc_day_end_bill', $a_calc_day_end_bill);
        com_pdo_bindValue($a_stmt, ':unit_bill', $a_unit_bill);
        com_pdo_bindValue($a_stmt, ':work_time_actualy_bill_src', $a_work_time_actualy_bill_src);
        com_pdo_bindValue($a_stmt, ':work_time_actualy_bill_dst', $a_work_time_actualy_bill_dst);
        com_pdo_bindValue($a_stmt, ':deduction_time_actualy_bill', $a_deduction_time_actualy_bill);
        com_pdo_bindValue($a_stmt, ':over_time_actualy_bill', $a_over_time_actualy_bill);
        com_pdo_bindValue($a_stmt, ':charge_deduction_bill', $a_charge_deduction_bill);
        com_pdo_bindValue($a_stmt, ':charge_over_bill', $a_charge_over_bill);
        com_pdo_bindValue($a_stmt, ':charge_bill', $a_charge_bill);

        com_pdo_bindValue($a_stmt, ':calc_day_start_pay1', $a_calc_day_start_pay1);
        com_pdo_bindValue($a_stmt, ':calc_day_end_pay1', $a_calc_day_end_pay1);
        com_pdo_bindValue($a_stmt, ':unit_pay1', $a_unit_pay1);
        com_pdo_bindValue($a_stmt, ':work_time_actualy_pay1_src', $a_work_time_actualy_pay1_src);
        com_pdo_bindValue($a_stmt, ':work_time_actualy_pay1_dst', $a_work_time_actualy_pay1_dst);
        com_pdo_bindValue($a_stmt, ':deduction_time_actualy_pay1', $a_deduction_time_actualy_pay1);
        com_pdo_bindValue($a_stmt, ':over_time_actualy_pay1', $a_over_time_actualy_pay1);
        com_pdo_bindValue($a_stmt, ':charge_deduction_pay1', $a_charge_deduction_pay1);
        com_pdo_bindValue($a_stmt, ':charge_over_pay1', $a_charge_over_pay1);
        com_pdo_bindValue($a_stmt, ':charge_pay1', $a_charge_pay1);

        com_pdo_bindValue($a_stmt, ':calc_day_start_pay2', $a_calc_day_start_pay2);
        com_pdo_bindValue($a_stmt, ':calc_day_end_pay2', $a_calc_day_end_pay2);
        com_pdo_bindValue($a_stmt, ':unit_pay2', $a_unit_pay2);
        com_pdo_bindValue($a_stmt, ':work_time_actualy_pay2_src', $a_work_time_actualy_pay2_src);
        com_pdo_bindValue($a_stmt, ':work_time_actualy_pay2_dst', $a_work_time_actualy_pay2_dst);
        com_pdo_bindValue($a_stmt, ':deduction_time_actualy_pay2', $a_deduction_time_actualy_pay2);
        com_pdo_bindValue($a_stmt, ':over_time_actualy_pay2', $a_over_time_actualy_pay2);
        com_pdo_bindValue($a_stmt, ':charge_deduction_pay2', $a_charge_deduction_pay2);
        com_pdo_bindValue($a_stmt, ':charge_over_pay2', $a_charge_over_pay2);
        com_pdo_bindValue($a_stmt, ':charge_pay2', $a_charge_pay2);

        $a_stmt->execute();
        
        //----------------------------------------------------------------------
        //検収台帳へ反映
        //----------------------------------------------------------------------
        #消費税算出
        $a_consumption_tax = 1;
        //echo $GLOBALS['a_consumption_tax'].'<br>';
        //echo gettype($GLOBALS['a_consumption_tax']).'<br>';
        $a_split = explode(",", $GLOBALS['a_consumption_tax']);
        //echo $a_split[0].'<br>';
        //echo count($a_split).'<br>';
        for ($a_cnt = count($a_split) - 1; $a_cnt >= 0; $a_cnt--){
            #echo $a_split[$a_cnt - 1].'<br>';
            $a_diff =
                com_time_diff(
                    strtotime($a_split[$a_cnt - 1]." 00:00:00"),
                    strtotime($a_calc_day_end_bill." 00:00:00"),
                    "d"
                    );

            if ($a_diff >= 0){
                $a_consumption_tax = $a_split[$a_cnt];
                $a_consumption_tax += 1.00;
                break;
            }
            $a_cnt--;   //2つずらす必要あり
        }
        $GLOBALS['a_sTrace'] = '消費税：'.strval($a_consumption_tax).'<br>';
        
        $a_accounts_expenses = 0;  #売掛（諸経費）
        $a_accounts_tax_meter_noinclude = 0;  #売掛（計（税抜）+諸経費）
        $a_accounts_tax_meter_include = 0;  #売掛（計（税込））
        $a_payment_commuting_expenses = 0;    #支払（交通費等）
        $a_payment_tax_meter_noinclude = 0;  #売掛（計（税抜）+諸経費）
        $a_payment_tax_meter_include = 0;  #売掛（計（税込））

        #実働時間を分から時間に変更
        $a_work_time_actualy_bill_dst = $a_work_time_actualy_bill_dst / 60;
        $a_work_time_actualy_pay2_dst = $a_work_time_actualy_pay2_dst / 60;
        
        $a_isFound = false;
        $a_sql = "SELECT * FROM ".$GLOBALS['g_DB_t_acceptance_ledger']." WHERE (cr_id=:cr_id)";
        #売上日が同じものを検出
        $a_sql .= " AND (accounts_bai_previous_day=:accounts_bai_previous_day);";
        $a_stmt = $h_conn->prepare($a_sql);
        com_pdo_bindValue($a_stmt, ':cr_id', $GLOBALS['cr_id']);
        com_pdo_bindValue($a_stmt, ':accounts_bai_previous_day', $a_calc_day_end_bill);
        $a_stmt->execute();
        while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
            if ($a_result['accounts_expenses'] != ''){
                $a_accounts_expenses = intval($a_result['accounts_expenses']);  #売掛（諸経費）
            }
            if ($a_result['payment_commuting_expenses'] != ''){
                $a_payment_commuting_expenses = intval($a_result['payment_commuting_expenses']);    #支払（交通費等）
            }

            $a_isFound = true;
        }
        
        #諸経費・計の計算
        $a_accounts_tax_meter_noinclude = $a_charge_bill + $a_accounts_expenses;  #売掛（計（税抜）+諸経費）
        $a_accounts_tax_meter_include = floor(($a_charge_bill * $a_consumption_tax) + $a_accounts_expenses);  #売掛（計（税込））
        $a_payment_tax_meter_noinclude = $a_charge_pay2 + $a_payment_commuting_expenses;  #売掛（計（税抜）+諸経費）
        $a_payment_tax_meter_include = floor(($a_charge_pay2 * $a_consumption_tax) + $a_payment_commuting_expenses);  #売掛（計（税込））
        
        if ($a_isFound == false){
            #新規追加
            $a_sql = "INSERT INTO ".$GLOBALS['g_DB_t_acceptance_ledger'].
                    "(cr_id,
                      accounts_bai_previous_day,
                      accounts_sales_will_amount,
                      accounts_actual_working_hours,
                      accounts_actual_amount_money,
                      payment_acceptance_date,
                      payment_schedule_amount,
                      payment_actual_working_hours,
                      payment_actual_amount_money,
                      accounts_expenses,
                      accounts_tax_meter_noinclude,
                      accounts_tax_meter_include,
                      payment_commuting_expenses,
                      payment_tax_meter_noinclude,
                      payment_tax_meter_include,
                      reg_id,
                      reg_date
                    )VALUES(";
            $a_sql .= ":cr_id,
                      :accounts_bai_previous_day,
                      :accounts_sales_will_amount,
                      :accounts_actual_working_hours,
                      :accounts_actual_amount_money,
                      :payment_acceptance_date,
                      :payment_schedule_amount,
                      :payment_actual_working_hours,
                      :payment_actual_amount_money,
                      :accounts_expenses,
                      :accounts_tax_meter_noinclude,
                      :accounts_tax_meter_include,
                      :payment_commuting_expenses,
                      :payment_tax_meter_noinclude,
                      :payment_tax_meter_include,
                      :reg_id,
                      :reg_date
                    );";
        }else{
            #更新
            $a_sql = "UPDATE ".$GLOBALS['g_DB_t_acceptance_ledger'].
                    " SET 
                      accounts_sales_will_amount=:accounts_sales_will_amount,
                      accounts_actual_working_hours=:accounts_actual_working_hours,
                      accounts_actual_amount_money=:accounts_actual_amount_money,
                      payment_acceptance_date=:payment_acceptance_date,
                      payment_schedule_amount=:payment_schedule_amount,
                      payment_actual_working_hours=:payment_actual_working_hours,
                      payment_actual_amount_money=:payment_actual_amount_money,
                      accounts_expenses=:accounts_expenses,
                      accounts_tax_meter_noinclude=:accounts_tax_meter_noinclude,
                      accounts_tax_meter_include=:accounts_tax_meter_include,
                      payment_commuting_expenses=:payment_commuting_expenses,
                      payment_tax_meter_noinclude=:payment_tax_meter_noinclude,
                      payment_tax_meter_include=:payment_tax_meter_include,
                      upd_id=:upd_id,
                      upd_date=:upd_date
                    ";
        }
        
        if ($a_isFound == false){
            #新規追加
        }else{
            #更新
            $a_sql .= " WHERE (cr_id=:cr_id) AND (accounts_bai_previous_day=:accounts_bai_previous_day)";
        }
        $a_stmt = $h_conn->prepare($a_sql);
        com_pdo_bindValue($a_stmt, ':cr_id', $GLOBALS['cr_id']);
        com_pdo_bindValue($a_stmt, ':accounts_bai_previous_day', $a_calc_day_end_bill);
        com_pdo_bindValue($a_stmt, ':accounts_sales_will_amount', $a_unit_bill);
        com_pdo_bindValue($a_stmt, ':accounts_actual_working_hours', $a_work_time_actualy_bill_dst);
        com_pdo_bindValue($a_stmt, ':accounts_actual_amount_money', $a_charge_bill);
        com_pdo_bindValue($a_stmt, ':payment_acceptance_date', $a_calc_day_end_bill);
        com_pdo_bindValue($a_stmt, ':payment_schedule_amount', $a_unit_pay2);
        com_pdo_bindValue($a_stmt, ':payment_actual_working_hours', $a_work_time_actualy_pay2_dst);
        com_pdo_bindValue($a_stmt, ':payment_actual_amount_money', $a_charge_pay2);

        com_pdo_bindValue($a_stmt, ':accounts_expenses', $a_accounts_expenses);
        com_pdo_bindValue($a_stmt, ':accounts_tax_meter_noinclude', $a_accounts_tax_meter_noinclude);
        com_pdo_bindValue($a_stmt, ':accounts_tax_meter_include', $a_accounts_tax_meter_include);
        com_pdo_bindValue($a_stmt, ':payment_commuting_expenses', $a_payment_commuting_expenses);
        com_pdo_bindValue($a_stmt, ':payment_tax_meter_noinclude', $a_payment_tax_meter_noinclude);
        com_pdo_bindValue($a_stmt, ':payment_tax_meter_include', $a_payment_tax_meter_include);

        if ($a_isFound == false){
            #新規追加
            com_pdo_bindValue($a_stmt, ':reg_id', $_SESSION['hal_idx']);
            com_pdo_bindValue($a_stmt, ':reg_date', date("Y/m/d"));
        } else {
            #更新
            com_pdo_bindValue($a_stmt, ':upd_id', $_SESSION['hal_idx']);
            com_pdo_bindValue($a_stmt, ':upd_date', date("Y/m/d"));
        }

        $a_stmt->execute();

        $h_conn->commit();    //コミット

    } catch (Exception $e) {
        if ($h_conn) {
            $h_conn->rollBack();  //ロールバック
        }
        echo 'Error:'.$e->getMessage();
    }    
}

function _calcAllowanceSub(
        $h_conn,
        $h_engineer_no,
        $h_time_table_year,
        $h_time_table_month,
        $h_divid,
        $h_closing_day,
        $h_kind,
        &$h_calc_day_start,
        &$h_calc_day_end,
        &$h_unit,
        &$h_work_time_actualy_src,
        &$h_work_time_actualy_dst,
        &$h_deduction_time_actualy,
        &$h_over_time_actualy,
        &$h_charge_deduction,
        &$h_charge_over,
        &$h_charge
        ){
    try{
        //締日
        $a_closing_day = 0;
        if (ctype_digit($h_closing_day) == TRUE){
            $a_closing_day = intval($h_closing_day);
        }else{
            //月末の締め
        }
        //計算対象の締範囲を算出
        if ($a_closing_day != 0){
            $a_clac_day_end = $h_time_table_year."/".$h_time_table_month."/".$a_closing_day;
            $a_clac_day_start = date("Y/m/d", strtotime($a_clac_day_end." -1 month"));
            $a_clac_day_start = date("Y/m/d", strtotime($a_clac_day_start." 1 day"));
        }else{
            $a_clac_day_start = $h_time_table_year."/".$h_time_table_month."/01";
            $a_clac_day_end = date("Y/m/d", strtotime($a_clac_day_start." 1 month"));
            $a_clac_day_end = date("Y/m/d", strtotime($a_clac_day_end." -1 day"));
        }
        $a_clac_day_start_src = $a_clac_day_start;
        $a_clac_day_end_src = $a_clac_day_end;
        $GLOBALS['a_sTrace'] = '対象の締開始日：'.$a_clac_day_start.'<br>';
        $GLOBALS['a_sTrace'] = '対象の締終了日：'.$a_clac_day_end.'<br>';

        $a_diff =
                com_time_diff(
                    strtotime($GLOBALS['inp_kyakusaki_kaishi']),
                    strtotime($a_clac_day_start),
                    "d"
                    );
        if ($a_diff < 0){
            $a_clac_day_start = $GLOBALS['inp_kyakusaki_kaishi'];
        }
        $a_diff =
                com_time_diff(
                    strtotime($GLOBALS['inp_kyakusaki_syuryo']),
                    strtotime($a_clac_day_end),
                    "d"
                    );
        if ($a_diff > 0){
            $a_clac_day_end = $GLOBALS['inp_kyakusaki_syuryo'];
        }
        $GLOBALS['a_sTrace'] = '実の締開始日：'.$a_clac_day_start.'<br>';
        $GLOBALS['a_sTrace'] = '実の締終了日：'.$a_clac_day_end.'<br>';
        $h_calc_day_start = $a_clac_day_start;
        $h_calc_day_end = $a_clac_day_end;
                
        $a_calc_kind = '';  //計算方法
        $a_lower = '';      //下限
        $a_upper = '';      //上限
        $a_unit = '';        //単価
        $a_deduction = '';   //控除単価
        $a_overtime = '';    //残業単価
        
        //通常期間か途中入場か途中退場かを算出
        $a_diff =
                com_time_diff(
                    strtotime($a_clac_day_start_src),
                    strtotime($a_clac_day_start),
                    "d"
                    );
        if ($a_diff > 0){
            //途中入場
            $GLOBALS['a_sTrace'] = '途中入場<br>';
                switch ($h_kind){
                    case 0: //請求サイド
                        $a_calc_kind = $GLOBALS['opt_contract_calc_b2'];  //計算方法
                        $a_lower = $GLOBALS['contract_lower_limit_b2'];      //下限
                        $a_upper = $GLOBALS['contract_upper_limit_b2'];      //上限
                        $a_unit = $GLOBALS['txt_tankin_b2'];        //単価
                        $a_deduction = $GLOBALS['txt_contract_kojyo_unit_b2'];   //控除単価
                        $a_overtime = $GLOBALS['txt_contract_zangyo_unit_b2'];    //残業単価
                        break;
                    case 1: //支払いサイド①
                        $a_calc_kind = $GLOBALS['opt_contract_calc_p12'];  //計算方法
                        $a_lower = $GLOBALS['txt_contract_lower_limit_p12'];      //下限
                        $a_upper = $GLOBALS['txt_contract_upper_limit_p12'];      //上限
                        $a_unit = $GLOBALS['txt_tankin_p12'];        //単価
                        $a_deduction = $GLOBALS['txt_contract_kojyo_unit_p12'];   //控除単価
                        $a_overtime = $GLOBALS['txt_contract_zangyo_unit_p12'];    //残業単価
                        break;
                    case 2: //支払いサイド②
                        $a_calc_kind = $GLOBALS['opt_contract_calc_p22'];  //計算方法
                        $a_lower = $GLOBALS['txt_contract_lower_limit_p22'];      //下限
                        $a_upper = $GLOBALS['txt_contract_upper_limit_p22'];      //上限
                        $a_unit = $GLOBALS['txt_tankin_p22'];        //単価
                        $a_deduction = $GLOBALS['txt_contract_kojyo_unit_p22'];   //控除単価
                        $a_overtime = $GLOBALS['txt_contract_zangyo_unit_p22'];    //残業単価
                        break;
                }
        }else{
            $a_diff =
                    com_time_diff(
                        strtotime($a_clac_day_end_src),
                        strtotime($a_clac_day_end),
                        "d"
                        );
            if ($a_diff < 0){
                //途中退場
                $GLOBALS['a_sTrace'] = '途中退場<br>';
                switch ($h_kind){
                    case 0: //請求サイド
                        $a_calc_kind = $GLOBALS['opt_contract_calc_b3'];  //計算方法
                        $a_lower = $GLOBALS['contract_lower_limit_b3'];      //下限
                        $a_upper = $GLOBALS['contract_upper_limit_b3'];      //上限
                        $a_unit = $GLOBALS['txt_tankin_b3'];        //単価
                        $a_deduction = $GLOBALS['txt_contract_kojyo_unit_b3'];   //控除単価
                        $a_overtime = $GLOBALS['txt_contract_zangyo_unit_b3'];    //残業単価
                        break;
                    case 1: //支払いサイド①
                        $a_calc_kind = $GLOBALS['opt_contract_calc_p13'];  //計算方法
                        $a_lower = $GLOBALS['txt_contract_lower_limit_p13'];      //下限
                        $a_upper = $GLOBALS['txt_contract_upper_limit_p13'];      //上限
                        $a_unit = $GLOBALS['txt_tankin_p13'];        //単価
                        $a_deduction = $GLOBALS['txt_contract_kojyo_unit_p13'];   //控除単価
                        $a_overtime = $GLOBALS['txt_contract_zangyo_unit_p13'];    //残業単価
                        break;
                    case 2: //支払いサイド②
                        $a_calc_kind = $GLOBALS['opt_contract_calc_p23'];  //計算方法
                        $a_lower = $GLOBALS['txt_contract_lower_limit_p23'];      //下限
                        $a_upper = $GLOBALS['txt_contract_upper_limit_p23'];      //上限
                        $a_unit = $GLOBALS['txt_tankin_p23'];        //単価
                        $a_deduction = $GLOBALS['txt_contract_kojyo_unit_p23'];   //控除単価
                        $a_overtime = $GLOBALS['txt_contract_zangyo_unit_p23'];    //残業単価
                        break;
                }
            }else{
                //通常期間
                $GLOBALS['a_sTrace'] = '通常期間<br>';
                switch ($h_kind){
                    case 0: //請求サイド
                        $a_calc_kind = $GLOBALS['opt_contract_calc_b1'];  //計算方法
                        $a_lower = $GLOBALS['contract_lower_limit_b1'];      //下限
                        $a_upper = $GLOBALS['contract_upper_limit_b1'];      //上限
                        $a_unit = $GLOBALS['inp_tankin_b1'];        //単価
                        $a_deduction = $GLOBALS['txt_contract_kojyo_unit_b1'];   //控除単価
                        $a_overtime = $GLOBALS['txt_contract_zangyo_unit_b1'];    //残業単価
                        break;
                    case 1: //支払いサイド①
                        $a_calc_kind = $GLOBALS['opt_contract_calc_p11'];  //計算方法
                        $a_lower = $GLOBALS['txt_contract_lower_limit_p11'];      //下限
                        $a_upper = $GLOBALS['txt_contract_upper_limit_p11'];      //上限
                        $a_unit = $GLOBALS['txt_tankin_p11'];        //単価
                        $a_deduction = $GLOBALS['txt_contract_kojyo_unit_p11'];   //控除単価
                        $a_overtime = $GLOBALS['txt_contract_zangyo_unit_p11'];    //残業単価
                        break;
                    case 2: //支払いサイド②
                        $a_calc_kind = $GLOBALS['opt_contract_calc_p21'];  //計算方法
                        $a_lower = $GLOBALS['txt_contract_lower_limit_p21'];      //下限
                        $a_upper = $GLOBALS['txt_contract_upper_limit_p21'];      //上限
                        $a_unit = $GLOBALS['txt_tankin_p21'];        //単価
                        $a_deduction = $GLOBALS['txt_contract_kojyo_unit_p21'];   //控除単価
                        $a_overtime = $GLOBALS['txt_contract_zangyo_unit_p21'];    //残業単価
                        break;
                }
            }
        }
        
        $a_unit = com_replace_toNumber($a_unit);        //単価
        $a_deduction = com_replace_toNumber($a_deduction);   //控除単価
        $a_overtime = com_replace_toNumber($a_overtime);    //残業単価

        $GLOBALS['a_sTrace'] = '計算方法：'.$a_calc_kind.'<br>';  //計算方法
        $GLOBALS['a_sTrace'] = '下限：'.$a_lower.'<br>';      //下限
        $GLOBALS['a_sTrace'] = '上限：'.$a_upper.'<br>';      //上限
        $GLOBALS['a_sTrace'] = '単価：'.$a_unit.'<br>';        //単価
        $GLOBALS['a_sTrace'] = '控除単価：'.$a_deduction.'<br>';   //控除単価
        $GLOBALS['a_sTrace'] = '残業単価：'.$a_overtime.'<br>';    //残業単価

        $h_unit = $a_unit;
        
        //タイムテーブルから対象範囲のデータを抽出する。
        $a_time_total = '';
        $a_sql = "SELECT SUM(";
        switch ($h_kind){
            case 0: //請求サイド
                $a_sql .= "work_time_actualy_bill";
                break;
            case 1: //支払いサイド①
                $a_sql .= "work_time_actualy_pay1";
                break;
            case 2: //支払いサイド②
                $a_sql .= "work_time_actualy_pay2";
                break;
        }
        $a_sql .= ") AS t_total FROM ".$GLOBALS['g_DB_t_time_table'];
        $a_sql .= " WHERE (work_day>=:work_day_start) AND (work_day<=:work_day_end) AND (engineer_no=:engineer_no);";
        //$GLOBALS['a_sTrace'] = $a_sql.'<br>';
        $a_stmt = $h_conn->prepare($a_sql);
        com_pdo_bindValue($a_stmt, ':work_day_start', $a_clac_day_start);
        com_pdo_bindValue($a_stmt, ':work_day_end', $a_clac_day_end);
        $a_stmt->bindParam(':engineer_no', $h_engineer_no, PDO::PARAM_STR);
        $a_stmt->execute();

        while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
            $a_time_total = $a_result['t_total'];
            $GLOBALS['a_sTrace'] = '作業時間合計：'.$a_time_total.'<br>';
        }
        
        //作業時間の合計を調整する。
        $a_time_total_dig = 0;
        if (ctype_digit($h_divid) == TRUE){
            $GLOBALS['a_sTrace'] = '時間刻み（月次）：'.$h_divid.'<br>';
            $a_inc_bd = intval($h_divid);
            if (ctype_digit($a_time_total) == TRUE){
                $a_time_total_dig = intval($a_time_total);
                $h_work_time_actualy_src = $a_time_total_dig;
                $a_syo = floor($a_time_total_dig / $a_inc_bd);
                $a_amari = $a_time_total_dig % $a_inc_bd;
                $a_time_total_dig = $a_inc_bd * $a_syo;
                $h_work_time_actualy_dst = $a_time_total_dig;
                $GLOBALS['a_sTrace'] = '実作業時間合計：'.strval($a_time_total_dig).'<br>';
            }else{
                //$GLOBALS['a_sTrace'] = $a_time_start_minute_src.'なんで？<br>';
            }

        }else{
            $GLOBALS['a_sTrace'] = '時間刻み（月次）：なし<br>';
        }
        
        $a_charge_total = 0;
        $a_message = '登録情報に不備がある為、計算できませんでした。';
        if (($a_calc_kind != '') && ($a_unit != '')){
            //計算方法／単価あり
            if ($a_calc_kind == '固定'){
                $GLOBALS['a_sTrace'] = '固定<br>';
                $a_charge_total = intval($a_unit);
                $a_message = '';
            }elseif($a_calc_kind == '時給'){
                $GLOBALS['a_sTrace'] = '時給<br>';
                if ($a_time_total != ''){
                    //$a_time_total_dig = intval($a_time_total);
                    $a_time_total_dig_h = $a_time_total_dig / 60;
                    $a_charge_total = floor(intval($a_unit) * $a_time_total_dig_h);
                    $a_message = '';
                }
            }else{
                $GLOBALS['a_sTrace'] = '稼働率<br>';
                if (($a_lower != '') && ($a_upper != '') && ($a_deduction != '') && ($a_overtime != '') && ($a_time_total != '')){
                    //下限・上限とのチェックを行う。
                    //$a_time_total_dig = intval($a_time_total);
                    $a_time_lower_dig = intval($a_lower) * 60;
                    $a_diff = $a_time_lower_dig - $a_time_total_dig;
                    if ($a_diff > 0){
                        $GLOBALS['a_sTrace'] = '控除あり<br>';
                        //控除あり
                        if ($h_divid != ''){
                            if (ctype_digit($h_divid) == TRUE){
                                $h_deduction_time_actualy = $a_diff;    //分
                                $h_charge_deduction = (floor($a_diff / intval($h_divid)) * intval($a_deduction));
                                $a_charge_total = intval($a_unit) - $h_charge_deduction;
                                $a_message = '';
                            }
                        }
                    }else{
                        $a_time_upper_dig = intval($a_upper) * 60;
                        $a_diff = $a_time_total_dig - $a_time_upper_dig;
                        if ($a_diff > 0){
                            $GLOBALS['a_sTrace'] = '残業あり<br>';
                            //残業あり
                            if ($h_divid != ''){
                                if (ctype_digit($h_divid) == TRUE){
                                    $h_over_time_actualy = $a_diff;
                                    $h_charge_over = (floor($a_diff / intval($h_divid)) * intval($a_overtime));
                                    $a_charge_total = intval($a_unit) + $h_charge_over;
                                    $a_message = '';
                                }
                            }
                        }else{
                            $GLOBALS['a_sTrace'] = '普通<br>';
                            $a_charge_total = intval($a_unit);
                            $a_message = '';
                        }
                    }
                }
            }
            
        }
        
        $GLOBALS['a_sTrace'] = '作業金額合計：'.$a_charge_total.'<br>';
        $h_charge = $a_charge_total;
        
    } catch (Exception $e) {
        echo 'Error:'.$e->getMessage();
    }    
}

?>
