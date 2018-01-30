/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function () {
    //--------------------------------------------------------------------------
    //契約レポート
    //--------------------------------------------------------------------------
    //--------------------------------------------------------------------------
    //請求サイド
    //--------------------------------------------------------------------------
    //作業時間
    $('#inp_kaishi1').datetimepicker({format:'H:i', datepicker:false, lang:'ja', step:5});
    $('#inp_syuryo1').datetimepicker({format:'H:i', datepicker:false, lang:'ja', step:5});
    $('#inp_kaishi2').datetimepicker({format:'H:i', datepicker:false, lang:'ja', step:5});
    $('#inp_syuryo2').datetimepicker({format:'H:i', datepicker:false, lang:'ja', step:5});

    $('#inp_kaishi1').keyup(function(){calc_bill_work_time(); check_value_changed_10102(3, 'work_start', $('#inp_kaishi1').val(), '#inp_kaishi1');});
    $('#inp_syuryo1').keyup(function(){calc_bill_work_time(); check_value_changed_10102(3, 'work_end', $('#inp_syuryo1').val(), '#inp_syuryo1');});
    $('#inp_kaishi2').keyup(function(){calc_bill_work_time(); check_value_changed_10102(3, 'break_start', $('#inp_kaishi2').val(), '#inp_kaishi2');});
    $('#inp_syuryo2').keyup(function(){calc_bill_work_time(); check_value_changed_10102(3, 'break_end', $('#inp_syuryo2').val(), '#inp_syuryo2');});

    $('#inp_kaishi1').change(function(){calc_bill_work_time(); check_value_changed_10102(3, 'work_start', $('#inp_kaishi1').val(), '#inp_kaishi1');});
    $('#inp_syuryo1').change(function(){calc_bill_work_time(); check_value_changed_10102(3, 'work_end', $('#inp_syuryo1').val(), '#inp_syuryo1');});
    $('#inp_kaishi2').change(function(){calc_bill_work_time(); check_value_changed_10102(3, 'break_start', $('#inp_kaishi2').val(), '#inp_kaishi2');});
    $('#inp_syuryo2').change(function(){calc_bill_work_time(); check_value_changed_10102(3, 'break_end', $('#inp_syuryo2').val(), '#inp_syuryo2');});

    //契約開始日・終了日
    $('#inp_kyakusaki_kaishi').datepicker({});
    $('#inp_kyakusaki_syuryo').datepicker({});
    $('#inp_kyakusaki_kaishi').keyup(function(){calc_pay_person(); check_value_changed_10102(2, 'claim_agreement_start', $('#inp_kyakusaki_kaishi').val(), '#inp_kyakusaki_kaishi');});
    $('#inp_kyakusaki_kaishi').change(function(){calc_pay_person(); check_value_changed_10102(2, 'claim_agreement_start', $('#inp_kyakusaki_kaishi').val(), '#inp_kyakusaki_kaishi');});
    $('#inp_kyakusaki_syuryo').keyup(function(){calc_pay_person(); check_value_changed_10102(2, 'claim_agreement_end', $('#inp_kyakusaki_syuryo').val(), '#inp_kyakusaki_syuryo');});
    $('#inp_kyakusaki_syuryo').change(function(){calc_pay_person(); check_value_changed_10102(2, 'claim_agreement_end', $('#inp_kyakusaki_syuryo').val(), '#inp_kyakusaki_syuryo');});
    
    //通常期間：単金・下限時間・上限時間
    $('#opt_contract_calc_b1').change(function(){
        $('#opt_contract_calc_p11').val($('#opt_contract_calc_b1').val()); $('#opt_contract_calc_p21').val($('#opt_contract_calc_b1').val());
        check_value_changed_10102(1, 'claim_normal_calculation', $('[name=opt_contract_calc_b1] option:selected').text(), '#opt_contract_calc_b1');
        //[2018.01.18]課題解決管理表No.89
        if ($('[name=opt_contract_calc_b1] option:selected').text() == '固定'){
            $('#opt_m_contract_time_inc_bd').val('7');
            $('#opt_m_contract_time_inc_bm').val('7');
            $('#opt_m_contract_time_inc_pd').val('7');
            $('#opt_m_contract_time_inc_pm').val('7');
        }
    });
    //[2017.11.07]課題No.79
    $('#inp_tankin_b1').keyup(function(){
        calc_bill_normal_period(); calc_bill_middle_admission(); calc_bill_midway_retirement();
        check_value_changed_10102(1, 'claim_normal__unit_price', $('#inp_tankin_b1').val(), '#inp_tankin_b1');
        calc_pay_normal_period(); calc_pay_middle_admission(); calc_pay_midway_retirement();
    });
    //$('#inp_tankin_b1').keyup(function(){calc_bill_normal_period(); calc_bill_middle_admission(); calc_bill_midway_retirement(); calc_pay_normal_period(); calc_pay_middle_admission(); calc_pay_midway_retirement(); check_value_changed_10102(1, 'claim_normal__unit_price', $('#inp_tankin_b1').val(), '#inp_tankin_b1');});

    //[2017.11.09]課題No.81
    $('#opt_contract_lower_limit_b1').change(function(){
        calc_bill_normal_period(); calc_bill_middle_admission(); calc_bill_midway_retirement();
        check_value_changed_10102(1, 'claim_normal_lower_limit', $('[name=opt_contract_lower_limit_b1] option:selected').text(), '#opt_contract_lower_limit_b1');
        calc_pay_normal_period(); calc_pay_middle_admission(); calc_pay_midway_retirement();
    });
    //[2017.11.09]課題No.81
    $('#opt_contract_upper_limit_b1').change(function(){
        calc_bill_normal_period(); calc_bill_middle_admission(); calc_bill_midway_retirement();
        check_value_changed_10102(1, 'claim_normal_upper_limit', $('[name=opt_contract_upper_limit_b1] option:selected').text(), '#opt_contract_upper_limit_b1');
        calc_pay_normal_period(); calc_pay_middle_admission(); calc_pay_midway_retirement();
    });
    //[2017.11.09]課題No.81
    $('#txt_contract_lower_limit_b1').keyup(function(){
        calc_bill_normal_period(); calc_bill_middle_admission(); calc_bill_midway_retirement();
        check_value_changed_10102(1, 'claim_normal_lower_limit', $('#txt_contract_lower_limit_b1').val(), '#txt_contract_lower_limit_b1');
        calc_pay_normal_period(); calc_pay_middle_admission(); calc_pay_midway_retirement();
    });
    //[2017.11.09]課題No.81
    $('#txt_contract_upper_limit_b1').keyup(function(){
        calc_bill_normal_period(); calc_bill_middle_admission(); calc_bill_midway_retirement();
        check_value_changed_10102(1, 'claim_normal_upper_limit', $('#txt_contract_upper_limit_b1').val(), '#txt_contract_upper_limit_b1');
        calc_pay_normal_period(); calc_pay_middle_admission(); calc_pay_midway_retirement();
    });
    //[2017.11.09]課題No.81
    $('#opt_contract_trunc_unit_kojyo').change(function(){
        calc_bill_normal_period(); calc_bill_middle_admission(); calc_bill_midway_retirement();
        check_value_changed_10102(1, 'claim_normal_deduction_unit_price_truncation_unit', $('[name=opt_contract_trunc_unit_kojyo] option:selected').text(), '#opt_contract_trunc_unit_kojyo');
        calc_pay_normal_period(); calc_pay_middle_admission(); calc_pay_midway_retirement();
    });
    //[2017.11.09]課題No.81
    $('#opt_contract_trunc_unit_zangyo').change(function(){
        calc_bill_normal_period(); calc_bill_middle_admission(); calc_bill_midway_retirement();
        check_value_changed_10102(1, 'claim_normal_overtime_unit_price_truncation_unit', $('[name=opt_contract_trunc_unit_zangyo] option:selected').text(), '#opt_contract_trunc_unit_zangyo');
        calc_pay_normal_period(); calc_pay_middle_admission(); calc_pay_midway_retirement();
    });

    //$('#opt_contract_lower_limit_b1').change(function(){calc_bill_normal_period(); calc_bill_middle_admission(); calc_bill_midway_retirement(); calc_pay_normal_period(); calc_pay_middle_admission(); calc_pay_midway_retirement(); check_value_changed_10102(1, 'claim_normal_lower_limit', $('[name=opt_contract_lower_limit_b1] option:selected').text(), '#opt_contract_lower_limit_b1');});
    //$('#opt_contract_upper_limit_b1').change(function(){calc_bill_normal_period(); calc_bill_middle_admission(); calc_bill_midway_retirement(); calc_pay_normal_period(); calc_pay_middle_admission(); calc_pay_midway_retirement(); check_value_changed_10102(1, 'claim_normal_upper_limit', $('[name=opt_contract_upper_limit_b1] option:selected').text(), '#opt_contract_upper_limit_b1');});
    //$('#txt_contract_lower_limit_b1').keyup(function(){calc_bill_normal_period(); calc_bill_middle_admission(); calc_bill_midway_retirement(); calc_pay_normal_period(); calc_pay_middle_admission(); calc_pay_midway_retirement(); check_value_changed_10102(1, 'claim_normal_lower_limit', $('#txt_contract_lower_limit_b1').val(), '#txt_contract_lower_limit_b1');});
    //$('#txt_contract_upper_limit_b1').keyup(function(){calc_bill_normal_period(); calc_bill_middle_admission(); calc_bill_midway_retirement(); calc_pay_normal_period(); calc_pay_middle_admission(); calc_pay_midway_retirement(); check_value_changed_10102(1, 'claim_normal_upper_limit', $('#txt_contract_upper_limit_b1').val(), '#txt_contract_upper_limit_b1');});
    //$('#opt_contract_trunc_unit_kojyo').change(function(){calc_bill_normal_period(); calc_bill_middle_admission(); calc_bill_midway_retirement(); calc_pay_normal_period(); calc_pay_middle_admission(); calc_pay_midway_retirement(); check_value_changed_10102(1, 'claim_normal_deduction_unit_price_truncation_unit', $('[name=opt_contract_trunc_unit_kojyo] option:selected').text(), '#opt_contract_trunc_unit_kojyo');});
    //$('#opt_contract_trunc_unit_zangyo').change(function(){calc_bill_normal_period(); calc_bill_middle_admission(); calc_bill_midway_retirement(); calc_pay_normal_period(); calc_pay_middle_admission(); calc_pay_midway_retirement(); check_value_changed_10102(1, 'claim_normal_overtime_unit_price_truncation_unit', $('[name=opt_contract_trunc_unit_zangyo] option:selected').text(), '#opt_contract_trunc_unit_zangyo');});

    //途中入場：自動計算・手入力・通常単金・通常下限時間・通常上限時間・通常控除単価・通常残業単価・就業日数・全営業日数
    $('#opt_contract_calc_b2').change(function(){
        $('#opt_contract_calc_p12').val($('#opt_contract_calc_b2').val()); $('#opt_contract_calc_p22').val($('#opt_contract_calc_b2').val());
        check_value_changed_10102(1, 'claim_middle_calculation', $('[name=opt_contract_calc_b2] option:selected').text(), '#opt_contract_calc_b2');
        //[2018.01.18]課題解決管理表No.89
        if ($('[name=opt_contract_calc_b2] option:selected').text() == '固定'){
            $('#opt_m_contract_time_inc_bd').val('7');
            $('#opt_m_contract_time_inc_bm').val('7');
            $('#opt_m_contract_time_inc_pd').val('7');
            $('#opt_m_contract_time_inc_pm').val('7');
        }
    });
    $('#inp_wariai_nyujyo_c1').keyup(function(){calc_bill_middle_admission();});
    $('#inp_wariai_nyujyo_c2').keyup(function(){calc_bill_middle_admission(); calc_pay_middle_admission(); check_value_changed_10102(1, 'payment_middle_daily_manual', $('#inp_wariai_nyujyo_c2').val(), '#inp_wariai_nyujyo_c2');});
    
    /*[2017.11.09]課題No.81
    $('#opt_contract_lower_limit_b2').change(function(){calc_bill_middle_admission_lower_limit(); check_value_changed_10102(1, 'claim_middle_lower_limit', $('[name=opt_contract_lower_limit_b2] option:selected').text(), '#opt_contract_lower_limit_b2');});
    $('#opt_contract_upper_limit_b2').change(function(){calc_bill_middle_admission_upper_limit(); check_value_changed_10102(1, 'claim_middle_upper_limit', $('[name=opt_contract_upper_limit_b2] option:selected').text(), '#opt_contract_upper_limit_b2');});
    */
    $('#txt_contract_lower_limit_b2').keyup(function(){calc_bill_middle_admission_lower_limit(); check_value_changed_10102(1, 'claim_middle_lower_limit', $('#txt_contract_lower_limit_b2').val(), '#txt_contract_lower_limit_b2');});
    $('#txt_contract_upper_limit_b2').keyup(function(){calc_bill_middle_admission_upper_limit(); check_value_changed_10102(1, 'claim_middle_upper_limit', $('#txt_contract_upper_limit_b2').val(), '#txt_contract_upper_limit_b2');});
    //$('#txt_contract_kojyo_unit_b1').keyup(function(){alert('txt_contract_kojyo_unit_b1');calc_bill_middle_admission();});
    //$('#txt_contract_zangyo_unit_b1').keyup(function(){calc_bill_middle_admission();});
    $('#inp_syugyonisu_b2').keyup(function(){calc_bill_middle_admission(); calc_pay_middle_admission(); check_value_changed_10102(1, 'claim_middle_employment_day', $('#inp_syugyonisu_b2').val(), '#inp_syugyonisu_b2');});
    $('#inp_zeneigyonisu_b2').keyup(function(){calc_bill_middle_admission(); calc_pay_middle_admission(); check_value_changed_10102(1, 'claim_middle_allbusiness_day', $('#inp_zeneigyonisu_b2').val(), '#inp_zeneigyonisu_b2');});

    //途中退場：自動計算・手入力・通常単金・通常下限時間・通常上限時間・通常控除単価・通常残業単価・就業日数・全営業日数
    $('#opt_contract_calc_b3').change(function(){
        $('#opt_contract_calc_p13').val($('#opt_contract_calc_b3').val()); $('#opt_contract_calc_p23').val($('#opt_contract_calc_b3').val());
        check_value_changed_10102(1, 'claim_leaving_calculation', $('[name=opt_contract_calc_b3] option:selected').text(), '#opt_contract_calc_b3');
        //[2018.01.18]課題解決管理表No.89
        if ($('[name=opt_contract_calc_b3] option:selected').text() == '固定'){
            $('#opt_m_contract_time_inc_bd').val('7');
            $('#opt_m_contract_time_inc_bm').val('7');
            $('#opt_m_contract_time_inc_pd').val('7');
            $('#opt_m_contract_time_inc_pm').val('7');
        }
    });
    $('#inp_wariai_taijyo_c1').keyup(function(){calc_bill_midway_retirement();});
    $('#inp_wariai_taijyo_c2').keyup(function(){calc_bill_midway_retirement(); calc_pay_midway_retirement(); check_value_changed_10102(1, 'payment_leaving_daily_manual', $('#inp_wariai_taijyo_c2').val(), '#inp_wariai_taijyo_c2');});
    /*[2017.11.09]課題No.81
    $('#opt_contract_lower_limit_b3').change(function(){calc_bill_midway_retirement_lower_limit(); check_value_changed_10102(1, 'claim_leaving_lower_limit', $('[name=opt_contract_lower_limit_b3] option:selected').text(), '#opt_contract_lower_limit_b3');});
    $('#opt_contract_upper_limit_b3').change(function(){calc_bill_midway_retirement_upper_limit(); check_value_changed_10102(1, 'claim_leaving_upper_limit', $('[name=opt_contract_upper_limit_b3] option:selected').text(), '#opt_contract_upper_limit_b3');});
    */
    $('#txt_contract_lower_limit_b3').keyup(function(){calc_bill_midway_retirement_lower_limit(); check_value_changed_10102(1, 'claim_leaving_lower_limit', $('#txt_contract_lower_limit_b3').val(), '#txt_contract_lower_limit_b3');});
    $('#txt_contract_upper_limit_b3').keyup(function(){calc_bill_midway_retirement_upper_limit(); check_value_changed_10102(1, 'claim_leaving_upper_limit', $('#txt_contract_upper_limit_b3').val(), '#txt_contract_upper_limit_b3');});
    $('#inp_syugyonisu_b3').keyup(function(){calc_bill_midway_retirement(); calc_pay_midway_retirement(); check_value_changed_10102(1, 'claim_leaving_employment_day', $('#inp_syugyonisu_b3').val(), '#inp_syugyonisu_b3');});
    $('#inp_zeneigyonisu_b3').keyup(function(){calc_bill_midway_retirement(); calc_pay_midway_retirement(); check_value_changed_10102(1, 'claim_leaving_allbusiness_day', $('#inp_zeneigyonisu_b3').val(), '#inp_zeneigyonisu_b3');});

    //[2018.01.26]課題解決管理表No.91
    $('#claim_normal_unit_price_base').keyup(function(){
        check_value_changed_10102(1, 'claim_normal_unit_price_base', $('#claim_normal_unit_price_base').val(), '#claim_normal_unit_price_base');
        calc_pay_normal_period();
    });
    $('#claim_middle_unit_price_base').keyup(function(){
        check_value_changed_10102(1, 'claim_middle_unit_price_base', $('#claim_middle_unit_price_base').val(), '#claim_middle_unit_price_base');
        calc_pay_middle_admission();
    });
    $('#claim_leaving_unit_price_base').keyup(function(){
        check_value_changed_10102(1, 'claim_leaving_unit_price_base', $('#claim_leaving_unit_price_base').val(), '#claim_leaving_unit_price_base');
        calc_pay_midway_retirement();
    });

    //--------------------------------------------------------------------------
    //支払いサイド
    //--------------------------------------------------------------------------
    //発行日の変更
    $('#inp_hakkobi').datepicker({onSelect: function(dataText){}});
    
    //契約形態の変更
    calc_pay_person();  //[2018.01.10]協の場合還元率を手入力
    $('#opt_contract_pay_form').change(function(){calc_pay_person(); calc_pay_settlement(); calc_teisyoku();
        calc_pay_normal_period(); calc_pay_middle_admission(); calc_pay_midway_retirement();
    });

    //還元率
    $('#opt_contract_reduction').change(function(){calc_pay_normal_period(); calc_pay_middle_admission(); calc_pay_midway_retirement();});
    //[2018.01.10]協の場合還元率を手入力
    $('#txt_contract_reduction').keyup(function(){calc_pay_normal_period(); calc_pay_middle_admission(); calc_pay_midway_retirement();});

    //ｴﾝｼﾞﾆｱNo.
    $('#inp_engineer_no').keyup(function(){get_engineer_info();});

    //入力変更チェック
    $('#inp_kyakusaki').keyup(function(){check_value_changed_10102(1, 'customer_name', $('#inp_kyakusaki').val(), '#inp_kyakusaki');});
    $('#inp_kenmei').keyup(function(){check_value_changed_10102(1, 'subject', $('#inp_kenmei').val(), '#inp_kenmei');});
    $('#opt_contarct_bill_form').change(function(){check_value_changed_10102(1, 'claim_contract_form', $('[name=opt_contarct_bill_form] option:selected').text(), '#opt_contarct_bill_form');});
    $('#inp_sagyo_basyo').keyup(function(){check_value_changed_10102(1, 'workplace', $('#inp_sagyo_basyo').val(), '#inp_sagyo_basyo');});

    $('#inp_kyakusaki_busyo').keyup(function(){check_value_changed_10102(1, 'customer_department_charge', $('#inp_kyakusaki_busyo').val(), '#inp_kyakusaki_busyo');});
    $('#inp_kyakusaki_tantosya').keyup(function(){check_value_changed_10102(1, 'customer_charge_name', $('#inp_kyakusaki_tantosya').val(), '#inp_kyakusaki_tantosya');});
    $('#inp_kyakusaki_jimutantosya').keyup(function(){check_value_changed_10102(1, 'customer_clerk_charge', $('#inp_kyakusaki_jimutantosya').val(), '#inp_kyakusaki_jimutantosya');});
    $('#inp_kyakusaki_yakusyoku').keyup(function(){check_value_changed_10102(1, 'charge_position', $('#inp_kyakusaki_yakusyoku').val(), '#inp_kyakusaki_yakusyoku');});
    $('#inp_kyakusaki_tel').keyup(function(){check_value_changed_10102(1, 'contact_phone_number', $('#inp_kyakusaki_tel').val(), '#inp_kyakusaki_tel');});

    $('#opt_m_contract_time_inc_bd').change(function(){check_value_changed_10102(1, 'claim_hourly_daily', $('[name=opt_m_contract_time_inc_bd] option:selected').text(), '#opt_m_contract_time_inc_bd');});
    $('#opt_m_contract_time_inc_bm').change(function(){check_value_changed_10102(1, 'claim_hourly_monthly', $('[name=opt_m_contract_time_inc_bm] option:selected').text(), '#opt_m_contract_time_inc_bm');});
    $('#opt_contract_tighten_b').change(function(){check_value_changed_10102(1, 'claim_settlement_closingday', $('[name=opt_contract_tighten_b] option:selected').text(), '#opt_contract_tighten_b');});
    $('#opt_contract_bill_pay').change(function(){check_value_changed_10102(1, 'claim_settlement_paymentday', $('[name=opt_contract_bill_pay] option:selected').text(), '#opt_contract_bill_pay');});
    $('#opt_m_contract_yesno_b1').change(function(){check_value_changed_10102(1, 'claim_dispatch_individual_contract', $('[name=opt_m_contract_yesno_b1] option:selected').text(), '#opt_m_contract_yesno_b1');});
    $('#opt_m_contract_yesno_b2').change(function(){check_value_changed_10102(1, 'claim_quotation', $('[name=opt_m_contract_yesno_b2] option:selected').text(), '#opt_m_contract_yesno_b2');});
    $('#opt_m_contract_yesno_b3').change(function(){check_value_changed_10102(1, 'claim_purchase_order', $('[name=opt_m_contract_yesno_b3] option:selected').text(), '#opt_m_contract_yesno_b3');});
    $('#opt_m_contract_yesno_b4').change(function(){check_value_changed_10102(1, 'claim_confirmation_order', $('[name=opt_m_contract_yesno_b4] option:selected').text(), '#opt_m_contract_yesno_b4');});
    $('#inp_biko').keyup(function(){check_value_changed_10102(1, 'remarks', $('#inp_biko').val(), '#inp_biko');});

    $('#opt_contract_kind').change(function(){check_value_changed_10102(1, 'new_or_continued', $('[name=opt_contract_kind] option:selected').text(), '#opt_contract_kind');});
    $('#inp_keiyaku_no').keyup(function(){check_value_changed_10102(1, 'contract_number', $('#inp_keiyaku_no').val(), '#inp_keiyaku_no');});
    $('#inp_hakkobi').keyup(function(){check_value_changed_10102(2, 'publication', $('#inp_hakkobi').val(), '#inp_hakkobi');});
    $('#inp_hakkobi').change(function(){check_value_changed_10102(2, 'publication', $('#inp_hakkobi').val(), '#inp_hakkobi');});
    $('#inp_sakuseisya').keyup(function(){check_value_changed_10102(1, 'author', $('#inp_sakuseisya').val(), '#inp_sakuseisya');});
    $('#inp_engineer_no').keyup(function(){check_value_changed_10102(1, 'engineer_number', $('#inp_engineer_no').val(), '#inp_engineer_no');});

    $('#opt_contract_pay_form').change(function(){check_value_changed_10102(1, 'payment_contract_form', $('[name=opt_contract_pay_form] option:selected').text(), '#opt_contract_pay_form');});
    $('#inp_jigyosya_tanto').keyup(function(){check_value_changed_10102(1, 'business_charge_name', $('#inp_jigyosya_tanto').val(), '#inp_jigyosya_tanto');});
    $('#opt_social_insurance').change(function(){check_value_changed_10102(1, 'social_insurance', $('[name=opt_social_insurance] option:selected').text(), '#opt_social_insurance');});
    $('#opt_tax_withholding').change(function(){check_value_changed_10102(1, 'tax_withholding', $('[name=opt_tax_withholding] option:selected').text(), '#opt_tax_withholding');});
    $('#opt_contract_reduction').change(function(){check_value_changed_10102(1, 'redemption_ratio', $('[name=opt_contract_reduction] option:selected').text(), '#opt_contract_reduction');});

    $('#opt_contract_calc_p11').change(function(){
        check_value_changed_10102(1, 'payment_normal_calculation_1', $('[name=opt_contract_calc_p11] option:selected').text(), '#opt_contract_calc_p11');
        //[2018.01.18]課題解決管理表No.89
        if ($('[name=opt_contract_calc_p11] option:selected').text() == '固定'){
            $('#opt_m_contract_time_inc_pd').val('7');
            $('#opt_m_contract_time_inc_pm').val('7');
        }
    });
    $('#opt_contract_calc_p21').change(function(){
        check_value_changed_10102(1, 'payment_normal_calculation_2', $('[name=opt_contract_calc_p21] option:selected').text(), '#opt_contract_calc_p21');
        //[2018.01.18]課題解決管理表No.89
        if ($('[name=opt_contract_calc_p21] option:selected').text() == '固定'){
            $('#opt_m_contract_time_inc_pd').val('7');
            $('#opt_m_contract_time_inc_pm').val('7');
        }
    });
    $('#opt_contract_calc_p12').change(function(){
        check_value_changed_10102(1, 'payment_middle_calculation_1', $('[name=opt_contract_calc_p12] option:selected').text(), '#opt_contract_calc_p12');
        //[2018.01.18]課題解決管理表No.89
        if ($('[name=opt_contract_calc_p12] option:selected').text() == '固定'){
            $('#opt_m_contract_time_inc_pd').val('7');
            $('#opt_m_contract_time_inc_pm').val('7');
        }
    });
    $('#opt_contract_calc_p22').change(function(){
        check_value_changed_10102(1, 'payment_middle_calculation_2', $('[name=opt_contract_calc_p22] option:selected').text(), '#opt_contract_calc_p22');
        //[2018.01.18]課題解決管理表No.89
        if ($('[name=opt_contract_calc_p22] option:selected').text() == '固定'){
            $('#opt_m_contract_time_inc_pd').val('7');
            $('#opt_m_contract_time_inc_pm').val('7');
        }
    });
    $('#opt_contract_calc_p13').change(function(){
        check_value_changed_10102(1, 'payment_leaving_calculation_1', $('[name=opt_contract_calc_p13] option:selected').text(), '#opt_contract_calc_p13');
        //[2018.01.18]課題解決管理表No.89
        if ($('[name=opt_contract_calc_p13] option:selected').text() == '固定'){
            $('#opt_m_contract_time_inc_pd').val('7');
            $('#opt_m_contract_time_inc_pm').val('7');
        }
    });
    $('#opt_contract_calc_p23').change(function(){
        check_value_changed_10102(1, 'payment_leaving_calculation_2', $('[name=opt_contract_calc_p23] option:selected').text(), '#opt_contract_calc_p23');
        //[2018.01.18]課題解決管理表No.89
        if ($('[name=opt_contract_calc_p23] option:selected').text() == '固定'){
            $('#opt_m_contract_time_inc_pd').val('7');
            $('#opt_m_contract_time_inc_pm').val('7');
        }
    });

    $('#opt_m_contract_time_inc_pd').change(function(){check_value_changed_10102(1, 'payment_hourly_daily', $('[name=opt_m_contract_time_inc_pd] option:selected').text(), '#opt_m_contract_time_inc_pd');});
    $('#opt_m_contract_time_inc_pm').change(function(){check_value_changed_10102(1, 'payment_hourly_monthly', $('[name=opt_m_contract_time_inc_pm] option:selected').text(), '#opt_m_contract_time_inc_pm');});
    $('#opt_contract_tighten_p').change(function(){check_value_changed_10102(1, 'payment_settlement_closingday', $('[name=opt_contract_tighten_p] option:selected').text(), '#opt_contract_tighten_p');});
    $('#opt_contract_pay_pay').change(function(){check_value_changed_10102(1, 'payment_settlement_paymentday', $('[name=opt_contract_pay_pay] option:selected').text(), '#opt_contract_pay_pay');});
    $('#opt_contract_yesno_p1').change(function(){check_value_changed_10102(1, 'payment_absence_deduction_subject', $('[name=opt_contract_yesno_p1] option:selected').text(), '#opt_contract_yesno_p1');});
    $('#opt_contract_yesno_p2').change(function(){check_value_changed_10102(1, 'payment_quotation', $('[name=opt_contract_yesno_p2] option:selected').text(), '#opt_contract_yesno_p2');});
    $('#opt_contract_yesno_p3').change(function(){check_value_changed_10102(1, 'payment_purchase_order', $('[name=opt_contract_yesno_p3] option:selected').text(), '#opt_contract_yesno_p3');});
    $('#opt_contract_yesno_p4').change(function(){check_value_changed_10102(1, 'payment_confirmation_order', $('[name=opt_contract_yesno_p4] option:selected').text(), '#opt_contract_yesno_p4');});

    //[2017.11.22]bug-fixed.
    $('#txt_engineer_name').keyup(function(){set_jigyousya_info('txt_engineer_name','txt_jigyosya_name');});
    $('#txt_engineer_name').change(function(){set_jigyousya_info('txt_engineer_name','txt_jigyosya_name');});
    $('#txt_engineer_kana').keyup(function(){set_jigyousya_info('txt_engineer_kana','txt_jigyosya_kana');});
    $('#txt_engineer_kana').change(function(){set_jigyousya_info('txt_engineer_kana','txt_jigyosya_kana');});

    //[2018.01.18]項目追加
    //$('#contact_date_org').datepicker({});
    $('#contact_date_org').keyup(function(){check_value_changed_10102(2, 'contact_date_org', $('#contact_date_org').val(), '#contact_date_org');});
    //$('#contact_date_org').change(function(){check_value_changed_10102(2, 'contact_date_org', $('#contact_date_org').val(), '#contact_date_org');});
    
    $('#organization').keyup(function(){check_value_changed_10102(1, 'organization', $('#organization').val(), '#organization');});
    $('#dd_name').keyup(function(){check_value_changed_10102(1, 'dd_name', $('#dd_name').val(), '#dd_name');});
    $('#dd_branch').keyup(function(){check_value_changed_10102(1, 'dd_branch', $('#dd_branch').val(), '#dd_branch');});
    $('#dd_address').keyup(function(){check_value_changed_10102(1, 'dd_address', $('#dd_address').val(), '#dd_address');});
    $('#dd_tel').keyup(function(){check_value_changed_10102(1, 'dd_tel', $('#dd_tel').val(), '#dd_tel');});
    $('#ip_position').keyup(function(){check_value_changed_10102(1, 'ip_position', $('#ip_position').val(), '#ip_position');});
    $('#ip_name').keyup(function(){check_value_changed_10102(1, 'ip_name', $('#ip_name').val(), '#ip_name');});
    $('#dm_responsible_position').keyup(function(){check_value_changed_10102(1, 'dm_responsible_position', $('#dm_responsible_position').val(), '#dm_responsible_position');});
    $('#dm_responsible_name').keyup(function(){check_value_changed_10102(1, 'dm_responsible_name', $('#dm_responsible_name').val(), '#dm_responsible_name');});
    $('#dm_responsible_tel').keyup(function(){check_value_changed_10102(1, 'dm_responsible_tel', $('#dm_responsible_tel').val(), '#dm_responsible_tel');});
    $('#dd_responsible_position').keyup(function(){check_value_changed_10102(1, 'dd_responsible_position', $('#dd_responsible_position').val(), '#dd_responsible_position');});
    $('#dd_responsible_name').keyup(function(){check_value_changed_10102(1, 'dd_responsible_name', $('#dd_responsible_name').val(), '#dd_responsible_name');});
    $('#dd_responsible_tel').keyup(function(){check_value_changed_10102(1, 'dd_responsible_tel', $('#dd_responsible_tel').val(), '#dd_responsible_tel');});
    $('#chs_position1').keyup(function(){check_value_changed_10102(1, 'chs_position1', $('#chs_position1').val(), '#chs_position1');});
    $('#chs_name1').keyup(function(){check_value_changed_10102(1, 'chs_name1', $('#chs_name1').val(), '#chs_name1');});
    $('#chs_tel1').keyup(function(){check_value_changed_10102(1, 'chs_tel1', $('#chs_tel1').val(), '#chs_tel1');});
    $('#chs_position2').keyup(function(){check_value_changed_10102(1, 'chs_position2', $('#chs_position2').val(), '#chs_position2');});
    $('#chs_name2').keyup(function(){check_value_changed_10102(1, 'chs_name2', $('#chs_name2').val(), '#chs_name2');});
    $('#chs_tel2').keyup(function(){check_value_changed_10102(1, 'chs_tel2', $('#chs_tel2').val(), '#chs_tel2');});
    $('#remarks_pay').keyup(function(){check_value_changed_10102(1, 'remarks_pay', $('#remarks_pay').val(), '#remarks_pay');});

    $('#status_cd').change(function(){check_value_changed_10102(1, 'status_cd', $('[name=status_cd] option:selected').text(), '#status_cd');});
    //[2018.01.10]協の場合還元率を手入力
    $('#txt_contract_reduction').keyup(function(){check_value_changed_10102(1, 'redemption_ratio', $('#txt_contract_reduction').val(), '#txt_contract_reduction');});
    
    //[2018.01.18]課題解決管理表No.92
    $('#remarks2').keyup(function(){check_value_changed_10102(1, 'remarks2', $('#remarks2').val(), '#remarks2');});
    $('#remarks_pay2').keyup(function(){check_value_changed_10102(1, 'remarks_pay2', $('#remarks_pay2').val(), '#remarks_pay2');});

    //--------------------------------------------------------------------------
    //見積書
    //--------------------------------------------------------------------------
    $('#inp_estimate_date').datepicker({});

    //入力変更チェック
    $('#inp_estimate_no').keyup(function(){check_value_changed_10107(1, 'estimate_no', $('#inp_estimate_no').val(), '#inp_estimate_no');});
    $('#inp_estimate_date').keyup(function(){check_value_changed_10107(2, 'estimate_date', $('#inp_estimate_date').val(), '#inp_estimate_date');});
    $('#inp_estimate_date').change(function(){check_value_changed_10107(2, 'estimate_date', $('#inp_estimate_date').val(), '#inp_estimate_date');});

    //--------------------------------------------------------------------------
    //契約終了レポート
    //--------------------------------------------------------------------------
    $('#inp_retire_date').datepicker({});

    //入力変更チェック
    $('#opt_contarct_replace').change(function(){check_value_changed_10105(1, 'replace_person', $('[name=opt_contarct_replace] option:selected').text(), '#opt_contarct_replace');});
    $('#opt_contarct_end_status').change(function(){check_value_changed_10105(1, 'end_status', $('[name=opt_contarct_end_status] option:selected').text(), '#opt_contarct_end_status');});
    $('#inp_retire_date').keyup(function(){check_value_changed_10105(2, 'retire_date', $('#inp_retire_date').val(), '#inp_retire_date');});
    $('#inp_retire_date').change(function(){check_value_changed_10105(2, 'retire_date', $('#inp_retire_date').val(), '#inp_retire_date');});
    $('#opt_contarct_insurance_crad').change(function(){check_value_changed_10105(1, 'insurance_crad', $('[name=opt_contarct_insurance_crad] option:selected').text(), '#opt_contarct_insurance_crad');});
    $('#opt_contarct_employ_insurance').change(function(){check_value_changed_10105(1, 'employ_insurance', $('[name=opt_contarct_employ_insurance] option:selected').text(), '#opt_contarct_employ_insurance');});
    $('#opt_contarct_end_reason1').change(function(){check_value_changed_10105(1, 'end_reason1', $('[name=opt_contarct_end_reason1] option:selected').text(), '#opt_contarct_end_reason1');});
    $('#opt_contarct_end_reason2').change(function(){check_value_changed_10105(1, 'end_reason2', $('[name=opt_contarct_end_reason2] option:selected').text(), '#opt_contarct_end_reason2');});
    $('#opt_contarct_end_reason3').change(function(){check_value_changed_10105(1, 'end_reason3', $('[name=opt_contarct_end_reason3] option:selected').text(), '#opt_contarct_end_reason3');});
    $('#inp_end_reason_detail').keyup(function(){check_value_changed_10105(1, 'end_reason_detail', $('#inp_end_reason_detail').val(), '#inp_end_reason_detail');});
    $('#opt_contarct_from_now').change(function(){check_value_changed_10105(1, 'from_now', $('[name=opt_contarct_from_now] option:selected').text(), '#opt_contarct_from_now');});
    $('#opt_contarct_skill').change(function(){check_value_changed_10105(1, 'skill', $('[name=opt_contarct_skill] option:selected').text(), '#opt_contarct_skill');});
    $('#opt_contarct_conversation').change(function(){check_value_changed_10105(1, 'conversation', $('[name=opt_contarct_conversation] option:selected').text(), '#opt_contarct_conversation');});
    $('#opt_contarct_work_attitude').change(function(){check_value_changed_10105(1, 'work_attitude', $('[name=opt_contarct_work_attitude] option:selected').text(), '#opt_contarct_work_attitude');});
    $('#opt_contarct_personality').change(function(){check_value_changed_10105(1, 'personality', $('[name=opt_contarct_personality] option:selected').text(), '#opt_contarct_personality');});
    $('#opt_contarct_projects_confirm').change(function(){check_value_changed_10105(1, 'projects_confirm', $('[name=opt_contarct_projects_confirm] option:selected').text(), '#opt_contarct_projects_confirm');});
    $('#opt_contarct_engineer_list').change(function(){check_value_changed_10105(1, 'engineer_list', $('[name=opt_contarct_engineer_list] option:selected').text(), '#opt_contarct_engineer_list');});
    $('#inp_biko').keyup(function(){check_value_changed_10105(1, 'remarks', $('#inp_biko').val(), '#inp_biko');});

    // [2018.01.12]追加
    $('#retirement_date').datepicker({});
    $('#leave_date_start').datepicker({});
    $('#leave_date_end').datepicker({});
    //[2018.01.18]bug-fixed.
    $('#retirement_date').keyup(function(){check_value_changed_10105(2, 'retirement_date', $('#retirement_date').val(), '#retirement_date');});
    $('#retirement_date').change(function(){check_value_changed_10105(2, 'retirement_date', $('#retirement_date').val(), '#retirement_date');});
    $('#leave_date_start').keyup(function(){check_value_changed_10105(2, 'leave_date_start', $('#leave_date_start').val(), '#leave_date_start');});
    $('#leave_date_start').change(function(){check_value_changed_10105(2, 'leave_date_start', $('#leave_date_start').val(), '#leave_date_start');});
    $('#leave_date_end').keyup(function(){check_value_changed_10105(2, 'leave_date_end', $('#leave_date_end').val(), '#leave_date_end');});
    $('#leave_date_end').change(function(){check_value_changed_10105(2, 'leave_date_end', $('#leave_date_end').val(), '#leave_date_end');});
    $('#insurance_card_retirement').change(function(){check_value_changed_10105(1, 'insurance_card_retirement', $('[name=insurance_card_retirement] option:selected').text(), '#insurance_card_retirement');});
    $('#insurance_card_leave').change(function(){check_value_changed_10105(1, 'insurance_card_leave', $('[name=insurance_card_leave] option:selected').text(), '#insurance_card_leave');});

    //[2018.01.18]課題解決管理表No.92
    $('#remarks2').keyup(function(){check_value_changed_10105(1, 'remarks2', $('#remarks2').val(), '#remarks2');});
    $('#remarks_pay2').keyup(function(){check_value_changed_10105(1, 'remarks_pay2', $('#remarks_pay2').val(), '#remarks_pay2');});

    //条件検索
    $('#f_claim_agreement_start').datepicker({});
    $('#f_claim_agreement_end').datepicker({});
    //[2018.01.30]課題解決管理表No.87
    $('#f_claim_agreement_start_del').datepicker({});
    $('#f_claim_agreement_end_del').datepicker({});
    
});

