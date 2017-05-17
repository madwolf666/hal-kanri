<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./global.php');

$a_sRet = '';

//POST情報取得
$a_act = $_POST['act'];

try{
    //DBからユーザ情報取得
    $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
    $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($a_act == 'n'){
        $a_sql = "INSERT INTO ".$GLOBALS['g_DB_t_contract_report']." (";
        $a_sql .= "
            customer_name
            ,subject
            ,claim_contract_form
            ,workplace
            ,work_start
            ,work_end
            ,work_hours
            ,break_start
            ,break_end
            ,break_hours
            ,customer_department_charge
            ,customer_charge_name
            ,customer_clerk_charge
            ,charge_position
            ,contact_phone_number
            ,claim_agreement_start
            ,claim_agreement_end
            ,claim_normal_calculation
            ,claim_normal__unit_price
            ,claim_normal_lower_limit
            ,claim_normal_upper_limit
            ,claim_normal_deduction_unit_price_truncation_unit
            ,claim_normal_deduction_unit_price
            ,claim_normal_overtime_unit_price_truncation_unit
            ,claim_normal_overtime_unit_price
            ,claim_middle_employment_day
            ,claim_middle_allbusiness_day
            ,claim_middle_calculation
            ,claim_middle_unit_price
            ,claim_middle_lower_limit
            ,claim_middle_upper_limit
            ,claim_middle_deduction_unit_price
            ,claim_middle_overtime_unit_price
            ,claim_leaving_employment_day
            ,claim_leaving_allbusiness_day
            ,claim_leaving_calculation
            ,claim_leaving_unit_price
            ,claim_leaving_lower_limit
            ,claim_leaving_upper_limit
            ,claim_leaving_deduction_unit_price
            ,claim_leaving_overtime_unit_price
            ,claim_hourly_daily
            ,claim_hourly_monthly
            ,claim_settlement_closingday
            ,claim_settlement_paymentday
            ,claim_dispatch_individual_contract
            ,claim_quotation
            ,claim_purchase_order
            ,claim_confirmation_order
            ,remarks
            ,new_or_continued
            ,contract_number
            ,publication
            ,author
            ,sales_representative
            ,engineer_number
            ,engineer_name
            ,engneer_name_phonetic
            ,business_name
            ,payment_contract_form
            ,business_name_phonetic
            ,business_charge_name
            ,social_insurance
            ,tax_withholding
            ,payment_agreement_start
            ,payment_agreement_end
            ,redemption_ratio
            ,payment_normal_calculation_1
            ,payment_normal_calculation_2
            ,payment_normal_unit_price_1
            ,payment_normal_unit_price_2
            ,payment_normal_lower_limit_1
            ,payment_normal_lower_limit_2
            ,payment_normal_upper_limit_1
            ,payment_normal_upper_limit_2
            ,payment_normal_deduction_unit_price_1
            ,payment_normal_deduction_unit_price_2
            ,payment_normal_overtime_unit_price_1
            ,payment_normal_overtime_unit_price_2
            ,payment_middle_employment_day_1
            ,payment_middle_employment_day_2
            ,payment_middle_allbusiness_day_1
            ,payment_middle_allbusiness_day_2
            ,payment_middle_calculation_1
            ,payment_middle_calculation_2
            ,payment_middle_unit_price_1
            ,payment_middle_unit_price_2
            ,payment_middle_lower_limit_1
            ,payment_middle_lower_limit_2
            ,payment_middle_upper_limit_1
            ,payment_middle_upper_limit_2
            ,payment_middle_deduction_unit_price_1
            ,payment_middle_deduction_unit_price_2
            ,payment_middle_overtime_unit_price_1
            ,payment_middle_overtime_unit_price_2
            ,payment_leaving_employment_day_1
            ,payment_leaving_employment_day_2
            ,payment_leaving_allbusiness_day_1
            ,payment_leaving_allbusiness_day_2
            ,payment_leaving_calculation_1
            ,payment_leaving_calculation_2
            ,payment_leaving_unit_price_1
            ,payment_leaving_unit_price_2
            ,payment_leaving_lower_limit_1
            ,payment_leaving_lower_limit_2
            ,payment_leaving_upper_limit_1
            ,payment_leaving_upper_limit_2
            ,payment_leaving_deduction_unit_price_1
            ,payment_leaving_deduction_unit_price_2
            ,payment_leaving_overtime_unit_price_1
            ,payment_leaving_overtime_unit_price_2
            ,payment_hourly_daily
            ,payment_hourly_monthly
            ,payment_settlement_closingday
            ,payment_settlement_paymentday
            ,payment_absence_deduction_subject
            ,payment_quotation
            ,payment_purchase_order
            ,payment_confirmation_order
            ,payment_middle_daily_auto
            ,payment_middle_daily_manual
            ,payment_leaving_daily_auto
            ,payment_leaving_daily_manual
            ";
        $a_sql .= ") VALUES(";
        $a_sql .= "
            :customer_name
            ,:subject
            ,:claim_contract_form
            ,:workplace
            ,:work_start
            ,:work_end
            ,:work_hours
            ,:break_start
            ,:break_end
            ,:break_hours
            ,:customer_department_charge
            ,:customer_charge_name
            ,:customer_clerk_charge
            ,:charge_position
            ,:contact_phone_number
            ,:claim_agreement_start
            ,:claim_agreement_end
            ,:claim_normal_calculation
            ,:claim_normal__unit_price
            ,:claim_normal_lower_limit
            ,:claim_normal_upper_limit
            ,:claim_normal_deduction_unit_price_truncation_unit
            ,:claim_normal_deduction_unit_price
            ,:claim_normal_overtime_unit_price_truncation_unit
            ,:claim_normal_overtime_unit_price
            ,:claim_middle_employment_day
            ,:claim_middle_allbusiness_day
            ,:claim_middle_calculation
            ,:claim_middle_unit_price
            ,:claim_middle_lower_limit
            ,:claim_middle_upper_limit
            ,:claim_middle_deduction_unit_price
            ,:claim_middle_overtime_unit_price
            ,:claim_leaving_employment_day
            ,:claim_leaving_allbusiness_day
            ,:claim_leaving_calculation
            ,:claim_leaving_unit_price
            ,:claim_leaving_lower_limit
            ,:claim_leaving_upper_limit
            ,:claim_leaving_deduction_unit_price
            ,:claim_leaving_overtime_unit_price
            ,:claim_hourly_daily
            ,:claim_hourly_monthly
            ,:claim_settlement_closingday
            ,:claim_settlement_paymentday
            ,:claim_dispatch_individual_contract
            ,:claim_quotation
            ,:claim_purchase_order
            ,:claim_confirmation_order
            ,:remarks
            ,:new_or_continued
            ,:contract_number
            ,:publication
            ,:author
            ,:sales_representative
            ,:engineer_number
            ,:engineer_name
            ,:engneer_name_phonetic
            ,:business_name
            ,:payment_contract_form
            ,:business_name_phonetic
            ,:business_charge_name
            ,:social_insurance
            ,:tax_withholding
            ,:payment_agreement_start
            ,:payment_agreement_end
            ,:redemption_ratio
            ,:payment_normal_calculation_1
            ,:payment_normal_calculation_2
            ,:payment_normal_unit_price_1
            ,:payment_normal_unit_price_2
            ,:payment_normal_lower_limit_1
            ,:payment_normal_lower_limit_2
            ,:payment_normal_upper_limit_1
            ,:payment_normal_upper_limit_2
            ,:payment_normal_deduction_unit_price_1
            ,:payment_normal_deduction_unit_price_2
            ,:payment_normal_overtime_unit_price_1
            ,:payment_normal_overtime_unit_price_2
            ,:payment_middle_employment_day_1
            ,:payment_middle_employment_day_2
            ,:payment_middle_allbusiness_day_1
            ,:payment_middle_allbusiness_day_2
            ,:payment_middle_calculation_1
            ,:payment_middle_calculation_2
            ,:payment_middle_unit_price_1
            ,:payment_middle_unit_price_2
            ,:payment_middle_lower_limit_1
            ,:payment_middle_lower_limit_2
            ,:payment_middle_upper_limit_1
            ,:payment_middle_upper_limit_2
            ,:payment_middle_deduction_unit_price_1
            ,:payment_middle_deduction_unit_price_2
            ,:payment_middle_overtime_unit_price_1
            ,:payment_middle_overtime_unit_price_2
            ,:payment_leaving_employment_day_1
            ,:payment_leaving_employment_day_2
            ,:payment_leaving_allbusiness_day_1
            ,:payment_leaving_allbusiness_day_2
            ,:payment_leaving_calculation_1
            ,:payment_leaving_calculation_2
            ,:payment_leaving_unit_price_1
            ,:payment_leaving_unit_price_2
            ,:payment_leaving_lower_limit_1
            ,:payment_leaving_lower_limit_2
            ,:payment_leaving_upper_limit_1
            ,:payment_leaving_upper_limit_2
            ,:payment_leaving_deduction_unit_price_1
            ,:payment_leaving_deduction_unit_price_2
            ,:payment_leaving_overtime_unit_price_1
            ,:payment_leaving_overtime_unit_price_2
            ,:payment_hourly_daily
            ,:payment_hourly_monthly
            ,:payment_settlement_closingday
            ,:payment_settlement_paymentday
            ,:payment_absence_deduction_subject
            ,:payment_quotation
            ,:payment_purchase_order
            ,:payment_confirmation_order
            ,:payment_middle_daily_auto
            ,:payment_middle_daily_manual
            ,:payment_leaving_daily_auto
            ,:payment_leaving_daily_manual
            ";
        $a_sql .= ");";
    }else{
        $a_sql = "UPDATE ".$GLOBALS['g_DB_t_contract_report']." SET ";
        $a_sql .= "
            customer_name=:customer_name
            ,subject=:subject
            ,claim_contract_form=:claim_contract_form
            ,workplace=:workplace
            ,work_start=:work_start
            ,work_end=:work_end
            ,work_hours=:work_hours
            ,break_start=:break_start
            ,break_end=:break_end
            ,break_hours=:break_hours
            ,customer_department_charge=:customer_department_charge
            ,customer_charge_name=:customer_charge_name
            ,customer_clerk_charge=:customer_clerk_charge
            ,charge_position=:charge_position
            ,contact_phone_number=:contact_phone_number
            ,claim_agreement_start=:claim_agreement_start
            ,claim_agreement_end=:claim_agreement_end
            ,claim_normal_calculation=:claim_normal_calculation
            ,claim_normal__unit_price=:claim_normal__unit_price
            ,claim_normal_lower_limit=:claim_normal_lower_limit
            ,claim_normal_upper_limit=:claim_normal_upper_limit
            ,claim_normal_deduction_unit_price_truncation_unit=:claim_normal_deduction_unit_price_truncation_unit
            ,claim_normal_deduction_unit_price=:claim_normal_deduction_unit_price
            ,claim_normal_overtime_unit_price_truncation_unit=:claim_normal_overtime_unit_price_truncation_unit
            ,claim_normal_overtime_unit_price=:claim_normal_overtime_unit_price
            ,claim_middle_employment_day=:claim_middle_employment_day
            ,claim_middle_allbusiness_day=:claim_middle_allbusiness_day
            ,claim_middle_calculation=:claim_middle_calculation
            ,claim_middle_unit_price=:claim_middle_unit_price
            ,claim_middle_lower_limit=:claim_middle_lower_limit
            ,claim_middle_upper_limit=:claim_middle_upper_limit
            ,claim_middle_deduction_unit_price=:claim_middle_deduction_unit_price
            ,claim_middle_overtime_unit_price=:claim_middle_overtime_unit_price
            ,claim_leaving_employment_day=:claim_leaving_employment_day
            ,claim_leaving_allbusiness_day=:claim_leaving_allbusiness_day
            ,claim_leaving_calculation=:claim_leaving_calculation
            ,claim_leaving_unit_price=:claim_leaving_unit_price
            ,claim_leaving_lower_limit=:claim_leaving_lower_limit
            ,claim_leaving_upper_limit=:claim_leaving_upper_limit
            ,claim_leaving_deduction_unit_price=:claim_leaving_deduction_unit_price
            ,claim_leaving_overtime_unit_price=:claim_leaving_overtime_unit_price
            ,claim_hourly_daily=:claim_hourly_daily
            ,claim_hourly_monthly=:claim_hourly_monthly
            ,claim_settlement_closingday=:claim_settlement_closingday
            ,claim_settlement_paymentday=:claim_settlement_paymentday
            ,claim_dispatch_individual_contract=:claim_dispatch_individual_contract
            ,claim_quotation=:claim_quotation
            ,claim_purchase_order=:claim_purchase_order
            ,claim_confirmation_order=:claim_confirmation_order
            ,remarks=:remarks
            ,new_or_continued=:new_or_continued
            ,contract_number=:contract_number
            ,publication=:publication
            ,author=:author
            ,sales_representative=:sales_representative
            ,engineer_number=:engineer_number
            ,engineer_name=:engineer_name
            ,engneer_name_phonetic=:engneer_name_phonetic
            ,business_name=:business_name
            ,payment_contract_form=:payment_contract_form
            ,business_name_phonetic=:business_name_phonetic
            ,business_charge_name=:business_charge_name
            ,social_insurance=:social_insurance
            ,tax_withholding=:tax_withholding
            ,payment_agreement_start=:payment_agreement_start
            ,payment_agreement_end=:payment_agreement_end
            ,redemption_ratio=:redemption_ratio
            ,payment_normal_calculation_1=:payment_normal_calculation_1
            ,payment_normal_calculation_2=:payment_normal_calculation_2
            ,payment_normal_unit_price_1=:payment_normal_unit_price_1
            ,payment_normal_unit_price_2=:payment_normal_unit_price_2
            ,payment_normal_lower_limit_1=:payment_normal_lower_limit_1
            ,payment_normal_lower_limit_2=:payment_normal_lower_limit_2
            ,payment_normal_upper_limit_1=:payment_normal_upper_limit_1
            ,payment_normal_upper_limit_2=:payment_normal_upper_limit_2
            ,payment_normal_deduction_unit_price_1=:payment_normal_deduction_unit_price_1
            ,payment_normal_deduction_unit_price_2=:payment_normal_deduction_unit_price_2
            ,payment_normal_overtime_unit_price_1=:payment_normal_overtime_unit_price_1
            ,payment_normal_overtime_unit_price_2=:payment_normal_overtime_unit_price_2
            ,payment_middle_employment_day_1=:payment_middle_employment_day_1
            ,payment_middle_employment_day_2=:payment_middle_employment_day_2
            ,payment_middle_allbusiness_day_1=:payment_middle_allbusiness_day_1
            ,payment_middle_allbusiness_day_2=:payment_middle_allbusiness_day_2
            ,payment_middle_calculation_1=:payment_middle_calculation_1
            ,payment_middle_calculation_2=:payment_middle_calculation_2
            ,payment_middle_unit_price_1=:payment_middle_unit_price_1
            ,payment_middle_unit_price_2=:payment_middle_unit_price_2
            ,payment_middle_lower_limit_1=:payment_middle_lower_limit_1
            ,payment_middle_lower_limit_2=:payment_middle_lower_limit_2
            ,payment_middle_upper_limit_1=:payment_middle_upper_limit_1
            ,payment_middle_upper_limit_2=:payment_middle_upper_limit_2
            ,payment_middle_deduction_unit_price_1=:payment_middle_deduction_unit_price_1
            ,payment_middle_deduction_unit_price_2=:payment_middle_deduction_unit_price_2
            ,payment_middle_overtime_unit_price_1=:payment_middle_overtime_unit_price_1
            ,payment_middle_overtime_unit_price_2=:payment_middle_overtime_unit_price_2
            ,payment_leaving_employment_day_1=:payment_leaving_employment_day_1
            ,payment_leaving_employment_day_2=:payment_leaving_employment_day_2
            ,payment_leaving_allbusiness_day_1=:payment_leaving_allbusiness_day_1
            ,payment_leaving_allbusiness_day_2=:payment_leaving_allbusiness_day_2
            ,payment_leaving_calculation_1=:payment_leaving_calculation_1
            ,payment_leaving_calculation_2=:payment_leaving_calculation_2
            ,payment_leaving_unit_price_1=:payment_leaving_unit_price_1
            ,payment_leaving_unit_price_2=:payment_leaving_unit_price_2
            ,payment_leaving_lower_limit_1=:payment_leaving_lower_limit_1
            ,payment_leaving_lower_limit_2=:payment_leaving_lower_limit_2
            ,payment_leaving_upper_limit_1=:payment_leaving_upper_limit_1
            ,payment_leaving_upper_limit_2=:payment_leaving_upper_limit_2
            ,payment_leaving_deduction_unit_price_1=:payment_leaving_deduction_unit_price_1
            ,payment_leaving_deduction_unit_price_2=:payment_leaving_deduction_unit_price_2
            ,payment_leaving_overtime_unit_price_1=:payment_leaving_overtime_unit_price_1
            ,payment_leaving_overtime_unit_price_2=:payment_leaving_overtime_unit_price_2
            ,payment_hourly_daily=:payment_hourly_daily
            ,payment_hourly_monthly=:payment_hourly_monthly
            ,payment_settlement_closingday=:payment_settlement_closingday
            ,payment_settlement_paymentday=:payment_settlement_paymentday
            ,payment_absence_deduction_subject=:payment_absence_deduction_subject
            ,payment_quotation=:payment_quotation
            ,payment_purchase_order=:payment_purchase_order
            ,payment_confirmation_order=:payment_confirmation_order
            ,payment_middle_daily_auto=:payment_middle_daily_auto
            ,payment_middle_daily_manual=:payment_middle_daily_manual
            ,payment_leaving_daily_auto=:payment_leaving_daily_auto
            ,payment_leaving_daily_manual=:payment_leaving_daily_manual
            ";
        $a_sql .= " WHERE (cr_id=:cr_id);";
    }
    
    $a_stmt = $a_conn->prepare($a_sql);

    $a_stmt->bindParam(':customer_name', $_POST['inp_kyakusaki'], PDO::PARAM_STR);
    $a_stmt->bindParam(':subject', $_POST['inp_kenmei'], PDO::PARAM_STR);
    $a_stmt->bindParam(':claim_contract_form', $_POST['opt_contarct_bill_form'], PDO::PARAM_STR);
    $a_stmt->bindParam(':workplace', $_POST['inp_sagyo_basyo'], PDO::PARAM_STR);
    $a_stmt->bindParam(':work_start', $_POST['inp_kaishi1'], PDO::PARAM_STR);
    $a_stmt->bindParam(':work_end', $_POST['inp_syuryo1'], PDO::PARAM_STR);
    $a_stmt->bindParam(':work_hours', $_POST['txt_sagyo_jikan'], PDO::PARAM_STR);
    $a_stmt->bindParam(':break_start', $_POST['inp_kaishi2'], PDO::PARAM_STR);
    $a_stmt->bindParam(':break_end', $_POST['inp_syuryo2'], PDO::PARAM_STR);
    $a_stmt->bindParam(':break_hours', $_POST['txt_kyukei_jikan'], PDO::PARAM_STR);
    
    $a_stmt->bindParam(':customer_department_charge', $_POST['inp_kyakusaki_busyo'], PDO::PARAM_STR);
    $a_stmt->bindParam(':customer_charge_name', $_POST['inp_kyakusaki_tantosya'], PDO::PARAM_STR);
    $a_stmt->bindParam(':customer_clerk_charge', $_POST['inp_kyakusaki_jimutantosya'], PDO::PARAM_STR);
    $a_stmt->bindParam(':charge_position', $_POST['inp_kyakusaki_yakusyoku'], PDO::PARAM_STR);
    $a_stmt->bindParam(':contact_phone_number', $_POST['inp_kyakusaki_tel'], PDO::PARAM_STR);
    com_pdo_bindValue($a_stmt, ':claim_agreement_start', $_POST['inp_kyakusaki_kaishi']);
    com_pdo_bindValue($a_stmt, ':claim_agreement_end', $_POST['inp_kyakusaki_syuryo']);
    
    $a_stmt->bindParam(':claim_normal_calculation', $_POST['opt_contract_calc_b1'], PDO::PARAM_STR);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['inp_tankin_b1']));
    //$inp_tankin_b1 = $a_val;
    //$a_stmt->bindParam(':claim_normal__unit_price', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':claim_normal__unit_price', $a_val);
    $a_stmt->bindParam(':claim_normal_lower_limit', $_POST['opt_contract_lower_limit_b1'], PDO::PARAM_STR);
    $a_stmt->bindParam(':claim_normal_upper_limit', $_POST['opt_contract_upper_limit_b1'], PDO::PARAM_STR);
    $a_stmt->bindParam(':claim_normal_deduction_unit_price_truncation_unit', $_POST['opt_contract_trunc_unit_kojyo'], PDO::PARAM_STR);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['txt_contract_kojyo_unit_b1']));
    //$a_stmt->bindParam(':claim_normal_deduction_unit_price', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':claim_normal_deduction_unit_price', $a_val);
    $a_stmt->bindParam(':claim_normal_overtime_unit_price_truncation_unit', $_POST['opt_contract_trunc_unit_zangyo'], PDO::PARAM_STR);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['txt_contract_zangyo_unit_b1']));
    //$a_stmt->bindParam(':claim_normal_overtime_unit_price', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':claim_normal_overtime_unit_price', $a_val);
    
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['inp_syugyonisu_b2']));
    //$a_stmt->bindParam(':claim_middle_employment_day', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':claim_middle_employment_day', $a_val);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['inp_zeneigyonisu_b2']));
    //$a_stmt->bindParam(':claim_middle_allbusiness_day', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':claim_middle_allbusiness_day', $a_val);
    $a_stmt->bindParam(':claim_middle_calculation', $_POST['opt_contract_calc_b2'], PDO::PARAM_STR);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['txt_tankin_b2']));
    //$a_stmt->bindParam(':claim_middle_unit_price', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':claim_middle_unit_price', $a_val);
    $a_stmt->bindParam(':claim_middle_lower_limit', $_POST['opt_contract_lower_limit_b2'], PDO::PARAM_STR);
    $a_stmt->bindParam(':claim_middle_upper_limit', $_POST['opt_contract_upper_limit_b2'], PDO::PARAM_STR);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['txt_contract_kojyo_unit_b2']));
    //$a_stmt->bindParam(':claim_middle_deduction_unit_price', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':claim_middle_deduction_unit_price', $a_val);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['txt_contract_zangyo_unit_b2']));
    //$a_stmt->bindParam(':claim_middle_overtime_unit_price', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':claim_middle_overtime_unit_price', $a_val);
    
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['inp_syugyonisu_b3']));
    //$a_stmt->bindParam(':claim_leaving_employment_day', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':claim_leaving_employment_day', $a_val);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['inp_zeneigyonisu_b3']));
    //$a_stmt->bindParam(':claim_leaving_allbusiness_day', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':claim_leaving_allbusiness_day', $a_val);
    $a_stmt->bindParam(':claim_leaving_calculation', $_POST['opt_contract_calc_b3'], PDO::PARAM_STR);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['txt_tankin_b3']));
    //$a_stmt->bindParam(':claim_leaving_unit_price', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':claim_leaving_unit_price', $a_val);
    $a_stmt->bindParam(':claim_leaving_lower_limit', $_POST['opt_contract_lower_limit_b3'], PDO::PARAM_STR);
    $a_stmt->bindParam(':claim_leaving_upper_limit', $_POST['opt_contract_upper_limit_b3'], PDO::PARAM_STR);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['txt_contract_kojyo_unit_b3']));
    //$a_stmt->bindParam(':claim_leaving_deduction_unit_price', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':claim_leaving_deduction_unit_price', $a_val);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['txt_contract_zangyo_unit_b3']));
    //$a_stmt->bindParam(':claim_leaving_overtime_unit_price', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':claim_leaving_overtime_unit_price', $a_val);
    
    $a_stmt->bindParam(':claim_hourly_daily', $_POST['opt_m_contract_time_inc_bd'], PDO::PARAM_STR);
    $a_stmt->bindParam(':claim_hourly_monthly', $_POST['opt_m_contract_time_inc_bm'], PDO::PARAM_STR);
    $a_stmt->bindParam(':claim_settlement_closingday', $_POST['opt_contract_tighten_b'], PDO::PARAM_STR);
    $a_stmt->bindParam(':claim_settlement_paymentday', $_POST['opt_contract_bill_pay'], PDO::PARAM_STR);
    $a_stmt->bindParam(':claim_dispatch_individual_contract', $_POST['opt_m_contract_yesno_b1'], PDO::PARAM_STR);
    $a_stmt->bindParam(':claim_quotation', $_POST['opt_m_contract_yesno_b2'], PDO::PARAM_STR);
    $a_stmt->bindParam(':claim_purchase_order', $_POST['opt_m_contract_yesno_b3'], PDO::PARAM_STR);
    $a_stmt->bindParam(':claim_confirmation_order', $_POST['opt_m_contract_yesno_b4'], PDO::PARAM_STR);
    $a_stmt->bindParam(':remarks', $_POST['inp_biko'], PDO::PARAM_STR);
    
    $a_stmt->bindParam(':new_or_continued', $_POST['opt_contract_kind'], PDO::PARAM_STR);
    //if ($a_act == 'n'){
        $a_stmt->bindParam(':contract_number', $_POST['inp_keiyaku_no'], PDO::PARAM_STR);
    //}
    com_pdo_bindValue($a_stmt, ':publication', $_POST['inp_hakkobi']);
    $a_stmt->bindParam(':author', $_POST['inp_sakuseisya'], PDO::PARAM_STR);
    $a_val = "";    //変数として代入しないとNGとなる
    $a_stmt->bindParam(':sales_representative', $a_val, PDO::PARAM_STR);
    $a_stmt->bindParam(':engineer_number', $_POST['inp_engineer_no'], PDO::PARAM_STR);
    $a_stmt->bindParam(':engineer_name', $_POST['txt_engineer_name'], PDO::PARAM_STR);
    $a_stmt->bindParam(':engneer_name_phonetic', $_POST['txt_engineer_kana'], PDO::PARAM_STR);
    $a_stmt->bindParam(':business_name', $_POST['txt_jigyosya_name'], PDO::PARAM_STR);
    $a_stmt->bindParam(':payment_contract_form', $_POST['opt_contract_pay_form'], PDO::PARAM_STR);
    $a_stmt->bindParam(':business_name_phonetic', $_POST['txt_jigyosya_kana'], PDO::PARAM_STR);
    $a_stmt->bindParam(':business_charge_name', $_POST['inp_jigyosya_tanto'], PDO::PARAM_STR);
    $a_stmt->bindParam(':social_insurance', $_POST['opt_social_insurance'], PDO::PARAM_STR);
    $a_stmt->bindParam(':tax_withholding', $_POST['opt_tax_withholding'], PDO::PARAM_STR);
    com_pdo_bindValue($a_stmt, ':payment_agreement_start', $_POST['txt_kyakusaki_kaishi']);
    com_pdo_bindValue($a_stmt, ':payment_agreement_end', $_POST['txt_kyakusaki_syuryo']);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['opt_contract_reduction']));
    //$a_stmt->bindParam(':redemption_ratio', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':redemption_ratio', $a_val);
    
    $a_stmt->bindParam(':payment_normal_calculation_1', $_POST['opt_contract_calc_p11'], PDO::PARAM_STR);
    $a_stmt->bindParam(':payment_normal_calculation_2', $_POST['opt_contract_calc_p21'], PDO::PARAM_STR);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['txt_tankin_p11']));
    //$a_stmt->bindParam(':payment_normal_unit_price_1', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':payment_normal_unit_price_1', $a_val);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['txt_tankin_p21']));
    //$a_stmt->bindParam(':payment_normal_unit_price_2', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':payment_normal_unit_price_2', $a_val);
    $a_stmt->bindParam(':payment_normal_lower_limit_1', $_POST['txt_contract_lower_limit_p11'], PDO::PARAM_STR);
    $a_stmt->bindParam(':payment_normal_lower_limit_2', $_POST['txt_contract_lower_limit_p21'], PDO::PARAM_STR);
    $a_stmt->bindParam(':payment_normal_upper_limit_1', $_POST['txt_contract_upper_limit_p11'], PDO::PARAM_STR);
    $a_stmt->bindParam(':payment_normal_upper_limit_2', $_POST['txt_contract_upper_limit_p21'], PDO::PARAM_STR);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['txt_contract_kojyo_unit_p11']));
    //$a_stmt->bindParam(':payment_normal_deduction_unit_price_1', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':payment_normal_deduction_unit_price_1', $a_val);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['txt_contract_kojyo_unit_p21']));
    //$a_stmt->bindParam(':payment_normal_deduction_unit_price_2', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':payment_normal_deduction_unit_price_2', $a_val);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['txt_contract_zangyo_unit_p11']));
    //$a_stmt->bindParam(':payment_normal_overtime_unit_price_1', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':payment_normal_overtime_unit_price_1', $a_val);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['txt_contract_zangyo_unit_p21']));
    //$a_stmt->bindParam(':payment_normal_overtime_unit_price_2', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':payment_normal_overtime_unit_price_2', $a_val);
    
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['txt_syugyonisu_p12']));
    //$a_stmt->bindParam(':payment_middle_employment_day_1', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':payment_middle_employment_day_1', $a_val);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['txt_syugyonisu_p22']));
    //$a_stmt->bindParam(':payment_middle_employment_day_2', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':payment_middle_employment_day_2', $a_val);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['txt_zeneigyonisu_p12']));
    //$a_stmt->bindParam(':payment_middle_allbusiness_day_1', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':payment_middle_allbusiness_day_1', $a_val);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['txt_zeneigyonisu_p22']));
    //$a_stmt->bindParam(':payment_middle_allbusiness_day_2', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':payment_middle_allbusiness_day_2', $a_val);
    $a_stmt->bindParam(':payment_middle_calculation_1', $_POST['opt_contract_calc_p12'], PDO::PARAM_STR);
    $a_stmt->bindParam(':payment_middle_calculation_2', $_POST['opt_contract_calc_p22'], PDO::PARAM_STR);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['txt_tankin_p12']));
    //$a_stmt->bindParam(':payment_middle_unit_price_1', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':payment_middle_unit_price_1', $a_val);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['txt_tankin_p22']));
    //$a_stmt->bindParam(':payment_middle_unit_price_2', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':payment_middle_unit_price_2', $a_val);
    $a_stmt->bindParam(':payment_middle_lower_limit_1', $_POST['txt_contract_lower_limit_p12'], PDO::PARAM_STR);
    $a_stmt->bindParam(':payment_middle_lower_limit_2', $_POST['txt_contract_lower_limit_p22'], PDO::PARAM_STR);
    $a_stmt->bindParam(':payment_middle_upper_limit_1', $_POST['txt_contract_upper_limit_p12'], PDO::PARAM_STR);
    $a_stmt->bindParam(':payment_middle_upper_limit_2', $_POST['txt_contract_upper_limit_p22'], PDO::PARAM_STR);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['txt_contract_kojyo_unit_p12']));
    //$a_stmt->bindParam(':payment_middle_deduction_unit_price_1', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':payment_middle_deduction_unit_price_1', $a_val);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['txt_contract_kojyo_unit_p22']));
    //$a_stmt->bindParam(':payment_middle_deduction_unit_price_2', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':payment_middle_deduction_unit_price_2', $a_val);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['txt_contract_zangyo_unit_p12']));
    //$a_stmt->bindParam(':payment_middle_overtime_unit_price_1', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':payment_middle_overtime_unit_price_1', $a_val);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['txt_contract_zangyo_unit_p22']));
    //$a_stmt->bindParam(':payment_middle_overtime_unit_price_2', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':payment_middle_overtime_unit_price_2', $a_val);
    
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['txt_syugyonisu_p13']));
    //$a_stmt->bindParam(':payment_leaving_employment_day_1', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':payment_leaving_employment_day_1', $a_val);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['txt_syugyonisu_p23']));
    //$a_stmt->bindParam(':payment_leaving_employment_day_2', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':payment_leaving_employment_day_2', $a_val);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['txt_zeneigyonisu_p13']));
    //$a_stmt->bindParam(':payment_leaving_allbusiness_day_1', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':payment_leaving_allbusiness_day_1', $a_val);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['txt_zeneigyonisu_p23']));
    //$a_stmt->bindParam(':payment_leaving_allbusiness_day_2', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':payment_leaving_allbusiness_day_2', $a_val);
    $a_stmt->bindParam(':payment_leaving_calculation_1', $_POST['opt_contract_calc_p13'], PDO::PARAM_STR);
    $a_stmt->bindParam(':payment_leaving_calculation_2', $_POST['opt_contract_calc_p23'], PDO::PARAM_STR);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['txt_tankin_p13']));
    //$a_stmt->bindParam(':payment_leaving_unit_price_1', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':payment_leaving_unit_price_1', $a_val);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['txt_tankin_p23']));
    //$a_stmt->bindParam(':payment_leaving_unit_price_2', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':payment_leaving_unit_price_2', $a_val);
    $a_stmt->bindParam(':payment_leaving_lower_limit_1', $_POST['txt_contract_lower_limit_p13'], PDO::PARAM_STR);
    $a_stmt->bindParam(':payment_leaving_lower_limit_2', $_POST['txt_contract_lower_limit_p23'], PDO::PARAM_STR);
    $a_stmt->bindParam(':payment_leaving_upper_limit_1', $_POST['txt_contract_upper_limit_p13'], PDO::PARAM_STR);
    $a_stmt->bindParam(':payment_leaving_upper_limit_2', $_POST['txt_contract_upper_limit_p23'], PDO::PARAM_STR);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['txt_contract_kojyo_unit_p13']));
    //$a_stmt->bindParam(':payment_leaving_deduction_unit_price_1', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':payment_leaving_deduction_unit_price_1', $a_val);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['txt_contract_kojyo_unit_p23']));
    //$a_stmt->bindParam(':payment_leaving_deduction_unit_price_2', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':payment_leaving_deduction_unit_price_2', $a_val);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['txt_contract_zangyo_unit_p13']));
    //$a_stmt->bindParam(':payment_leaving_overtime_unit_price_1', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':payment_leaving_overtime_unit_price_1', $a_val);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['txt_contract_zangyo_unit_p23']));
    //$a_stmt->bindParam(':payment_leaving_overtime_unit_price_2', $a_val, PDO::PARAM_INT);
    com_pdo_bindValue($a_stmt, ':payment_leaving_overtime_unit_price_2', $a_val);
    
    $a_stmt->bindParam(':payment_hourly_daily', $_POST['opt_m_contract_time_inc_pd'], PDO::PARAM_STR);
    $a_stmt->bindParam(':payment_hourly_monthly', $_POST['opt_m_contract_time_inc_pm'], PDO::PARAM_STR);
    $a_stmt->bindParam(':payment_settlement_closingday', $_POST['opt_contract_tighten_p'], PDO::PARAM_STR);
    $a_stmt->bindParam(':payment_settlement_paymentday', $_POST['opt_contract_pay_pay'], PDO::PARAM_STR);
    $a_stmt->bindParam(':payment_absence_deduction_subject', $_POST['opt_contract_yesno_p1'], PDO::PARAM_STR);
    $a_stmt->bindParam(':payment_quotation', $_POST['opt_contract_yesno_p2'], PDO::PARAM_STR);
    $a_stmt->bindParam(':payment_purchase_order', $_POST['opt_contract_yesno_p3'], PDO::PARAM_STR);
    $a_stmt->bindParam(':payment_confirmation_order', $_POST['opt_contract_yesno_p4'], PDO::PARAM_STR);
    
    $a_stmt->bindParam(':payment_middle_daily_auto', $_POST['inp_wariai_nyujyo_c1'], PDO::PARAM_STR);
    $a_stmt->bindParam(':payment_middle_daily_manual', $_POST['inp_wariai_nyujyo_c2'], PDO::PARAM_STR);
    $a_stmt->bindParam(':payment_leaving_daily_auto', $_POST['inp_wariai_taijyo_c1'], PDO::PARAM_STR);
    $a_stmt->bindParam(':payment_leaving_daily_manual', $_POST['inp_wariai_taijyo_c2'], PDO::PARAM_STR);

    if ($a_act == 'e'){
        com_pdo_bindValue($a_stmt, ':cr_id', $_POST['cr_id']);
    }
    
    $a_stmt->execute();

    $a_sRet = 'OK';
    //$a_sRet .= "--->".$inp_tankin_b1;
    
} catch (PDOException $e){
    $a_sRet = 'Error:'.$e->getMessage();
    //print('Error:'.$e->getMessage());
    //die();
}
$a_conn = null;

echo $a_sRet;

?>
