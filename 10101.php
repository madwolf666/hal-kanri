<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./header.php');

$a_act = "e";

require_once('./10100-com.php');

$h_selected = false;

#echo "f_send_mail_date1_del=".$_SESSION['f_send_mail_date1_del'];

?>

<link rel="stylesheet" href="./jquery/jquery-ui.css">
<link rel="stylesheet" href="./jquery/jquery.datetimepicker.css">
<script type="text/javascript" src="./jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="./jquery/jquery.ui.datepicker-ja.min.js"></script>
<script type="text/javascript" src="./jquery/jquery.datetimepicker.js"></script>

<link rel="stylesheet" href="css/hal-kanri-common.css">

<section>
    
<h2>契約管理全体<?php if($_SESSION['contract_del'] == 1){echo '(削除済)';} ?></h2>

<form action="index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10100']; ?>&DEL=<?php echo $_SESSION['contract_del']; ?>&EXC=1" method="post">
    <center>
<table class="tbl_list">
<tr>
<td class="td_titlee">エンジニア名</td>
<td>
    <?php
    if ($_SESSION['contract_del'] != 1){
        echo com_make_tag_input($a_act, $f_engineer_name, "f_engineer_name", "width: 260px; text-align: center;");
    }else{
        echo com_make_tag_input($a_act, $f_engineer_name_del, "f_engineer_name_del", "width: 260px; text-align: center;");
    }
    ?>
</td>
<td>&nbsp;</td>
</tr>
<tr>
<td class="td_titlee">エンジニア番号</td>
<td>
    <?php
    if ($_SESSION['contract_del'] != 1){
        echo com_make_tag_input($a_act, $f_engineer_number, "f_engineer_number", "width: 260px; text-align: center;");
    }else{
        echo com_make_tag_input($a_act, $f_engineer_number_del, "f_engineer_number_del", "width: 260px; text-align: center;");
    }
    ?>
</td>
<td>
    <?php
    if ($_SESSION['contract_del'] != 1){
        echo com_make_tag_option_andor("", "f_engineer_number_andor", "f_engineer_number_andor", "", $h_selected);
    }else{
        echo com_make_tag_option_andor("", "f_engineer_number_andor_del", "f_engineer_number_andor_del", "", $h_selected);
    }
    ?>
</td>
</tr>
<tr>
<td class="td_titlee">契約管理番号</td>
<td>
    <?php
    if ($_SESSION['contract_del'] != 1){
        echo com_make_tag_input($a_act, $f_contract_number, "f_contract_number", "width: 260px; text-align: center;");
    }else{
        echo com_make_tag_input($a_act, $f_contract_number_del, "f_contract_number_del", "width: 260px; text-align: center;");
    }
    ?>
</td>
<td>
    <?php
    if ($_SESSION['contract_del'] != 1){
        echo com_make_tag_option_andor("", "f_contract_number_andor", "f_contract_number_andor", "", $h_selected);
    }else{
        echo com_make_tag_option_andor("", "f_contract_number_andor_del", "f_contract_number_andor_del", "", $h_selected);
    }
    ?>
</td>
</tr>
<tr>
<td class="td_titlee">客先名</td>
<td>
    <?php
    if ($_SESSION['contract_del'] != 1){
        echo com_make_tag_input($a_act, $f_customer_name, "f_customer_name", "width: 260px; text-align: center;");
    }else{
        echo com_make_tag_input($a_act, $f_customer_name_del, "f_customer_name_del", "width: 260px; text-align: center;");
    }
    ?>
</td>
<td>
    <?php
    if ($_SESSION['contract_del'] != 1){
        echo com_make_tag_option_andor("", "f_customer_name_andor", "f_customer_name_andor", "", $h_selected);
    }else{
        echo com_make_tag_option_andor("", "f_customer_name_andor_del", "f_customer_name_andor_del", "", $h_selected);
    }
    ?>
