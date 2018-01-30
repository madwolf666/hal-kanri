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
//$a_cr_id_result = 0;    //[2017.11.08]課題No.81
/*
$a_sRet = "OK";
echo $a_sRet;
exit();
*/
try{
    //DBからユーザ情報取得
    $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
    $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    #[2017.07.20]課題解決表No.67
    $a_cn_max = 0;
    if (($_SESSION['hal_department_cd'] == 3) && ($_POST['status_cd_num'] == 2)){
        //管理者で、ステータスが2の場合
        $a_sql2 = "SELECT MAX(t1.contract_number)+1 AS cn_max";
        $a_sql2 .= " FROM";
        $a_sql2 .= " (";
        $a_sql2 .= "  SELECT";
        $a_sql2 .= "   CASE WHEN contract_number > 0 THEN CAST(contract_number AS SIGNED)";
        $a_sql2 .= "   ELSE 0";
        $a_sql2 .= "   END AS contract_number";
        $a_sql2 .= "  FROM t_contract_report";
        $a_sql2 .= " ) t1";
        $a_stmt = $a_conn->prepare($a_sql2);
        $a_stmt->execute();
        while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
            $a_cn_max = $a_result['cn_max'];
        }
    }

    if ($a_act == 'n'){
        $a_sql = "INSERT INTO ".$GLOBALS['g_DB_t_contract_report']." (";
        #[2018.01.18]課題解決管理表No.92
        #[2018.01.26]課題解決管理表No.91
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
            ,contact_date_org
            ,organization
            ,dd_name
            ,dd_branch
            ,dd_address
            ,dd_tel
            ,ip_position
            ,ip_name
            ,dm_responsible_position
            ,dm_responsible_name
            ,dm_responsible_tel
            ,dd_responsible_position
            ,dd_responsible_name
            ,dd_responsible_tel
            ,chs_position1
            ,chs_name1
            ,chs_tel1
            ,chs_position2
            ,chs_name2
            ,chs_tel2
            ,remarks_pay
            ,status_cd
            ,cr_id_src
            ,claim_accounts_invoicing
            ,remarks2
            ,remarks_pay2
            ,claim_normal_unit_price_base
            ,claim_middle_unit_price_base
            ,claim_leaving_unit_price_base
            ,payment_normal_unit_price_1_base
            ,payment_normal_unit_price_2_base
            ,payment_middle_unit_price_1_base
            ,payment_middle_unit_price_2_base
            ,payment_leaving_unit_price_1_base
            ,payment_leaving_unit_price_2_base
            ";
        #[2017.11.21]bug-fixed.
        #if (($_SESSION['hal_department_cd'] != 3) || ($_POST['status_cd_num'] < 2)){
        #if ($_SESSION['hal_department_cd'] != 3){
            //管理者以外もしくは、ステータスが2未満の場合
            $a_sql .= "
                ,reg_id
                ,reg_date
                ";
        #}else{
        #    $a_sql .= "
        #        ,cnf_id
        #        ,cnf_date
        #        ";
        #}
        $a_sql .= ") VALUES(";
        #[2018.01.18]課題解決管理表No.92
        #[2018.01.26]課題解決管理表No.91
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
            ,:contact_date_org
            ,:organization
            ,:dd_name
            ,:dd_branch
            ,:dd_address
            ,:dd_tel
            ,:ip_position
            ,:ip_name
            ,:dm_responsible_position
            ,:dm_responsible_name
            ,:dm_responsible_tel
            ,:dd_responsible_position
            ,:dd_responsible_name
            ,:dd_responsible_tel
            ,:chs_position1
            ,:chs_name1
            ,:chs_tel1
            ,:chs_position2
            ,:chs_name2
            ,:chs_tel2
            ,:remarks_pay
            ,:status_cd
            ,:cr_id_src
            ,:claim_accounts_invoicing
            ,:remarks2
            ,:remarks_pay2
            ,:claim_normal_unit_price_base
            ,:claim_middle_unit_price_base
            ,:claim_leaving_unit_price_base
            ,:payment_normal_unit_price_1_base
            ,:payment_normal_unit_price_2_base
            ,:payment_middle_unit_price_1_base
            ,:payment_middle_unit_price_2_base
            ,:payment_leaving_unit_price_1_base
            ,:payment_leaving_unit_price_2_base
            ";
        #[2017.11.21]bug-fixed.
        #if (($_SESSION['hal_department_cd'] != 3) || ($_POST['status_cd_num'] < 2)){
        #if ($_SESSION['hal_department_cd'] != 3){
            //管理者以外もしくは、ステータスが2未満の場合
            $a_sql .= "
                ,:reg_id
                ,:reg_date
                ";
        #}else{
        #    $a_sql .= "
        #        ,:cnf_id
        #        ,:cnf_date
        #        ";
        #}
        $a_sql .= ");";
    }else{
        $a_sql = "UPDATE ".$GLOBALS['g_DB_t_contract_report']." SET ";
        #[2018.01.18]課題解決管理表No.92
        #[2018.01.18]課題解決管理表No.91
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
            ,contact_date_org=:contact_date_org
            ,organization=:organization
            ,dd_name=:dd_name
            ,dd_branch=:dd_branch
            ,dd_address=:dd_address
            ,dd_tel=:dd_tel
            ,ip_position=:ip_position
            ,ip_name=:ip_name
            ,dm_responsible_position=:dm_responsible_position
            ,dm_responsible_name=:dm_responsible_name
            ,dm_responsible_tel=:dm_responsible_tel
            ,dd_responsible_position=:dd_responsible_position
            ,dd_responsible_name=:dd_responsible_name
            ,dd_responsible_tel=:dd_responsible_tel
            ,chs_position1=:chs_position1
            ,chs_name1=:chs_name1
            ,chs_tel1=:chs_tel1
            ,chs_position2=:chs_position2
            ,chs_name2=:chs_name2
            ,chs_tel2=:chs_tel2
            ,remarks_pay=:remarks_pay
            ,status_cd=:status_cd
            ,claim_accounts_invoicing=:claim_accounts_invoicing
            ,remarks2=:remarks2
            ,remarks_pay2=:remarks_pay2
            ,claim_normal_unit_price_base=:claim_normal_unit_price_base
            ,claim_middle_unit_price_base=:claim_middle_unit_price_base
            ,claim_leaving_unit_price_base=:claim_leaving_unit_price_base
            ,payment_normal_unit_price_1_base=:payment_normal_unit_price_1_base
            ,payment_normal_unit_price_2_base=:payment_normal_unit_price_2_base
            ,payment_middle_unit_price_1_base=:payment_middle_unit_price_1_base
            ,payment_middle_unit_price_2_base=:payment_middle_unit_price_2_base
            ,payment_leaving_unit_price_1_base=:payment_leaving_unit_price_1_base
            ,payment_leaving_unit_price_2_base=:payment_leaving_unit_price_2_base
            ";
        #[2017.11.20]bug-fixed.
        #if (($_SESSION['hal_department_cd'] != 3) || ($_POST['status_cd_num'] < 2)){
        if ($_SESSION['hal_department_cd'] != 3){
            //管理者以外もしくは、ステータスが2未満の場合
            $a_sql .= "
                ,upd_id=:upd_id
                ,upd_date=:upd_date
                ";
        }else{
            $a_sql .= "
                ,cnf_id=:cnf_id
                ,cnf_date=:cnf_date
                ";
        }
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
    
    if ($_POST['txt_contract_lower_limit_b1'] == ''){
        $a_stmt->bindParam(':claim_normal_lower_limit', $_POST['opt_contract_lower_limit_b1'], PDO::PARAM_STR);
    }else{
        $a_stmt->bindParam(':claim_normal_lower_limit', $_POST['txt_contract_lower_limit_b1'], PDO::PARAM_STR);
    }
    if ($_POST['txt_contract_upper_limit_b1'] == ''){
        $a_stmt->bindParam(':claim_normal_upper_limit', $_POST['opt_contract_upper_limit_b1'], PDO::PARAM_STR);
    }else{
        $a_stmt->bindParam(':claim_normal_upper_limit', $_POST['txt_contract_upper_limit_b1'], PDO::PARAM_STR);
    }
    
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
    
    /*[2017.11.09]課題No.81
    if ($_POST['txt_contract_lower_limit_b2'] == ''){
        $a_stmt->bindParam(':claim_middle_lower_limit', $_POST['opt_contract_lower_limit_b2'], PDO::PARAM_STR);
    }else{
        $a_stmt->bindParam(':claim_middle_lower_limit', $_POST['txt_contract_lower_limit_b2'], PDO::PARAM_STR);
    }
    if ($_POST['txt_contract_upper_limit_b2'] == ''){
        $a_stmt->bindParam(':claim_middle_upper_limit', $_POST['opt_contract_upper_limit_b2'], PDO::PARAM_STR);
    }else{
        $a_stmt->bindParam(':claim_middle_upper_limit', $_POST['txt_contract_upper_limit_b2'], PDO::PARAM_STR);
    }
    */
    $a_stmt->bindParam(':claim_middle_lower_limit', $_POST['txt_contract_lower_limit_b2'], PDO::PARAM_STR); //[2017.11.09]課題No.81
    $a_stmt->bindParam(':claim_middle_upper_limit', $_POST['txt_contract_upper_limit_b2'], PDO::PARAM_STR); //[2017.11.09]課題No.81
    
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
    
    /*[2017.11.09]課題No.81
    if ($_POST['txt_contract_lower_limit_b3'] == ''){
        $a_stmt->bindParam(':claim_leaving_lower_limit', $_POST['opt_contract_lower_limit_b3'], PDO::PARAM_STR);
    }else{
        $a_stmt->bindParam(':claim_leaving_lower_limit', $_POST['txt_contract_lower_limit_b3'], PDO::PARAM_STR);
    }
    if ($_POST['txt_contract_upper_limit_b3'] == ''){
        $a_stmt->bindParam(':claim_leaving_upper_limit', $_POST['opt_contract_upper_limit_b3'], PDO::PARAM_STR);
    }else{
        $a_stmt->bindParam(':claim_leaving_upper_limit', $_POST['txt_contract_upper_limit_b3'], PDO::PARAM_STR);
    }
    */
    $a_stmt->bindParam(':claim_leaving_lower_limit', $_POST['txt_contract_lower_limit_b3'], PDO::PARAM_STR);    //[2017.11.09]課題No.81
    $a_stmt->bindParam(':claim_leaving_upper_limit', $_POST['txt_contract_upper_limit_b3'], PDO::PARAM_STR);    //[2017.11.09]課題No.81
    
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
    
    #[2017.07.20]課題解決表No.67
    if ($_POST['inp_keiyaku_no'] == ''){
        if (($_SESSION['hal_department_cd'] == 3) && ($_POST['status_cd_num'] == 2)){
            //管理者で、ステータスが2の場合
            $a_stmt->bindParam(':contract_number', $a_cn_max, PDO::PARAM_STR);
        } else{
            $a_stmt->bindParam(':contract_number', $_POST['inp_keiyaku_no'], PDO::PARAM_STR);
        }
    } else {
        $a_stmt->bindParam(':contract_number', $_POST['inp_keiyaku_no'], PDO::PARAM_STR);
    }
    
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

    //追加項目
    $a_stmt->bindParam(':contact_date_org', $_POST['contact_date_org'], PDO::PARAM_STR);
    #com_pdo_bindValue($a_stmt, ':contact_date_org', $_POST['contact_date_org']);
    $a_stmt->bindParam(':organization', $_POST['organization'], PDO::PARAM_STR);
    $a_stmt->bindParam(':dd_name', $_POST['dd_name'], PDO::PARAM_STR);
    $a_stmt->bindParam(':dd_branch', $_POST['dd_branch'], PDO::PARAM_STR);
    $a_stmt->bindParam(':dd_address', $_POST['dd_address'], PDO::PARAM_STR);
    $a_stmt->bindParam(':dd_tel', $_POST['dd_tel'], PDO::PARAM_STR);
    $a_stmt->bindParam(':ip_position', $_POST['ip_position'], PDO::PARAM_STR);
    $a_stmt->bindParam(':ip_name', $_POST['ip_name'], PDO::PARAM_STR);
    $a_stmt->bindParam(':dm_responsible_position', $_POST['dm_responsible_position'], PDO::PARAM_STR);
    $a_stmt->bindParam(':dm_responsible_name', $_POST['dm_responsible_name'], PDO::PARAM_STR);
    $a_stmt->bindParam(':dm_responsible_tel', $_POST['dm_responsible_tel'], PDO::PARAM_STR);
    $a_stmt->bindParam(':dd_responsible_position', $_POST['dd_responsible_position'], PDO::PARAM_STR);
    $a_stmt->bindParam(':dd_responsible_name', $_POST['dd_responsible_name'], PDO::PARAM_STR);
    $a_stmt->bindParam(':dd_responsible_tel', $_POST['dd_responsible_tel'], PDO::PARAM_STR);
    $a_stmt->bindParam(':chs_position1', $_POST['chs_position1'], PDO::PARAM_STR);
    $a_stmt->bindParam(':chs_name1', $_POST['chs_name1'], PDO::PARAM_STR);
    $a_stmt->bindParam(':chs_tel1', $_POST['chs_tel1'], PDO::PARAM_STR);
    $a_stmt->bindParam(':chs_position2', $_POST['chs_position2'], PDO::PARAM_STR);
    $a_stmt->bindParam(':chs_name2', $_POST['chs_name2'], PDO::PARAM_STR);
    $a_stmt->bindParam(':chs_tel2', $_POST['chs_tel2'], PDO::PARAM_STR);
    $a_stmt->bindParam(':remarks_pay', $_POST['remarks_pay'], PDO::PARAM_STR);
    $a_stmt->bindParam(':status_cd', $_POST['status_cd'], PDO::PARAM_STR);
    
    #[2017.12.14]要望
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['claim_accounts_invoicing']));
    com_pdo_bindValue($a_stmt, ':claim_accounts_invoicing', $a_val);

    #[2018.01.18]課題解決管理表No.92
    $a_stmt->bindParam(':remarks2', $_POST['remarks2'], PDO::PARAM_STR);
    $a_stmt->bindParam(':remarks_pay2', $_POST['remarks_pay2'], PDO::PARAM_STR);

    #[2018.01.18]課題解決管理表No.91
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['claim_normal_unit_price_base']));
    com_pdo_bindValue($a_stmt, ':claim_normal_unit_price_base', $a_val);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['claim_middle_unit_price_base']));
    com_pdo_bindValue($a_stmt, ':claim_middle_unit_price_base', $a_val);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['claim_leaving_unit_price_base']));
    com_pdo_bindValue($a_stmt, ':claim_leaving_unit_price_base', $a_val);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['payment_normal_unit_price_1_base']));
    com_pdo_bindValue($a_stmt, ':payment_normal_unit_price_1_base', $a_val);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['payment_normal_unit_price_2_base']));
    com_pdo_bindValue($a_stmt, ':payment_normal_unit_price_2_base', $a_val);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['payment_middle_unit_price_1_base']));
    com_pdo_bindValue($a_stmt, ':payment_middle_unit_price_1_base', $a_val);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['payment_middle_unit_price_2_base']));
    com_pdo_bindValue($a_stmt, ':payment_middle_unit_price_2_base', $a_val);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['payment_leaving_unit_price_1_base']));
    com_pdo_bindValue($a_stmt, ':payment_leaving_unit_price_1_base', $a_val);
    $a_val = str_replace("￥", "", str_replace(",","",$_POST['payment_leaving_unit_price_2_base']));
    com_pdo_bindValue($a_stmt, ':payment_leaving_unit_price_2_base', $a_val);

    if ($a_act == 'e'){
        #[2017.11.20]bug-fixed.
        #if (($_SESSION['hal_department_cd'] != 3) || ($_POST['status_cd_num'] < 2)){
        if ($_SESSION['hal_department_cd'] != 3){
            //管理者以外もしくは、ステータスが2未満の場合
            com_pdo_bindValue($a_stmt, ':upd_id', $_SESSION['hal_idx']);
            com_pdo_bindValue($a_stmt, ':upd_date', date("Y/m/d"));
        }else{
            com_pdo_bindValue($a_stmt, ':cnf_id', $_SESSION['hal_idx']);
            com_pdo_bindValue($a_stmt, ':cnf_date', date("Y/m/d"));
        }
        //[2017.11.08]課題No.81
        $a_cr_id = $_POST['cr_id'];
        com_pdo_bindValue($a_stmt, ':cr_id', $a_cr_id);
    } else {
        #[2017.11.21]bug-fixed.
        #if (($_SESSION['hal_department_cd'] != 3) || ($_POST['status_cd_num'] < 2)){
        #if ($_SESSION['hal_department_cd'] != 3){
            //管理者以外もしくは、ステータスが2未満の場合
            com_pdo_bindValue($a_stmt, ':reg_id', $_SESSION['hal_idx']);
            com_pdo_bindValue($a_stmt, ':reg_date', date("Y/m/d"));
        #}else{
        #    com_pdo_bindValue($a_stmt, ':cnf_id', $_SESSION['hal_idx']);
        #    com_pdo_bindValue($a_stmt, ':cnf_date', date("Y/m/d"));
        #}
        com_pdo_bindValue($a_stmt, ':cr_id_src', $_POST['cr_id_src']);  #[2017.07.20]課題解決表No.67
    }
    
    $a_stmt->execute();
    
