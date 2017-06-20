<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

#Session
$f_payment_contract_form_10200 = "";
$f_engineer_name_10200 = "";
$f_date_entering_10200 = "";
$f_date_retire_10200 = "";
$f_payment_settlement_paymentday_10200 = "";
$f_date_modify_salary_10200 = "";
$f_date_first_salary_10200 = "";
$f_labor_contact_date_10200 = "";
$f_labor_yayoi_changed_10200 = "";
$f_labor_remarks_10200 = "";
if (isset($_SESSION['f_payment_contract_form_10200'])){
    $f_payment_contract_form_10200 = $_SESSION['f_payment_contract_form_10200'];
}
if (isset($_SESSION['f_engineer_name_10200'])){
    $f_engineer_name_10200 = $_SESSION['f_engineer_name_10200'];
}
if (isset($_SESSION['f_date_entering_10200'])){
    $f_date_entering_10200 = $_SESSION['f_date_entering_10200'];
}
if (isset($_SESSION['f_date_retire_10200'])){
    $f_date_retire_10200 = $_SESSION['f_date_retire_10200'];
}
if (isset($_SESSION['f_payment_settlement_paymentday_10200'])){
    $f_payment_settlement_paymentday_10200 = $_SESSION['f_payment_settlement_paymentday_10200'];
}
if (isset($_SESSION['f_date_modify_salary_10200'])){
    $f_date_modify_salary_10200 = $_SESSION['f_date_modify_salary_10200'];
}
if (isset($_SESSION['f_date_first_salary_10200'])){
    $f_date_first_salary_10200 = $_SESSION['f_date_first_salary_10200'];
}
if (isset($_SESSION['f_labor_contact_date_10200'])){
    $f_labor_contact_date_10200 = $_SESSION['f_labor_contact_date_10200'];
}
if (isset($_SESSION['f_labor_yayoi_changed_10200'])){
    $f_labor_yayoi_changed_10200 = $_SESSION['f_labor_yayoi_changed_10200'];
}
if (isset($_SESSION['f_labor_remarks_10200'])){
    $f_labor_remarks_10200 = $_SESSION['f_labor_remarks_10200'];
}

#Session(AND OR)
$f_engineer_name_10200_andor = "";
$f_date_entering_10200_andor = "";
$f_date_retire_10200_andor = "";
$f_payment_settlement_paymentday_10200_andor = "";
$f_date_modify_salary_10200_andor = "";
$f_date_first_salary_10200_andor = "";
$f_labor_contact_date_10200_andor = "";
$f_labor_yayoi_changed_10200_andor = "";
$f_labor_remarks_10200_andor = "";
if (isset($_SESSION['f_engineer_name_10200_andor'])){
    $f_engineer_name_10200_andor = $_SESSION['f_engineer_name_10200_andor'];
}
if (isset($_SESSION['f_date_entering_10200_andor'])){
    $f_date_entering_10200_andor = $_SESSION['f_date_entering_10200_andor'];
}
if (isset($_SESSION['f_date_retire_10200_andor'])){
    $f_date_retire_10200_andor = $_SESSION['f_date_retire_10200_andor'];
}
if (isset($_SESSION['f_payment_settlement_paymentday_10200_andor'])){
    $f_payment_settlement_paymentday_10200_andor = $_SESSION['f_payment_settlement_paymentday_10200_andor'];
}
if (isset($_SESSION['f_date_modify_salary_10200_andor'])){
    $f_date_modify_salary_10200_andor = $_SESSION['f_date_modify_salary_10200_andor'];
}
if (isset($_SESSION['f_date_first_salary_10200_andor'])){
    $f_date_first_salary_10200_andor = $_SESSION['f_date_first_salary_10200_andor'];
}
if (isset($_SESSION['f_labor_contact_date_10200_andor'])){
    $f_labor_contact_date_10200_andor = $_SESSION['f_labor_contact_date_10200_andor'];
}
if (isset($_SESSION['f_labor_yayoi_changed_10200_andor'])){
    $f_labor_yayoi_changed_10200_andor = $_SESSION['f_labor_yayoi_changed_10200_andor'];
}
if (isset($_SESSION['f_labor_remarks_10200_andor'])){
    $f_labor_remarks_10200_andor = $_SESSION['f_labor_remarks_10200_andor'];
}

$cr_id = "";

$payment_contract_form = "";
$engineer_name = "";
$payment_settlement_closingday = "";
$payment_settlement_paymentday = "";

$payment_normal_calculation_2 = "";
$payment_normal_unit_price_2 = "";
$payment_normal_overtime_unit_price_2 = "";
$payment_normal_deduction_unit_price_2 = "";
$payment_normal_upper_limit_2 = "";
$payment_normal_lower_limit_2 = "";

$payment_middle_unit_price_2 = "";
$payment_middle_overtime_unit_price_2 = "";
$payment_middle_deduction_unit_price_2 = "";
$payment_middle_upper_limit_2 = "";
$payment_middle_lower_limit_2 = "";