</td>
</tr>
<tr>
<td class="td_titlee">開始日</td>
<td>
    <?php
    if ($_SESSION['contract_del'] != 1){
        echo com_make_tag_input($a_act, $f_claim_agreement_start, "f_claim_agreement_start", "width: 260px; text-align: center;");
    }else{
        echo com_make_tag_input($a_act, $f_claim_agreement_start_del, "f_claim_agreement_start_del", "width: 260px; text-align: center;");
    }
    ?>
</td>
<td>
    <?php
    if ($_SESSION['contract_del'] != 1){
        echo com_make_tag_option_andor("", "f_claim_agreement_start_andor", "f_claim_agreement_start_andor", "", $h_selected);
    }else{
        echo com_make_tag_option_andor("", "f_claim_agreement_start_andor_del", "f_claim_agreement_start_andor_del", "", $h_selected);
    }
    ?>
</td>
</tr>
<tr>
<td class="td_titlee">終了日</td>
<td>
    <?php
    if ($_SESSION['contract_del'] != 1){
        echo com_make_tag_input($a_act, $f_claim_agreement_end, "f_claim_agreement_end", "width: 260px; text-align: center;");
    }else{
        echo com_make_tag_input($a_act, $f_claim_agreement_end_del, "f_claim_agreement_end_del", "width: 260px; text-align: center;");
    } 
    ?>
</td>
<td>
    <?php
    if ($_SESSION['contract_del'] != 1){
        echo com_make_tag_option_andor("", "f_claim_agreement_end_andor", "f_claim_agreement_end_andor", "", $h_selected);
    }else{
        echo com_make_tag_option_andor("", "f_claim_agreement_end_andor_del", "f_claim_agreement_end_andor_del", "", $h_selected);
    }
    ?>
</td>
</tr>
<tr>
<td class="td_titlee">契約形態</td>
<td>
    <?php
    if ($_SESSION['contract_del'] != 1){
        echo com_make_tag_option2($a_act, $f_claim_contract_form, "f_claim_contract_form", $GLOBALS['g_DB_m_contract_bill_form'], "width: 260px;", $a_selected);
    }else{
        echo com_make_tag_option2($a_act, $f_claim_contract_form_del, "f_claim_contract_form_del", $GLOBALS['g_DB_m_contract_bill_form'], "width: 260px;", $a_selected);
    }
    ?>
</td>
<td>
    <?php
    if ($_SESSION['contract_del'] != 1){
        echo com_make_tag_option_andor("", "f_claim_contract_form_andor", "f_claim_contract_form_andor", "", $h_selected);
    }else{
        echo com_make_tag_option_andor("", "f_claim_contract_form_andor_del", "f_claim_contract_form_andor_del", "", $h_selected);
    }
    ?>
</td>
</tr>
<tr>
<td class="td_titlee">決済（締）</td>
<td>
    <?php
    if ($_SESSION['contract_del'] != 1){
        echo com_make_tag_option2($a_act, $f_claim_settlement_closingday, "f_claim_settlement_closingday", $GLOBALS['g_DB_m_contract_tighten'], "width: 50px;", $a_selected);
    }else{
        echo com_make_tag_option2($a_act, $f_claim_settlement_closingday_del, "f_claim_settlement_closingday_del", $GLOBALS['g_DB_m_contract_tighten'], "width: 50px;", $a_selected);
    }
    ?>
</td>
<td>
    <?php
    if ($_SESSION['contract_del'] != 1){
        echo com_make_tag_option_andor("", "f_claim_settlement_closingday_andor", "f_claim_settlement_closingday_andor", "", $h_selected);
    }else{
        echo com_make_tag_option_andor("", "f_claim_settlement_closingday_andor_del", "f_claim_settlement_closingday_andor_del", "", $h_selected);
    }
    ?>
