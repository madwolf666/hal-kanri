<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

#Session
$f_engineer_number = "";
$f_engineer_name = "";
$f_contract_number = "";
$f_customer_name = "";
$f_claim_agreement_start = "";
$f_claim_agreement_end = "";
$f_claim_contract_form = "";
$f_claim_settlement_closingday = "";
$f_claim_settlement_paymentday = "";
$f_remarks = "";
#[2018.01.19]課題解決管理表No.93
$f_send_mail_date1 = "";
$f_send_mail_date2 = "";
$f_send_mail_date3 = "";
$f_send_mail_date4 = "";

if (isset($_SESSION['f_engineer_number'])){
    $f_engineer_number = $_SESSION['f_engineer_number'];
}
if (isset($_SESSION['f_engineer_name'])){
    $f_engineer_name = $_SESSION['f_engineer_name'];
}
if (isset($_SESSION['f_contract_number'])){
    $f_contract_number = $_SESSION['f_contract_number'];
}
if (isset($_SESSION['f_customer_name'])){
    $f_customer_name = $_SESSION['f_customer_name'];
}
if (isset($_SESSION['f_claim_agreement_start'])){
    $f_claim_agreement_start = $_SESSION['f_claim_agreement_start'];
}
if (isset($_SESSION['f_claim_agreement_end'])){
    $f_claim_agreement_end = $_SESSION['f_claim_agreement_end'];
}
if (isset($_SESSION['f_claim_contract_form'])){
    $f_claim_contract_form = $_SESSION['f_claim_contract_form'];
}
if (isset($_SESSION['f_claim_settlement_closingday'])){
    $f_claim_settlement_closingday = $_SESSION['f_claim_settlement_closingday'];
}
if (isset($_SESSION['f_claim_settlement_paymentday'])){
    $f_claim_settlement_paymentday = $_SESSION['f_claim_settlement_paymentday'];
}
if (isset($_SESSION['f_remarks'])){
    $f_remarks = $_SESSION['f_remarks'];
}
#[2018.01.19]課題解決管理表No.93
            #checkboxはcheckされないとPOSTされない！
if (isset($_SESSION['f_send_mail_date1'])){
    #echo 'session='.$_SESSION['f_send_mail_date1'];
    $f_send_mail_date1 = $_SESSION['f_send_mail_date1'];
}
if (isset($_SESSION['f_send_mail_date2'])){
    $f_send_mail_date2 = $_SESSION['f_send_mail_date2'];
}
if (isset($_SESSION['f_send_mail_date3'])){
    $f_send_mail_date3 = $_SESSION['f_send_mail_date3'];
}
if (isset($_SESSION['f_send_mail_date4'])){
    $f_send_mail_date4 = $_SESSION['f_send_mail_date4'];
}

#Session(AND OR)
$f_engineer_number_andor = "";
$f_contract_number_andor = "";
$f_customer_name_andor = "";
$f_claim_agreement_start_andor = "";
$f_claim_agreement_end_andor = "";
$f_claim_contract_form_andor = "";
$f_claim_settlement_closingday_andor = "";
$f_claim_settlement_paymentday_andor = "";
$f_remarks_andor = "";
#[2018.01.19]課題解決管理表No.93
$f_send_mail_date_andor = "";

if (isset($_SESSION['f_engineer_number_andor'])){
    $f_engineer_number_andor = $_SESSION['f_engineer_number_andor'];
}
if (isset($_SESSION['f_contract_number_andor'])){
    $f_contract_number_andor = $_SESSION['f_contract_number_andor'];
}
if (isset($_SESSION['f_customer_name_andor'])){
    $f_customer_name_andor = $_SESSION['f_customer_name_andor'];
}
if (isset($_SESSION['f_claim_agreement_start_andor'])){
    $f_claim_agreement_start_andor = $_SESSION['f_claim_agreement_start_andor'];
}
if (isset($_SESSION['f_claim_agreement_end_andor'])){
    $f_claim_agreement_end_andor = $_SESSION['f_claim_agreement_end_andor'];
}
if (isset($_SESSION['f_claim_contract_form_andor'])){
    $f_claim_contract_form_andor = $_SESSION['f_claim_contract_form_andor'];
}
if (isset($_SESSION['f_claim_settlement_closingday_andor'])){
    $f_claim_settlement_closingday_andor = $_SESSION['f_claim_settlement_closingday_andor'];
}
if (isset($_SESSION['f_claim_settlement_paymentday_andor'])){
    $f_claim_settlement_paymentday_andor = $_SESSION['f_claim_settlement_paymentday_andor'];
}
if (isset($_SESSION['f_remarks_andor'])){
    $f_remarks_andor = $_SESSION['f_remarks_andor'];
}
#[2018.01.19]課題解決管理表No.93
if (isset($_SESSION['f_send_mail_date_andor'])){
    $f_send_mail_date_andor = $_SESSION['f_send_mail_date_andor'];
}

#[2018.01.30]課題解決管理表No.87
#Session
$f_engineer_number_del = "";
$f_engineer_name_del = "";
$f_contract_number_del = "";
$f_customer_name_del = "";
$f_claim_agreement_start_del = "";
$f_claim_agreement_end_del = "";
$f_claim_contract_form_del = "";
$f_claim_settlement_closingday_del = "";
$f_claim_settlement_paymentday_del = "";
$f_remarks_del = "";
#[2018.01.19]課題解決管理表No.93
$f_send_mail_date1_del = "";
$f_send_mail_date2_del = "";
$f_send_mail_date3_del = "";
$f_send_mail_date4_del = "";

if (isset($_SESSION['f_engineer_number_del'])){
    $f_engineer_number_del = $_SESSION['f_engineer_number_del'];
}
if (isset($_SESSION['f_engineer_name_del'])){
    $f_engineer_name_del = $_SESSION['f_engineer_name_del'];
}
if (isset($_SESSION['f_contract_number_del'])){
    $f_contract_number_del = $_SESSION['f_contract_number_del'];
}
if (isset($_SESSION['f_customer_name_del'])){
    $f_customer_name_del = $_SESSION['f_customer_name_del'];
}
if (isset($_SESSION['f_claim_agreement_start_del'])){
    $f_claim_agreement_start_del = $_SESSION['f_claim_agreement_start_del'];
}
if (isset($_SESSION['f_claim_agreement_end_del'])){
    $f_claim_agreement_end_del = $_SESSION['f_claim_agreement_end_del'];
}
if (isset($_SESSION['f_claim_contract_form_del'])){
    $f_claim_contract_form_del = $_SESSION['f_claim_contract_form_del'];
}
if (isset($_SESSION['f_claim_settlement_closingday_del'])){
    $f_claim_settlement_closingday_del = $_SESSION['f_claim_settlement_closingday_del'];
}
if (isset($_SESSION['f_claim_settlement_paymentday_del'])){
    $f_claim_settlement_paymentday_del = $_SESSION['f_claim_settlement_paymentday_del'];
}
if (isset($_SESSION['f_remarks_del'])){
    $f_remarks_del = $_SESSION['f_remarks_del'];
}
#[2018.01.19]課題解決管理表No.93
#checkboxはcheckされないとPOSTされない！
if (isset($_SESSION['f_send_mail_date1_del'])){
    #echo 'session='.$_SESSION['f_send_mail_date1_del'];
    $f_send_mail_date1_del = $_SESSION['f_send_mail_date1_del'];
}
if (isset($_SESSION['f_send_mail_date2_del'])){
    $f_send_mail_date2_del = $_SESSION['f_send_mail_date2_del'];
}
if (isset($_SESSION['f_send_mail_date3_del'])){
    $f_send_mail_date3_del = $_SESSION['f_send_mail_date3_del'];
}
if (isset($_SESSION['f_send_mail_date4_del'])){
    $f_send_mail_date4_del = $_SESSION['f_send_mail_date4_del'];
}

#Session(AND OR)
$f_engineer_number_andor_del = "";
$f_contract_number_andor_del = "";
$f_customer_name_andor_del = "";
$f_claim_agreement_start_andor_del = "";
$f_claim_agreement_end_andor_del = "";
$f_claim_contract_form_andor_del = "";
$f_claim_settlement_closingday_andor_del = "";
$f_claim_settlement_paymentday_andor_del = "";
$f_remarks_andor_del = "";
#[2018.01.19]課題解決管理表No.93
$f_send_mail_date_andor_del = "";

if (isset($_SESSION['f_engineer_number_andor_del'])){
    $f_engineer_number_andor_del = $_SESSION['f_engineer_number_andor_del'];
}
if (isset($_SESSION['f_contract_number_andor_del'])){
    $f_contract_number_andor_del = $_SESSION['f_contract_number_andor_del'];
}
if (isset($_SESSION['f_customer_name_andor_del'])){
    $f_customer_name_andor_del = $_SESSION['f_customer_name_andor_del'];
}
if (isset($_SESSION['f_claim_agreement_start_andor_del'])){
    $f_claim_agreement_start_andor_del = $_SESSION['f_claim_agreement_start_andor_del'];
}
if (isset($_SESSION['f_claim_agreement_end_andor_del'])){
    $f_claim_agreement_end_andor_del = $_SESSION['f_claim_agreement_end_andor_del'];
}
if (isset($_SESSION['f_claim_contract_form_andor_del'])){
    $f_claim_contract_form_andor_del = $_SESSION['f_claim_contract_form_andor_del'];
}
if (isset($_SESSION['f_claim_settlement_closingday_andor_del'])){
    $f_claim_settlement_closingday_andor_del = $_SESSION['f_claim_settlement_closingday_andor_del'];
}
if (isset($_SESSION['f_claim_settlement_paymentday_andor_del'])){
    $f_claim_settlement_paymentday_andor_del = $_SESSION['f_claim_settlement_paymentday_andor_del'];
}
if (isset($_SESSION['f_remarks_andor_del'])){
    $f_remarks_andor_del = $_SESSION['f_remarks_andor_del'];
}
#[2018.01.19]課題解決管理表No.93
if (isset($_SESSION['f_send_mail_date_andor_del'])){
    $f_send_mail_date_andor_del = $_SESSION['f_send_mail_date_andor_del'];
}

$cr_id = "";
$inp_kyakusaki = "";
$inp_kenmei = "";
$opt_contarct_bill_form = "";
$inp_sagyo_basyo = "";
$inp_kaishi1 = "";
$inp_syuryo1 = "";
$txt_sagyo_jikan = "";
$inp_kaishi2 = "";
$inp_syuryo2 = "";
$txt_kyukei_jikan = "";

$inp_kyakusaki_busyo = "";
$inp_kyakusaki_tantosya = "";
$inp_kyakusaki_jimutantosya = "";
$inp_kyakusaki_yakusyoku = "";
$inp_kyakusaki_tel = "";
$inp_kyakusaki_kaishi = "";
$inp_kyakusaki_syuryo = "";

$opt_contract_calc_b1 = "";
$inp_tankin_b1 = "";
$contract_lower_limit_b1 = "";
$contract_upper_limit_b1 = "";
$opt_contract_lower_limit_b1 = "";
$opt_contract_upper_limit_b1 = "";
$opt_contract_trunc_unit_kojyo = "";
$txt_contract_kojyo_unit_b1 = "";
$opt_contract_trunc_unit_zangyo = "";
$txt_contract_zangyo_unit_b1 = "";

