<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once('./global.php');

require_once('./10500-com.php');

//POSTデータを取得
$a_PageNo = $_POST['PageNo'];

try{
    //DBからユーザ情報取得
    $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
    $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $a_sql = "SELECT t1.*,";
    $a_sql .= "
 t2.ag_no
,t2.publication
,t2.dd_office
,t2.dd_address
,t2.dd_tel
,t2.ip_position
,t2.ip_name
,t2.dm_responsible_position
,t2.dm_responsible_name
,t2.dd_responsible_position
,t2.dd_responsible_name
,t2.person_post_no
,t2.person_address
,t2.person_birthday
,t2.contact_date_org
,t2.contact_date_brn
,t2.organization
,t2.conflict_prevention
,t2.thing1
,t2.chs_position1
,t2.chs_name1
,t2.chs_position2
,t2.chs_name2
,t2.chs_tel2
,t2.dd_responsible_tel
,t2.reserve1
,t2.reserve2
,t2.reserve3
,t2.reserve4
,t2.reserve5
,t2.reserve6
,t2.reserve7
,t2.guide_ships
    ";
    $a_sql .= " FROM ".$GLOBALS['g_DB_t_contract_report']." t1";
    $a_sql .= " LEFT JOIN ";
    $a_sql .= $GLOBALS['g_DB_t_agreement_ledger']." t2";
    $a_sql .= " ON (t1.cr_id=t2.cr_id)";

    $a_where = "";
    $a_where = com_make_where_session(1, $a_where, 't1.engineer_number', 'f_engineer_number_10500', "");
    $a_where = com_make_where_session(3, $a_where, 't1.contract_number', 'f_contract_number_10500', "");
    $a_where = com_make_where_session(1, $a_where, 't1.engineer_name', 'f_engineer_name_10500', "");
    if ($a_where != ""){
        $a_where = " WHERE ".$a_where;
    }
    
    $a_sql .= $a_where;

    $a_sql .= " ORDER BY t2.ag_no;";
    
    $a_stmt = $a_conn->prepare($a_sql);
    //$a_stmt->bindParam(':pass', $a_pass,PDO::PARAM_STR);
    $a_stmt->execute();

    $a_rec = 0;

    $a_sRet = "<table class='tbl_list' style='width: 100%'>";
    //$a_sRet = "<table class='tbl_list' width='98%'>";

    //ヘッダ部
    $a_sRet .= "    <tr class='tr_title'>";
    
    //固定列部分
    $a_sRet .= "        <td style='width: 400px; padding: 0 0;' width='400px'>";
    $a_sRet .= "            <table class='tbl_list' width='410px;'>";
    $a_sRet .= "                <tr class='tr_title2'>";
    $a_sRet .= "                    <td rowspan='2' class='td_titleI' style='width: 80px;' nowrap>労働契約書<br>発行No</td>";
    $a_sRet .= "                    <td rowspan='2' class='td_title2' style='width: 60px;' nowrap>契約管理<br>No.</td>";
    $a_sRet .= "                    <td rowspan='2' class='td_titleI' style='width: 90px;' nowrap>労働契約書<br>発行日</td>";
    $a_sRet .= "                    <td rowspan='2' class='td_title2' style='width: 100px; height:25px;' nowrap>ｴﾝｼﾞﾆｱ番号</td>";
    $a_sRet .= "                    <td rowspan='2' class='td_title2' style='width: 80px;' nowrap>ｴﾝｼﾞﾆｱ名</td>";
    $a_sRet .= "                </tr>";
    $a_sRet .= "            </table>";
    $a_sRet .= "        </td>";
    
    //可変部分
    $a_sRet .= "        <td style='width: 440px; padding:0 0'>";
    $a_sRet .= "            <div id='right_title' style='overflow:hidden; width: 500px; padding:0 0;'>";
    $a_sRet .= "                <table class='tbl_list' style='width: 8000px;'>";
    $a_sRet .= "                    <tr>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>ｴﾝｼﾞﾆｱｶﾅ</td>";
    $a_sRet .= "                        <td colspan='2' class='td_title2' style='height: 25px;' nowrap>客先情報</td>";
    $a_sRet .= "                        <td colspan='2' class='td_title2' style='' nowrap>期間</td>";
    $a_sRet .= "                        <td colspan='3' class='td_title2' nowrap>作業時間</td>";
    $a_sRet .= "                        <td colspan='3' class='td_title2' nowrap>休憩時間</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width:100px;' nowrap>社会保険</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width:100px;' nowrap>源泉徴収</td>";
    $a_sRet .= "                        <td colspan='6' class='td_title2' nowrap>基本給</td>";
    $a_sRet .= "                        <td colspan='6' class='td_title2' nowrap>期中入場</td>";
    $a_sRet .= "                        <td colspan='6' class='td_title2' nowrap>期中退場</td>";
    $a_sRet .= "                        <td colspan='2' class='td_title2' nowrap>時間刻み</td>";
    $a_sRet .= "                        <td colspan='2' class='td_title2' nowrap>決済</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width:100px;' nowrap>備考</td>";
    $a_sRet .= "                        <td colspan='3' class='td_title2' nowrap>派遣就業場所</td>";
    $a_sRet .= "                        <td colspan='2' class='td_title2' nowrap>指揮命令者</td>";
    $a_sRet .= "                        <td colspan='2' class='td_title2' nowrap>派遣元責任者</td>";
    $a_sRet .= "                        <td colspan='2' class='td_title2' nowrap>派遣先責任者</td>";
    $a_sRet .= "                        <td colspan='3' class='td_title2' nowrap>個人情報</td>";
    $a_sRet .= "                        <td colspan='3' class='td_title2' nowrap>&nbsp;</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_titleI' style='width:100px;' nowrap>抵触日(組)</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_titleI' style='width:100px;' nowrap>抵触日(事)</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_titleI' style='width:100px;' nowrap>組織単位</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_titleI' style='width:100px;' nowrap>紛争防止措置</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_titleI' style='width:100px;' nowrap>&nbsp;</td>";
    $a_sRet .= "                        <td colspan='3' class='td_title2' nowrap>苦情の処理・申出先(派遣元)</td>";
    $a_sRet .= "                        <td colspan='3' class='td_title2' nowrap>苦情の処理・申出先(派遣先)</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_titleI' style='width:100px;' nowrap>派遣先責任者<br>電話番号</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_titleI' style='width:100px;' nowrap>&nbsp;</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_titleI' style='width:100px;' nowrap>&nbsp;</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_titleI' style='width:100px;' nowrap>&nbsp;</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_titleI' style='width:100px;' nowrap>&nbsp;</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_titleI' style='width:100px;' nowrap>&nbsp;</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_titleI' style='width:100px;' nowrap>&nbsp;</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_titleI' style='width:100px;' nowrap>&nbsp;</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_titleI' style='width:100px;' nowrap>派遣の案内発送</td>";
    $a_sRet .= "                    </tr>";
    
    $a_sRet .= "                    <tr>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px; height: 25px;' nowrap>客先名</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>契約形態</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>開始日</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>終了日</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>開始時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>終了時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>作業時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>開始時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>終了時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>休憩時間</td>";
    
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>計算方法</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>基準単価</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>下限時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>上限時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>控除単価</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>残業単価</td>";

    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>計算方法</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>基準単価</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>下限時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>上限時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>控除単価</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>残業単価</td>";

    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>計算方法</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>基準単価</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>下限時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>上限時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>控除単価</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>残業単価</td>";

    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>日次</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>月次</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>〆日</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>支払日</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>名称</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>住所</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>電話</td>";

    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>（役職）</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>（氏名）</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>（役職）</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>（氏名）</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>役職</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>氏名</td>";
    
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>郵便番号</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>現住所</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>生年月日</td>";
    
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>その他</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>&nbsp;</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>&nbsp;</td>";

    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>役職</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>氏名</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>役職</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>氏名</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>電話番号</td>";

    $a_sRet .= "                    </tr>";
    $a_sRet .= "                </table>";
    $a_sRet .= "            </div>";
    $a_sRet .= "        </td>";
    $a_sRet .= "    </tr>";
    $a_sRet .= "    <tr>";

    $a_sRet_L = "       <td valign='top'>";
    $a_sRet_L .= "           <div id='leftColumn' style='overflow:hidden;height:433px;'>";
    $a_sRet_L .= "               <table class='tbl_list' style='' width='410px'>";
    
    $a_sRet_R = "       <td valign='top' style='padding: 0 0;'>";
    $a_sRet_R .= "          <div id='right_record' style='padding: 0 0; overflow:scroll;width:00px;height:450px;' onscroll='document.all.right_title.scrollLeft=this.scrollLeft;document.all.leftColumn.scrollTop=this.scrollTop;'>";
    $a_sRet_R .= "              <table class='tbl_list' style='width: 8000px;'>";

/**/
    //while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
    while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
        //var_dump($a_result); 

        set_10500_fromDB($a_result);

        $a_rec++;

        if (($a_rec % 2)==0){
            $a_sRet_L .= "<tr class='linee' style='background-color: #fffff0;'>";
            $a_sRet_R .= "<tr class='linee' style='background-color: #fffff0;'>";
        }else{
            $a_sRet_L .= "<tr class='lineo'>";
            $a_sRet_R .= "<tr class='lineo'>";
        }

        //入力あり
        //$a_sRet_L .= "<td class='td_line2' style='width: 50px;'><div class='myover' id='dm_no".$a_rec."' onClick='alert(\"chappy\");'>".$a_result['dm_no']."</td>";
        $a_sRet_L .= "<td class='td_lineI' style='width: 80px;'><div class='myover' ".com_make_input_text($cr_id,'ag_no',$a_rec,1).">".$ag_no."</td>";

        $a_sRet_L .= "<td class='td_line2' style='width: 60px;'><div class='myover'>".$contract_number."</td>";
        $a_sRet_L .= "<td class='td_lineI' style='width: 90px;'><div class='myover' ".com_make_input_text($cr_id,'publication',$a_rec,1).">".$publication."</td>";

        $a_sRet_L .= "<td class='td_line2' style='width: 100px;'><div class='myover'>";
        $a_sRet_L .= "<a href='#' onclick='choice_agreement_ledger_method(\"".$a_result['cr_id']."\");'>".$engineer_number."</a>";
        $a_sRet_L .= "</td>";

        $a_sRet_L .= "<td class='td_line2' style='width: 80px;'><div class='myover'>".$engineer_name."</td>";
        
        $a_sRet_L .= "</tr>";

        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$engneer_name_phonetic."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$customer_name."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$claim_contract_form."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$claim_agreement_start."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$claim_agreement_end."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$work_start."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$work_end."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$work_hours."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$break_start."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$break_end."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$break_hours."</td>";

        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$social_insurance."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$tax_withholding."</td>";

        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_normal_calculation_2."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_normal_unit_price_2."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_normal_lower_limit_2."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_normal_upper_limit_2."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_normal_deduction_unit_price_2."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_normal_overtime_unit_price_2."</td>";

        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_middle_calculation_2."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_middle_unit_price_2."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_middle_lower_limit_2."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_middle_upper_limit_2."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_middle_deduction_unit_price_2."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_middle_overtime_unit_price_2."</td>";
        
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_leaving_calculation_2."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_leaving_unit_price_2."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_leaving_lower_limit_2."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_leaving_upper_limit_2."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_leaving_deduction_unit_price_2."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_leaving_overtime_unit_price_2."</td>";
        
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_hourly_daily."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_hourly_monthly."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_settlement_closingday."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_settlement_paymentday."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$remarks."</td>";
        
        //入力あり
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'dd_office',$a_rec,1).">".$dd_office."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'dd_address',$a_rec,1).">".$dd_address."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'dd_tel',$a_rec,1).">".$dd_tel."</td>";
        
        //入力あり
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'ip_position',$a_rec,1).">".$ip_position."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'ip_name',$a_rec,1).">".$ip_name."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'dm_responsible_position',$a_rec,1).">".$dm_responsible_position."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'dm_responsible_name',$a_rec,1).">".$dm_responsible_name."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'dd_responsible_position',$a_rec,1).">".$dd_responsible_position."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'dd_responsible_name',$a_rec,1).">".$dd_responsible_name."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'person_post_no',$a_rec,1).">".$person_post_no."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'person_address',$a_rec,1).">".$person_address."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'person_birthday',$a_rec,1).">".$person_birthday."</td>";
        

        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover'>".""."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover'>".""."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover'>".""."</td>";

        //入力あり
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'contact_date_org',$a_rec,1).">".$contact_date_org."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'contact_date_brn',$a_rec,1).">".$contact_date_brn."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'organization',$a_rec,1).">".$organization."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'conflict_prevention',$a_rec,1).">".$conflict_prevention."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover'>".""."</td>";

        //入力あり
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'chs_position1',$a_rec,1).">".$chs_position1."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'chs_name1',$a_rec,1).">".$chs_name1."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'chs_position2',$a_rec,1).">".$chs_position2."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'chs_name2',$a_rec,1).">".$chs_name2."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'chs_tel2',$a_rec,1).">".$chs_tel2."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'dd_responsible_tel',$a_rec,1).">".$dd_responsible_tel."</td>";

        //入力あり
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'reserve1',$a_rec,1).">".$reserve1."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'reserve2',$a_rec,1).">".$reserve2."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'reserve3',$a_rec,1).">".$reserve3."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'reserve4',$a_rec,1).">".$reserve4."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'reserve5',$a_rec,1).">".$reserve5."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'reserve6',$a_rec,1).">".$reserve6."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'reserve7',$a_rec,1).">".$reserve7."</td>";

        //入力あり
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'guide_ships',$a_rec,1).">".$guide_ships."</td>";

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