function calc_bill_work_time()
{
    //--------------------------------------------------------------------------
    //請求サイド
    //--------------------------------------------------------------------------
    $('#txt_kyukei_jikan').val('');
    $('#txt_sagyo_jikan').val('');

    var a_timeS1 = $('#inp_kaishi1').val();
    var a_timeE1 = $('#inp_syuryo1').val();
    var a_timeS2 = $('#inp_kaishi2').val();
    var a_timeE2 = $('#inp_syuryo2').val();
    var a_timeS1_s;
    var a_timeE1_s;
    var a_timeS2_s;
    var a_timeE2_s;
    var a_isOK = false;
    var a_timeC2 = 0;
    var a_timeC1 = 0;
    var a_tmp;
    
    //休憩時間⇒終了時刻－開始時刻
    a_isOK = false;
    if (a_timeS2 != '') {
        a_timeS2_s = a_timeS2.split(":");
        if (a_timeE2 != '') {
            a_timeE2_s = a_timeE2.split(":");
            if (parseInt(a_timeS2_s[0])<=parseInt(a_timeE2_s[0])) {
                //開始時<=終了時
                a_isOK = true;
                if (parseInt(a_timeS2_s[0])==parseInt(a_timeE2_s[0])) {
                    //開始時=終了時
                    if (parseInt(a_timeS2_s[1])<=parseInt(a_timeE2_s[1])) {
                        //開始分<=終了分
                    } else {
                        a_isOK = false;
                    }
                }
            }
            if (a_isOK == true) {
                a_timeC2 = (parseInt(a_timeE2_s[0])*60 + parseInt(a_timeE2_s[1])) - (parseInt(a_timeS2_s[0])*60 + parseInt(a_timeS2_s[1]));
                //休憩時間
                a_tmp = Math.floor(a_timeC2/60);
                $('#txt_kyukei_jikan').val(a_tmp + ":" + ("00" + (a_timeC2-(a_tmp*60))).slice(-2));
                //$('#txt_kyukei_jikan').val(("00" + a_tmp).slice(-2) + ":" + ("00" + (a_timeC2-(a_tmp*60))).slice(-2));
            }
        }
    }
    //作業時間⇒終了時刻－開始時刻－休憩時間
    a_isOK = false;
    if (a_timeS1 != '') {
        a_timeS1_s = a_timeS1.split(":");
        if (a_timeE1 != ''){
            a_timeE1_s = a_timeE1.split(":");
            if (parseInt(a_timeS1_s[0])<=parseInt(a_timeE1_s[0])){
                //開始時<=終了時
                a_isOK = true;
                if (parseInt(a_timeS1_s[0])==parseInt(a_timeE1_s[0])) {
                    //開始時=終了時
                    if (parseInt(a_timeS1_s[1])<=parseInt(a_timeE1_s[1])) {
                        //開始分<=終了分
                    } else {
                        a_isOK = false;
                    }
                }
            }
            if (a_isOK == true) {
                a_timeC1 = (parseInt(a_timeE1_s[0])*60 + parseInt(a_timeE1_s[1])) - (parseInt(a_timeS1_s[0])*60 + parseInt(a_timeS1_s[1]));
                if (a_timeC2 != 0) {
                    a_timeC1 -= a_timeC2;
                }
                //作業時間
                a_tmp = Math.floor(a_timeC1/60);
                $('#txt_sagyo_jikan').val(a_tmp + ":" + ("00" + (a_timeC1-(a_tmp*60))).slice(-2));
                //$('#txt_sagyo_jikan').val(("00" + a_tmp).slice(-2) + ":" + ("00" + (a_timeC1-(a_tmp*60))).slice(-2));
            }
        }
    }
}

