<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once('./global.php');

//POSTデータを取得
$a_PageNo = $_POST['PageNo'];

try{
    $a_today = date("Y/m/d");
    
    //DBからユーザ情報取得
    $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
    $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $a_sql = "SELECT * FROM ".$GLOBALS['g_DB_t_contract_report'];
    
    $a_where = "";
    $a_where = com_make_where_session(1, $a_where, 'engineer_name', $_SESSION['f_engineer_name'], "");
    $a_where = com_make_where_session(1, $a_where, 'engineer_number', $_SESSION['f_engineer_number'], "");
    $a_where = com_make_where_session(1, $a_where, 'contract_number', $_SESSION['f_contract_number'], "");
    $a_where = com_make_where_session(1, $a_where, 'customer_name', $_SESSION['f_customer_name'], "");
    $a_where = com_make_where_session(2, $a_where, 'claim_agreement_start', $_SESSION['f_claim_agreement_start'], "");
    $a_where = com_make_where_session(2, $a_where, 'claim_agreement_end', $_SESSION['f_claim_agreement_end'], "");
    $a_where = com_make_where_session(3, $a_where, 'claim_contract_form', $_SESSION['f_claim_contract_form'], $GLOBALS['g_DB_m_contract_bill_form']);
    $a_where = com_make_where_session(3, $a_where, 'claim_settlement_closingday', $_SESSION['f_claim_settlement_closingday'], $GLOBALS['g_DB_m_contract_tighten']);
    $a_where = com_make_where_session(3, $a_where, 'claim_settlement_paymentday', $_SESSION['f_claim_settlement_paymentday'], $GLOBALS['g_DB_m_contract_bill_pay']);
    $a_where = com_make_where_session(1, $a_where, 'remarks', $_SESSION['f_remarks'], "");
    if ($a_where != ""){
        $a_where = " WHERE ".$a_where;
    }
    
    $a_sql .= $a_where;
    $a_sql .= " ORDER BY contract_number;";
    #echo $a_sql;
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
    $a_sRet .= "            <table class='tbl_list' width='400px;'>";
    $a_sRet .= "                <tr class='tr_title2'>";
    $a_sRet .= "                    <td rowspan='1' class='td_title2' style='width: 52px; height:86px;' nowrap>No</td>";
    $a_sRet .= "                    <td rowspan='1' class='td_title2' style='width: 90px;' nowrap>発行日</td>";
    $a_sRet .= "                    <td colspan='1' class='td_title2' style='width: 80px;' nowrap>作成者</td>";
    $a_sRet .= "                    <td colspan='1' class='td_title2' style='width: 100px;' nowrap>ｴﾝｼﾞﾆｱ<br>番号</td>";
    $a_sRet .= "                    <td colspan='1' class='td_title2' style='width: 78px;' nowrap>ｴﾝｼﾞﾆｱ名</td>";
    $a_sRet .= "                </tr>";
    $a_sRet .= "            </table>";
    $a_sRet .= "        </td>";
    
    //可変部分
    $a_sRet .= "        <td style='width: 440px; padding:0 0'>";
    $a_sRet .= "            <div id='right_title' style='overflow:hidden; width: 500px; padding:0 0;'>";
    $a_sRet .= "                <table class='tbl_list' style='width: 8400px;'>";
    $a_sRet .= "                    <tr>";
    $a_sRet .= "                        <td colspan='41' class='td_title2' style='height: 25px;' nowrap>請求サイド</td>";
    $a_sRet .= "                        <td colspan='33' class='td_title2' style='' nowrap>支払サイド</td>";
    $a_sRet .= "                        <td colspan='2' class='td_title2' style='' nowrap>&nbsp;</td>";
    #$a_sRet .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($a_result['cr_id'],'check_date_start',$a_rec).">".str_replace("-", "/", $a_result['check_date_start'])."</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>".""."</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>".$a_today."</td>";
    $a_sRet .= "                        <td colspan='3' class='td_title2' style='' nowrap>&nbsp;</td>";
    $a_sRet .= "                    </tr>";
    
    $a_sRet .= "                    <tr>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px; height: 25px;' nowrap>客先名</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>件名</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>作業場所</td>";
    $a_sRet .= "                        <td colspan='3' class='td_title2' style='width: 100px;' nowrap>作業時間</td>";
    $a_sRet .= "                        <td colspan='3' class='td_title2' style='width: 100px;' nowrap>休憩時間</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>客先担当部署</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>客先担当者</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>開始日</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>終了日</td>";
    $a_sRet .= "                        <td colspan='6' class='td_title2' style='width: 100px;' nowrap>通常期間</td>";
    $a_sRet .= "                        <td colspan='6' class='td_title2' style='width: 100px;' nowrap>期中入場</td>";
    $a_sRet .= "                        <td colspan='6' class='td_title2' style='width: 100px;' nowrap>期中退場</td>";
    $a_sRet .= "                        <td colspan='2' class='td_title2' style='width: 100px;' nowrap>時間刻み</td>";
    $a_sRet .= "                        <td colspan='2' class='td_title2' style='width: 100px;' nowrap>決済</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>見積依頼書</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>見積書</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>注文書</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>注文請書</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>備考</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>契約形態</td>";
    
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>事業者名</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>担当者名</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>開始日</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>終了日</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>還元率</td>";
    $a_sRet .= "                        <td colspan='6' class='td_title2' style='width: 100px;' nowrap>通常期間</td>";
    $a_sRet .= "                        <td colspan='6' class='td_title2' style='width: 100px;' nowrap>期中入場</td>";
    $a_sRet .= "                        <td colspan='6' class='td_title2' style='width: 100px;' nowrap>期中退場</td>";
    $a_sRet .= "                        <td colspan='2' class='td_title2' style='width: 100px;' nowrap>時間刻み</td>";
    $a_sRet .= "                        <td colspan='2' class='td_title2' style='width: 100px;' nowrap>決済</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>消費税区分</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>見積書</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>注文書</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>注文請書</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>備考</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>契約</td>";
    
    $a_sRet .= "                        <td rowspan='2' class='td_titleI' style='width: 100px;' nowrap>確認日付</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_titleI' style='width: 100px;' nowrap>確認担当者</td>";
    #$a_sRet .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($a_result['cr_id'],'check_date_end',$a_rec).">".str_replace("-", "/", $a_result['check_date_end'])."</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>&nbsp;</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>現在稼働</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>稼働累計</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_titleI' style='width: 100px;' nowrap>営業支援費</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_titleI' style='width: 100px;' nowrap>管理メモ</td>";
    $a_sRet .= "                    </tr>";

    $a_sRet .= "                    <tr>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px; height: 25px;' nowrap>開始時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>終了時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>作業時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>開始時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>終了時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>休憩時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>基準単金</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>下限時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>上限時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>控除単価</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>残業単価</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>計算方法</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>基準単金</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>下限時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>上限時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>控除単価</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>残業単価</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>計算方法</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>基準単金</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>下限時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>上限時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>控除単価</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>残業単価</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>日次</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>月次</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>締め</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>支払</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>受理</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>発送</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>受理</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>発送</td>";
    
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>計算方法</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>基準単金</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>下限時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>上限時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>控除単価</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>残業単価</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>計算方法</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>基準単金</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>下限時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>上限時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>控除単価</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>残業単価</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>計算方法</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>基準単金</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>下限時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>上限時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>控除単価</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>残業単価</td>";
    
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>日次</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>月次</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>締め</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>支払</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>受理</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>発送</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>受理</td>";
    
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>&nbsp;</td>";

    $a_sRet .= "                    </tr>";
    $a_sRet .= "                </table>";
    $a_sRet .= "            </div>";
    $a_sRet .= "        </td>";
    $a_sRet .= "    </tr>";
    $a_sRet .= "    <tr>";

    $a_sRet_L = "       <td valign='top'>";
    $a_sRet_L .= "           <div id='leftColumn' style='overflow:hidden;height:433px;'>";
    $a_sRet_L .= "               <table class='tbl_list' style='width: 400px;'>";
    
    $a_sRet_R = "       <td valign='top' style='padding: 0 0;'>";
    $a_sRet_R .= "          <div id='right_record' style='padding: 0 0; overflow:scroll;width:500px;height:450px;' onscroll='document.all.right_title.scrollLeft=this.scrollLeft;document.all.leftColumn.scrollTop=this.scrollTop;'>";
    $a_sRet_R .= "              <table class='tbl_list' style='width: 8400px;'>";

/**/
    #現在稼働
    $a_active_now = 0;
    $a_active_sum = 0;
    //while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
    while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
        $a_rec++;

        #現在稼働
        $a_date_start = str_replace("-", "/", $a_result['claim_agreement_start']);
        $a_date_end = str_replace("-", "/", $a_result['claim_agreement_end']);
        if (($a_today>=$a_date_start) && ($a_today<=$a_date_end)){
            $a_active_now = 1;
            $a_active_sum++;
        } else {
            $a_active_now = 0;
        }
        
        if (($a_rec % 2)==0){
            $a_sRet_L .= "<tr class='linee' style='background-color: #fffff0;'>";
            $a_sRet_R .= "<tr class='linee' style='background-color: #fffff0;'>";
        }else{
            $a_sRet_L .= "<tr class='lineo'>";
            $a_sRet_R .= "<tr class='lineo'>";
        }

        $a_sRet_L .= "<td class='td_line2' style='width: 50px;'><div class='myover'>".$a_result['contract_number']."</td>";
        //$a_sRet_L .= "<td class='td_line2' style='width: 51px;'><div class='myover' ".com_make_input_text($a_result['cr_id'],'contract_number',$a_rec).">".$a_result['contract_number']."</td>";
        
        $a_sRet_L .= "<td class='td_line2' style='width: 90px;'><div class='myover'>".com_replace_toDate($a_result['publication'])."</td>";
        $a_sRet_L .= "<td class='td_line2' style='width: 80px;'><div class='myover'>".$a_result['author']."</td>";
        
        $a_sRet_L .= "<td class='td_line2' style='width: 100px;'><div class='myover'>";
        $a_sRet_L .= "<a href='#' onclick='choice_contract_report_method(\"".$a_result['cr_id']."\");'>".$a_result['engineer_number']."</a>";
        $a_sRet_L .= "</td>";
        
        $a_sRet_L .= "<td class='td_line2' style='width: 80px;'><div class='myover'>".$a_result['engineer_name']."</td>";
        $a_sRet_L .= "</tr>";

        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['customer_name']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['subject']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['workplace']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['work_start']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['work_end']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['work_hours']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['break_start']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['break_end']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['break_hours']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['customer_department_charge']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['customer_charge_name']."</td>";
        //$a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['customer_clerk_charge']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".str_replace("-", "/", $a_result['claim_agreement_start'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".str_replace("-", "/", $a_result['claim_agreement_end'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['claim_normal_calculation']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format_symbol($a_result['claim_normal__unit_price'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['claim_normal_lower_limit']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['claim_normal_upper_limit']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format_symbol($a_result['claim_normal_deduction_unit_price'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format_symbol($a_result['claim_normal_overtime_unit_price'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['claim_middle_calculation']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format_symbol($a_result['claim_middle_unit_price'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['claim_middle_lower_limit']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['claim_middle_upper_limit']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format_symbol($a_result['claim_middle_deduction_unit_price'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format_symbol($a_result['claim_middle_overtime_unit_price'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['claim_leaving_calculation']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format_symbol($a_result['claim_leaving_unit_price'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['claim_leaving_lower_limit']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['claim_leaving_upper_limit']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format_symbol($a_result['claim_leaving_deduction_unit_price'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format_symbol($a_result['claim_leaving_overtime_unit_price'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['claim_hourly_daily']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['claim_hourly_monthly']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['claim_settlement_closingday']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['claim_settlement_paymentday']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['claim_dispatch_individual_contract']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['claim_quotation']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['claim_purchase_order']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['claim_confirmation_order']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['remarks']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['claim_contract_form']."</td>";

        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['business_name']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['business_charge_name']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".str_replace("-", "/", $a_result['payment_agreement_start'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".str_replace("-", "/", $a_result['payment_agreement_end'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['redemption_ratio']."</td>";

        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['payment_normal_calculation_1']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format_symbol($a_result['payment_normal_unit_price_1'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['payment_normal_lower_limit_1']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['payment_normal_upper_limit_1']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format_symbol($a_result['payment_normal_deduction_unit_price_1'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format_symbol($a_result['payment_normal_overtime_unit_price_1'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['payment_middle_calculation_1']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format_symbol($a_result['payment_middle_unit_price_1'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['payment_middle_lower_limit_1']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['payment_middle_upper_limit_1']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format_symbol($a_result['payment_middle_deduction_unit_price_1'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format_symbol($a_result['payment_middle_overtime_unit_price_1'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['payment_leaving_calculation_1']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format_symbol($a_result['payment_leaving_unit_price_1'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['payment_leaving_lower_limit_1']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['payment_leaving_upper_limit_1']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format_symbol($a_result['payment_leaving_deduction_unit_price_1'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format_symbol($a_result['payment_leaving_overtime_unit_price_1'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['payment_hourly_daily']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['payment_hourly_monthly']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['payment_settlement_closingday']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['payment_settlement_paymentday']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['payment_absence_deduction_subject']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['payment_quotation']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['payment_purchase_order']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['payment_confirmation_order']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['remarks']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['payment_contract_form']."</td>";

        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($a_result['cr_id'],'check_correct_date',$a_rec,1).">".str_replace("-", "/", $a_result['check_correct_date'])."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($a_result['cr_id'],'check_correct_person',$a_rec,1).">".$a_result['check_correct_person']."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".""."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_active_now."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_active_sum."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($a_result['cr_id'],'check_remarks1',$a_rec,1).">".$a_result['check_remarks1']."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($a_result['cr_id'],'check_remarks2',$a_rec,1).">".$a_result['check_remarks2']."</td>";

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
        $a_sRet = "<div id='my-recnum'>".$a_rec."件</div>".$a_sRet;
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
