<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

#Session
$f_contract_number_10400 = "";
$f_engineer_name_10400 = "";
if (isset($_SESSION['f_contract_number_10400'])){
    $f_contract_number_10400 = $_SESSION['f_contract_number_10400'];
}
if (isset($_SESSION['f_engineer_name_10400'])){
    $f_engineer_name_10400 = $_SESSION['f_engineer_name_10400'];
}

#Session(AND OR)
$f_engineer_name_10400_andor = "";
if (isset($_SESSION['f_engineer_name_10400_andor'])){
    $f_engineer_name_10400_andor = $_SESSION['f_engineer_name_10400_andor'];
}

#[2018.01.30]課題解決管理表No.87
#Session
$f_contract_number_10400_del = "";
$f_engineer_name_10400_del = "";
if (isset($_SESSION['f_contract_number_10400_del'])){
    $f_contract_number_10400_del = $_SESSION['f_contract_number_10400_del'];
}
if (isset($_SESSION['f_engineer_name_10400_del'])){
    $f_engineer_name_10400_del = $_SESSION['f_engineer_name_10400_del'];
}

#Session(AND OR)
$f_engineer_name_10400_andor_del = "";
if (isset($_SESSION['f_engineer_name_10400_andor_del'])){
    $f_engineer_name_10400_andor_del = $_SESSION['f_engineer_name_10400_andor_del'];
}

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

$payment_normal_calculation_1 = "";
$payment_normal_unit_price_1 = "";
$payment_normal_overtime_unit_price_1 = "";
$payment_normal_deduction_unit_price_1 = "";
$payment_normal_upper_limit_1 = "";
$payment_normal_lower_limit_1 = "";

$payment_middle_calculation_1 = "";
$payment_middle_unit_price_1 = "";
$payment_middle_overtime_unit_price_1 = "";
$payment_middle_deduction_unit_price_1 = "";
$payment_middle_upper_limit_1 = "";
$payment_middle_lower_limit_1 = "";

$payment_leaving_calculation_1 = "";
$payment_leaving_unit_price_1 = "";
$payment_leaving_overtime_unit_price_1 = "";
$payment_leaving_deduction_unit_price_1 = "";
$payment_leaving_upper_limit_1 = "";
$payment_leaving_lower_limit_1 = "";

$payment_hourly_daily = "";
$payment_hourly_monthly = "";
$payment_settlement_closingday = "";
$payment_settlement_paymentday = "";
$remarks = "";
$remarks_pay = "";
$claim_contract_form = "";

$payment_absence_deduction_subject = "";

$remarks1 = "";
$remarks2 = "";
$remarks3 = "";
$remarks4 = "";
$inheriting = "";
$sending_back = "";

$ag_no = "";

function set_10400_selectDB()
{
    #[2018.01.26]bug-fixed.
    $a_sql_src = "SELECT t1.*,";
    $a_sql_src .= "
 t2.po_no				
,t2.publication AS publication_purchase_order
,t2.remarks1			
,t2.remarks2 AS remarks2_purchase_order		
,t2.remarks3				
,t2.remarks4				
,t2.inheriting			
,t2.sending_back
,t3.ag_no
        ";

    #[2018.01.29]課題解決管理表No.87
    $a_sql_src .= " FROM (SELECT * FROM ".$GLOBALS['g_DB_t_contract_report']." WHERE ";
    if ($_SESSION['contract_del'] == 1){
        $a_sql_src .= "(del_flag='1')";
    }else{
        $a_sql_src .= "((del_flag IS NULL) OR (del_flag<>'1'))";
    }
    $a_sql_src .= ") t1";

    $a_sql_src .= " LEFT JOIN ";
    $a_sql_src .= $GLOBALS['g_DB_t_purchase_order_ledger']." t2";
    $a_sql_src .= " ON (t1.cr_id=t2.cr_id)";
    $a_sql_src .= " LEFT JOIN ";
    $a_sql_src .= $GLOBALS['g_DB_t_agreement_ledger']." t3";
    $a_sql_src .= " ON (t1.cr_id=t3.cr_id)";

    return $a_sql_src;
}

