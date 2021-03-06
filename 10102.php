<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./header.php');


if (!isset($_GET['ACT'])){
    $a_act = '';
}else{
    $a_act = $_GET['ACT'];
}

#[2018.01.29]課題解決管理表No.87
if ($_SESSION['contract_del'] == 1){
    $a_act = '';
}


require_once('./10100-com.php');

$cr_id_src = '';   #[2017.07.20]課題解決表No.67

if ($a_act == 'n'){
    if (isset($_GET['ENO'])) {
        $inp_engineer_no = $_GET['ENO'];
        try{
            //DBからユーザ情報取得
            $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
            $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $a_sql = "SELECT * FROM ".$GLOBALS['g_DB_m_engineer']." WHERE (entry_no=:entry_no);";
            $a_stmt = $a_conn->prepare($a_sql);
            $a_stmt->bindParam(':entry_no', $inp_engineer_no,PDO::PARAM_STR);
            $a_stmt->execute();

            while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
                $txt_engineer_name = $a_result['last_name']." ".$a_result['first_name'];
                $txt_engineer_kana = $a_result['last_kana']." ".$a_result['first_kana'];
                $txt_jigyosya_name = $txt_engineer_name;
                $txt_jigyosya_kana = $txt_engineer_kana;
            }
        } catch (PDOException $e){
            echo 'Error:'.$e->getMessage();
            die();
        }
    }
} else {
    if (isset($_GET['NO'])) {
        $a_no = $_GET['NO'];
        try{
            //DBからユーザ情報取得
            $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
            $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $a_sql = set_10100_selectDB();

            $a_sql .= " WHERE (cr_id=:cr_id);";
            $a_stmt = $a_conn->prepare($a_sql);
            $a_stmt->bindParam(':cr_id', $a_no, PDO::PARAM_STR);
            $a_stmt->execute();

            while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
                set_10100_fromDB($a_result);
            }
        } catch (PDOException $e){
            echo 'Error:'.$e->getMessage();
            die();
        }
        
        #[2018.01.29]課題解決管理表No.88-90
        get_10100_selectDB_submission();
    }
}

if ($a_act == 'c') {
    //契約継続時
    $cr_id = "";
    
    $inp_kyakusaki_kaishi = "";
    if ($inp_kyakusaki_syuryo != '') {
        //1日プラス
        $inp_kyakusaki_kaishi = date("Y/m/d", strtotime($inp_kyakusaki_syuryo." 1 day"));
    }
    $inp_kyakusaki_syuryo = "";
    $opt_contract_kind = "継続契約";
    $inp_keiyaku_no = "";
    $inp_hakkobi = "";
    $txt_kyakusaki_kaishi = $inp_kyakusaki_kaishi;
    $txt_kyakusaki_syuryo = "";
    $a_act = 'n';

    $status_cd = "営業作成中";  #[2017.07.20]課題解決表No.67
    $cr_id_src = $_GET['NO'];   #[2017.07.20]課題解決表No.67
}else{
    if ($a_act != 'n'){
        #管理本部かレポート作成者以外は更新不可
        if (($reg_id == $_SESSION['hal_idx']) || ($_SESSION['hal_department_cd'] == 3)){
        }else{
            $a_act = '';
        }
        #echo $status_cd_num;
        #管理本部以外で、かつステータスが「営業提出」「管理承認」の場合は更新不可
        if (($_SESSION['hal_department_cd'] != 3) && (($status_cd_num == 1) || ($status_cd_num == 2))){
            $a_act = '';
        }
    }
}

$a_selected = false;

?>

<link rel="stylesheet" href="./jquery/jquery-ui.css">
<link rel="stylesheet" href="./jquery/jquery.datetimepicker.css">
<script type="text/javascript" src="./jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="./jquery/jquery.ui.datepicker-ja.min.js"></script>
<script type="text/javascript" src="./jquery/jquery.datetimepicker.js"></script>
<!-- script type="text/javascript" src="./jquery/jquery.MultiFile.js"></script -->

<link rel="stylesheet" href="css/hal-kanri-10102.css">

<section>
    
<h2>契約管理全体<?php if($_SESSION['contract_del'] == 1){echo '(削除済)';} ?></h2>
<h3>契約レポート<?php if($_SESSION['contract_del'] == 1){echo '(削除済)';} ?></h3>

<form action="" method="post">

<center>
<br>
<font size="+1"><FONT color="red" class="yellow">黄色の枠の項目だけ入力してください。</FONT>　<i><B>ＨＡＬ契約レポート</B></i></font>
<ul class="myul" style="list-style:none;">
<!-- 左側のテーブル群 -->
    <li class="myli">