$inp_syugyonisu_b2 = "";
$inp_zeneigyonisu_b2 = "";
$opt_contract_calc_b2 = "";
$txt_tankin_b2 = "";
$contract_lower_limit_b2 = "";
$contract_upper_limit_b2 = "";
$opt_contract_lower_limit_b2 = "";
$opt_contract_upper_limit_b2 = "";
$txt_contract_kojyo_unit_b2 = "";
$txt_contract_zangyo_unit_b2 = "";

$inp_syugyonisu_b3 = "";
$inp_zeneigyonisu_b3 = "";
$opt_contract_calc_b3 = "";
$txt_tankin_b3 = "";
$contract_lower_limit_b3 = "";
$contract_upper_limit_b3 = "";
$opt_contract_lower_limit_b3 = "";
$opt_contract_upper_limit_b3 = "";
$txt_contract_kojyo_unit_b3 = "";
$txt_contract_zangyo_unit_b3 = "";

$opt_m_contract_time_inc_bd = "";
$opt_m_contract_time_inc_bm = "";
$opt_contract_tighten_b = "";
$opt_contract_bill_pay = "";
$opt_m_contract_yesno_b1 = "";
$opt_m_contract_yesno_b2 = "";
$opt_m_contract_yesno_b3 = "";
$opt_m_contract_yesno_b4 = "";
$inp_biko = "";

$opt_contract_kind = "";
$inp_keiyaku_no = "";
$inp_hakkobi = "";
$inp_sakuseisya = "";
$inp_engineer_no = "";
$txt_engineer_name = "";
$txt_engineer_kana = "";
$txt_jigyosya_name = "";
$opt_contract_pay_form = "";
$txt_jigyosya_kana = "";
$inp_jigyosya_tanto = "";
$opt_social_insurance = "";
$opt_tax_withholding = "";
$txt_kyakusaki_kaishi = "";
$txt_kyakusaki_syuryo = "";
$opt_contract_reduction = "";

$opt_contract_calc_p11 = "";
$opt_contract_calc_p21 = "";
$txt_tankin_p11 = "";
$txt_tankin_p21 = "";
$txt_contract_lower_limit_p11 = "";
$txt_contract_lower_limit_p21 = "";
$txt_contract_upper_limit_p11 = "";
$txt_contract_upper_limit_p21 = "";
$txt_contract_kojyo_unit_p11 = "";
$txt_contract_kojyo_unit_p21 = "";
$txt_contract_zangyo_unit_p11 = "";
$txt_contract_zangyo_unit_p21 = "";

$txt_syugyonisu_p12 = "";
$txt_syugyonisu_p22 = "";
$txt_zeneigyonisu_p12 = "";
$txt_zeneigyonisu_p22 = "";
$opt_contract_calc_p12 = "";
$opt_contract_calc_p22 = "";
$txt_tankin_p12 = "";
$txt_tankin_p22 = "";
$txt_contract_lower_limit_p12 = "";
$txt_contract_lower_limit_p22 = "";
$txt_contract_upper_limit_p12 = "";
$txt_contract_upper_limit_p22 = "";
$txt_contract_kojyo_unit_p12 = "";
$txt_contract_kojyo_unit_p22 = "";
$txt_contract_zangyo_unit_p12 = "";
$txt_contract_zangyo_unit_p22 = "";

$txt_syugyonisu_p13 = "";
$txt_syugyonisu_p23 = "";
$txt_zeneigyonisu_p13 = "";
$txt_zeneigyonisu_p23 = "";
$opt_contract_calc_p13 = "";
$opt_contract_calc_p23 = "";
$txt_tankin_p13 = "";
$txt_tankin_p23 = "";
$txt_contract_lower_limit_p13 = "";
$txt_contract_lower_limit_p23 = "";
$txt_contract_upper_limit_p13 = "";
$txt_contract_upper_limit_p23 = "";
$txt_contract_kojyo_unit_p13 = "";
$txt_contract_kojyo_unit_p23 = "";
$txt_contract_zangyo_unit_p13 = "";
$txt_contract_zangyo_unit_p23 = "";

$opt_m_contract_time_inc_pd = "";
$opt_m_contract_time_inc_pm = "";
$opt_contract_tighten_p = "";
$opt_contract_pay_pay = "";
$opt_contract_yesno_p1 = "";
$opt_contract_yesno_p2 = "";
$opt_contract_yesno_p3 = "";
$opt_contract_yesno_p4 = "";

$inp_wariai_nyujyo_c1 = "";
$inp_wariai_nyujyo_c2 = "";
$inp_wariai_taijyo_c1 = "";
$inp_wariai_taijyo_c2 = "";

$contact_date_org = "";
$organization = "";
$dd_name = "";
$dd_branch = "";
$dd_address = "";
$dd_tel = "";
$ip_position = "";
$ip_name = "";
$dm_responsible_position = "";
$dm_responsible_name = "";
$dm_responsible_tel = "";
$dd_responsible_position = "";
$dd_responsible_name = "";
$dd_responsible_tel = "";
$chs_position1 = "";
$chs_name1 = "";
$chs_tel1 = "";
$chs_position2 = "";
$chs_name2 = "";
$chs_tel2 = "";
$remarks_pay = "";
$status_cd = "";
$status_cd_num = "";

$reg_id = "";
$reg_person = "";
$upd_id = "";
$upd_person = "";
$cnf_person = "";

$claim_accounts_invoicing = ""; #[2017.12.14]要望
$txt_contract_reduction = "";  #[2018.01.10]協の場合還元率を手入力
$dsp_contract_reduction = "";  #[2018.01.10]協の場合還元率を手入力

#[2018.01.18]課題解決管理表No.92
$remarks2 = "";
$remarks_pay2 = "";

#[2018.01.26]課題解決管理表No.91
$claim_normal_unit_price_base = "";
$claim_middle_unit_price_base = "";
$claim_leaving_unit_price_base = "";
$payment_normal_unit_price_1_base = "";
$payment_normal_unit_price_2_base = "";
$payment_middle_unit_price_1_base = "";
$payment_middle_unit_price_2_base = "";
$payment_leaving_unit_price_1_base = "";
$payment_leaving_unit_price_2_base = "";

#[2018.01.29]課題解決管理表No.88-90
$file_payroll = "";
$file_evidence = "";

#[2018.01.29]課題解決管理表No.88-90
$color_diff = "#FF3333";
$color_customer_name = "";
$color_subject = "";
$color_claim_contract_form = "";
$color_workplace = "";
$color_work_start = "";
$color_work_end = "";
$color_work_hours = "";
$color_break_start = "";
$color_break_end = "";
$color_break_hours = "";

$color_customer_department_charge = "";
$color_customer_charge_name = "";
$color_customer_clerk_charge = "";
$color_charge_position = "";
$color_contact_phone_number = "";
$color_claim_agreement_start = "";
$color_claim_agreement_end = "";

$color_claim_normal_calculation = "";
$color_claim_normal__unit_price = "";
$color_claim_normal_lower_limit = "";
$color_claim_normal_upper_limit = "";
$color_claim_normal_deduction_unit_price_truncation_unit = "";
$color_claim_normal_overtime_unit_price_truncation_unit = "";
$color_claim_normal_deduction_unit_price = "";
$color_claim_normal_overtime_unit_price = "";

$color_claim_middle_employment_day = "";
$color_claim_middle_allbusiness_day = "";
$color_claim_middle_calculation = "";
$color_claim_middle_unit_price = "";
$color_claim_middle_lower_limit = "";
$color_claim_middle_upper_limit = "";
$color_claim_middle_deduction_unit_price = "";
$color_claim_middle_overtime_unit_price = "";

$color_claim_leaving_employment_day = "";
$color_claim_leaving_allbusiness_day = "";
$color_claim_leaving_calculation = "";
$color_claim_leaving_unit_price = "";
$color_claim_leaving_lower_limit = "";
$color_claim_leaving_upper_limit = "";
$color_claim_leaving_deduction_unit_price = "";
$color_claim_leaving_overtime_unit_price = "";

$color_claim_hourly_daily = "";
$color_claim_hourly_monthly = "";
$color_claim_settlement_closingday = "";
$color_claim_settlement_paymentday = "";
$color_claim_dispatch_individual_contract = "";
$color_claim_quotation = "";
$color_claim_purchase_order = "";
$color_claim_confirmation_order = "";
$color_remarks = "";
$color_remarks_pay = "";

$color_new_or_continued = "";
$color_contract_number = "";
$color_publication = "";
$color_author = "";
$color_engineer_number = "";
$color_engineer_name = "";
$color_engneer_name_phonetic = "";
$color_business_name = "";
$color_payment_contract_form = "";
$color_business_name_phonetic = "";
$color_business_charge_name = "";
$color_social_insurance = "";
$color_tax_withholding = "";
$color_payment_agreement_start = "";
$color_payment_agreement_end = "";
$color_redemption_ratio = "";

$color_payment_normal_calculation_1 = "";
$color_payment_normal_calculation_2 = "";
$color_payment_normal_unit_price_1 = "";
$color_payment_normal_unit_price_2 = "";
$color_payment_normal_lower_limit_1 = "";
$color_payment_normal_lower_limit_2 = "";
$color_payment_normal_upper_limit_1 = "";
$color_payment_normal_upper_limit_2 = "";
$color_payment_normal_deduction_unit_price_1 = "";
$color_payment_normal_deduction_unit_price_2 = "";
$color_payment_normal_overtime_unit_price_1 = "";
$color_payment_normal_overtime_unit_price_2 = "";

$color_payment_middle_employment_day_1 = "";
$color_payment_middle_employment_day_2 = "";
$color_payment_middle_allbusiness_day_1 = "";
$color_payment_middle_allbusiness_day_2 = "";
$color_payment_middle_calculation_1 = "";
$color_payment_middle_calculation_2 = "";
$color_payment_middle_unit_price_1 = "";
$color_payment_middle_unit_price_2 = "";
$color_payment_middle_lower_limit_1 = "";
$color_payment_middle_lower_limit_2 = "";
$color_payment_middle_upper_limit_1 = "";
$color_payment_middle_upper_limit_2 = "";
$color_payment_middle_deduction_unit_price_1 = "";
$color_payment_middle_deduction_unit_price_2 = "";
$color_payment_middle_overtime_unit_price_1 = "";
$color_payment_middle_overtime_unit_price_2 = "";

$color_payment_leaving_employment_day_1 = "";
$color_payment_leaving_employment_day_2 = "";
$color_payment_leaving_allbusiness_day_1 = "";
$color_payment_leaving_allbusiness_day_2 = "";
$color_payment_leaving_calculation_1 = "";
$color_payment_leaving_calculation_2 = "";
$color_payment_leaving_unit_price_1 = "";
$color_payment_leaving_unit_price_2 = "";
$color_payment_leaving_lower_limit_1 = "";
$color_payment_leaving_lower_limit_2 = "";
$color_payment_leaving_upper_limit_1 = "";
$color_payment_leaving_upper_limit_2 = "";
$color_payment_leaving_deduction_unit_price_1 = "";
$color_payment_leaving_deduction_unit_price_2 = "";
$color_payment_leaving_overtime_unit_price_1 = "";
$color_payment_leaving_overtime_unit_price_2 = "";

