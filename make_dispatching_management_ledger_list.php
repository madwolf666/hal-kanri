<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once('./global.php');

require_once('./10600-com.php');

//POSTデータを取得
$a_PageNo = $_POST['PageNo'];

try{
    //DBからユーザ情報取得
    $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
    $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $a_sql_src = set_10600_selectDB();

    $a_where = "";
    #$a_where = "((t1.del_flag IS NULL) OR (t1.del_flag<>'1'))";    #[2018.01.26]課題解決管理表No.87
    #$a_where = com_make_where_session(1, $a_where, 't1.engineer_number', 'f_engineer_number_10600', "", "");
    #[2018.01.30]課題解決管理表No.87
    if ($_SESSION['contract_del'] != 1){
        $a_where = com_make_where_session(3, $a_where, 't1.contract_number', 'f_contract_number_10600', "", "");
        $a_where = com_make_where_session(1, $a_where, 't1.engineer_name', 'f_engineer_name_10600', "", "f_engineer_name_10600_andor");
    }else{
        $a_where = com_make_where_session(3, $a_where, 't1.contract_number', 'f_contract_number_10600_del', "", "");
        $a_where = com_make_where_session(1, $a_where, 't1.engineer_name', 'f_engineer_name_10600_del', "", "f_engineer_name_10600_andor_del");
    }
    if ($a_where != ""){
        $a_where = " WHERE ".$a_where;
    }
    
    $a_sql_src .= $a_where;

    $a_sql_src .= " ORDER BY t2.dm_no";
    
    com_select_pager($a_conn, $a_stmt, $a_sql_src, $a_PageNo, $a_total_num);

    $a_rec = 0;

    $a_sRet = "<table class='tbl_list' style='width: 100%'>";
    //$a_sRet = "<table class='tbl_list' width='98%'>";

    //ヘッダ部
    $a_sRet .= "    <tr class='tr_title'>";
    
    //固定列部分
    $a_sRet .= "        <td style='padding: 0 0;'>";
    $a_sRet .= "            <table class='tbl_list' width='320px;'>";
    $a_sRet .= "                <tr class='tr_title2'>";
    $a_sRet .= "                    <td rowspan='2' class='td_titleI' style='width: 60px;' nowrap>派遣元<br>管理No</td>";
    $a_sRet .= "                    <td rowspan='2' class='td_title2' style='width: 60px;' nowrap>契約管理No.</td>";
    $a_sRet .= "                    <td rowspan='2' class='td_title2' style='width: 40px;' nowrap>契約<br>形態</td>";
    $a_sRet .= "                    <td colspan='2' class='td_title2' style='height:25px;' nowrap>派遣労働者氏名</td>";
    $a_sRet .= "                </tr>";
    $a_sRet .= "                <tr class='tr_title2'>";
    $a_sRet .= "                    <td class='td_title2' style='width: 80px; height:25px;' nowrap>氏名</td>";
    $a_sRet .= "                    <td class='td_title2' style='width: 80px;' nowrap>カナ</td>";
    $a_sRet .= "                </tr>";
    $a_sRet .= "            </table>";
    $a_sRet .= "        </td>";
    
    //可変部分
    $a_sRet .= "        <td style='width: 440px; padding:0 0'>";
    $a_sRet .= "            <div id='right_title' style='overflow:hidden; width: 500px; padding:0 0;'>";
    $a_sRet .= "                <table class='tbl_list' style='width: 6000px;'>";
    $a_sRet .= "                    <tr>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px; height: 25px;' nowrap>派遣先</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px; ' nowrap>派遣先事業所</td>";
    $a_sRet .= "                        <td colspan='4' class='td_title2' nowrap>派遣就業場所</td>";
    $a_sRet .= "                        <td colspan='2' class='td_title2' nowrap>派遣期間</td>";
    $a_sRet .= "                        <td colspan='2' class='td_title2' nowrap>就業時間</td>";
    $a_sRet .= "                        <td colspan='2' class='td_title2' nowrap>休憩時間</td>";
    $a_sRet .= "                        <td colspan='8' class='td_title2' nowrap>派遣労働者からの苦情処理状況</td>";
    $a_sRet .= "                        <td colspan='2' class='td_title2' nowrap>派遣元責任者</td>";
    $a_sRet .= "                        <td colspan='2' class='td_title2' nowrap>派遣先責任者</td>";
    $a_sRet .= "                        <td colspan='8' class='td_title2' nowrap>就業状況</td>";
    $a_sRet .= "                        <td colspan='4' class='td_title2' nowrap>労働者派遣を行う業務に関し、</td>";
    $a_sRet .= "                        <td colspan='5' class='td_title2' nowrap>提出の有無</td>";
    $a_sRet .= "                    </tr>";
    
    $a_sRet .= "                    <tr>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px; height: 25px;' nowrap>名称</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>名称</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>名称</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>住所</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>電話</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>FAX</td>";
    
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>開始日</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>終了日</td>";
    
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>開始</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>終了</td>";
    
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>開始</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>終了</td>";

    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>申出受日1</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 200px;' nowrap>苦情内容、状況1</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>申出受日2</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 200px;' nowrap>苦情内容、状況2</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>申出受日3</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 200px;' nowrap>苦情内容、状況3</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>申出受日4</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 200px;' nowrap>苦情内容、状況4</td>";

    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>（役職）</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>（氏名）</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>役職</td>";
    $a_sRet .= "                        <td class='td_title2' style='width: 100px;' nowrap>氏名</td>";
    
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>＜日付1＞</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 200px;' nowrap>＜状況1＞</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>＜日付2＞</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 200px;' nowrap>＜状況2＞</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>＜日付3＞</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 200px;' nowrap>＜状況3＞</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>＜日付4＞</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 200px;' nowrap>＜状況4＞</td>";

    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>氏名</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>及び業務</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>休業の開始</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>休業の終了日</td>";

    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>雇用保険</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>健康保険</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>厚生年金</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>管轄</td>";
    $a_sRet .= "                        <td class='td_titleI' style='width: 100px;' nowrap>特定派遣</td>";

    $a_sRet .= "                    </tr>";
    $a_sRet .= "                </table>";
    $a_sRet .= "            </div>";
    $a_sRet .= "        </td>";
    $a_sRet .= "    </tr>";
    $a_sRet .= "    <tr>";

    $a_sRet_L = "       <td valign='top'>";
    $a_sRet_L .= "           <div id='leftColumn' style='overflow:hidden;height:433px;'>";
    $a_sRet_L .= "               <table class='tbl_list' style='width: 320px;'>";
    
    $a_sRet_R = "       <td valign='top' style='padding: 0 0;'>";
    $a_sRet_R .= "          <div id='right_record' style='padding: 0 0; overflow:scroll;width:500px;height:450px;' onscroll='document.all.right_title.scrollLeft=this.scrollLeft;document.all.leftColumn.scrollTop=this.scrollTop;'>";
    $a_sRet_R .= "              <table class='tbl_list' style='width: 6000px;'>";

/**/
    //while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
    while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
        //var_dump($a_result); 

        set_10600_fromDB($a_result);

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
        $a_sRet_L .= "<td class='td_lineI' style='width: 60px;'><div class='myover' ".com_make_input_text($cr_id,'dm_no',$a_rec,1).">".$dm_no."</td>";

        $a_sRet_L .= "<td class='td_line2' style='width: 60px;'><div class='myover'>".$contract_number."</td>";
        $a_sRet_L .= "<td class='td_line2' style='width: 40px;'><div class='myover'>".$payment_contract_form."</td>";
        $a_sRet_L .= "<td class='td_line2' style='width: 80px;'><div class='myover'>".$engineer_name."</td>";
        $a_sRet_L .= "<td class='td_line2' style='width: 80px;'><div class='myover'>".$engneer_name_phonetic."</td>";
        
        $a_sRet_L .= "</tr>";

        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$customer_name."</td>";

        //入力あり
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'dd_office',$a_rec,1).">".$dd_office."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'dd_name',$a_rec,1).">".$dd_name."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'dd_address',$a_rec,1).">".$dd_address."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'dd_tel',$a_rec,1).">".$dd_tel."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'dd_fax',$a_rec,1).">".$dd_fax."</td>";
        
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$claim_agreement_start."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$claim_agreement_end."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$work_start."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$work_end."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$break_start."</td>";
        $a_sRet_R .= "<td class='td_line2' style='width: 100px;'><div class='myover'>".$break_end."</td>";

        //入力あり
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'chs_date1',$a_rec,2).">".$chs_date1."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 200px;'><div class='myover' ".com_make_input_text($cr_id,'chs_status1',$a_rec,1).">".$chs_status1."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'chs_date2',$a_rec,2).">".$chs_date2."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 200px;'><div class='myover' ".com_make_input_text($cr_id,'chs_status2',$a_rec,1).">".$chs_status2."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'chs_date3',$a_rec,2).">".$chs_date3."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 200px;'><div class='myover' ".com_make_input_text($cr_id,'chs_status3',$a_rec,1).">".$chs_status3."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'chs_date4',$a_rec,2).">".$chs_date4."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 200px;'><div class='myover' ".com_make_input_text($cr_id,'chs_status4',$a_rec,1).">".$chs_status4."</td>";
        
        //入力あり
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover'>".$dm_responsible_position."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover'>".$dm_responsible_name."</td>";
        //$a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'dm_responsible_position',$a_rec,1).">".$dm_responsible_position."</td>";
        //$a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'dm_responsible_name',$a_rec,1).">".$dm_responsible_name."</td>";

        //入力あり
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover'>".$dd_responsible_position."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover'>".$dd_responsible_name."</td>";
        //$a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'dd_responsible_position',$a_rec,1).">".$dd_responsible_position."</td>";
        //$a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'dd_responsible_name',$a_rec,1).">".$dd_responsible_name."</td>";

        //入力あり
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'employment_date1',$a_rec,2).">".$employment_date1."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 200px;'><div class='myover' ".com_make_input_text($cr_id,'employment_status1',$a_rec,1).">".$employment_status1."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'employment_date2',$a_rec,2).">".$employment_date2."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 200px;'><div class='myover' ".com_make_input_text($cr_id,'employment_status2',$a_rec,1).">".$employment_status2."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'employment_date3',$a_rec,2).">".$employment_date3."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 200px;'><div class='myover' ".com_make_input_text($cr_id,'employment_status3',$a_rec,1).">".$employment_status3."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'employment_date4',$a_rec,2).">".$employment_date4."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 200px;'><div class='myover' ".com_make_input_text($cr_id,'employment_status4',$a_rec,1).">".$employment_status4."</td>";

        //入力あり
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'dd_worker_name',$a_rec,1).">".$dd_worker_name."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'dd_worker_business',$a_rec,1).">".$dd_worker_business."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'dd_worker_holiday_start',$a_rec,2).">".$dd_worker_holiday_start."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'dd_worker_holiday_end',$a_rec,2).">".$dd_worker_holiday_end."</td>";

        //入力あり
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'employment_insurance',$a_rec,1).">".$employment_insurance."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'health_insurance',$a_rec,1).">".$health_insurance."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'welfare_pension',$a_rec,1).">".$welfare_pension."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'jurisdiction',$a_rec,1).">".$jurisdiction."</td>";
        $a_sRet_R .= "<td class='td_lineI' style='width: 100px;'><div class='myover' ".com_make_input_text($cr_id,'specified_worker',$a_rec,1).">".$specified_worker."</td>";

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
        $a_sRet = "<div id='my-recnum'>". com_make_pager("make_dispatching_management_ledger_list", $a_total_num, $a_PageNo, $GLOBALS['g_MAX_LINE_PAGE'])."</div>".$a_sRet;
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
