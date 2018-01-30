<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./header.php');

#echo $_GET['DEL']."<br>";
$a_del = 0;
if (isset($_GET['DEL'])){
    #echo $_GET['DEL']."<br>";
    $a_del = $_GET['DEL'];
}

?>

<section>
<h2>台帳関連<?php if ($a_del == 1){echo '(削除済)';} ?></h2>
<p><a href="./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10100']; ?>&DEL=<?php echo $a_del; ?>">契約管理全体</a></p>
<?php if ($_SESSION["hal_auth"] <= 0) { ?>
<p><a href="./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10200']; ?>&DEL=<?php echo $a_del; ?>">給与台帳</a></p>
<p><a href="./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10300']; ?>&DEL=<?php echo $a_del; ?>">検収台帳</a></p>
<p><a href="./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10400']; ?>&DEL=<?php echo $a_del; ?>">注文書台帳</a></p>
<p><a href="./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10500']; ?>&DEL=<?php echo $a_del; ?>">契約書台帳</a></p>
<p><a href="./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10600']; ?>&DEL=<?php echo $a_del; ?>">派遣元台帳</a></p>
<?php } ?>
</section>

<?php
require_once('./footer.php');
?>
