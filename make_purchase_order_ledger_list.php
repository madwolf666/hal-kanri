<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once('./global.php');

require_once('./10400-com.php');

//POSTデータを取得
$a_PageNo = $_POST['PageNo'];

try{
    //DBからユーザ情報取得
    $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
    $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $a_sql_src = set_10400_selectDB();
    
    $a_where = "";
    #$a_where = "((t1.del_flag IS NULL) OR (t1.del_flag<>'1'))";    #[2018.01.26]課題解決管理表No.87
    #$a_where = com_make_where_session(1, $a_where, 't1.engineer_number', 'f_engineer_number_10400', "", "");
    #[2018.01.30]課題解決管理表No.87
    if ($_SESSION['contract_del'] != 1){
        $a_where = com_make_where_session(3, $a_where, 't1.contract_number', 'f_contract_number_10400', "", "");
        $a_where = com_make_where_session(1, $a_where, 't1.engineer_name', 'f_engineer_name_10400', "", "f_engineer_name_10400_andor");
    }else{
        $a_where = com_make_where_session(3, $a_where, 't1.contract_number', 'f_contract_number_10400_del', "", "");
        $a_where = com_make_where_session(1, $a_where, 't1.engineer_name', 'f_engineer_name_10400_del', "", "f_engineer_name_10400_andor_del");
    }
    if ($a_where != ""){
        $a_where = " WHERE ".$a_where;
    }
    
    $a_sql_src .= $a_where;

    $a_sql_src .= " ORDER BY t3.ag_no";
    
    com_select_pager($a_conn, $a_stmt, $a_sql_src, $a_PageNo, $a_total_num);

    $a_rec = 0;

    $a_sRet = "<table class='tbl_list' style='width: 100%'>";
    //$a_sRet = "<table class='tbl_list' width='98%'>";

    //ヘッダ部
    $a_sRet .= "    <tr class='tr_title'>";
    
    //固定列部分
    $a_sRet .= "        <td style='padding: 0 0;'>";
    $a_sRet .= "            <table class='tbl_list' width='450px;'>";
    $a_sRet .= "                <tr class='tr_title2'>";
    $a_sRet .= "                    <td colspan='2' class='td_title2' style='height:25px;' nowrap>注文書情報</td>";
    $a_sRet .= "                    <td colspan='3' class='td_title2' style='' nowrap>エンジニア情報</td>";
    $a_sRet .= "                </tr>";
    $a_sRet .= "                <tr class='tr_title2'>";
    #$a_sRet .= "                    <td class='td_title2' style='width: 50px; height:50px;' nowrap>注文書<br>台帳<br>No.</td>";
    $a_sRet .= "                    <td class='td_title2' style='width: 60px;' nowrap>契約<br>管理<br>No.</td>";
    $a_sRet .= "                    <td class='td_titleI' style='width: 90px;' nowrap>注文書<br>発行日</td>";
    $a_sRet .= "                    <td class='td_title2' style='width: 100px; height:50px;' nowrap>HALｴﾝｼﾞﾆｱ<br>番号</td>";
    $a_sRet .= "                    <td class='td_title2' style='width: 100px;' nowrap>技術者氏名</td>";
    $a_sRet .= "                    <td class='td_title2' style='width: 100px;' nowrap>ﾌﾘｶﾞﾅ</td>";
    $a_sRet .= "                </tr>";
    $a_sRet .= "            </table>";
    $a_sRet .= "        </td>";
    
    //可変部分
    $a_sRet .= "        <td style='width: 440px; padding:0 0'>";
    $a_sRet .= "            <div id='right_title' style='overflow:hidden; width: 500px; padding:0 0;'>";
    $a_sRet .= "                <table class='tbl_list' style='width: 4600px;'>";
    $a_sRet .= "                    <tr>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px; height: 25px;' nowrap>案件情報</td>";
    $a_sRet .= "                        <td colspan='28' class='td_title2' style='' nowrap>注文内容</td>";
    $a_sRet .= "                        <td colspan='6' class='td_title2' style='' nowrap>注文書備考欄</td>";
    $a_sRet .= "                    </tr>";

    $a_sRet .= "                    <tr>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px; height: 85px;' nowrap>客先名＝<br>就業先名</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>事業者名＝<br>発注先名</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>事業者名＝<br>ﾌﾘｶﾞﾅ</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>作業<br>開始日</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>作業<br>終了日</td>";
    $a_sRet .= "                        <td colspan='6' class='td_title2' style='height: 25px;' nowrap>通常期間</td>";
    $a_sRet .= "                        <td colspan='6' class='td_title2' style='' nowrap>期中入場</td>";
    $a_sRet .= "                        <td colspan='6' class='td_title2' style='' nowrap>期中退場</td>";
    $a_sRet .= "                        <td colspan='2' class='td_title2' style='' nowrap>時間刻み</td>";
    $a_sRet .= "                        <td colspan='2' class='td_title2' style='' nowrap>決済</td>";
    #$a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>消費税区分</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>備考</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>契約形態</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_titleI' style='width: 100px;' nowrap>その他1</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_titleI' style='width: 100px;' nowrap>その他2</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_titleI' style='width: 100px;' nowrap>その他3</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_titleI' style='width: 100px;' nowrap>その他4</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_titleI' style='width: 100px;' nowrap>引継ぎ</td>";
    $a_sRet .= "                        <td rowspan='2' class='td_titleI' style='width: 100px;' nowrap>返送確認</td>";
    $a_sRet .= "                    </tr>";

    $a_sRet .= "                    <tr>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px; height: 25px;' nowrap>計算方法</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>基準単価</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>下限時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>上限時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>控除単価</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>超過単価</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>計算方法</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>基準単価</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>下限時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>上限時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>控除単価</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>超過単価</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>計算方法</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>基準単価</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>下限時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>上限時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>控除単価</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>超過単価</td>";

    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>日付</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>月次</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>締日</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>支払日</td>";
    $a_sRet .= "                    </tr>";
    $a_sRet .= "                </table>";
    $a_sRet .= "            </div>";
    $a_sRet .= "        </td>";
    $a_sRet .= "    </tr>";
    $a_sRet .= "    <tr>";

    $a_sRet_L = "       <td valign='top'>";
    $a_sRet_L .= "           <div id='leftColumn' style='overflow:hidden;height:433px;'>";
    $a_sRet_L .= "               <table class='tbl_list' style='width: 450px;'>";
    
    $a_sRet_R = "       <td valign='top' style='padding: 0 0;'>";
    $a_sRet_R .= "          <div id='right_record' style='padding: 0 0; overflow:scroll;width:500px;height:450px;' onscroll='document.all.right_title.scrollLeft=this.scrollLeft;document.all.leftColumn.scrollTop=this.scrollTop;'>";
    $a_sRet_R .= "              <table class='tbl_list' style='width: 4600px;'>";

/**/
    //while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
    while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
        //var_dump($a_result); 

        set_10400_fromDB($a_result);

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
        #$a_sRet_L .= "<td class='td_lineI' style='width: 50px;'><div class='myover' ".com_make_input_text($cr_id,'po_no',$a_rec,1).">".$po_no."</td>";
        #$a_sRet_L .= "<td class='td_line2' style='width: 50px;'><div class='myover'>".$ag_no."</td>";

        $a_sRet_L .= "<td class='td_line2' style='width: 60px;'><div class='myover'>".$contract_number."</td>";

        //入力あり
        $a_sRet_L .= "<td class='td_lineI' style='width: 90px;'><div class='myover' ".com_make_input_text($cr_id,'publication',$a_rec,2).">".$publication."</td>";

        $a_sRet_L .= "<td class='td_line2' style='width: 100px;'><div class='myover'>";
        $a_sRet_L .= "<a href='#' onclick='choice_purchase_order_ledger_method(\"".$a_result['cr_id']."\");'>".$a_result['engineer_number']."</a>";
        $a_sRet_L .= "</td>";

        $a_sRet_L .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$engineer_name."</td>";
        $a_sRet_L .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$engneer_name_phonetic."</td>";
        
        $a_sRet_L .= "</tr>";

        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$customer_name."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$business_name."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$business_name_phonetic."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$claim_agreement_start."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$claim_agreement_end."</td>";

        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_normal_calculation_1."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_normal_unit_price_1."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_normal_lower_limit_1."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_normal_upper_limit_1."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_normal_deduction_unit_price_1."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_normal_overtime_unit_price_1."</td>";

        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_middle_calculation_1."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_middle_unit_price_1."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_middle_lower_limit_1."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_middle_upper_limit_1."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_middle_deduction_unit_price_1."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_middle_overtime_unit_price_1."</td>";
        
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_leaving_calculation_1."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_leaving_unit_price_1."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_leaving_lower_limit_1."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_leaving_upper_limit_1."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_leaving_deduction_unit_price_1."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_leaving_overtime_unit_price_1."</td>";
        
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_hourly_daily."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_hourly_monthly."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_settlement_closingday."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_settlement_paymentday."</td>";
        #$a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_absence_deduction_subject."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$remarks_pay."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$claim_contract_form."</td>";
        
        //入力あり
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'remarks1',$a_rec,1).">".$remarks1."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'remarks2',$a_rec,1).">".$remarks2."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'remarks3',$a_rec,1).">".$remarks3."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'remarks4',$a_rec,1).">".$remarks4."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'inheriting',$a_rec,1).">".$inheriting."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'sending_back',$a_rec,1).">".$sending_back."</td>";

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
        $a_sRet = "<div id='my-recnum'>". com_make_pager("make_purchase_order_ledger_list", $a_total_num, $a_PageNo, $GLOBALS['g_MAX_LINE_PAGE'])."</div>".$a_sRet;
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
