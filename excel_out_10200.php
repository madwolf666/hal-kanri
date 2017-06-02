<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./global.php');
require_once($GLOBALS['g_EXCEL_LIB_PATH']."PHPExcel.php");
require_once($GLOBALS['g_EXCEL_LIB_PATH']."PHPExcel/IOFactory.php");

require_once('./10200-com.php');

//読み書きするファイルのパスを設定
$target_file = $GLOBALS['g_EXCEL_TEMPLATE_PATH'].$GLOBALS['g_EXCEL_CONTRACT_10200'];

//1. リーダーを作成して既存ファイルを読み込む
$obj_reader = PHPExcel_IOFactory::createReader('Excel2007');
$obj_book   = $obj_reader->load($target_file);

//2. ファイルを編集（先頭のシートのA1セルに文字列を書き込み）
$obj_sheet = $obj_book->getSheet(0);

try{
    //DBからユーザ情報取得
    $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
    $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //一覧出力は何順？
    $a_sql = "SELECT t1.*,";
    $a_sql .= "
 t2.employ_num
,t2.employ_form
,t2.employ_no
,t2.date_entering
,t2.date_retire
,t2.yayoi_group
,t2.date_modify_salary
,t2.date_first_salary
,t2.status_employ_insurance
,t2.status_compensation_insurance
,t2.status_social_insurance
,t2.tax_municipal_tax
,t2.tax_dependents
,t2.tax_year_end_adjustment
,t2.labor_managerial_position
,t2.labor_contact_date
,t2.labor_yayoi_changed
,t2.labor_remarks
,t2.labor_question
,t2.labor_answer
,t2.labor_employ_no
,t2.health_insurance_standard_remuneration
,t2.thickness_year_standard_remuneration
        ";
    $a_sql .= " FROM ".$GLOBALS['g_DB_t_contract_report']." t1";
    $a_sql .= " LEFT JOIN ";
    $a_sql .= $GLOBALS['g_DB_t_payroll']." t2";
    $a_sql .= " ON (t1.cr_id=t2.cr_id)";
    $a_sql .= " ORDER BY t2.employ_no;";

    $a_stmt = $a_conn->prepare($a_sql);
    $a_stmt->execute();

    //PHPExcelでは、rowは1始まり、colは0始まりのようである。
    $a_row = 4;
    while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){

        set_10200_fromDB($a_result);
        
        $obj_sheet->setCellValueByColumnAndRow(2, $a_row, $employ_num);
        $obj_sheet->setCellValueByColumnAndRow(3, $a_row, $payment_contract_form);
        
        $obj_sheet->setCellValueByColumnAndRow(4, $a_row, $engineer_name);
        
        $obj_sheet->setCellValueByColumnAndRow(5, $a_row, $employ_no);
        $obj_sheet->setCellValueByColumnAndRow(6, $a_row, $date_entering);
        $obj_sheet->setCellValueByColumnAndRow(7, $a_row, $date_retire);
        
        $obj_sheet->setCellValueByColumnAndRow(8, $a_row, $yayoi_group);
        $obj_sheet->setCellValueByColumnAndRow(9, $a_row, $payment_settlement_closingday);
        $obj_sheet->setCellValueByColumnAndRow(10, $a_row, $payment_settlement_paymentday);
        $obj_sheet->setCellValueByColumnAndRow(11, $a_row, $date_modify_salary );
        $obj_sheet->setCellValueByColumnAndRow(12, $a_row, $date_first_salary);
        $obj_sheet->setCellValueByColumnAndRow(13, $a_row, $payment_normal_calculation_2);
        
        $obj_sheet->setCellValueByColumnAndRow(15, $a_row, $payment_normal_unit_price_2);
        $obj_sheet->setCellValueByColumnAndRow(23, $a_row, $payment_normal_overtime_unit_price_2);
        $obj_sheet->setCellValueByColumnAndRow(24, $a_row, $payment_normal_deduction_unit_price_2);
        $obj_sheet->setCellValueByColumnAndRow(25, $a_row, $payment_normal_upper_limit_2);
        $obj_sheet->setCellValueByColumnAndRow(26, $a_row, $payment_normal_lower_limit_2);
        
        $obj_sheet->setCellValueByColumnAndRow(27, $a_row, $payment_middle_unit_price_2);
        $obj_sheet->setCellValueByColumnAndRow(28, $a_row, $payment_middle_overtime_unit_price_2);
        $obj_sheet->setCellValueByColumnAndRow(29, $a_row, $payment_middle_deduction_unit_price_2);
        $obj_sheet->setCellValueByColumnAndRow(30, $a_row, $payment_middle_upper_limit_2);
        $obj_sheet->setCellValueByColumnAndRow(31, $a_row, $payment_middle_lower_limit_2);
        
        $obj_sheet->setCellValueByColumnAndRow(32, $a_row, $payment_leaving_unit_price_2);
        $obj_sheet->setCellValueByColumnAndRow(33, $a_row, $payment_leaving_overtime_unit_price_2);
        $obj_sheet->setCellValueByColumnAndRow(34, $a_row, $payment_leaving_deduction_unit_price_2);
        $obj_sheet->setCellValueByColumnAndRow(35, $a_row, $payment_leaving_upper_limit_2);
        $obj_sheet->setCellValueByColumnAndRow(36, $a_row, $payment_leaving_lower_limit_2);
        
        $obj_sheet->setCellValueByColumnAndRow(37, $a_row, $status_employ_insurance);
        $obj_sheet->setCellValueByColumnAndRow(38, $a_row, $status_compensation_insurance);
        $obj_sheet->setCellValueByColumnAndRow(39, $a_row, $status_social_insurance);
        $obj_sheet->setCellValueByColumnAndRow(40, $a_row, $tax_municipal_tax);
        $obj_sheet->setCellValueByColumnAndRow(41, $a_row, $tax_dependents);
        $obj_sheet->setCellValueByColumnAndRow(42, $a_row, $tax_year_end_adjustment);
        
        $obj_sheet->setCellValueByColumnAndRow(43, $a_row, $labor_managerial_position);
        $obj_sheet->setCellValueByColumnAndRow(44, $a_row, $labor_contact_date);
        $obj_sheet->setCellValueByColumnAndRow(45, $a_row, $labor_yayoi_changed);
        $obj_sheet->setCellValueByColumnAndRow(46, $a_row, $labor_remarks);
        $obj_sheet->setCellValueByColumnAndRow(47, $a_row, $labor_question);
        $obj_sheet->setCellValueByColumnAndRow(48, $a_row, $labor_answer);
        $obj_sheet->setCellValueByColumnAndRow(49, $a_row, $labor_employ_no);
        $obj_sheet->setCellValueByColumnAndRow(50, $a_row, $health_insurance_standard_remuneration);
        $obj_sheet->setCellValueByColumnAndRow(51, $a_row, $thickness_year_standard_remuneration);

        $obj_sheet->setCellValueByColumnAndRow(52, $a_row, $redemption_ratio);
        
        $a_row++;
    }
} catch (PDOException $e){
    echo 'Error:'.$e->getMessage();
    //die();
}

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment;filename='".$GLOBALS['g_EXCEL_CONTRACT_10200']."'");
header("Cache-Control: max-age=0");

$obj_writer = PHPExcel_IOFactory::createWriter($obj_book, 'Excel2007');
$obj_writer->save("php://output"); 

exit;

?>