/**/
    //検収元台帳レコードの作成
    if ($a_act != 'e'){
        //直近のcr_idを取得
        $a_cr_id = "";
        $a_sql = "SELECT last_insert_id() AS cr_id FROM ".$GLOBALS['g_DB_t_contract_report'];
        $a_stmt = $a_conn->prepare($a_sql);
        $a_stmt->execute();
        while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
            $a_cr_id = $a_result['cr_id'];
        }
        
        //検収元台帳を1レコード作成
        $a_sql = "INSERT INTO ".$GLOBALS['g_DB_t_acceptance_ledger']." (";
        $a_sql .= "cr_id,reg_id,reg_date";
        $a_sql .= ") VALUES(";
        $a_sql .= ":cr_id,:reg_id,:reg_date";
        $a_sql .= ");";
        $a_stmt = $a_conn->prepare($a_sql);
        com_pdo_bindValue($a_stmt, ':reg_id', $_SESSION['hal_idx']);
        com_pdo_bindValue($a_stmt, ':reg_date', date("Y/m/d"));
        com_pdo_bindValue($a_stmt, ':cr_id', $a_cr_id);
        $a_stmt->execute();
    }
/**/        
    #$a_sRet = 'OK'.'-->.'.$_SESSION['hal_department_cd'].'-->'.$_POST['status_cd'];
    $a_sRet = 'OK';
    $a_sRet .= "#".$a_cr_id;    //[2017.11.08]課題No.81
    //$a_sRet .= "--->".$inp_tankin_b1;
    
} catch (PDOException $e){
    $a_sRet = 'Error:'.$e->getMessage();
    //print('Error:'.$e->getMessage());
    //die();
}

    #[2018.01.26]課題解決管理表No.88
