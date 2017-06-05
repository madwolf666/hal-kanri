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
    
<h2>注文書台帳</h2>

<form action="index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10400']; ?>" method="post">
<center>
<table class="tbl_list">
<tr>
<td class="td_titlee">契約管理No.</td>
<td>
    <?php
        echo com_make_tag_input($a_act, $f_contract_number_10400, "f_contract_number_10400", "width: 260px; text-align: center;");
    ?>
</td>
</tr>
<tr>
<td class="td_titlee">氏名</td>
<td>
    <?php
        echo com_make_tag_input($a_act, $f_engineer_name_10400, "f_engineer_name_10400", "width: 260px; text-align: center;");
    ?>
</td>
</tr>
</table>
</center>
<br>
    
<p class="c">
<input type="submit" value="検索実行">
<input type="button" value="一覧に戻る" onclick="location.href='./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10400']; ?>'">
</p>

</form>

</section>

<?php
require_once('./footer.php');
?>

<script src="./js/hal-kanri-10400.js"></script>