$color_payment_hourly_daily = "";
$color_payment_hourly_monthly = "";
$color_payment_settlement_closingday = "";
$color_payment_settlement_paymentday = "";
$color_payment_absence_deduction_subject = "";
$color_payment_quotation = "";
$color_payment_purchase_order = "";
$color_payment_confirmation_order = "";

$color_payment_middle_daily_auto = "";
$color_payment_middle_daily_manual = "";
$color_payment_leaving_daily_auto = "";
$color_payment_leaving_daily_manual = "";

$color_contact_date_org = "";
$color_organization = "";
$color_dd_name = "";
$color_dd_address = "";
$color_dd_tel = "";
$color_ip_position = "";
$color_dm_responsible_position = "";
$color_dd_responsible_position = "";
$color_chs_position1 = "";
$color_chs_position2 = "";

$color_upd_person = "";
$color_cnf_person = "";

$color_claim_accounts_invoicing = "";

$color_claim_normal_unit_price_base = "";
$color_claim_middle_unit_price_base = "";
$color_claim_leaving_unit_price_base = "";
$color_payment_normal_unit_price_1_base = "";
$color_payment_normal_unit_price_2_base = "";
$color_payment_middle_unit_price_1_base = "";
$color_payment_middle_unit_price_2_base = "";
$color_payment_leaving_unit_price_1_base = "";
$color_payment_leaving_unit_price_2_base = "";

$color_payroll = "";
$color_evidence = "";

function set_10100_selectDB()
{
    $a_sql_src = "SELECT t1.*";
    $a_sql_src .= ",(SELECT idx FROM ".$GLOBALS['g_DB_m_contract_status']." WHERE (m_name=t1.status_cd)) AS status_cd_num";
    $a_sql_src .= ",(SELECT person FROM ".$GLOBALS['g_DB_m_user']." WHERE (idx=t1.reg_id)) AS reg_person";
    $a_sql_src .= ",(SELECT person FROM ".$GLOBALS['g_DB_m_user']." WHERE (idx=t1.upd_id)) AS upd_person";
    $a_sql_src .= ",(SELECT person FROM ".$GLOBALS['g_DB_m_user']." WHERE (idx=t1.cnf_id)) AS cnf_person";

    #[2018.01.29]課題解決管理表No.88-90
    $a_sql_src .= ",(SELECT GROUP_CONCAT(file_name_src ORDER BY file_name_src) FROM t_payroll_file WHERE cr_id=t1.cr_id) AS file_payroll";
    $a_sql_src .= ",(SELECT GROUP_CONCAT(file_name_src ORDER BY file_name_src) FROM t_evidence WHERE cr_id=t1.cr_id) AS file_evidence";

    #[2018.01.29]課題解決管理表No.87
    $a_sql_src .= " FROM (SELECT * FROM ".$GLOBALS['g_DB_t_contract_report']." WHERE ";
    if ($_SESSION['contract_del'] == 1){
        $a_sql_src .= "(del_flag='1')";
    }else{
        $a_sql_src .= "((del_flag IS NULL) OR (del_flag<>'1'))";
    }
    $a_sql_src .= ") t1";
    
    return $a_sql_src;
}

