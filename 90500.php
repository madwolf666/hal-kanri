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

<h2>請求・支払計算結果</h2>

<p class="c">
    <!-- input type="button" value="条件検索" onclick="location.href='./index.php?mnu=<?php echo $GLOBALS['g_MENU_MAINTENANCE_90401']; ?>'" -->
    <input type="button" value="アップロード" onclick="location.href='./index.php?mnu=<?php echo $GLOBALS['g_MENU_MAINTENANCE_90511']; ?>'">
</p>

<center>
<div id="my-list" style="z-index:100; width: auto; padding-bottom: 4px;"></div>
</center>

<div id="my-popup" class="popup">
	<div id="my-charge-calc" class="popup_inner" style="">
            <a href="#" onclick="hide_popup();">閉じる</a>
	</div>
</div>
<div id="overlay"></div>

</section>

<?php
require_once('./footer.php');
?>

<script src="./js/hal-kanri-90500.js"></script>
<script type="text/javascript">
    make_charge_calc_list(1);
    //resize_div2('leftColumn', 'right_title', 'right_record', 300, 184); 
    $(window).resize(function(){
        resize_div2('leftColumn', 'right_title', 'right_record', 300, 184); 
    });
</script>