//通常期間の計算
function calc_bill_normal_period()
{
    //--------------------------------------------------------------------------
    //請求サイド
    //--------------------------------------------------------------------------
    $('#txt_contract_kojyo_unit_b1').val('');
    $('#txt_contract_zangyo_unit_b1').val('');

    var a_tankin = $('#inp_tankin_b1').val().replace(/,/g,"");  //[2017.11.09]課題No.82
    var a_lower_opt = $('[name=opt_contract_lower_limit_b1] option:selected').text();
    var a_upper_opt = $('[name=opt_contract_upper_limit_b1] option:selected').text();
    var a_lower_txt = $('#txt_contract_lower_limit_b1').val();
    var a_upper_txt = $('#txt_contract_upper_limit_b1').val();
    var a_trunc_txt1 = $('[name=opt_contract_trunc_unit_kojyo] option:selected').text();
    var a_trunc_txt2 = $('[name=opt_contract_trunc_unit_zangyo] option:selected').text();
    var a_tmp;

    if (a_lower_txt == ''){
        a_lower_txt = a_lower_opt;
    }
    if (a_upper_txt == ''){
        a_upper_txt = a_upper_opt;
    }

    if (a_tankin != '') {
        //通常期間：控除単価
        if (a_lower_txt != '') {
            if (isFinite(a_lower_txt) == true) {
                if (a_trunc_txt1 == '1円未満切捨') {
                    //  1円未満切り捨て⇒ROUNDDOWN(単金/下限時間,0)
                    $('#txt_contract_kojyo_unit_b1').val(Number(Math.floor(a_tankin/a_lower_txt)).toLocaleString());
                } else if (a_trunc_txt1 == '10円未満切捨') {
                    //  10円未満切り捨て⇒ROUNDDOWN(単金/下限時間,-1)
                    a_tmp = Math.floor((a_tankin/a_lower_txt)/10);
                    $('#txt_contract_kojyo_unit_b1').val(Number(a_tmp*10).toLocaleString());
                } else if (a_trunc_txt1 == '100円未満切捨') {
                    //  100円未満切り捨て⇒ROUNDDOWN(単金/下限時間,-2)
                    a_tmp = Math.floor((a_tankin/a_lower_txt)/100);
                    $('#txt_contract_kojyo_unit_b1').val(Number(a_tmp*100).toLocaleString());
                } else if (a_trunc_txt1 == '1円未満切上') {
                    //  1円未満切上⇒ROUNDDOWN(単金/下限時間,-2)
                    $('#txt_contract_kojyo_unit_b1').val(Number(Math.ceil(a_tankin/a_lower_txt)).toLocaleString());
                } else if (a_trunc_txt1 == '10円未満切上') {
                    //  10円未満切上⇒ROUNDDOWN(単金/下限時間,-2)
                    a_tmp = Math.ceil((a_tankin/a_lower_txt)/10);
                    $('#txt_contract_kojyo_unit_b1').val(Number(a_tmp*10).toLocaleString());
                } else if (a_trunc_txt1 == '100円未満切上') {
                    //  100円未満切上⇒ROUNDDOWN(単金/下限時間,-2)
                    a_tmp = Math.ceil((a_tankin/a_lower_txt)/100);
                    $('#txt_contract_kojyo_unit_b1').val(Number(a_tmp*100).toLocaleString());
                }
                $('#txt_contract_kojyo_unit_b1').attr('readonly',true);
                /*[2017.06.15]
                $('#txt_contract_kojyo_unit_p11').attr('readonly',true);
                $('#txt_contract_kojyo_unit_p21').attr('readonly',true);
                */
            } else {
                $('#txt_contract_kojyo_unit_b1').attr('readonly',false);
                /*[2017.06.15]
                $('#txt_contract_kojyo_unit_p11').attr('readonly',false);
                $('#txt_contract_kojyo_unit_p21').attr('readonly',false);
                */
            }
        } else {
            $('#txt_contract_kojyo_unit_b1').attr('readonly',true);
            /*[2017.06.15]
            $('#txt_contract_kojyo_unit_p11').attr('readonly',true);
            $('#txt_contract_kojyo_unit_p21').attr('readonly',true);
            */
        }
        
        //通常期間：残業単価
        if (a_upper_txt != '') {
            if (isFinite(a_upper_txt) == true) {
                if (a_trunc_txt2 == '1円未満切捨') {
                    //  1円未満切り捨て⇒ROUNDDOWN(単金/上限時間,0)
                    $('#txt_contract_zangyo_unit_b1').val(Number(Math.floor(a_tankin/a_upper_txt)).toLocaleString());
                } else if (a_trunc_txt2 == '10円未満切捨') {
                    //  10円未満切り捨て⇒ROUNDDOWN(単金/上限時間,-1)
                    a_tmp = Math.floor((a_tankin/a_upper_txt)/10);
                    $('#txt_contract_zangyo_unit_b1').val(Number(a_tmp*10).toLocaleString());
                } else if (a_trunc_txt2 == '100円未満切捨') {
                    //  100円未満切り捨て⇒ROUNDDOWN(単金/上限時間,-2)
                    a_tmp = Math.floor((a_tankin/a_upper_txt)/100);
                    $('#txt_contract_zangyo_unit_b1').val(Number(a_tmp*100).toLocaleString());
                } else if (a_trunc_txt2 == '1円未満切上') {
                    //  1円未満切上⇒ROUNDDOWN(単金/下限時間,-2)
                    $('#txt_contract_zangyo_unit_b1').val(Number(Math.ceil(a_tankin/a_upper_txt)).toLocaleString());
                } else if (a_trunc_txt2 == '10円未満切上') {
                    //  10円未満切上⇒ROUNDDOWN(単金/下限時間,-2)
                    a_tmp = Math.ceil((a_tankin/a_upper_txt)/10);
                    $('#txt_contract_zangyo_unit_b1').val(Number(a_tmp*10).toLocaleString());
                } else if (a_trunc_txt2 == '100円未満切上') {
                    //  100円未満切上⇒ROUNDDOWN(単金/下限時間,-2)
                    a_tmp = Math.ceil((a_tankin/a_upper_txt)/100);
                    $('#txt_contract_zangyo_unit_b1').val(Number(a_tmp*100).toLocaleString());
                }
                $('#txt_contract_zangyo_unit_b1').attr('readonly',true);
                /*[2017.06.15]
                $('#txt_contract_zangyo_unit_p11').attr('readonly',true);
                $('#txt_contract_zangyo_unit_p21').attr('readonly',true);
                */
            } else {
                $('#txt_contract_zangyo_unit_b1').attr('readonly',false);
                /*[2017.06.15]
                $('#txt_contract_zangyo_unit_p11').attr('readonly',false);
                $('#txt_contract_zangyo_unit_p21').attr('readonly',false);
                */
            }
        } else {
            $('#txt_contract_zangyo_unit_b1').attr('readonly',true);
            /*[2017.06.15]
            $('#txt_contract_zangyo_unit_p11').attr('readonly',true);
            $('#txt_contract_zangyo_unit_p21').attr('readonly',true);
            */
        }
    }
}

