<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$cr_id = "";
$ag_no = "";
$contract_number = "";
$publication = "";

$engineer_number = "";
$engineer_name = "";
$engneer_name_phonetic = "";

$customer_name = "";
$claim_contract_form = "";

$claim_agreement_start = "";
$claim_agreement_end = "";

$work_start = "";
$work_end = "";
$work_hours = "";
$break_start = "";
$break_end = "";
$break_hours = "";

$social_insurance = "";
$tax_withholding = "";

$payment_normal_calculation_2 = "";
$payment_normal_unit_price_2 = "";
$payment_normal_lower_limit_2 = "";
$payment_normal_upper_limit_2 = "";
$payment_normal_deduction_unit_price_2 = "";
$payment_normal_overtime_unit_price_2 = "";

$payment_middle_calculation_2 = "";
$payment_middle_unit_price_2 = "";
$payment_middle_lower_limit_2 = "";
$payment_middle_upper_limit_2 = "";
$payment_middle_deduction_unit_price_2 = "";
$payment_middle_overtime_unit_price_2 = "";

$payment_leaving_calculation_2 = "";
$payment_leaving_unit_price_2 = "";
$payment_leaving_lower_limit_2 = "";
$payment_leaving_upper_limit_2 = "";
$payment_leaving_deduction_unit_price_2 = "";
$payment_leaving_overtime_unit_price_2 = "";

$payment_hourly_daily = "";
$payment_hourly_monthly = "";
$payment_settlement_closingday = "";
$payment_settlement_paymentday = "";
$remarks = "";

$payment_settlement_closingday  = "";
$payment_settlement_paymentday = "";

$dd_office = "";
$dd_address = "";
$dd_tel = "";

$ip_position = "";
$ip_name = "";
$dm_responsible_position = "";
$dm_responsible_name = "";
$dd_responsible_position = "";
$dd_responsible_name = "";

$person_post_no = "";
$person_address = "";
$person_birthday = "";

//3カラムは何？

$contact_date_org = "";
$contact_date_brn = "";
$organization = "";
$conflict_prevention = "";
$thing1 = "";

$chs_position1 = "";
$chs_name1 = "";
$chs_position2 = "";
$chs_name2 = "";
$chs_tel2 = "";
$dd_responsible_tel = "";

$reserve1 = "";
$reserve2 = "";
$reserve3 = "";
$reserve4 = "";
$reserve5 = "";
$reserve6 = "";
$reserve7 = "";

$guide_ships = "";