function set_10100_fromDB($a_result)
{
    $GLOBALS['cr_id'] = $a_result['cr_id'];
    //客先名など
    $GLOBALS['inp_kyakusaki'] = $a_result['customer_name'];
    $GLOBALS['inp_kenmei'] = $a_result['subject'];
    $GLOBALS['opt_contarct_bill_form'] = $a_result['claim_contract_form'];
    $GLOBALS['inp_sagyo_basyo'] = $a_result['workplace'];
    $GLOBALS['inp_kaishi1'] = substr($a_result['work_start'], 0, 5);
    $GLOBALS['inp_syuryo1'] = substr($a_result['work_end'], 0, 5);
    $GLOBALS['txt_sagyo_jikan'] = substr($a_result['work_hours'], 0, 5);
    $GLOBALS['inp_kaishi2'] = substr($a_result['break_start'], 0, 5);
    $GLOBALS['inp_syuryo2'] = substr($a_result['break_end'], 0, 5);
    $GLOBALS['txt_kyukei_jikan'] = substr($a_result['break_hours'], 0, 5);

    //客先担当部署など
    $GLOBALS['inp_kyakusaki_busyo'] = $a_result['customer_department_charge'];
    $GLOBALS['inp_kyakusaki_tantosya'] = $a_result['customer_charge_name'];
    $GLOBALS['inp_kyakusaki_jimutantosya'] = $a_result['customer_clerk_charge'];
    $GLOBALS['inp_kyakusaki_yakusyoku'] = $a_result['charge_position'];
    $GLOBALS['inp_kyakusaki_tel'] = $a_result['contact_phone_number'];
    $GLOBALS['inp_kyakusaki_kaishi'] = str_replace("-", "/", $a_result['claim_agreement_start']);
    $GLOBALS['inp_kyakusaki_syuryo'] = str_replace("-", "/", $a_result['claim_agreement_end']);

    //通常期間など
    $GLOBALS['opt_contract_calc_b1'] = $a_result['claim_normal_calculation'];
    $GLOBALS['inp_tankin_b1'] = com_db_number_format($a_result['claim_normal__unit_price']);    //[2017.11.09]課題No,82
    $GLOBALS['contract_lower_limit_b1'] = $a_result['claim_normal_lower_limit'];
    $GLOBALS['contract_upper_limit_b1'] = $a_result['claim_normal_upper_limit'];
    $GLOBALS['opt_contract_lower_limit_b1'] = $a_result['claim_normal_lower_limit'];
    $GLOBALS['opt_contract_upper_limit_b1'] = $a_result['claim_normal_upper_limit'];
    $GLOBALS['opt_contract_trunc_unit_kojyo'] = $a_result['claim_normal_deduction_unit_price_truncation_unit'];
    $GLOBALS['opt_contract_trunc_unit_zangyo'] = $a_result['claim_normal_overtime_unit_price_truncation_unit'];
    $GLOBALS['txt_contract_kojyo_unit_b1'] = com_db_number_format($a_result['claim_normal_deduction_unit_price']);
    $GLOBALS['txt_contract_zangyo_unit_b1'] = com_db_number_format($a_result['claim_normal_overtime_unit_price']);

    $GLOBALS['inp_syugyonisu_b2'] = $a_result['claim_middle_employment_day'];
    $GLOBALS['inp_zeneigyonisu_b2'] = $a_result['claim_middle_allbusiness_day'];
    $GLOBALS['opt_contract_calc_b2'] = $a_result['claim_middle_calculation'];
    $GLOBALS['txt_tankin_b2'] = com_db_number_format($a_result['claim_middle_unit_price']);
    $GLOBALS['contract_lower_limit_b2'] = $a_result['claim_middle_lower_limit'];
    $GLOBALS['contract_upper_limit_b2'] = $a_result['claim_middle_upper_limit'];
    $GLOBALS['opt_contract_lower_limit_b2'] = $a_result['claim_middle_lower_limit'];
    $GLOBALS['opt_contract_upper_limit_b2'] = $a_result['claim_middle_upper_limit'];
    $GLOBALS['txt_contract_kojyo_unit_b2'] = com_db_number_format($a_result['claim_middle_deduction_unit_price']);
    $GLOBALS['txt_contract_zangyo_unit_b2'] = com_db_number_format($a_result['claim_middle_overtime_unit_price']);

    $GLOBALS['inp_syugyonisu_b3'] = $a_result['claim_leaving_employment_day'];
    $GLOBALS['inp_zeneigyonisu_b3'] = $a_result['claim_leaving_allbusiness_day'];
    $GLOBALS['opt_contract_calc_b3'] = $a_result['claim_leaving_calculation'];
    $GLOBALS['txt_tankin_b3'] = com_db_number_format($a_result['claim_leaving_unit_price']);
    $GLOBALS['contract_lower_limit_b3'] = $a_result['claim_leaving_lower_limit'];
    $GLOBALS['contract_upper_limit_b3'] = $a_result['claim_leaving_upper_limit'];
    $GLOBALS['opt_contract_lower_limit_b3'] = $a_result['claim_leaving_lower_limit'];
    $GLOBALS['opt_contract_upper_limit_b3'] = $a_result['claim_leaving_upper_limit'];
    $GLOBALS['txt_contract_kojyo_unit_b3'] = com_db_number_format($a_result['claim_leaving_deduction_unit_price']);
    $GLOBALS['txt_contract_zangyo_unit_b3'] = com_db_number_format($a_result['claim_leaving_overtime_unit_price']);

    $GLOBALS['opt_m_contract_time_inc_bd'] = $a_result['claim_hourly_daily'];
    $GLOBALS['opt_m_contract_time_inc_bm'] = $a_result['claim_hourly_monthly'];
    $GLOBALS['opt_contract_tighten_b'] = $a_result['claim_settlement_closingday'];
    $GLOBALS['opt_contract_bill_pay'] = $a_result['claim_settlement_paymentday'];
    $GLOBALS['opt_m_contract_yesno_b1'] = $a_result['claim_dispatch_individual_contract'];
    $GLOBALS['opt_m_contract_yesno_b2'] = $a_result['claim_quotation'];
    $GLOBALS['opt_m_contract_yesno_b3'] = $a_result['claim_purchase_order'];
    $GLOBALS['opt_m_contract_yesno_b4'] = $a_result['claim_confirmation_order'];
    $GLOBALS['inp_biko'] = $a_result['remarks'];

    $GLOBALS['opt_contract_kind'] = $a_result['new_or_continued'];
    $GLOBALS['inp_keiyaku_no'] = $a_result['contract_number'];
    $GLOBALS['inp_hakkobi'] = str_replace("-", "/", $a_result['publication']);
    $GLOBALS['inp_sakuseisya'] = $a_result['author'];
    $GLOBALS['inp_engineer_no'] = $a_result['engineer_number'];
    $GLOBALS['txt_engineer_name'] = $a_result['engineer_name'];
    $GLOBALS['txt_engineer_kana'] = $a_result['engneer_name_phonetic'];
    $GLOBALS['txt_jigyosya_name'] = $a_result['business_name'];
    $GLOBALS['opt_contract_pay_form'] = $a_result['payment_contract_form'];
    $GLOBALS['txt_jigyosya_kana'] = $a_result['business_name_phonetic'];
    $GLOBALS['inp_jigyosya_tanto'] = $a_result['business_charge_name'];
    $GLOBALS['opt_social_insurance'] = $a_result['social_insurance'];
    $GLOBALS['opt_tax_withholding'] = $a_result['tax_withholding'];
    $GLOBALS['txt_kyakusaki_kaishi'] = str_replace("-", "/", $a_result['payment_agreement_start']);
    $GLOBALS['txt_kyakusaki_syuryo'] = str_replace("-", "/", $a_result['payment_agreement_end']);
    $GLOBALS['opt_contract_reduction'] = $a_result['redemption_ratio'];

    $GLOBALS['opt_contract_calc_p11'] = $a_result['payment_normal_calculation_1'];
    $GLOBALS['opt_contract_calc_p21'] = $a_result['payment_normal_calculation_2'];
    $GLOBALS['txt_tankin_p11'] = com_db_number_format($a_result['payment_normal_unit_price_1']);
    $GLOBALS['txt_tankin_p21'] = com_db_number_format($a_result['payment_normal_unit_price_2']);
    $GLOBALS['txt_contract_lower_limit_p11'] = $a_result['payment_normal_lower_limit_1'];
    $GLOBALS['txt_contract_lower_limit_p21'] = $a_result['payment_normal_lower_limit_2'];
    $GLOBALS['txt_contract_upper_limit_p11'] = $a_result['payment_normal_upper_limit_1'];
    $GLOBALS['txt_contract_upper_limit_p21'] = $a_result['payment_normal_upper_limit_2'];
    $GLOBALS['txt_contract_kojyo_unit_p11'] = com_db_number_format($a_result['payment_normal_deduction_unit_price_1']);
    $GLOBALS['txt_contract_kojyo_unit_p21'] = com_db_number_format($a_result['payment_normal_deduction_unit_price_2']);
    $GLOBALS['txt_contract_zangyo_unit_p11'] = com_db_number_format($a_result['payment_normal_overtime_unit_price_1']);
    $GLOBALS['txt_contract_zangyo_unit_p21'] = com_db_number_format($a_result['payment_normal_overtime_unit_price_2']);

    $GLOBALS['txt_syugyonisu_p12'] = $a_result['payment_middle_employment_day_1'];
    $GLOBALS['txt_syugyonisu_p22'] = $a_result['payment_middle_employment_day_2'];
    $GLOBALS['txt_zeneigyonisu_p12'] = $a_result['payment_middle_allbusiness_day_1'];
    $GLOBALS['txt_zeneigyonisu_p22'] = $a_result['payment_middle_allbusiness_day_2'];
    $GLOBALS['opt_contract_calc_p12'] = $a_result['payment_middle_calculation_1'];
    $GLOBALS['opt_contract_calc_p22'] = $a_result['payment_middle_calculation_2'];
    $GLOBALS['txt_tankin_p12'] = com_db_number_format($a_result['payment_middle_unit_price_1']);
    $GLOBALS['txt_tankin_p22'] = com_db_number_format($a_result['payment_middle_unit_price_2']);
    $GLOBALS['txt_contract_lower_limit_p12'] = $a_result['payment_middle_lower_limit_1'];
    $GLOBALS['txt_contract_lower_limit_p22'] = $a_result['payment_middle_lower_limit_2'];
    $GLOBALS['txt_contract_upper_limit_p12'] = $a_result['payment_middle_upper_limit_1'];
    $GLOBALS['txt_contract_upper_limit_p22'] = $a_result['payment_middle_upper_limit_2'];
    $GLOBALS['txt_contract_kojyo_unit_p12'] = com_db_number_format($a_result['payment_middle_deduction_unit_price_1']);
    $GLOBALS['txt_contract_kojyo_unit_p22'] = com_db_number_format($a_result['payment_middle_deduction_unit_price_2']);
    $GLOBALS['txt_contract_zangyo_unit_p12'] = com_db_number_format($a_result['payment_middle_overtime_unit_price_1']);
    $GLOBALS['txt_contract_zangyo_unit_p22'] = com_db_number_format($a_result['payment_middle_overtime_unit_price_2']);

    $GLOBALS['txt_syugyonisu_p13'] = $a_result['payment_leaving_employment_day_1'];
    $GLOBALS['txt_syugyonisu_p23'] = $a_result['payment_leaving_employment_day_2'];
    $GLOBALS['txt_zeneigyonisu_p13'] = $a_result['payment_leaving_allbusiness_day_1'];
    $GLOBALS['txt_zeneigyonisu_p23'] = $a_result['payment_leaving_allbusiness_day_2'];
    $GLOBALS['opt_contract_calc_p13'] = $a_result['payment_leaving_calculation_1'];
    $GLOBALS['opt_contract_calc_p23'] = $a_result['payment_leaving_calculation_2'];
    $GLOBALS['txt_tankin_p13'] = com_db_number_format($a_result['payment_leaving_unit_price_1']);
    $GLOBALS['txt_tankin_p23'] = com_db_number_format($a_result['payment_leaving_unit_price_2']);
    $GLOBALS['txt_contract_lower_limit_p13'] = $a_result['payment_leaving_lower_limit_1'];
    $GLOBALS['txt_contract_lower_limit_p23'] = $a_result['payment_leaving_lower_limit_2'];
    $GLOBALS['txt_contract_upper_limit_p13'] = $a_result['payment_leaving_upper_limit_1'];
    $GLOBALS['txt_contract_upper_limit_p23'] = $a_result['payment_leaving_upper_limit_2'];
    $GLOBALS['txt_contract_kojyo_unit_p13'] = com_db_number_format($a_result['payment_leaving_deduction_unit_price_1']);
    $GLOBALS['txt_contract_kojyo_unit_p23'] = com_db_number_format($a_result['payment_leaving_deduction_unit_price_2']);
    $GLOBALS['txt_contract_zangyo_unit_p13'] = com_db_number_format($a_result['payment_leaving_overtime_unit_price_1']);
    $GLOBALS['txt_contract_zangyo_unit_p23'] = com_db_number_format($a_result['payment_leaving_overtime_unit_price_2']);

    $GLOBALS['opt_m_contract_time_inc_pd'] = $a_result['payment_hourly_daily'];
    $GLOBALS['opt_m_contract_time_inc_pm'] = $a_result['payment_hourly_monthly'];
    $GLOBALS['opt_contract_tighten_p'] = $a_result['payment_settlement_closingday'];
    $GLOBALS['opt_contract_pay_pay'] = $a_result['payment_settlement_paymentday'];
    $GLOBALS['opt_contract_yesno_p1'] = $a_result['payment_absence_deduction_subject'];
    $GLOBALS['opt_contract_yesno_p2'] = $a_result['payment_quotation'];
    $GLOBALS['opt_contract_yesno_p3'] = $a_result['payment_purchase_order'];
    $GLOBALS['opt_contract_yesno_p4'] = $a_result['payment_confirmation_order'];

    $GLOBALS['inp_wariai_nyujyo_c1'] = $a_result['payment_middle_daily_auto'];
    $GLOBALS['inp_wariai_nyujyo_c2'] = $a_result['payment_middle_daily_manual'];
    $GLOBALS['inp_wariai_taijyo_c1'] = $a_result['payment_leaving_daily_auto'];
    $GLOBALS['inp_wariai_taijyo_c2'] = $a_result['payment_leaving_daily_manual'];

    $GLOBALS['contact_date_org'] = com_replace_toDate($a_result['contact_date_org']);
    $GLOBALS['organization'] = $a_result['organization'];
    $GLOBALS['dd_name'] = $a_result['dd_name'];
    $GLOBALS['dd_branch'] = $a_result['dd_branch'];
    $GLOBALS['dd_address'] = $a_result['dd_address'];
    $GLOBALS['dd_tel'] = $a_result['dd_tel'];
    $GLOBALS['ip_position'] = $a_result['ip_position'];
    $GLOBALS['ip_name'] = $a_result['ip_name'];
    $GLOBALS['dm_responsible_position'] = $a_result['dm_responsible_position'];
    $GLOBALS['dm_responsible_name'] = $a_result['dm_responsible_name'];
    $GLOBALS['dm_responsible_tel'] = $a_result['dm_responsible_tel'];
    $GLOBALS['dd_responsible_position'] = $a_result['dd_responsible_position'];
    $GLOBALS['dd_responsible_name'] = $a_result['dd_responsible_name'];
    $GLOBALS['dd_responsible_tel'] = $a_result['dd_responsible_tel'];
    $GLOBALS['chs_position1'] = $a_result['chs_position1'];
    $GLOBALS['chs_name1'] = $a_result['chs_name1'];
    $GLOBALS['chs_tel1'] = $a_result['chs_tel1'];
    $GLOBALS['chs_position2'] = $a_result['chs_position2'];
    $GLOBALS['chs_name2'] = $a_result['chs_name2'];
    $GLOBALS['chs_tel2'] = $a_result['chs_tel2'];
    $GLOBALS['remarks_pay'] = $a_result['remarks_pay'];
    $GLOBALS['status_cd'] = $a_result['status_cd'];
    $GLOBALS['status_cd_num'] = $a_result['status_cd_num'];

    $GLOBALS['reg_id'] = $a_result['reg_id'];
    $GLOBALS['reg_person'] = $a_result['reg_person'];
    $GLOBALS['upd_id'] = $a_result['upd_id'];
    $GLOBALS['upd_person'] = $a_result['upd_person'];
    $GLOBALS['cnf_person'] = $a_result['cnf_person'];

    $GLOBALS['claim_accounts_invoicing'] = $a_result['claim_accounts_invoicing'];   #[2017.12.14]要望
    #[2018.01.10]協の場合還元率を手入力
    if ($GLOBALS['opt_contract_pay_form'] == "協"){
        $GLOBALS['txt_contract_reduction'] = $GLOBALS['opt_contract_reduction'];
        $GLOBALS['opt_contract_reduction'] = "";
        $GLOBALS['dsp_contract_reduction'] = $GLOBALS['txt_contract_reduction'];
    }else{
        $GLOBALS['dsp_contract_reduction'] = $GLOBALS['opt_contract_reduction'];
    }

    #[2018.01.18]課題解決管理表No.92
    $GLOBALS['remarks2'] = $a_result['remarks2'];
    $GLOBALS['remarks_pay2'] = $a_result['remarks_pay2'];

    #[2018.01.26]課題解決管理表No.91
    $GLOBALS['claim_normal_unit_price_base'] = com_db_number_format($a_result['claim_normal_unit_price_base']);
    $GLOBALS['claim_middle_unit_price_base'] = com_db_number_format($a_result['claim_middle_unit_price_base']);
    $GLOBALS['claim_leaving_unit_price_base'] = com_db_number_format($a_result['claim_leaving_unit_price_base']);
    $GLOBALS['payment_normal_unit_price_1_base'] = com_db_number_format($a_result['payment_normal_unit_price_1_base']);
    $GLOBALS['payment_normal_unit_price_2_base'] = com_db_number_format($a_result['payment_normal_unit_price_2_base']);
    $GLOBALS['payment_middle_unit_price_1_base'] = com_db_number_format($a_result['payment_middle_unit_price_1_base']);
    $GLOBALS['payment_middle_unit_price_2_base'] = com_db_number_format($a_result['payment_middle_unit_price_2_base']);
    $GLOBALS['payment_leaving_unit_price_1_base'] = com_db_number_format($a_result['payment_leaving_unit_price_1_base']);
    $GLOBALS['payment_leaving_unit_price_s_base'] = com_db_number_format($a_result['payment_leaving_unit_price_2_base']);

    #[2018.01.29]課題解決管理表No.88-90
    $GLOBALS['file_payroll'] = $a_result['file_payroll'];
    $GLOBALS['file_evidence'] = $a_result['file_evidence'];
    
}

