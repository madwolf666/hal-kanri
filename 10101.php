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

?>

<link rel="stylesheet" href="./jquery/jquery-ui.css">
<link rel="stylesheet" href="./jquery/jquery.datetimepicker.css">
<script type="text/javascript" src="./jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="./jquery/jquery.ui.datepicker-ja.min.js"></script>
<script type="text/javascript" src="./jquery/jquery.datetimepicker.js"></script>

<link rel="stylesheet" href="css/hal-kanri-common.css">

<section>
    
<h2>契約管理全体</h2>

<form action="index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10100']; ?>" method="post">
    <center>
<table class="tbl_list">
<tr>
<td class="td_titlee">エンジニア名</td>
<td>
    <?php
        echo com_make_tag_input($a_act, $f_engineer_name, "f_engineer_name", "width: 260px; text-align: center;");
    ?>
</td>
<td>&nbsp;</td>
</tr>
<tr>
<td class="td_titlee">エンジニア番号</td>
<td>
    <?php
        echo com_make_tag_input($a_act, $f_engineer_number, "f_engineer_number", "width: 260px; text-align: center;");
    ?>
</td>
<td><?php echo com_make_tag_option_andor("", "f_engineer_number_andor", "f_engineer_number_andor", "", $h_selected); ?></td>
</tr>
<tr>
<td class="td_titlee">契約管理番号</td>
<td>
    <?php
        echo com_make_tag_input($a_act, $f_contract_number, "f_contract_number", "width: 260px; text-align: center;");
    ?>
</td>
<td><?php echo com_make_tag_option_andor("", "f_contract_number_andor", "f_contract_number_andor", "", $h_selected); ?></td>
</tr>
<tr>
<td class="td_titlee">客先名</td>
<td>
    <?php
        echo com_make_tag_input($a_act, $f_customer_name, "f_customer_name", "width: 260px; text-align: center;");
    ?>
</td>
<td><?php echo com_make_tag_option_andor("", "f_customer_name_andor", "f_customer_name_andor", "", $h_selected); ?></td>
</tr>
<tr>
<td class="td_titlee">開始日</td>
<td>
    <?php
        echo com_make_tag_input($a_act, $f_claim_agreement_start, "f_claim_agreement_start", "width: 260px; text-align: center;");
    ?>
</td>
<td><?php echo com_make_tag_option_andor("", "f_claim_agreement_start_andor", "f_claim_agreement_start_andor", "", $h_selected); ?></td>
</tr>
<tr>
<td class="td_titlee">終了日</td>
<td>
    <?php
        echo com_make_tag_input($a_act, $f_claim_agreement_end, "f_claim_agreement_end", "width: 260px; text-align: center;");
    ?>
</td>
<td><?php echo com_make_tag_option_andor("", "f_claim_agreement_end_andor", "f_claim_agreement_end_andor", "", $h_selected); ?></td>
</tr>
<tr>
<td class="td_titlee">契約形態</td>
<td>
    <?php
        echo com_make_tag_option2($a_act, $f_claim_contract_form, "f_claim_contract_form", $GLOBALS['g_DB_m_contract_bill_form'], "width: 260px;", $a_selected);
    ?>
</td>
<td><?php echo com_make_tag_option_andor("", "f_claim_contract_form_andor", "f_claim_contract_form_andor", "", $h_selected); ?></td>
</tr>
<tr>
<td class="td_titlee">決済（締）</td>
<td>
    <?php
        echo com_make_tag_option2($a_act, $f_claim_settlement_closingday, "f_claim_settlement_closingday", $GLOBALS['g_DB_m_contract_tighten'], "width: 50px;", $a_selected);
    ?>
</td>
<td><?php echo com_make_tag_option_andor("", "f_claim_settlement_closingday_andor", "f_claim_settlement_closingday_andor", "", $h_selected); ?></td>
</tr>
<tr>
<td class="td_titlee">決済（支払）</td>
<td>
    <?php
        echo com_make_tag_option2($a_act, $f_claim_settlement_paymentday, "f_claim_settlement_paymentday", $GLOBALS['g_DB_m_contract_bill_pay'], "", $a_selected);
    ?>
</td>
<td><?php echo com_make_tag_option_andor("", "f_claim_settlement_paymentday_andor", "f_claim_settlement_paymentday_andor", "", $h_selected); ?></td>
</tr>
<tr>
<td class="td_titlee">備考</td>
<td>
    <?php
        echo com_make_tag_input($a_act, $f_remarks, "f_remarks", "width: 260px; text-align: center;");
    ?>
</td>
<td>&nbsp;</td>
</tr>
</table>
</center>
<br>

<p class="c">
<input type="submit" value="検索実行">
<input type="button" value="一覧に戻る" onclick="location.href='./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10100']; ?>'">
</p>

</form>

</section>

<?php
require_once('./footer.php');
?>

<script src="./js/hal-kanri-10100.js"></script>