function set_10400_fromDB($a_result)
{
    $GLOBALS['cr_id'] = $a_result['cr_id'];
    $GLOBALS['po_no'] = $a_result['contract_number'];
    #$GLOBALS['po_no'] = $a_result['po_no'];
    $GLOBALS['contract_number'] = $a_result['contract_number'];
    $GLOBALS['publication'] = com_replace_toDate($a_result['publication_purchase_order']);
    $GLOBALS['engineer_number'] = $a_result['engineer_number'];
    $GLOBALS['engineer_name'] = $a_result['engineer_name'];
    $GLOBALS['engneer_name_phonetic'] = $a_result['engneer_name_phonetic'];

    $GLOBALS['customer_name'] = $a_result['customer_name'];
    $GLOBALS['business_name'] = $a_result['business_name'];
    $GLOBALS['business_name_phonetic'] = $a_result['business_name_phonetic'];
    $GLOBALS['claim_agreement_start'] = str_replace("-", "/", $a_result['claim_agreement_start']);
    $GLOBALS['claim_agreement_end'] = str_replace("-", "/", $a_result['claim_agreement_end']);

    $GLOBALS['payment_normal_calculation_1'] = $a_result['payment_normal_calculation_1'];
    $GLOBALS['payment_normal_unit_price_1'] = com_db_number_format_symbol($a_result['payment_normal_unit_price_1']);
    $GLOBALS['payment_normal_lower_limit_1'] = $a_result['payment_normal_lower_limit_1'];
    $GLOBALS['payment_normal_upper_limit_1'] = $a_result['payment_normal_upper_limit_1'];
    $GLOBALS['payment_normal_deduction_unit_price_1'] = com_db_number_format_symbol($a_result['payment_normal_deduction_unit_price_1']);
    $GLOBALS['payment_normal_overtime_unit_price_1'] = com_db_number_format_symbol($a_result['payment_normal_overtime_unit_price_1']);

    $GLOBALS['payment_middle_calculation_1'] = $a_result['payment_middle_calculation_1'];
    $GLOBALS['payment_middle_unit_price_1'] = com_db_number_format_symbol($a_result['payment_middle_unit_price_1']);
    $GLOBALS['payment_middle_lower_limit_1'] = $a_result['payment_middle_lower_limit_1'];
    $GLOBALS['payment_middle_upper_limit_1'] = $a_result['payment_middle_upper_limit_1'];
    $GLOBALS['payment_middle_deduction_unit_price_1'] = com_db_number_format_symbol($a_result['payment_middle_deduction_unit_price_1']);
    $GLOBALS['payment_middle_overtime_unit_price_1'] = com_db_number_format_symbol($a_result['payment_middle_overtime_unit_price_1']);

    $GLOBALS['payment_leaving_calculation_1'] = $a_result['payment_leaving_calculation_1'];
    $GLOBALS['payment_leaving_unit_price_1'] = com_db_number_format_symbol($a_result['payment_leaving_unit_price_1']);
    $GLOBALS['payment_leaving_lower_limit_1'] = $a_result['payment_leaving_lower_limit_1'];
    $GLOBALS['payment_leaving_upper_limit_1'] = $a_result['payment_leaving_upper_limit_1'];
    $GLOBALS['payment_leaving_deduction_unit_price_1'] = com_db_number_format_symbol($a_result['payment_leaving_deduction_unit_price_1']);
    $GLOBALS['payment_leaving_overtime_unit_price_1'] = com_db_number_format_symbol($a_result['payment_leaving_overtime_unit_price_1']);

    $GLOBALS['payment_hourly_daily'] = $a_result['payment_hourly_daily'];
    $GLOBALS['payment_hourly_monthly'] = $a_result['payment_hourly_monthly'];
    $GLOBALS['payment_settlement_closingday'] = $a_result['payment_settlement_closingday'];
    $GLOBALS['payment_settlement_paymentday'] = $a_result['payment_settlement_paymentday'];
    $GLOBALS['remarks'] = $a_result['remarks'];
    $GLOBALS['remarks_pay'] = $a_result['remarks_pay'];
    $GLOBALS['claim_contract_form'] = $a_result['claim_contract_form'];
    
    $GLOBALS['payment_absence_deduction_subject'] = $a_result['payment_absence_deduction_subject'];
    
    $GLOBALS['remarks1'] = $a_result['remarks1'];
    $GLOBALS['remarks2'] = $a_result['remarks2_purchase_order'];    #[2018.01.26]bug-fixed.
    $GLOBALS['remarks3'] = $a_result['remarks3'];
    $GLOBALS['remarks4'] = $a_result['remarks4'];
    $GLOBALS['inheriting'] = $a_result['inheriting'];
    $GLOBALS['sending_back'] = $a_result['sending_back'];
    
    $GLOBALS['ag_no'] = $a_result['contract_number'];
    #$GLOBALS['ag_no'] = $a_result['ag_no'];
}

?>