#[2018.01.29]課題解決管理表No.88-90
function get_10100_selectDB_submission()
{
    if (isset($_GET['NO'])) {
        $a_no = $_GET['NO'];
        try{
            //DBからユーザ情報取得
            $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
            $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $a_sql = set_10100_selectDB_submission();

            $a_sql .= " WHERE (cr_id=:cr_id);";
            $a_stmt = $a_conn->prepare($a_sql);
            $a_stmt->bindParam(':cr_id', $a_no, PDO::PARAM_STR);
            $a_stmt->execute();

            while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
                chk_10100_fromDB_submission($a_result);
            }
        } catch (PDOException $e){
            echo 'Error:'.$e->getMessage();
            die();
        }
    }
}

#[2018.01.29]課題解決管理表No.88-90
function set_10100_selectDB_submission()
{
    $a_sql_src = "SELECT t1.*";
    $a_sql_src .= ",(SELECT idx FROM ".$GLOBALS['g_DB_m_contract_status']." WHERE (m_name=t1.status_cd)) AS status_cd_num";
    $a_sql_src .= ",(SELECT person FROM ".$GLOBALS['g_DB_m_user']." WHERE (idx=t1.reg_id)) AS reg_person";
    $a_sql_src .= ",(SELECT person FROM ".$GLOBALS['g_DB_m_user']." WHERE (idx=t1.upd_id)) AS upd_person";
    $a_sql_src .= ",(SELECT person FROM ".$GLOBALS['g_DB_m_user']." WHERE (idx=t1.cnf_id)) AS cnf_person";
    
    #[2018.01.29]課題解決管理表No.88-90
    #$a_sql_src .= ",(SELECT GROUP_CONCAT(file_name_src ORDER BY file_name_src) FROM t_payroll_file WHERE cr_id=t1.cr_id) AS file_payroll";
    #$a_sql_src .= ",(SELECT GROUP_CONCAT(file_name_src ORDER BY file_name_src) FROM t_evidence WHERE cr_id=t1.cr_id) AS file_evidence";

    $a_sql_src .= " FROM ".$GLOBALS['g_DB_t_contract_report_submission']." t1";
    
    return $a_sql_src;
}

