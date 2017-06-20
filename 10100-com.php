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

function set_10100_selectDB()
{
    $a_sql_src = "SELECT t1.*";
    $a_sql_src .= ",(SELECT idx FROM ".$GLOBALS['g_DB_m_contract_status']." WHERE (m_name=t1.status_cd)) AS status_cd_num";
    $a_sql_src .= ",(SELECT person FROM ".$GLOBALS['g_DB_m_user']." WHERE (idx=t1.reg_id)) AS reg_person";
    $a_sql_src .= ",(SELECT person FROM ".$GLOBALS['g_DB_m_user']." WHERE (idx=t1.upd_id)) AS upd_person";
    $a_sql_src .= ",(SELECT person FROM ".$GLOBALS['g_DB_m_user']." WHERE (idx=t1.cnf_id)) AS cnf_person";
    $a_sql_src .= " FROM ".$GLOBALS['g_DB_t_contract_report']." t1";
    
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
    $GLOBALS['inp_tankin_b1'] = $a_result['claim_normal__unit_price'];
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

}

?>
