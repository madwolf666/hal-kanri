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
    //DBからユーザ情報取得
    $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
    $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //①件数を取得する。
    $a_sql = "SELECT COUNT(engineer_no) AS total_num FROM ".$GLOBALS['g_DB_t_charge_calc']." ORDER BY engineer_no, calc_day_start_bill;";
    $a_stmt = $a_conn->prepare($a_sql);
    //$a_stmt->bindParam(':pass', $a_pass,PDO::PARAM_STR);
    $a_stmt->execute();
    $a_result = $a_stmt->fetch(PDO::FETCH_ASSOC);
    $a_total_num = $a_result['total_num'];
    
    $a_start_idx = (($a_PageNo-1)*$GLOBALS['g_MAX_LINE_PAGE']) + 1;
    $a_end_idx = ($a_PageNo*$GLOBALS['g_MAX_LINE_PAGE']);

    //②ページ対象のSELECT
    $a_conn->exec("SET @rownum=0");
    $a_sql = "SELECT t2.* FROM (";
    $a_sql .= " SELECT  t1.*,";
    $a_sql .= " (SELECT engineer_name FROM ".$GLOBALS['g_DB_t_contract_report']." WHERE (cr_id=t1.cr_id)) AS engineer_name,";
    $a_sql .= " (SELECT contract_number FROM ".$GLOBALS['g_DB_t_contract_report']." WHERE (cr_id=t1.cr_id)) AS contract_number,";
    $a_sql .= " @rownum:=@rownum+1 AS ROW_NUM FROM";
    $a_sql .= " (SELECT * FROM ".$GLOBALS['g_DB_t_charge_calc']." ORDER BY engineer_no, calc_day_start_bill) t1";
    $a_sql .= ") t2 WHERE (t2.ROW_NUM BETWEEN ".$a_start_idx." AND ".$a_end_idx.");";
    #$a_sql = "SELECT * FROM ".$GLOBALS['g_DB_m_covering_letter']." ORDER BY entry_no;";
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
    $a_sRet .= "        <td style='width: 300px; padding:0 0;'>";
    $a_sRet .= "            <table class='tbl_list' width='100%'>";
    $a_sRet .= "                <tr class='tr_title2'>";
    $a_sRet .= "                    <td rowspan='2' class='td_title2' style='width: 100px; height:58px;' nowrap>エンジニアNo.</td>";
    $a_sRet .= "                    <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>氏名</td>";
    $a_sRet .= "                    <td rowspan='2' class='td_title2' style='width: 100px;' nowrap>契約No.</td>";
    $a_sRet .= "                </tr>";
    $a_sRet .= "            </table>";
    $a_sRet .= "        </td>";
    
    //可変部分
    $a_sRet .= "        <td style='width: 6000px; padding:0 0'>";
    $a_sRet .= "            <div id='right_title' style='overflow:hidden; width:6000px; padding:0 0'>";
    $a_sRet .= "                <table class='tbl_list' style='width: 3000px;'>";
    $a_sRet .= "                    <tr>";
    $a_sRet .= "                        <td colspan='9' class='td_title2' style='height: 25px;' nowrap>請求サイド</td>";
    $a_sRet .= "                        <td colspan='9' class='td_title2' style='height: 25px;' nowrap>支払サイド①</td>";
    $a_sRet .= "                        <td colspan='9' class='td_title2' style='height: 25px;' nowrap>支払サイド②</td>";
    $a_sRet .= "                    </tr>";

    $a_sRet .= "                    <tr>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' height: 25px;' nowrap>締開始日</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>締終了日</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>作業時間合計</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 150px;' nowrap>作業時間合計（調整）</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>控除時間合計</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>残業時間合計</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>控除金額合計</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>残業金額合計</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>請求金額合計</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>締開始日</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>締終了日</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>作業時間合計</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 150px;' nowrap>作業時間合計（調整）</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>控除時間合計</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>残業時間合計</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>控除金額合計</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>残業金額合計</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>支払金額合計</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>締開始日</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>締終了日</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>作業時間合計</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 150px;' nowrap>作業時間合計（調整）</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>控除時間合計</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>残業時間合計</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>控除金額合計</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>残業金額合計</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>支払金額合計</td>";
    $a_sRet .= "                    </tr>";
    $a_sRet .= "                </table>";
    $a_sRet .= "            </div>";
    $a_sRet .= "        </td>";
    $a_sRet .= "    </tr>";
    $a_sRet .= "    <tr>";

    $a_sRet_L = "       <td valign='top'>";
    $a_sRet_L .= "           <div id='leftColumn' style='overflow:hidden;height:300px;'>";
    $a_sRet_L .= "               <table class='tbl_list' style='padding: 0 0;'>";
    
    $a_sRet_R = "       <td valign='top'>";
    $a_sRet_R .= "          <div id='right_record' style='overflow:scroll;width:6000px;height:450px;' onscroll='document.all.right_title.scrollLeft=this.scrollLeft;document.all.leftColumn.scrollTop=this.scrollTop;'>";
    $a_sRet_R .= "              <table class='tbl_list' style='width: 3000px'>";

