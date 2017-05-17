<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./header.php');

//echo date_default_timezone_get();
?>

<link rel="stylesheet" href="./css/hal-kanri-common.css">

<section>
    
<h2>エンジニア情報</h2>

<form action="" method="post">
<center>
    <font color="#ff0000">※アップロードするExcelファイルを選択して下さい。</font>
    <br>
    <font color="#ff0000">（パスワードの設定は解除して下さい。）</font>
    <br>
    <br>
    <input type="file" name="excel_file">
</center>
<br>

<p class="c">
<input type="button" value="アップロード" onclick="return upload_engineer_file();">
<input type="button" value="一覧に戻る" onclick="location.href='./index.php?mnu=<?php echo $GLOBALS['g_MENU_MAINTENANCE_90200']; ?>'">
</p>

<div id="my-result" style="z-index:100; text-align:center; width:auto; color: #ff0000;"></div>

</form>

</section>

<?php
require_once('./footer.php');
?>

<script src="./js/hal-kanri-90200.js"></script>
