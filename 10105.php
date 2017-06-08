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

$opt_contarct_replace = "";
$opt_contarct_end_status = "";
$inp_retire_date = "";
$opt_contarct_insurance_crad = "";
$opt_contarct_employ_insurance = "";
$opt_contarct_end_reason1 = "";
$opt_contarct_end_reason2 = "";
$opt_contarct_end_reason3 = "";
$inp_end_reason_detail = "";
$opt_contarct_from_now = "";
$opt_contarct_skill = "";
$opt_contarct_conversation = "";
$opt_contarct_work_attitude = "";
$opt_contarct_personality = "";
$opt_contarct_projects_confirm = "";
$opt_contarct_engineer_list = "";

if (isset($_GET['NO'])) {
    $a_no = $_GET['NO'];
    try{
        //DBからユーザ情報取得
        $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
        $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $a_sql = "SELECT * FROM ".$GLOBALS['g_DB_t_contract_end_report']." WHERE (cr_id=:cr_id);";
        $a_stmt = $a_conn->prepare($a_sql);
        $a_stmt->bindParam(':cr_id', $a_no, PDO::PARAM_STR);
        $a_stmt->execute();

        while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
            $opt_contarct_replace = $a_result['replace_person'];
            $opt_contarct_end_status = $a_result['end_status'];
            $inp_retire_date = str_replace("-", "/", $a_result['retire_date']);
            $opt_contarct_insurance_crad = $a_result['insurance_crad'];
            $opt_contarct_employ_insurance = $a_result['employ_insurance'];
            $opt_contarct_end_reason1 = $a_result['end_reason1'];
            $opt_contarct_end_reason2 = $a_result['end_reason2'];
            $opt_contarct_end_reason3 = $a_result['end_reason3'];
            $inp_end_reason_detail = $a_result['end_reason_detail'];
            $opt_contarct_from_now = $a_result['from_now'];
            $opt_contarct_skill = $a_result['skill'];
            $inp_biko = $a_result['remarks'];
            $opt_contarct_conversation = $a_result['conversation'];
            $opt_contarct_work_attitude = $a_result['work_attitude'];
            $opt_contarct_personality = $a_result['personality'];
            $opt_contarct_projects_confirm = $a_result['projects_confirm'];
            $opt_contarct_engineer_list = $a_result['engineer_list'];
        }
    } catch (PDOException $e){
        echo 'Error:'.$e->getMessage();
        die();
    }
}

$a_selected = false;

?>

<link rel="stylesheet" href="./jquery/jquery-ui.css">
<link rel="stylesheet" href="./jquery/jquery.datetimepicker.css">
<script type="text/javascript" src="./jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="./jquery/jquery.ui.datepicker-ja.min.js"></script>
<script type="text/javascript" src="./jquery/jquery.datetimepicker.js"></script>

<link rel="stylesheet" href="css/hal-kanri-10105.css">

<section>
    
<h2>契約管理全体</h2>
<h3>契約終了レポート</h3>

<form action="index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10100']; ?>" method="post">