/**/
    //while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
    while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
        $a_rec++;

        if (($a_rec % 2)==0){
            $a_sRet_L .= "<tr class='linee' style='background-color: #fffff0;'>";
            $a_sRet_R .= "<tr class='linee' style='background-color: #fffff0;'>";
        }else{
            $a_sRet_L .= "<tr class='lineo'>";
            $a_sRet_R .= "<tr class='lineo'>";
        }

        $a_sRet_L .= "<td class='td_line2' style='width: 100px;'><div class='myover'>";
        
        #[2017.12.06]
        $a_sRet_L .= "<a href='#' onclick='choice_charge_calc_method(\"".$a_result['cc_id']."\");'>".$a_result['engineer_no']."</a>";
        #$a_sRet_L .= $a_result['engineer_no'];
        ##$a_sRet_L .= "<a href='#' onclick='choice_covering_letter_method(\"".$a_result[0]."\");'>".$a_result[0]."</a>";
        $a_sRet_L .= "</td>";
        $a_sRet_L .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['engineer_name']."</td>";
        $a_sRet_L .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$a_result['contract_number']."</td>";
        $a_sRet_L .= "</tr>";

        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_replace_toDate($a_result['calc_day_start_bill'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_replace_toDate($a_result['calc_day_end_bill'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format($a_result['work_time_actualy_bill_src'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 150px;'><div class='myover'>".com_db_number_format($a_result['work_time_actualy_bill_dst'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format($a_result['deduction_time_actualy_bill'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format($a_result['over_time_actualy_bill'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format($a_result['charge_deduction_bill'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format($a_result['charge_over_bill'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format($a_result['charge_bill'])."</td>";
        
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_replace_toDate($a_result['calc_day_start_pay1'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_replace_toDate($a_result['calc_day_end_pay1'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format($a_result['work_time_actualy_pay1_src'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 150px;'><div class='myover'>".com_db_number_format($a_result['work_time_actualy_pay1_dst'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format($a_result['deduction_time_actualy_pay1'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format($a_result['over_time_actualy_pay1'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format($a_result['charge_deduction_pay1'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format($a_result['charge_over_pay1'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format($a_result['charge_pay1'])."</td>";

        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_replace_toDate($a_result['calc_day_start_pay2'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_replace_toDate($a_result['calc_day_end_pay2'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format($a_result['work_time_actualy_pay2_src'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 150px;'><div class='myover'>".com_db_number_format($a_result['work_time_actualy_pay2_dst'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format($a_result['deduction_time_actualy_pay2'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format($a_result['over_time_actualy_pay2'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format($a_result['charge_deduction_pay2'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format($a_result['charge_over_pay2'])."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".com_db_number_format($a_result['charge_pay2'])."</td>";

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
        $a_sRet = "<div id='my-recnum'>". com_make_pager("make_charge_calc_list", $a_total_num, $a_PageNo, $GLOBALS['g_MAX_LINE_PAGE'])."</div>".$a_sRet;
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
