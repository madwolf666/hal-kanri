<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once('./global.php');

require_once('./10200-com.php');

//POSTデータを取得
$a_PageNo = $_POST['PageNo'];

try{
    //DBからユーザ情報取得
    $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
    $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $a_sql = "SELECT t1.*,";
    $a_sql .= "
 t2.employ_num
,t2.employ_form
,t2.employ_no
,t2.date_entering
,t2.date_retire
,t2.yayoi_group
,t2.date_modify_salary
,t2.date_first_salary
,t2.status_employ_insurance
,t2.status_compensation_insurance
,t2.status_social_insurance
,t2.tax_municipal_tax
,t2.tax_dependents
,t2.tax_year_end_adjustment
,t2.labor_managerial_position
,t2.labor_contact_date
,t2.labor_yayoi_changed
,t2.labor_remarks
,t2.labor_question
,t2.labor_answer
,t2.labor_employ_no
,t2.health_insurance_standard_remuneration
,t2.thickness_year_standard_remuneration
        ";
    $a_sql .= " FROM ".$GLOBALS['g_DB_t_contract_report']." t1";
    $a_sql .= " LEFT JOIN ";
    $a_sql .= $GLOBALS['g_DB_t_payroll']." t2";
    $a_sql .= " ON (t1.cr_id=t2.cr_id)";
    $a_sql .= " ORDER BY t2.employ_no;";
    
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
    $a_sRet .= "            <table class='tbl_list' width='440px;'>";
    $a_sRet .= "                <tr class='tr_title2'>";
    $a_sRet .= "                    <td rowspan='2' class='td_titleI' style='width: 60px;' nowrap>現従業員<br>人数</td>";
    $a_sRet .= "                    <td rowspan='2' class='td_title2' style='width: 40px;' nowrap>雇用<br>形態</td>";
    $a_sRet .= "                    <td colspan='4' class='td_title2' style='height:25px;' nowrap>労働者</td>";
    $a_sRet .= "                </tr>";
    $a_sRet .= "                <tr class='tr_title2'>";
    $a_sRet .= "                    <td class='td_title2' style='width: 80px; height:25px;' nowrap>氏名</td>";
    $a_sRet .= "                    <td class='td_titleI' style='width: 80px;' nowrap>社員番号</td>";
    $a_sRet .= "                    <td class='td_titleI' style='width: 90px;' nowrap>入社日</td>";
    $a_sRet .= "                    <td class='td_titleI' style='width: 90px;' nowrap>退職日</td>";
    $a_sRet .= "                </tr>";
    $a_sRet .= "            </table>";
    $a_sRet .= "        </td>";
    
    //可変部分
    $a_sRet .= "        <td style='width: 440px; padding:0 0'>";
    $a_sRet .= "            <div id='right_title' style='overflow:hidden; width: 500px; padding:0 0;'>";
    $a_sRet .= "                <table class='tbl_list' style='width: 6000px;'>";
    $a_sRet .= "                    <tr>";
    $a_sRet .= "                        <td colspan='6' class='td_title2' style='height: 25px;' nowrap>弥生給与</td>";
    $a_sRet .= "                        <td colspan='13' class='td_title2' style='' nowrap>基本の給与</td>";
    $a_sRet .= "                        <td colspan='5' class='td_title2' nowrap>途中入場の場合の給与</td>";
    $a_sRet .= "                        <td colspan='5' class='td_title2' nowrap>途中退場の場合の給与</td>";
    $a_sRet .= "                        <td colspan='3' class='td_title2' nowrap>各種加入状況</td>";
    $a_sRet .= "                        <td colspan='3' class='td_title2' nowrap>税務状況</td>";
    $a_sRet .= "                        <td colspan='7' class='td_title2' nowrap>川島経営労務管理事務所確認欄</td>";
    $a_sRet .= "                        <td colspan='3' class='td_title2' nowrap>給与変更確認欄</td>";
    $a_sRet .= "                    </tr>";
    
    $a_sRet .= "                    <tr>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px; height: 25px;' nowrap>ｸﾞﾙｰﾌﾟ</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>〆日</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>支給日</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>給与変更日</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>変更後最初給与日</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>給与形態</td>";
    
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>役員報酬</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>基本給(月給)</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>基本給(時給)</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>職務給</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>役付手当</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>資格手当</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>技能手当</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>特別手当</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>定期代</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>残業単価</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>控除単価</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>上限時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>下限時間</td>";
    
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>基本給(月給)</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>残業単価</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>控除単価</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>上限時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>下限時間</td>";

    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>基本給(月給)</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>残業単価</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>控除単価</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>上限時間</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>下限時間</td>";
    
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>雇用保険</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>労災保険</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>社会保険</td>";
    
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>住民税</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>扶養家族</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>年末調整</td>";
    
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>役職</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>連絡日</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>弥生給与変更済</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>備考</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>質問</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>回答</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>従業員No.</td>";
    
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>健保標準報酬(千円)</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>厚年標準報酬(千円)</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>還元率</td>";

    $a_sRet .= "                    </tr>";
    $a_sRet .= "                </table>";
    $a_sRet .= "            </div>";
    $a_sRet .= "        </td>";
    $a_sRet .= "    </tr>";
    $a_sRet .= "    <tr>";

    $a_sRet_L = "       <td valign='top'>";
    $a_sRet_L .= "           <div id='leftColumn' style='overflow:hidden;height:433px;'>";
    $a_sRet_L .= "               <table class='tbl_list' style='width: 440px;'>";
    
    $a_sRet_R = "       <td valign='top' style='padding: 0 0;'>";
    $a_sRet_R .= "          <div id='right_record' style='padding: 0 0; overflow:scroll;width:500px;height:450px;' onscroll='document.all.right_title.scrollLeft=this.scrollLeft;document.all.leftColumn.scrollTop=this.scrollTop;'>";
    $a_sRet_R .= "              <table class='tbl_list' style='width: 6000px;'>";

/**/
    //while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
    while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
        //var_dump($a_result); 

        set_10200_fromDB($a_result);

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
        $a_sRet_L .= "<td class='td_lineI' style='width: 60px;'><div class='myover' ".com_make_input_text($cr_id,'employ_num',$a_rec,1).">".$employ_num."</td>";
        $a_sRet_L .= "<td class='td_line2' style='width: 40px;'><div class='myover'>".$payment_contract_form."</td>";
        $a_sRet_L .= "<td class='td_line2' style='width: 80px;'><div class='myover'>".$engineer_name."</td>";
        $a_sRet_L .= "<td class='td_lineI' style='width: 80px;'><div class='myover' ".com_make_input_text($cr_id,'employ_no',$a_rec,1).">".$employ_no."</td>";
        $a_sRet_L .= "<td class='td_lineI' style='width: 90px;'><div class='myover' ".com_make_input_text($cr_id,'date_entering',$a_rec,1).">".$date_entering."</td>";
        $a_sRet_L .= "<td class='td_lineI' style='width: 90px;'><div class='myover' ".com_make_input_text($cr_id,'date_retire',$a_rec,1).">".$date_retire."</td>";
        
        $a_sRet_L .= "</tr>";

        //入力あり
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'yayoi_group',$a_rec,1).">".$yayoi_group."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_settlement_closingday."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_settlement_paymentday."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'date_modify_salary',$a_rec,1).">".$date_modify_salary."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'date_first_salary',$a_rec,1).">".$date_first_salary."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_normal_calculation_2."</td>";

        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".""."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_normal_unit_price_2."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".""."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".""."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".""."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".""."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".""."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".""."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".""."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_normal_overtime_unit_price_2."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_normal_deduction_unit_price_2."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_normal_upper_limit_2."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_normal_lower_limit_2."</td>";
        
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_middle_unit_price_2."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_middle_overtime_unit_price_2."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_middle_deduction_unit_price_2."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_middle_upper_limit_2."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_middle_lower_limit_2."</td>";

        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_leaving_unit_price_2."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_leaving_overtime_unit_price_2."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_leaving_deduction_unit_price_2."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_leaving_upper_limit_2."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$payment_leaving_lower_limit_2."</td>";

        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'status_employ_insurance',$a_rec,1).">".$status_employ_insurance."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'status_compensation_insurance',$a_rec,1).">".$status_compensation_insurance."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'status_social_insurance',$a_rec,1).">".$status_social_insurance."</td>";
        
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'tax_municipal_tax',$a_rec,1).">".$tax_municipal_tax."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'tax_dependents',$a_rec,1).">".$tax_dependents."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'tax_year_end_adjustment',$a_rec,1).">".$tax_year_end_adjustment."</td>";

        //入力あり
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'labor_managerial_position',$a_rec,1).">".$labor_managerial_position."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'labor_contact_date',$a_rec,1).">".$labor_contact_date."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'labor_yayoi_changed',$a_rec,1).">".$labor_yayoi_changed."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'labor_remarks',$a_rec,1).">".$labor_remarks."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'labor_question',$a_rec,1).">".$labor_question."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'labor_answer',$a_rec,1).">".$labor_answer."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'labor_employ_no',$a_rec,1).">".$labor_employ_no."</td>";
        
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'health_insurance_standard_remuneration',$a_rec,1).">".$health_insurance_standard_remuneration."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'thickness_year_standard_remuneration',$a_rec,1).">".$thickness_year_standard_remuneration."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".$redemption_ratio."</td>";

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