if ($_POST['status_cd'] == '営業提出'){
    #t_contract_report_submissionにレコードがなかったら、INSERTする
    try{
        $a_sql = "
INSERT INTO t_contract_report_submission(
cr_id
,customer_name
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
,reg_id
,upd_id
,reg_date
,upd_date
,check_remarks1
,check_correct_date
,check_correct_person
,check_date_start
,check_date_end
,check_remarks2
,organization
,dd_name
,dd_branch
,dd_address
,dd_tel
,ip_position
,ip_name
,dm_responsible_position
,dm_responsible_name
,dd_responsible_position
,dd_responsible_name
,chs_position1
,chs_name1
,chs_position2
,chs_name2
,remarks_pay
,status_cd
,contact_date_org
,cnf_id
,cnf_date
,dm_responsible_tel
,dd_responsible_tel
,chs_tel1
,chs_tel2
,cr_id_src
,claim_accounts_invoicing
,remarks2
,remarks_pay2
,send_mail_date1
,send_mail_date2
,send_mail_date3
,send_mail_date4
,claim_normal_unit_price_base
,claim_middle_unit_price_base
,claim_leaving_unit_price_base
,payment_normal_unit_price_1_base
,payment_normal_unit_price_2_base
,payment_middle_unit_price_1_base
,payment_middle_unit_price_2_base
,payment_leaving_unit_price_1_base
,payment_leaving_unit_price_2_base
,file_payroll
,file_evidence
)
SELECT
cr_id
,customer_name
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
,reg_id
,upd_id
,reg_date
,upd_date
,check_remarks1
,check_correct_date
,check_correct_person
,check_date_start
,check_date_end
,check_remarks2
,organization
,dd_name
,dd_branch
,dd_address
,dd_tel
,ip_position
,ip_name
,dm_responsible_position
,dm_responsible_name
,dd_responsible_position
,dd_responsible_name
,chs_position1
,chs_name1
,chs_position2
,chs_name2
,remarks_pay
,status_cd
,contact_date_org
,cnf_id
,cnf_date
,dm_responsible_tel
,dd_responsible_tel
,chs_tel1
,chs_tel2
,cr_id_src
,claim_accounts_invoicing
,remarks2
,remarks_pay2
,send_mail_date1
,send_mail_date2
,send_mail_date3
,send_mail_date4
,claim_normal_unit_price_base
,claim_middle_unit_price_base
,claim_leaving_unit_price_base
,payment_normal_unit_price_1_base
,payment_normal_unit_price_2_base
,payment_middle_unit_price_1_base
,payment_middle_unit_price_2_base
,payment_leaving_unit_price_1_base
,payment_leaving_unit_price_2_base
,(SELECT GROUP_CONCAT(file_name_src ORDER BY file_name_src) FROM t_payroll_file WHERE cr_id=:cr_id_f1) AS file_payroll
,(SELECT GROUP_CONCAT(file_name_src ORDER BY file_name_src) FROM t_evidence WHERE cr_id=:cr_id_f2) AS file_evidence
FROM t_contract_report
WHERE (cr_id=:cr_id);
";
        $a_stmt = $a_conn->prepare($a_sql);
        com_pdo_bindValue($a_stmt, ':cr_id_f1', $a_cr_id);
        com_pdo_bindValue($a_stmt, ':cr_id_f2', $a_cr_id);
        com_pdo_bindValue($a_stmt, ':cr_id', $a_cr_id);
        $a_stmt->execute();
    } catch (PDOException $e) {
        #何もしない
        #$a_sRet = 'Error:'.$e->getMessage();
    }
}

$a_conn = null;

echo $a_sRet;

?>
