<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./header.php');

$a_act = "e";

require_once('./10300-com.php');

?>

<link rel="stylesheet" href="./jquery/jquery-ui.css">
<link rel="stylesheet" href="./jquery/jquery.datetimepicker.css">
<script type="text/javascript" src="./jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="./jquery/jquery.ui.datepicker-ja.min.js"></script>
<script type="text/javascript" src="./jquery/jquery.datetimepicker.js"></script>

<link rel="stylesheet" href="./css/hal-kanri-common.css">

<section>
    
<h2>検収台帳</h2>

<form action="index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10300']; ?>" method="post">
<center>
<table class="tbl_list">
<tr>
<td class="td_titlee">契約管理No.</td>
<td>
    <?php
        echo com_make_tag_input($a_act, $f_contract_number_10300, "f_contract_number_10300", "width: 260px; text-align: center;");
    ?>
</td>
<td>&nbsp;</td>
</tr>
<tr>
<td class="td_titlee">HAL No.</td>
<td>
    <?php
        echo com_make_tag_input($a_act, $f_engineer_number_10300, "f_engineer_number_10300", "width: 260px; text-align: center;");
    ?>
</td>
<td><?php echo com_make_tag_option_andor("", "f_engineer_number_10300_andor", "f_engineer_number_10300_andor", "", $h_selected); ?></td>
</tr>
<tr>
<td class="td_titlee">エンジニア氏名</td>
<td>
    <?php
        echo com_make_tag_input($a_act, $f_engineer_name_10300, "f_engineer_name_10300", "width: 260px; text-align: center;");
    ?>
</td>
<td><?php echo com_make_tag_option_andor("", "f_engineer_name_10300_andor", "f_engineer_name_10300_andor", "", $h_selected); ?></td>
</tr>
<tr>
<td class="td_titlee">得意先</td>
<td>
    <?php
        echo com_make_tag_input($a_act, $f_customer_name_10300, "f_customer_name_10300", "width: 260px; text-align: center;");
    ?>
</td>
<td><?php echo com_make_tag_option_andor("", "f_customer_name_10300_andor", "f_customer_name_10300_andor", "", $h_selected); ?></td>
</tr>
<tr>
<td class="td_titlee">契約形態（受注サイド）</td>
<td>
    <?php
        echo com_make_tag_option2($a_act, $f_claim_contract_form_10300, "f_claim_contract_form_10300", $GLOBALS['g_DB_m_contract_bill_form'], "width: 260px;", $a_selected);
    ?>
</td>
<td><?php echo com_make_tag_option_andor("", "f_claim_contract_form_10300_andor", "f_claim_contract_form_10300_andor", "", $h_selected); ?></td>
</tr>
<tr>
<td class="td_titlee">注文書/契約書No.</td>
<td>
    <?php
        echo com_make_tag_input($a_act, $f_ag_no_10300, "f_ag_no_10300", "width: 260px; text-align: center;");
    ?>
</td>
<td><?php echo com_make_tag_option_andor("", "f_ag_no_10300_andor", "f_ag_no_10300_andor", "", $h_selected); ?></td>
</tr>
<tr>
<td class="td_titlee">売上日</td>
<td>
    <?php
        echo com_make_tag_input($a_act, $f_accounts_bai_previous_day_10300, "f_accounts_bai_previous_day_10300", "width: 260px; text-align: center;");
    ?>
</td>
<td><?php echo com_make_tag_option_andor("", "f_accounts_bai_previous_day_10300_andor", "f_accounts_bai_previous_day_10300_andor", "", $h_selected); ?></td>
</tr>
<tr>
<td class="td_titlee">実働時間</td>
<td>
    <?php
        echo com_make_tag_input($a_act, $f_accounts_actual_working_hours_10300, "f_accounts_actual_working_hours_10300", "width: 260px; text-align: center;");
    ?>
</td>
<td><?php echo com_make_tag_option_andor("", "f_accounts_actual_working_hours_10300_andor", "f_accounts_actual_working_hours_10300_andor", "", $h_selected); ?></td>
</tr>
<tr>
<td class="td_titlee">諸経費</td>
<td>
    <?php
        echo com_make_tag_input($a_act, $f_accounts_expenses_10300, "f_accounts_expenses_10300", "width: 260px; text-align: center;");
    ?>
</td>
<td><?php echo com_make_tag_option_andor("", "f_accounts_expenses_10300_andor", "f_accounts_expenses_10300_andor", "", $h_selected); ?></td>
</tr>
<tr>
<td class="td_titlee">契約形態（発注サイド）</td>
<td>
    <?php
        echo com_make_tag_option2($a_act, $f_payment_contract_form_10300, "f_payment_contract_form_10300", $GLOBALS['g_DB_m_contract_pay_form'], "width: 260px; text-align: center;", $a_selected);
    ?>
</td>
<td><?php echo com_make_tag_option_andor("", "f_payment_contract_form_10300_andor", "f_payment_contract_form_10300_andor", "", $h_selected); ?></td>
</tr>
<tr>
<td class="td_titlee">検収日</td>
<td>
    <?php
        echo com_make_tag_input($a_act, $f_payment_acceptance_date_10300, "f_payment_acceptance_date_10300", "width: 260px; text-align: center;");
    ?>
</td>
<td><?php echo com_make_tag_option_andor("", "f_payment_acceptance_date_10300_andor", "f_payment_acceptance_date_10300_andor", "", $h_selected); ?></td>
</tr>
<tr>
<td class="td_titlee">支払日</td>
<td>
    <?php
        echo com_make_tag_option2($a_act, $f_payment_settlement_paymentday_10300, "f_payment_settlement_paymentday_10300", $GLOBALS['g_DB_m_contract_pay_pay'], "", $a_selected);
    ?>
</td>
<td><?php echo com_make_tag_option_andor("", "f_payment_settlement_paymentday_10300_andor", "f_payment_settlement_paymentday_10300_andor", "", $h_selected); ?></td>
</tr>
</table>
</center>
<br>

<p class="c">
<input type="submit" value="検索実行">
<input type="button" value="一覧に戻る" onclick="location.href='./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10300']; ?>'">
</p>

</form>

</section>

<?php
require_once('./footer.php');
?>

<script src="./js/hal-kanri-10300.js"></script>