//途中入場の計算
function calc_bill_middle_admission()
{
    //--------------------------------------------------------------------------
    //請求サイド
    //--------------------------------------------------------------------------
    var a_tankin = $('#inp_tankin_b1').val().replace(/,/g,"");  //[2017.11.09]課題No,82
    var a_lower_opt = $('[name=opt_contract_lower_limit_b1] option:selected').text();
    var a_upper_opt = $('[name=opt_contract_upper_limit_b1] option:selected').text();
    var a_lower_txt = $('#txt_contract_lower_limit_b1').val();
    var a_upper_txt = $('#txt_contract_upper_limit_b1').val();
    var a_kojyo_unit = $('#txt_contract_kojyo_unit_b1').val();
    var a_zangyo_unit = $('#txt_contract_zangyo_unit_b1').val();
    var a_syugyonisu = $('#inp_syugyonisu_b2').val();
    var a_zeneigyonisu = $('#inp_zeneigyonisu_b2').val();
    var a_tmp;

    if (a_lower_txt == ''){
        a_lower_txt = a_lower_opt;
    }
    if (a_upper_txt == ''){
        a_upper_txt = a_upper_opt;
    }

    //日割り時の割合：自動計算⇒IF(OR(就業日数="",全営業日数=""),"",(就業日数/全営業日数))
    if ((a_syugyonisu == '') || (a_zeneigyonisu == '')) {
        $('#inp_wariai_nyujyo_c1').val('');
    } else {
        a_tmp = parseInt(a_syugyonisu)/parseInt(a_zeneigyonisu);
        //a_tmp = parseInt(a_syugyonisu)/parseInt(a_zeneigyonisu)*10000;
        //a_tmp = Math.floor(a_tmp)/10000;
        $('#inp_wariai_nyujyo_c1').val(a_tmp);
    }

    var a_wariai_c1 = $('#inp_wariai_nyujyo_c1').val();
    var a_wariai_c2 = $('#inp_wariai_nyujyo_c2').val();
    
    //日割り時の割合：手入力⇒★手入力が必要？
    //単金⇒IF(OR(就業日数="",自動計算=""),"",IF(手入力<>"",通常単金*手入力,通常単金*自動計算))
    if ((a_syugyonisu == '') || (a_wariai_c1 == '')) {
        $('#txt_tankin_b2').val('');
    } else if (a_wariai_c2 != '') {
        $('#txt_tankin_b2').val(Number(Math.round(a_tankin*a_wariai_c2)).toLocaleString());
    } else {
        $('#txt_tankin_b2').val(Number(Math.round(a_tankin*a_wariai_c1)).toLocaleString());
    }
    
    //下限時間⇒IF(就業日数="","",TRUNC(IF(OR(就業日数="",自動計算=""),"",IF(手入力<>"",通常下限時間*手入力,通常下限時間*自動計算))))
    if ((a_syugyonisu == '') || (a_wariai_c1 == '')) {
        //$('#opt_contract_lower_limit_b2').val(0); //[2017.11.09]課題No.81
        $("#txt_contract_lower_limit_b2").val('');  //[2017.11.09]課題No.81
    } else if (a_wariai_c2 != '') {
        if (a_lower_txt != '') {
            if (isFinite(a_lower_txt) == true) {
                a_tmp = Math.floor(a_lower_txt*a_wariai_c2);
                $("#txt_contract_lower_limit_b2").val(a_tmp);
                /*
                $("#opt_contract_lower_limit_b2").append( function(){
                    if($("#opt_contract_lower_limit_b2 option[value='" + a_tmp +"']").size() == 0) {
                        return $("<option>").val(a_tmp).text(a_tmp);
                    }
                });
                $('#opt_contract_lower_limit_b2').val(a_tmp);
                */
            } else {
                //$('#opt_contract_lower_limit_b2').val(0);   //[2017.11.09]課題No.81
                $("#txt_contract_lower_limit_b2").val('');  //[2017.11.09]課題No.81
            }
        } else {
            //$('#opt_contract_lower_limit_b2').val(0); //[2017.11.09]課題No.81
            $("#txt_contract_lower_limit_b2").val('');  //[2017.11.09]課題No.81
        }
    } else {
        if (a_lower_txt != '') {
            if (isFinite(a_lower_txt) == true) {
                a_tmp = Math.floor(a_lower_txt*a_wariai_c1);
                $("#txt_contract_lower_limit_b2").val(a_tmp);
                /*
                $("#opt_contract_lower_limit_b2").append( function(){
                    if($("#opt_contract_lower_limit_b2 option[value='" + a_tmp +"']").size() == 0) {
                        return $("<option>").val(a_tmp).text(a_tmp);
                    }
                });
                $('#opt_contract_lower_limit_b2').val(a_tmp);
                */
            } else {
                //$('#opt_contract_lower_limit_b2').val(0); //[2017.11.09]課題No.81
                $("#txt_contract_lower_limit_b2").val('');  //[2017.11.09]課題No.81
            }
        } else {
            //$('#opt_contract_lower_limit_b2').val(0); //[2017.11.09]課題No.81
            $("#txt_contract_lower_limit_b2").val('');  //[2017.11.09]課題No.81
        }
    }
    //$('#txt_contract_kojyo_unit_b2').attr('readonly',true);
    
    //上限時間⇒IF(就業日数="","",TRUNC(IF(OR(就業日数="",自動計算=""),"",IF(手入力<>"",通常上限時間*手入力,通常上限時間*自動計算))))
    if ((a_syugyonisu == '') || (a_wariai_c1 == '')) {
        //$('#opt_contract_upper_limit_b2').val(0); //[2017.11.09]課題No.81
        $("#txt_contract_upper_limit_b2").val('');  //[2017.11.09]課題No.81
    } else if (a_wariai_c2 != '') {
        if (a_upper_txt != '') {
            if (isFinite(a_upper_txt) == true) {
                a_tmp = Math.floor(a_upper_txt*a_wariai_c2);
                $("#txt_contract_upper_limit_b2").val(a_tmp);
                /*
                $("#opt_contract_upper_limit_b2").append( function(){
                    if($("#opt_contract_upper_limit_b2 option[value='" + a_tmp +"']").size() == 0) {
                        return $("<option>").val(a_tmp).text(a_tmp);
                    }
                });
                $('#opt_contract_upper_limit_b2').val(a_tmp);
                */
            } else {
                //$('#opt_contract_upper_limit_b2').val(0); //[2017.11.09]課題No.81
                $("#txt_contract_upper_limit_b2").val('');  //[2017.11.09]課題No.81
            }
        } else {
            //$('#opt_contract_upper_limit_b2').val(0); //[2017.11.09]課題No.81
            $("#txt_contract_upper_limit_b2").val('');  //[2017.11.09]課題No.81
        }
    } else {
        if (a_upper_txt != '') {
            if (isFinite(a_upper_txt) == true) {
                a_tmp = Math.floor(a_upper_txt*a_wariai_c1);
                $("#txt_contract_upper_limit_b2").val(a_tmp);
                /*
                $("#opt_contract_upper_limit_b2").append( function(){
                    if($("#opt_contract_upper_limit_b2 option[value='" + a_tmp +"']").size() == 0) {
                        return $("<option>").val(a_tmp).text(a_tmp);
                    }
                });
                $('#opt_contract_upper_limit_b2').val(a_tmp);
                */
            } else {
                //$('#opt_contract_upper_limit_b2').val(0); //[2017.11.09]課題No.81
                $("#txt_contract_upper_limit_b2").val('');  //[2017.11.09]課題No.81
            }
        } else {
            //$('#opt_contract_upper_limit_b2').val(0); //[2017.11.09]課題No.81
            $("#txt_contract_upper_limit_b2").val('');  //[2017.11.09]課題No.81
        }
    }
    //$('#txt_contract_zangyo_unit_b2').attr('readonly',true);
    
    //控除単価⇒IF(就業日数<>"",通常控除単価,"")
    if (a_syugyonisu != '') {
        $('#txt_contract_kojyo_unit_b2').val(a_kojyo_unit);
    } else {
        $('#txt_contract_kojyo_unit_b2').val('');
    }
    
    //残業単価⇒IF(就業日数<>"",通常残業単価,"")
    if (a_syugyonisu != '') {
        $('#txt_contract_zangyo_unit_b2').val(a_zangyo_unit);
    } else {
        $('#txt_contract_zangyo_unit_b2').val('');
    }
}

function calc_bill_middle_admission_lower_limit()
{
    //var a_lower_opt = $('[name=opt_contract_lower_limit_b2] option:selected').text(); //[2017.11.09]課題No.81
    var a_lower_txt = $('#txt_contract_lower_limit_b2').val();

    /*[2017.11.09]課題No.81
    if (a_lower_txt == ''){
        a_lower_txt = a_lower_opt;
    }
    */

    $('#txt_contract_lower_limit_p12').val(a_lower_txt);
    $('#txt_contract_lower_limit_p22').val(a_lower_txt);
    
    if (a_lower_txt != '') {
        if (isFinite(a_lower_txt) == true) {
            $('#txt_contract_kojyo_unit_b2').attr('readonly',true);
            /*[2017.06.15]
            $('#txt_contract_kojyo_unit_p12').attr('readonly',true);
            $('#txt_contract_kojyo_unit_p22').attr('readonly',true);
            */
        } else {
            $('#txt_contract_kojyo_unit_b2').attr('readonly',false);
            /*[2017.06.15]
            $('#txt_contract_kojyo_unit_p12').attr('readonly',false);
            $('#txt_contract_kojyo_unit_p22').attr('readonly',false);
            */
        }
    } else {
        $('#txt_contract_kojyo_unit_b2').attr('readonly',true);
        /*[2017.06.15]
        $('#txt_contract_kojyo_unit_p12').attr('readonly',true);
        $('#txt_contract_kojyo_unit_p22').attr('readonly',true);
        */
    }
}

function calc_bill_middle_admission_upper_limit()
{
    //var a_upper_opt = $('[name=opt_contract_upper_limit_b2] option:selected').text(); //[2017.11.09]課題No.81
    var a_upper_txt = $('#txt_contract_upper_limit_b2').val();

    /*[2017.11.09]課題No.81
    if (a_upper_txt == ''){
        a_upper_txt = a_upper_opt;
    }
    */

    $('#txt_contract_upper_limit_p12').val(a_upper_txt);
    $('#txt_contract_upper_limit_p22').val(a_upper_txt);

    if (a_upper_txt != '') {
        if (isFinite(a_upper_txt) == true) {
            $('#txt_contract_zangyo_unit_b2').attr('readonly',true);
            /*[2017.06.15]
            $('#txt_contract_zangyo_unit_p12').attr('readonly',true);
            $('#txt_contract_zangyo_unit_p22').attr('readonly',true);
            */
        } else {
            $('#txt_contract_zangyo_unit_b2').attr('readonly',false);
            /*[2017.06.15]
            $('#txt_contract_zangyo_unit_p12').attr('readonly',false);
            $('#txt_contract_zangyo_unit_p22').attr('readonly',false);
            */
        }
    } else {
        $('#txt_contract_zangyo_unit_b2').attr('readonly',true);
        /*[2017.06.15]
        $('#txt_contract_zangyo_unit_p12').attr('readonly',true);
        $('#txt_contract_zangyo_unit_p22').attr('readonly',true);
        */
    }
}

//途中退場の計算
function calc_bill_midway_retirement()
{
    //--------------------------------------------------------------------------
    //請求サイド
    //--------------------------------------------------------------------------
    var a_tankin = $('#inp_tankin_b1').val().replace(/,/g,"");  //[2017.11.09]課題No,82
    var a_lower_opt = $('[name=opt_contract_lower_limit_b1] option:selected').text();
    var a_upper_opt = $('[name=opt_contract_upper_limit_b1] option:selected').text();
    var a_lower_txt = $('#txt_contract_lower_limit_b1').val();
    var a_upper_txt = $('#txt_contract_upper_limit_b1').val();
    var a_kojyo_unit = $('#txt_contract_kojyo_unit_b1').val();
    var a_zangyo_unit = $('#txt_contract_zangyo_unit_b1').val();
    var a_syugyonisu = $('#inp_syugyonisu_b3').val();
    var a_zeneigyonisu = $('#inp_zeneigyonisu_b3').val();
    var a_tmp;

    if (a_lower_txt == ''){
        a_lower_txt = a_lower_opt;
    }
    if (a_upper_txt == ''){
        a_upper_txt = a_upper_opt;
    }

    //日割り時の割合：自動計算⇒IF(OR(就業日数="",全営業日数=""),"",(就業日数/全営業日数))
    if ((a_syugyonisu == '') || (a_zeneigyonisu == '')) {
        $('#inp_wariai_taijyo_c1').val('');
    } else {
        a_tmp = parseInt(a_syugyonisu)/parseInt(a_zeneigyonisu);
        //a_tmp = parseInt(a_syugyonisu)/parseInt(a_zeneigyonisu)*10000;
        //a_tmp = Math.floor(a_tmp)/10000;
        $('#inp_wariai_taijyo_c1').val(a_tmp);
    }
    
    var a_wariai_c1 = $('#inp_wariai_taijyo_c1').val();
    var a_wariai_c2 = $('#inp_wariai_taijyo_c2').val();
    
    //日割り時の割合：手入力⇒★手入力が必要？
    //単金⇒IF(OR(就業日数="",自動計算=""),"",IF(手入力<>"",通常単金*手入力,通常単金*自動計算))
    if ((a_syugyonisu == '') || (a_wariai_c1 == '')) {
        $('#txt_tankin_b3').val('');
    } else if (a_wariai_c2 != '') {
        $('#txt_tankin_b3').val(Number(Math.round(a_tankin*a_wariai_c2)).toLocaleString());
    } else {
        $('#txt_tankin_b3').val(Number(Math.round(a_tankin*a_wariai_c1)).toLocaleString());
    }
    
    //下限時間⇒IF(就業日数="","",TRUNC(IF(OR(就業日数="",自動計算=""),"",IF(手入力<>"",通常下限時間*手入力,通常下限時間*自動計算))))
    if ((a_syugyonisu == '') || (a_wariai_c1 == '')) {
        //$('#opt_contract_lower_limit_b3').val(0); //[2017.11.09]課題No.81
        $("#txt_contract_lower_limit_b3").val('');  //[2017.11.09]課題No.81
    } else if (a_wariai_c2 != '') {
        if (a_lower_txt != '') {
            if (isFinite(a_lower_txt) == true) {
                a_tmp = Math.floor(a_lower_txt*a_wariai_c2);
                $("#txt_contract_lower_limit_b3").val(a_tmp);
                /*
                $("#opt_contract_lower_limit_b3").append( function(){
                    if($("#opt_contract_lower_limit_b3 option[value='" + a_tmp +"']").size() == 0) {
                        return $("<option>").val(a_tmp).text(a_tmp);
                    }
                });
                $('#opt_contract_lower_limit_b3').val(a_tmp);
                */
            } else {
                //$('#opt_contract_lower_limit_b3').val(0); //[2017.11.09]課題No.81
                $("#txt_contract_lower_limit_b3").val('');  //[2017.11.09]課題No.81
            }
        } else {
            //$('#opt_contract_lower_limit_b3').val(0); //[2017.11.09]課題No.81
            $("#txt_contract_lower_limit_b3").val('');  //[2017.11.09]課題No.81
        }
    } else {
        if (a_lower_txt != '') {
            if (isFinite(a_lower_txt) == true) {
                a_tmp = Math.floor(a_lower_txt*a_wariai_c1);
                $("#txt_contract_lower_limit_b3").val(a_tmp);
                /*
                $("#opt_contract_lower_limit_b3").append( function(){
                    if($("#opt_contract_lower_limit_b3 option[value='" + a_tmp +"']").size() == 0) {
                        return $("<option>").val(a_tmp).text(a_tmp);
                    }
                });
                $('#opt_contract_lower_limit_b3').val(a_tmp);
                */
            } else {
                //$('#opt_contract_lower_limit_b3').val(0); //[2017.11.09]課題No.81
                $("#txt_contract_lower_limit_b3").val('');  //[2017.11.09]課題No.81
            }
        } else {
            //$('#opt_contract_lower_limit_b3').val(0); //[2017.11.09]課題No.81
            $("#txt_contract_lower_limit_b3").val('');  //[2017.11.09]課題No.81
        }
    }
    //$('#txt_contract_kojyo_unit_b3').attr('readonly',true);
    
    //上限時間⇒IF(就業日数="","",TRUNC(IF(OR(就業日数="",自動計算=""),"",IF(手入力<>"",通常上限時間*手入力,通常上限時間*自動計算))))
    if ((a_syugyonisu == '') || (a_wariai_c1 == '')) {
        //$('#opt_contract_upper_limit_b3').val(0); //[2017.11.09]課題No.81
        $("#txt_contract_upper_limit_b3").val('');  //[2017.11.09]課題No.81
    } else if (a_wariai_c2 != '') {
        if (a_upper_txt != '') {
            if (isFinite(a_upper_txt) == true) {
                a_tmp = Math.floor(a_upper_txt*a_wariai_c2);
                $("#txt_contract_upper_limit_b3").val(a_tmp);
                /*
                $("#opt_contract_upper_limit_b3").append( function(){
                    if($("#opt_contract_upper_limit_b3 option[value='" + a_tmp +"']").size() == 0) {
                        return $("<option>").val(a_tmp).text(a_tmp);
                    }
                });
                $('#opt_contract_upper_limit_b3').val(a_tmp);
                */
            } else {
                //$('#opt_contract_upper_limit_b3').val(0); //[2017.11.09]課題No.81
                $("#txt_contract_upper_limit_b3").val('');  //[2017.11.09]課題No.81
            }
        } else {
            //$('#opt_contract_upper_limit_b3').val(0); //[2017.11.09]課題No.81
            $("#txt_contract_upper_limit_b3").val('');  //[2017.11.09]課題No.81
        }
    } else {
        if (a_upper_txt != '') {
            if (isFinite(a_upper_txt) == true) {
                a_tmp = Math.floor(a_upper_txt*a_wariai_c1);
                $("#txt_contract_upper_limit_b3").val(a_tmp);
                /*
                $("#opt_contract_upper_limit_b3").append( function(){
                    if($("#opt_contract_upper_limit_b3 option[value='" + a_tmp +"']").size() == 0) {
                        return $("<option>").val(a_tmp).text(a_tmp);
                    }
                });
                $('#opt_contract_upper_limit_b3').val(a_tmp);
                */
            } else {
                //$('#opt_contract_upper_limit_b3').val(0); //[2017.11.09]課題No.81
                $("#txt_contract_upper_limit_b3").val('');  //[2017.11.09]課題No.81
            }
        } else {
            //$('#opt_contract_upper_limit_b3').val(0); //[2017.11.09]課題No.81
            $("#txt_contract_upper_limit_b3").val('');  //[2017.11.09]課題No.81
        }
    }
    //$('#txt_contract_zangyo_unit_b3').attr('readonly',true);
    
    //控除単価⇒IF(就業日数<>"",通常控除単価,"")
    if (a_syugyonisu != '') {
        $('#txt_contract_kojyo_unit_b3').val(a_kojyo_unit);
    } else {
        $('#txt_contract_kojyo_unit_b3').val('');
    }
    //残業単価⇒IF(就業日数<>"",通常残業単価,"")
    if (a_syugyonisu != '') {
        $('#txt_contract_zangyo_unit_b3').val(a_zangyo_unit);
    } else {
        $('#txt_contract_zangyo_unit_b3').val('');
    }
}

function calc_bill_midway_retirement_lower_limit()
{
    //var a_lower_opt = $('[name=opt_contract_lower_limit_b3] option:selected').text(); //[2017.11.09]課題No.81
    var a_lower_txt = $('#txt_contract_lower_limit_b3').val();
    
    /*[2017.11.09]課題No.81
    if (a_lower_txt == ''){
        a_lower_txt = a_lower_opt;
    }
    */

    $('#txt_contract_lower_limit_p13').val(a_lower_txt);
    $('#txt_contract_lower_limit_p23').val(a_lower_txt);
    
    if (a_lower_txt != '') {
        if (isFinite(a_lower_txt) == true) {
            $('#txt_contract_kojyo_unit_b3').attr('readonly',true);
            /*[2017.06.15]
            $('#txt_contract_kojyo_unit_p13').attr('readonly',true);
            $('#txt_contract_kojyo_unit_p23').attr('readonly',true);
            */
        } else {
            $('#txt_contract_kojyo_unit_b3').attr('readonly',false);
            /*[2017.06.15]
            $('#txt_contract_kojyo_unit_p13').attr('readonly',false);
            $('#txt_contract_kojyo_unit_p23').attr('readonly',false);
            */
        }
    } else {
        $('#txt_contract_kojyo_unit_b3').attr('readonly',true);
        /*[2017.06.15]
        $('#txt_contract_kojyo_unit_p13').attr('readonly',true);
        $('#txt_contract_kojyo_unit_p23').attr('readonly',true);
        */
    }
}

function calc_bill_midway_retirement_upper_limit()
{
    //var a_upper_opt = $('[name=opt_contract_upper_limit_b3] option:selected').text(); //[2017.11.09]課題No.81
    var a_upper_txt = $('#txt_contract_upper_limit_b3').val();
    
    /*[2017.11.09]課題No.81
    if (a_upper_txt == ''){
        a_upper_txt = a_upper_opt;
    }
    */

    $('#txt_contract_upper_limit_p13').val(a_upper_txt);
    $('#txt_contract_upper_limit_p23').val(a_upper_txt);

    if (a_upper_txt != '') {
        if (isFinite(a_upper_txt) == true) {
            $('#txt_contract_zangyo_unit_b3').attr('readonly',true);
            /*[2017.06.15]
            $('#txt_contract_zangyo_unit_p13').attr('readonly',true);
            $('#txt_contract_zangyo_unit_p23').attr('readonly',true);
            */
        } else {
            $('#txt_contract_zangyo_unit_b3').attr('readonly',false);
            /*[2017.06.15]
            $('#txt_contract_zangyo_unit_p13').attr('readonly',false);
            $('#txt_contract_zangyo_unit_p23').attr('readonly',false);
            */
        }
    } else {
        $('#txt_contract_zangyo_unit_b3').attr('readonly',true);
        /*[2017.06.15]
        $('#txt_contract_zangyo_unit_p13').attr('readonly',true);
        $('#txt_contract_zangyo_unit_p23').attr('readonly',true);
        */
    }
}