function set_10500_fromDB($a_result)
{
    $GLOBALS['cr_id'] = $a_result['cr_id'];
    $GLOBALS['ag_no'] = $a_result['ag_no'];
    $GLOBALS['contract_number'] = $a_result['contract_number'];
    $GLOBALS['publication'] = $a_result['publication'];
    
    $GLOBALS['engineer_number'] = $a_result['engineer_number'];
    $GLOBALS['engineer_name'] = $a_result['engineer_name'];
    $GLOBALS['engneer_name_phonetic'] = $a_result['engneer_name_phonetic'];

    $GLOBALS['customer_name'] = $a_result['customer_name'];
    $GLOBALS['claim_contract_form'] = $a_result['claim_contract_form'];

    $GLOBALS['claim_agreement_start'] = str_replace("-", "/", $a_result['claim_agreement_start']);
    $GLOBALS['claim_agreement_end'] = str_replace("-", "/", $a_result['claim_agreement_end']);

    $GLOBALS['work_start'] = substr($a_result['work_start'], 0, 5);
    $GLOBALS['work_end'] = substr($a_result['work_end'], 0, 5);
    $GLOBALS['work_hours'] = substr($a_result['work_hours'], 0, 5);
    $GLOBALS['break_start'] = substr($a_result['break_start'], 0, 5);
    $GLOBALS['break_end'] = substr($a_result['break_end'], 0, 5);
    $GLOBALS['break_hours'] = substr($a_result['break_hours'], 0, 5);

    $GLOBALS['social_insurance'] = $a_result['social_insurance'];
    $GLOBALS['tax_withholding'] = $a_result['tax_withholding'];

    $GLOBALS['payment_normal_calculation_2'] = $a_result['payment_normal_calculation_2'];
    $GLOBALS['payment_normal_unit_price_2'] = com_db_number_format_symbol($a_result['payment_normal_unit_price_2']);
    $GLOBALS['payment_normal_lower_limit_2'] = $a_result['payment_normal_lower_limit_2'];
    $GLOBALS['payment_normal_upper_limit_2'] = $a_result['payment_normal_upper_limit_2'];
    $GLOBALS['payment_normal_deduction_unit_price_2'] = com_db_number_format_symbol($a_result['payment_normal_deduction_unit_price_2']);
    $GLOBALS['payment_normal_overtime_unit_price_2'] = com_db_number_format_symbol($a_result['payment_normal_overtime_unit_price_2']);

    $GLOBALS['payment_middle_calculation_2'] = $a_result['payment_middle_calculation_2'];
    $GLOBALS['payment_middle_unit_price_2'] = com_db_number_format_symbol($a_result['payment_middle_unit_price_2']);
    $GLOBALS['payment_middle_lower_limit_2'] = $a_result['payment_middle_lower_limit_2'];
    $GLOBALS['payment_middle_upper_limit_2'] = $a_result['payment_middle_upper_limit_2'];
    $GLOBALS['payment_middle_deduction_unit_price_2'] = com_db_number_format_symbol($a_result['payment_middle_deduction_unit_price_2']);
    $GLOBALS['payment_middle_overtime_unit_price_2'] = com_db_number_format_symbol($a_result['payment_middle_overtime_unit_price_2']);

    $GLOBALS['payment_leaving_calculation_2'] = $a_result['payment_leaving_calculation_2'];
    $GLOBALS['payment_leaving_unit_price_2'] = com_db_number_format_symbol($a_result['payment_leaving_unit_price_2']);
    $GLOBALS['payment_leaving_lower_limit_2'] = $a_result['payment_leaving_lower_limit_2'];
    $GLOBALS['payment_leaving_upper_limit_2'] = $a_result['payment_leaving_upper_limit_2'];
    $GLOBALS['payment_leaving_deduction_unit_price_2'] = com_db_number_format_symbol($a_result['payment_leaving_deduction_unit_price_2']);
    $GLOBALS['payment_leaving_overtime_unit_price_2'] = com_db_number_format_symbol($a_result['payment_leaving_overtime_unit_price_2']);

    $GLOBALS['payment_hourly_daily'] = $a_result['payment_hourly_daily'];
    $GLOBALS['payment_hourly_monthly'] = $a_result['payment_hourly_monthly'];
    $GLOBALS['payment_settlement_closingday'] = $a_result['payment_settlement_closingday'];
    $GLOBALS['payment_settlement_paymentday'] = $a_result['payment_settlement_paymentday'];
    $GLOBALS['remarks'] = $a_result['remarks'];
    
    $GLOBALS['payment_settlement_closingday'] = $a_result['payment_settlement_closingday'];
    $GLOBALS['payment_settlement_paymentday'] = $a_result['payment_settlement_paymentday'];

    $GLOBALS['dd_office'] = $a_result['dd_office'];
    $GLOBALS['dd_address'] = $a_result['dd_address'];
    $GLOBALS['dd_tel'] = $a_result['dd_tel'];

    $GLOBALS['ip_position'] = $a_result['ip_position'];
    $GLOBALS['ip_name'] = $a_result['ip_name'];
    $GLOBALS['dm_responsible_position'] = $a_result['dm_responsible_position'];
    $GLOBALS['dm_responsible_name'] = $a_result['dm_responsible_name'];
    $GLOBALS['dd_responsible_position'] = $a_result['dd_responsible_position'];
    $GLOBALS['dd_responsible_name'] = $a_result['dd_responsible_name'];
    
    $GLOBALS['person_post_no'] = $a_result['person_post_no'];
    $GLOBALS['person_address'] = $a_result['person_address'];
    $GLOBALS['person_birthday'] = $a_result['person_birthday'];

    //3カラムは何？
    
    $GLOBALS['contact_date_org'] = $a_result['contact_date_org'];
    $GLOBALS['contact_date_brn'] = $a_result['contact_date_brn'];
    $GLOBALS['organization'] = $a_result['organization'];
    $GLOBALS['conflict_prevention'] = $a_result['conflict_prevention'];
    $GLOBALS['thing1'] = $a_result['thing1'];

    $GLOBALS['chs_position1'] = $a_result['chs_position1'];
    $GLOBALS['chs_name1'] = $a_result['chs_name1'];
    $GLOBALS['chs_position2'] = $a_result['chs_position2'];
    $GLOBALS['chs_name2'] = $a_result['chs_name2'];
    $GLOBALS['chs_tel2'] = $a_result['chs_tel2'];
    $GLOBALS['dd_responsible_tel'] = $a_result['dd_responsible_tel'];
    
    $GLOBALS['reserve1'] = $a_result['reserve1'];
    $GLOBALS['reserve2'] = $a_result['reserve2'];
    $GLOBALS['reserve3'] = $a_result['reserve3'];
    $GLOBALS['reserve4'] = $a_result['reserve4'];
    $GLOBALS['reserve5'] = $a_result['reserve5'];
    $GLOBALS['reserve6'] = $a_result['reserve6'];
    $GLOBALS['reserve7'] = $a_result['reserve7'];

    $GLOBALS['guide_ships'] = $a_result['guide_ships'];
}

?>
