<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./global.php');
require_once($GLOBALS['g_EXCEL_LIB_PATH']."PHPExcel.php");
require_once($GLOBALS['g_EXCEL_LIB_PATH']."PHPExcel/IOFactory.php");

require_once('./10300-com.php');

//読み書きするファイルのパスを設定
$target_file = $GLOBALS['g_EXCEL_TEMPLATE_PATH'].$GLOBALS['g_EXCEL_CONTRACT_10300'];

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
 t2.al_id
,t2.accounts_estimate_no
,t2.accounts_contract_purchase_no
,t2.accounts_bai_previous_day
,t2.accounts_sales_will_amount
,t2.accounts_working_hours_manage
,t2.accounts_actual_working_hours
,t2.accounts_actual_amount_money
,t2.accounts_expenses
,t2.accounts_tax_meter_noinclude
,t2.accounts_tax_meter_include
,t2.accounts_invoicing
,t2.ordering_purchase_no
,t2.payment_acceptance_date
,t2.payment_schedule_amount
,t2.payment_actual_working_hours
,t2.payment_actual_amount_money
,t2.payment_commuting_expenses
,t2.payment_tax_meter_noinclude
,t2.payment_tax_meter_include
,t2.payment_bill_acceptance
,t2.payment_expenses
,t2.payment_else
,t2.payment_pre_paid
,t2.payment_advance
,t2.payment_commission
,t2.payment_total
,t2.payment_plan_month_after_next_1
,t2.payment_plan_next_month_15
,t2.payment_plan_month_after_next_15
,t2.payment_plan_else
,t2.payment_payroll_schedule
,t2.payment_transfer_processing_amount1
,t2.payment_transfer_processing_amount2
,t2.payment_difference
,t2.payment_actual_working_hours_difference
,t2.payment_gross_profit
,t2.payment_gross_profit_margin
,t3.ag_no
        ";
    $a_sql .= " FROM ".$GLOBALS['g_DB_t_contract_report']." t1";
    $a_sql .= " LEFT JOIN ";
    $a_sql .= $GLOBALS['g_DB_t_acceptance_ledger']." t2";
    $a_sql .= " ON (t1.cr_id=t2.cr_id)";
    $a_sql .= " LEFT JOIN ";
    $a_sql .= $GLOBALS['g_DB_t_agreement_ledger']." t3";
    $a_sql .= " ON (t1.cr_id=t3.cr_id)";
    $a_sql .= " ORDER BY t1.contract_number,t3.ag_no,t2.al_id;";

    $a_stmt = $a_conn->prepare($a_sql);
    $a_stmt->execute();

    //PHPExcelでは、rowは1始まり、colは0始まりのようである。
    $a_row = 8;
    while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){

        set_10300_fromDB($a_result);
        
        $obj_sheet->setCellValueByColumnAndRow(0, $a_row, $contract_number);
        $obj_sheet->setCellValueByColumnAndRow(1, $a_row, $engineer_number);
        $obj_sheet->setCellValueByColumnAndRow(2, $a_row, $engneer_name_phonetic);
        $obj_sheet->setCellValueByColumnAndRow(3, $a_row, $engineer_name);
        $obj_sheet->setCellValueByColumnAndRow(4, $a_row, $customer_name);
        $obj_sheet->setCellValueByColumnAndRow(5, $a_row, $claim_contract_form);
        $obj_sheet->setCellValueByColumnAndRow(6, $a_row, $subject);
        $obj_sheet->setCellValueByColumnAndRow(7, $a_row, $claim_agreement_start);
        $obj_sheet->setCellValueByColumnAndRow(8, $a_row, $claim_agreement_end);
        
        $obj_sheet->setCellValueByColumnAndRow(9, $a_row, $accounts_estimate_no);
        #$obj_sheet->setCellValueByColumnAndRow(10, $a_row, $accounts_contract_purchase_no);
        $obj_sheet->setCellValueByColumnAndRow(10, $a_row, $ag_no);
        
        $obj_sheet->setCellValueByColumnAndRow(11, $a_row, $accounts_bai_previous_day);
        $obj_sheet->setCellValueByColumnAndRow(12, $a_row, $accounts_sales_will_amount);
        $obj_sheet->setCellValueByColumnAndRow(13, $a_row, $accounts_working_hours_manage);
        $obj_sheet->setCellValueByColumnAndRow(14, $a_row, $accounts_actual_working_hours);
        $obj_sheet->setCellValueByColumnAndRow(15, $a_row, $accounts_actual_amount_money);
        $obj_sheet->setCellValueByColumnAndRow(16, $a_row, $accounts_expenses);
        $obj_sheet->setCellValueByColumnAndRow(17, $a_row, $accounts_tax_meter_noinclude);
        $obj_sheet->setCellValueByColumnAndRow(18, $a_row, $accounts_tax_meter_include);
        $obj_sheet->setCellValueByColumnAndRow(19, $a_row, $accounts_invoicing);
        
        $obj_sheet->setCellValueByColumnAndRow(20, $a_row, $business_name);
        $obj_sheet->setCellValueByColumnAndRow(21, $a_row, $business_name_phonetic);
        $obj_sheet->setCellValueByColumnAndRow(22, $a_row, $payment_contract_form);
        $obj_sheet->setCellValueByColumnAndRow(23, $a_row, $social_insurance);
        $obj_sheet->setCellValueByColumnAndRow(24, $a_row, $payment_absence_deduction_subject);
        $obj_sheet->setCellValueByColumnAndRow(25, $a_row, $claim_agreement_start);
        $obj_sheet->setCellValueByColumnAndRow(26, $a_row, $claim_agreement_end);
        
        $obj_sheet->setCellValueByColumnAndRow(27, $a_row, $ordering_purchase_no);
        $obj_sheet->setCellValueByColumnAndRow(28, $a_row, $payment_acceptance_date);
        $obj_sheet->setCellValueByColumnAndRow(29, $a_row, $payment_schedule_amount);
        $obj_sheet->setCellValueByColumnAndRow(30, $a_row, $payment_actual_working_hours);
        $obj_sheet->setCellValueByColumnAndRow(31, $a_row, $payment_actual_amount_money);
        $obj_sheet->setCellValueByColumnAndRow(32, $a_row, $payment_commuting_expenses);
        $obj_sheet->setCellValueByColumnAndRow(33, $a_row, $payment_tax_meter_noinclude);
        $obj_sheet->setCellValueByColumnAndRow(34, $a_row, $payment_tax_meter_include);
        $obj_sheet->setCellValueByColumnAndRow(35, $a_row, $payment_bill_acceptance);
        $obj_sheet->setCellValueByColumnAndRow(36, $a_row, $payment_expenses);
        $obj_sheet->setCellValueByColumnAndRow(37, $a_row, $payment_else);
        $obj_sheet->setCellValueByColumnAndRow(38, $a_row, $payment_pre_paid);
        $obj_sheet->setCellValueByColumnAndRow(39, $a_row, $payment_advance);
        $obj_sheet->setCellValueByColumnAndRow(40, $a_row, $payment_commission);
        $obj_sheet->setCellValueByColumnAndRow(41, $a_row, $payment_total);
        
        $obj_sheet->setCellValueByColumnAndRow(42, $a_row, $payment_settlement_paymentday);
        
        $obj_sheet->setCellValueByColumnAndRow(43, $a_row, $payment_plan_month_after_next_1);
        $obj_sheet->setCellValueByColumnAndRow(44, $a_row, $payment_plan_next_month_15);
        $obj_sheet->setCellValueByColumnAndRow(45, $a_row, $payment_plan_month_after_next_15);
        $obj_sheet->setCellValueByColumnAndRow(46, $a_row, $payment_plan_else);
        $obj_sheet->setCellValueByColumnAndRow(47, $a_row, $payment_payroll_schedule);
        $obj_sheet->setCellValueByColumnAndRow(48, $a_row, $payment_transfer_processing_amount1);
        $obj_sheet->setCellValueByColumnAndRow(49, $a_row, $payment_transfer_processing_amount2);
        $obj_sheet->setCellValueByColumnAndRow(50, $a_row, $payment_difference);
        $obj_sheet->setCellValueByColumnAndRow(51, $a_row, $payment_actual_working_hours_difference);
        $obj_sheet->setCellValueByColumnAndRow(52, $a_row, $payment_gross_profit);
        $obj_sheet->setCellValueByColumnAndRow(53, $a_row, $payment_gross_profit_margin);
        
        $a_row++;
    }
} catch (PDOException $e){
    echo 'Error:'.$e->getMessage();
    //die();
}

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment;filename='".$GLOBALS['g_EXCEL_CONTRACT_10300']."'");
header("Cache-Control: max-age=0");

$obj_writer = PHPExcel_IOFactory::createWriter($obj_book, 'Excel2007');
$obj_writer->save("php://output"); 

exit;

?>