//決済等の計算
function calc_bill_settlement()
{
    //--------------------------------------------------------------------------
    //請求サイド
    //--------------------------------------------------------------------------
    //ラベル⇒IF(契約形態<>"派遣","見積依頼書","派遣個別契約書")
}

//事業者の計算
function calc_pay_person()
{
    //--------------------------------------------------------------------------
    //支払いサイド
    //--------------------------------------------------------------------------
    var a_contract_form = $('[name=opt_contract_pay_form] option:selected').text();
    //事業者⇒エンジニア氏名
    
    //源泉徴収⇒IF(契約形態="","",IF(OR(契約形態="正", 契約形態="契"),"有","無"))
    if (a_contract_form == '') {
        $('#opt_tax_withholding').val(0);
    } else if ((a_contract_form == '正') || (a_contract_form == '契')) {
        $('#opt_social_insurance').val(1);
        $('#opt_tax_withholding').val(1);
        //事業所名・事業所名を入力不可とし、エンジニア名・フリガナを設定
        $('#txt_jigyosya_name').val($('#txt_engineer_name').val());
        $('#txt_jigyosya_kana').val($('#txt_engineer_kana').val());
        $('#txt_jigyosya_name').attr('readonly',true);
        $('#txt_jigyosya_kana').attr('readonly',true);
    } else {
        $('#opt_social_insurance').val(2);
        $('#opt_tax_withholding').val(2);
        //事業所名・事業所名を入力可とし、空を設定
        $('#txt_jigyosya_name').val('');
        $('#txt_jigyosya_kana').val('');
        $('#txt_jigyosya_name').attr('readonly',false);
        $('#txt_jigyosya_kana').attr('readonly',false);
    }
    
    //契約開始日⇒請求サイド契約開始日
    $('#txt_kyakusaki_kaishi').val($('#inp_kyakusaki_kaishi').val());
    
    //契約終了日⇒請求サイド契約終了日
    $('#txt_kyakusaki_syuryo').val($('#inp_kyakusaki_syuryo').val());
    
    //[2018.01.10]協の場合還元率を手入力
    if (a_contract_form == '協'){
        $('#opt_contract_reduction').val(0);
        //$('#opt_contract_reduction').attr('readonly',true);
        $('#txt_contract_reduction').attr('readonly',false);
    }else{
        $('#txt_contract_reduction').val('');
        $('#txt_contract_reduction').attr('readonly',true);
        //$('#opt_contract_reduction').attr('readonly',false);
    }
}

//通常期間の計算
function calc_pay_normal_period()
{
    //--------------------------------------------------------------------------
    //支払いサイド
    //--------------------------------------------------------------------------
    var a_tankin = $('#inp_tankin_b1').val().replace(/,/g,"");  //[2017.11.09]課題No.82
    var a_tankin_base = $('#claim_normal_unit_price_base').val().replace(/,/g,""); //[2018.01.26]↓課題No.91
    var a_lower_opt = $('[name=opt_contract_lower_limit_b1] option:selected').text();
    var a_upper_opt = $('[name=opt_contract_upper_limit_b1] option:selected').text();
    var a_lower_txt = $('#txt_contract_lower_limit_b1').val();
    var a_upper_txt = $('#txt_contract_upper_limit_b1').val();
    
    var a_kangen = $('[name=opt_contract_reduction] option:selected').text();
    //[2018.01.10]協の場合還元率を手入力
    var a_contract_form = $('[name=opt_contract_pay_form] option:selected').text();
    if (a_contract_form == '協'){
        a_kangen = $('#txt_contract_reduction').val();
    }

    //①エンジニア還元金額
    var a_tankin_p11;
    var a_tankin_p21;
    var a_lower_p11;
    var a_lower_p21;
    var a_upper_p11;
    var a_upper_p21;
    
    if (a_lower_txt == ''){
        a_lower_txt = a_lower_opt;
    }
    if (a_upper_txt == ''){
        a_upper_txt = a_upper_opt;
    }

    //単金⇒IF(請求サイド通常単金<>"",請求サイド通常単金*(還元率/100),"")
    if ((a_tankin == '') || (a_kangen == '')) {
        $('#txt_tankin_p11').val('');
        $('#txt_tankin_p21').val('');
        set_pay_input_mode(true);
    } else {
        if (isFinite(a_kangen) == true){
            $('#txt_tankin_p11').val(Number(Math.round(a_tankin*(a_kangen/100))).toLocaleString());
            $('#txt_tankin_p21').val(Number(Math.round(a_tankin*((a_kangen-20)/100))).toLocaleString());
            set_pay_input_mode(true);
        }else{
            set_pay_input_mode(false);
        }
    }
    a_tankin_p11 = $('#txt_tankin_p11').val().replace(/,/g,""); //[2017.11.07]課題No.79
    a_tankin_p21 = $('#txt_tankin_p21').val().replace(/,/g,""); //[2017.11.07]課題No.79
    
    //[2018.01.26]↓課題No.91
    //ベース単金
    if ((a_tankin_base == '') || (a_kangen == '')) {
        $('#payment_normal_unit_price_1_base').val('');
        $('#payment_normal_unit_price_2_base').val('');
    } else {
        if (isFinite(a_kangen) == true){
            $('#payment_normal_unit_price_1_base').val(Number(Math.round(a_tankin_base*(a_kangen/100))).toLocaleString());
            $('#payment_normal_unit_price_2_base').val(Number(Math.round(a_tankin_base*((a_kangen-20)/100))).toLocaleString());
            a_tankin_p11 = $('#payment_normal_unit_price_1_base').val().replace(/,/g,"");
            a_tankin_p21 = $('#payment_normal_unit_price_2_base').val().replace(/,/g,"");
        }else{
        }
    }
    //[2018.01.26]↑課題No.91

    //下限時間⇒IF(請求サイド通常下限時間="","",請求サイド通常下限時間)
    //if ((a_lower_txt == '') || (isFinite(a_lower_txt) == false)) {
    if (a_lower_txt == '') {
        $('#txt_contract_lower_limit_p11').val('');
        $('#txt_contract_lower_limit_p21').val('');
    } else {
        $('#txt_contract_lower_limit_p11').val(a_lower_txt);
        $('#txt_contract_lower_limit_p21').val(a_lower_txt);
    }
    a_lower_p11 = $('#txt_contract_lower_limit_p11').val();
    a_lower_p21 = $('#txt_contract_lower_limit_p21').val();
    
    //上限時間⇒IF(請求サイド通常上限時間="","",請求サイド通常上限時間)
    //if ((a_upper_txt == '') || (isFinite(a_upper_txt) == false)) {
    if (a_upper_txt == '') {
        $('#txt_contract_upper_limit_p11').val('');
        $('#txt_contract_upper_limit_p21').val('');
    } else {
        $('#txt_contract_upper_limit_p11').val(a_upper_txt);
        $('#txt_contract_upper_limit_p21').val(a_upper_txt);
    }
    a_upper_p11 = $('#txt_contract_upper_limit_p11').val();
    a_upper_p21 = $('#txt_contract_upper_limit_p21').val();
    
    //通常期間：控除単価・残業単価
    var a_trunc_txt1 = $('[name=opt_contract_trunc_unit_kojyo] option:selected').text();
    var a_trunc_txt2 = $('[name=opt_contract_trunc_unit_zangyo] option:selected').text();
    $('#txt_contract_kojyo_unit_p11').val('');
    $('#txt_contract_zangyo_unit_p11').val('');
    if (a_tankin_p11 != '') {
        a_tankin_p11 = a_tankin_p11.replace(/,/g,""); //[2017.11.07]課題No.79
        //通常期間：控除単価
        if ((a_lower_p11 != '') && (isFinite(a_lower_p11) == true)) {
            if (a_trunc_txt1 == '1円未満切捨') {
                //  1円未満切り捨て⇒ROUNDDOWN(単金/下限時間*(還元率/100),0)
                $('#txt_contract_kojyo_unit_p11').val(Number(Math.floor(a_tankin_p11/a_lower_p11)).toLocaleString());
            } else if (a_trunc_txt1 == '10円未満切捨') {
                //  10円未満切り捨て⇒ROUNDDOWN(単金/下限時間*(還元率/100),-1)
                a_tmp = Math.floor((a_tankin_p11/a_lower_p11)/10);
                $('#txt_contract_kojyo_unit_p11').val(Number(a_tmp*10).toLocaleString());
            } else if (a_trunc_txt1 == '100円未満切捨') {
                //  100円未満切り捨て⇒ROUNDDOWN(単金/下限時間*(還元率/100),-2)
                a_tmp = Math.floor((a_tankin_p11/a_lower_p11)/100);
                $('#txt_contract_kojyo_unit_p11').val(Number(a_tmp*100).toLocaleString());
            } else if (a_trunc_txt1 == '1円未満切上') {
                //  1円未満切上⇒ROUNDDOWN(単金/下限時間,-2)
                $('#txt_contract_kojyo_unit_p11').val(Number(Math.ceil(a_tankin_p11/a_lower_p11)).toLocaleString());
            } else if (a_trunc_txt1 == '10円未満切上') {
                //  10円未満切上⇒ROUNDDOWN(単金/下限時間,-2)
                a_tmp = Math.ceil((a_tankin_p11/a_lower_p11)/10);
                $('#txt_contract_kojyo_unit_p11').val(Number(a_tmp*10).toLocaleString());
            } else if (a_trunc_txt1 == '100円未満切上') {
                //  100円未満切上⇒ROUNDDOWN(単金/下限時間,-2)
                a_tmp = Math.ceil((a_tankin_p11/a_lower_p11)/100);
                $('#txt_contract_kojyo_unit_p11').val(Number(a_tmp*100).toLocaleString());
            }
        }
        //通常期間：残業単価
        if ((a_upper_p11 != '') && (isFinite(a_upper_p11) == true)) {
            if (a_trunc_txt2 == '1円未満切捨') {
                //  1円未満切り捨て⇒ROUNDDOWN(単金/上限時間*(還元率/100),0)
                $('#txt_contract_zangyo_unit_p11').val(Number(Math.floor(a_tankin_p11/a_upper_p11)).toLocaleString());
            } else if (a_trunc_txt2 == '10円未満切捨') {
                //  10円未満切り捨て⇒ROUNDDOWN(単金/上限時間*(還元率/100),-1)
                a_tmp = Math.floor((a_tankin_p11/a_upper_p11)/10);
                $('#txt_contract_zangyo_unit_p11').val(Number(a_tmp*10).toLocaleString());
            } else if (a_trunc_txt2 == '100円未満切捨') {
                //  100円未満切り捨て⇒ROUNDDOWN(単金/上限時間*(還元率/100),-2)
                a_tmp = Math.floor((a_tankin_p11/a_upper_p11)/100);
                $('#txt_contract_zangyo_unit_p11').val(Number(a_tmp*100).toLocaleString());
            } else if (a_trunc_txt2 == '1円未満切上') {
                //  1円未満切上⇒ROUNDDOWN(単金/下限時間,-2)
                $('#txt_contract_zangyo_unit_p11').val(Number(Math.ceil(a_tankin_p11/a_upper_p11)).toLocaleString());
            } else if (a_trunc_txt2 == '10円未満切上') {
                //  10円未満切上⇒ROUNDDOWN(単金/下限時間,-2)
                a_tmp = Math.ceil((a_tankin_p11/a_upper_p11)/10);
                $('#txt_contract_zangyo_unit_p11').val(Number(a_tmp*10).toLocaleString());
            } else if (a_trunc_txt2 == '100円未満切上') {
                //  100円未満切上⇒ROUNDDOWN(単金/下限時間,-2)
                a_tmp = Math.ceil((a_tankin_p11/a_upper_p11)/100);
                $('#txt_contract_zangyo_unit_p11').val(Number(a_tmp*100).toLocaleString());
            }
        }
    }    

    //②本人名目給与
    //計算方法⇒IF(請求サイド計算方法="","",請求サイド計算方法)
    
    //単金⇒IF(請求サイド通常単金<>"",請求サイド通常単金*(還元率-20/100),"")
    
    //下限時間⇒IF(請求サイド通常下限時間="","",請求サイド通常下限時間)
    //上限時間⇒IF(請求サイド通常上限時間="","",請求サイド通常上限時間)
    
    //通常期間：控除単価・残業単価
    $('#txt_contract_kojyo_unit_p21').val('');
    $('#txt_contract_zangyo_unit_p21').val('');
    if (a_tankin_p21 != '') {
        a_tankin_p21 = a_tankin_p21.replace(/,/g,""); //[2017.11.07]課題No.79
        //通常期間：控除単価
        if ((a_lower_p21 != '') && (isFinite(a_lower_p21) == true)) {
            if (a_trunc_txt1 == '1円未満切捨') {
                //  1円未満切り捨て⇒ROUNDDOWN(単金/下限時間*(還元率/100),0)
                $('#txt_contract_kojyo_unit_p21').val(Number(Math.floor(a_tankin_p21/a_lower_p21)).toLocaleString());
            } else if (a_trunc_txt1 == '10円未満切捨') {
                //  10円未満切り捨て⇒ROUNDDOWN(単金/下限時間*(還元率/100),-1)
                a_tmp = Math.floor((a_tankin_p21/a_lower_p21)/10);
                $('#txt_contract_kojyo_unit_p21').val(Number(a_tmp*10).toLocaleString());
            } else if (a_trunc_txt1 == '100円未満切捨') {
                //  100円未満切り捨て⇒ROUNDDOWN(単金/下限時間*(還元率/100),-2)
                a_tmp = Math.floor((a_tankin_p21/a_lower_p21)/100);
                $('#txt_contract_kojyo_unit_p21').val(Number(a_tmp*100).toLocaleString());
            } else if (a_trunc_txt1 == '1円未満切上') {
                //  1円未満切上⇒ROUNDDOWN(単金/下限時間,-2)
                $('#txt_contract_kojyo_unit_p21').val(Number(Math.ceil(a_tankin_p21/a_lower_p21)).toLocaleString());
            } else if (a_trunc_txt1 == '10円未満切上') {
                //  10円未満切上⇒ROUNDDOWN(単金/下限時間,-2)
                a_tmp = Math.ceil((a_tankin_p21/a_lower_p21)/10);
                $('#txt_contract_kojyo_unit_p21').val(Number(a_tmp*10).toLocaleString());
            } else if (a_trunc_txt1 == '100円未満切上') {
                //  100円未満切上⇒ROUNDDOWN(単金/下限時間,-2)
                a_tmp = Math.ceil((a_tankin_p21/a_lower_p21)/100);
                $('#txt_contract_kojyo_unit_p21').val(Number(a_tmp*100).toLocaleString());
            }
        }
        //通常期間：残業単価
        if ((a_upper_p21 != '') && (isFinite(a_upper_p21) == true)) {
            if (a_trunc_txt2 == '1円未満切捨') {
                //  1円未満切り捨て⇒ROUNDDOWN(単金/上限時間*(還元率/100),0)
                $('#txt_contract_zangyo_unit_p21').val(Number(Math.floor(a_tankin_p21/a_upper_p21)).toLocaleString());
            } else if (a_trunc_txt2 == '10円未満切捨') {
                //  10円未満切り捨て⇒ROUNDDOWN(単金/上限時間*(還元率/100),-1)
                a_tmp = Math.floor((a_tankin_p21/a_upper_p21)/10);
                $('#txt_contract_zangyo_unit_p21').val(Number(a_tmp*10).toLocaleString());
            } else if (a_trunc_txt2 == '100円未満切捨') {
                //  100円未満切り捨て⇒ROUNDDOWN(単金/上限時間*(還元率/100),-2)
                a_tmp = Math.floor((a_tankin_p21/a_upper_p21)/100);
                $('#txt_contract_zangyo_unit_p21').val(Number(a_tmp*100).toLocaleString());
            } else if (a_trunc_txt2 == '1円未満切上') {
                //  1円未満切上⇒ROUNDDOWN(単金/下限時間,-2)
                $('#txt_contract_zangyo_unit_p21').val(Number(Math.ceil(a_tankin_p21/a_upper_p21)).toLocaleString());
            } else if (a_trunc_txt2 == '10円未満切上') {
                //  10円未満切上⇒ROUNDDOWN(単金/下限時間,-2)
                a_tmp = Math.ceil((a_tankin_p21/a_upper_p21)/10);
                $('#txt_contract_zangyo_unit_p21').val(Number(a_tmp*10).toLocaleString());
            } else if (a_trunc_txt2 == '100円未満切上') {
                //  100円未満切上⇒ROUNDDOWN(単金/下限時間,-2)
                a_tmp = Math.ceil((a_tankin_p21/a_upper_p21)/100);
                $('#txt_contract_zangyo_unit_p21').val(Number(a_tmp*100).toLocaleString());
            }
        }
    }    
}