<center>
<br><font size="+1"><i><B>ＨＡＬ契約終了レポート</B></i></font>
<ul style="list-style:none;" class="Responsive">
<!-- 左上のテーブル群 -->
    <li class="myli">
        <!-- 左1番目のテーブル -->
        <table border="1" rules="all" width=340 height=105>
            <tr>
                <td colspan="12" width=340 class="gray" height=15>請求ｻｲﾄﾞ</td>
            </tr>
            <tr>
                <td colspan="2" width=60 class="gray" width=100 height=15>客先名</td>
                <td colspan="10" width=280><?php echo $inp_kyakusaki; ?></td>
            </tr>
            <tr>
                <td colspan="2" class="gray" height=15>件名</td>
                <td colspan="10"><?php echo $inp_kenmei; ?></td>
            </tr>
            <tr>
                <td colspan="2" class="gray" height=15>契約形態</td>
                <td colspan="10"><?php echo $opt_contarct_bill_form; ?></td>
            </tr>
            <tr>
                <td colspan="2" class="gray" height=15>作業場所</td>
                <td colspan="10"><?php echo $inp_sagyo_basyo; ?></td>
            </tr>
            <tr>
                <td colspan="2" width=20 class="gray" height=15>開始</td>
                <td colspan="2" width=20><?php echo $inp_kaishi1; ?></td>
                <td colspan="2" width=20 class="gray">終了</td>
                <td colspan="2" width=20><?php echo $inp_syuryo1; ?></td>
                <td colspan="2" width=20 class="gray">作業時間</td>
                <td colspan="2" width=20><?php echo $txt_sagyo_jikan; ?></td>
            </tr>
            <tr>
                <td colspan="2" class="gray" height=15>開始</td>
                <td colspan="2"><?php echo $inp_kaishi2; ?></td>
                <td colspan="2" class="gray">終了</td>
                <td colspan="2"><?php echo $inp_syuryo2 ; ?></td>
                <td colspan="2" class="gray">休憩時間</td>
                <td colspan="2"><?php echo $txt_kyukei_jikan; ?></td>
            </tr>
        </table>
        <br>
        <!-- 左2番目のテーブル -->
        <table border="1" rules="all" width=340 height=105>
            <tr>
                <td colspan="2" width=100 class="gray" width= height=15>客先担当部署</td>
                <td colspan="10"  width=240><?php echo $inp_kyakusaki_busyo; ?></td>
            </tr>
            <tr>
                <td colspan="2" class="gray" height=15>客先担当者名</td>
                <td colspan="10"><?php echo $inp_kyakusaki_tantosya; ?></td>
            </tr>
            <tr>
                <td colspan="2" class="gray" height=15><font size="-2">客先事務担当者名</font></td>
                <td colspan="10"><?php echo $inp_kyakusaki_jimutantosya ; ?></td>
            </tr>
            <tr>
                <td colspan="2" class="gray" height=15>担当者役職</td>
                <td colspan="10"><?php echo $inp_kyakusaki_yakusyoku; ?></td>
            </tr>
            <tr>
                <td colspan="2" class="gray" height=15>連絡先TEL</td>
                <td colspan="10"><?php echo $inp_kyakusaki_tel; ?></td>
            </tr>
            <tr>
                <td colspan="2" class="gray" height=15>契約開始日</td>
                <td colspan="10"><?php echo $inp_kyakusaki_kaishi; ?></td>
            </tr>
            <tr>
                <td colspan="2" class="gray" height=15>契約終了日</td>
                <td colspan="10"><?php echo $inp_kyakusaki_syuryo; ?></td>
            </tr>
        </table>
        <br>
        <!-- 左3番目のテーブル -->
        <table border="1" rules="all" width=340 height=330>
            <tr>
                <td rowspan="6" width=20 class="Length gray" height=120>通常期間</td>
                <td colspan="2" class="gray">計算方法</td>
                <td colspan="9"><?php echo $opt_contract_calc_b1; ?></td>
            </tr>
            <tr>
                <td colspan="2" class="gray">単金</td>
                <td colspan="9"><?php echo com_db_number_format_symbol($inp_tankin_b1); ?></td>
            </tr>
            <tr>
                <td colspan="2" class="gray">下限時間</td>
                <td colspan="9"><?php echo $opt_contract_lower_limit_b1; ?></td>
            </tr>
            <tr>
                <td colspan="2" class="gray">上限時間</td>
                <td colspan="9"><?php echo $opt_contract_upper_limit_b1; ?></td>
            </tr>
            <tr>
                <td colspan="2" class="gray">控除単価</td>
                <td colspan="9"><?php echo com_db_number_format_symbol($txt_contract_kojyo_unit_b1); ?></td>
            </tr>
            <tr>
                <td colspan="2" class="gray">残業単価</td>
                <td colspan="9"><?php echo com_db_number_format_symbol($txt_contract_zangyo_unit_b1); ?></td>
            </tr>
            <tr>
                <td rowspan="8" class="Length gray" height=120>途中退場</td>
                <td colspan="2" class="gray">就業日数</td>
                <td colspan="9"><?php echo $inp_syugyonisu_b3; ?></td>
            </tr>
            <tr>
                <td colspan="2" class="gray">全営業日数</td>
                <td colspan="9"><?php echo $inp_zeneigyonisu_b3; ?></td>
            </tr>
            <tr>
                <td colspan="2" class="gray">計算方法</td>
                <td colspan="9"><?php echo $opt_contract_calc_b3; ?></td>
            </tr>
            <tr>
                <td colspan="2" class="gray">単金</td>
                <td colspan="9"><?php echo com_db_number_format_symbol($txt_tankin_b3); ?></td>
            </tr>
            <tr>
                <td colspan="2" class="gray">下限時間</td>
                <td colspan="9"><?php echo $opt_contract_lower_limit_b3; ?></td>
            </tr>
            <tr>
                <td colspan="2" class="gray">上限時間</td>
                <td colspan="9"><?php echo $opt_contract_upper_limit_b3; ?></td>
            </tr>
            <tr>
                <td colspan="2" class="gray">控除単価</td>
                <td colspan="9"><?php echo com_db_number_format_symbol($txt_contract_kojyo_unit_b3); ?></td>
            </tr>
            <tr>
                <td colspan="2" class="gray">残業単価</td>
                <td colspan="9"><?php echo com_db_number_format_symbol($txt_contract_zangyo_unit_b3); ?></td>
            </tr>
        </table>
        <br>
        <!-- 左4番目のテーブル -->
        <table border="1" rules="all" width=340 height=60>
            <tr>
                <td colspan="4" width=120 class="gray" height=15>時間刻み</td>
                <td colspan="2" width=65 class="gray">日次</td>
                <td colspan="2" width=65><?php echo $opt_m_contract_time_inc_bd; ?></td>
                <td colspan="2" width=65 class="gray">月次</td>
                <td colspan="2" width=65><?php echo $opt_m_contract_time_inc_bm; ?></td>
            </tr>
            <tr>
                <td colspan="4" class="gray" height=15>決済</td>
                <td colspan="2" class="gray">締め</td>
                <td colspan="2"><?php echo $opt_contract_tighten_b; ?></td>
                <td colspan="2" class="gray">支払日</td>
                <td colspan="2"><?php echo $opt_contract_bill_pay; ?></td>
            </tr>
            <tr>
                <td colspan="12" classs="hiddencell_l hiddencell_r" height=15></td>
            </tr>
            <tr>
                <td colspan="4" class="yellow" height=15>交代要員</td>
                <td colspan="8">
                    <?php
                        if ($a_act == '') {
                            echo $opt_contarct_replace;
                        } else {
                            echo com_make_tag_option($a_act, $opt_contarct_replace, "opt_contarct_replace", $GLOBALS['g_DB_m_contract_replace'], "width: 220px;", $a_selected);
                        }
                    ?>
                </td>
            </tr>
        </table>
    </li>
    <br>
    <!-- 右上のテーブル群 -->
    <li class="myli">
        <!-- 右1番目のテーブル -->
        <table border="1" rules="all" width=340 height=105>
            <tr>
                <td colspan="4" width=100 class="yellow" height=15><font size="-2">契約終了状況</font></td>
                <td colspan="4" width=200>
                    <?php
                        if ($a_act == '') {
                            echo $opt_contarct_end_status;
                        } else {
                            echo com_make_tag_option($a_act, $opt_contarct_end_status, "opt_contarct_end_status", $GLOBALS['g_DB_m_contract_end_status'], "width: 120px;", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="3" width=100>担当営業</td>
            </tr>
            <tr>
                <td colspan="4" class="yellow" height=15>退場日</td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $inp_retire_date;
                        } else {
                            echo com_make_tag_input($a_act, $inp_retire_date, "inp_retire_date", "width: 120px; text-align: center;");
                        }
                    ?>
                </td>
                <td colspan="3" rowspan="4">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="4" class="gray" height=15>契約No</td>
                <td colspan="4"><?php echo $inp_keiyaku_no; ?></td>
            </tr>
            <tr>
                <td colspan="4" class="gray" height=15>発行日</td>
                <td colspan="4"><?php echo $inp_hakkobi; ?></td>
            </tr>
            <tr>
                <td colspan="4" class="gray" height=15>作成者</td>
                <td colspan="4"><?php echo $inp_sakuseisya; ?></td>
            </tr>
            <tr>
                <td colspan="4" class="gray" height=15>ｴﾝｼﾞﾆｱNo</td>
                <td colspan="7"><?php echo $inp_engineer_no; ?></td>
            </tr>
            <tr>
                <td colspan="4" class="gray" height=15>ｴﾝｼﾞﾆｱ氏名</td>
                <td colspan="3" width=40><?php echo $txt_engineer_name; ?></td>
                <td colspan="1" width=40 class="gray"><font size="-1">ﾌﾘｶﾞﾅ</font></td>
                <td colspan="3"><?php echo $txt_engineer_kana; ?></td>
            </tr>
        </table>
        <br>
        <!-- 右2番目のテーブル -->
        <table border="1" rules="all" width=340 height=105>
            <tr>
                <td colspan="13" class="gray" height=15>支払サイド</td>
            </tr>
            <tr>
                <td colspan="4" class="gray" height=15>事業者名</td>
                <td colspan="9"><?php echo $txt_jigyosya_name; ?></td>
            </tr>
            <tr>
                <td colspan="4"class="gray" height=15>契約形態</td>
                <td colspan="1" width=40><?php echo $opt_contract_pay_form; ?></td>
                <td colspan="3" width=80>事業者ﾌﾘｶﾞﾅ</td>
                <td colspan="5" width=120><?php echo $txt_jigyosya_kana; ?></td>
            </tr>
            <tr>
                <td colspan="4" width=100 class="gray" height=15 nowrap><font size="-2">事業者担当者名</font></td>
                <td colspan="6" width=140><?php echo $inp_jigyosya_tanto; ?></td>
                <td colspan="3" width=100>還元率</td>
            </tr>
            <tr>
                <td colspan="1" width=65 class="gray" height=15><font size="-2">社会保険</font></td>
                <td colspan="4" width=65><?php echo $opt_social_insurance; ?></td>
                <td colspan="1" width=65><font size="-2">源泉徴収</font></td>
                <td colspan="4" width=65><?php echo $opt_tax_withholding; ?></td>
                <td colspan="3" rowspan="3"><?php echo $opt_contract_reduction; ?>%</td>
            </tr>
            <tr>
                <td colspan="4" class="gray" height=15>契約開始日</td>
                <td colspan="6"><?php echo $txt_kyakusaki_kaishi; ?></td>
            </tr>
            <tr>
                <td colspan="4" width=100 class="gray" height=15>契約終了日</td>
                <td colspan="6" width=140><?php echo $txt_kyakusaki_syuryo; ?></td>
            </tr>
        </table>
        <br>
        <!-- 右3番目のテーブル -->
        <table border="1" rules="all" width=340 height=330>
            <tr>
                <td rowspan="6" width=20 class="Length gray" height=115>通常期間</td>
                <td colspan="2" class="gray">計算方法</td>
                <td colspan="4"><?php echo $opt_contract_calc_p11; ?></td>
                <td colspan="4"><?php echo $opt_contract_calc_p21; ?></td>
            </tr>
            <tr>
                <td colspan="2" class="gray">単金</td>
                <td colspan="4"><?php echo com_db_number_format_symbol($txt_tankin_p11); ?></td>
                <td colspan="4"><?php echo com_db_number_format_symbol($txt_tankin_p21); ?></td>
            </tr>
            <tr>
                <td colspan="2" class="gray">下限時間</td>
                <td colspan="4"><?php echo $txt_contract_lower_limit_p11; ?></td>
                <td colspan="4"><?php echo $txt_contract_lower_limit_p21; ?></td>
            </tr>
            <tr>
                <td colspan="2" class="gray">上限時間</td>
                <td colspan="4"><?php echo $txt_contract_upper_limit_p11; ?></td>
                <td colspan="4"><?php echo $txt_contract_upper_limit_p21; ?></td>

            </tr>
            <tr>
                <td colspan="2" class="gray">控除単価</td>
                <td colspan="4"><?php echo com_db_number_format_symbol($txt_contract_kojyo_unit_p11); ?></td>
                <td colspan="4"><?php echo com_db_number_format_symbol($txt_contract_kojyo_unit_p21); ?></td>
            </tr>
            <tr>
                <td colspan="2" class="gray">残業単価</td>
                <td colspan="4"><?php echo com_db_number_format_symbol($txt_contract_zangyo_unit_p11); ?></td>
                <td colspan="4"><?php echo com_db_number_format_symbol($txt_contract_zangyo_unit_p21); ?></td>
            </tr>
            <tr>
                <td rowspan="8" class="Length gray" height=115>途中退場</td>
                <td colspan="2" class="gray">就業日数</td>
                <td colspan="4"><?php echo $txt_syugyonisu_p13; ?></td>
                <td colspan="4"><?php echo $txt_syugyonisu_p23; ?></td>
            </tr>
            <tr>
                <td colspan="2" class="gray">全営業日数</td>
                <td colspan="4"><?php echo $txt_zeneigyonisu_p13; ?></td>
                <td colspan="4"><?php echo $txt_zeneigyonisu_p23; ?></td>
            </tr>
            <tr>
                <td colspan="2" class="gray">計算方法</td>
                <td colspan="4"><?php echo $opt_contract_calc_p13; ?></td>
                <td colspan="4"><?php echo $opt_contract_calc_p23; ?></td>
            </tr>
            <tr>
                    <td colspan="2" class="gray">単金</td>
                    <td colspan="4"><?php echo com_db_number_format_symbol($txt_tankin_p13); ?></td>
                    <td colspan="4"><?php echo com_db_number_format_symbol($txt_tankin_p23); ?></td>
            </tr>
            <tr>
                <td colspan="2" class="gray">下限時間</td>
                <td colspan="4"><?php echo $txt_contract_lower_limit_p13; ?></td>
                <td colspan="4"><?php echo $txt_contract_lower_limit_p23; ?></td>
            </tr>
            <tr>
                <td colspan="2" class="gray">上限時間</td>
                <td colspan="4"><?php echo $txt_contract_upper_limit_p13; ?></td>
                <td colspan="4"><?php echo $txt_contract_upper_limit_p23; ?></td>
            </tr>
            <tr>
                <td colspan="2" class="gray">控除単価</td>
                <td colspan="4"><?php echo com_db_number_format_symbol($txt_contract_kojyo_unit_p13); ?></td>
                <td colspan="4"><?php echo com_db_number_format_symbol($txt_contract_kojyo_unit_p23); ?></td>
            </tr>
            <tr>
                <td colspan="2" class="gray">残業単価</td>
                <td colspan="4"><?php echo com_db_number_format_symbol($txt_contract_zangyo_unit_p13); ?></td>
                <td colspan="4"><?php echo com_db_number_format_symbol($txt_contract_zangyo_unit_p23); ?></td>
            </tr>
        </table>
        <br>
        <!-- 右4番目のテーブル -->
        <table border="1" rules="all" width=340 height=60>
            <tr>
                <td colspan="5" width=60 class="gray" height=15><font size="-1">時間刻み</font></td>
                <td colspan="2" width=44 class="gray">日次</td>
                <td colspan="1" width=52><?php echo $opt_m_contract_time_inc_pd; ?></td>
                <td colspan="3" width=52 class="gray">月次</td>
                <td colspan="1" width=52><?php echo $opt_m_contract_time_inc_pm; ?></td>
                <td colspan="3" width=80>寺西COO</td>
            </tr>
            <tr>
                <td colspan="5" class="gray" height=15>決済</td>
                <td colspan="2" class="gray">締め</td>
                <td colspan="1"><?php echo $opt_contract_tighten_p; ?></td>
                <td colspan="3" class="gray">支払日</td>
                <td colspan="1"><?php echo $opt_contract_pay_pay; ?></td>
                <td colspan="3" rowspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="12" class="hiddencell_l" height=15></td>
            </tr>
            <tr>
                <td colspan="4" class="yellow" height=15>保険証</td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $opt_contarct_insurance_crad;
                        } else {
                            echo com_make_tag_option($a_act, $opt_contarct_insurance_crad, "opt_contarct_insurance_crad", $GLOBALS['g_DB_m_contract_insurance_crad'], "width: 90px;", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="4">
                    <?php
                        if ($a_act == '') {
                            echo $opt_contarct_employ_insurance;
                        } else {
                            echo com_make_tag_option($a_act, $opt_contarct_employ_insurance, "opt_contarct_employ_insurance", $GLOBALS['g_DB_m_contract_employ_insurance'], "width: 110px;", $a_selected);
                        }
                    ?>
                </td>
            </tr>
        </table>
    </li>
</ul>
<br>
<!-- 真ん中の終了理由欄 -->
<!-- table border="1" rules="all"  height=60 style="width:90%; min-width:340px; max-width:680px;" -->
<table border="1" rules="all"  height=60 style="min-width:340px; max-width:720px;">
    <tr>
        <td colspan="2" width=12% class="yellow" height=15>終了理由</td>
        <td colspan="4" width=26%>
            <?php
                if ($a_act == '') {
                    echo $opt_contarct_end_reason1;
                } else {
                    echo com_make_tag_option($a_act, $opt_contarct_end_reason1, "opt_contarct_end_reason1", $GLOBALS['g_DB_m_contract_end_reason'], "width: 140px;", $a_selected);
                }
            ?>
        </td>
        <td colspan="4" width=26%>
            <?php
                if ($a_act == '') {
                    echo $opt_contarct_end_reason2;
                } else {
                    echo com_make_tag_option($a_act, $opt_contarct_end_reason2, "opt_contarct_end_reason2", $GLOBALS['g_DB_m_contract_end_reason'], "width: 140px;", $a_selected);
                }
            ?>
        </td>
        <td colspan="4" width=26%>
            <?php
                if ($a_act == '') {
                    echo $opt_contarct_end_reason3;
                } else {
                    echo com_make_tag_option($a_act, $opt_contarct_end_reason3, "opt_contarct_end_reason3", $GLOBALS['g_DB_m_contract_end_reason'], "width: 140px;", $a_selected);
                }
            ?>
        </td>
    </tr>
	<tr>
            <td colspan="1" width=3% class="yellow" height=15>終了理由詳細</td>
            <td colspan="13"width=87% height=300>
                    <?php
                        if ($a_act == ''){
                            echo $inp_end_reason_detail;
                        }else{
                            echo com_make_tag_textarea($a_act, $inp_end_reason_detail, "inp_end_reason_detail", "width: 96%; height: 96%;");
                        }
                    ?>
            </td>
        </tr>

</table>
<br>
<!-- 右下のテーブル群 -->
<ul style="list-style:none;" class="Responsive">
    <li class="myli">
        <!-- 右下1番目のテーブル -->
        <table border="1" rules="all" width=340 height=15>
            <tr>
                    <td colspan="4" width=80 class="yellow" height=15>今後の<br>対応</td>
                    <td colspan="4" width=80>
                        <?php
                            if ($a_act == '') {
                                echo $opt_contarct_from_now;
                            } else {
                                echo com_make_tag_option($a_act, $opt_contarct_from_now, "opt_contarct_from_now", $GLOBALS['g_DB_m_contract_from_now'], "width: 100px;", $a_selected);
                            }
                        ?>
                    </td>
                    <td colspan="2" width=20 class="hiddencell_TB">&nbsp;</td>
                    <td colspan="4" width=80 class="yellow" height=15>スキル</td>
                    <td colspan="4" width=80>
                        <?php
                            if ($a_act == '') {
                                echo $opt_contarct_skill;
                            } else {
                                echo com_make_tag_option($a_act, $opt_contarct_skill, "opt_contarct_skill", $GLOBALS['g_DB_m_contract_skill'], "width: 100px;", $a_selected);
                            }
                        ?>
                    </td>
            </tr>
        </table>
        <br>
        <!-- 右下2番目のテーブル -->
        <table border="1" rules="all" width=340 height=230>
            <tr>
                <td colspan="2" width=40 class="yellow" height=230>備考</td>
                <td colspan="10" width=300 class="remarks">
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
        <br>
    </li>
    <!-- 左下のテーブル群 -->
    <li class="myli">
        <!-- 左下1番目のテーブル -->
        <table border="1" rules="all" width=340 height=15>
            <tr>
                <td colspan="4" width=68 class="yellow" height=15>人物</td>
                <td colspan="4" width=68>
                    <?php
                        if ($a_act == '') {
                            echo $opt_contarct_conversation;
                        } else {
                            echo com_make_tag_option($a_act, $opt_contarct_conversation, "opt_contarct_conversation", $GLOBALS['g_DB_m_contract_conversation'], "width: 110px;", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="4" width=68>
                    <?php
                        if ($a_act == '') {
                            echo $opt_contarct_work_attitude;
                        } else {
                            echo com_make_tag_option($a_act, $opt_contarct_work_attitude, "opt_contarct_work_attitude", $GLOBALS['g_DB_m_contract_work_attitude'], "width: 110px;", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="4" width=68>
                    <?php
                        if ($a_act == '') {
                            echo $opt_contarct_personality;
                        } else {
                            echo com_make_tag_option($a_act, $opt_contarct_personality, "opt_contarct_personality", $GLOBALS['g_DB_m_contract_personality'], "width: 110px;", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="4" width=68>&nbsp;</td>
            </tr>
        </table>
        <br>
        <!-- 左下2番目のテーブル -->
        <table border="1" rules="all" width=340 height=200>
            <tr>
                <td colspan="3" height=19 width=68 class="yellow"><font size="-2">他社決定時の<br>案件内容確認</font></td>
                <td colspan="3" width=68>
                    <?php
                        if ($a_act == '') {
                            echo $opt_contarct_projects_confirm;
                        } else {
                            echo com_make_tag_option($a_act, $opt_contarct_projects_confirm, "opt_contarct_projects_confirm", $GLOBALS['g_DB_m_contract_projects_confirm'], "width: 100px;", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="3" width=68 class="yellow"><font size="-2">新ＨＡＬ<br>ｴﾝｼﾞﾆｱﾘｽﾄ更新</font></td>
                <td colspan="3" width=68>
                    <?php
                        if ($a_act == '') {
                            echo $opt_contarct_engineer_list;
                        } else {
                            echo com_make_tag_option($a_act, $opt_contarct_engineer_list, "opt_contarct_engineer_list", $GLOBALS['g_DB_m_contract_engineer_list'], "width: 100px;", $a_selected);
                        }
                    ?>
                </td>
                <td colspan="3" width=68></td>
            </tr>
        </table>
    </li>
</ul>
</center>  

<input type="hidden" id="cr_id" value="<?php echo $cr_id; ?>">

<p class="c">
<?php if ($a_act == ''){ ?>
<input type="button" value="Excelへ出力" onclick="return excel_out_10105(<?php echo $cr_id; ?>);">
<?php } elseif ($a_act == 'n'){ ?>
<input type="submit" value="登録">
<?php } else { ?>
<!-- ↓後でコメントアウトする -->
<input type="button" value="更新" onclick="return regist_contract_end_report('e',<?php echo $cr_id; ?>);">
<input type="button" value="Excelへ出力" onclick="return excel_out_10105(<?php echo $cr_id; ?>);">
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
