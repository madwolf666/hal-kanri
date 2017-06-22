<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./global.php');
require_once($GLOBALS['g_EXCEL_LIB_PATH']."PHPExcel.php");
require_once($GLOBALS['g_EXCEL_LIB_PATH']."PHPExcel/IOFactory.php");

$a_sRet = "<font color='#0000ff'>アップロードが行われました！</font>";
//$a_sRet = $_FILES["file"]["tmp_name"];
//$dir = $_POST["dir"];
try {
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

        try{
            //DBからユーザ情報取得
            $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
            $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $a_trans_num = 0;             //トランザクション実行数
            $a_conn->beginTransaction();  //トランザクション開始

#echo $target_file.'<br>';exit;

            //1. リーダーを作成して既存ファイルを読み込む
            $obj_reader = PHPExcel_IOFactory::createReader('Excel2007');
            $obj_book   = $obj_reader->load($target_file);
            $obj_sheet = $obj_book->getSheetByName("個人住所録");

            //PHPExcelでは、rowは1始まり、colは0始まりのようである。
            $a_row = 3;
            $a_val = $obj_sheet->getCell("A".$a_row)->getValue();
            $a_nothin_num = 0;  //100回何もなかったら終了
            #while (($a_val != '') && ($a_nothin_num<=10)) {
            while ($a_nothin_num<=100) {
                if (substr($a_val, 0, 3) == 'HAL'){

                    $a_nothin_num = 0;

                    $a_sql = "INSERT INTO ".$GLOBALS['g_DB_m_covering_letter']." VALUES(";
                    for ($a_col= 0; $a_col < 10; $a_col++) {
                        if ($a_col > 0) {
                            $a_sql .= ",";
                        }
                        switch ($a_col) {
                            case 2:   //誕生日
                            case 9:   //退職日
                                //日付セル
                                $a_tmp = $obj_sheet->getCellByColumnAndRow($a_col,$a_row)->getCalculatedValue();
                                #echo '$a_tmp-->'.$a_tmp.'<br>';
                                if ($a_tmp != ''){
                                    $date_val = $obj_sheet->getCellByColumnAndRow($a_col,$a_row)->getFormattedValue();
                                    #echo '$date_val-->'.$date_val.'<br>';
                                    if (preg_match( '/^[0-9]{1,}[\-|\/][0-9]{1,}[\-|\/][0-9]{1,}$/', $date_val )) {
                                        //$date_val = "chappy";
                                        $date_val2 = str_replace("/", "-", $date_val);
                                        #echo '$date_val2-->'.$date_val2.'<br>';
                                        $split = explode("-", $date_val2);
                                        if (strlen($split[0]) <= 2){
                                            try{
                                                $date_val2 = DateTime::createFromFormat( 'm-d-Y', $date_val2 )->format( 'Y/m/d' );
                                                $date_val = $date_val2;
                                            }catch (Exception $e){
                                            }
                                        }
                                    }
                                    $a_sql .= "'".$date_val."'";
                                 }else{
                                    $a_sql .= "''";
                                 }
                                break;
                            default:
                                $a_tmp = $obj_sheet->getCellByColumnAndRow($a_col,$a_row)->getCalculatedValue();
                                #$a_tmp = $obj_sheet->getCellByColumnAndRow($a_col,$a_row)->getValue();
                                if ($a_col == 0){
                                    //スペースを削除
                                    $a_tmp = str_replace(" ", "", $a_tmp);
                                    //差分アップロードのサポート
                                    $a_sql_D = "DELETE FROM ".$GLOBALS['g_DB_m_covering_letter']." WHERE (entry_no='".$a_tmp."');";
                                    $a_stmt = $a_conn->prepare($a_sql_D);
                                    #$a_stmt->bindParam(':entry_no', "'".$a_tmp."'", PDO::PARAM_STR);
                                    $a_stmt->execute();
                                }
                                //住所に'がある場合がある。
                                $a_sql .= "'".str_replace("'", "''",$a_tmp)."'";
                                break;
                        }
                    }

                    $a_sql .= ");";
    #echo $a_sql.'<br>';
                    $a_stmt = $a_conn->prepare($a_sql);
                    $a_stmt->execute();
                    $a_trans_num++;
                    if ($a_trans_num == 10){
                        $a_conn->commit();    //コミット
                        $a_trans_num =0;
                        $a_conn->beginTransaction();  //トランザクション開始     
                    }
                }else{
                    $a_nothin_num++;
                }
                
                $a_row++;
                $a_val = $obj_sheet->getCell("A".$a_row)->getValue();
            }

            if ($a_row > 3){
                if ($a_trans_num > 0){
                    $a_conn->commit();    //コミット
                    $a_trans_num =0;
                }
            }else{
                $a_conn->rollBack();  //ロールバック
                $a_sRet = "登録データはありません。";
            }
        } catch (PDOException $e){
            if ($a_conn) {
                $a_conn->rollBack();  //ロールバック
            }
            $a_sRet = 'Error:'.$e->getMessage();
            //$a_sRet .= $a_sql;
        }
        $a_conn = null;
        
        unlink($target_file);   //ファイル削除
    }
} catch (Exception $e) {
    if ($a_conn) {
        $a_conn->rollBack();  //ロールバック
    }
    $a_sRet = 'Error:'.$e->getMessage();
}

echo $a_sRet;

?>