//途中入場の計算
function calc_pay_middle_admission()
{
    //--------------------------------------------------------------------------
    //支払いサイド
    //--------------------------------------------------------------------------
    var a_syugyonisu = $('#inp_syugyonisu_b2').val();
    var a_zeneigyonisu = $('#inp_zeneigyonisu_b2').val();
    
    var a_tankin = $('#txt_tankin_b2').val().replace(/,/g,""); //[2017.11.07]課題No.79
    var a_tankin_base = $('#claim_middle_unit_price_base').val().replace(/,/g,""); //[2018.01.26]↓課題No.91
    /*[2017.11.09]課題No.81
    var a_lower_opt = $('[name=opt_contract_lower_limit_b2] option:selected').text();
    var a_upper_opt = $('[name=opt_contract_upper_limit_b2] option:selected').text();
    */
    var a_lower_txt = $('#txt_contract_lower_limit_b2').val();
    var a_upper_txt = $('#txt_contract_upper_limit_b2').val();

    var a_kangen = $('[name=opt_contract_reduction] option:selected').text();
    //[2018.01.10]協の場合還元率を手入力
    var a_contract_form = $('[name=opt_contract_pay_form] option:selected').text();
    if (a_contract_form == '協'){
        a_kangen = $('#txt_contract_reduction').val();
    }

    //①エンジニア還元金額
    var a_syugyonisu_p12;
    var a_syugyonisu_p22;
    var a_tankin_p12;
    var a_tankin_p22;
    var a_lower_p12;
    var a_lower_p22;
    var a_upper_p12;
    var a_upper_p22;

    /*[2017.11.09]課題No.81
    if (a_lower_txt == ''){
        a_lower_txt = a_lower_opt;
    }
    if (a_upper_txt == ''){
        a_upper_txt = a_upper_opt;
    }
    */

    //就業日数⇒請求サイド就業日数
    $('#txt_syugyonisu_p12').val(a_syugyonisu);
    $('#txt_syugyonisu_p22').val(a_syugyonisu);
    a_syugyonisu_p12 = $('#txt_syugyonisu_p12').val();
    a_syugyonisu_p22 = $('#txt_syugyonisu_p22').val();

    //全営業日数⇒請求サイド全営業日数
    $('#txt_zeneigyonisu_p12').val(a_zeneigyonisu);
    $('#txt_zeneigyonisu_p22').val(a_zeneigyonisu);

    //計算方法⇒請求サイド計算方法
    
    //単金⇒IF(請求サイド途中入場単金<>"",請求サイド途中入場単金*(還元率/100),"")
    if ((a_tankin == '') || (a_kangen == '')) {
        $('#txt_tankin_p12').val('');
        $('#txt_tankin_p22').val('');
        set_pay_input_mode(true);
    } else {
        if (isFinite(a_kangen) == true){
            $('#txt_tankin_p12').val(Number(Math.round(a_tankin*(a_kangen/100))).toLocaleString());
            $('#txt_tankin_p22').val(Number(Math.round(a_tankin*((a_kangen-20)/100))).toLocaleString());
            set_pay_input_mode(true);
        }else{
            set_pay_input_mode(false);
        }
    }
    a_tankin_p12 = $('#txt_tankin_p12').val().replace(/,/g,""); //[2017.11.07]課題No.79
    a_tankin_p22 = $('#txt_tankin_p22').val().replace(/,/g,""); //[2017.11.07]課題No.79

    //[2018.01.26]↓課題No.91
    //ベース単金
    if ((a_tankin_base == '') || (a_kangen == '')) {
        $('#payment_middle_unit_price_1_base').val('');
        $('#payment_middle_unit_price_2_base').val('');
    } else {
        if (isFinite(a_kangen) == true){
            $('#payment_middle_unit_price_1_base').val(Number(Math.round(a_tankin_base*(a_kangen/100))).toLocaleString());
            $('#payment_middle_unit_price_2_base').val(Number(Math.round(a_tankin_base*((a_kangen-20)/100))).toLocaleString());
            a_tankin_p12 = $('#payment_middle_unit_price_1_base').val().replace(/,/g,"");
            a_tankin_p22 = $('#payment_middle_unit_price_2_base').val().replace(/,/g,"");
        }else{
        }
    }
    //[2018.01.26]↑課題No.91

    //下限時間⇒IF(請求サイド途中入場下限時間="","",請求サイド途中入場下限時間)
    //if ((a_lower_txt == '') || (isFinite(a_lower_txt) == false)) {
    if (a_lower_txt == '') {
        $('#txt_contract_lower_limit_p12').val('');
        $('#txt_contract_lower_limit_p22').val('');
    } else {
        $('#txt_contract_lower_limit_p12').val(a_lower_txt);
        $('#txt_contract_lower_limit_p22').val(a_lower_txt);
    }
    a_lower_p12 = $('#txt_contract_lower_limit_p12').val();
    a_lower_p22 = $('#txt_contract_lower_limit_p22').val();
    
    //上限時間⇒IF(請求サイド途中入場上限時間="","",請求サイド途中入場上限時間)
    //if ((a_upper_txt == '') || (isFinite(a_upper_txt) == false)) {
    if (a_upper_txt == '') {
        $('#txt_contract_upper_limit_p12').val('');
        $('#txt_contract_upper_limit_p22').val('');
    } else {
        $('#txt_contract_upper_limit_p12').val(a_upper_txt);
        $('#txt_contract_upper_limit_p22').val(a_upper_txt);
    }
    a_upper_p12 = $('#txt_contract_upper_limit_p12').val();
    a_upper_p22 = $('#txt_contract_upper_limit_p22').val();
    
    //通常期間：控除単価⇒IF(就業日数<>"",通常控除単価,"")
    if (a_syugyonisu_p12 != '') {
        $('#txt_contract_kojyo_unit_p12').val($('#txt_contract_kojyo_unit_p11').val());
    }
    
    //通常期間：残業単価⇒IF(就業日数<>"",通常残業単価,"")
    if (a_syugyonisu_p12 != '') {
        $('#txt_contract_zangyo_unit_p12').val($('#txt_contract_zangyo_unit_p11').val());
    }
    
    //②本人名目給与
    //就業日数⇒請求サイド就業日数
    //全営業日数⇒請求サイド全営業日数
    //計算方法⇒請求サイド計算方法
    //単金⇒IF(OR(就業日数="",自動計算=""),"",IF(手入力<>"",通常単金*手入力,通常単金*自動計算))
    //下限時間⇒IF(請求サイド途中入場下限時間="","",請求サイド途中入場下限時間)
    //上限時間⇒IF(請求サイド途中入場上限時間="","",請求サイド途中入場上限時間)
    //通常期間：控除単価⇒IF(就業日数<>"",通常控除単価,"")
    if (a_syugyonisu_p22 != '') {
        $('#txt_contract_kojyo_unit_p22').val($('#txt_contract_kojyo_unit_p21').val());
    }
    
    //通常期間：残業単価⇒IF(就業日数<>"",通常残業単価,"")
    if (a_syugyonisu_p22 != '') {
        $('#txt_contract_zangyo_unit_p22').val($('#txt_contract_zangyo_unit_p21').val());
    }
}

//途中退場の計算
function calc_pay_midway_retirement()
{
    //--------------------------------------------------------------------------
    //支払いサイド
    //--------------------------------------------------------------------------
    var a_syugyonisu = $('#inp_syugyonisu_b3').val();
    var a_zeneigyonisu = $('#inp_zeneigyonisu_b3').val();
    
    var a_tankin = $('#txt_tankin_b3').val().replace(/,/g,""); //[2017.11.07]課題No.79
    var a_tankin_base = $('#claim_leaving_unit_price_base').val().replace(/,/g,""); //[2018.01.26]↓課題No.91
    /*[2017.11.09]課題No.81
    var a_lower_opt = $('[name=opt_contract_lower_limit_b3] option:selected').text();
    var a_upper_opt = $('[name=opt_contract_upper_limit_b3] option:selected').text();
    */
    var a_lower_txt = $('#txt_contract_lower_limit_b3').val();
    var a_upper_txt = $('#txt_contract_upper_limit_b3').val();

    var a_kangen = $('[name=opt_contract_reduction] option:selected').text();
    //[2018.01.10]協の場合還元率を手入力
    var a_contract_form = $('[name=opt_contract_pay_form] option:selected').text();
    if (a_contract_form == '協'){
        a_kangen = $('#txt_contract_reduction').val();
    }
    
    //①エンジニア還元金額
    var a_syugyonisu_p13;
    var a_syugyonisu_p23;
    var a_tankin_p13;
    var a_tankin_p23;
    var a_lower_p13;
    var a_lower_p23;
    var a_upper_p13;
    var a_upper_p23;

    /*[2017.11.09]課題No.81
    if (a_lower_txt == ''){
        a_lower_txt = a_lower_opt;
    }
    if (a_upper_txt == ''){
        a_upper_txt = a_upper_opt;
    }
    */
    
    //就業日数⇒請求サイド就業日数
    $('#txt_syugyonisu_p13').val(a_syugyonisu);
    $('#txt_syugyonisu_p23').val(a_syugyonisu);
    a_syugyonisu_p13 = $('#txt_syugyonisu_p13').val();
    a_syugyonisu_p23 = $('#txt_syugyonisu_p23').val();
    
    //全営業日数⇒請求サイド全営業日数
    $('#txt_zeneigyonisu_p13').val(a_zeneigyonisu);
    $('#txt_zeneigyonisu_p23').val(a_zeneigyonisu);

    //計算方法⇒請求サイド計算方法
    
    //単金⇒IF(請求サイド途中入場単金<>"",請求サイド途中入場単金*(還元率/100),"")
    if ((a_tankin == '') || (a_kangen == '')) {
        $('#txt_tankin_p13').val('');
        $('#txt_tankin_p23').val('');
        set_pay_input_mode(true);
    } else {
        if (isFinite(a_kangen) == true){
            $('#txt_tankin_p13').val(Number(Math.round(a_tankin*(a_kangen/100))).toLocaleString());
            $('#txt_tankin_p23').val(Number(Math.round(a_tankin*((a_kangen-20)/100))).toLocaleString());
            set_pay_input_mode(true);
        }else{
            set_pay_input_mode(false);
        }
    }
    a_tankin_p13 = $('#txt_tankin_p13').val().replace(/,/g,""); //[2017.11.07]課題No.79
    a_tankin_p23 = $('#txt_tankin_p23').val().replace(/,/g,""); //[2017.11.07]課題No.79
    
    //[2018.01.26]↓課題No.91
    //ベース単金
    if ((a_tankin_base == '') || (a_kangen == '')) {
        $('#payment_leaving_unit_price_1_base').val('');
        $('#payment_leaving_unit_price_2_base').val('');
    } else {
        if (isFinite(a_kangen) == true){
            $('#payment_leaving_unit_price_1_base').val(Number(Math.round(a_tankin_base*(a_kangen/100))).toLocaleString());
            $('#payment_leaving_unit_price_2_base').val(Number(Math.round(a_tankin_base*((a_kangen-20)/100))).toLocaleString());
            a_tankin_p13 = $('#payment_leaving_unit_price_1_base').val().replace(/,/g,"");
            a_tankin_p23 = $('#payment_leaving_unit_price_2_base').val().replace(/,/g,"");
        }else{
        }
    }
    //[2018.01.26]↑課題No.91

    //下限時間⇒IF(請求サイド途中入場下限時間="","",請求サイド途中入場下限時間)
    //if ((a_lower_txt == '') || (isFinite(a_lower_txt) == false)) {
    if (a_lower_txt == '') {
        $('#txt_contract_lower_limit_p13').val('');
        $('#txt_contract_lower_limit_p23').val('');
    } else {
        $('#txt_contract_lower_limit_p13').val(a_lower_txt);
        $('#txt_contract_lower_limit_p23').val(a_lower_txt);
    }
    a_lower_p13 = $('#txt_contract_lower_limit_p13').val();
    a_lower_p23 = $('#txt_contract_lower_limit_p23').val();
    
    //上限時間⇒IF(請求サイド途中入場上限時間="","",請求サイド途中入場上限時間)
    //if ((a_upper_txt == '') || (isFinite(a_upper_txt) == false)) {
    if (a_upper_txt == '') {
        $('#txt_contract_upper_limit_p13').val('');
        $('#txt_contract_upper_limit_p23').val('');
    } else {
        $('#txt_contract_upper_limit_p13').val(a_upper_txt);
        $('#txt_contract_upper_limit_p23').val(a_upper_txt);
    }
    a_upper_p13 = $('#txt_contract_upper_limit_p13').val();
    a_upper_p23 = $('#txt_contract_upper_limit_p23').val();
    
    //通常期間：控除単価⇒IF(就業日数<>"",通常控除単価,"")
    if (a_syugyonisu_p13 != '') {
        $('#txt_contract_kojyo_unit_p13').val($('#txt_contract_kojyo_unit_p11').val());
    }
    
    //通常期間：残業単価⇒IF(就業日数<>"",通常残業単価,"")
    if (a_syugyonisu_p13 != '') {
        $('#txt_contract_zangyo_unit_p13').val($('#txt_contract_zangyo_unit_p11').val());
    }
    
    //②本人名目給与
    //就業日数⇒請求サイド就業日数
    //全営業日数⇒請求サイド全営業日数
    //計算方法⇒請求サイド計算方法
    //単金⇒IF(OR(就業日数="",自動計算=""),"",IF(手入力<>"",通常単金*手入力,通常単金*自動計算))
    //下限時間⇒IF(請求サイド途中入場下限時間="","",請求サイド途中入場下限時間)
    //上限時間⇒IF(請求サイド途中入場上限時間="","",請求サイド途中入場上限時間)
    //通常期間：控除単価⇒IF(就業日数<>"",通常控除単価,"")
    if (a_syugyonisu_p23 != '') {
        $('#txt_contract_kojyo_unit_p23').val($('#txt_contract_kojyo_unit_p21').val());
    }
    
    //通常期間：残業単価⇒IF(就業日数<>"",通常残業単価,"")
    if (a_syugyonisu_p23 != '') {
        $('#txt_contract_zangyo_unit_p23').val($('#txt_contract_zangyo_unit_p21').val());
    }
}

//決済等の計算
function calc_pay_settlement()
{
    //--------------------------------------------------------------------------
    //支払いサイド
    //--------------------------------------------------------------------------
    var a_txt = $('[name=opt_contract_pay_form] option:selected').text();
    //見積書⇒IF(契約形態="","",IF(OR(契約形態="協力"),"","無"))
    if (a_txt == ''){
        $('#opt_contract_yesno_p2').val('0');
    } else if (a_txt == '協力'){
        $('#opt_contract_yesno_p2').val('0');
    } else{
        $('#opt_contract_yesno_p2').val('2');
    }
    //注文書⇒IF(契約形態="","",IF(OR(契約形態="正"),"無","有"))
    if (a_txt == ''){
        $('#opt_contract_yesno_p3').val('0');
    } else if ((a_txt == '正') || (a_txt == '契')){
        $('#opt_contract_yesno_p3').val('2');
    } else{
        $('#opt_contract_yesno_p3').val('1');
    }
    //注文書請書
    if (a_txt == ''){
        $('#opt_contract_yesno_p4').val('0');
    } else if ((a_txt == '正') || (a_txt == '契')){
        $('#opt_contract_yesno_p4').val('2');
    } else{
        $('#opt_contract_yesno_p4').val('1');
    }
}

//抵触
function calc_teisyoku()
{
    var a_txt = $('[name=opt_contract_pay_form] option:selected').text();
    if (a_txt == '正'){
        //$('#contact_date_org').val('無期雇用者に限定する');
        //$('#contact_date_org').attr('readonly',true);
    } else{
        //$('#contact_date_org').attr('readonly',false);
    }
}

//支払条件入力切替
function set_pay_input_mode(h_mode)
{
    //画面入力自体、入力可とする。
    return;
    
    $('#txt_tankin_p11').attr('readonly', h_mode);
    $('#txt_tankin_p21').attr('readonly', h_mode);
    $('#txt_contract_lower_limit_p11').attr('readonly', h_mode);
    $('#txt_contract_lower_limit_p21').attr('readonly', h_mode);
    $('#txt_contract_upper_limit_p11').attr('readonly', h_mode);
    $('#txt_contract_upper_limit_p21').attr('readonly', h_mode);
    $('#txt_contract_kojyo_unit_p11').attr('readonly', h_mode);
    $('#txt_contract_kojyo_unit_p21').attr('readonly', h_mode);
    $('#txt_contract_zangyo_unit_p11').attr('readonly', h_mode);
    $('#txt_contract_zangyo_unit_p21').attr('readonly', h_mode);

    $('#txt_syugyonisu_p12').attr('readonly', h_mode);
    $('#txt_syugyonisu_p22').attr('readonly', h_mode);
    $('#txt_zeneigyonisu_p12').attr('readonly', h_mode);
    $('#txt_zeneigyonisu_p22').attr('readonly', h_mode);
    $('#txt_tankin_p12').attr('readonly', h_mode);
    $('#txt_tankin_p22').attr('readonly', h_mode);
    $('#txt_contract_lower_limit_p12').attr('readonly', h_mode);
    $('#txt_contract_lower_limit_p22').attr('readonly', h_mode);
    $('#txt_contract_upper_limit_p12').attr('readonly', h_mode);
    $('#txt_contract_upper_limit_p22').attr('readonly', h_mode);
    $('#txt_contract_kojyo_unit_p12').attr('readonly', h_mode);
    $('#txt_contract_kojyo_unit_p22').attr('readonly', h_mode);
    $('#txt_contract_zangyo_unit_p12').attr('readonly', h_mode);
    $('#txt_contract_zangyo_unit_p22').attr('readonly', h_mode);

    $('#txt_syugyonisu_p13').attr('readonly', h_mode);
    $('#txt_syugyonisu_p23').attr('readonly', h_mode);
    $('#txt_zeneigyonisu_p13').attr('readonly', h_mode);
    $('#txt_zeneigyonisu_p23').attr('readonly', h_mode);
    $('#txt_tankin_p13').attr('readonly', h_mode);
    $('#txt_tankin_p23').attr('readonly', h_mode);
    $('#txt_contract_lower_limit_p13').attr('readonly', h_mode);
    $('#txt_contract_lower_limit_p23').attr('readonly', h_mode);
    $('#txt_contract_upper_limit_p13').attr('readonly', h_mode);
    $('#txt_contract_upper_limit_p23').attr('readonly', h_mode);
    $('#txt_contract_kojyo_unit_p13').attr('readonly', h_mode);
    $('#txt_contract_kojyo_unit_p23').attr('readonly', h_mode);
    $('#txt_contract_zangyo_unit_p13').attr('readonly', h_mode);
    $('#txt_contract_zangyo_unit_p23').attr('readonly', h_mode);
}