#[2018.01.29]課題解決管理表No.88-90
function chk_10100_fromDB_submission($a_result)
{
    #$GLOBALS['cr_id'] = $a_result['cr_id'];
    
    //客先名など
    if ($GLOBALS['inp_kyakusaki'] != $a_result['customer_name']){$GLOBALS['color_customer_name'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['inp_kenmei'] != $a_result['subject']){$GLOBALS['color_subject'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['opt_contarct_bill_form'] != $a_result['claim_contract_form']){$GLOBALS['color_claim_contract_form'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['inp_sagyo_basyo'] != $a_result['workplace']){$GLOBALS['color_workplace'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['inp_kaishi1'] != substr($a_result['work_start'], 0, 5)){$GLOBALS['color_work_start'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['inp_syuryo1'] != substr($a_result['work_end'], 0, 5)){$GLOBALS['color_work_end'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_sagyo_jikan'] != substr($a_result['work_hours'], 0, 5)){$GLOBALS['color_work_hours'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['inp_kaishi2'] != substr($a_result['break_start'], 0, 5)){$GLOBALS['color_break_start'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['inp_syuryo2'] != substr($a_result['break_end'], 0, 5)){$GLOBALS['color_break_end'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_kyukei_jikan'] != substr($a_result['break_hours'], 0, 5)){$GLOBALS['color_break_hours'] = $GLOBALS['color_diff'];}

    //客先担当部署など
    if ($GLOBALS['inp_kyakusaki_busyo'] != $a_result['customer_department_charge']){$GLOBALS['color_customer_department_charge'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['inp_kyakusaki_tantosya'] != $a_result['customer_charge_name']){$GLOBALS['color_customer_charge_name'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['inp_kyakusaki_jimutantosya'] != $a_result['customer_clerk_charge']){$GLOBALS['color_customer_clerk_charge'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['inp_kyakusaki_yakusyoku'] != $a_result['charge_position']){$GLOBALS['color_charge_position'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['inp_kyakusaki_tel'] != $a_result['contact_phone_number']){$GLOBALS['color_contact_phone_number'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['inp_kyakusaki_kaishi'] != str_replace("-", "/", $a_result['claim_agreement_start'])){$GLOBALS['color_claim_agreement_start'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['inp_kyakusaki_syuryo'] != str_replace("-", "/", $a_result['claim_agreement_end'])){$GLOBALS['color_claim_agreement_end'] = $GLOBALS['color_diff'];}

    //通常期間など
    if ($GLOBALS['opt_contract_calc_b1'] != $a_result['claim_normal_calculation']){$GLOBALS['color_claim_normal_calculation'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['inp_tankin_b1'] != com_db_number_format($a_result['claim_normal__unit_price'])){$GLOBALS['color_claim_normal__unit_price'] = $GLOBALS['color_diff'];}
    if (($GLOBALS['contract_lower_limit_b1'] != $a_result['claim_normal_lower_limit']) || ($GLOBALS['opt_contract_lower_limit_b1'] != $a_result['claim_normal_lower_limit'])){$GLOBALS['color_claim_normal_lower_limit'] = $GLOBALS['color_diff'];}
    if (($GLOBALS['contract_upper_limit_b1'] != $a_result['claim_normal_upper_limit']) || ($GLOBALS['opt_contract_upper_limit_b1'] != $a_result['claim_normal_upper_limit'])){$GLOBALS['color_claim_normal_upper_limit'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['opt_contract_trunc_unit_kojyo'] != $a_result['claim_normal_deduction_unit_price_truncation_unit']){$GLOBALS['color_claim_normal_deduction_unit_price_truncation_unit'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['opt_contract_trunc_unit_zangyo'] != $a_result['claim_normal_overtime_unit_price_truncation_unit']){$GLOBALS['color_claim_normal_overtime_unit_price_truncation_unit'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_contract_kojyo_unit_b1'] != com_db_number_format($a_result['claim_normal_deduction_unit_price'])){$GLOBALS['color_claim_normal_deduction_unit_price'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_contract_zangyo_unit_b1'] != com_db_number_format($a_result['claim_normal_overtime_unit_price'])){$GLOBALS['color_claim_normal_overtime_unit_price'] = $GLOBALS['color_diff'];}

    if ($GLOBALS['inp_syugyonisu_b2'] != $a_result['claim_middle_employment_day']){$GLOBALS['color_claim_middle_employment_day'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['inp_zeneigyonisu_b2'] != $a_result['claim_middle_allbusiness_day']){$GLOBALS['color_claim_middle_allbusiness_day'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['opt_contract_calc_b2'] != $a_result['claim_middle_calculation']){$GLOBALS['color_claim_middle_calculation'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_tankin_b2'] != com_db_number_format($a_result['claim_middle_unit_price'])){$GLOBALS['color_claim_middle_unit_price'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['contract_lower_limit_b2'] != $a_result['claim_middle_lower_limit']){$GLOBALS['color_claim_middle_lower_limit'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['contract_upper_limit_b2'] != $a_result['claim_middle_upper_limit']){$GLOBALS['color_claim_middle_upper_limit'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_contract_kojyo_unit_b2'] != com_db_number_format($a_result['claim_middle_deduction_unit_price'])){$GLOBALS['color_claim_middle_deduction_unit_price'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_contract_zangyo_unit_b2'] != com_db_number_format($a_result['claim_middle_overtime_unit_price'])){$GLOBALS['color_claim_middle_overtime_unit_price'] = $GLOBALS['color_diff'];}

    if ($GLOBALS['inp_syugyonisu_b3'] != $a_result['claim_leaving_employment_day']){$GLOBALS['color_claim_leaving_employment_day'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['inp_zeneigyonisu_b3'] != $a_result['claim_leaving_allbusiness_day']){$GLOBALS['color_claim_leaving_allbusiness_day'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['opt_contract_calc_b3'] != $a_result['claim_leaving_calculation']){$GLOBALS['color_claim_leaving_calculation'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_tankin_b3'] != com_db_number_format($a_result['claim_leaving_unit_price'])){$GLOBALS['color_claim_leaving_unit_price'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['contract_lower_limit_b3'] != $a_result['claim_leaving_lower_limit']){$GLOBALS['color_claim_leaving_lower_limit'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['contract_upper_limit_b3'] != $a_result['claim_leaving_upper_limit']){$GLOBALS['color_claim_leaving_upper_limit'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_contract_kojyo_unit_b3'] != com_db_number_format($a_result['claim_leaving_deduction_unit_price'])){$GLOBALS['color_claim_leaving_deduction_unit_price'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_contract_zangyo_unit_b3'] != com_db_number_format($a_result['claim_leaving_overtime_unit_price'])){$GLOBALS['color_claim_leaving_overtime_unit_price'] = $GLOBALS['color_diff'];}

    if ($GLOBALS['opt_m_contract_time_inc_bd'] != $a_result['claim_hourly_daily']){$GLOBALS['color_claim_hourly_daily'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['opt_m_contract_time_inc_bm'] != $a_result['claim_hourly_monthly']){$GLOBALS['color_claim_hourly_monthly'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['opt_contract_tighten_b'] != $a_result['claim_settlement_closingday']){$GLOBALS['color_claim_settlement_closingday'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['opt_contract_bill_pay'] != $a_result['claim_settlement_paymentday']){$GLOBALS['color_claim_settlement_paymentday'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['opt_m_contract_yesno_b1'] != $a_result['claim_dispatch_individual_contract']){$GLOBALS['color_claim_dispatch_individual_contract'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['opt_m_contract_yesno_b2'] != $a_result['claim_quotation']){$GLOBALS['color_claim_quotation'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['opt_m_contract_yesno_b3'] != $a_result['claim_purchase_order']){$GLOBALS['color_claim_purchase_order'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['opt_m_contract_yesno_b4'] != $a_result['claim_confirmation_order']){$GLOBALS['color_claim_confirmation_order'] = $GLOBALS['color_diff'];}
    if (($GLOBALS['inp_biko'] != $a_result['remarks']) || ($GLOBALS['remarks2'] != $a_result['remarks2'])){$GLOBALS['color_remarks'] = $GLOBALS['color_diff'];}
    if (($GLOBALS['remarks_pay'] != $a_result['remarks_pay']) || ($GLOBALS['remarks_pay2'] != $a_result['remarks_pay2'])){$GLOBALS['color_remarks_pay'] = $GLOBALS['color_diff'];}

    if ($GLOBALS['opt_contract_kind'] != $a_result['new_or_continued']){$GLOBALS['color_new_or_continued'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['inp_keiyaku_no'] != $a_result['contract_number']){$GLOBALS['color_contract_number'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['inp_hakkobi'] != str_replace("-", "/", $a_result['publication'])){$GLOBALS['color_publication'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['inp_sakuseisya'] != $a_result['author']){$GLOBALS['color_author'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['inp_engineer_no'] != $a_result['engineer_number']){$GLOBALS['color_engineer_number'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_engineer_name'] != $a_result['engineer_name']){$GLOBALS['color_engineer_name'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_engineer_kana'] != $a_result['engneer_name_phonetic']){$GLOBALS['color_engneer_name_phonetic'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_jigyosya_name'] != $a_result['business_name']){$GLOBALS['color_business_name'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['opt_contract_pay_form'] != $a_result['payment_contract_form']){$GLOBALS['color_payment_contract_form'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_jigyosya_kana'] != $a_result['business_name_phonetic']){$GLOBALS['color_business_name_phonetic'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['inp_jigyosya_tanto'] != $a_result['business_charge_name']){$GLOBALS['color_business_charge_name'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['opt_social_insurance'] != $a_result['social_insurance']){$GLOBALS['color_social_insurance'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['opt_tax_withholding'] != $a_result['tax_withholding']){$GLOBALS['color_tax_withholding'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_kyakusaki_kaishi'] != str_replace("-", "/", $a_result['payment_agreement_start'])){$GLOBALS['color_payment_agreement_start'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_kyakusaki_syuryo'] != str_replace("-", "/", $a_result['payment_agreement_end'])){$GLOBALS['color_payment_agreement_end'] = $GLOBALS['color_diff'];}
    #echo "還元率=".$GLOBALS['opt_contract_reduction'].",".$GLOBALS['txt_contract_reduction']."<br>";
    #echo "還元率=".$a_result['redemption_ratio']."<br>";
    #[2018.01.10]協の場合還元率を手入力
    if ($GLOBALS['opt_contract_pay_form'] == "協"){
        if ($GLOBALS['txt_contract_reduction'] != $a_result['redemption_ratio']){$GLOBALS['color_redemption_ratio'] = $GLOBALS['color_diff'];}
    }else{
        if ($GLOBALS['opt_contract_reduction'] != $a_result['redemption_ratio']){$GLOBALS['color_redemption_ratio'] = $GLOBALS['color_diff'];}
    }

    if ($GLOBALS['opt_contract_calc_p11'] != $a_result['payment_normal_calculation_1']){$GLOBALS['color_payment_normal_calculation_1'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['opt_contract_calc_p21'] != $a_result['payment_normal_calculation_2']){$GLOBALS['color_payment_normal_calculation_2'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_tankin_p11'] != com_db_number_format($a_result['payment_normal_unit_price_1'])){$GLOBALS['color_payment_normal_unit_price_1'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_tankin_p21'] != com_db_number_format($a_result['payment_normal_unit_price_2'])){$GLOBALS['color_payment_normal_unit_price_2'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_contract_lower_limit_p11'] != $a_result['payment_normal_lower_limit_1']){$GLOBALS['color_payment_normal_lower_limit_1'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_contract_lower_limit_p21'] != $a_result['payment_normal_lower_limit_2']){$GLOBALS['color_payment_normal_lower_limit_2'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_contract_upper_limit_p11'] != $a_result['payment_normal_upper_limit_1']){$GLOBALS['color_payment_normal_upper_limit_1'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_contract_upper_limit_p21'] != $a_result['payment_normal_upper_limit_2']){$GLOBALS['color_payment_normal_upper_limit_2'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_contract_kojyo_unit_p11'] != com_db_number_format($a_result['payment_normal_deduction_unit_price_1'])){$GLOBALS['color_payment_normal_deduction_unit_price_1'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_contract_kojyo_unit_p21'] != com_db_number_format($a_result['payment_normal_deduction_unit_price_2'])){$GLOBALS['color_payment_normal_deduction_unit_price_2'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_contract_zangyo_unit_p11'] != com_db_number_format($a_result['payment_normal_overtime_unit_price_1'])){$GLOBALS['color_payment_normal_overtime_unit_price_1'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_contract_zangyo_unit_p21'] != com_db_number_format($a_result['payment_normal_overtime_unit_price_2'])){$GLOBALS['color_payment_normal_overtime_unit_price_2'] = $GLOBALS['color_diff'];}

    if ($GLOBALS['txt_syugyonisu_p12'] != $a_result['payment_middle_employment_day_1']){$GLOBALS['color_payment_middle_employment_day_1'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_syugyonisu_p22'] != $a_result['payment_middle_employment_day_2']){$GLOBALS['color_payment_middle_employment_day_2'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_zeneigyonisu_p12'] != $a_result['payment_middle_allbusiness_day_1']){$GLOBALS['color_payment_middle_allbusiness_day_1'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_zeneigyonisu_p22'] != $a_result['payment_middle_allbusiness_day_2']){$GLOBALS['color_payment_middle_allbusiness_day_2'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['opt_contract_calc_p12'] != $a_result['payment_middle_calculation_1']){$GLOBALS['color_payment_middle_calculation_1'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['opt_contract_calc_p22'] != $a_result['payment_middle_calculation_2']){$GLOBALS['color_payment_middle_calculation_2'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_tankin_p12'] != com_db_number_format($a_result['payment_middle_unit_price_1'])){$GLOBALS['color_payment_middle_unit_price_1'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_tankin_p22'] != com_db_number_format($a_result['payment_middle_unit_price_2'])){$GLOBALS['color_payment_middle_unit_price_2'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_contract_lower_limit_p12'] != $a_result['payment_middle_lower_limit_1']){$GLOBALS['color_payment_middle_lower_limit_1'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_contract_lower_limit_p22'] != $a_result['payment_middle_lower_limit_2']){$GLOBALS['color_payment_middle_lower_limit_2'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_contract_upper_limit_p12'] != $a_result['payment_middle_upper_limit_1']){$GLOBALS['color_payment_middle_upper_limit_1'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_contract_upper_limit_p22'] != $a_result['payment_middle_upper_limit_2']){$GLOBALS['color_payment_middle_upper_limit_2'] = $GLOBALS['color_diff'];}
    #echo "控除単価1=".$GLOBALS['txt_contract_kojyo_unit_p12'].",".com_db_number_format($a_result['payment_middle_deduction_unit_price_1'])."<br>";
    #echo "控除単価2=".$GLOBALS['txt_contract_kojyo_unit_p22'].",".com_db_number_format($a_result['payment_middle_deduction_unit_price_2'])."<br>";
    if ($GLOBALS['txt_contract_kojyo_unit_p12'] != com_db_number_format($a_result['payment_middle_deduction_unit_price_1'])){$GLOBALS['color_payment_middle_deduction_unit_price_1'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_contract_kojyo_unit_p22'] != com_db_number_format($a_result['payment_middle_deduction_unit_price_2'])){$GLOBALS['color_payment_middle_deduction_unit_price_2'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_contract_zangyo_unit_p12'] != com_db_number_format($a_result['payment_middle_overtime_unit_price_1'])){$GLOBALS['color_payment_middle_overtime_unit_price_1'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_contract_zangyo_unit_p22'] != com_db_number_format($a_result['payment_middle_overtime_unit_price_2'])){$GLOBALS['color_payment_middle_overtime_unit_price_2'] = $GLOBALS['color_diff'];}

    if ($GLOBALS['txt_syugyonisu_p13'] != $a_result['payment_leaving_employment_day_1']){$GLOBALS['color_payment_leaving_employment_day_1'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_syugyonisu_p23'] != $a_result['payment_leaving_employment_day_2']){$GLOBALS['color_payment_leaving_employment_day_2'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_zeneigyonisu_p13'] != $a_result['payment_leaving_allbusiness_day_1']){$GLOBALS['color_payment_leaving_allbusiness_day_1'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_zeneigyonisu_p23'] != $a_result['payment_leaving_allbusiness_day_2']){$GLOBALS['color_payment_leaving_allbusiness_day_2'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['opt_contract_calc_p13'] != $a_result['payment_leaving_calculation_1']){$GLOBALS['color_payment_leaving_calculation_1'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['opt_contract_calc_p23'] != $a_result['payment_leaving_calculation_2']){$GLOBALS['color_payment_leaving_calculation_2'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_tankin_p13'] != com_db_number_format($a_result['payment_leaving_unit_price_1'])){$GLOBALS['color_payment_leaving_unit_price_1'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_tankin_p23'] != com_db_number_format($a_result['payment_leaving_unit_price_2'])){$GLOBALS['color_payment_leaving_unit_price_2'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_contract_lower_limit_p13'] != $a_result['payment_leaving_lower_limit_1']){$GLOBALS['color_payment_leaving_lower_limit_1'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_contract_lower_limit_p23'] != $a_result['payment_leaving_lower_limit_2']){$GLOBALS['color_payment_leaving_lower_limit_2'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_contract_upper_limit_p13'] != $a_result['payment_leaving_upper_limit_1']){$GLOBALS['color_payment_leaving_upper_limit_1'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_contract_upper_limit_p23'] != $a_result['payment_leaving_upper_limit_2']){$GLOBALS['color_payment_leaving_upper_limit_2'] = $GLOBALS['color_diff'];}
    #echo "控除単価1=".$GLOBALS['txt_contract_kojyo_unit_p13'].",".com_db_number_format($a_result['payment_leaving_deduction_unit_price_1'])."<br>";
    #echo "控除単価2=".$GLOBALS['txt_contract_kojyo_unit_p23'].",".com_db_number_format($a_result['payment_leaving_deduction_unit_price_2'])."<br>";
    if ($GLOBALS['txt_contract_kojyo_unit_p13'] != com_db_number_format($a_result['payment_leaving_deduction_unit_price_1'])){$GLOBALS['color_payment_leaving_deduction_unit_price_1'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_contract_kojyo_unit_p23'] != com_db_number_format($a_result['payment_leaving_deduction_unit_price_2'])){$GLOBALS['color_payment_leaving_deduction_unit_price_2'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_contract_zangyo_unit_p13'] != com_db_number_format($a_result['payment_leaving_overtime_unit_price_1'])){$GLOBALS['color_payment_leaving_overtime_unit_price_1'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['txt_contract_zangyo_unit_p23'] != com_db_number_format($a_result['payment_leaving_overtime_unit_price_2'])){$GLOBALS['color_payment_leaving_overtime_unit_price_2'] = $GLOBALS['color_diff'];}

    if ($GLOBALS['opt_m_contract_time_inc_pd'] != $a_result['payment_hourly_daily']){$GLOBALS['color_payment_hourly_daily'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['opt_m_contract_time_inc_pm'] != $a_result['payment_hourly_monthly']){$GLOBALS['color_payment_hourly_monthly'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['opt_contract_tighten_p'] != $a_result['payment_settlement_closingday']){$GLOBALS['color_payment_settlement_closingday'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['opt_contract_pay_pay'] != $a_result['payment_settlement_paymentday']){$GLOBALS['color_payment_settlement_paymentday'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['opt_contract_yesno_p1'] != $a_result['payment_absence_deduction_subject']){$GLOBALS['color_payment_absence_deduction_subject'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['opt_contract_yesno_p2'] != $a_result['payment_quotation']){$GLOBALS['color_payment_quotation'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['opt_contract_yesno_p3'] != $a_result['payment_purchase_order']){$GLOBALS['color_payment_purchase_order'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['opt_contract_yesno_p4'] != $a_result['payment_confirmation_order']){$GLOBALS['color_payment_confirmation_order'] = $GLOBALS['color_diff'];}

    if ($GLOBALS['inp_wariai_nyujyo_c1'] != $a_result['payment_middle_daily_auto']){$GLOBALS['color_payment_middle_daily_auto'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['inp_wariai_nyujyo_c2'] != $a_result['payment_middle_daily_manual']){$GLOBALS['color_payment_middle_daily_manual'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['inp_wariai_taijyo_c1'] != $a_result['payment_leaving_daily_auto']){$GLOBALS['color_payment_leaving_daily_auto'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['inp_wariai_taijyo_c2'] != $a_result['payment_leaving_daily_manual']){$GLOBALS['color_payment_leaving_daily_manual'] = $GLOBALS['color_diff'];}

    if ($GLOBALS['contact_date_org'] != com_replace_toDate($a_result['contact_date_org'])){$GLOBALS['color_contact_date_org'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['organization'] != $a_result['organization']){$GLOBALS['color_organization'] = $GLOBALS['color_diff'];}
    if (($GLOBALS['dd_name'] != $a_result['dd_name']) || ($GLOBALS['dd_branch'] != $a_result['dd_branch'])){$GLOBALS['color_dd_name'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['dd_address'] != $a_result['dd_address']){$GLOBALS['color_dd_address'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['dd_tel'] != $a_result['dd_tel']){$GLOBALS['color_dd_tel'] = $GLOBALS['color_diff'];}
    if (($GLOBALS['ip_position'] != $a_result['ip_position']) || ($GLOBALS['ip_name'] != $a_result['ip_name'])){$GLOBALS['color_ip_position'] = $GLOBALS['color_diff'];}
    if (($GLOBALS['dm_responsible_position'] != $a_result['dm_responsible_position']) || ($GLOBALS['dm_responsible_name'] != $a_result['dm_responsible_name']) || ($GLOBALS['dm_responsible_tel'] != $a_result['dm_responsible_tel'])){$GLOBALS['color_dm_responsible_position'] = $GLOBALS['color_diff'];}
    if (($GLOBALS['dd_responsible_position'] != $a_result['dd_responsible_position']) || ($GLOBALS['dd_responsible_name'] != $a_result['dd_responsible_name']) || ($GLOBALS['dd_responsible_tel'] != $a_result['dd_responsible_tel'])){$GLOBALS['color_dd_responsible_position'] = $GLOBALS['color_diff'];}
    if (($GLOBALS['chs_position1'] != $a_result['chs_position1']) || ($GLOBALS['chs_name1'] != $a_result['chs_name1']) || ($GLOBALS['chs_tel1'] != $a_result['chs_tel1'])){$GLOBALS['color_chs_position1'] = $GLOBALS['color_diff'];}
    if (($GLOBALS['chs_position2'] != $a_result['chs_position2']) || ($GLOBALS['chs_name2'] != $a_result['chs_name2']) || ($GLOBALS['chs_tel2'] != $a_result['chs_tel2'])){$GLOBALS['color_chs_position2'] = $GLOBALS['color_diff'];}
    
    #$GLOBALS['status_cd'] != $a_result['status_cd'];
    #$GLOBALS['status_cd_num'] != $a_result['status_cd_num'];
    #$GLOBALS['reg_id'] != $a_result['reg_id'];
    #$GLOBALS['reg_person'] != $a_result['reg_person'];
    #$GLOBALS['upd_id'] != $a_result['upd_id'];
    if ($GLOBALS['upd_person'] != $a_result['upd_person']){$GLOBALS['color_upd_person'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['cnf_person'] != $a_result['cnf_person']){$GLOBALS['color_cnf_person'] = $GLOBALS['color_diff'];}

    if ($GLOBALS['claim_accounts_invoicing'] != $a_result['claim_accounts_invoicing']){$GLOBALS['color_claim_accounts_invoicing'] = $GLOBALS['color_diff'];}

    if ($GLOBALS['claim_normal_unit_price_base'] != com_db_number_format($a_result['claim_normal_unit_price_base'])){$GLOBALS['color_claim_normal_unit_price_base'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['claim_middle_unit_price_base'] != com_db_number_format($a_result['claim_middle_unit_price_base'])){$GLOBALS['color_claim_middle_unit_price_base'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['claim_leaving_unit_price_base'] != com_db_number_format($a_result['claim_leaving_unit_price_base'])){$GLOBALS['color_claim_leaving_unit_price_base'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['payment_normal_unit_price_1_base'] != com_db_number_format($a_result['payment_normal_unit_price_1_base'])){$GLOBALS['color_payment_normal_unit_price_1_base'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['payment_normal_unit_price_2_base'] != com_db_number_format($a_result['payment_normal_unit_price_2_base'])){$GLOBALS['color_payment_normal_unit_price_2_base'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['payment_middle_unit_price_1_base'] != com_db_number_format($a_result['payment_middle_unit_price_1_base'])){$GLOBALS['color_payment_middle_unit_price_1_base'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['payment_middle_unit_price_2_base'] != com_db_number_format($a_result['payment_middle_unit_price_2_base'])){$GLOBALS['color_payment_middle_unit_price_2_base'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['payment_leaving_unit_price_1_base'] != com_db_number_format($a_result['payment_leaving_unit_price_1_base'])){$GLOBALS['color_payment_leaving_unit_price_1_base'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['payment_leaving_unit_price_s_base'] != com_db_number_format($a_result['payment_leaving_unit_price_2_base'])){$GLOBALS['color_payment_leaving_unit_price_2_base'] = $GLOBALS['color_diff'];}
    
    #echo "給与計算=".$GLOBALS['file_payroll']."---".$a_result['file_payroll']."<br>";
    #echo "エビデンス=".$GLOBALS['file_evidence']."---".$a_result['file_evidence']."<br>";
    if ($GLOBALS['file_payroll'] != $a_result['file_payroll']){$GLOBALS['color_payroll'] = $GLOBALS['color_diff'];}
    if ($GLOBALS['file_evidence'] != $a_result['file_evidence']){$GLOBALS['color_evidence'] = $GLOBALS['color_diff'];}

}

#[2018.02.15]課題解決管理表No.99
function set_10105_fromDB_com($a_result)
{
    if ($GLOBALS['claim_normal_unit_price_base'] != ""){
        $GLOBALS['inp_tankin_b1'] = $GLOBALS['claim_normal_unit_price_base'];
    }
    if ($GLOBALS['claim_middle_unit_price_base'] != ""){
        $GLOBALS['txt_tankin_b2'] = $GLOBALS['claim_middle_unit_price_base'];
    }
    if ($GLOBALS['claim_leaving_unit_price_base'] != ""){
        $GLOBALS['txt_tankin_b3'] = $GLOBALS['claim_leaving_unit_price_base'];
    }
    if ($GLOBALS['payment_normal_unit_price_1_base'] != ""){
        $GLOBALS['txt_tankin_p11'] = $GLOBALS['payment_normal_unit_price_1_base'];
    }
    if ($GLOBALS['payment_normal_unit_price_2_base'] != ""){
        $GLOBALS['txt_tankin_p21'] = $GLOBALS['payment_normal_unit_price_2_base'];
    }
    if ($GLOBALS['payment_middle_unit_price_1_base'] != ""){
        $GLOBALS['txt_tankin_p12'] = $GLOBALS['payment_middle_unit_price_1_base'];
    }
    if ($GLOBALS['payment_middle_unit_price_2_base'] != ""){
        $GLOBALS['txt_tankin_p22'] = $GLOBALS['payment_middle_unit_price_2_base'];
    }
    if ($GLOBALS['payment_leaving_unit_price_1_base'] != ""){
        $GLOBALS['txt_tankin_p13'] = $GLOBALS['payment_leaving_unit_price_1_base'];
    }
    if ($GLOBALS['payment_leaving_unit_price_2_base'] != ""){
        $GLOBALS['txt_tankin_p23'] = $GLOBALS['payment_leaving_unit_price_2_base'];
    }
}

#[2018.02.15]課題解決管理表No.99
function set_10105_fromDB($a_result)
{
    $GLOBALS['opt_contarct_replace'] = $a_result['replace_person'];
    $GLOBALS['opt_contarct_end_status'] = $a_result['end_status'];
    $GLOBALS['inp_retire_date'] = str_replace("-", "/", $a_result['retire_date']);
    $GLOBALS['opt_contarct_insurance_crad'] = $a_result['insurance_crad'];
    $GLOBALS['opt_contarct_employ_insurance'] = $a_result['employ_insurance'];
    $GLOBALS['opt_contarct_end_reason1'] = $a_result['end_reason1'];
    $GLOBALS['opt_contarct_end_reason2'] = $a_result['end_reason2'];
    $GLOBALS['opt_contarct_end_reason3'] = $a_result['end_reason3'];
    $GLOBALS['inp_end_reason_detail'] = $a_result['end_reason_detail'];
    $GLOBALS['opt_contarct_from_now'] = $a_result['from_now'];
    $GLOBALS['opt_contarct_skill'] = $a_result['skill'];
    if ($GLOBALS['opt_contarct_end_status'] == ''){
        $GLOBALS['inp_biko'] = $a_result['remarks'];
        $GLOBALS['remarks2'] = $a_result['remarks2'];  #[2018.01.18]課題解決管理表No.92
    }else{
        $GLOBALS['inp_biko'] = $a_result['remarks_end'];
        $GLOBALS['remarks2'] = $a_result['remarks_end2'];  #[2018.01.18]課題解決管理表No.92
    }
    $GLOBALS['opt_contarct_conversation'] = $a_result['conversation'];
    $GLOBALS['opt_contarct_work_attitude'] = $a_result['work_attitude'];
    $GLOBALS['opt_contarct_personality'] = $a_result['personality'];
    $GLOBALS['opt_contarct_projects_confirm'] = $a_result['projects_confirm'];
    $GLOBALS['opt_contarct_engineer_list'] = $a_result['engineer_list'];
    if ($GLOBALS['opt_contarct_end_status'] == ''){
        $GLOBALS['remarks_pay'] = $a_result['remarks_pay'];
        $GLOBALS['remarks_pay2'] = $a_result['remarks_pay2'];  #[2018.01.18]課題解決管理表No.92
    }else{
        $GLOBALS['remarks_pay'] = $a_result['remarks_pay_end'];
        $GLOBALS['remarks_pay2'] = $a_result['remarks_pay_end2'];  #[2018.01.18]課題解決管理表No.92
    }

    # [2018.01.12]追加
    $GLOBALS['retirement_date'] = str_replace("-", "/", $a_result['retirement_date']);
    $GLOBALS['insurance_card_retirement'] = $a_result['insurance_card_retirement'];
    $GLOBALS['leave_date_start'] = str_replace("-", "/", $a_result['leave_date_start']);
    $GLOBALS['leave_date_end'] = str_replace("-", "/", $a_result['leave_date_end']);
    $GLOBALS['insurance_card_leave'] = $a_result['insurance_card_leave'];

    /*$reg_id = $a_result['reg_id'];
    $reg_person = $a_result['reg_person'];
    $upd_id = $a_result['upd_id'];
    $upd_person = $a_result['upd_person'];
    $cnf_person = $a_result['cnf_person'];*/

    $GLOBALS['cnf_person'] = $a_result['cnf_person_end'];
    
    #[2018.02.16]課題解決管理表No.99
    if ($GLOBALS['opt_contarct_end_status'] != ""){
        #終了レポートありの場合
        $GLOBALS['claim_normal_calculation_end'] = $a_result['claim_normal_calculation_end'];
        $GLOBALS['claim_normal_unit_price_end'] = $a_result['claim_normal_unit_price_end'];
        $GLOBALS['claim_normal_lower_limit_end'] = $a_result['claim_normal_lower_limit_end'];
        $GLOBALS['claim_normal_upper_limit_end'] = $a_result['claim_normal_upper_limit_end'];
        $GLOBALS['claim_normal_deduction_unit_price_end'] = $a_result['claim_normal_deduction_unit_price_end'];
        $GLOBALS['claim_normal_over_unit_price_end'] = $a_result['claim_normal_over_unit_price_end'];

        $GLOBALS['claim_leaving_employment_day_end'] = $a_result['claim_leaving_employment_day_end'];
        $GLOBALS['claim_leaving_allbusiness_day_end'] = $a_result['claim_leaving_allbusiness_day_end'];
        $GLOBALS['claim_leaving_calculation_end'] = $a_result['claim_leaving_calculation_end'];
        $GLOBALS['claim_leaving_unit_price_end'] = $a_result['claim_leaving_unit_price_end'];
        $GLOBALS['claim_leaving_lower_limit_end'] = $a_result['claim_leaving_lower_limit_end'];
        $GLOBALS['claim_leaving_upper_limit_end'] = $a_result['claim_leaving_upper_limit_end'];
        $GLOBALS['claim_leaving_deduction_unit_price_end'] = $a_result['claim_leaving_deduction_unit_price_end'];
        $GLOBALS['claim_leaving_over_unit_price_end'] = $a_result['claim_leaving_over_unit_price_end'];
        
        $GLOBALS['payment_normal_calculation_1_end'] = $a_result['payment_normal_calculation_1_end'];
        $GLOBALS['payment_normal_calculation_2_end'] = $a_result['payment_normal_calculation_2_end'];
        $GLOBALS['payment_normal_unit_price_1_end'] = $a_result['payment_normal_unit_price_1_end'];
        $GLOBALS['payment_normal_unit_price_2_end'] = $a_result['payment_normal_unit_price_2_end'];
        $GLOBALS['payment_normal_lower_limit_1_end'] = $a_result['payment_normal_lower_limit_1_end'];
        $GLOBALS['payment_normal_lower_limit_2_end'] = $a_result['payment_normal_lower_limit_2_end'];
        $GLOBALS['payment_normal_upper_limit_1_end'] = $a_result['payment_normal_upper_limit_1_end'];
        $GLOBALS['payment_normal_upper_limit_2_end'] = $a_result['payment_normal_upper_limit_2_end'];
        $GLOBALS['payment_normal_deduction_unit_price_1_end'] = $a_result['payment_normal_deduction_unit_price_1_end'];
        $GLOBALS['payment_normal_deduction_unit_price_2_end'] = $a_result['payment_normal_deduction_unit_price_2_end'];
        $GLOBALS['payment_normal_over_unit_price_1_end'] = $a_result['payment_normal_over_unit_price_1_end'];
        $GLOBALS['payment_normal_over_unit_price_2_end'] = $a_result['payment_normal_over_unit_price_2_end'];
        
        $GLOBALS['payment_leaving_employment_day_1_end'] = $a_result['payment_leaving_employment_day_1_end'];
        $GLOBALS['payment_leaving_employment_day_2_end'] = $a_result['payment_leaving_employment_day_2_end'];
        $GLOBALS['payment_leaving_allbusiness_day_1_end'] = $a_result['payment_leaving_allbusiness_day_1_end'];
        $GLOBALS['payment_leaving_allbusiness_day_2_end'] = $a_result['payment_leaving_allbusiness_day_2_end'];
        $GLOBALS['payment_leaving_calculation_1_end'] = $a_result['payment_leaving_calculation_1_end'];
        $GLOBALS['payment_leaving_calculation_2_end'] = $a_result['payment_leaving_calculation_2_end'];
        $GLOBALS['payment_leaving_unit_price_1_end'] = $a_result['payment_leaving_unit_price_1_end'];
        $GLOBALS['payment_leaving_unit_price_2_end'] = $a_result['payment_leaving_unit_price_2_end'];
        $GLOBALS['payment_leaving_lower_limit_1_end'] = $a_result['payment_leaving_lower_limit_1_end'];
        $GLOBALS['payment_leaving_lower_limit_2_end'] = $a_result['payment_leaving_lower_limit_2_end'];
        $GLOBALS['payment_leaving_upper_limit_1_end'] = $a_result['payment_leaving_upper_limit_1_end'];
        $GLOBALS['payment_leaving_upper_limit_2_end'] = $a_result['payment_leaving_upper_limit_2_end'];
        $GLOBALS['payment_leaving_deduction_unit_price_1_end'] = $a_result['payment_leaving_deduction_unit_price_1_end'];
        $GLOBALS['payment_leaving_deduction_unit_price_2_end'] = $a_result['payment_leaving_deduction_unit_price_2_end'];
        $GLOBALS['payment_leaving_over_unit_price_1_end'] = $a_result['payment_leaving_over_unit_price_1_end'];
        $GLOBALS['payment_leaving_over_unit_price_2_end'] = $a_result['payment_leaving_over_unit_price_2_end'];
    }else{
        #終了レポートなしの場合
        $GLOBALS['claim_normal_calculation_end'] = $GLOBALS['opt_contract_calc_b1'];
        $GLOBALS['claim_normal_unit_price_end'] = $GLOBALS['inp_tankin_b1'];
        $GLOBALS['claim_normal_lower_limit_end'] = $a_result['claim_normal_lower_limit'];
        $GLOBALS['claim_normal_upper_limit_end'] = $a_result['claim_normal_upper_limit'];
        $GLOBALS['claim_normal_deduction_unit_price_end'] = $GLOBALS['txt_contract_kojyo_unit_b1'];
        $GLOBALS['claim_normal_over_unit_price_end'] = $GLOBALS['txt_contract_zangyo_unit_b1'];

        $GLOBALS['claim_leaving_employment_day_end'] = $GLOBALS['inp_syugyonisu_b3'];
        $GLOBALS['claim_leaving_allbusiness_day_end'] = $GLOBALS['inp_zeneigyonisu_b3'];
        $GLOBALS['claim_leaving_calculation_end'] = $GLOBALS['opt_contract_calc_b3'];
        $GLOBALS['claim_leaving_unit_price_end'] = $GLOBALS['txt_tankin_b3'];
        $GLOBALS['claim_leaving_lower_limit_end'] = $a_result['claim_leaving_lower_limit'];
        $GLOBALS['claim_leaving_upper_limit_end'] = $a_result['claim_leaving_upper_limit'];
        $GLOBALS['claim_leaving_deduction_unit_price_end'] = $GLOBALS['txt_contract_kojyo_unit_b3'];
        $GLOBALS['claim_leaving_over_unit_price_end'] = $GLOBALS['txt_contract_zangyo_unit_b3'];
        
        $GLOBALS['payment_normal_calculation_1_end'] = $GLOBALS['opt_contract_calc_p11'];
        $GLOBALS['payment_normal_calculation_2_end'] = $GLOBALS['opt_contract_calc_p21'];
        $GLOBALS['payment_normal_unit_price_1_end'] = $GLOBALS['txt_tankin_p11'];
        $GLOBALS['payment_normal_unit_price_2_end'] = $GLOBALS['txt_tankin_p21'];
        $GLOBALS['payment_normal_lower_limit_1_end'] = $GLOBALS['txt_contract_lower_limit_p11'];
        $GLOBALS['payment_normal_lower_limit_2_end'] = $GLOBALS['txt_contract_lower_limit_p21'];
        $GLOBALS['payment_normal_upper_limit_1_end'] = $GLOBALS['txt_contract_upper_limit_p11'];
        $GLOBALS['payment_normal_upper_limit_2_end'] = $GLOBALS['txt_contract_upper_limit_p21'];
        $GLOBALS['payment_normal_deduction_unit_price_1_end'] = $GLOBALS['txt_contract_kojyo_unit_p11'];
        $GLOBALS['payment_normal_deduction_unit_price_2_end'] = $GLOBALS['txt_contract_kojyo_unit_p21'];
        $GLOBALS['payment_normal_over_unit_price_1_end'] = $GLOBALS['txt_contract_zangyo_unit_p11'];
        $GLOBALS['payment_normal_over_unit_price_2_end'] = $GLOBALS['txt_contract_zangyo_unit_p21'];
        
        $GLOBALS['payment_leaving_employment_day_1_end'] = $GLOBALS['txt_syugyonisu_p13'];
        $GLOBALS['payment_leaving_employment_day_2_end'] = $GLOBALS['txt_syugyonisu_p23'];
        $GLOBALS['payment_leaving_allbusiness_day_1_end'] = $GLOBALS['txt_zeneigyonisu_p13'];
        $GLOBALS['payment_leaving_allbusiness_day_2_end'] = $GLOBALS['txt_zeneigyonisu_p23'];
        $GLOBALS['payment_leaving_calculation_1_end'] = $GLOBALS['opt_contract_calc_p13'];
        $GLOBALS['payment_leaving_calculation_2_end'] = $GLOBALS['opt_contract_calc_p23'];
        $GLOBALS['payment_leaving_unit_price_1_end'] = $GLOBALS['txt_tankin_p13'];
        $GLOBALS['payment_leaving_unit_price_2_end'] = $GLOBALS['txt_tankin_p23'];
        $GLOBALS['payment_leaving_lower_limit_1_end'] = $GLOBALS['txt_contract_lower_limit_p13'];
        $GLOBALS['payment_leaving_lower_limit_2_end'] = $GLOBALS['txt_contract_lower_limit_p23'];
        $GLOBALS['payment_leaving_upper_limit_1_end'] = $GLOBALS['txt_contract_upper_limit_p13'];
        $GLOBALS['payment_leaving_upper_limit_2_end'] = $GLOBALS['txt_contract_upper_limit_p23'];
        $GLOBALS['payment_leaving_deduction_unit_price_1_end'] = $GLOBALS['txt_contract_kojyo_unit_p13'];
        $GLOBALS['payment_leaving_deduction_unit_price_2_end'] = $GLOBALS['txt_contract_kojyo_unit_p23'];
        $GLOBALS['payment_leaving_over_unit_price_1_end'] = $GLOBALS['txt_contract_zangyo_unit_p13'];
        $GLOBALS['payment_leaving_over_unit_price_2_end'] = $GLOBALS['txt_contract_zangyo_unit_p23'];
    }
    

    
}

?>
