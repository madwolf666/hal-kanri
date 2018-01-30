<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./header.php');

$a_act = "e";

require_once('./10400-com.php');

?>

<link rel="stylesheet" href="./css/hal-kanri-common.css">

<section>
    
<h2>注文書台帳<?php if($_SESSION['contract_del'] == 1){echo '(削除済)';} ?></h2>

<form action="index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10400']; ?>&DEL=<?php echo $_SESSION['contract_del']; ?>" method="post">
<center>
<table class="tbl_list">
<tr>
<td class="td_titlee">契約管理No.</td>
<td>
    <?php
    if ($_SESSION['contract_del'] != 1){
        echo com_make_tag_input($a_act, $f_contract_number_10400, "f_contract_number_10400", "width: 260px; text-align: center;");
    }else{
        echo com_make_tag_input($a_act, $f_contract_number_10400_del, "f_contract_number_10400_del", "width: 260px; text-align: center;");
    }
    ?>
</td>
<td>&nbsp;</td>
</tr>
<tr>
<td class="td_titlee">氏名</td>
<td>
    <?php
    if ($_SESSION['contract_del'] != 1){
        echo com_make_tag_input($a_act, $f_engineer_name_10400, "f_engineer_name_10400", "width: 260px; text-align: center;");
    }else{
        echo com_make_tag_input($a_act, $f_engineer_name_10400_del, "f_engineer_name_10400_del", "width: 260px; text-align: center;");
    }
    ?>
</td>
<td>
    <?php
    if ($_SESSION['contract_del'] != 1){
        echo com_make_tag_option_andor("", "f_engineer_name_10400_andor", "f_engineer_name_10400_andor", "", $h_selected);
    }else{
        echo com_make_tag_option_andor("", "f_engineer_name_10400_andor_del", "f_engineer_name_10400_andor_del", "", $h_selected);
    }
    ?>
</td>
</tr>
</table>
</center>
<br>
    
<p class="c">
<input type="submit" value="検索実行">
<input type="button" value="一覧に戻る" onclick="location.href='./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10400']; ?>&DEL=<?php echo $_SESSION['contract_del']; ?>'">
</p>

</form>

</section>

<?php
require_once('./footer.php');
?>

<script src="./js/hal-kanri-10400.js"></script>