//ｴﾝｼﾞﾆｱNo.
function get_engineer_info()
{
    $('#txt_engineer_name').val('');
    $('#txt_engineer_kana').val('');
    $('#txt_jigyosya_name').val('');
    $('#txt_jigyosya_kana').val('');
    
    //m_ProgressMsg('データ取得中です......<br><img src="./images/upload.gif" /> ');

    $.ajax({
        url: m_parentURL + "get_engineer_info.php",
        type: 'POST',
        dataType: "html",
        async: true,
        data:{
            'entry_no': $('#inp_engineer_no').val()
        },
        success: function(data, dataType){
            if (data != '') {
                var a_val = data.split("\t");
                $('#txt_engineer_name').val(a_val[0]);
                $('#txt_engineer_kana').val(a_val[1]);
                
                //[2017.11.22]bug-fixed.
                var a_contract_form = $('[name=opt_contract_pay_form] option:selected').text();
                if (a_contract_form == '') {
                } else if ((a_contract_form == '正') || (a_contract_form == '契')) {
                    //事業所名・事業所名を入力不可とし、エンジニア名・フリガナを設定
                    $('#txt_jigyosya_name').val(a_val[0]);
                    $('#txt_jigyosya_kana').val(a_val[1]);
                } else {
                    //事業所名・事業所名を入力可とし、空を設定
                }
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown.message);
        },
       complete: function (data) {
            $.unblockUI();
       }
   });
}

//契約レポート登録
function regist_contract_report(h_act)
{
    //alert($('#contact_date_org').val());
    /*if ($('#file1') != null){
        alert($('#file1'));
    }*/
    var a_wk = null;    //[2017.11.08]課題No.81
    var a_idx = "";
    var a_sKind = "";
    if (h_act == 'n'){
        a_sKind = '登録';
    }else{
        a_sKind = '更新';
    }

    if (check_IsRequired('#inp_engineer_no', 'エンジニアNoが入力されていません！') == false) return;
    //[2017.11.07]課題No.73
    if (check_IsHanKana('#txt_engineer_kana', 'ﾌﾘｶﾞﾅは半角ｶﾅで入力して下さい！') == false) return;
    //[2017.11.09]課題No.83
    var a_val = $('[name=opt_contarct_bill_form] option:selected').text();
    //alert(a_val);
    if (a_val == '派遣'){
        if (check_IsRequired('#contact_date_org', '組織単位が入力されていません！') == false) return;
        if (check_IsRequired('#dd_name', '名称（就業場所）が入力されていません！') == false) return;
        if (check_IsRequired('#dd_branch', '部署（就業場所）が入力されていません！') == false) return;
        if (check_IsRequired('#organization', '組織単位（就業場所）が入力されていません！') == false) return;
        if (check_IsRequired('#dd_address', '所在地（就業場所）が入力されていません！') == false) return;
        if (check_IsRequired('#dd_tel', '電話番号（就業場所）が入力されていません！') == false) return;
        if (check_IsRequired('#ip_position', '職名（指揮命令者）が入力されていません！') == false) return;
        if (check_IsRequired('#ip_name', '氏名（指揮命令者）が入力されていません！') == false) return;
        if (check_IsRequired('#dd_responsible_position', '職名（派遣先責任者）が入力されていません！') == false) return;
        if (check_IsRequired('#dd_responsible_name', '氏名（派遣先責任者）が入力されていません！') == false) return;
        if (check_IsRequired('#dd_responsible_tel', '電話番号（派遣先責任者）が入力されていません！') == false) return;
        if (check_IsRequired('#dm_responsible_position', '職名（派遣元責任者）が入力されていません！') == false) return;
        if (check_IsRequired('#dm_responsible_name', '氏名（派遣元責任者）が入力されていません！') == false) return;
        if (check_IsRequired('#dm_responsible_tel', '電話番号（派遣元責任者）が入力されていません！') == false) return;
        if (check_IsRequired('#chs_position2', '職名（苦情：派遣先責任者）が入力されていません！') == false) return;
        if (check_IsRequired('#chs_name2', '氏名（苦情：派遣先責任者）が入力されていません！') == false) return;
        if (check_IsRequired('#chs_tel2', '電話番号（苦情：派遣先責任者）が入力されていません！') == false) return;
        //[2018.01.09]上段に３項目記載ある場合は、下段に記載なくてもOK
        /*
        if (check_IsRequired('#chs_position1', '職名（苦情：派遣元責任者）が入力されていません！') == false) return;
        if (check_IsRequired('#chs_name1', '氏名（苦情：派遣元責任者）が入力されていません！') == false) return;
        if (check_IsRequired('#chs_tel1', '電話番号（苦情：派遣元責任者）が入力されていません！') == false) return;
        */
    }
    
    //[2018.01.10]協の場合還元率を手入力
    var a_contract_form = $('[name=opt_contract_pay_form] option:selected').text();
    var contract_reduction = '';
    if (a_contract_form == "協"){
        contract_reduction = $('#txt_contract_reduction').val();
    }else{
        contract_reduction = $('[name=opt_contract_reduction] option:selected').text();
    }
    
    if (!confirm("契約レポートを" + a_sKind + "します。よろしいですか？")) return;
    m_ProgressMsg('処理中です...<br><img src="./images/upload.gif" /> ');
    //alert($('#inp_engineer_no').val());
    //[2018.01.18]課題解決管理表No.92
    //[2018.01.26]課題解決管理表No.91
    $.ajax({
        url: m_parentURL + "regist_contract_report.php",
        type: 'POST',
        dataType: "html",
        async: true,
        data:{
            'act': h_act,
            'cr_id': $('#cr_id').val(),
            'inp_kyakusaki': $('#inp_kyakusaki').val(),
            'inp_kenmei': $('#inp_kenmei').val(),
            'opt_contarct_bill_form': $('[name=opt_contarct_bill_form] option:selected').text(),
            'inp_sagyo_basyo': $('#inp_sagyo_basyo').val(),
            'inp_kaishi1': $('#inp_kaishi1').val(),
            'inp_syuryo1': $('#inp_syuryo1').val(),
            'txt_sagyo_jikan': $('#txt_sagyo_jikan').val(),
            'inp_kaishi2': $('#inp_kaishi2').val(),
            'inp_syuryo2': $('#inp_syuryo2').val(),
            'txt_kyukei_jikan': $('#txt_kyukei_jikan').val(),
            
            'inp_kyakusaki_busyo': $('#inp_kyakusaki_busyo').val(),
            'inp_kyakusaki_tantosya': $('#inp_kyakusaki_tantosya').val(),
            'inp_kyakusaki_jimutantosya': $('#inp_kyakusaki_jimutantosya').val(),
            'inp_kyakusaki_yakusyoku': $('#inp_kyakusaki_yakusyoku').val(),
            'inp_kyakusaki_tel': $('#inp_kyakusaki_tel').val(),
            'inp_kyakusaki_kaishi': $('#inp_kyakusaki_kaishi').val(),
            'inp_kyakusaki_syuryo': $('#inp_kyakusaki_syuryo').val(),
            
            'inp_wariai_nyujyo_c1': $('#inp_wariai_nyujyo_c1').val(),
            'inp_wariai_nyujyo_c2': $('#inp_wariai_nyujyo_c2').val(),
            'inp_wariai_taijyo_c1': $('#inp_wariai_taijyo_c1').val(),
            'inp_wariai_taijyo_c2': $('#inp_wariai_taijyo_c2').val(),
            
            'opt_contract_calc_b1': $('[name=opt_contract_calc_b1] option:selected').text(),
            'inp_tankin_b1': $('#inp_tankin_b1').val(),
            'opt_contract_lower_limit_b1': $('[name=opt_contract_lower_limit_b1] option:selected').text(),
            'opt_contract_upper_limit_b1': $('[name=opt_contract_upper_limit_b1] option:selected').text(),
            'txt_contract_lower_limit_b1': $('#txt_contract_lower_limit_b1').val(),
            'txt_contract_upper_limit_b1': $('#txt_contract_upper_limit_b1').val(),
            'opt_contract_trunc_unit_kojyo': $('[name=opt_contract_trunc_unit_kojyo] option:selected').text(),
            'txt_contract_kojyo_unit_b1': $('#txt_contract_kojyo_unit_b1').val(),
            'opt_contract_trunc_unit_zangyo': $('[name=opt_contract_trunc_unit_zangyo] option:selected').text(),
            'txt_contract_zangyo_unit_b1': $('#txt_contract_zangyo_unit_b1').val(),

            'inp_syugyonisu_b2': $('#inp_syugyonisu_b2').val(),
            'inp_zeneigyonisu_b2': $('#inp_zeneigyonisu_b2').val(),
            'opt_contract_calc_b2': $('[name=opt_contract_calc_b2] option:selected').text(),
            'txt_tankin_b2': $('#txt_tankin_b2').val(),
            //'opt_contract_lower_limit_b2': $('[name=opt_contract_lower_limit_b2] option:selected').text(),
            //'opt_contract_upper_limit_b2': $('[name=opt_contract_upper_limit_b2] option:selected').text(),
            'txt_contract_lower_limit_b2': $('#txt_contract_lower_limit_b2').val(),
            'txt_contract_upper_limit_b2': $('#txt_contract_upper_limit_b2').val(),
            'txt_contract_kojyo_unit_b2': $('#txt_contract_kojyo_unit_b2').val(),
            'txt_contract_zangyo_unit_b2': $('#txt_contract_zangyo_unit_b2').val(),

            'inp_syugyonisu_b3': $('#inp_syugyonisu_b3').val(),
            'inp_zeneigyonisu_b3': $('#inp_zeneigyonisu_b3').val(),
            'opt_contract_calc_b3': $('[name=opt_contract_calc_b3] option:selected').text(),
            'txt_tankin_b3': $('#txt_tankin_b3').val(),
            //'opt_contract_lower_limit_b3': $('[name=opt_contract_lower_limit_b3] option:selected').text(),
            //'opt_contract_upper_limit_b3': $('[name=opt_contract_upper_limit_b3] option:selected').text(),
            'txt_contract_lower_limit_b3': $('#txt_contract_lower_limit_b3').val(),
            'txt_contract_upper_limit_b3': $('#txt_contract_upper_limit_b3').val(),
            'txt_contract_kojyo_unit_b3': $('#txt_contract_kojyo_unit_b3').val(),
            'txt_contract_zangyo_unit_b3': $('#txt_contract_zangyo_unit_b3').val(),

            'opt_m_contract_time_inc_bd': $('[name=opt_m_contract_time_inc_bd] option:selected').text(),
            'opt_m_contract_time_inc_bm': $('[name=opt_m_contract_time_inc_bm] option:selected').text(),
            'opt_contract_tighten_b': $('[name=opt_contract_tighten_b] option:selected').text(),
            'opt_contract_bill_pay': $('[name=opt_contract_bill_pay] option:selected').text(),
            'opt_m_contract_yesno_b1': $('[name=opt_m_contract_yesno_b1] option:selected').text(),
            'opt_m_contract_yesno_b2': $('[name=opt_m_contract_yesno_b2] option:selected').text(),
            'opt_m_contract_yesno_b3': $('[name=opt_m_contract_yesno_b3] option:selected').text(),
            'opt_m_contract_yesno_b4': $('[name=opt_m_contract_yesno_b4] option:selected').text(),
            'inp_biko': $('#inp_biko').val(),

            'opt_contract_kind': $('[name=opt_contract_kind] option:selected').text(),
            'inp_keiyaku_no': $('#inp_keiyaku_no').val(),
            'inp_hakkobi': $('#inp_hakkobi').val(),
            'inp_sakuseisya': $('#inp_sakuseisya').val(),
            'inp_engineer_no': $('#inp_engineer_no').val(),
            'txt_engineer_name': $('#txt_engineer_name').val(),
            'txt_engineer_kana': $('#txt_engineer_kana').val(),

            'txt_jigyosya_name': $('#txt_jigyosya_name').val(),
            'opt_contract_pay_form': $('[name=opt_contract_pay_form] option:selected').text(),
            'txt_jigyosya_kana': $('#txt_jigyosya_kana').val(),
            'inp_jigyosya_tanto': $('#inp_jigyosya_tanto').val(),
            'opt_social_insurance': $('[name=opt_social_insurance] option:selected').text(),
            'opt_tax_withholding': $('[name=opt_tax_withholding] option:selected').text(),
            'opt_contract_reduction': contract_reduction,
            'txt_kyakusaki_kaishi': $('#txt_kyakusaki_kaishi').val(),
            'txt_kyakusaki_syuryo': $('#txt_kyakusaki_syuryo').val(),

            'opt_contract_calc_p11': $('[name=opt_contract_calc_p11] option:selected').text(),
            'txt_tankin_p11': $('#txt_tankin_p11').val(),
            'txt_contract_lower_limit_p11': $('#txt_contract_lower_limit_p11').val(),
            'txt_contract_upper_limit_p11': $('#txt_contract_upper_limit_p11').val(),
            'txt_contract_kojyo_unit_p11': $('#txt_contract_kojyo_unit_p11').val(),
            'txt_contract_zangyo_unit_p11': $('#txt_contract_zangyo_unit_p11').val(),

            'opt_contract_calc_p21': $('[name=opt_contract_calc_p21] option:selected').text(),
            'txt_tankin_p21': $('#txt_tankin_p21').val(),
            'txt_contract_lower_limit_p21': $('#txt_contract_lower_limit_p21').val(),
            'txt_contract_upper_limit_p21': $('#txt_contract_upper_limit_p21').val(),
            'txt_contract_kojyo_unit_p21': $('#txt_contract_kojyo_unit_p21').val(),
            'txt_contract_zangyo_unit_p21': $('#txt_contract_zangyo_unit_p21').val(),

            'txt_syugyonisu_p12': $('#txt_syugyonisu_p12').val(),
            'txt_zeneigyonisu_p12': $('#txt_zeneigyonisu_p12').val(),
            'opt_contract_calc_p12': $('[name=opt_contract_calc_p12] option:selected').text(),
            'txt_tankin_p12': $('#txt_tankin_p12').val(),
            'txt_contract_lower_limit_p12': $('#txt_contract_lower_limit_p12').val(),
            'txt_contract_upper_limit_p12': $('#txt_contract_upper_limit_p12').val(),
            'txt_contract_kojyo_unit_p12': $('#txt_contract_kojyo_unit_p12').val(),
            'txt_contract_zangyo_unit_p12': $('#txt_contract_zangyo_unit_p12').val(),

            'txt_syugyonisu_p22': $('#txt_syugyonisu_p22').val(),
            'txt_zeneigyonisu_p22': $('#txt_zeneigyonisu_p22').val(),
            'opt_contract_calc_p22': $('[name=opt_contract_calc_p22] option:selected').text(),
            'txt_tankin_p22': $('#txt_tankin_p22').val(),
            'txt_contract_lower_limit_p22': $('#txt_contract_lower_limit_p22').val(),
            'txt_contract_upper_limit_p22': $('#txt_contract_upper_limit_p22').val(),
            'txt_contract_kojyo_unit_p22': $('#txt_contract_kojyo_unit_p22').val(),
            'txt_contract_zangyo_unit_p22': $('#txt_contract_zangyo_unit_p22').val(),

            'txt_syugyonisu_p13': $('#txt_syugyonisu_p13').val(),
            'txt_zeneigyonisu_p13': $('#txt_zeneigyonisu_p13').val(),
            'opt_contract_calc_p13': $('[name=opt_contract_calc_p13] option:selected').text(),
            'txt_tankin_p13': $('#txt_tankin_p13').val(),
            'txt_contract_lower_limit_p13': $('#txt_contract_lower_limit_p13').val(),
            'txt_contract_upper_limit_p13': $('#txt_contract_upper_limit_p13').val(),
            'txt_contract_kojyo_unit_p13': $('#txt_contract_kojyo_unit_p13').val(),
            'txt_contract_zangyo_unit_p13': $('#txt_contract_zangyo_unit_p13').val(),

            'txt_syugyonisu_p23': $('#txt_syugyonisu_p23').val(),
            'txt_zeneigyonisu_p23': $('#txt_zeneigyonisu_p23').val(),
            'opt_contract_calc_p23': $('[name=opt_contract_calc_p23] option:selected').text(),
            'txt_tankin_p23': $('#txt_tankin_p23').val(),
            'txt_contract_lower_limit_p23': $('#txt_contract_lower_limit_p23').val(),
            'txt_contract_upper_limit_p23': $('#txt_contract_upper_limit_p23').val(),
            'txt_contract_kojyo_unit_p23': $('#txt_contract_kojyo_unit_p23').val(),
            'txt_contract_zangyo_unit_p23': $('#txt_contract_zangyo_unit_p23').val(),

            'opt_m_contract_time_inc_pd': $('[name=opt_m_contract_time_inc_pd] option:selected').text(),
            'opt_m_contract_time_inc_pm': $('[name=opt_m_contract_time_inc_pm] option:selected').text(),
            'opt_contract_tighten_p': $('[name=opt_contract_tighten_p] option:selected').text(),
            'opt_contract_pay_pay': $('[name=opt_contract_pay_pay] option:selected').text(),
            'opt_contract_yesno_p1': $('[name=opt_contract_yesno_p1] option:selected').text(),
            'opt_contract_yesno_p2': $('[name=opt_contract_yesno_p2] option:selected').text(),
            'opt_contract_yesno_p3': $('[name=opt_contract_yesno_p3] option:selected').text(),
            'opt_contract_yesno_p4': $('[name=opt_contract_yesno_p4] option:selected').text(),
            
            'contact_date_org': $('#contact_date_org').val(),
            'organization': $('#organization').val(),
            'dd_name': $('#dd_name').val(),
            'dd_branch': $('#dd_branch').val(),
            'dd_address': $('#dd_address').val(),
            'dd_tel': $('#dd_tel').val(),
            'ip_position': $('#ip_position').val(),
            'ip_name': $('#ip_name').val(),
            'dm_responsible_position': $('#dm_responsible_position').val(),
            'dm_responsible_name': $('#dm_responsible_name').val(),
            'dm_responsible_tel': $('#dm_responsible_tel').val(),
            'dd_responsible_position': $('#dd_responsible_position').val(),
            'dd_responsible_name': $('#dd_responsible_name').val(),
            'dd_responsible_tel': $('#dd_responsible_tel').val(),
            'chs_position1': $('#chs_position1').val(),
            'chs_name1': $('#chs_name1').val(),
            'chs_tel1': $('#chs_tel1').val(),
            'chs_position2': $('#chs_position2').val(),
            'chs_name2': $('#chs_name2').val(),
            'chs_tel2': $('#chs_tel2').val(),
            'remarks_pay': $('#remarks_pay').val(),
            'status_cd': $('[name=status_cd] option:selected').text(),
            'status_cd_num': $('[name=status_cd] option:selected').val(),
            'cr_id_src': $('#cr_id_src').val(),
            'claim_accounts_invoicing': $('#claim_accounts_invoicing').val(),
            'remarks2': $('#remarks2').val(),
            'remarks_pay2': $('#remarks_pay2').val(),

            'claim_normal_unit_price_base': $('#claim_normal_unit_price_base').val(),
            'claim_middle_unit_price_base': $('#claim_middle_unit_price_base').val(),
            'claim_leaving_unit_price_base': $('#claim_leaving_unit_price_base').val(),
            'payment_normal_unit_price_1_base': $('#payment_normal_unit_price_1_base').val(),
            'payment_normal_unit_price_2_base': $('#payment_normal_unit_price_2_base').val(),
            'payment_middle_unit_price_1_base': $('#payment_middle_unit_price_1_base').val(),
            'payment_middle_unit_price_2_base': $('#payment_middle_unit_price_2_base').val(),
            'payment_leaving_unit_price_1_base': $('#payment_leaving_unit_price_1_base').val(),
            'payment_leaving_unit_price_2_base': $('#payment_leaving_unit_price_2_base').val(),
        },
        success: function(data, dataType){
            //[2017.11.08]↓課題No.81
            a_wk = data.split('#');
            if (a_wk != null){
                if (a_wk[0] == 'OK'){
                    //[2017.11.08]↓課題No.81
                    if (a_wk != null){
                        var a_bRet = file_upload('regist_evidence', a_wk[1]);   //[2017.12.14]要望
                        a_bRet = file_upload('regist_payroll', a_wk[1]);        //[2017.12.14]要望
                    }
                    //[2017.11.08]↑課題No.81

                    alert(a_sKind + "しました。");
                    //$.unblockUI();
                    location.href = "./index.php?mnu=10100";  //[2017.11.08]課題No.81
                }else{
                    $("#my-result").empty().append(a_wk[0]);
                }
            }else{
                    $("#my-result").empty().append("不明なエラー");
            }
            //[2017.11.08]↑課題No.81
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown.message);
        },
       complete: function (data) {
            $.unblockUI();
       }
   });
}

