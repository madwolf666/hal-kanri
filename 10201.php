<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./header.php');

?>

<link rel="stylesheet" href="./css/hal-kanri-common.css">

<section>
    
<h2>給与台帳</h2>

<form action="index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10200']; ?>" method="post">
    <center>
        
<table class="tbl_list">
<tr>
<td class="td_titlee">管理No.</td>
<td><input type="text" name="管理No." size="10" class="ws"></td>
</tr>
<tr>
<td class="td_titlee">発行日</td>
<td><input type="text" name="発行日" size="10" class="ws"></td>
</tr>
<tr>
<td class="td_titlee">作成者</td>
<td><input type="text" name="作成者" size="30" class="ws"></td>
</tr>
<tr>
<td class="td_titlee">ｴﾝｼﾞﾆｱ番号</td>
<td><input type="text" name="ｴﾝｼﾞﾆｱ番号" size="10" class="ws"></td>
</tr>
<tr>
<td class="td_titlee">ｴﾝｼﾞﾆｱ名</td>
<td><input type="text" name="ｴﾝｼﾞﾆｱ名" size="10" class="ws"></td>
</tr>
<tr>
<!-- th>お問い合わせ詳細※</th>
<td><textarea name="お問い合わせ詳細" cols="30" rows="10" class="wl"></textarea></td>
</tr -->
</table>
</center>
<br>
    
<p class="c">
<input type="submit" value="検索実行">
<input type="button" value="一覧に戻る" onclick="location.href='./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10200']; ?>'">
</p>

</form>

</section>

<?php
require_once('./footer.php');
?>
