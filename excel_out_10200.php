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

    $a_sql = set_10200_selectDB();

    $a_where = "";
    #$a_where = "((del_flag IS NULL) OR (del_flag<>'1'))";    #[2018.01.26]課題解決管理表No.87
    #$a_where = com_make_where_session(1, $a_where, 't1.engineer_number', 'f_engineer_number_10200', "", "");
    #[2018.01.30]課題解決管理表No.87
    if ($_SESSION['contract_del'] != 1){
        $a_where = com_make_where_session(3, $a_where, 'u1.payment_contract_form', 'f_payment_contract_form_10200', $GLOBALS['g_DB_m_contract_pay_form'], "");
        $a_where = com_make_where_session(1, $a_where, 'u1.engineer_name', 'f_engineer_name_10200', "", "f_engineer_name_10200_andor");
        $a_where = com_make_where_session(2, $a_where, 'u1.date_entering', 'f_date_entering_10200', "", "f_date_entering_10200_andor");
        $a_where = com_make_where_session(2, $a_where, 'u1.date_retire', 'f_date_retire_10200', "", "f_date_retire_10200_andor");
        $a_where = com_make_where_session(3, $a_where, 'u1.payment_settlement_paymentday', 'f_payment_settlement_paymentday_10200', $GLOBALS['g_DB_m_contract_pay_pay'], "f_payment_settlement_paymentday_10200_andor");
        $a_where = com_make_where_session(2, $a_where, 'u1.date_modify_salary', 'f_date_modify_salary_10200', "", "f_date_modify_salary_10200_andor");
        $a_where = com_make_where_session(2, $a_where, 'u1.date_first_salary', 'f_date_first_salary_10200', "", "f_date_first_salary_10200_andor");
        $a_where = com_make_where_session(2, $a_where, 'u1.labor_contact_date', 'f_labor_contact_date_10200', "", "f_labor_contact_date_10200_andor");
        $a_where = com_make_where_session(2, $a_where, 'u1.labor_yayoi_changed', 'f_labor_yayoi_changed_10200', "", "f_labor_yayoi_changed_10200_andor");
        $a_where = com_make_where_session(1, $a_where, 'u1.labor_remarks', 'f_labor_remarks_10200', "", "f_labor_remarks_10200_andor");
    }else{
        $a_where = com_make_where_session(3, $a_where, 'u1.payment_contract_form', 'f_payment_contract_form_10200_del', $GLOBALS['g_DB_m_contract_pay_form'], "");
        $a_where = com_make_where_session(1, $a_where, 'u1.engineer_name', 'f_engineer_name_10200_del', "", "f_engineer_name_10200_andor_del");
        $a_where = com_make_where_session(2, $a_where, 'u1.date_entering', 'f_date_entering_10200_del', "", "f_date_entering_10200_andor_del");
        $a_where = com_make_where_session(2, $a_where, 'u1.date_retire', 'f_date_retire_10200_del', "", "f_date_retire_10200_andor_del");
        $a_where = com_make_where_session(3, $a_where, 'u1.payment_settlement_paymentday', 'f_payment_settlement_paymentday_10200_del', $GLOBALS['g_DB_m_contract_pay_pay'], "f_payment_settlement_paymentday_10200_andor_del");
        $a_where = com_make_where_session(2, $a_where, 'u1.date_modify_salary', 'f_date_modify_salary_10200_del', "", "f_date_modify_salary_10200_andor_del");
        $a_where = com_make_where_session(2, $a_where, 'u1.date_first_salary', 'f_date_first_salary_10200_del', "", "f_date_first_salary_10200_andor_del");
        $a_where = com_make_where_session(2, $a_where, 'u1.labor_contact_date', 'f_labor_contact_date_10200_del', "", "f_labor_contact_date_10200_andor_del");
        $a_where = com_make_where_session(2, $a_where, 'u1.labor_yayoi_changed', 'f_labor_yayoi_changed_10200_del', "", "f_labor_yayoi_changed_10200_andor_del");
        $a_where = com_make_where_session(1, $a_where, 'u1.labor_remarks', 'f_labor_remarks_10200_del', "", "f_labor_remarks_10200_andor_del");
    }
    if ($a_where != ""){
        #[2018.01.30]課題解決管理表No.87⇒既にWHERE句あり
        $a_where = " AND ".$a_where;
        #$a_where = " WHERE ".$a_where;
    }
    
    $a_sql .= $a_where;

    #[2017.07.20]課題解決表No.72
    $a_sql .= " ORDER BY u1.engineer_number,u1.cr_id,u1.pr_id";

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
