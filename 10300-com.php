<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

#Session
$f_contract_number_10300 = "";
$f_engineer_number_10300 = "";
$f_engineer_name_10300 = "";
$f_customer_name_10300 = "";
$f_claim_contract_form_10300 = "";
$f_ag_no_10300 = "";
$f_accounts_bai_previous_day_10300 = "";
$f_accounts_actual_working_hours_10300 = "";
$f_accounts_expenses_10300 = "";
$f_payment_contract_form_10300 = "";
$f_payment_acceptance_date_10300 = "";
$f_payment_settlement_paymentday_10300 = "";
if (isset($_SESSION['f_contract_number_10300'])){
    $f_contract_number_10300 = $_SESSION['f_contract_number_10300'];
}
if (isset($_SESSION['f_engineer_number_10300'])){
    $f_engineer_number_10300 = $_SESSION['f_engineer_number_10300'];
}
if (isset($_SESSION['f_engineer_name_10300'])){
    $f_engineer_name_10300 = $_SESSION['f_engineer_name_10300'];
}
if (isset($_SESSION['f_customer_name_10300'])){
    $f_customer_name_10300 = $_SESSION['f_customer_name_10300'];
}
if (isset($_SESSION['f_claim_contract_form_10300'])){
    $f_claim_contract_form_10300 = $_SESSION['f_claim_contract_form_10300'];
}
if (isset($_SESSION['f_ag_no_10300'])){
    $f_ag_no_10300 = $_SESSION['f_ag_no_10300'];
}
if (isset($_SESSION['f_accounts_bai_previous_day_10300'])){
    $f_accounts_bai_previous_day_10300 = $_SESSION['f_accounts_bai_previous_day_10300'];
}
if (isset($_SESSION['f_accounts_actual_working_hours_10300'])){
    $f_accounts_actual_working_hours_10300 = $_SESSION['f_accounts_actual_working_hours_10300'];
}
if (isset($_SESSION['f_accounts_expenses_10300'])){
    $f_accounts_expenses_10300 = $_SESSION['f_accounts_expenses_10300'];
}
if (isset($_SESSION['f_payment_contract_form_10300'])){
    $f_payment_contract_form_10300 = $_SESSION['f_payment_contract_form_10300'];
}
if (isset($_SESSION['f_payment_acceptance_date_10300'])){
    $f_payment_acceptance_date_10300 = $_SESSION['f_payment_acceptance_date_10300'];
}
if (isset($_SESSION['f_payment_settlement_paymentday_10300'])){
    $f_payment_settlement_paymentday_10300 = $_SESSION['f_payment_settlement_paymentday_10300'];
}

$cr_id = "";

$contract_number = "";
$engineer_number = "";
$engneer_name_phonetic = "";
$engineer_name = "";
$customer_name = "";
$claim_contract_form = "";
$subject = "";
$claim_agreement_start = "";
$claim_agreement_end = "";

$payment_contract_form = "";
$social_insurance = "";
$payment_absence_deduction_subject = "";

$payment_settlement_paymentday = "";

$al_id = "";
$accounts_estimate_no = "";
$accounts_contract_purchase_no = "";
$accounts_bai_previous_day = "";
$accounts_sales_will_amount = "";
$accounts_working_hours_manage = "";
$accounts_actual_working_hours = "";
$accounts_actual_amount_money = "";
$accounts_expenses = "";
$accounts_tax_meter_noinclude = "";
$accounts_tax_meter_include = "";
$accounts_invoicing = "";
$ordering_purchase_no = "";
$payment_acceptance_date = "";
$payment_schedule_amount = "";
$payment_actual_working_hours = "";
$payment_actual_amount_money = "";
$payment_commuting_expenses = "";
$payment_tax_meter_noinclude = "";
$payment_tax_meter_include = "";
$payment_bill_acceptance = "";
$payment_expenses = "";
$payment_else = "";
$payment_pre_paid = "";
$payment_advance = "";
$payment_commission = "";
$payment_total = "";
$payment_plan_month_after_next_1 = "";
$payment_plan_next_month_15 = "";
$payment_plan_month_after_next_15 = "";
$payment_plan_else = "";
$payment_payroll_schedule = "";
$payment_transfer_processing_amount1 = "";
$payment_transfer_processing_amount2 = "";
$payment_difference = "";
$payment_actual_working_hours_difference = "";
$payment_gross_profit = "";
$payment_gross_profit_margin = "";

$ag_no = "";

