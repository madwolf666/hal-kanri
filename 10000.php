<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./header.php');

?>

<section>
<h2>台帳関連</h2>
<p><a href="./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10100']; ?>">契約管理全体</a></p>
<p><a href="./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10200']; ?>">給与台帳</a></p>
<p><a href="./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10300']; ?>">検収台帳</a></p>
<p><a href="./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10400']; ?>">注文書台帳</a></p>
<p><a href="./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10500']; ?>">契約書台帳</a></p>
<p><a href="./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10600']; ?>">派遣元台帳</a></p>
</section>

<?php
require_once('./footer.php');
?>