</td>
</tr>
<tr>
<td class="td_titlee">決済（支払）</td>
<td>
    <?php
    if ($_SESSION['contract_del'] != 1){
        echo com_make_tag_option2($a_act, $f_claim_settlement_paymentday, "f_claim_settlement_paymentday", $GLOBALS['g_DB_m_contract_bill_pay'], "", $a_selected);
    }else{
        echo com_make_tag_option2($a_act, $f_claim_settlement_paymentday_del, "f_claim_settlement_paymentday_del", $GLOBALS['g_DB_m_contract_bill_pay'], "", $a_selected);
    }
    ?>
</td>
<td>
    <?php
    if ($_SESSION['contract_del'] != 1){
        echo com_make_tag_option_andor("", "f_claim_settlement_paymentday_andor", "f_claim_settlement_paymentday_andor", "", $h_selected);
    }else{
        echo com_make_tag_option_andor("", "f_claim_settlement_paymentday_andor_del", "f_claim_settlement_paymentday_andor_del", "", $h_selected);
    }
    ?>
</td>
</tr>
<tr>
<td class="td_titlee">備考</td>
<td>
    <?php
    if ($_SESSION['contract_del'] != 1){
        echo com_make_tag_input($a_act, $f_remarks, "f_remarks", "width: 260px; text-align: center;");
    }else{
        echo com_make_tag_input($a_act, $f_remarks_del, "f_remarks_del", "width: 260px; text-align: center;");
    }
    ?>
</td>
<td>
    <?php
    if ($_SESSION['contract_del'] != 1){
        echo com_make_tag_option_andor("", "f_remarks_andor", "f_remarks_andor", "", $h_selected);
    }else{
        echo com_make_tag_option_andor("", "f_remarks_andor_del", "f_remarks_andor_del", "", $h_selected);
    }
    ?>
</td>
</tr>
<tr>
<td class="td_titlee">当日配信</td>
<td>
    <?php
    if ($_SESSION['contract_del'] != 1){
        echo com_make_tag_checkbox("", "1", "次契約レポートなし", "f_send_mail_date1", "f_send_mail_date1", "")."<br>";
        echo com_make_tag_checkbox("", "2", "請求書未発行", "f_send_mail_date2", "f_send_mail_date2", "")."<br>";
        echo com_make_tag_checkbox("", "3", "管理差戻し", "f_send_mail_date3", "f_send_mail_date3", "")."<br>";
        echo com_make_tag_checkbox("", "4", "退職日／休職終了日", "f_send_mail_date4", "f_send_mail_date4", "")."<br>";
    }else{
        echo com_make_tag_checkbox("", "1", "次契約レポートなし", "f_send_mail_date1_del", "f_send_mail_date1_del", "")."<br>";
        echo com_make_tag_checkbox("", "2", "請求書未発行", "f_send_mail_date2_del", "f_send_mail_date2_del", "")."<br>";
        echo com_make_tag_checkbox("", "3", "管理差戻し", "f_send_mail_date3_del", "f_send_mail_date3_del", "")."<br>";
        echo com_make_tag_checkbox("", "4", "退職日／休職終了日", "f_send_mail_date4_del", "f_send_mail_date4_del", "")."<br>";
    }
    ?>
</td>
<td>
    <?php
    if ($_SESSION['contract_del'] != 1){
        echo com_make_tag_option_andor("", "f_send_mail_date_andor", "f_send_mail_date_andor", "", $h_selected);
    }else{
        echo com_make_tag_option_andor("", "f_send_mail_date_andor_del", "f_send_mail_date_andor_del", "", $h_selected);
    }
    ?>
</td>
</tr>
</table>
</center>
<br>

<p class="c">
<input type="submit" value="検索実行">
<input type="button" value="一覧に戻る" onclick="location.href='./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10100']; ?>&DEL=<?php echo $_SESSION['contract_del']; ?>'">
</p>

</form>

</section>

<?php
require_once('./footer.php');
?>

<script src="./js/hal-kanri-10100.js"></script>
