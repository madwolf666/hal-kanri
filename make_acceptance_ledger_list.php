<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once('./global.php');

require_once('./10300-com.php');

//POSTデータを取得
$a_PageNo = $_POST['PageNo'];

try{
    //DBからユーザ情報取得
    $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
    $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $a_sql_src = "SELECT t1.*,";
    $a_sql_src .= "
 t2.al_id
,t2.accounts_estimate_no
,t2.accounts_contract_purchase_no
,t2.accounts_bai_previous_day
,t2.accounts_sales_will_amount
,t2.accounts_working_hours_manage
,t2.accounts_actual_working_hours
,t2.accounts_actual_amount_money
,t2.accounts_expenses
,t2.accounts_tax_meter_noinclude
,t2.accounts_tax_meter_include
,t2.accounts_invoicing
,t2.ordering_purchase_no
,t2.payment_acceptance_date
,t2.payment_schedule_amount
,t2.payment_actual_working_hours
,t2.payment_actual_amount_money
,t2.payment_commuting_expenses
,t2.payment_tax_meter_noinclude
,t2.payment_tax_meter_include
,t2.payment_bill_acceptance
,t2.payment_expenses
,t2.payment_else
,t2.payment_pre_paid
,t2.payment_advance
,t2.payment_commission
,t2.payment_total
,t2.payment_plan_month_after_next_1
,t2.payment_plan_next_month_15
,t2.payment_plan_month_after_next_15
,t2.payment_plan_else
,t2.payment_payroll_schedule
,t2.payment_transfer_processing_amount1
,t2.payment_transfer_processing_amount2
,t2.payment_difference
,t2.payment_actual_working_hours_difference
,t2.payment_gross_profit
,t2.payment_gross_profit_margin
,t3.ag_no
        ";
    $a_sql_src .= " FROM ".$GLOBALS['g_DB_t_contract_report']." t1";
    $a_sql_src .= " LEFT JOIN ";
    $a_sql_src .= $GLOBALS['g_DB_t_acceptance_ledger']." t2";
    $a_sql_src .= " ON (t1.cr_id=t2.cr_id)";
    $a_sql_src .= " LEFT JOIN ";
    $a_sql_src .= $GLOBALS['g_DB_t_agreement_ledger']." t3";
    $a_sql_src .= " ON (t1.cr_id=t3.cr_id)";

    $a_where = "";
    $a_where = com_make_where_session(1, $a_where, 't1.contract_number', 'f_contract_number_10300', "");
    $a_where = com_make_where_session(1, $a_where, 't1.engineer_number', 'f_engineer_number_10300', "");
    $a_where = com_make_where_session(1, $a_where, 't1.engineer_name', 'f_engineer_name_10300', "");
    $a_where = com_make_where_session(1, $a_where, 't1.customer_name', 'f_customer_name_10300', "");
    $a_where = com_make_where_session(3, $a_where, 't1.claim_contract_form', 'f_claim_contract_form_10300', $GLOBALS['g_DB_m_contract_bill_form']);
    $a_where = com_make_where_session(1, $a_where, 't3.ag_no', 'f_ag_no_10300', "");
    $a_where = com_make_where_session(2, $a_where, 't2.accounts_bai_previous_day', 'f_accounts_bai_previous_day_10300', "");
    $a_where = com_make_where_session(1, $a_where, 't2.accounts_actual_working_hours', 'f_accounts_actual_working_hours_10300', "");
    $a_where = com_make_where_session(1, $a_where, 't2.accounts_expenses', 'f_accounts_expenses_10300', "");
    $a_where = com_make_where_session(3, $a_where, 't1.payment_contract_form', 'f_payment_contract_form_10300', $GLOBALS['g_DB_m_contract_pay_form']);
    $a_where = com_make_where_session(2, $a_where, 't2.payment_acceptance_date', 'f_payment_acceptance_date_10300', "");
    $a_where = com_make_where_session(3, $a_where, 't1.payment_settlement_paymentday', 'f_payment_settlement_paymentday_10300', $GLOBALS['g_DB_m_contract_pay_pay']);
    if ($a_where != ""){
        $a_where = " WHERE ".$a_where;
    }
    
    $a_sql_src .= $a_where;

    $a_sql_src .= " ORDER BY t1.contract_number,t3.ag_no,t2.al_id";
    
    //①件数を取得する。
    $a_sql = "SELECT COUNT(s1.cr_id) AS total_num FROM (".$a_sql_src.") s1;";
    $a_stmt = $a_conn->prepare($a_sql);
    //$a_stmt->bindParam(':pass', $a_pass,PDO::PARAM_STR);
    $a_stmt->execute();
    $a_result = $a_stmt->fetch(PDO::FETCH_ASSOC);
    $a_total_num = $a_result['total_num'];
    
    $a_start_idx = (($a_PageNo-1)*$GLOBALS['g_MAX_LINE_PAGE']) + 1;
    $a_end_idx = ($a_PageNo*$GLOBALS['g_MAX_LINE_PAGE']);

    //②ページ対象のSELECT
    $a_conn->exec("SET @rownum=0");
    $a_sql = "SELECT s2.* FROM (";
    $a_sql .= " SELECT  s1.*, @rownum:=@rownum+1 AS ROW_NUM FROM (".$a_sql_src.") s1";
    $a_sql .= ") s2 WHERE (s2.ROW_NUM BETWEEN ".$a_start_idx." AND ".$a_end_idx.");";
    $a_stmt = $a_conn->prepare($a_sql);
    //$a_stmt->bindParam(':pass', $a_pass,PDO::PARAM_STR);
    $a_stmt->execute();

    $a_rec = 0;

    $a_sRet = "<table class='tbl_list' style='width: 100%'>";
    //$a_sRet = "<table class='tbl_list' width='98%'>";

    //ヘッダ部
    $a_sRet .= "    <tr class='tr_title'>";
    
    //固定列部分
    $a_sRet .= "        <td style='padding: 0 0;'>";
    $a_sRet .= "            <table class='tbl_list' width='310px;'>";
    $a_sRet .= "                <tr class='tr_title2'>";
    $a_sRet .= "                    <td rowspan='2' class='td_title2' style='width: 50px; height:56px;' nowrap>契約No</td>";
    $a_sRet .= "                    <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>HAL No.</td>";
    $a_sRet .= "                    <td rowspan='2' class='td_title2' style='width: 80px;' nowrap>ﾌﾘｶﾞﾅ</td>";
    $a_sRet .= "                    <td rowspan='2' class='td_title2' style='width: 80px;' nowrap>ｴﾝｼﾞﾆｱ名</td>";
    $a_sRet .= "                </tr>";
    $a_sRet .= "            </table>";
    $a_sRet .= "        </td>";
    
    //可変部分
    $a_sRet .= "        <td style='width: 440px; padding:0 0'>";
    $a_sRet .= "            <div id='right_title' style='overflow:hidden; width: 500px; padding:0 0;'>";
    $a_sRet .= "                <table class='tbl_list' style='width: 6000px;'>";
    $a_sRet .= "                    <tr>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>得意先</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>契約形態</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>件名</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>開始日</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>終了日</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_titleI' style='width: 100px;' nowrap>見積No.</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>注文書/<br>契約書No.</td>";
    $a_sRet .= "                        <td colspan='9' class='td_title2' style='width: 100px; height: 25px;' nowrap>売掛</td>";
    $a_sRet .= "                        <td colspan='8' class='td_title2' style='width: 100px; ' nowrap>発注</td>";
    $a_sRet .= "                        <td colspan='26' class='td_title2' style='width: 100px; ' nowrap>支払</td>";
    $a_sRet .= "                    </tr>";
    
    $a_sRet .= "                    <tr>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px; height: 25px;' nowrap>売上日</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>売上予定金額</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>作業時間管理表</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>実働時間</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>実績時間</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>諸経費</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>計(税抜)+諸経費</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>計(税込)</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>請求書発行</td>";

    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>仕入れ先</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>ﾌﾘｶﾞﾅ</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>契約形態</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>社保適用</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>消費税</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>開始日</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>終了日</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>注文書発行No.</td>";

    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>検収日</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>支払い予定金額</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>実働時間</td>";

    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>実績時間</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>交通費等</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>計(税抜)+諸経費</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>計(税込)</td>";
    
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>諸経費受理</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>諸経費</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>その他</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>前払い済</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>前払い</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>手数料</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>計</td>";
    
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>支払い日</td>";

    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>翌々月1日予定</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>翌月25日予定</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>翌々月15日予定</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>その他予定</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>給与振込予定</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>振込処理金額①</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>振込処理金額②</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>差額</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>実働時間の差</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>粗利</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>粗利率</td>";

    $a_sRet .= "                    </tr>";
    $a_sRet .= "                </table>";
    $a_sRet .= "            </div>";
    $a_sRet .= "        </td>";
    $a_sRet .= "    </tr>";
    $a_sRet .= "    <tr>";

    $a_sRet_L = "       <td valign='top'>";
    $a_sRet_L .= "           <div id='leftColumn' style='overflow:hidden;height:433px;'>";
    $a_sRet_L .= "               <table class='tbl_list' style='width: 310px;'>";
    
    $a_sRet_R = "       <td valign='top' style='padding: 0 0;'>";
    $a_sRet_R .= "          <div id='right_record' style='padding: 0 0; overflow:scroll;width:500px;height:450px;' onscroll='document.all.right_title.scrollLeft=this.scrollLeft;document.all.leftColumn.scrollTop=this.scrollTop;'>";
    $a_sRet_R .= "              <table class='tbl_list' style='width: 6000px;'>";

/**/
    //while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
    while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
        //var_dump($a_result); 

        set_10300_fromDB($a_result);

        $a_rec++;

        if (($a_rec % 2)==0){
            $a_sRet_L .= "<tr class='linee' style='background-color: #fffff0;'>";
            $a_sRet_R .= "<tr class='linee' style='background-color: #fffff0;'>";
        }else{
            $a_sRet_L .= "<tr class='lineo'>";
            $a_sRet_R .= "<tr class='lineo'>";
        }

        $a_sRet_L .= "<td class='td_line2' style='width: 50px;'><div class='myover'>".$contract_number."</td>";
        $a_sRet_L .= "<td class='td_line2' style='width: 100px;'><div class='myover'>";
        $a_sRet_L .= "<a href='#' onclick='choice_acceptance_ledger_method(\"".$a_result['cr_id']."\",\"".$a_result['al_id']."\");'>".$a_result['engineer_number']."</a>";
        $a_sRet_L .= "</td>";
        $a_sRet_L .= "<td class='td_line2' style='width: 80px;'><div class='myover'>".$engneer_name_phonetic."</td>";
        $a_sRet_L .= "<td class='td_line2' style='width: 80px;'><div class='myover'>".$engineer_name."</td>";
        
        $a_sRet_L .= "</tr>";

        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$customer_name."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$claim_contract_form."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$subject."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$claim_agreement_start."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$claim_agreement_end."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'accounts_estimate_no',$a_rec,1).">".$accounts_estimate_no."</td>";
        #$a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'accounts_contract_purchase_no',$a_rec,1).">".$accounts_contract_purchase_no."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$ag_no."</td>";

        //入力あり
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'accounts_bai_previous_day',$a_rec,2).">".$accounts_bai_previous_day."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'accounts_sales_will_amount',$a_rec,1).">".$accounts_sales_will_amount."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'accounts_working_hours_manage',$a_rec,1).">".$accounts_working_hours_manage."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'accounts_actual_working_hours',$a_rec,1).">".$accounts_actual_working_hours."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'accounts_actual_amount_money',$a_rec,1).">".$accounts_actual_amount_money."</td>";

        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'accounts_expenses',$a_rec,1).">".$accounts_expenses."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'accounts_tax_meter_noinclude',$a_rec,1).">".$accounts_tax_meter_noinclude."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'accounts_tax_meter_include',$a_rec,1).">".$accounts_tax_meter_include."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'accounts_invoicing',$a_rec,1).">".$accounts_invoicing."</td>";

        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$business_name."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$business_name_phonetic."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_contract_form."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$social_insurance."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_absence_deduction_subject."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$claim_agreement_start."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$claim_agreement_end."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'ordering_purchase_no',$a_rec,1).">".$ordering_purchase_no."</td>";

        //入力あり
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'payment_acceptance_date',$a_rec,2).">".$payment_acceptance_date."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'payment_schedule_amount',$a_rec,1).">".$payment_schedule_amount."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'payment_actual_working_hours',$a_rec,1).">".$payment_actual_working_hours."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'payment_actual_amount_money',$a_rec,1).">".$payment_actual_amount_money."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'payment_commuting_expenses',$a_rec,1).">".$payment_commuting_expenses."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'payment_tax_meter_noinclude',$a_rec,1).">".$payment_tax_meter_noinclude."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'payment_tax_meter_include',$a_rec,1).">".$payment_tax_meter_include."</td>";
        
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'payment_bill_acceptance',$a_rec,1).">".$payment_bill_acceptance."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'payment_expenses',$a_rec,1).">".$payment_expenses."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'payment_else',$a_rec,1).">".$payment_else."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'payment_pre_paid',$a_rec,1).">".$payment_pre_paid."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'payment_advance',$a_rec,1).">".$payment_advance."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'payment_commission',$a_rec,1).">".$payment_commission."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'payment_total',$a_rec,1).">".$payment_total."</td>";

        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_settlement_paymentday."</td>";

        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'payment_plan_month_after_next_1',$a_rec,1).">".$payment_plan_month_after_next_1."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'payment_plan_next_month_15',$a_rec,1).">".$payment_plan_next_month_15."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'payment_plan_month_after_next_15',$a_rec,1).">".$payment_plan_month_after_next_15."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'payment_plan_else',$a_rec,1).">".$payment_plan_else."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'payment_payroll_schedule',$a_rec,1).">".$payment_payroll_schedule."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'payment_transfer_processing_amount1',$a_rec,1).">".$payment_transfer_processing_amount1."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'payment_transfer_processing_amount2',$a_rec,1).">".$payment_transfer_processing_amount2."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'payment_difference',$a_rec,1).">".$payment_difference."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'payment_actual_working_hours_difference',$a_rec,1).">".$payment_actual_working_hours_difference."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'payment_gross_profit',$a_rec,1).">".$payment_gross_profit."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text2($cr_id,$al_id,'payment_gross_profit_margin',$a_rec,1).">".$payment_gross_profit_margin."</td>";

        $a_sRet_R .= "</tr>";
    }
    
    $a_sRet_L .= "               </table>";
    $a_sRet_L .= "           </div>";
    $a_sRet_L .= "       </td>";
    
    $a_sRet_R .= "               </table>";
    $a_sRet_R .= "           </div>";
    $a_sRet_R .= "       </td>";

    if ($a_rec > 0){
        $a_sRet .= $a_sRet_L.$a_sRet_R;
        $a_sRet .= "    </tr>";
        $a_sRet .= "</table>";
        $a_sRet = "<div id='my-recnum'>". com_make_pager("make_acceptance_ledger_list", $a_total_num, $a_PageNo, $GLOBALS['g_MAX_LINE_PAGE'])."</div>".$a_sRet;
    }else{
        $a_sRet = "登録データはありません。";
    }
/**/
} catch (PDOException $e){
    $a_sRet = 'Error:'.$e->getMessage();
}
$a_conn = null;

echo $a_sRet;

?>
