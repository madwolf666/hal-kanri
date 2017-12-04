<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./global.php');
require_once($GLOBALS['g_EXCEL_LIB_PATH']."PHPExcel.php");
require_once($GLOBALS['g_EXCEL_LIB_PATH']."PHPExcel/IOFactory.php");

if (!isset($_GET['ACT'])){
    $a_act = '';
}else{
    $a_act = $_GET['ACT'];
}

require_once('./10300-com.php');

$get_customer_name = $_GET['CN'];
$get_date = $_GET['DT'];

try{
    //DBからユーザ情報取得
    $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
    $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $a_sql_src = set_10300_selectDB();

    $a_sql = "SELECT s1.*";
    $a_sql .= ",s2.calc_day_start_bill,s2.calc_day_end_bill";
    $a_sql .= " FROM (".$a_sql_src.") s1 LEFT JOIN ";
    $a_sql .= $GLOBALS['g_DB_t_charge_calc']." s2";
    $a_sql .= " ON (s1.cr_id=s2.cr_id) AND (s1.accounts_bai_previous_day=s2.calc_day_end_bill)";
    #売上日が同じで客先が同じもの
    $a_sql .= " WHERE (s1.customer_name=:customer_name) AND (s1.accounts_bai_previous_day=:accounts_bai_previous_day);";

    $a_stmt = $a_conn->prepare($a_sql);
    $a_stmt->bindParam(':customer_name', $get_customer_name, PDO::PARAM_STR);
    com_pdo_bindValue($a_stmt, ':accounts_bai_previous_day', $get_date);
    $a_stmt->execute();

} catch (PDOException $e){
    echo 'Error:'.$e->getMessage();
    die();
}

//読み書きするファイルのパスを設定
$target_file = $GLOBALS['g_EXCEL_TEMPLATE_PATH'].$GLOBALS['g_EXCEL_CONTRACT_10301'];

//1. リーダーを作成して既存ファイルを読み込む
$obj_reader = PHPExcel_IOFactory::createReader('Excel2007');
$obj_book   = $obj_reader->load($target_file);

//2. ファイルを編集（先頭のシートのA1セルに文字列を書き込み）
$obj_sheet_tmp = $obj_book->getSheet(0);
$obj_sheet = NULL;

$a_row = 13;
$a_recNum = 5;
$a_page = 0;
$a_No = 0;  #項番
while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
    set_10300_fromDB($a_result);

    $a_No++;    #項番
    
    $calc_day_start_bill = str_replace("-", "/", $a_result['calc_day_start_bill']);
    $calc_day_end_bill = str_replace("-", "/", $a_result['calc_day_end_bill']);

    if ($a_recNum<5){
        
    }else{
        $a_recNum = 0;
        $a_row = 13;
        $a_page++;
        #シートのコピー
        $obj_sheet = $obj_sheet_tmp->copy();
        $obj_sheet->setTitle('請求書'.strval($a_page));
        $obj_book->addSheet($obj_sheet);
        
        #請求日⇒締日（売上日）とする。
        com_setValue_Date($accounts_bai_previous_day, $obj_sheet, "S2", 'yyyy年m月d日');
        #com_setValue_Date($accounts_bai_previous_day, $obj_sheet, "S2", '[$-ja-JP]ggge"年"m"月"d"日"');
        #客先名
        $obj_sheet->setCellValue("A5",$customer_name);
        #支払日の計算（J10）
        if ($accounts_bai_previous_day != ''){
            $a_split = explode("/", $accounts_bai_previous_day);
            $a_clac_day_pay = date("Y/m/d", strtotime($a_split[0]."/".$a_split[1]."/01 2 month"));
            $a_clac_day_pay = date("Y/m/d", strtotime($a_clac_day_pay." -1 day"));
            com_setValue_Date($a_clac_day_pay, $obj_sheet, "J10", 'yyyy年m月d日');
        }
    }

    #項番
    $obj_sheet->setCellValue("A".strval($a_row), strval($a_No));
    #件名
    $obj_sheet->setCellValue("B".strval($a_row), $subject);
    #エンジニアNo.
    $obj_sheet->setCellValue("C".strval($a_row + 1), $engineer_number);
    #注文書No.
    $obj_sheet->setCellValue("I".strval($a_row + 1), $accounts_contract_purchase_no);
    #作業期間（締開始日～締終了日）
    com_setValue_Date($calc_day_start_bill, $obj_sheet, "C".strval($a_row + 2), 'yyyy年m月d日');
    com_setValue_Date($calc_day_end_bill, $obj_sheet, "H".strval($a_row + 2), 'yyyy年m月d日');
    #作業時間
    $obj_sheet->setCellValue("F".strval($a_row + 3), com_db_number_format($accounts_actual_working_hours));
    
    #数量
    $obj_sheet->setCellValue("M".strval($a_row), "1");
    #単価
    $obj_sheet->setCellValue("Q".strval($a_row), $accounts_actual_amount_money);
    #$obj_sheet->setCellValue("Q".strval($a_row), com_db_number_format_symbol($accounts_sales_will_amount));
    #金額
    #$obj_sheet->setCellValue("T".strval($a_row), com_db_number_format_symbol($accounts_actual_amount_money));
    
    $a_recNum++;
    $a_row += 6;
}

#不要な部分を削除する
if ($obj_sheet != NULL){
    $a_row = 13;
    for ($a_cnt = $a_recNum; $a_cnt < 5; $a_cnt++){
        #A13
        $obj_sheet->setCellValue("A".strval($a_row + (6*$a_cnt)), "");
        #B14,G14,H14,L14
        $obj_sheet->setCellValue("B".strval($a_row + (6*$a_cnt) + 1), "");
        $obj_sheet->setCellValue("G".strval($a_row + (6*$a_cnt) + 1), "");
        $obj_sheet->setCellValue("H".strval($a_row + (6*$a_cnt) + 1), "");
        $obj_sheet->setCellValue("L".strval($a_row + (6*$a_cnt) + 1), "");
        #B15,G15,L15
        $obj_sheet->setCellValue("B".strval($a_row + (6*$a_cnt) + 2), "");
        $obj_sheet->setCellValue("G".strval($a_row + (6*$a_cnt) + 2), "");
        $obj_sheet->setCellValue("L".strval($a_row + (6*$a_cnt) + 2), "");
        #B16,I16
        $obj_sheet->setCellValue("B".strval($a_row + (6*$a_cnt) + 3), "");
        $obj_sheet->setCellValue("I".strval($a_row + (6*$a_cnt) + 3), "");
    }
}

#シートを非表示
$obj_sheet_tmp->setSheetState(PHPExcel_Worksheet::SHEETSTATE_HIDDEN);

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment;filename='".$GLOBALS['g_EXCEL_CONTRACT_10107']."'");
header("Cache-Control: max-age=0");

$obj_writer = PHPExcel_IOFactory::createWriter($obj_book, 'Excel2007');
$obj_writer->save("php://output"); 

exit;

?>
