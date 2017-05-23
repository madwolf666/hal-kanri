<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$cr_id = "";
$po_no = "";
$contract_number = "";
$publication = "";
$engineer_number = "";
$engineer_name = "";
$engneer_name_phonetic = "";

$customer_name = "";
$business_name = "";
$business_name_phonetic = "";
$claim_agreement_start = "";
$claim_agreement_end = "";

$claim_normal_calculation = "";
$claim_normal__unit_price = "";
$claim_normal_lower_limit = "";
$claim_normal_upper_limit = "";
$claim_normal_deduction_unit_price = "";
$claim_normal_overtime_unit_price = "";

$claim_middle_calculation = "";
$claim_middle_unit_price = "";
$claim_middle_lower_limit = "";
$claim_middle_upper_limit = "";
$claim_middle_deduction_unit_price = "";
$claim_middle_overtime_unit_price = "";

$claim_leaving_calculation = "";
$claim_leaving_unit_price = "";
$claim_leaving_lower_limit = "";
$claim_leaving_upper_limit = "";
$claim_leaving_deduction_unit_price = "";
$claim_leaving_overtime_unit_price = "";

$claim_hourly_daily = "";
$claim_hourly_monthly = "";
$claim_settlement_closingday = "";
$claim_settlement_paymentday = "";
$remarks = "";
$claim_contract_form = "";

$payment_absence_deduction_subject = "";

$remarks1 = "";
$remarks2 = "";
$remarks3 = "";
$remarks4 = "";
$inheriting = "";
$sending_back = "";

function set_10400_fromDB($a_result)
{
    $GLOBALS['cr_id'] = $a_result['cr_id'];
    $GLOBALS['po_no'] = $a_result['po_no'];
    $GLOBALS['contract_number'] = $a_result['contract_number'];
    $GLOBALS['publication'] = com_replace_toDate($a_result['publication']);
    $GLOBALS['engineer_number'] = $a_result['engineer_number'];
    $GLOBALS['engineer_name'] = $a_result['engineer_name'];
    $GLOBALS['engneer_name_phonetic'] = $a_result['engneer_name_phonetic'];

    $GLOBALS['customer_name'] = $a_result['customer_name'];
    $GLOBALS['business_name'] = $a_result['business_name'];
    $GLOBALS['business_name_phonetic'] = $a_result['business_name_phonetic'];
    $GLOBALS['claim_agreement_start'] = str_replace("-", "/", $a_result['claim_agreement_start']);
    $GLOBALS['claim_agreement_end'] = str_replace("-", "/", $a_result['claim_agreement_end']);

    $GLOBALS['claim_normal_calculation'] = $a_result['claim_normal_calculation'];
    $GLOBALS['claim_normal__unit_price'] = com_replace_toNumber($a_result['claim_normal__unit_price']);
    $GLOBALS['claim_normal_lower_limit'] = $a_result['claim_normal_lower_limit'];
    $GLOBALS['claim_normal_upper_limit'] = $a_result['claim_normal_upper_limit'];
    $GLOBALS['claim_normal_deduction_unit_price'] = com_replace_toNumber($a_result['claim_normal_deduction_unit_price']);
    $GLOBALS['claim_normal_overtime_unit_price'] = com_replace_toNumber($a_result['claim_normal_overtime_unit_price']);

    $GLOBALS['claim_middle_calculation'] = $a_result['claim_middle_calculation'];
    $GLOBALS['claim_middle_unit_price'] = com_replace_toNumber($a_result['claim_middle_unit_price']);
    $GLOBALS['claim_middle_lower_limit'] = $a_result['claim_middle_lower_limit'];
    $GLOBALS['claim_middle_upper_limit'] = $a_result['claim_middle_upper_limit'];
    $GLOBALS['claim_middle_deduction_unit_price'] = com_replace_toNumber($a_result['claim_middle_deduction_unit_price']);
    $GLOBALS['claim_middle_overtime_unit_price'] = com_replace_toNumber($a_result['claim_middle_overtime_unit_price']);

    $GLOBALS['claim_leaving_calculation'] = $a_result['claim_leaving_calculation'];
    $GLOBALS['claim_leaving_unit_price'] = com_replace_toNumber($a_result['claim_leaving_unit_price']);
    $GLOBALS['claim_leaving_lower_limit'] = $a_result['claim_leaving_lower_limit'];
    $GLOBALS['claim_leaving_upper_limit'] = $a_result['claim_leaving_upper_limit'];
    $GLOBALS['claim_leaving_deduction_unit_price'] = com_replace_toNumber($a_result['claim_leaving_deduction_unit_price']);
    $GLOBALS['claim_leaving_overtime_unit_price'] = com_replace_toNumber($a_result['claim_leaving_overtime_unit_price']);

    $GLOBALS['claim_hourly_daily'] = $a_result['claim_hourly_daily'];
    $GLOBALS['claim_hourly_monthly'] = $a_result['claim_hourly_monthly'];
    $GLOBALS['claim_settlement_closingday'] = $a_result['claim_settlement_closingday'];
    $GLOBALS['claim_settlement_paymentday'] = $a_result['claim_settlement_paymentday'];
    $GLOBALS['remarks'] = $a_result['remarks'];
    $GLOBALS['claim_contract_form'] = $a_result['claim_contract_form'];
    
    $GLOBALS['payment_absence_deduction_subject'] = $a_result['payment_absence_deduction_subject'];
    
    $GLOBALS['remarks1'] = $a_result['remarks1'];
    $GLOBALS['remarks2'] = $a_result['remarks2'];
    $GLOBALS['remarks3'] = $a_result['remarks3'];
    $GLOBALS['remarks4'] = $a_result['remarks4'];
    $GLOBALS['inheriting'] = $a_result['inheriting'];
    $GLOBALS['sending_back'] = $a_result['sending_back'];
}

?>