$payment_leaving_unit_price_2 = "";
$payment_leaving_overtime_unit_price_2 = "";
$payment_leaving_deduction_unit_price_2 = "";
$payment_leaving_upper_limit_2 = "";
$payment_leaving_lower_limit_2 = "";

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

function set_10200_selectDB()
{
    $a_sql_src = "SELECT t1.*,";
    $a_sql_src .= "
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
    $a_sql_src .= " FROM ".$GLOBALS['g_DB_t_contract_report']." t1";
    $a_sql_src .= " LEFT JOIN ";
    $a_sql_src .= $GLOBALS['g_DB_t_payroll']." t2";
    $a_sql_src .= " ON (t1.cr_id=t2.cr_id)";
    
    return $a_sql_src;
}

function set_10200_fromDB($a_result)
{
    $GLOBALS['cr_id'] = $a_result['cr_id'];
    
    $GLOBALS['payment_contract_form'] = $a_result['payment_contract_form'];
    $GLOBALS['engineer_name'] = $a_result['engineer_name'];
    $GLOBALS['payment_settlement_closingday'] = $a_result['payment_settlement_closingday'];
    $GLOBALS['payment_settlement_paymentday'] = $a_result['payment_settlement_paymentday'];
    
    $GLOBALS['payment_normal_calculation_2'] = $a_result['payment_normal_calculation_2'];
    $GLOBALS['payment_normal_unit_price_2'] = com_db_number_format_symbol($a_result['payment_normal_unit_price_2']);
    $GLOBALS['payment_normal_overtime_unit_price_2'] = com_db_number_format_symbol($a_result['payment_normal_overtime_unit_price_2']);
    $GLOBALS['payment_normal_deduction_unit_price_2'] = com_db_number_format_symbol($a_result['payment_normal_deduction_unit_price_2']);
    $GLOBALS['payment_normal_upper_limit_2'] = $a_result['payment_normal_upper_limit_2'];
    $GLOBALS['payment_normal_lower_limit_2'] = $a_result['payment_normal_lower_limit_2'];
    
    $GLOBALS['payment_middle_unit_price_2'] = com_db_number_format_symbol($a_result['payment_middle_unit_price_2']);
    $GLOBALS['payment_middle_overtime_unit_price_2'] = com_db_number_format_symbol($a_result['payment_middle_overtime_unit_price_2']);
    $GLOBALS['payment_middle_deduction_unit_price_2'] = com_db_number_format_symbol($a_result['payment_middle_deduction_unit_price_2']);
    $GLOBALS['payment_middle_upper_limit_2'] = $a_result['payment_middle_upper_limit_2'];
    $GLOBALS['payment_middle_lower_limit_2'] = $a_result['payment_middle_lower_limit_2'];

    $GLOBALS['payment_leaving_unit_price_2'] = com_db_number_format_symbol($a_result['payment_leaving_unit_price_2']);
    $GLOBALS['payment_leaving_overtime_unit_price_2'] = com_db_number_format_symbol($a_result['payment_leaving_overtime_unit_price_2']);
    $GLOBALS['payment_leaving_deduction_unit_price_2'] = com_db_number_format_symbol($a_result['payment_leaving_deduction_unit_price_2']);
    $GLOBALS['payment_leaving_upper_limit_2'] = $a_result['payment_leaving_upper_limit_2'];
    $GLOBALS['payment_leaving_lower_limit_2'] = $a_result['payment_leaving_lower_limit_2'];

    $GLOBALS['redemption_ratio'] = $a_result['redemption_ratio'];

    $GLOBALS['employ_num'] = $a_result['employ_num'];
    $GLOBALS['employ_form'] = $a_result['employ_form'];
    $GLOBALS['employ_no'] = $a_result['employ_no'];
    $GLOBALS['date_entering'] = com_replace_toDate($a_result['date_entering']);
    $GLOBALS['date_retire'] = com_replace_toDate($a_result['date_retire']);
    $GLOBALS['yayoi_group'] = $a_result['yayoi_group'];
    $GLOBALS['date_modify_salary'] = com_replace_toDate($a_result['date_modify_salary']);
    $GLOBALS['date_first_salary'] = com_replace_toDate($a_result['date_first_salary']);
    $GLOBALS['status_employ_insurance'] = $a_result['status_employ_insurance'];
    $GLOBALS['status_compensation_insurance'] = $a_result['status_compensation_insurance'];
    $GLOBALS['status_social_insurance'] = $a_result['status_social_insurance'];
    $GLOBALS['tax_municipal_tax'] = $a_result['tax_municipal_tax'];
    $GLOBALS['tax_dependents'] = $a_result['tax_dependents'];
    $GLOBALS['tax_year_end_adjustment'] = $a_result['tax_year_end_adjustment'];
    $GLOBALS['labor_managerial_position'] = $a_result['labor_managerial_position'];
    $GLOBALS['labor_contact_date'] = com_replace_toDate($a_result['labor_contact_date']);
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
