<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./global.php');
require_once($GLOBALS['g_EXCEL_LIB_PATH']."PHPExcel.php");
require_once($GLOBALS['g_EXCEL_LIB_PATH']."PHPExcel/IOFactory.php");

if (!isset($_GET['ACT'])){
    $a_act = '';
}else{
    $a_act = $_GET['ACT'];
}

require_once('./10100-com.php');

//読み書きするファイルのパスを設定
$target_file = $GLOBALS['g_EXCEL_TEMPLATE_PATH'].$GLOBALS['g_EXCEL_CONTRACT_10100'];

//1. リーダーを作成して既存ファイルを読み込む
$obj_reader = PHPExcel_IOFactory::createReader('Excel2007');
$obj_book   = $obj_reader->load($target_file);

//2. ファイルを編集（先頭のシートのA1セルに文字列を書き込み）
$obj_sheet = $obj_book->getSheet(0);
//$obj_sheet->setCellValue("A1", "Hello, PHPExcel!");

try{
    $a_today = date("Y/m/d");

    //DBからユーザ情報取得
    $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
    $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $a_sql = set_10100_selectDB();

    #$a_where = "((del_flag IS NULL) OR (del_flag<>'1'))";    #[2018.01.26]課題解決管理表No.87
    #[2018.01.30]課題解決管理表No.87
    if ($_SESSION['contract_del'] != 1){
        $a_where = com_make_where_session(1, $a_where, 'engineer_name', 'f_engineer_name', "", "");
        $a_where = com_make_where_session(1, $a_where, 'engineer_number', 'f_engineer_number', "", "f_engineer_number_andor");
        $a_where = com_make_where_session(1, $a_where, 'contract_number', 'f_contract_number', "", "f_contract_number_andor");
        $a_where = com_make_where_session(1, $a_where, 'customer_name', 'f_customer_name', "", "f_customer_name_andor");
        $a_where = com_make_where_session(2, $a_where, 'claim_agreement_start', 'f_claim_agreement_start', "", "f_claim_agreement_start_andor");
        $a_where = com_make_where_session(2, $a_where, 'claim_agreement_end', 'f_claim_agreement_end', "", "f_claim_agreement_end_andor");
        $a_where = com_make_where_session(3, $a_where, 'claim_contract_form', 'f_claim_contract_form', $GLOBALS['g_DB_m_contract_bill_form'], "f_claim_contract_form_andor");
        $a_where = com_make_where_session(3, $a_where, 'claim_settlement_closingday', 'f_claim_settlement_closingday', $GLOBALS['g_DB_m_contract_tighten'], "f_claim_settlement_closingday_andor");
        $a_where = com_make_where_session(3, $a_where, 'claim_settlement_paymentday', 'f_claim_settlement_paymentday', $GLOBALS['g_DB_m_contract_bill_pay'], "f_claim_settlement_paymentday_andor");

        #[2018.01.18]課題解決管理表No.92
        #remarksの場合、remarks2/remarks_pay/remarks_pay2も含める
        $a_where_sub = "";
        $a_where_andor = "";
        if (isset($_SESSION['f_remarks'])){
            $a_sess = $_SESSION['f_remarks'];
            if ($a_sess != ""){
                $a_where_sub = "((remarks LIKE '%".$a_sess."%') OR (remarks2 LIKE '%".$a_sess."%') OR (remarks_pay LIKE '%".$a_sess."%') OR (remarks_pay2 LIKE '%".$a_sess."%'))";
            }
        }
        if (isset($_SESSION['f_remarks_andor'])){
            $a_where_andor = " ".$_SESSION['f_remarks_andor']." ";
        }else{
            $a_where_andor = " AND ";
        }
        if (($a_where != "") && ($a_where_sub != "")){
            $a_where .= " ".$a_where_andor." ".$a_where_sub;
        }else{
            $a_where .= $a_where_sub;   #[2018.01.26]bug-fixed.
        }
        #$a_where = com_make_where_session(1, $a_where, 'remarks', 'f_remarks', "", "f_remarks_andor");

        #[2018.01.18]課題解決管理表No.93
        #当日配信の場合
        $a_today = date("Y/m/d");
        $a_where_sub = "";
        $a_where_andor = "";
        #echo "f_send_mail_date1=".isset($_SESSION['f_send_mail_date1'])."<br>";
        if (isset($_SESSION['f_send_mail_date1'])){
            $a_sess = $_SESSION['f_send_mail_date1'];
            #echo "checkbox=".$a_sess."<br>";
            if ($a_sess != ""){
                $a_where_sub .= "(send_mail_date1='".$a_today."')";
            }
        }
        if (isset($_SESSION['f_send_mail_date2'])){
            $a_sess = $_SESSION['f_send_mail_date2'];
            #echo "checkbox=".$a_sess."<br>";
            if ($a_sess != ""){
                if ($a_where_sub != ""){
                    $a_where_sub .= " OR ";
                }
                $a_where_sub .= "(send_mail_date2='".$a_today."')";
            }
        }
        if (isset($_SESSION['f_send_mail_date3'])){
            $a_sess = $_SESSION['f_send_mail_date3'];
            #echo "checkbox=".$a_sess."<br>";
            if ($a_sess != ""){
                if ($a_where_sub != ""){
                    $a_where_sub .= " OR ";
                }
                $a_where_sub .= "(send_mail_date3='".$a_today."')";
            }
        }
        if (isset($_SESSION['f_send_mail_date4'])){
            $a_sess = $_SESSION['f_send_mail_date4'];
            #echo "checkbox=".$a_sess."<br>";
            if ($a_sess != ""){
                if ($a_where_sub != ""){
                    $a_where_sub .= " OR ";
                }
                $a_where_sub .= "(send_mail_date4='".$a_today."')";
            }
        }
        if ($a_where_sub != ""){
            $a_where_sub = "(".$a_where_sub.")";
        }
        if (isset($_SESSION['f_send_mail_date_andor'])){
            $a_where_andor = " ".$_SESSION['f_send_mail_date_andor']." ";
        }else{
            $a_where_andor = " AND ";
        }
        if (($a_where != "") && ($a_where_sub != "")){
            $a_where .= " ".$a_where_andor." ".$a_where_sub;
        }else{
            $a_where .= $a_where_sub;   #[2018.01.26]bug-fixed.
        }
    }else{
        $a_where = com_make_where_session(1, $a_where, 'engineer_name', 'f_engineer_name_del', "", "");
        $a_where = com_make_where_session(1, $a_where, 'engineer_number', 'f_engineer_number_del', "", "f_engineer_number_andor_del");
        $a_where = com_make_where_session(1, $a_where, 'contract_number', 'f_contract_number_del', "", "f_contract_number_andor_del");
        $a_where = com_make_where_session(1, $a_where, 'customer_name', 'f_customer_name_del', "", "f_customer_name_andor_del");
        $a_where = com_make_where_session(2, $a_where, 'claim_agreement_start', 'f_claim_agreement_start_del', "", "f_claim_agreement_start_andor_del");
        $a_where = com_make_where_session(2, $a_where, 'claim_agreement_end', 'f_claim_agreement_end_del', "", "f_claim_agreement_end_andor_del");
        $a_where = com_make_where_session(3, $a_where, 'claim_contract_form', 'f_claim_contract_form_del', $GLOBALS['g_DB_m_contract_bill_form'], "f_claim_contract_form_andor_del");
        $a_where = com_make_where_session(3, $a_where, 'claim_settlement_closingday', 'f_claim_settlement_closingday_del', $GLOBALS['g_DB_m_contract_tighten'], "f_claim_settlement_closingday_andor_del");
        $a_where = com_make_where_session(3, $a_where, 'claim_settlement_paymentday', 'f_claim_settlement_paymentday_del', $GLOBALS['g_DB_m_contract_bill_pay'], "f_claim_settlement_paymentday_andor_del");

        #[2018.01.18]課題解決管理表No.92
        #remarksの場合、remarks2/remarks_pay/remarks_pay2も含める
        $a_where_sub = "";
        $a_where_andor = "";
        if (isset($_SESSION['f_remarks_del'])){
            $a_sess = $_SESSION['f_remarks_del'];
            if ($a_sess != ""){
                $a_where_sub = "((remarks LIKE '%".$a_sess."%') OR (remarks2 LIKE '%".$a_sess."%') OR (remarks_pay LIKE '%".$a_sess."%') OR (remarks_pay2 LIKE '%".$a_sess."%'))";
            }
        }
        if (isset($_SESSION['f_remarks_andor_del'])){
            $a_where_andor = " ".$_SESSION['f_remarks_andor_del']." ";
        }else{
            $a_where_andor = " AND ";
        }
        if (($a_where != "") && ($a_where_sub != "")){
            $a_where .= " ".$a_where_andor." ".$a_where_sub;
        }else{
            $a_where .= $a_where_sub;   #[2018.01.26]bug-fixed.
        }
        #$a_where = com_make_where_session(1, $a_where, 'remarks', 'f_remarks', "", "f_remarks_andor");

        #[2018.01.18]課題解決管理表No.93
        #当日配信の場合
        $a_today = date("Y/m/d");
        $a_where_sub = "";
        $a_where_andor = "";
        #echo "f_send_mail_date1=".isset($_SESSION['f_send_mail_date1'])."<br>";
        if (isset($_SESSION['f_send_mail_date1_del'])){
            $a_sess = $_SESSION['f_send_mail_date1_del'];
            #echo "checkbox=".$a_sess."<br>";
            if ($a_sess != ""){
                $a_where_sub .= "(send_mail_date1='".$a_today."')";
            }
        }
        if (isset($_SESSION['f_send_mail_date2_del'])){
            $a_sess = $_SESSION['f_send_mail_date2_del'];
            #echo "checkbox=".$a_sess."<br>";
            if ($a_sess != ""){
                if ($a_where_sub != ""){
                    $a_where_sub .= " OR ";
                }
                $a_where_sub .= "(send_mail_date2='".$a_today."')";
            }
        }
        if (isset($_SESSION['f_send_mail_date3_del'])){
            $a_sess = $_SESSION['f_send_mail_date3_del'];
            #echo "checkbox=".$a_sess."<br>";
            if ($a_sess != ""){
                if ($a_where_sub != ""){
                    $a_where_sub .= " OR ";
                }
                $a_where_sub .= "(send_mail_date3='".$a_today."')";
            }
        }
        if (isset($_SESSION['f_send_mail_date4_del'])){
            $a_sess = $_SESSION['f_send_mail_date4_del'];
            #echo "checkbox=".$a_sess."<br>";
            if ($a_sess != ""){
                if ($a_where_sub != ""){
                    $a_where_sub .= " OR ";
                }
                $a_where_sub .= "(send_mail_date4='".$a_today."')";
            }
        }
        if ($a_where_sub != ""){
            $a_where_sub = "(".$a_where_sub.")";
        }
        if (isset($_SESSION['f_send_mail_date_andor_del'])){
            $a_where_andor = " ".$_SESSION['f_send_mail_date_andor_del']." ";
        }else{
            $a_where_andor = " AND ";
        }
        if (($a_where != "") && ($a_where_sub != "")){
            $a_where .= " ".$a_where_andor." ".$a_where_sub;
        }else{
            $a_where .= $a_where_sub;   #[2018.01.26]bug-fixed.
        }
    }

    if ($a_where != ""){
        $a_where = " WHERE ".$a_where;
    }
    
    $a_sql .= $a_where;
    $a_sql .= " ORDER BY contract_number;";
    $a_stmt = $a_conn->prepare($a_sql);
    $a_stmt->execute();

    #現在稼働
    $a_active_now = 0;
    $a_active_sum = 0;

    //PHPExcelでは、rowは1始まり、colは0始まりのようである。
    $a_row = 4;
    while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
        #現在稼働
        $a_date_start = str_replace("-", "/", $a_result['claim_agreement_start']);
        $a_date_end = str_replace("-", "/", $a_result['claim_agreement_end']);
        if (($a_today>=$a_date_start) && ($a_today<=$a_date_end)){
            $a_active_now = 1;
            $a_active_sum++;
        } else {
            $a_active_now = 0;
        }

        //客先名など
        $inp_kyakusaki = $a_result['customer_name'];
        $inp_kenmei = $a_result['subject'];
        $opt_contarct_bill_form = $a_result['claim_contract_form'];
        $inp_sagyo_basyo = $a_result['workplace'];
        $inp_kaishi1 = substr($a_result['work_start'], 0, 5);
        $inp_syuryo1 = substr($a_result['work_end'], 0, 5);
        $txt_sagyo_jikan = substr($a_result['work_hours'], 0, 5);
        $inp_kaishi2 = substr($a_result['break_start'], 0, 5);
        $inp_syuryo2 = substr($a_result['break_end'], 0, 5);
        $txt_kyukei_jikan = substr($a_result['break_hours'], 0, 5);

        //客先担当部署など
        $inp_kyakusaki_busyo = $a_result['customer_department_charge'];
        $inp_kyakusaki_tantosya = $a_result['customer_charge_name'];
        $inp_kyakusaki_jimutantosya = $a_result['customer_clerk_charge'];
        $inp_kyakusaki_yakusyoku = $a_result['charge_position'];
        $inp_kyakusaki_tel = $a_result['contact_phone_number'];
        $inp_kyakusaki_kaishi = str_replace("-", "/", $a_result['claim_agreement_start']);
        $inp_kyakusaki_syuryo = str_replace("-", "/", $a_result['claim_agreement_end']);

        //通常期間など
        $opt_contract_calc_b1 = $a_result['claim_normal_calculation'];
        $inp_tankin_b1 = $a_result['claim_normal__unit_price'];
        $opt_contract_lower_limit_b1 = $a_result['claim_normal_lower_limit'];
        $opt_contract_upper_limit_b1 = $a_result['claim_normal_upper_limit'];
        $opt_contract_trunc_unit_kojyo = $a_result['claim_normal_deduction_unit_price_truncation_unit'];
        $opt_contract_trunc_unit_zangyo = $a_result['claim_normal_overtime_unit_price_truncation_unit'];
        $txt_contract_kojyo_unit_b1 = com_db_number_format($a_result['claim_normal_deduction_unit_price']);
        $txt_contract_zangyo_unit_b1 = com_db_number_format($a_result['claim_normal_overtime_unit_price']);

        $inp_syugyonisu_b2 = $a_result['claim_middle_employment_day'];
        $inp_zeneigyonisu_b2 = $a_result['claim_middle_allbusiness_day'];
        $opt_contract_calc_b2 = $a_result['claim_middle_calculation'];
        $txt_tankin_b2 = com_db_number_format($a_result['claim_middle_unit_price']);
        $opt_contract_lower_limit_b2 = $a_result['claim_middle_lower_limit'];
        $opt_contract_upper_limit_b2 = $a_result['claim_middle_upper_limit'];
        $txt_contract_kojyo_unit_b2 = com_db_number_format($a_result['claim_middle_deduction_unit_price']);
        $txt_contract_zangyo_unit_b2 = com_db_number_format($a_result['claim_middle_overtime_unit_price']);

        $inp_syugyonisu_b3 = $a_result['claim_leaving_employment_day'];
        $inp_zeneigyonisu_b3 = $a_result['claim_leaving_allbusiness_day'];
        $opt_contract_calc_b3 = $a_result['claim_leaving_calculation'];
        $txt_tankin_b3 = com_db_number_format($a_result['claim_leaving_unit_price']);
        $opt_contract_lower_limit_b3 = $a_result['claim_leaving_lower_limit'];
        $opt_contract_upper_limit_b3 = $a_result['claim_leaving_upper_limit'];
        $txt_contract_kojyo_unit_b3 = com_db_number_format($a_result['claim_leaving_deduction_unit_price']);
        $txt_contract_zangyo_unit_b3 = com_db_number_format($a_result['claim_leaving_overtime_unit_price']);

        $opt_m_contract_time_inc_bd = $a_result['claim_hourly_daily'];
        $opt_m_contract_time_inc_bm = $a_result['claim_hourly_monthly'];
        $opt_contract_tighten_b = $a_result['claim_settlement_closingday'];
        $opt_contract_bill_pay = $a_result['claim_settlement_paymentday'];
        $opt_m_contract_yesno_b1 = $a_result['claim_dispatch_individual_contract'];
        $opt_m_contract_yesno_b2 = $a_result['claim_quotation'];
        $opt_m_contract_yesno_b3 = $a_result['claim_purchase_order'];
        $opt_m_contract_yesno_b4 = $a_result['claim_confirmation_order'];
        $inp_biko = $a_result['remarks'];

        $opt_contract_kind = $a_result['new_or_continued'];
        $inp_keiyaku_no = $a_result['contract_number'];
        $inp_hakkobi = $a_result['publication'];
        $inp_sakuseisya = $a_result['author'];
        $inp_engineer_no = $a_result['engineer_number'];
        $txt_engineer_name = $a_result['engineer_name'];
        $txt_engineer_kana = $a_result['engneer_name_phonetic'];
        $txt_jigyosya_name = $a_result['business_name'];
        $opt_contract_pay_form = $a_result['payment_contract_form'];
        $txt_jigyosya_name = $a_result['business_name'];
        $inp_jigyosya_tanto = $a_result['business_charge_name'];
        $opt_social_insurance = $a_result['social_insurance'];
        $opt_tax_withholding = $a_result['tax_withholding'];
        $txt_kyakusaki_kaishi = str_replace("-", "/", $a_result['payment_agreement_start']);
        $txt_kyakusaki_syuryo = str_replace("-", "/", $a_result['payment_agreement_end']);
        $opt_contract_reduction = $a_result['redemption_ratio'];

        $opt_contract_calc_p11 = $a_result['payment_normal_calculation_1'];
        $opt_contract_calc_p21 = $a_result['payment_normal_calculation_2'];
        $txt_tankin_p11 = com_db_number_format($a_result['payment_normal_unit_price_1']);
        $txt_tankin_p21 = com_db_number_format($a_result['payment_normal_unit_price_2']);
        $txt_contract_lower_limit_p11 = $a_result['payment_normal_lower_limit_1'];
        $txt_contract_lower_limit_p21 = $a_result['payment_normal_lower_limit_2'];
        $txt_contract_upper_limit_p11 = $a_result['payment_normal_upper_limit_1'];
        $txt_contract_upper_limit_p21 = $a_result['payment_normal_upper_limit_2'];
        $txt_contract_kojyo_unit_p11 = com_db_number_format($a_result['payment_normal_deduction_unit_price_1']);
        $txt_contract_kojyo_unit_p21 = com_db_number_format($a_result['payment_normal_deduction_unit_price_2']);
        $txt_contract_zangyo_unit_p11 = com_db_number_format($a_result['payment_normal_overtime_unit_price_1']);
        $txt_contract_zangyo_unit_p21 = com_db_number_format($a_result['payment_normal_overtime_unit_price_2']);

        $txt_syugyonisu_p12 = $a_result['payment_middle_employment_day_1'];
        $txt_syugyonisu_p22 = $a_result['payment_middle_employment_day_2'];
        $txt_zeneigyonisu_p12 = $a_result['payment_middle_allbusiness_day_1'];
        $txt_zeneigyonisu_p22 = $a_result['payment_middle_allbusiness_day_2'];
        $opt_contract_calc_p12 = $a_result['payment_middle_calculation_1'];
        $opt_contract_calc_p22 = $a_result['payment_middle_calculation_2'];
        $txt_tankin_p12 = com_db_number_format($a_result['payment_middle_unit_price_1']);
        $txt_tankin_p22 = com_db_number_format($a_result['payment_middle_unit_price_2']);
        $txt_contract_lower_limit_p12 = $a_result['payment_middle_lower_limit_1'];
        $txt_contract_lower_limit_p22 = $a_result['payment_middle_lower_limit_2'];
        $txt_contract_upper_limit_p12 = $a_result['payment_middle_upper_limit_1'];
        $txt_contract_upper_limit_p22 = $a_result['payment_middle_upper_limit_2'];
        $txt_contract_kojyo_unit_p12 = com_db_number_format($a_result['payment_middle_deduction_unit_price_1']);
        $txt_contract_kojyo_unit_p22 = com_db_number_format($a_result['payment_middle_deduction_unit_price_2']);
        $txt_contract_zangyo_unit_p12 = com_db_number_format($a_result['payment_middle_overtime_unit_price_1']);
        $txt_contract_zangyo_unit_p22 = com_db_number_format($a_result['payment_middle_overtime_unit_price_2']);

        $txt_syugyonisu_p13 = $a_result['payment_leaving_employment_day_1'];
        $txt_syugyonisu_p23 = $a_result['payment_leaving_employment_day_2'];
        $txt_zeneigyonisu_p13 = $a_result['payment_leaving_allbusiness_day_1'];
        $txt_zeneigyonisu_p23 = $a_result['payment_leaving_allbusiness_day_2'];
        $opt_contract_calc_p13 = $a_result['payment_leaving_calculation_1'];
        $opt_contract_calc_p23 = $a_result['payment_leaving_calculation_2'];
        $txt_tankin_p13 = com_db_number_format($a_result['payment_leaving_unit_price_1']);
        $txt_tankin_p23 = com_db_number_format($a_result['payment_leaving_unit_price_2']);
        $txt_contract_lower_limit_p13 = $a_result['payment_leaving_lower_limit_1'];
        $txt_contract_lower_limit_p23 = $a_result['payment_leaving_lower_limit_2'];
        $txt_contract_upper_limit_p13 = $a_result['payment_leaving_upper_limit_1'];
        $txt_contract_upper_limit_p23 = $a_result['payment_leaving_upper_limit_2'];
        $txt_contract_kojyo_unit_p13 = com_db_number_format($a_result['payment_leaving_deduction_unit_price_1']);
        $txt_contract_kojyo_unit_p23 = com_db_number_format($a_result['payment_leaving_deduction_unit_price_2']);
        $txt_contract_zangyo_unit_p13 = com_db_number_format($a_result['payment_leaving_overtime_unit_price_1']);
        $txt_contract_zangyo_unit_p23 = com_db_number_format($a_result['payment_leaving_overtime_unit_price_2']);

        $opt_m_contract_time_inc_pd = $a_result['payment_hourly_daily'];
        $opt_m_contract_time_inc_pm = $a_result['payment_hourly_monthly'];
        $opt_contract_tighten_p = $a_result['payment_settlement_closingday'];
        $opt_contract_pay_pay = $a_result['payment_settlement_paymentday'];
        $opt_contract_yesno_p1 = $a_result['payment_absence_deduction_subject'];
        $opt_contract_yesno_p2 = $a_result['payment_quotation'];
        $opt_contract_yesno_p3 = $a_result['payment_purchase_order'];
        $opt_contract_yesno_p4 = $a_result['payment_confirmation_order'];

        $inp_wariai_nyujyo_c1 = $a_result['payment_middle_daily_auto'];
        $inp_wariai_nyujyo_c2 = $a_result['payment_middle_daily_manual'];
        $inp_wariai_taijyo_c1 = $a_result['payment_leaving_daily_auto'];
        $inp_wariai_taijyo_c2 = $a_result['payment_leaving_daily_manual'];

        $check_correct_date = "";
        $check_correct_person = "";
        if ($a_result['status_cd_num'] == 2){
            //ステータスが2の場合
            $check_correct_date = str_replace("-", "/", $a_result['cnf_date']);
            $check_correct_person = $a_result['cnf_person'];
        }
        /*$check_correct_date = str_replace("-", "/", $a_result['check_correct_date']);
        $check_correct_person = $a_result['check_correct_person'];*/

        $check_remarks1 = $a_result['check_remarks1'];
        $check_remarks2 = $a_result['check_remarks2'];
        
        $obj_sheet->setCellValueByColumnAndRow(0, $a_row, $inp_keiyaku_no);
        $obj_sheet->setCellValueByColumnAndRow(1, $a_row, $inp_hakkobi);
        $obj_sheet->setCellValueByColumnAndRow(2, $a_row, $inp_sakuseisya);
        $obj_sheet->setCellValueByColumnAndRow(3, $a_row, $inp_engineer_no);
        $obj_sheet->setCellValueByColumnAndRow(4, $a_row, $txt_engineer_name);
        
        $obj_sheet->setCellValueByColumnAndRow(5, $a_row, $inp_kyakusaki);
        $obj_sheet->setCellValueByColumnAndRow(6, $a_row, $inp_kenmei);
        $obj_sheet->setCellValueByColumnAndRow(7, $a_row, $inp_sagyo_basyo);

        $obj_sheet->setCellValueByColumnAndRow(8, $a_row, $inp_kaishi1);
        $obj_sheet->setCellValueByColumnAndRow(9, $a_row, $inp_syuryo1);
        $obj_sheet->setCellValueByColumnAndRow(10, $a_row, $txt_sagyo_jikan);
        $obj_sheet->setCellValueByColumnAndRow(11, $a_row, $inp_kaishi2);
        $obj_sheet->setCellValueByColumnAndRow(12, $a_row, $inp_syuryo2);
        $obj_sheet->setCellValueByColumnAndRow(13, $a_row, $txt_kyukei_jikan);

        $obj_sheet->setCellValueByColumnAndRow(14, $a_row, $inp_kyakusaki_busyo);
        $obj_sheet->setCellValueByColumnAndRow(15, $a_row, $inp_kyakusaki_tantosya);
        //$obj_sheet->setCellValueByColumnAndRow(8, $a_row, $inp_kyakusaki_jimutantosya);
        $obj_sheet->setCellValueByColumnAndRow(16, $a_row, $inp_kyakusaki_kaishi);
        $obj_sheet->setCellValueByColumnAndRow(17, $a_row, $inp_kyakusaki_syuryo);
        $obj_sheet->setCellValueByColumnAndRow(18, $a_row, $opt_contract_calc_b1);
        $obj_sheet->setCellValueByColumnAndRow(19, $a_row, str_replace(",", "", $inp_tankin_b1));
        $obj_sheet->setCellValueByColumnAndRow(20, $a_row, $opt_contract_lower_limit_b1);
        $obj_sheet->setCellValueByColumnAndRow(21, $a_row, $opt_contract_upper_limit_b1);
        $obj_sheet->setCellValueByColumnAndRow(22, $a_row, str_replace(",", "", $txt_contract_kojyo_unit_b1));
        $obj_sheet->setCellValueByColumnAndRow(23, $a_row, str_replace(",", "", $txt_contract_zangyo_unit_b1));
        $obj_sheet->setCellValueByColumnAndRow(24, $a_row, $opt_contract_calc_b2);
        $obj_sheet->setCellValueByColumnAndRow(25, $a_row, str_replace(",", "", $txt_tankin_b2));
        $obj_sheet->setCellValueByColumnAndRow(26, $a_row, $opt_contract_lower_limit_b2);
        $obj_sheet->setCellValueByColumnAndRow(27, $a_row, $opt_contract_upper_limit_b2);
        $obj_sheet->setCellValueByColumnAndRow(28, $a_row, str_replace(",", "", $txt_contract_kojyo_unit_b2));
        $obj_sheet->setCellValueByColumnAndRow(29, $a_row, str_replace(",", "", $txt_contract_zangyo_unit_b2));
        $obj_sheet->setCellValueByColumnAndRow(30, $a_row, $opt_contract_calc_b3);
        $obj_sheet->setCellValueByColumnAndRow(31, $a_row, str_replace(",", "", $txt_tankin_b3));
        $obj_sheet->setCellValueByColumnAndRow(32, $a_row, $opt_contract_lower_limit_b3);
        $obj_sheet->setCellValueByColumnAndRow(33, $a_row, $opt_contract_upper_limit_b3);
        $obj_sheet->setCellValueByColumnAndRow(34, $a_row, str_replace(",", "", $txt_contract_kojyo_unit_b3));
        $obj_sheet->setCellValueByColumnAndRow(35, $a_row, str_replace(",", "", $txt_contract_zangyo_unit_b3));
        $obj_sheet->setCellValueByColumnAndRow(36, $a_row, $opt_m_contract_time_inc_bd);
        $obj_sheet->setCellValueByColumnAndRow(37, $a_row, $opt_m_contract_time_inc_bm);
        $obj_sheet->setCellValueByColumnAndRow(38, $a_row, $opt_contract_tighten_b);
        $obj_sheet->setCellValueByColumnAndRow(39, $a_row, $opt_contract_bill_pay);
        $obj_sheet->setCellValueByColumnAndRow(40, $a_row, $opt_m_contract_yesno_b1);
        $obj_sheet->setCellValueByColumnAndRow(41, $a_row, $opt_m_contract_yesno_b2);
        $obj_sheet->setCellValueByColumnAndRow(42, $a_row, $opt_m_contract_yesno_b3);
        $obj_sheet->setCellValueByColumnAndRow(43, $a_row, $opt_m_contract_yesno_b4);
        $obj_sheet->setCellValueByColumnAndRow(44, $a_row, $inp_biko);
        $obj_sheet->setCellValueByColumnAndRow(45, $a_row, $opt_contarct_bill_form);
        
        $obj_sheet->setCellValueByColumnAndRow(46, $a_row, $txt_jigyosya_name);
        $obj_sheet->setCellValueByColumnAndRow(47, $a_row, $inp_jigyosya_tanto);
        $obj_sheet->setCellValueByColumnAndRow(48, $a_row, $txt_kyakusaki_kaishi);
        $obj_sheet->setCellValueByColumnAndRow(49, $a_row, $txt_kyakusaki_syuryo);
        $obj_sheet->setCellValueByColumnAndRow(50, $a_row, $opt_contract_reduction);
        
        $obj_sheet->setCellValueByColumnAndRow(51, $a_row, $opt_contract_calc_p11);
        $obj_sheet->setCellValueByColumnAndRow(52, $a_row, str_replace(",", "", $txt_tankin_p11));
        $obj_sheet->setCellValueByColumnAndRow(53, $a_row, $txt_contract_lower_limit_p11);
        $obj_sheet->setCellValueByColumnAndRow(54, $a_row, $txt_contract_upper_limit_p11);
        $obj_sheet->setCellValueByColumnAndRow(55, $a_row, str_replace(",", "", $txt_contract_kojyo_unit_p11));
        $obj_sheet->setCellValueByColumnAndRow(56, $a_row, str_replace(",", "", $txt_contract_zangyo_unit_p11));
        $obj_sheet->setCellValueByColumnAndRow(57, $a_row, $opt_contract_calc_p12);
        $obj_sheet->setCellValueByColumnAndRow(58, $a_row, str_replace(",", "", $txt_tankin_p12));
        $obj_sheet->setCellValueByColumnAndRow(59, $a_row, $txt_contract_lower_limit_p12);
        $obj_sheet->setCellValueByColumnAndRow(60, $a_row, $txt_contract_upper_limit_p12);
        $obj_sheet->setCellValueByColumnAndRow(61, $a_row, str_replace(",", "", $txt_contract_kojyo_unit_p12));
        $obj_sheet->setCellValueByColumnAndRow(62, $a_row, str_replace(",", "", $txt_contract_zangyo_unit_p12));
        $obj_sheet->setCellValueByColumnAndRow(63, $a_row, $opt_contract_calc_p13);
        $obj_sheet->setCellValueByColumnAndRow(64, $a_row, str_replace(",", "", $txt_tankin_p13));
        $obj_sheet->setCellValueByColumnAndRow(65, $a_row, $txt_contract_lower_limit_p13);
        $obj_sheet->setCellValueByColumnAndRow(66, $a_row, $txt_contract_upper_limit_p13);
        $obj_sheet->setCellValueByColumnAndRow(67, $a_row, str_replace(",", "", $txt_contract_kojyo_unit_p13));
        $obj_sheet->setCellValueByColumnAndRow(68, $a_row, str_replace(",", "", $txt_contract_zangyo_unit_p13));
        $obj_sheet->setCellValueByColumnAndRow(69, $a_row, $opt_m_contract_time_inc_pd);
        $obj_sheet->setCellValueByColumnAndRow(70, $a_row, $opt_m_contract_time_inc_pm);
        $obj_sheet->setCellValueByColumnAndRow(71, $a_row, $opt_contract_tighten_p);
        $obj_sheet->setCellValueByColumnAndRow(72, $a_row, $opt_contract_pay_pay);
        $obj_sheet->setCellValueByColumnAndRow(73, $a_row, $opt_contract_yesno_p1);
        $obj_sheet->setCellValueByColumnAndRow(74, $a_row, $opt_contract_yesno_p2);
        $obj_sheet->setCellValueByColumnAndRow(75, $a_row, $opt_contract_yesno_p3);
        $obj_sheet->setCellValueByColumnAndRow(76, $a_row, $opt_contract_yesno_p4);
        $obj_sheet->setCellValueByColumnAndRow(77, $a_row, $a_result['remarks_pay']);
        $obj_sheet->setCellValueByColumnAndRow(78, $a_row, $opt_contract_pay_form);

        $obj_sheet->setCellValueByColumnAndRow(79, $a_row, $check_correct_date);
        $obj_sheet->setCellValueByColumnAndRow(80, $a_row, $check_correct_person);
        $obj_sheet->setCellValueByColumnAndRow(82, $a_row, $a_active_now);
        $obj_sheet->setCellValueByColumnAndRow(83, $a_row, $a_active_sum);
        $obj_sheet->setCellValueByColumnAndRow(84, $a_row, $check_remarks1);
        $obj_sheet->setCellValueByColumnAndRow(85, $a_row, $check_remarks2);
        
        $a_row++;
    }
} catch (PDOException $e){
    echo 'Error:'.$e->getMessage();
    //die();
}

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment;filename='".$GLOBALS['g_EXCEL_CONTRACT_10100']."'");
header("Cache-Control: max-age=0");

$obj_writer = PHPExcel_IOFactory::createWriter($obj_book, 'Excel2007');
$obj_writer->save("php://output"); 

exit;

?>
