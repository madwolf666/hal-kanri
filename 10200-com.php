<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$cr_id = "";

$payment_contract_form = "";
$engineer_name = "";
$payment_settlement_closingday = "";
$payment_settlement_paymentday = "";

$payment_normal_calculation_1 = "";
$payment_normal_unit_price_1 = "";
$payment_normal_overtime_unit_price_1 = "";
$payment_normal_deduction_unit_price_1 = "";
$payment_normal_upper_limit_1 = "";
$payment_normal_lower_limit_1 = "";

$payment_middle_unit_price_1 = "";
$payment_middle_overtime_unit_price_1 = "";
$payment_middle_deduction_unit_price_1 = "";
$payment_middle_upper_limit_1 = "";
$payment_middle_lower_limit_1 = "";

$payment_leaving_unit_price_1 = "";
$payment_leaving_overtime_unit_price_1 = "";
$payment_leaving_deduction_unit_price_1 = "";
$payment_leaving_upper_limit_1 = "";
$payment_leaving_lower_limit_1 = "";

$redemption_ratio = "";

$employ_num = "";
$employ_form = "";
$employ_no = "";
$date_entering = "";
$date_retire = "";
$yayoi_group = "";
$date_modify_salary = "";
$date_first_salary = "";
$status_employ_insurance = "";
$status_compensation_insurance = "";
$status_social_insurance = "";
$tax_municipal_tax = "";
$tax_dependents = "";
$tax_year_end_adjustment = "";
$labor_managerial_position = "";
$labor_contact_date = "";
$labor_yayoi_changed = "";
$labor_remarks = "";
$labor_question = "";
$labor_answer = "";
$labor_employ_no = "";
$health_insurance_standard_remuneration = "";
$thickness_year_standard_remuneration = "";
//$redemption_ratio = "";

function set_10200_fromDB($a_result)
{
    $GLOBALS['cr_id'] = $a_result['cr_id'];
    
    $GLOBALS['payment_contract_form'] = $a_result['payment_contract_form'];
    $GLOBALS['engineer_name'] = $a_result['engineer_name'];
    $GLOBALS['payment_settlement_closingday'] = $a_result['payment_settlement_closingday'];
    $GLOBALS['payment_settlement_paymentday'] = $a_result['payment_settlement_paymentday'];
    
    $GLOBALS['payment_normal_calculation_1'] = $a_result['payment_normal_calculation_1'];
    $GLOBALS['payment_normal_unit_price_1'] = com_db_number_format_symbol($a_result['payment_normal_unit_price_1']);
    $GLOBALS['payment_normal_overtime_unit_price_1'] = com_db_number_format_symbol($a_result['payment_normal_overtime_unit_price_1']);
    $GLOBALS['payment_normal_deduction_unit_price_1'] = com_db_number_format_symbol($a_result['payment_normal_deduction_unit_price_1']);
    $GLOBALS['payment_normal_upper_limit_1'] = $a_result['payment_normal_upper_limit_1'];
    $GLOBALS['payment_normal_lower_limit_1'] = $a_result['payment_normal_lower_limit_1'];
    
    $GLOBALS['payment_middle_unit_price_1'] = com_db_number_format_symbol($a_result['payment_middle_unit_price_1']);
    $GLOBALS['payment_middle_overtime_unit_price_1'] = com_db_number_format_symbol($a_result['payment_middle_overtime_unit_price_1']);
    $GLOBALS['payment_middle_deduction_unit_price_1'] = com_db_number_format_symbol($a_result['payment_middle_deduction_unit_price_1']);
    $GLOBALS['payment_middle_upper_limit_1'] = $a_result['payment_middle_upper_limit_1'];
    $GLOBALS['payment_middle_lower_limit_1'] = $a_result['payment_middle_lower_limit_1'];

    $GLOBALS['payment_leaving_unit_price_1'] = com_db_number_format_symbol($a_result['payment_leaving_unit_price_1']);
    $GLOBALS['payment_leaving_overtime_unit_price_1'] = com_db_number_format_symbol($a_result['payment_leaving_overtime_unit_price_1']);
    $GLOBALS['payment_leaving_deduction_unit_price_1'] = com_db_number_format_symbol($a_result['payment_leaving_deduction_unit_price_1']);
    $GLOBALS['payment_leaving_upper_limit_1'] = $a_result['payment_leaving_upper_limit_1'];
    $GLOBALS['payment_leaving_lower_limit_1'] = $a_result['payment_leaving_lower_limit_1'];

    $GLOBALS['redemption_ratio'] = $a_result['redemption_ratio'];

    $GLOBALS['employ_num'] = $a_result['employ_num'];
    $GLOBALS['employ_form'] = $a_result['employ_form'];
    $GLOBALS['employ_no'] = $a_result['employ_no'];
    $GLOBALS['date_entering'] = $a_result['date_entering'];
    $GLOBALS['date_retire'] = $a_result['date_retire'];
    $GLOBALS['yayoi_group'] = $a_result['yayoi_group'];
    $GLOBALS['date_modify_salary'] = $a_result['date_modify_salary'];
    $GLOBALS['date_first_salary'] = $a_result['date_first_salary'];
    $GLOBALS['status_employ_insurance'] = $a_result['status_employ_insurance'];
    $GLOBALS['status_compensation_insurance'] = $a_result['status_compensation_insurance'];
    $GLOBALS['status_social_insurance'] = $a_result['status_social_insurance'];
    $GLOBALS['tax_municipal_tax'] = $a_result['tax_municipal_tax'];
    $GLOBALS['tax_dependents'] = $a_result['tax_dependents'];
    $GLOBALS['tax_year_end_adjustment'] = $a_result['tax_year_end_adjustment'];
    $GLOBALS['labor_managerial_position'] = $a_result['labor_managerial_position'];
    $GLOBALS['labor_contact_date'] = $a_result['labor_contact_date'];
    $GLOBALS['labor_yayoi_changed'] = $a_result['labor_yayoi_changed'];
    $GLOBALS['labor_remarks'] = $a_result['labor_remarks'];
    $GLOBALS['labor_question'] = $a_result['labor_question'];
    $GLOBALS['labor_answer'] = $a_result['labor_answer'];
    $GLOBALS['labor_employ_no'] = $a_result['labor_employ_no'];
    $GLOBALS['health_insurance_standard_remuneration'] = $a_result['health_insurance_standard_remuneration'];
    $GLOBALS['thickness_year_standard_remuneration'] = $a_result['thickness_year_standard_remuneration'];
    //$GLOBALS['redemption_ratio'] = $a_result['redemption_ratio'];

}

?>
