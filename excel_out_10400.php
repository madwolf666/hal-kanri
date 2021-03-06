<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./global.php');
require_once($GLOBALS['g_EXCEL_LIB_PATH']."PHPExcel.php");
require_once($GLOBALS['g_EXCEL_LIB_PATH']."PHPExcel/IOFactory.php");
 
require_once('./10400-com.php');

//読み書きするファイルのパスを設定
$target_file = $GLOBALS['g_EXCEL_TEMPLATE_PATH'].$GLOBALS['g_EXCEL_CONTRACT_10400'];

//1. リーダーを作成して既存ファイルを読み込む
$obj_reader = PHPExcel_IOFactory::createReader('Excel2007');
$obj_book   = $obj_reader->load($target_file);

//2. ファイルを編集（先頭のシートのA1セルに文字列を書き込み）
$obj_sheet = $obj_book->getSheet(0);

try{
    //DBからユーザ情報取得
    $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
    $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $a_sql = set_10400_selectDB();

    $a_where = "";
    #$a_where = "((t1.del_flag IS NULL) OR (t1.del_flag<>'1'))";    #[2018.01.26]課題解決管理表No.87
    #$a_where = com_make_where_session(1, $a_where, 't1.engineer_number', 'f_engineer_number_10400', "", "");
    #[2018.01.30]課題解決管理表No.87
    if ($_SESSION['contract_del'] != 1){
        $a_where = com_make_where_session(3, $a_where, 't1.contract_number', 'f_contract_number_10400', "", "");
        $a_where = com_make_where_session(1, $a_where, 't1.engineer_name', 'f_engineer_name_10400', "", "f_engineer_name_10400_andor");
    }else{
        $a_where = com_make_where_session(3, $a_where, 't1.contract_number', 'f_contract_number_10400_del', "", "");
        $a_where = com_make_where_session(1, $a_where, 't1.engineer_name', 'f_engineer_name_10400_del', "", "f_engineer_name_10400_andor_del");
    }
    if ($a_where != ""){
        $a_where = " WHERE ".$a_where;
    }
    
    $a_sql .= $a_where;

    $a_sql .= " ORDER BY t3.ag_no;";

    $a_stmt = $a_conn->prepare($a_sql);
    $a_stmt->execute();

    //PHPExcelでは、rowは1始まり、colは0始まりのようである。
    $a_row = 5;
    while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){

        set_10400_fromDB($a_result);
        
        #$obj_sheet->setCellValueByColumnAndRow(0, $a_row, $po_no);
        $obj_sheet->setCellValueByColumnAndRow(0, $a_row, $ag_no);
        
        $obj_sheet->setCellValueByColumnAndRow(1, $a_row, $contract_number);
        
        $obj_sheet->setCellValueByColumnAndRow(2, $a_row, $publication);
        
        $obj_sheet->setCellValueByColumnAndRow(3, $a_row, $engineer_number);
        $obj_sheet->setCellValueByColumnAndRow(4, $a_row, $engineer_name);
        $obj_sheet->setCellValueByColumnAndRow(5, $a_row, $engneer_name_phonetic);
        $obj_sheet->setCellValueByColumnAndRow(6, $a_row, $customer_name);
        $obj_sheet->setCellValueByColumnAndRow(7, $a_row, $business_name);
        $obj_sheet->setCellValueByColumnAndRow(8, $a_row, $business_name_phonetic);
        $obj_sheet->setCellValueByColumnAndRow(9, $a_row, $claim_agreement_start);
        $obj_sheet->setCellValueByColumnAndRow(10, $a_row, $claim_agreement_end);
        
        $obj_sheet->setCellValueByColumnAndRow(11, $a_row, $payment_normal_calculation_1);
        $obj_sheet->setCellValueByColumnAndRow(12, $a_row, $payment_normal_unit_price_1);
        $obj_sheet->setCellValueByColumnAndRow(13, $a_row, $payment_normal_lower_limit_1);
        $obj_sheet->setCellValueByColumnAndRow(14, $a_row, $payment_normal_upper_limit_1);
        $obj_sheet->setCellValueByColumnAndRow(15, $a_row, $payment_normal_deduction_unit_price_1);
        $obj_sheet->setCellValueByColumnAndRow(16, $a_row, $payment_normal_overtime_unit_price_1);
        
        $obj_sheet->setCellValueByColumnAndRow(17, $a_row, $payment_middle_calculation_1);
        $obj_sheet->setCellValueByColumnAndRow(18, $a_row, $payment_middle_unit_price_1);
        $obj_sheet->setCellValueByColumnAndRow(19, $a_row, $payment_middle_lower_limit_1);
        $obj_sheet->setCellValueByColumnAndRow(20, $a_row, $payment_middle_upper_limit_1);
        $obj_sheet->setCellValueByColumnAndRow(21, $a_row, $payment_middle_deduction_unit_price_1);
        $obj_sheet->setCellValueByColumnAndRow(22, $a_row, $payment_middle_overtime_unit_price_1);
        
        $obj_sheet->setCellValueByColumnAndRow(23, $a_row, $payment_leaving_calculation_1);
        $obj_sheet->setCellValueByColumnAndRow(24, $a_row, $payment_leaving_unit_price_1);
        $obj_sheet->setCellValueByColumnAndRow(25, $a_row, $payment_leaving_lower_limit_1);
        $obj_sheet->setCellValueByColumnAndRow(26, $a_row, $payment_leaving_upper_limit_1);
        $obj_sheet->setCellValueByColumnAndRow(27, $a_row, $payment_leaving_deduction_unit_price_1);
        $obj_sheet->setCellValueByColumnAndRow(28, $a_row, $payment_leaving_overtime_unit_price_1);
        
        $obj_sheet->setCellValueByColumnAndRow(29, $a_row, $payment_hourly_daily);
        $obj_sheet->setCellValueByColumnAndRow(30, $a_row, $payment_hourly_monthly);
        
        $obj_sheet->setCellValueByColumnAndRow(31, $a_row, $payment_settlement_closingday);
        $obj_sheet->setCellValueByColumnAndRow(32, $a_row, $payment_settlement_paymentday);
        
        #$obj_sheet->setCellValueByColumnAndRow(33, $a_row, $payment_absence_deduction_subject);
        $obj_sheet->setCellValueByColumnAndRow(33, $a_row, $remarks_pay);
        $obj_sheet->setCellValueByColumnAndRow(34, $a_row, $claim_contract_form);
        
        $obj_sheet->setCellValueByColumnAndRow(35, $a_row, $remarks1);
        $obj_sheet->setCellValueByColumnAndRow(36, $a_row, $remarks2);
        $obj_sheet->setCellValueByColumnAndRow(37, $a_row, $remarks3);
        $obj_sheet->setCellValueByColumnAndRow(38, $a_row, $remarks4);
        $obj_sheet->setCellValueByColumnAndRow(39, $a_row, $inheriting);
        $obj_sheet->setCellValueByColumnAndRow(40, $a_row, $sending_back);
        
        $a_row++;
    }
} catch (PDOException $e){
    echo 'Error:'.$e->getMessage();
    //die();
}

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment;filename='".$GLOBALS['g_EXCEL_CONTRACT_10400']."'");
header("Cache-Control: max-age=0");

$obj_writer = PHPExcel_IOFactory::createWriter($obj_book, 'Excel2007');
$obj_writer->save("php://output"); 

exit;

?>
