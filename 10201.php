<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./header.php');

$a_act = "e";

require_once('./10200-com.php');

?>

<link rel="stylesheet" href="./jquery/jquery-ui.css">
<link rel="stylesheet" href="./jquery/jquery.datetimepicker.css">
<script type="text/javascript" src="./jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="./jquery/jquery.ui.datepicker-ja.min.js"></script>
<script type="text/javascript" src="./jquery/jquery.datetimepicker.js"></script>

<link rel="stylesheet" href="./css/hal-kanri-common.css">

<section>
    
<h2>給与台帳</h2>

<form action="index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10200']; ?>" method="post">
<center>
<table class="tbl_list">
<tr>
<td class="td_titlee">雇用形態</td>
<td>
    <?php
        echo com_make_tag_option2($a_act, $f_payment_contract_form_10200, "f_payment_contract_form_10200", $GLOBALS['g_DB_m_contract_pay_form'], "width: 260px; text-align: center;", $a_selected);
    ?>
</td>
</tr>
<tr>
<td class="td_titlee">氏名</td>
<td>
    <?php
        echo com_make_tag_input($a_act, $f_engineer_name_10200, "f_engineer_name_10200", "width: 260px; text-align: center;");
    ?>
</td>
</tr>
<tr>
<td class="td_titlee">入社日</td>
<td>
    <?php
        echo com_make_tag_input($a_act, $f_date_entering_10200, "f_date_entering_10200", "width: 260px; text-align: center;");
    ?>
</td>
</tr>
<tr>
<td class="td_titlee">退職日</td>
<td>
    <?php
        echo com_make_tag_input($a_act, $f_date_retire_10200, "f_date_retire_10200", "width: 260px; text-align: center;");
    ?>
</td>
</tr>
<tr>
<td class="td_titlee">支給日</td>
<td>
    <?php
        echo com_make_tag_option2($a_act, $f_payment_settlement_paymentday_10200, "f_payment_settlement_paymentday_10200", $GLOBALS['g_DB_m_contract_pay_pay'], "width: 260px; text-align: center;", $a_selected);
    ?>
</td>
</tr>
<tr>
<td class="td_titlee">給与変更日</td>
<td>
    <?php
        echo com_make_tag_input($a_act, $f_date_modify_salary_10200, "f_date_modify_salary_10200", "width: 260px; text-align: center;");
    ?>
</td>
</tr>
<tr>
<td class="td_titlee">給与変更後最初の給与日</td>
<td>
    <?php
        echo com_make_tag_input($a_act, $f_date_first_salary_10200, "f_date_first_salary_10200", "width: 260px; text-align: center;");
    ?>
</td>
</tr>
<tr>
<td class="td_titlee">連絡日</td>
<td>
    <?php
        echo com_make_tag_input($a_act, $f_labor_contact_date_10200, "f_labor_contact_date_10200", "width: 260px; text-align: center;");
    ?>
</td>
</tr>
<tr>
<td class="td_titlee">弥生給与変更済</td>
<td>
    <?php
        echo com_make_tag_input($a_act, $f_labor_yayoi_changed_10200, "f_labor_yayoi_changed_10200", "width: 260px; text-align: center;");
    ?>
</td>
</tr>
<tr>
<td class="td_titlee">備考</td>
<td>
    <?php
        echo com_make_tag_input($a_act, $f_labor_remarks_10200, "f_labor_remarks_10200", "width: 260px; text-align: center;");
    ?>
</td>
</tr>
</table>
</center>
<br>
    
<p class="c">
<input type="submit" value="検索実行">
<input type="button" value="一覧に戻る" onclick="location.href='./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10200']; ?>'">
</p>

</form>

</section>

<?php
require_once('./footer.php');
?>

<script src="./js/hal-kanri-10200.js"></script>
