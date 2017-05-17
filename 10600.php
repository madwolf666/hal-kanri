<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./header.php');

?>

<section>
<h2>派遣元台帳</h2>

<p class="c">
    <input type="button" value="条件検索" onclick="location.href='./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10601']; ?>'">
    <input type="button" value="Excelへ一覧出力" onclick="return excel_out_10600();">
</p>

</section>

<?php
require_once('./footer.php');
?>