<!-- 左1番目のテーブル -->
        <table border="1" rules="all" width=340 height=280>
            <tr>
                <td colspan="12" class="gray" height=15>請求ｻｲﾄﾞ（売上）</td>
            </tr>
            <tr>
                <td colspan="2" class="yellow" height=15>客先名</td>
                <td colspan="10" style="background-color: <?php echo $color_customer_name; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $inp_kyakusaki;
                        } else {
                            echo com_make_tag_input($a_act, $inp_kyakusaki, "inp_kyakusaki", "width: 260px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="yellow" height=15>件名</td>
                <td colspan="10" style="background-color: <?php echo $color_subject; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $inp_kenmei;
                        } else {
                            echo com_make_tag_input($a_act, $inp_kenmei, "inp_kenmei", "width: 260px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="yellow" height=15 nowrap>契約形態</td>
                <td colspan="10" style="background-color: <?php echo $color_claim_contract_form; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $opt_contarct_bill_form;
                        } else {
                            echo com_make_tag_option($a_act, $opt_contarct_bill_form, "opt_contarct_bill_form", $GLOBALS['g_DB_m_contract_bill_form'], "width: 260px;", $a_selected);
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="yellow" height=15 nowrap>作業場所</td>
                <td colspan="10" style="background-color: <?php echo $color_workplace; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $inp_sagyo_basyo;
                        } else {
                            echo com_make_tag_input($a_act, $inp_sagyo_basyo, "inp_sagyo_basyo", "width: 260px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="yellow" height=15 nowrap>開始</td>
                <td colspan="2" style="background-color: <?php echo $color_work_start; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $inp_kaishi1;
                        } else {
                            echo com_make_tag_input($a_act, $inp_kaishi1, "inp_kaishi1", "width: 40px; text-align: center;");
                        }
                    ?>
                </td>
                <td colspan="2" class="yellow" nowrap>終了</td>
                <td colspan="2" style="background-color: <?php echo $color_work_end; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $inp_syuryo1;
                        } else {
                            echo com_make_tag_input($a_act, $inp_syuryo1, "inp_syuryo1", "width: 40px; text-align: center;");
                        }
                    ?>
                </td>
                <td colspan="2" class="gray" nowrap>作業時間</td>
                <td colspan="2" width="50" style="background-color: <?php echo $color_work_hours; ?>">
                    <!-- 自動計算：終了－開始－休憩時間 -->
                    <?php
                        if ($a_act == '') {
                            echo $txt_sagyo_jikan;
                        } else {
                    ?>
                    <input type="text" id="txt_sagyo_jikan" readonly="true" value="<?php echo $txt_sagyo_jikan; ?>" style="width:50px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="yellow" height=15 nowrap>開始</td>
                <td colspan="2" style="background-color: <?php echo $color_break_start; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $inp_kaishi2;
                        } else {
                            echo com_make_tag_input($a_act, $inp_kaishi2, "inp_kaishi2", "width: 40px; text-align: center;");
                        }
                    ?>
                </td>
                <td colspan="2" class="yellow" nowrap>終了</td>
                <td colspan="2" style="background-color: <?php echo $color_break_end; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $inp_syuryo2;
                        }else{
                            echo com_make_tag_input($a_act, $inp_syuryo2, "inp_syuryo2", "width: 40px; text-align: center;");
                        }
                    ?>
                </td>
                <td colspan="2" class="gray" nowrap>休憩時間</td>
                <td colspan="2" width="50" style="background-color: <?php echo $color_break_hours; ?>">
                <!-- 終了－開始 -->
                    <?php
                        if ($a_act == '') {
                            echo $txt_kyukei_jikan;
                        } else {
                    ?>
                <input type="text" id="txt_kyukei_jikan" readonly="true" value="<?php echo $txt_kyukei_jikan; ?>" style="width:50px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
        </table>
          <br>
<!-- 左2番目のテーブル -->
        <table border="1" rules="all" width=340 height=280>
            <tr>
                <td colspan="2" class="yellow" height=15>客先担当部署</td>
                <td colspan="10" style="background-color: <?php echo $color_customer_department_charge; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $inp_kyakusaki_busyo;
                        }else{
                            echo com_make_tag_input($a_act, $inp_kyakusaki_busyo, "inp_kyakusaki_busyo", "width: 200px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="yellow" height=15>客先担当者名</td>
                <td colspan="10" style="background-color: <?php echo $color_customer_charge_name; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $inp_kyakusaki_tantosya;
                        }else{
                            echo com_make_tag_input($a_act, $inp_kyakusaki_tantosya, "inp_kyakusaki_tantosya", "width: 200px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <input type="hidden" id="inp_kyakusaki_jimutantosya" readonly="true" value="" style="width: 160px; text-align: center;">
            <!--
            <tr>
                <td colspan="2" class="yellow" height=15>客先事務担当者名</td>
                <td colspan="10">
                    <?php
                        if ($a_act == ''){
                            echo $inp_kyakusaki_jimutantosya;
                        }else{
                            echo com_make_tag_input($a_act, $inp_kyakusaki_jimutantosya, "inp_kyakusaki_jimutantosya", "width: 200px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            -->
            <tr>
                <td colspan="2" class="yellow" height=15>担当者役職</td>
                <td colspan="10" style="background-color: <?php echo $color_charge_position; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $inp_kyakusaki_yakusyoku;
                        }else{
                            echo com_make_tag_input($a_act, $inp_kyakusaki_yakusyoku, "inp_kyakusaki_yakusyoku", "width: 200px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="yellow" height=15>連絡先TEL</td>
                <td colspan="10" style="background-color: <?php echo $color_contact_phone_number; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $inp_kyakusaki_tel;
                        }else{
                            echo com_make_tag_input($a_act, $inp_kyakusaki_tel, "inp_kyakusaki_tel", "width: 200px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="yellow" height=15>契約開始日</td>
                <td colspan="10" style="background-color: <?php echo $color_claim_agreement_start; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $inp_kyakusaki_kaishi;
                        }else{
                            echo com_make_tag_input($a_act, $inp_kyakusaki_kaishi, "inp_kyakusaki_kaishi", "width: 200px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="yellow" height=15>契約終了日</td>
                  <td colspan="10" style="background-color: <?php echo $color_claim_agreement_end; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $inp_kyakusaki_syuryo;
                        }else{
                            echo com_make_tag_input($a_act, $inp_kyakusaki_syuryo, "inp_kyakusaki_syuryo", "width: 200px; text-align: center;");
                        }
                    ?>
              </td>
            </tr>
        </table>
        <br>
        <!-- 日割り時の割合-->
        <table border="1" rules="all" width=340 height="110">
            <tr>
                <td colspan="3" class="yellow">日割り時の割合(入場時)</td>
            </tr>
            <tr>
                <td class="gray" style="width: 120px;">自動計算</td>
                <td style="background-color: <?php echo $color_payment_middle_daily_auto; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $inp_wariai_nyujyo_c1;
                        } else {
                    ?>
                    <input type="text" id="inp_wariai_nyujyo_c1" readonly="true" value="<?php echo $inp_wariai_nyujyo_c1; ?>" style="width: 160px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
                <td style="width: 40px;">人月</td>
            </tr>
            <tr>
                <td class="yellow" style="width: 120px;">手入力</td>
                <td style="background-color: <?php echo $color_payment_middle_daily_manual; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $inp_wariai_nyujyo_c2;
                        }else{
                            echo com_make_tag_input($a_act, $inp_wariai_nyujyo_c2, "inp_wariai_nyujyo_c2", "width: 160px; text-align: center;");
                        }
                    ?>
                </td>
                <td style="width: 40px;">人月</td>
            </tr>
        </table>
        <table border="1" rules="all" width=340 height="110">
            <tr>
                <td colspan="3" class="yellow">日割り時の割合(退場時)</td>
            </tr>
            <tr>
                <td class="gray" style="width: 120px;">自動計算</td>
                <td style="background-color: <?php echo $color_payment_leaving_daily_auto; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $inp_wariai_taijyo_c1;
                        } else {
                    ?>
                    <input type="text" id="inp_wariai_taijyo_c1" readonly="true" value="<?php echo $inp_wariai_taijyo_c1; ?>" style="width: 160px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
                <td style="width: 40px;">人月</td>
            </tr>
            <tr>
                <td class="yellow" style="width: 120px;">手入力</td>
                <td style="background-color: <?php echo $color_payment_leaving_daily_manual; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $inp_wariai_taijyo_c2;
                        }else{
                            echo com_make_tag_input($a_act, $inp_wariai_taijyo_c2, "inp_wariai_taijyo_c2", "width: 160px; text-align: center;");
                        }
                    ?>
                </td>
                <td style="width: 40px;">人月</td>
            </tr>
        </table>
        <br>
        <table border="0" rules="" width=340 height="220">
            <tr>
                <td class="" height="22">
                    &nbsp;
                </td>
            </tr>
            <?php
                if ($a_act == '') {
            ?>
            <tr>
                <td colspan="3" class="">
                    <div id="my-dummy" name="my-dummy" style="line-height: 24px; text-align: left;"></div>
                </td>
            </tr>
            <?php
                } else {
            ?>
            <tr>
                <td colspan="3" class="">
                    <div id="my-dummy" name="my-dummy" style="line-height: 24px; text-align: left;"></div>
                </td>
            </tr>
            <tr>
                <td class="" style="width: auto; height:100px; text-align: left;">
                    &nbsp;
             <?php
                        if ($a_act == 'e') {
            ?>
                        &nbsp;
            <?php
                        }
            ?>
                </td>
            </tr>
            <?php
                }
            ?>
        </table>
        <br>
        <br style="line-height: 34px;" >
<!-- 左3番目のテーブル -->
        <table border="1" rules="all" width=340 height=330>
            <tr>
                <td rowspan="7" width=6 class="Length yellow" height=90>通常期間</td>
                <td colspan="2" class="yellow">計算方法</td>
                <td colspan="9" style="background-color: <?php echo $color_claim_normal_calculation; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_calc_b1;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_calc_b1, "opt_contract_calc_b1", $GLOBALS['g_DB_m_contract_calc'], "width: 230px;", $a_selected);
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="yellow">単金</td>
                <td colspan="9" style="background-color: <?php echo $color_claim_normal__unit_price; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $inp_tankin_b1;
                        }else{
                            echo com_make_tag_input($a_act, $inp_tankin_b1, "inp_tankin_b1", "width: 230px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="yellow">ﾍﾞｰｽ単金</td>
                <td colspan="9" style="background-color: <?php echo $color_claim_normal_unit_price_base; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $claim_normal_unit_price_base;
                        }else{
                            echo com_make_tag_input($a_act, $claim_normal_unit_price_base, "claim_normal_unit_price_base", "width: 230px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="yellow">下限時間</td>
                <td colspan="9" style="background-color: <?php echo $color_claim_normal_lower_limit; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $contract_lower_limit_b1;
                        }else{
                            echo com_make_tag_option($a_act, $contract_lower_limit_b1, "opt_contract_lower_limit_b1", $GLOBALS['g_DB_m_contract_lower_limit'], "width: 110px;", $a_selected);
                            echo '&nbsp;&nbsp;';
                            if ($a_selected == true){
                                $contract_lower_limit_b1 = "";
                            }
                            echo com_make_tag_input($a_act, $contract_lower_limit_b1, "txt_contract_lower_limit_b1", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="yellow">上限時間</td>
                <td colspan="9" style="background-color: <?php echo $color_claim_normal_upper_limit; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $contract_upper_limit_b1;
                        }else{
                            echo com_make_tag_option($a_act, $contract_upper_limit_b1, "opt_contract_upper_limit_b1", $GLOBALS['g_DB_m_contract_upper_limit'], "width: 110px;", $a_selected);
                            echo '&nbsp;&nbsp;';
                            if ($a_selected == true){
                                $contract_upper_limit_b1 = "";
                            }
                            echo com_make_tag_input($a_act, $contract_upper_limit_b1, "txt_contract_upper_limit_b1", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="yellow">控除単価</td>
                <td colspan="3" class="yellow">単位</td>
                <td colspan="3" style="background-color: <?php echo $color_claim_normal_deduction_unit_price_truncation_unit; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_trunc_unit_kojyo;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_trunc_unit_kojyo, "opt_contract_trunc_unit_kojyo", $GLOBALS['g_DB_m_contract_trunc_unit'], "", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="3" width="70" style="background-color: <?php echo $color_claim_normal_deduction_unit_price; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_kojyo_unit_b1;
                        } else {
                    ?>
                    <input type="text" id="txt_contract_kojyo_unit_b1" readonly="true" value="<?php echo $txt_contract_kojyo_unit_b1; ?>" style="width:70px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="yellow">残業単価</td>
                <td colspan="3" class="yellow">単位</td>
                <td colspan="3" style="background-color: <?php echo $color_claim_normal_overtime_unit_price_truncation_unit; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_trunc_unit_zangyo;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_trunc_unit_zangyo, "opt_contract_trunc_unit_zangyo", $GLOBALS['g_DB_m_contract_trunc_unit'], "", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="3" width="70" style="background-color: <?php echo $color_claim_normal_overtime_unit_price; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_zangyo_unit_b1;
                        } else {
                    ?>
                    <input type="text" id="txt_contract_zangyo_unit_b1" readonly="true" value="<?php echo $txt_contract_zangyo_unit_b1; ?>" style="width:70px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td rowspan="9" class="Length yellow" height=120 width="6">途中入場</td>
                <td colspan="2" class="yellow">就業日数</td>
                <td colspan="9" style="background-color: <?php echo $color_claim_middle_employment_day; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $inp_syugyonisu_b2;
                        }else{
                            echo com_make_tag_input($a_act, $inp_syugyonisu_b2, "inp_syugyonisu_b2", "width: 230px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="yellow">全営業日数</td>
                <td colspan="9" style="background-color: <?php echo $color_claim_middle_allbusiness_day; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $inp_zeneigyonisu_b2;
                        }else{
                            echo com_make_tag_input($a_act, $inp_zeneigyonisu_b2, "inp_zeneigyonisu_b2", "width: 230px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="yellow">計算方法</td>
                <td colspan="9" style="background-color: <?php echo $color_claim_middle_calculation; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_calc_b2;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_calc_b2, "opt_contract_calc_b2", $GLOBALS['g_DB_m_contract_calc'], "width: 230px;", $a_selected);
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">単金</td>
                <td colspan="9" style="background-color: <?php echo $color_claim_middle_unit_price; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_tankin_b2;
                        } else {
                    ?>
                    <input type="text" id="txt_tankin_b2" readonly="true" value="<?php echo $txt_tankin_b2; ?>" style="width:230px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="yellow">ﾍﾞｰｽ単金</td>
                <td colspan="9" style="background-color: <?php echo $color_claim_middle_unit_price_base; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $claim_middle_unit_price_base;
                        }else{
                            echo com_make_tag_input($a_act, $claim_middle_unit_price_base, "claim_middle_unit_price_base", "width: 230px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="yellow">下限時間</td>
                <td colspan="9" style="background-color: <?php echo $color_claim_middle_lower_limit; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $contract_lower_limit_b2;
                        }else{
                            /*[2017.11.09]課題No.81
                            echo com_make_tag_option($a_act, $contract_lower_limit_b2, "opt_contract_lower_limit_b2", $GLOBALS['g_DB_m_contract_lower_limit'], "width: 110px;", $a_selected);
                            echo '&nbsp;&nbsp;';
                            if ($a_selected == true){
                                $contract_lower_limit_b2 = "";
                            }
                            */
                            echo com_make_tag_input($a_act, $contract_lower_limit_b2, "txt_contract_lower_limit_b2", "width: 230px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="yellow">上限時間</td>
                <td colspan="9" style="background-color: <?php echo $color_claim_middle_upper_limit; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $contract_upper_limit_b2;
                        }else{
                            /*[2017.11.09]課題No.81
                            echo com_make_tag_option($a_act, $contract_upper_limit_b2, "opt_contract_upper_limit_b2", $GLOBALS['g_DB_m_contract_upper_limit'], "width: 110px;", $a_selected);
                            echo '&nbsp;&nbsp;';
                            if ($a_selected == true){
                                $contract_upper_limit_b2 = "";
                            }
                            */
                            echo com_make_tag_input($a_act, $contract_upper_limit_b2, "txt_contract_upper_limit_b2", "width: 230px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">控除単価</td>
                <td colspan="9" style="background-color: <?php echo $color_claim_middle_deduction_unit_price; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_kojyo_unit_b2;
                        } else {
                    ?>
                    <input type="text" id="txt_contract_kojyo_unit_b2" readonly="true" value="<?php echo $txt_contract_kojyo_unit_b2; ?>" style="width:230px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">残業単価</td>
                <td colspan="9" style="background-color: <?php echo $color_claim_middle_overtime_unit_price; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_zangyo_unit_b2;
                        } else {
                    ?>
                    <input type="text" id="txt_contract_zangyo_unit_b2" readonly="true" value="<?php echo $txt_contract_zangyo_unit_b2; ?>" style="width:230px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td rowspan="9" class="Length yellow" height=120 width="6">途中退場</td>
                <td colspan="2" class="yellow">就業日数</td>
                <td colspan="9" style="background-color: <?php echo $color_claim_leaving_employment_day; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $inp_syugyonisu_b3;
                        }else{
                            echo com_make_tag_input($a_act, $inp_syugyonisu_b3, "inp_syugyonisu_b3", "width: 230px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="yellow">全営業日数</td>
                <td colspan="9" style="background-color: <?php echo $color_claim_leaving_allbusiness_day; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $inp_zeneigyonisu_b3;
                        }else{
                            echo com_make_tag_input($a_act, $inp_zeneigyonisu_b3, "inp_zeneigyonisu_b3", "width: 230px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="yellow">計算方法</td>
                <td colspan="9" style="background-color: <?php echo $color_claim_leaving_calculation; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_calc_b3;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_calc_b3, "opt_contract_calc_b3", $GLOBALS['g_DB_m_contract_calc'], "width: 230px;", $a_selected);
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">単金</td>
                <td colspan="9" style="background-color: <?php echo $color_claim_leaving_unit_price; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_tankin_b3;
                        } else {
                    ?>
                    <input type="text" id="txt_tankin_b3" readonly="true" value="<?php echo $txt_tankin_b3; ?>" style="width:230px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="yellow">ﾍﾞｰｽ単金</td>
                <td colspan="9" style="background-color: <?php echo $color_claim_leaving_unit_price_base; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $claim_leaving_unit_price_base;
                        }else{
                            echo com_make_tag_input($a_act, $claim_leaving_unit_price_base, "claim_leaving_unit_price_base", "width: 230px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="yellow">下限時間</td>
                <td colspan="9" style="background-color: <?php echo $color_claim_leaving_lower_limit; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $contract_lower_limit_b3;
                        }else{
                            /*[2017.11.09]課題No.81
                            echo com_make_tag_option($a_act, $contract_lower_limit_b3, "opt_contract_lower_limit_b3", $GLOBALS['g_DB_m_contract_lower_limit'], "width: 110px;", $a_selected);
                            echo '&nbsp;&nbsp;';
                            if ($a_selected == true){
                                $contract_lower_limit_b3 = "";
                            }
                            */
                            echo com_make_tag_input($a_act, $contract_lower_limit_b3, "txt_contract_lower_limit_b3", "width: 230px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="yellow">上限時間</td>
                <td colspan="9" style="background-color: <?php echo $color_claim_leaving_upper_limit; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $contract_upper_limit_b3;
                        }else{
                            /*[2017.11.09]課題No.81
                            echo com_make_tag_option($a_act, $contract_upper_limit_b3, "opt_contract_upper_limit_b3", $GLOBALS['g_DB_m_contract_upper_limit'], "width: 110px;", $a_selected);
                            echo '&nbsp;&nbsp;';
                            if ($a_selected == true){
                                $contract_upper_limit_b3 = "";
                            }
                            */
                            echo com_make_tag_input($a_act, $contract_upper_limit_b3, "txt_contract_upper_limit_b3", "width: 230px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">控除単価</td>
                <td colspan="9" style="background-color: <?php echo $color_claim_leaving_deduction_unit_price; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_kojyo_unit_b3;
                        } else {
                    ?>
                    <input type="text" id="txt_contract_kojyo_unit_b3" readonly="true" value="<?php echo $txt_contract_kojyo_unit_b3; ?>" style="width:230px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">残業単価</td>
                <td colspan="9" style="background-color: <?php echo $color_claim_leaving_overtime_unit_price; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_zangyo_unit_b3;
                        } else {
                    ?>
                    <input type="text" id="txt_contract_zangyo_unit_b3" readonly="true" value="<?php echo $txt_contract_zangyo_unit_b3; ?>" style="width:230px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
        </table>
        <br>
<!-- 左4番目のテーブル -->
        <table border="1" rules="all" width=340 height=60>
            <tr>
                <td colspan="4" class="yellow" height=15 width="180">時間刻み</td>
                <td colspan="2" class="yellow" width="50">日次</td>
                <td colspan="2" style="background-color: <?php echo $color_claim_hourly_daily; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $opt_m_contract_time_inc_bd;
                        }else{
                            echo com_make_tag_option($a_act, $opt_m_contract_time_inc_bd, "opt_m_contract_time_inc_bd", $GLOBALS['g_DB_m_contract_time_inc'], "width: 50px;", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="2" class="yellow">月次</td>
                <td colspan="2" style="background-color: <?php echo $color_claim_hourly_monthly; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $opt_m_contract_time_inc_bm;
                        }else{
                            echo com_make_tag_option($a_act, $opt_m_contract_time_inc_bm, "opt_m_contract_time_inc_bm", $GLOBALS['g_DB_m_contract_time_inc'], "width: 100px;", $a_selected);
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="yellow" height=15>決済</td>
                <td colspan="2" class="yellow">締め</td>
                <td colspan="2" style="background-color: <?php echo $color_claim_settlement_closingday; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_tighten_b;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_tighten_b, "opt_contract_tighten_b", $GLOBALS['g_DB_m_contract_tighten'], "width: 50px;", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="2" class="yellow"><font size="-1">支払日</font></td>
                <td colspan="2" style="background-color: <?php echo $color_claim_settlement_paymentday; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_bill_pay;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_bill_pay, "opt_contract_bill_pay", $GLOBALS['g_DB_m_contract_bill_pay'], "", $a_selected);
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="yellow" height=15>派遣個別<br>契約書</td>
                <td colspan="3" style="background-color: <?php echo $color_claim_dispatch_individual_contract; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $opt_m_contract_yesno_b1;
                        }else{
                            echo com_make_tag_option($a_act, $opt_m_contract_yesno_b1, "opt_m_contract_yesno_b1", $GLOBALS['g_DB_m_contract_yesno'], "width: 50px;", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="2" class="yellow">見積書</td>
                <td colspan="3" style="background-color: <?php echo $color_claim_quotation; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $opt_m_contract_yesno_b2;
                        }else{
                            echo com_make_tag_option($a_act, $opt_m_contract_yesno_b2, "opt_m_contract_yesno_b2", $GLOBALS['g_DB_m_contract_yesno'], "width: 50px;", $a_selected);
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="yellow" height=15>注文書</td>
                <td colspan="3" style="background-color: <?php echo $color_claim_purchase_order; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $opt_m_contract_yesno_b3;
                        }else{
                            echo com_make_tag_option($a_act, $opt_m_contract_yesno_b3, "opt_m_contract_yesno_b3", $GLOBALS['g_DB_m_contract_yesno'], "width: 50px;", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="2" class="yellow">注文請書</td>
                <td colspan="3" style="background-color: <?php echo $color_claim_confirmation_order; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $opt_m_contract_yesno_b4;
                        }else{
                            echo com_make_tag_option($a_act, $opt_m_contract_yesno_b4, "opt_m_contract_yesno_b4", $GLOBALS['g_DB_m_contract_yesno'], "width: 50px;", $a_selected);
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="yellow" height=15>請求書送付日</td>
                <td colspan="8" style="background-color: <?php echo $color_claim_accounts_invoicing; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $claim_accounts_invoicing;
                        }else{
                            echo com_make_tag_input($a_act, $claim_accounts_invoicing, "claim_accounts_invoicing", "width: 100px; text-align: center;");
                        }
                    ?>
                    &nbsp;&nbsp;営業日
                </td>
            </tr>
        </table>
    </li>
    <br>
<!-- 右側のテーブル群 -->
    <li class="myli">
<!-- 右1番目のテーブル -->
        <table border="1" rules="all" width=340 height=280>
            <tr>
		<td colspan="4" class="yellow" height=15 nowrap="true">新規or継続</td>
                <td colspan="4" style="background-color: <?php echo $color_new_or_continued; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_kind;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_kind, "opt_contract_kind", $GLOBALS['g_DB_m_contract_kind'], "width: 130px;", $a_selected);
                        }
                    ?>
                </td>
		<td colspan="3">担当営業</td>
            </tr>
            <tr>
                <td colspan="4" class="yellow" height=15>契約No</td>
                <td colspan="4" style="background-color: <?php echo $color_contract_number; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $inp_keiyaku_no;
                        }else{
                            echo com_make_tag_input($a_act, $inp_keiyaku_no, "inp_keiyaku_no", "width: 130px; text-align: center;");
                        }
                    ?>
                </td>
                <td colspan="3" rowspan="4" style="background-color: <?php echo $color_upd_person; ?>">
                    <?php
                        if ($upd_person != ''){
                            echo $upd_person;
                        }else{
                            echo $reg_person;
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="yellow" height=15>発行日</td>
                <td colspan="4" style="background-color: <?php echo $color_publication; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $inp_hakkobi;
                        }else{
                            echo com_make_tag_input($a_act, $inp_hakkobi, "inp_hakkobi", "width: 130px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="yellow" height=15>作成者</td>
                <td colspan="4" style="background-color: <?php echo $color_author; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $inp_sakuseisya;
                        }else{
                            echo com_make_tag_input($a_act, $inp_sakuseisya, "inp_sakuseisya", "width: 130px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="8" class="gray" height=15>支払ｻｲﾄﾞ（仕入）</td>
            </tr>
            <tr>
                <td colspan="4" class="yellow" height=15>ｴﾝｼﾞﾆｱNo</td>
                <td colspan="7" style="background-color: <?php echo $color_engineer_number; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $inp_engineer_no;
                        }else{
                            echo com_make_tag_input($a_act, $inp_engineer_no, "inp_engineer_no", "width: 240px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="gray" height=15>ｴﾝｼﾞﾆｱ氏名</td>
                <td colspan="3" width="100" style="background-color: <?php echo $color_engineer_name; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_engineer_name;
                        } else {
                            echo com_make_tag_input($a_act, $txt_engineer_name, "txt_engineer_name", "width: 90px; text-align: center;");
                        }
                    ?>
                </td>
                <td class="gray">ﾌﾘｶﾞﾅ</td>
                <td colspan="3" width="100" style="background-color: <?php echo $color_engneer_name_phonetic; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_engineer_kana;
                        } else {
                            echo com_make_tag_input($a_act, $txt_engineer_kana, "txt_engineer_kana", "width: 100px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
        </table>
        <br>
  <!-- 右2番目のテーブル -->
        <table border="1" rules="all" width=340 height=280>
            <tr>
		<td colspan="4" class="yellow" height=15 nowrap="true">事業者名</td>
                <td colspan="9" style="background-color: <?php echo $color_business_name; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_jigyosya_name;
                        } else {
                    ?>
                    <input type="text" id="txt_jigyosya_name" readonly="true" value="<?php echo $txt_jigyosya_name; ?>" style="width:220px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="yellow" height=15>契約形態</td>
                <td style="background-color: <?php echo $color_payment_contract_form; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_pay_form;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_pay_form, "opt_contract_pay_form", $GLOBALS['g_DB_m_contract_pay_form'], "", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="2" class="yellow"nowrap="true">事業者名ﾌﾘｶﾞﾅ</td>
                <td colspan="6" style="background-color: <?php echo $color_business_name_phonetic; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_jigyosya_kana;
                        } else {
                    ?>
                    <input type="text" id="txt_jigyosya_kana" readonly="true" value="<?php echo $txt_jigyosya_kana; ?>" style="width:80px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="yellow" height=15 nowrap="true">事業者担当者名</td>
                <td colspan="6" style="background-color: <?php echo $color_business_charge_name; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $inp_jigyosya_tanto;
                        }else{
                            echo com_make_tag_input($a_act, $inp_jigyosya_tanto, "inp_jigyosya_tanto", "width: 170px; text-align: center;");
                        }
                    ?>
                </td>
                <td colspan="3" class="yellow">還元率</td>
            </tr>
            <tr>
                <td colspan="4" class="yellow" height=15>社会保険</td>
                <td colspan="2" width="40" style="background-color: <?php echo $color_social_insurance; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $opt_social_insurance;
                        }else{
                            echo com_make_tag_option($a_act, $opt_social_insurance, "opt_social_insurance", $GLOBALS['g_DB_m_contract_yesno'], "width: 40px;", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="1" class="yellow">源泉徴収</td>
                <td colspan="3" width="40" style="background-color: <?php echo $color_tax_withholding; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $opt_tax_withholding;
                        }else{
                            echo com_make_tag_option($a_act, $opt_tax_withholding, "opt_tax_withholding", $GLOBALS['g_DB_m_contract_yesno'], "width: 40px;", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="3" rowspan="3" style="background-color: <?php echo $color_redemption_ratio; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_reduction;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_reduction, "opt_contract_reduction", $GLOBALS['g_DB_m_contract_reduction'], "width: 40px;", $a_selected);
                            #[2018.01.10]協の場合還元率を手入力
                            echo com_make_tag_input($a_act, $txt_contract_reduction, "txt_contract_reduction", "width: 40px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="gray" height=15 nowrap="true">契約開始日</td>
                <td colspan="6" style="background-color: <?php echo $color_payment_agreement_start; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_kyakusaki_kaishi;
                        } else {
                    ?>
                    <input type="text" id="txt_kyakusaki_kaishi" readonly="true" value="<?php echo $txt_kyakusaki_kaishi; ?>" style="width:170px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="gray" height=15>契約終了日</td>
                <td colspan="6" style="background-color: <?php echo $color_payment_agreement_end; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_kyakusaki_syuryo;
                        } else {
                    ?>
                    <input type="text" id="txt_kyakusaki_syuryo" readonly="true" value="<?php echo $txt_kyakusaki_syuryo; ?>" style="width:170px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
        </table>
        <br>
        <!-- 日割り時の割合-->
        <table border="1" rules="all" width=340 height="220">
            <tr>
                <td class="yellow" height="22">
                    給与計算
                </td>
            </tr>
            <?php
                if ($a_act == '') {
            ?>
            <tr>
                <td colspan="3" class="" style="background-color: <?php echo $color_payroll; ?>">
                    <div id="my-payroll" name="my-payroll" style="line-height: 24px; text-align: left;"></div>
                </td>
            </tr>
            <?php
                } else {
            ?>
            <tr>
                <td colspan="3" class="" style="background-color: <?php echo $color_payroll; ?>">
                    <div id="my-payroll" name="my-payroll" style="line-height: 24px; text-align: left;"></div>
                </td>
            </tr>
            <tr>
                <td class="" style="width: auto; height:100px; text-align: left;">
                    <!-- div style="height: 100px; line-height: 24px;" -->
                        <input type="file" name="regist_payroll" id="regist_payroll" multiple>
                        <!-- input type="file" name="input-file" id="input-file" class="multi max-3" -->
                    <!-- /div -->
             <?php
                        if ($a_act == 'e') {
            ?>
                        <input type="button" value="ｱｯﾌﾟﾛｰﾄﾞ" onClick="edit_file_upload('regist_payroll', '<?php echo $cr_id; ?>');" style="padding: 0px 4px 0px 4px;">
            <?php
                        }
            ?>
                   <!--
                    <div id="image_upload_section">
                        <div id="drop" style="width:autopx; height:80px; padding:0px; border:3px solid #ff0000" ondragover="onDragOver(event)" ondrop="onDrop(event)">
                            ファイルをドラッグアンドドロップして下さい。
                        </div>
                    </div>
                    -->
                </td>
            </tr>
            <?php
                }
            ?>
        </table>
        <br>
        <table border="1" rules="all" width=340 height="220">
            <tr>
                <td class="yellow" height="22">
                    エビデンス
                </td>
            </tr>
            <?php
                if ($a_act == '') {
            ?>
            <tr>
                <td colspan="3" class="" style="background-color: <?php echo $color_evidence; ?>">
                    <div id="my-evidence" name="my-evidence" style="line-height: 24px; text-align: left;"></div>
                </td>
            </tr>
            <?php
                } else {
            ?>
            <tr>
                <td colspan="3" class="" style="background-color: <?php echo $color_evidence; ?>">
                    <div id="my-evidence" name="my-evidence" style="line-height: 24px; text-align: left;"></div>
                </td>
            </tr>
            <tr>
                <td class="" style="width: auto; height:100px; text-align: left;">
                    <!-- div style="height: 100px; line-height: 24px;" -->
                        <input type="file" name="regist_evidence" id="regist_evidence" multiple>
                        <!-- input type="file" name="input-file" id="input-file" class="multi max-3" -->
                    <!-- /div -->
             <?php
                        if ($a_act == 'e') {
            ?>
                        <input type="button" value="ｱｯﾌﾟﾛｰﾄﾞ" onClick="edit_file_upload('regist_evidence', '<?php echo $cr_id; ?>');" style="padding: 0px 4px 0px 4px;">
            <?php
                        }
            ?>
                   <!--
                    <div id="image_upload_section">
                        <div id="drop" style="width:autopx; height:80px; padding:0px; border:3px solid #ff0000" ondragover="onDragOver(event)" ondrop="onDrop(event)">
                            ファイルをドラッグアンドドロップして下さい。
                        </div>
                    </div>
                    -->
                </td>
            </tr>
            <?php
                }
            ?>
        </table>
        <br>
<!-- 右3番目のテーブル -->
        <table border="1" rules="all" width=340 height=330>
            <tr>
                <td colspan="3" class="gray" height=15><B>支払条件</B></td>
                <td colspan="4" class="gray"><B>①ｴﾝｼﾞﾆｱ還元金額</B></td>
                <td colspan="4" class="gray"><B>②本人名目給与</B></td>
            </tr>
            <tr>
		<td rowspan="7" width=4 class="Length gray" height=90>通常期間</td>
                <td colspan="2" class="gray">計算方法</td>
                <td colspan="4" style="background-color: <?php echo $color_payment_normal_calculation_1; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_calc_p11;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_calc_p11, "opt_contract_calc_p11", $GLOBALS['g_DB_m_contract_calc'], "width: 110px;", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="4" style="background-color: <?php echo $color_payment_normal_calculation_2; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_calc_p21;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_calc_p21, "opt_contract_calc_p21", $GLOBALS['g_DB_m_contract_calc'], "width: 110px;", $a_selected);
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">単金</td>
                <td colspan="4" style="background-color: <?php echo $color_payment_normal_unit_price_1; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_tankin_p11;
                        } else {
                            echo com_make_tag_input($a_act, $txt_tankin_p11, "txt_tankin_p11", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
                <td colspan="4" style="background-color: <?php echo $color_payment_normal_unit_price_2; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_tankin_p21;
                        } else {
                            echo com_make_tag_input($a_act, $txt_tankin_p21, "txt_tankin_p21", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">ﾍﾞｰｽ単金</td>
                <td colspan="4" style="background-color: <?php echo $color_payment_normal_unit_price_1_base; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $payment_normal_unit_price_1_base;
                        } else {
                    ?>
                    <input type="text" id="payment_normal_unit_price_1_base" readonly="true" value="<?php echo $payment_normal_unit_price_1_base; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
                <td colspan="4" style="background-color: <?php echo $color_payment_normal_unit_price_2_base; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $payment_normal_unit_price_2_base;
                        } else {
                    ?>
                    <input type="text" id="payment_normal_unit_price_2_base" readonly="true" value="<?php echo $payment_normal_unit_price_2_base; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">下限時間</td>
                <td colspan="4" style="background-color: <?php echo $color_payment_normal_lower_limit_1; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_lower_limit_p11;
                        } else {
                            echo com_make_tag_input($a_act, $txt_contract_lower_limit_p11, "txt_contract_lower_limit_p11", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
                <td colspan="4" style="background-color: <?php echo $color_payment_normal_lower_limit_2; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_lower_limit_p21;
                        } else {
                            echo com_make_tag_input($a_act, $txt_contract_lower_limit_p21, "txt_contract_lower_limit_p21", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">上限時間</td>
                <td colspan="4" style="background-color: <?php echo $color_payment_normal_upper_limit_1; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_upper_limit_p11;
                        } else {
                            echo com_make_tag_input($a_act, $txt_contract_upper_limit_p11, "txt_contract_upper_limit_p11", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
                <td colspan="4" style="background-color: <?php echo $color_payment_normal_upper_limit_2; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_upper_limit_p21;
                        } else {
                            echo com_make_tag_input($a_act, $txt_contract_upper_limit_p21, "txt_contract_upper_limit_p21", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">控除単価</td>
                <td colspan="4" style="background-color: <?php echo $color_payment_normal_deduction_unit_price_1; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_kojyo_unit_p11;
                        } else {
                            echo com_make_tag_input($a_act, $txt_contract_kojyo_unit_p11, "txt_contract_kojyo_unit_p11", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
                <td colspan="4" style="background-color: <?php echo $color_payment_normal_deduction_unit_price_2; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_kojyo_unit_p21;
                        } else {
                            echo com_make_tag_input($a_act, $txt_contract_kojyo_unit_p21, "txt_contract_kojyo_unit_p21", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">残業単価</td>
                <td colspan="4" style="background-color: <?php echo $color_payment_normal_overtime_unit_price_1; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_zangyo_unit_p11;
                        } else {
                            echo com_make_tag_input($a_act, $txt_contract_zangyo_unit_p11, "txt_contract_zangyo_unit_p11", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
                <td colspan="4" style="background-color: <?php echo $color_payment_normal_overtime_unit_price_2; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_zangyo_unit_p21;
                        } else {
                            echo com_make_tag_input($a_act, $txt_contract_zangyo_unit_p21, "txt_contract_zangyo_unit_p21", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td rowspan="9" width=4 class="Length gray" height=120>途中入場</td>
                <td colspan="2" class="gray">就業日数</td>
                <td colspan="4" style="background-color: <?php echo $color_payment_middle_employment_day_1; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_syugyonisu_p12;
                        } else {
                            echo com_make_tag_input($a_act, $txt_syugyonisu_p12, "txt_syugyonisu_p12", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
                <td colspan="4" style="background-color: <?php echo $color_payment_middle_employment_day_2; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_syugyonisu_p22;
                        } else {
                            echo com_make_tag_input($a_act, $txt_syugyonisu_p22, "txt_syugyonisu_p22", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">全営業日数</td>
                <td colspan="4" style="background-color: <?php echo $color_payment_middle_allbusiness_day_1; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_zeneigyonisu_p12;
                        } else {
                            echo com_make_tag_input($a_act, $txt_zeneigyonisu_p12, "txt_zeneigyonisu_p12", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
                <td colspan="4" style="background-color: <?php echo $color_payment_middle_allbusiness_day_2; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_zeneigyonisu_p22;
                        } else {
                            echo com_make_tag_input($a_act, $txt_zeneigyonisu_p22, "txt_zeneigyonisu_p22", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">計算方法</td>
                <td colspan="4" style="background-color: <?php echo $color_payment_middle_calculation_1; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_calc_p12;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_calc_p12, "opt_contract_calc_p12", $GLOBALS['g_DB_m_contract_calc'], "width: 110px;", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="4" style="background-color: <?php echo $color_payment_middle_calculation_2; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_calc_p22;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_calc_p22, "opt_contract_calc_p22", $GLOBALS['g_DB_m_contract_calc'], "width: 110px;", $a_selected);
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">単金</td>
                <td colspan="4" style="background-color: <?php echo $color_payment_middle_unit_price_1; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_tankin_p12;
                        } else {
                            echo com_make_tag_input($a_act, $txt_tankin_p12, "txt_tankin_p12", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
                <td colspan="4" style="background-color: <?php echo $color_payment_middle_unit_price_2; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_tankin_p22;
                        } else {
                            echo com_make_tag_input($a_act, $txt_tankin_p22, "txt_tankin_p22", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">ﾍﾞｰｽ単金</td>
                <td colspan="4" style="background-color: <?php echo $color_payment_middle_unit_price_1_base; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $payment_middle_unit_price_1_base;
                        } else {
                    ?>
                    <input type="text" id="payment_middle_unit_price_1_base" readonly="true" value="<?php echo $payment_middle_unit_price_1_base; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
                <td colspan="4" style="background-color: <?php echo $color_payment_middle_unit_price_2_base; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $payment_middle_unit_price_2_base;
                        } else {
                    ?>
                    <input type="text" id="payment_middle_unit_price_2_base" readonly="true" value="<?php echo $payment_middle_unit_price_2_base; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
            <td colspan="2" class="gray">下限時間</td>
            <td colspan="4" style="background-color: <?php echo $color_payment_middle_lower_limit_1; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_lower_limit_p12;
                        } else {
                            echo com_make_tag_input($a_act, $txt_contract_lower_limit_p12, "txt_contract_lower_limit_p12", "width: 110px; text-align: center;");
                        }
                    ?>
            </td>
            <td colspan="4" style="background-color: <?php echo $color_payment_middle_lower_limit_2; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_lower_limit_p22;
                        } else {
                            echo com_make_tag_input($a_act, $txt_contract_lower_limit_p22, "txt_contract_lower_limit_p22", "width: 110px; text-align: center;");
                        }
                    ?>
            </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">上限時間</td>
                <td colspan="4" style="background-color: <?php echo $color_payment_middle_upper_limit_1; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_upper_limit_p12;
                        } else {
                            echo com_make_tag_input($a_act, $txt_contract_upper_limit_p12, "txt_contract_upper_limit_p12", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
                <td colspan="4" style="background-color: <?php echo $color_payment_middle_upper_limit_2; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_upper_limit_p22;
                        } else {
                            echo com_make_tag_input($a_act, $txt_contract_upper_limit_p22, "txt_contract_upper_limit_p22", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">控除単価</td>
                <td colspan="4" style="background-color: <?php echo $color_payment_middle_deduction_unit_price_1; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_kojyo_unit_p12;
                        } else {
                            echo com_make_tag_input($a_act, $txt_contract_kojyo_unit_p12, "txt_contract_kojyo_unit_p12", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
                <td colspan="4" style="background-color: <?php echo $color_payment_middle_deduction_unit_price_2; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_kojyo_unit_p22;
                        } else {
                            echo com_make_tag_input($a_act, $txt_contract_kojyo_unit_p22, "txt_contract_kojyo_unit_p22", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">残業単価</td>
                <td colspan="4" style="background-color: <?php echo $color_payment_middle_overtime_unit_price_1; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_zangyo_unit_p12;
                        } else {
                            echo com_make_tag_input($a_act, $txt_contract_zangyo_unit_p12, "txt_contract_zangyo_unit_p12", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
                <td colspan="4" style="background-color: <?php echo $color_payment_middle_overtime_unit_price_2; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_zangyo_unit_p22;
                        } else {
                            echo com_make_tag_input($a_act, $txt_contract_zangyo_unit_p22, "txt_contract_zangyo_unit_p22", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td rowspan="9" width=4 class="Length gray" height=120>途中退場</td>
                <td colspan="2" class="gray">就業日数</td>
                <td colspan="4" style="background-color: <?php echo $color_payment_leaving_employment_day_1; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_syugyonisu_p13;
                        } else {
                            echo com_make_tag_input($a_act, $txt_syugyonisu_p13, "txt_syugyonisu_p13", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
                <td colspan="4" style="background-color: <?php echo $color_payment_leaving_employment_day_2; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_syugyonisu_p23;
                        } else {
                            echo com_make_tag_input($a_act, $txt_syugyonisu_p23, "txt_syugyonisu_p23", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">全営業日数</td>
                <td colspan="4" style="background-color: <?php echo $color_payment_leaving_allbusiness_day_1; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_zeneigyonisu_p13;
                        } else {
                            echo com_make_tag_input($a_act, $txt_zeneigyonisu_p13, "txt_zeneigyonisu_p13", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
                <td colspan="4" style="background-color: <?php echo $color_payment_leaving_allbusiness_day_2; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_zeneigyonisu_p23;
                        } else {
                            echo com_make_tag_input($a_act, $txt_zeneigyonisu_p23, "txt_zeneigyonisu_p23", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">計算方法</td>
                <td colspan="4" style="background-color: <?php echo $color_payment_leaving_calculation_1; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_calc_p13;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_calc_p13, "opt_contract_calc_p13", $GLOBALS['g_DB_m_contract_calc'], "width: 110px;", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="4" style="background-color: <?php echo $color_payment_leaving_calculation_2; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_calc_p23;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_calc_p23, "opt_contract_calc_p23", $GLOBALS['g_DB_m_contract_calc'], "width: 110px;", $a_selected);
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">単金</td>
                <td colspan="4" style="background-color: <?php echo $color_payment_leaving_unit_price_1; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_tankin_p13;
                        } else {
                            echo com_make_tag_input($a_act, $txt_tankin_p13, "txt_tankin_p13", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
                <td colspan="4" style="background-color: <?php echo $color_payment_leaving_unit_price_2; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_tankin_p23;
                        } else {
                            echo com_make_tag_input($a_act, $txt_tankin_p23, "txt_tankin_p23", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">ﾍﾞｰｽ単金</td>
                <td colspan="4" style="background-color: <?php echo $color_payment_leaving_unit_price_1_base; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $payment_leaving_unit_price_1_base;
                        } else {
                    ?>
                    <input type="text" id="payment_leaving_unit_price_1_base" readonly="true" value="<?php echo $payment_leaving_unit_price_1_base; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
                <td colspan="4" style="background-color: <?php echo $color_payment_leaving_unit_price_2_base; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $payment_leaving_unit_price_2_base;
                        } else {
                    ?>
                    <input type="text" id="payment_leaving_unit_price_2_base" readonly="true" value="<?php echo $payment_leaving_unit_price_2_base; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">下限時間</td>
                <td colspan="4" style="background-color: <?php echo $color_payment_leaving_lower_limit_1; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_lower_limit_p13;
                        } else {
                            echo com_make_tag_input($a_act, $txt_contract_lower_limit_p13, "txt_contract_lower_limit_p13", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
                <td colspan="4" style="background-color: <?php echo $color_payment_leaving_lower_limit_2; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_lower_limit_p23;
                        } else {
                            echo com_make_tag_input($a_act, $txt_contract_lower_limit_p23, "txt_contract_lower_limit_p23", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">上限時間</td>
                <td colspan="4" style="background-color: <?php echo $color_payment_leaving_upper_limit_1; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_upper_limit_p13;
                        } else {
                            echo com_make_tag_input($a_act, $txt_contract_upper_limit_p13, "txt_contract_upper_limit_p13", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
                <td colspan="4" style="background-color: <?php echo $color_payment_leaving_upper_limit_2; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_upper_limit_p23;
                        } else {
                            echo com_make_tag_input($a_act, $txt_contract_upper_limit_p23, "txt_contract_upper_limit_p23", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">控除単価</td>
                <td colspan="4" style="background-color: <?php echo $color_payment_leaving_deduction_unit_price_1; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_kojyo_unit_p13;
                        } else {
                            echo com_make_tag_input($a_act, $txt_contract_kojyo_unit_p13, "txt_contract_kojyo_unit_p13", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
                <td colspan="4" style="background-color: <?php echo $color_payment_leaving_deduction_unit_price_2; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_kojyo_unit_p23;
                        } else {
                            echo com_make_tag_input($a_act, $txt_contract_kojyo_unit_p23, "txt_contract_kojyo_unit_p23", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">残業単価</td>
                <td colspan="4" style="background-color: <?php echo $color_payment_leaving_overtime_unit_price_1; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_zangyo_unit_p13;
                        } else {
                            echo com_make_tag_input($a_act, $txt_contract_zangyo_unit_p13, "txt_contract_zangyo_unit_p13", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
                <td colspan="4" style="background-color: <?php echo $color_payment_leaving_overtime_unit_price_2; ?>">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_zangyo_unit_p23;
                        } else {
                            echo com_make_tag_input($a_act, $txt_contract_zangyo_unit_p23, "txt_contract_zangyo_unit_p23", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
        </table>
          <br>
  <!-- 右4番目のテーブル -->
        <table border="1" rules="all" width=340 height=60>
            <tr>
                <td colspan="5" class="yellow" height=15 nowrap="true">時間刻み</td>
                <td colspan="2" class="yellow" nowrap="true">日次</td>
                <td colspan="1" style="background-color: <?php echo $color_payment_hourly_daily; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $opt_m_contract_time_inc_pd;
                        }else{
                            echo com_make_tag_option($a_act, $opt_m_contract_time_inc_pd, "opt_m_contract_time_inc_pd", $GLOBALS['g_DB_m_contract_time_inc'], "width: 50px;", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="3" class="yellow" nowrap="true">月次</td>
                <td colspan="1" style="background-color: <?php echo $color_payment_hourly_monthly; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $opt_m_contract_time_inc_pm;
                        }else{
                            echo com_make_tag_option($a_act, $opt_m_contract_time_inc_pm, "opt_m_contract_time_inc_pm", $GLOBALS['g_DB_m_contract_time_inc'], "width: 90px;", $a_selected);
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="5" class="yellow" height=15>決済</td>
                <td colspan="2" class="yellow">締め</td>
                <td colspan="1" style="background-color: <?php echo $color_payment_settlement_closingday; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_tighten_p;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_tighten_p, "opt_contract_tighten_p", $GLOBALS['g_DB_m_contract_tighten'], "", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="3" class="yellow">支払日</td>
                <td colspan="1" style="background-color: <?php echo $color_payment_settlement_paymentday; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_pay_pay;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_pay_pay, "opt_contract_pay_pay", $GLOBALS['g_DB_m_contract_pay_pay'], "width: 90px;", $a_selected);
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="7" class="yellow" height=15><font size="-2" nowrap="true">欠勤控除対象者</font></td>
                <td colspan="1" style="background-color: <?php echo $color_payment_absence_deduction_subject; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_yesno_p1;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_yesno_p1, "opt_contract_yesno_p1", $GLOBALS['g_DB_m_contract_absence_deduction'], "", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="3" class="yellow" nowrap="true">見積書</td>
                <td colspan="1" style="background-color: <?php echo $color_payment_quotation; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_yesno_p2;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_yesno_p2, "opt_contract_yesno_p2", $GLOBALS['g_DB_m_contract_yesno'], "", $a_selected);
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="7" class="yellow" height=15>注文書</td>
                <td colspan="1" style="background-color: <?php echo $color_payment_purchase_order; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_yesno_p3;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_yesno_p3, "opt_contract_yesno_p3", $GLOBALS['g_DB_m_contract_yesno'], "", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="3" class="yellow"><font size="-2" nowrap="true">注文請書</font></td>
                <td colspan="1" style="background-color: <?php echo $color_payment_confirmation_order; ?>">
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_yesno_p4;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_yesno_p4, "opt_contract_yesno_p4", $GLOBALS['g_DB_m_contract_yesno'], "", $a_selected);
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="12">管理本部</td>
            </tr>
            <tr>
                <td colspan="12" style="background-color: <?php echo $color_cnf_person; ?>"><?php echo $cnf_person; ?></td>
            </tr>
        </table>
    </li>
</ul>
<br>
<!--
<ul class="" style="list-style:none;">
    <li class="myli">
-->
        <!-- table border="1" rules="all" style="width:740px;" -->
        <table border="1" rules="all" class="notice">
        <!-- table border="1" rules="all" style="min-width:340px; max-width:760px" -->
	<tr>
            <td class="yellow" style="width:60px;">抵触日</td>
            <td class="yellow" style="width:60px;" nowrap="true">組織単位</td>
            <td class="" style="background-color: <?php echo $color_contact_date_org; ?>">
            <!-- td style="width:auto;" -->
            <?php
                if ($a_act == '') {
                    echo $contact_date_org;
                } else {
                    echo com_make_tag_input($a_act, $contact_date_org, "contact_date_org", "width: 90%; text-align: center;");
                }
            ?>
            </td>
	</tr>
	<tr>
            <td rowspan="18" class="yellow" nowrap="true">派遣契約に<br>関する通知</td>
            <td rowspan="8" class="yellow" nowrap="true">就業場所</td>
            <td class="yellow">名称・部署</td>
	</tr>
	<tr>
            <td class="" style="background-color: <?php echo $color_dd_name; ?>">
                <?php
                    if ($a_act == '') {
                        echo $dd_name;
                    } else {
                        echo com_make_tag_input($a_act, $dd_name, "dd_name", "width: 43%; text-align: center;");
                    }
                ?>
                ・
                <?php
                    if ($a_act == '') {
                        echo $dd_branch;
                    } else {
                        echo com_make_tag_input($a_act, $dd_branch, "dd_branch", "width: 43%; text-align: center;");
                    }
                ?>
            </td>
	</tr>
	<tr>
            <td class="yellow" nowrap="true">組織単位</td>
	</tr>
	<tr>
            <td class="" style="background-color: <?php echo $color_organization; ?>">
                <?php
                    if ($a_act == '') {
                        echo $organization;
                    } else {
                        echo com_make_tag_input($a_act, $organization, "organization", "width: 90%; text-align: center;");
                    }
                ?>
            </td>
	</tr>
	<tr>
            <td colspan="4" class="yellow" nowrap="true">所在地</td>
	</tr>
	<tr>
            <td class="" style="background-color: <?php echo $color_dd_address; ?>">
                <?php
                    if ($a_act == '') {
                        echo $dd_address;
                    } else {
                        echo com_make_tag_input($a_act, $dd_address, "dd_address", "width: 90%; text-align: center;");
                    }
                ?>
            </td>
	</tr>
	<tr>
            <td colspan="4" class="yellow" nowrap="true">電話番号</td>
	</tr>
	<tr>
            <td class="" style="background-color: <?php echo $color_dd_tel; ?>">
                <?php
                    if ($a_act == '') {
                        echo $dd_tel;
                    } else {
                        echo com_make_tag_input($a_act, $dd_tel, "dd_tel", "width: 90%; text-align: center;");
                    }
                ?>
            </td>
	</tr>
	<tr>
            <td rowspan="2" class="yellow" nowrap="true">指揮命令者</td>
            <td class="yellow" nowrap="true">職名・氏名</td>
	</tr>
	<tr>
            <td class="" style="background-color: <?php echo $color_ip_position; ?>">
                <?php
                    if ($a_act == '') {
                        echo $ip_position;
                    } else {
                        echo com_make_tag_input($a_act, $ip_position, "ip_position", "width: 43%; text-align: center;");
                    }
                ?>
                ・
                <?php
                    if ($a_act == '') {
                        echo $ip_name;
                    } else {
                        echo com_make_tag_input($a_act, $ip_name, "ip_name", "width: 43%; text-align: center;");
                    }
                ?>
            </td>
	</tr>
	<tr>
            <td rowspan="2" class="yellow" nowrap="true">派遣先責任者</td>
            <td class="yellow" nowrap="true">職名・氏名・電話番号</td>
	</tr>
	<tr>
            <td class="" style="background-color: <?php echo $color_dd_responsible_position; ?>">
                <?php
                    if ($a_act == '') {
                        echo $dd_responsible_position;
                    } else {
                        echo com_make_tag_input($a_act, $dd_responsible_position, "dd_responsible_position", "width: 27%; text-align: center;");
                    }
                ?>
                ・
                <?php
                    if ($a_act == '') {
                        echo $dd_responsible_name;
                    } else {
                        echo com_make_tag_input($a_act, $dd_responsible_name, "dd_responsible_name", "width: 27%; text-align: center;");
                    }
                ?>
                ・
                <?php
                    if ($a_act == '') {
                        echo $dd_responsible_tel;
                    } else {
                        echo com_make_tag_input($a_act, $dd_responsible_tel, "dd_responsible_tel", "width: 27%; text-align: center;");
                    }
                ?>
            </td>
	</tr>
	<tr>
            <td rowspan="2" class="yellow" nowrap="true">派遣元責任者</td>
            <td class="yellow" nowrap="true">職名・氏名・電話番号</td>
	</tr>
	<tr>
            <td class="" style="background-color: <?php echo $color_dm_responsible_position; ?>">
                <?php
                    if ($a_act == '') {
                        echo $dm_responsible_position;
                    } else {
                        echo com_make_tag_input($a_act, $dm_responsible_position, "dm_responsible_position", "width: 27%; text-align: center;");
                    }
                ?>
                ・
                <?php
                    if ($a_act == '') {
                        echo $dm_responsible_name;
                    } else {
                        echo com_make_tag_input($a_act, $dm_responsible_name, "dm_responsible_name", "width: 27%; text-align: center;");
                    }
                ?>
                ・
                <?php
                    if ($a_act == '') {
                        echo $dm_responsible_tel;
                    } else {
                        echo com_make_tag_input($a_act, $dm_responsible_tel, "dm_responsible_tel", "width: 27%; text-align: center;");
                    }
                ?>
            </td>
	</tr>
	<tr>
            <td rowspan="4" class="yellow" nowrap="true">苦情の処理<br>・申出先(1)</td>
            <td class="yellow" nowrap="true">派遣先：職名・氏名・電話番号</td>
	</tr>
	<tr>
            <td class="" style="background-color: <?php echo $color_chs_position2; ?>">
                <?php
                    if ($a_act == '') {
                        echo $chs_position2;
                    } else {
                        echo com_make_tag_input($a_act, $chs_position2, "chs_position2", "width: 27%; text-align: center;");
                    }
                ?>
                ・
                <?php
                    if ($a_act == '') {
                        echo $chs_name2;
                    } else {
                        echo com_make_tag_input($a_act, $chs_name2, "chs_name2", "width: 27%; text-align: center;");
                    }
                ?>
                ・
                <?php
                    if ($a_act == '') {
                        echo $chs_tel2;
                    } else {
                        echo com_make_tag_input($a_act, $chs_tel2, "chs_tel2", "width: 27%; text-align: center;");
                    }
                ?>
            </td>
	</tr>
	<tr>
            <td class="yellow" nowrap="true">派遣元：職名・氏名・電話番号</td>
	</tr>
	<tr>
            <td class="" style="background-color: <?php echo $color_chs_position1; ?>">
                <?php
                    if ($a_act == '') {
                        echo $chs_position1;
                    } else {
                        echo com_make_tag_input($a_act, $chs_position1, "chs_position1", "width: 27%; text-align: center;");
                    }
                ?>
                ・
                <?php
                    if ($a_act == '') {
                        echo $chs_name1;
                    } else {
                        echo com_make_tag_input($a_act, $chs_name1, "chs_name1", "width: 27%; text-align: center;");
                    }
                ?>
                ・
                <?php
                    if ($a_act == '') {
                        echo $chs_tel1;
                    } else {
                        echo com_make_tag_input($a_act, $chs_tel1, "chs_tel1", "width: 27%; text-align: center;");
                    }
                ?>
            </td>
	</tr>
    </table>
<!--
    </li>
</ui>
-->
<br>
<ul class="myul" style="list-style:none;">
    <li class="myli">
        <table border="1" rules="all" width=340 height=440>
            <tr>
                <td colspan="2" class="yellow" height=440 nowrap>備考<br>(営業)</td>
                <td colspan="10" class="remarks" style="background-color: <?php echo $color_remarks; ?>">
                    <?php
                        if ($a_act == ''){
                            echo "・該当レポートのみの場合<br>";
                            echo com_db_string_format($inp_biko);   #[2017.11.07]
                            echo "・継続する内容<br>";
                            echo com_db_string_format($remarks2);   #[2018.01.18]課題解決管理表No.92
                        }else{
                            echo "・該当レポートのみの場合<br>";
                            echo com_make_tag_textarea($a_act, $inp_biko, "inp_biko", "width: 96%; height: 40%;");
                            echo "・継続する内容<br>";
                            echo com_make_tag_textarea($a_act, $remarks2, "remarks2", "width: 96%; height: 40%;");  #[2018.01.18]課題解決管理表No.92
                        }
                    ?>
                </td>
            </tr>
        </table>
    </li>
    <!-- 右側のテーブル群 -->
    <li class="myli">
        <table border="1" rules="all" width=340 height=440>
            <tr>
                <td colspan="2" class="yellow" height=440 nowrap>備考<br>(管理)</td>
                <td colspan="10" class="remarks" style="background-color: <?php echo $color_remarks_pay; ?>">
                    <?php
                        if ($a_act == ''){
                            echo "・該当レポートのみの場合<br>";
                            echo com_db_string_format($remarks_pay);    #[2017.11.07]
                            echo "・継続する内容<br>";
                            echo com_db_string_format($remarks_pay2);   #[2018.01.18]課題解決管理表No.92
                        }else{
                            echo "・該当レポートのみの場合<br>";
                            echo com_make_tag_textarea($a_act, $remarks_pay, "remarks_pay", "width: 96%; height: 40%;");
                            echo "・継続する内容<br>";
                            echo com_make_tag_textarea($a_act, $remarks_pay2, "remarks_pay2", "width: 96%; height: 40%;");  #[2018.01.18]課題解決管理表No.92
                        }
                    ?>
                </td>
            </tr>
        </table>
    </li>
</ul>
<br>
        <table border="1" rules="all" >
            <tr>
                <td class="yellow">契約作成ステータス</td>
                <td class="">
                    <?php
                        if ($a_act == '') {
                            echo $status_cd;
                        } else {
                            echo com_make_tag_option_contract_status($a_act, $status_cd, "status_cd", $GLOBALS['g_DB_m_contract_status'], "width: 120px;", $a_selected);
                        }
                    ?>
                </td>
            </tr>
        </table>
</center>
<br>
<input type="hidden" id="cr_id" value="<?php echo $cr_id; ?>">
<input type="hidden" id="cr_id_src" value="<?php echo $cr_id_src; ?>">

<p class="c">
<?php if ($a_act == ''){ ?>
<input type="button" value="Excelへ出力" onclick="return excel_out_10102(<?php echo $cr_id; ?>);">
<?php     if ($_SESSION["hal_auth"] <= 0) { ?>
<input type="button" value="契約終了レポート" onclick="location.href='./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10105']; ?>&NO=<?php echo $cr_id; ?>'">
<?php     } ?>
<input type="button" value="見積書" onclick="location.href='./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10107']; ?>&NO=<?php echo $cr_id; ?>'">
<?php } elseif ($a_act == 'n'){ ?>
<input type="button" value="登録" onclick="return regist_contract_report('n');">
<?php } else { ?>
<!-- ↓後でコメントアウトする -->
<!-- 管理部かレポート作成者以外は更新できない　-->
<?php if (($reg_id == $_SESSION['hal_idx']) || ($_SESSION['hal_department_cd'] == 3)){ ?>
<input type="button" value="更新" onclick="return regist_contract_report('e');">
<?php } ?>
<input type="button" value="Excelへ出力" onclick="return excel_out_10102(<?php echo $cr_id; ?>);">
<?php     if ($_SESSION["hal_auth"] <= 0) { ?>
<input type="button" value="契約終了レポート" onclick="location.href='./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10105']; ?>&NO=<?php echo $cr_id; ?>'">
<?php } ?>
<input type="button" value="見積書" onclick="location.href='./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10107']; ?>&NO=<?php echo $cr_id; ?>'">
<!-- ↑後でコメントアウトする -->
<?php } ?>
<input type="button" value="一覧に戻る" onclick="location.href='./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10100']; ?>&DEL=<?php echo $_SESSION['contract_del']; ?>'">
</p>

<center>
<div id="my-result" style="z-index:100; text-align:center; width:auto; color: #ff0000;"></div>
</center>

</form>

</section>

<?php
require_once('./footer.php');
?>

<script src="./js/hal-kanri-10100.js"></script>
<script type="text/javascript">
    make_regist_file_list('my-evidence', '<?php echo $a_act; ?>', '<?php echo $cr_id; ?>');
    make_regist_file_list('my-payroll', '<?php echo $a_act; ?>', '<?php echo $cr_id; ?>');
</script>
