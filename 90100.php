<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./header.php');

?>

<link rel="stylesheet" href="css/hal-kanri-common.css">

<section>
    
<h2>ユーザ情報</h2>
<center>
<p class="c">
<input type="button" value="新規" onclick="location.href='./index.php?mnu=<?php echo $GLOBALS['g_MENU_MAINTENANCE_90102']; ?>&ACT=n'">
</p>

<div id="my-list" style="z-index:100; width: auto; padding-bottom: 10px;"></div>
</center>

</section>

<?php
require_once('./footer.php');
?>

<script src="./js/hal-kanri-90100.js"></script>
<script type="text/javascript">
    make_m_user_list(1);
</script>
