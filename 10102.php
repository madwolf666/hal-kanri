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

require_once('./10100-com.php');

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
}else{
    if ($a_act != 'n'){
        #管理本部かレポート作成者以外は更新不可
        if (($reg_id == $_SESSION['hal_idx']) || ($_SESSION['hal_department_cd'] == 3)){
        }else{
            $a_act = '';
        }
        #echo $status_cd_num;
        #管理本部以外で、かつステータスが「管理承認」の場合は更新不可
        if (($_SESSION['hal_department_cd'] != 3) && ($status_cd_num == 2)){
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

<link rel="stylesheet" href="css/hal-kanri-10102.css">

<section>
    
<h2>契約管理全体</h2>
<h3>契約レポート</h3>

<form action="" method="post">

<center>
<br>
<font size="+1"><FONT color="red" class="yellow">黄色の枠の項目だけ入力してください。</FONT>　<i><B>ＨＡＬ契約レポート</B></i></font>
<ul class="myul" style="list-style:none;">
<!-- 左側のテーブル群 -->
    <li class="myli">
<!-- 左1番目のテーブル -->
        <table border="1" rules="all" width=340 height=105>
            <tr>
                <td colspan="12" class="gray" height=15>請求ｻｲﾄﾞ（売上）</td>
            </tr>
            <tr>
                <td colspan="2" class="yellow" height=15>客先名</td>
                <td colspan="10">
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
                <td colspan="10">
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
                <td colspan="2" class="yellow" height=15>契約形態</td>
                <td colspan="10">
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
                <td colspan="2" class="yellow" height=15>作業場所</td>
                <td colspan="10">
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
                <td colspan="2" class="yellow" height=15>開始</td>
                <td colspan="2">
                    <?php
                        if ($a_act == '') {
                            echo $inp_kaishi1;
                        } else {
                            echo com_make_tag_input($a_act, $inp_kaishi1, "inp_kaishi1", "width: 40px; text-align: center;");
                        }
                    ?>
                </td>
                <td colspan="2" class="yellow">終了</td>
                <td colspan="2">
                    <?php
                        if ($a_act == '') {
                            echo $inp_syuryo1;
                        } else {
                            echo com_make_tag_input($a_act, $inp_syuryo1, "inp_syuryo1", "width: 40px; text-align: center;");
                        }
                    ?>
                </td>
                <td colspan="2" class="gray">作業時間</td>
                <td colspan="2" width="50">
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
                <td colspan="2" class="yellow" height=15>開始</td>
                <td colspan="2">
                    <?php
                        if ($a_act == '') {
                            echo $inp_kaishi2;
                        } else {
                            echo com_make_tag_input($a_act, $inp_kaishi2, "inp_kaishi2", "width: 40px; text-align: center;");
                        }
                    ?>
                </td>
                <td colspan="2" class="yellow">終了</td>
                <td colspan="2">
                    <?php
                        if ($a_act == ''){
                            echo $inp_syuryo2;
                        }else{
                            echo com_make_tag_input($a_act, $inp_syuryo2, "inp_syuryo2", "width: 40px; text-align: center;");
                        }
                    ?>
                </td>
                <td colspan="2" class="gray">休憩時間</td>
                <td colspan="2" width="50">
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
        <table border="1" rules="all" width=340 height=105>
            <tr>
                <td colspan="2" class="yellow" height=15>客先担当部署</td>
                <td colspan="10">
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
                <td colspan="10">
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
                <td colspan="10">
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
                <td colspan="10">
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
                <td colspan="10">
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
                  <td colspan="10">
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
        <table border="1" rules="all" width=340>
            <tr>
                <td colspan="3" class="yellow">日割り時の割合(入場時)</td>
            </tr>
            <tr>
                <td class="gray" style="width: 120px;">自動計算</td>
                <td>
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
                <td>
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
        <table border="1" rules="all" width=340>
            <tr>
                <td colspan="3" class="yellow">日割り時の割合(退場時)</td>
            </tr>
            <tr>
                <td class="gray" style="width: 120px;">自動計算</td>
                <td>
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
                <td>
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
<!-- 左3番目のテーブル -->
        <table border="1" rules="all" width=340 height=330>
            <tr>
                <td rowspan="6" width=6 class="Length yellow" height=90>通常期間</td>
                <td colspan="2" class="yellow">計算方法</td>
                <td colspan="9">
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
                <td colspan="9">
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
                <td colspan="2" class="yellow">下限時間</td>
                <td colspan="9">
                    <?php
                        if ($a_act == ''){
                            echo $contract_lower_limit_b1;
                        }else{
                            echo com_make_tag_option($a_act, $contract_lower_limit_b1, "opt_contract_lower_limit_b1", $GLOBALS['g_DB_m_contract_lower_limit'], "width: 110px;", $a_selected);
                            echo '&nbsp;&nbsp;';
                            //echo '$a_selected:'.$a_selected;
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
                <td colspan="9">
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
                <td colspan="3">
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_trunc_unit_kojyo;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_trunc_unit_kojyo, "opt_contract_trunc_unit_kojyo", $GLOBALS['g_DB_m_contract_trunc_unit'], "", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="3" width="70">
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
                <td colspan="3">
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_trunc_unit_zangyo;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_trunc_unit_zangyo, "opt_contract_trunc_unit_zangyo", $GLOBALS['g_DB_m_contract_trunc_unit'], "", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="3" width="70">
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
                <td rowspan="8" class="Length yellow" height=120>途中入場</td>
                <td colspan="2" class="yellow">就業日数</td>
                <td colspan="9">
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
                <td colspan="9">
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
                <td colspan="9">
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
                <td colspan="9">
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
                <td colspan="2" class="yellow">下限時間</td>
                <td colspan="9">
                    <?php
                        if ($a_act == ''){
                            echo $contract_lower_limit_b2;
                        }else{
                            echo com_make_tag_option($a_act, $contract_lower_limit_b2, "opt_contract_lower_limit_b2", $GLOBALS['g_DB_m_contract_lower_limit'], "width: 110px;", $a_selected);
                            echo '&nbsp;&nbsp;';
                            if ($a_selected == true){
                                $contract_lower_limit_b2 = "";
                            }
                            echo com_make_tag_input($a_act, $contract_lower_limit_b2, "txt_contract_lower_limit_b2", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="yellow">上限時間</td>
                <td colspan="9">
                    <?php
                        if ($a_act == ''){
                            echo $contract_upper_limit_b2;
                        }else{
                            echo com_make_tag_option($a_act, $contract_upper_limit_b2, "opt_contract_upper_limit_b2", $GLOBALS['g_DB_m_contract_upper_limit'], "width: 110px;", $a_selected);
                            echo '&nbsp;&nbsp;';
                            if ($a_selected == true){
                                $contract_upper_limit_b2 = "";
                            }
                            echo com_make_tag_input($a_act, $contract_upper_limit_b2, "txt_contract_upper_limit_b2", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">控除単価</td>
                <td colspan="9">
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
                <td colspan="9">
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
                <td rowspan="8" class="Length yellow" height=120>途中退場</td>
                <td colspan="2" class="yellow">就業日数</td>
                <td colspan="9">
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
                <td colspan="9">
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
                <td colspan="9">
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
                <td colspan="9">
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
                <td colspan="2" class="yellow">下限時間</td>
                <td colspan="9">
                    <?php
                        if ($a_act == ''){
                            echo $contract_lower_limit_b3;
                        }else{
                            echo com_make_tag_option($a_act, $contract_lower_limit_b3, "opt_contract_lower_limit_b3", $GLOBALS['g_DB_m_contract_lower_limit'], "width: 110px;", $a_selected);
                            echo '&nbsp;&nbsp;';
                            if ($a_selected == true){
                                $contract_lower_limit_b3 = "";
                            }
                            echo com_make_tag_input($a_act, $contract_lower_limit_b3, "txt_contract_lower_limit_b3", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="yellow">上限時間</td>
                <td colspan="9">
                    <?php
                        if ($a_act == ''){
                            echo $contract_upper_limit_b3;
                        }else{
                            echo com_make_tag_option($a_act, $contract_upper_limit_b3, "opt_contract_upper_limit_b3", $GLOBALS['g_DB_m_contract_upper_limit'], "width: 110px;", $a_selected);
                            echo '&nbsp;&nbsp;';
                            if ($a_selected == true){
                                $contract_upper_limit_b3 = "";
                            }
                            echo com_make_tag_input($a_act, $contract_upper_limit_b3, "txt_contract_upper_limit_b3", "width: 110px; text-align: center;");
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">控除単価</td>
                <td colspan="9">
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
                <td colspan="9">
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
                <td colspan="2">
                    <?php
                        if ($a_act == ''){
                            echo $opt_m_contract_time_inc_bd;
                        }else{
                            echo com_make_tag_option($a_act, $opt_m_contract_time_inc_bd, "opt_m_contract_time_inc_bd", $GLOBALS['g_DB_m_contract_time_inc'], "width: 50px;", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="2" class="yellow">月次</td>
                <td colspan="2">
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
                <td colspan="2">
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_tighten_b;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_tighten_b, "opt_contract_tighten_b", $GLOBALS['g_DB_m_contract_tighten'], "width: 50px;", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="2" class="yellow"><font size="-1">支払日</font></td>
                <td colspan="2">
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
                <td colspan="4" class="yellow" height=15>派遣個別契約書</td>
                <td colspan="3">
                    <?php
                        if ($a_act == ''){
                            echo $opt_m_contract_yesno_b1;
                        }else{
                            echo com_make_tag_option($a_act, $opt_m_contract_yesno_b1, "opt_m_contract_yesno_b1", $GLOBALS['g_DB_m_contract_yesno'], "width: 50px;", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="2" class="yellow">見積書</td>
                <td colspan="3">
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
                <td colspan="3">
                    <?php
                        if ($a_act == ''){
                            echo $opt_m_contract_yesno_b3;
                        }else{
                            echo com_make_tag_option($a_act, $opt_m_contract_yesno_b3, "opt_m_contract_yesno_b3", $GLOBALS['g_DB_m_contract_yesno'], "width: 50px;", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="2" class="yellow">注文請書</td>
                <td colspan="3">
                    <?php
                        if ($a_act == ''){
                            echo $opt_m_contract_yesno_b4;
                        }else{
                            echo com_make_tag_option($a_act, $opt_m_contract_yesno_b4, "opt_m_contract_yesno_b4", $GLOBALS['g_DB_m_contract_yesno'], "width: 50px;", $a_selected);
                        }
                    ?>
                </td>
            </tr>
        </table>
    </li>
    <br>
<!-- 右側のテーブル群 -->
    <li class="myli">
<!-- 右1番目のテーブル -->
        <table border="1" rules="all" width=340 height=105>
            <tr>
		<td colspan="4" class="yellow" height=15 nowrap="true">新規or継続</td>
                <td colspan="4">
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
                <td colspan="4">
                    <?php
                        if ($a_act == ''){
                            echo $inp_keiyaku_no;
                        }else{
                            echo com_make_tag_input($a_act, $inp_keiyaku_no, "inp_keiyaku_no", "width: 130px; text-align: center;");
                        }
                    ?>
                </td>
                <td colspan="3" rowspan="4">
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
                <td colspan="4">
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
                <td colspan="4">
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
                <td colspan="7">
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
                <td colspan="3" width="100">
                    <?php
                        if ($a_act == '') {
                            echo $txt_engineer_name;
                        } else {
                    ?>
                    <input type="text" id="txt_engineer_name" readonly="true" value="<?php echo $txt_engineer_name; ?>" style="width:90px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
                <td class="gray">ﾌﾘｶﾞﾅ</td>
                <td colspan="3" width="100">
                    <?php
                        if ($a_act == '') {
                            echo $txt_engineer_kana;
                        } else {
                    ?>
                    <input type="text" id="txt_engineer_kana" readonly="true" value="<?php echo $txt_engineer_kana; ?>" style="width:100px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
        </table>
        <br>
  <!-- 右2番目のテーブル -->
        <table border="1" rules="all" width=340 height=105>
            <tr>
		<td colspan="4" class="yellow" height=15 nowrap="true">事業者名</td>
                <td colspan="9">
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
                <td>
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_pay_form;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_pay_form, "opt_contract_pay_form", $GLOBALS['g_DB_m_contract_pay_form'], "", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="2" class="yellow"nowrap="true">事業者名ﾌﾘｶﾞﾅ</td>
                <td colspan="6">
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
                <td colspan="6">
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
                <td colspan="2" width="40">
                    <?php
                        if ($a_act == ''){
                            echo $opt_social_insurance;
                        }else{
                            echo com_make_tag_option($a_act, $opt_social_insurance, "opt_social_insurance", $GLOBALS['g_DB_m_contract_yesno'], "width: 40px;", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="1" class="yellow">源泉徴収</td>
                <td colspan="3" width="40">
                    <?php
                        if ($a_act == ''){
                            echo $opt_tax_withholding;
                        }else{
                            echo com_make_tag_option($a_act, $opt_tax_withholding, "opt_tax_withholding", $GLOBALS['g_DB_m_contract_yesno'], "width: 40px;", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="3" rowspan="3">
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_reduction;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_reduction, "opt_contract_reduction", $GLOBALS['g_DB_m_contract_reduction'], "width: 40px;", $a_selected);
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="gray" height=15 nowrap="true">契約開始日</td>
                <td colspan="6">
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
                <td colspan="6">
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
<!-- 日割り時の割合 -->
        <table border="0" width=340>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </table>
        <table border="0" width=340 height="98">
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        </table>
<!-- 右3番目のテーブル -->
        <table border="1" rules="all" width=340 height=330>
            <tr>
                <td colspan="3" class="gray" height=15><B>支払条件</B></td>
                <td colspan="4" class="gray"><B>①ｴﾝｼﾞﾆｱ還元金額</B></td>
                <td colspan="4" class="gray"><B>②本人名目給与</B></td>
            </tr>
            <tr>
		<td rowspan="6" width=4 class="Length gray" height=90>通常期間</td>
                <td colspan="2" class="gray">計算方法</td>
                <td colspan="4">
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_calc_p11;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_calc_p11, "opt_contract_calc_p11", $GLOBALS['g_DB_m_contract_calc'], "width: 110px;", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="4">
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
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_tankin_p11;
                        } else {
                    ?>
                    <input type="text" id="txt_tankin_p11" readonly="true" value="<?php echo $txt_tankin_p11; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_tankin_p21;
                        } else {
                    ?>
                    <input type="text" id="txt_tankin_p21" readonly="true" value="<?php echo $txt_tankin_p21; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">下限時間</td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_lower_limit_p11;
                        } else {
                    ?>
                    <input type="text" id="txt_contract_lower_limit_p11" readonly="true" value="<?php echo $txt_contract_lower_limit_p11; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_lower_limit_p21;
                        } else {
                    ?>
                    <input type="text" id="txt_contract_lower_limit_p21" readonly="true" value="<?php echo $txt_contract_lower_limit_p21; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">上限時間</td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_upper_limit_p11;
                        } else {
                    ?>
                    <input type="text" id="txt_contract_upper_limit_p11" readonly="true" value="<?php echo $txt_contract_upper_limit_p11; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_upper_limit_p21;
                        } else {
                    ?>
                    <input type="text" id="txt_contract_upper_limit_p21" readonly="true" value="<?php echo $txt_contract_upper_limit_p21; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">控除単価</td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_kojyo_unit_p11;
                        } else {
                    ?>
                    <input type="text" id="txt_contract_kojyo_unit_p11" readonly="true" value="<?php echo $txt_contract_kojyo_unit_p11; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_kojyo_unit_p21;
                        } else {
                    ?>
                    <input type="text" id="txt_contract_kojyo_unit_p21" readonly="true" value="<?php echo $txt_contract_kojyo_unit_p21; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">残業単価</td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_zangyo_unit_p11;
                        } else {
                    ?>
                    <input type="text" id="txt_contract_zangyo_unit_p11" readonly="true" value="<?php echo $txt_contract_zangyo_unit_p11; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_zangyo_unit_p21;
                        } else {
                    ?>
                    <input type="text" id="txt_contract_zangyo_unit_p21" readonly="true" value="<?php echo $txt_contract_zangyo_unit_p21; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td rowspan="8" width=4 class="Length gray" height=120>途中入場</td>
                <td colspan="2" class="gray">就業日数</td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_syugyonisu_p12;
                        } else {
                    ?>
                    <input type="text" id="txt_syugyonisu_p12" readonly="true" value="<?php echo $txt_syugyonisu_p12; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_syugyonisu_p22;
                        } else {
                    ?>
                    <input type="text" id="txt_syugyonisu_p22" readonly="true" value="<?php echo $txt_syugyonisu_p22; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">全営業日数</td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_zeneigyonisu_p12;
                        } else {
                    ?>
                    <input type="text" id="txt_zeneigyonisu_p12" readonly="true" value="<?php echo $txt_zeneigyonisu_p12; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_zeneigyonisu_p22;
                        } else {
                    ?>
                    <input type="text" id="txt_zeneigyonisu_p22" readonly="true" value="<?php echo $txt_zeneigyonisu_p22; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">計算方法</td>
                <td colspan="4">
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_calc_p12;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_calc_p12, "opt_contract_calc_p12", $GLOBALS['g_DB_m_contract_calc'], "width: 110px;", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="4">
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
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_tankin_p12;
                        } else {
                    ?>
                    <input type="text" id="txt_tankin_p12" readonly="true" value="<?php echo $txt_tankin_p12; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_tankin_p22;
                        } else {
                    ?>
                    <input type="text" id="txt_tankin_p22" readonly="true" value="<?php echo $txt_tankin_p22; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
            <td colspan="2" class="gray">下限時間</td>
            <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_lower_limit_p12;
                        } else {
                    ?>
                    <input type="text" id="txt_contract_lower_limit_p12" readonly="true" value="<?php echo $txt_contract_lower_limit_p12; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
            </td>
            <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_lower_limit_p22;
                        } else {
                    ?>
                    <input type="text" id="txt_contract_lower_limit_p22" readonly="true" value="<?php echo $txt_contract_lower_limit_p22; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
            </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">上限時間</td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_upper_limit_p12;
                        } else {
                    ?>
                    <input type="text" id="txt_contract_upper_limit_p12" readonly="true" value="<?php echo $txt_contract_upper_limit_p12; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_upper_limit_p22;
                        } else {
                    ?>
                    <input type="text" id="txt_contract_upper_limit_p22" readonly="true" value="<?php echo $txt_contract_upper_limit_p22; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">控除単価</td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_kojyo_unit_p12;
                        } else {
                    ?>
                    <input type="text" id="txt_contract_kojyo_unit_p12" readonly="true" value="<?php echo $txt_contract_kojyo_unit_p12; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_kojyo_unit_p22;
                        } else {
                    ?>
                    <input type="text" id="txt_contract_kojyo_unit_p22" readonly="true" value="<?php echo $txt_contract_kojyo_unit_p22; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">残業単価</td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_zangyo_unit_p12;
                        } else {
                    ?>
                    <input type="text" id="txt_contract_zangyo_unit_p12" readonly="true" value="<?php echo $txt_contract_zangyo_unit_p12; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_zangyo_unit_p22;
                        } else {
                    ?>
                    <input type="text" id="txt_contract_zangyo_unit_p22" readonly="true" value="<?php echo $txt_contract_zangyo_unit_p22; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td rowspan="8" width=4 class="Length gray" height=120>途中退場</td>
                <td colspan="2" class="gray">就業日数</td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_syugyonisu_p13;
                        } else {
                    ?>
                    <input type="text" id="txt_syugyonisu_p13" readonly="true" value="<?php echo $txt_syugyonisu_p13; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_syugyonisu_p23;
                        } else {
                    ?>
                    <input type="text" id="txt_syugyonisu_p23" readonly="true" value="<?php echo $txt_syugyonisu_p23; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">全営業日数</td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_zeneigyonisu_p13;
                        } else {
                    ?>
                    <input type="text" id="txt_zeneigyonisu_p13" readonly="true" value="<?php echo $txt_zeneigyonisu_p13; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_zeneigyonisu_p23;
                        } else {
                    ?>
                    <input type="text" id="txt_zeneigyonisu_p23" readonly="true" value="<?php echo $txt_zeneigyonisu_p23; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">計算方法</td>
                <td colspan="4">
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_calc_p13;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_calc_p13, "opt_contract_calc_p13", $GLOBALS['g_DB_m_contract_calc'], "width: 110px;", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="4">
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
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_tankin_p13;
                        } else {
                    ?>
                    <input type="text" id="txt_tankin_p13" readonly="true" value="<?php echo $txt_tankin_p13; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_tankin_p23;
                        } else {
                    ?>
                    <input type="text" id="txt_tankin_p23" readonly="true" value="<?php echo $txt_tankin_p23; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">下限時間</td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_lower_limit_p13;
                        } else {
                    ?>
                    <input type="text" id="txt_contract_lower_limit_p13" readonly="true" value="<?php echo $txt_contract_lower_limit_p13; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_lower_limit_p23;
                        } else {
                    ?>
                    <input type="text" id="txt_contract_lower_limit_p23" readonly="true" value="<?php echo $txt_contract_lower_limit_p23; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">上限時間</td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_upper_limit_p13;
                        } else {
                    ?>
                    <input type="text" id="txt_contract_upper_limit_p13" readonly="true" value="<?php echo $txt_contract_upper_limit_p13; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_upper_limit_p23;
                        } else {
                    ?>
                    <input type="text" id="txt_contract_upper_limit_p23" readonly="true" value="<?php echo $txt_contract_upper_limit_p23; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">控除単価</td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_kojyo_unit_p13;
                        } else {
                    ?>
                    <input type="text" id="txt_contract_kojyo_unit_p13" readonly="true" value="<?php echo $txt_contract_kojyo_unit_p13; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_kojyo_unit_p23;
                        } else {
                    ?>
                    <input type="text" id="txt_contract_kojyo_unit_p23" readonly="true" value="<?php echo $txt_contract_kojyo_unit_p23; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="gray">残業単価</td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_zangyo_unit_p13;
                        } else {
                    ?>
                    <input type="text" id="txt_contract_zangyo_unit_p13" readonly="true" value="<?php echo $txt_contract_zangyo_unit_p13; ?>" style="width:110px; text-align: center;">
                    <?php
                        }
                    ?>
                </td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $txt_contract_zangyo_unit_p23;
                        } else {
                    ?>
                    <input type="text" id="txt_contract_zangyo_unit_p23" readonly="true" value="<?php echo $txt_contract_zangyo_unit_p23; ?>" style="width:110px; text-align: center;">
                    <?php
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
                <td colspan="1">
                    <?php
                        if ($a_act == ''){
                            echo $opt_m_contract_time_inc_pd;
                        }else{
                            echo com_make_tag_option($a_act, $opt_m_contract_time_inc_pd, "opt_m_contract_time_inc_pd", $GLOBALS['g_DB_m_contract_time_inc'], "width: 50px;", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="3" class="yellow" nowrap="true">月次</td>
                <td colspan="1">
                    <?php
                        if ($a_act == ''){
                            echo $opt_m_contract_time_inc_pm;
                        }else{
                            echo com_make_tag_option($a_act, $opt_m_contract_time_inc_pm, "opt_m_contract_time_inc_pm", $GLOBALS['g_DB_m_contract_time_inc'], "width: 90px;", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="3">管理<br>本部</td>
            </tr>
            <tr>
                <td colspan="5" class="yellow" height=15>決済</td>
                <td colspan="2" class="yellow">締め</td>
                <td colspan="1">
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_tighten_p;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_tighten_p, "opt_contract_tighten_p", $GLOBALS['g_DB_m_contract_tighten'], "", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="3" class="yellow">支払日</td>
                <td colspan="1">
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_pay_pay;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_pay_pay, "opt_contract_pay_pay", $GLOBALS['g_DB_m_contract_pay_pay'], "width: 90px;", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="3" rowspan="3"><?php echo $cnf_person; ?></td>
            </tr>
            <tr>
                <td colspan="7" class="yellow" height=15><font size="-2" nowrap="true">欠勤控除対象者</font></td>
                <td colspan="1">
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_yesno_p1;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_yesno_p1, "opt_contract_yesno_p1", $GLOBALS['g_DB_m_contract_absence_deduction'], "", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="3" class="yellow" nowrap="true">見積書</td>
                <td colspan="1">
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
                <td colspan="1">
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_yesno_p3;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_yesno_p3, "opt_contract_yesno_p3", $GLOBALS['g_DB_m_contract_yesno'], "", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="3" class="yellow"><font size="-2" nowrap="true">注文請書</font></td>
                <td colspan="1">
                    <?php
                        if ($a_act == ''){
                            echo $opt_contract_yesno_p4;
                        }else{
                            echo com_make_tag_option($a_act, $opt_contract_yesno_p4, "opt_contract_yesno_p4", $GLOBALS['g_DB_m_contract_yesno'], "", $a_selected);
                        }
                    ?>
                </td>
            </tr>
        </table>
    </li>
</ul>
<br>
<!--
<ul class="" style="list-style:none; width:auto;">
    <li class="myli">
-->
        <table border="1" rules="all" style="min-width:340px; max-width:760px">
	<tr>
            <td class="yellow" style="width:60px;">抵触日</td>
            <td class="yellow" style="width:140px;" nowrap="true">組織単位</td>
            <td style="width:auto;">
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
            <td class="">
                <?php
                    if ($a_act == '') {
                        echo $dd_name;
                    } else {
                        echo com_make_tag_input($a_act, $dd_name, "dd_name", "width: 45%; text-align: center;");
                    }
                ?>
                ・
                <?php
                    if ($a_act == '') {
                        echo $dd_branch;
                    } else {
                        echo com_make_tag_input($a_act, $dd_branch, "dd_branch", "width: 45%; text-align: center;");
                    }
                ?>
            </td>
	</tr>
	<tr>
            <td class="yellow" nowrap="true">組織単位</td>
	</tr>
	<tr>
            <td class="">
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
            <td class="">
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
            <td class="">
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
            <td class="">
                <?php
                    if ($a_act == '') {
                        echo $ip_position;
                    } else {
                        echo com_make_tag_input($a_act, $ip_position, "ip_position", "width: 45%; text-align: center;");
                    }
                ?>
                ・
                <?php
                    if ($a_act == '') {
                        echo $ip_name;
                    } else {
                        echo com_make_tag_input($a_act, $ip_name, "ip_name", "width: 45%; text-align: center;");
                    }
                ?>
            </td>
	</tr>
	<tr>
            <td rowspan="2" class="yellow" nowrap="true">派遣先責任者</td>
            <td class="yellow" nowrap="true">職名・氏名</td>
	</tr>
	<tr>
            <td class="">
                <?php
                    if ($a_act == '') {
                        echo $dd_responsible_position;
                    } else {
                        echo com_make_tag_input($a_act, $dd_responsible_position, "dd_responsible_position", "width: 45%; text-align: center;");
                    }
                ?>
                ・
                <?php
                    if ($a_act == '') {
                        echo $dd_responsible_name;
                    } else {
                        echo com_make_tag_input($a_act, $dd_responsible_name, "dd_responsible_name", "width: 45%; text-align: center;");
                    }
                ?>
            </td>
	</tr>
	<tr>
            <td rowspan="2" class="yellow" nowrap="true">派遣元責任者</td>
            <td class="yellow" nowrap="true">職名・氏名</td>
	</tr>
	<tr>
            <td class="hiddencell_r">
                <?php
                    if ($a_act == '') {
                        echo $dm_responsible_position;
                    } else {
                        echo com_make_tag_input($a_act, $dm_responsible_position, "dm_responsible_position", "width: 45%; text-align: center;");
                    }
                ?>
                ・
                <?php
                    if ($a_act == '') {
                        echo $dm_responsible_name;
                    } else {
                        echo com_make_tag_input($a_act, $dm_responsible_name, "dm_responsible_name", "width: 45%; text-align: center;");
                    }
                ?>
            </td>
	</tr>
	<tr>
            <td rowspan="4" class="yellow" nowrap="true">苦情の処理・申出先(1)</td>
            <td class="yellow" nowrap="true">派遣先：職名・氏名</td>
	</tr>
	<tr>
            <td class="hiddencell_r">
                <?php
                    if ($a_act == '') {
                        echo $chs_position2;
                    } else {
                        echo com_make_tag_input($a_act, $chs_position2, "chs_position2", "width: 45%; text-align: center;");
                    }
                ?>
                ・
                <?php
                    if ($a_act == '') {
                        echo $chs_name2;
                    } else {
                        echo com_make_tag_input($a_act, $chs_name2, "chs_name2", "width: 45%; text-align: center;");
                    }
                ?>
            </td>
	</tr>
	<tr>
            <td class="yellow" nowrap="true">派遣元：職名・氏名</td>
	</tr>
	<tr>
            <td class="hiddencell_r">
                <?php
                    if ($a_act == '') {
                        echo $chs_position1;
                    } else {
                        echo com_make_tag_input($a_act, $chs_position1, "chs_position1", "width: 45%; text-align: center;");
                    }
                ?>
                ・
                <?php
                    if ($a_act == '') {
                        echo $chs_name1;
                    } else {
                        echo com_make_tag_input($a_act, $chs_name1, "chs_name1", "width: 45%; text-align: center;");
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
        <table border="1" rules="all" width=340 height=200>
            <tr>
                <td colspan="2" class="yellow" height=200>備考<br>(営業)</td>
                <td colspan="10" class="remarks">
                    <?php
                        if ($a_act == ''){
                            echo $inp_biko;
                        }else{
                            echo com_make_tag_textarea($a_act, $inp_biko, "inp_biko", "width: 96%; height: 96%;");
                        }
                    ?>
                </td>
            </tr>
        </table>
    </li>
    <!-- 右側のテーブル群 -->
    <li class="myli">
        <table border="1" rules="all" width=340 height=200>
            <tr>
                <td colspan="2" class="yellow" height=200>備考<br>(管理)</td>
                <td colspan="10" class="remarks">
                    <?php
                        if ($a_act == ''){
                            echo $remarks_pay;
                        }else{
                            echo com_make_tag_textarea($a_act, $remarks_pay, "remarks_pay", "width: 96%; height: 96%;");
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
<input type="button" value="一覧に戻る" onclick="location.href='./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10100']; ?>'">
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
