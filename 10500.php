<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./header.php');

?>

<link rel="stylesheet" href="./jquery/jquery-ui.css">
<link rel="stylesheet" href="./jquery/jquery.datetimepicker.css">
<script type="text/javascript" src="./jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="./jquery/jquery.ui.datepicker-ja.min.js"></script>
<script type="text/javascript" src="./jquery/jquery.datetimepicker.js"></script>

<link rel="stylesheet" href="css/hal-kanri-common.css">

<section>
<h2>契約書台帳<?php if($_SESSION['contract_del'] == 1){echo '(削除済)';} ?></h2>

<p class="c">
    <input type="button" value="条件検索" onclick="location.href='./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10501']; ?>'">
    <!--
    <input type="button" value="労働契約書" onclick="location.href='./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10502']; ?>'">
    <input type="button" value="労働契約書（再発行）" onclick="location.href='./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10503']; ?>'">
    <input type="button" value="就業条件明示書" onclick="location.href='./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10504']; ?>'">
    -->
    <input type="button" value="Excelへ一覧出力" onclick="return excel_out_10500();">
</p>

<center>
<div id="my-list" style="z-index:100; width: auto; padding-bottom: 4px;"></div>
</center>

<div id="my-popup" class="popup">
	<div id="my-method" class="popup_inner" style="">
            <a href="#" onclick="hide_popup();">閉じる</a>
	</div>
</div>
<div id="overlay"></div>

</section>

<?php
require_once('./footer.php');
?>

<script src="./js/hal-kanri-10500.js"></script>
<script type="text/javascript">
    make_agreement_ledger_list(1);
    //resize_div2('leftColumn', 'right_title', 'right_record', 410, 184); 
    $(window).resize(function(){
        resize_div2('leftColumn', 'right_title', 'right_record', 410, 184); 
    });
</script>