//契約レポート一覧
function make_contract_report_list(h_pageNo){
    m_ProgressMsg('データ取得中です......<br><img src="./images/upload.gif" /> ');

    $.ajax({
        url: m_parentURL + "make_contract_report_list.php",
        type: 'POST',
        dataType: "html",
        async: true,
        data:{
            'PageNo': h_pageNo
        },
        success: function(data, dataType){
            //make_pager(2,h_pageNo);
            $("#my-list").empty().append(data);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown.message);
        },
       complete: function (data) {
            $.unblockUI();
            resize_div2('leftColumn', 'right_title', 'right_record', 400, 194); 
       }
   });
}

//契約管理機能選択
function choice_contract_report_method(h_no)
{
    //alert(h_no);
    /**/
    m_ProgressMsg('データ取得中です......<br><img src="./images/upload.gif" /> ');
    
    $.ajax({
        url: m_parentURL + "choice_contract_report_method.php",
        type: 'POST',
        dataType: "html",
        async: true,
        data:{
            'cr_id': h_no
        },
        success: function(data, dataType){
            $("#my-method").empty().append(data);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown.message);
        },
       complete: function (data) {
            $.unblockUI();
       }
    });
    /**/
    show_popup();
}

//Excelへ一覧出力
function excel_out_10100(h_no){
    //alert($.fn.jquery);
    //alert('excel_out_10100');
    location.href = m_parentURL + "excel_out_10100.php?NO=" + h_no;
    return false;
    
    /*
    $.ajax({
        url: m_parentURL + "excel_out_10100.php",
        type: 'POST',
        dataType: "html",
        async: true,
        data:{
        },
        success: function(data, dataType){
              //window.open(data);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown.message);
        },
       complete: function (data) {
       }
   });
   */
}
//Excelへ契約レポート出力
function excel_out_10102(h_no){
    location.href = m_parentURL + "excel_out_10102.php?NO=" + h_no;
    return false;
}
//Excelへ契約終了レポート出力
function excel_out_10105(h_no){
    location.href = m_parentURL + "excel_out_10105.php?NO=" + h_no;
    return false;
}
//Excelへ見積書出力
function excel_out_10107(h_no){
    location.href = m_parentURL + "excel_out_10107.php?NO=" + h_no;
    return false;
}

//契約終了レポート登録
function regist_contract_end_report(h_act, h_no)
{
    //alert($('#remarks_pay').val());
    var a_idx = "";
    var a_sKind = "";
    if (h_act == 'n'){
        a_sKind = '登録';
    }else{
        a_sKind = '更新';
    }

    if (check_IsRequired_opt('opt_contarct_end_status', '契約終了状況が選択されていません！') == false) return;
    if (check_IsRequired('#inp_retire_date', '退場日が入力されていません！') == false) return;

    if (!confirm("契約終了レポートを" + a_sKind + "します。よろしいですか？")) return;
    m_ProgressMsg('処理中です...<br><img src="./images/upload.gif" /> ');
    //alert($('#inp_engineer_no').val());
    //[2018.01.18]課題解決管理表No.92
    $.ajax({
        url: m_parentURL + "regist_contract_end_report.php",
        type: 'POST',
        dataType: "html",
        async: true,
        data:{
            'act': h_act,
            'no': h_no,
            'opt_contarct_replace': $('[name=opt_contarct_replace] option:selected').text(),
            'opt_contarct_end_status': $('[name=opt_contarct_end_status] option:selected').text(),
            'inp_retire_date': $('#inp_retire_date').val(),
            'opt_contarct_insurance_crad': $('[name=opt_contarct_insurance_crad] option:selected').text(),
            'opt_contarct_employ_insurance': $('[name=opt_contarct_employ_insurance] option:selected').text(),
            'opt_contarct_end_reason1': $('[name=opt_contarct_end_reason1] option:selected').text(),
            'opt_contarct_end_reason2': $('[name=opt_contarct_end_reason2] option:selected').text(),
            'opt_contarct_end_reason3': $('[name=opt_contarct_end_reason3] option:selected').text(),
            'inp_end_reason_detail': $('#inp_end_reason_detail').val(),
            'opt_contarct_from_now': $('[name=opt_contarct_from_now] option:selected').text(),
            'opt_contarct_skill': $('[name=opt_contarct_skill] option:selected').text(),
            'inp_biko': $('#inp_biko').val(),
            'opt_contarct_conversation': $('[name=opt_contarct_conversation] option:selected').text(),
            'opt_contarct_work_attitude': $('[name=opt_contarct_work_attitude] option:selected').text(),
            'opt_contarct_personality': $('[name=opt_contarct_personality] option:selected').text(),
            'opt_contarct_projects_confirm': $('[name=opt_contarct_projects_confirm] option:selected').text(),
            'opt_contarct_engineer_list': $('[name=opt_contarct_engineer_list] option:selected').text(),
            'remarks_pay': $('#remarks_pay').val(),
            'reg_id':$('#reg_id').val(),
            'retirement_date': $('#retirement_date').val(),
            'insurance_card_retirement': $('[name=insurance_card_retirement] option:selected').text(),
            'leave_date_start': $('#leave_date_start').val(),
            'leave_date_end': $('#leave_date_end').val(),
            'insurance_card_leave': $('[name=insurance_card_leave] option:selected').text(),
            'remarks2': $('#remarks2').val(),
            'remarks_pay2': $('#remarks_pay2').val(),
        },
        success: function(data, dataType){
            if (data == 'OK'){
                alert(a_sKind + "しました。");
                //$.unblockUI();
                //document.location.href = "./index.php?mnu=<?php echo $GLOBALS['g_MENU_MAINTENANCE_90100']; ?>";
                location.href = "./index.php?mnu=10100";
            }else{
                $("#my-result").empty().append(data);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown.message);
        },
       complete: function (data) {
            $.unblockUI();
       }
   });

}

//見積書
function regist_contract_estimate(h_act, h_no)
{
    var a_idx = "";
    var a_sKind = "";
    if (h_act == 'n'){
        a_sKind = '登録';
    }else{
        a_sKind = '更新';
    }

    //if (check_IsRequired('#inp_estimate_no', '見積書Noが入力されていません！') == false) return;
    if (check_IsRequired('#inp_estimate_date', '発行日が入力されていません！') == false) return;

    if (!confirm("見積書を" + a_sKind + "します。よろしいですか？")) return;
    m_ProgressMsg('処理中です...<br><img src="./images/upload.gif" /> ');
    //alert($('#inp_estimate_no').val());
    $.ajax({
        url: m_parentURL + "regist_contract_estimate.php",
        type: 'POST',
        dataType: "html",
        async: true,
        data:{
            'act': h_act,
            'no': h_no,
            'inp_estimate_no': $('#inp_estimate_no').val(),
            'inp_estimate_date': $('#inp_estimate_date').val(),
            'old_estimate_date': $('#old_estimate_date').val(),
        },
        success: function(data, dataType){
            if (data == 'OK'){
                alert(a_sKind + "しました。");
                //$.unblockUI();
                //document.location.href = "./index.php?mnu=<?php echo $GLOBALS['g_MENU_MAINTENANCE_90100']; ?>";
                location.href = "./index.php?mnu=10100";
            }else{
                $("#my-result").empty().append(data);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown.message);
        },
       complete: function (data) {
            $.unblockUI();
       }
   });

}

//契約レポート削除
function unregist_contract_report(h_no)
{
    var a_idx = "";
    a_sKind = '削除';

    if (!confirm("契約レポートを" + a_sKind + "します。よろしいですか？")) return;
    m_ProgressMsg('処理中です...<br><img src="./images/upload.gif" /> ');
    //alert($('#inp_engineer_no').val());
    $.ajax({
        url: m_parentURL + "unregist_contract_report.php",
        type: 'POST',
        dataType: "html",
        async: true,
        data:{
            'no': h_no,
        },
        success: function(data, dataType){
            if (data == 'OK'){
                alert(a_sKind + "しました。");
                //$.unblockUI();
                //document.location.href = "./index.php?mnu=<?php echo $GLOBALS['g_MENU_MAINTENANCE_90100']; ?>";
                location.href = "./index.php?mnu=10100";
            }else{
                $("#my-result").empty().append(data);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown.message);
        },
       complete: function (data) {
            $.unblockUI();
       }
   });

}

//入力変更チェック
function check_value_changed_10102(h_kind, h_field, h_val, h_name)
{
    if ($('#cr_id').val() == '') return;
    
    // h_kind   1:文字、2:日付、3：時間
    //alert($('#inp_keiyaku_no').val());
    $.ajax({
        url: m_parentURL + "check_value_changed_10102.php",
        type: 'POST',
        dataType: "html",
        async: true,
        data:{
            'cr_id': $('#cr_id').val(),
            'kind': h_kind,
            'field': h_field,
            'val': h_val,
        },
        success: function(data, dataType){
            if (data == 'OK') {
                $(h_name).css("background-color","#ffffff");
            } else if ((data == 'NG')) {
                $(h_name).css("background-color","#ffccff");
            }else{
                $("#my-result").empty().append(data);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown.message);
        },
       complete: function (data) {
            $.unblockUI();
       }
   });
}

//入力変更チェック
function check_value_changed_10105(h_kind, h_field, h_val, h_name)
{
    if ($('#cr_id').val() == '') return;

    // h_kind   1:文字、2:日付、3：時間
    //alert($('#inp_keiyaku_no').val());
    $.ajax({
        url: m_parentURL + "check_value_changed_10105.php",
        type: 'POST',
        dataType: "html",
        async: true,
        data:{
            'cr_id': $('#cr_id').val(),
            'kind': h_kind,
            'field': h_field,
            'val': h_val,
        },
        success: function(data, dataType){
            if (data == 'OK') {
                $(h_name).css("background-color","#ffffff");
            } else if ((data == 'NG')) {
                $(h_name).css("background-color","#ffccff");
            }else{
                $("#my-result").empty().append(data);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown.message);
        },
       complete: function (data) {
            $.unblockUI();
       }
   });
}

//入力変更チェック
function check_value_changed_10107(h_kind, h_field, h_val, h_name)
{
    if ($('#cr_id').val() == '') return;

    // h_kind   1:文字、2:日付、3：時間
    //alert($('#inp_keiyaku_no').val());
    $.ajax({
        url: m_parentURL + "check_value_changed_10107.php",
        type: 'POST',
        dataType: "html",
        async: true,
        data:{
            'cr_id': $('#cr_id').val(),
            'kind': h_kind,
            'field': h_field,
            'val': h_val,
        },
        success: function(data, dataType){
            if (data == 'OK') {
                $(h_name).css("background-color","#ffffff");
            } else if ((data == 'NG')) {
                $(h_name).css("background-color","#ffccff");
            }else{
                $("#my-result").empty().append(data);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown.message);
        },
       complete: function (data) {
            $.unblockUI();
       }
   });
}

//Enterキー押下時の処理
function check_input_key_enter(h_key, h_cr_id, h_field, h_id, h_kind)
{
    //alert(h_cr_id + "," + h_field + "," + h_id);

    if(h_key == 13){
        //alert("ENTERが押されました");
        //alert($("#i_" + h_field + h_id).val());
        var a_val = $("#i_" + h_field + h_id).val();
        
        //alert(h_cr_id + "," + h_kind + "," + h_field + "," + a_val);
        //DBに登録する
        // h_kind   1:文字、2:日付、3：時間
        $.ajax({
            url: m_parentURL + "update_value_10102.php",
            type: 'POST',
            dataType: "html",
            async: true,
            data:{
                'cr_id': h_cr_id,
                'kind': h_kind,
                'field': h_field,
                'val': a_val,
            },
            success: function(data, dataType){
                //alert(data);
                if (data == 'OK') {
                    g_input_completed = true;
                    //$(h_name).css("background-color","#ffffff");
                } else if ((data == 'NG')) {
                    //$(h_name).css("background-color","#ffccff");
                }else{
                    alert(data);
                    //$("#my-result").empty().append(data);
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert(errorThrown.message);
            },
           complete: function (data) {
                $("#" + h_field + h_id).empty().append(a_val);
                g_input_click = false;
                $.unblockUI();
           }
        });

        //g_input_click = false;
    }else{
        //alert("ENTER以外が押されました");
    }    
}

//[2017.11.08]課題No.81
//[2017.12.13]要望
function file_upload(h_inp_id, h_cr_id){
    var a_fd = new FormData();
    var a_iCnt = 1;
    
    var files = $("#" + h_inp_id)[0].files;
    //var files = $("#input-file2")[0].files;
    var a_max_count = files.length;
    var a_count = 0;
    for (var i = 0; i < a_max_count; i++){
        //alert(files[i].name);
        a_fd.append("file", files[i]);
        a_fd.append("inp_id", h_inp_id);
        a_fd.append("cr_id", h_cr_id);
        $.ajax({
            url: m_parentURL + "regist_file.php",
            type: "POST",
            contentType: false,
            processData: false,
            dataType: "text",
            data: a_fd,
            async: false,
            success: function(data, dataType){
                //alert(data);
                if (data == 'OK') {
                } else if ((data == 'NG')) {
                }else{
                    alert(data);
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert(errorThrown.message);
            },
           complete: function (data) {
               a_count++;
               //alert(a_count);
           }
        });
    }
    $("#" + h_inp_id).val('');
    //$("#input-file2").val('');
    //alert('ファイルのアップロードが完了しました！');
}

//[2017.11.08]課題No.81
//[2017.12.13]要望
function edit_file_upload(h_inp_id, h_cr_id){
    if (!confirm("ファイルをアップロードします。よろしいですか？")) return;
    file_upload(h_inp_id, h_cr_id);
    if (h_inp_id == 'regist_evidence'){
        make_regist_file_list('my-evidence', 'e', h_cr_id);
    }else if (h_inp_id == 'regist_payroll'){
        make_regist_file_list('my-payroll', 'e', h_cr_id);
    }
}

//[2017.11.08]課題No.81
//[2017.12.13]要望
function make_regist_file_list(h_my_id, h_act, h_cr_id){
    //alert(h_my_id + "," +  h_act + "," + h_cr_id);
    $.ajax({
        url: m_parentURL + "make_regist_file_list.php",
        type: 'POST',
        dataType: "html",
        async: true,
        data:{
            'my_id': h_my_id,
            'act': h_act,
            'cr_id': h_cr_id,
        },
        success: function(data, dataType){
            //alert(data);
            if (data != '') {
                $("#" + h_my_id).empty().append(data);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown.message);
        },
       complete: function (data) {
       }
    });
}

//[2017.11.08]課題No.81
//[2017.12.13]要望
function delete_regist_file(h_my_id, h_cr_id, h_ed_id){
    if (!confirm("ファイルを削除します。よろしいですか？")) return;
    $.ajax({
        url: m_parentURL + "delete_regist_file.php",
        type: 'POST',
        dataType: "html",
        async: false,
        data:{
            'my_id': h_my_id,
            'cr_id': h_cr_id,
            'ed_id': h_ed_id,
        },
        success: function(data, dataType){
            //alert(data);
            if (data == 'OK') {
                make_regist_file_list(h_my_id, 'e', h_cr_id);
                //make_evidence_list('e', h_cr_id);
            }else{
                alert(data);
            }
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown.message);
        },
       complete: function (data) {
       }
    });
    
}

//事業者名[2017.11.22]bug-fixed.
function set_jigyousya_info(h_src, h_dst)
{
    var a_contract_form = $('[name=opt_contract_pay_form] option:selected').text();
    if (a_contract_form == '') {
         //$('#' + h_dst).val('');
    } else if ((a_contract_form == '正') || (a_contract_form == '契')) {
         $('#' + h_dst).val($('#' + h_src).val());
    } else {
        //事業所名・事業所名を入力可とし、空を設定
    }
}

//給与計算
function confirm_allowance(h_no){
    var  a_val = $('[name=optAllowance] option:selected').val();
    //alert(h_no + "," + a_val);
    location.href = m_parentURL + "excel_out_10108.php?NO=" + h_no + "&KIND=" + a_val;
    return false;
}