function set_10300_fromDB($a_result)
{
    $GLOBALS['cr_id'] = $a_result['cr_id'];

    $GLOBALS['contract_number'] = $a_result['contract_number'];
    $GLOBALS['engineer_number'] = $a_result['engineer_number'];
    $GLOBALS['engneer_name_phonetic'] = $a_result['engneer_name_phonetic'];
    $GLOBALS['engineer_name'] = $a_result['engineer_name'];
    $GLOBALS['customer_name'] = $a_result['customer_name'];
    $GLOBALS['claim_contract_form'] = $a_result['claim_contract_form'];
    $GLOBALS['subject'] = $a_result['subject'];
    $GLOBALS['claim_agreement_start'] = str_replace("-", "/", $a_result['claim_agreement_start']);
    $GLOBALS['claim_agreement_end'] = str_replace("-", "/", $a_result['claim_agreement_end']);

    $GLOBALS['payment_contract_form'] = $a_result['payment_contract_form'];
    $GLOBALS['social_insurance'] = $a_result['social_insurance'];
    $GLOBALS['payment_absence_deduction_subject'] = $a_result['payment_absence_deduction_subject'];
    
    $GLOBALS['payment_settlement_paymentday'] = $a_result['payment_settlement_paymentday'];

    $GLOBALS['al_id'] = $a_result['al_id'];
    if ($GLOBALS['al_id'] == ''){
        $GLOBALS['al_id'] = -1;
    }
    $GLOBALS['accounts_estimate_no'] = $a_result['accounts_estimate_no'];
    $GLOBALS['accounts_contract_purchase_no'] = $a_result['accounts_contract_purchase_no'];
    $GLOBALS['accounts_bai_previous_day'] = com_replace_toDate($a_result['accounts_bai_previous_day']);
    $GLOBALS['accounts_sales_will_amount'] = $a_result['accounts_sales_will_amount'];
    $GLOBALS['accounts_working_hours_manage'] = $a_result['accounts_working_hours_manage'];
    $GLOBALS['accounts_actual_working_hours'] = $a_result['accounts_actual_working_hours'];
    $GLOBALS['accounts_actual_amount_money'] = $a_result['accounts_actual_amount_money'];
    $GLOBALS['accounts_expenses'] = $a_result['accounts_expenses'];
    $GLOBALS['accounts_tax_meter_noinclude'] = $a_result['accounts_tax_meter_noinclude'];
    $GLOBALS['accounts_tax_meter_include'] = $a_result['accounts_tax_meter_include'];
    $GLOBALS['accounts_invoicing'] = $a_result['accounts_invoicing'];
    $GLOBALS['ordering_purchase_no'] = $a_result['ordering_purchase_no'];
    $GLOBALS['payment_acceptance_date'] = com_replace_toDate($a_result['payment_acceptance_date']);
    $GLOBALS['payment_schedule_amount'] = $a_result['payment_schedule_amount'];
    $GLOBALS['payment_actual_working_hours'] = $a_result['payment_actual_working_hours'];
    $GLOBALS['payment_actual_amount_money'] = $a_result['payment_actual_amount_money'];
    $GLOBALS['payment_commuting_expenses'] = $a_result['payment_commuting_expenses'];
    $GLOBALS['payment_tax_meter_noinclude'] = $a_result['payment_tax_meter_noinclude'];
    $GLOBALS['payment_tax_meter_include'] = $a_result['payment_tax_meter_include'];
    $GLOBALS['payment_bill_acceptance'] = $a_result['payment_bill_acceptance'];
    $GLOBALS['payment_expenses'] = $a_result['payment_expenses'];
    $GLOBALS['payment_else'] = $a_result['payment_else'];
    $GLOBALS['payment_pre_paid'] = $a_result['payment_pre_paid'];
    $GLOBALS['payment_advance'] = $a_result['payment_advance'];
    $GLOBALS['payment_commission'] = $a_result['payment_commission'];
    $GLOBALS['payment_total'] = $a_result['payment_total'];
    $GLOBALS['payment_plan_month_after_next_1'] = $a_result['payment_plan_month_after_next_1'];
    $GLOBALS['payment_plan_next_month_15'] = $a_result['payment_plan_next_month_15'];
    $GLOBALS['payment_plan_month_after_next_15'] = $a_result['payment_plan_month_after_next_15'];
    $GLOBALS['payment_plan_else'] = $a_result['payment_plan_else'];
    $GLOBALS['payment_payroll_schedule'] = $a_result['payment_payroll_schedule'];
    $GLOBALS['payment_transfer_processing_amount1'] = $a_result['payment_transfer_processing_amount1'];
    $GLOBALS['payment_transfer_processing_amount2'] = $a_result['payment_transfer_processing_amount2'];
    $GLOBALS['payment_difference'] = $a_result['payment_difference'];
    $GLOBALS['payment_actual_working_hours_difference'] = $a_result['payment_actual_working_hours_difference'];
    $GLOBALS['payment_gross_profit'] = $a_result['payment_gross_profit'];
    $GLOBALS['payment_gross_profit_margin'] = $a_result['payment_gross_profit_margin'];

    $GLOBALS['ag_no'] = $a_result['ag_no'];
}

?>
