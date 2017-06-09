<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./header.php');

?>

<section>
<h2>マスタ情報</h2>
<?php if ($_SESSION["hal_auth"] <= 0) { ?>
<p><a href="./index.php?mnu=<?php echo $GLOBALS['g_MENU_MAINTENANCE_90100']; ?>">ユーザ情報</a></p>
<p><a href="./index.php?mnu=<?php echo $GLOBALS['g_MENU_MAINTENANCE_90300']; ?>">お知らせ情報</a></p>
<?php } ?>
<p><a href="./index.php?mnu=<?php echo $GLOBALS['g_MENU_MAINTENANCE_90200']; ?>">エンジニア情報</a></p>
<p><a href="./index.php?mnu=<?php echo $GLOBALS['g_MENU_MAINTENANCE_90400']; ?>">送付状情報</a></p>
</section>

<?php
require_once('./footer.php');
?>
