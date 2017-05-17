<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./header.php');

if (!isset($_GET['MOD'])){
    $a_mod = 0;
}else{
    $a_mod = $_GET['MOD'];
}
?>

<link rel="stylesheet" href="css/hal-kanri-10403.css">

<section>
    
<h2>注文書台帳</h2>
<h3>注文請書</h3>

<form action="index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10400']; ?>" method="post">

<center>
    <br>
    <font size="+2"><B>注文請書</B></font>
    <br>
    <br>
    <div style="float: left"><u><B>&nbsp;&nbsp;株式会社HAL&nbsp;&nbsp;</B>&nbsp;&nbsp;&nbsp;&nbsp;</u>御中</div>
    <div style="text-align: left; margin-left:auto; width:300px;"><u>発&nbsp;&nbsp;&nbsp;行&nbsp;&nbsp;&nbsp;日&nbsp;&nbsp;2017年03月31日&nbsp;</u></div>
    <div style="text-align: left; margin-left:auto; width:300px;"><u>注文書番号&nbsp;&nbsp;&nbsp;&nbsp;3993&nbsp;&nbsp;-&nbsp;&nbsp;10993&nbsp;</u></div>
    <br>
    <div style="text-align: left; margin-left:auto; width:300px;"><住所></div>
    <br>
    <br>
    <div style="text-align: left; margin-left:auto; width:300px;"><会社名></div>
    <br>
    <div style="float: left">以下の通り、ご注文承ります。</div>
    <br>
    <table border="1" rules="all">
	<tr>
            <th colspan="4">契&nbsp;約&nbsp;形&nbsp;態</th>
            <td colspan="9" class="remarks">作業請負</td>
	</tr>
	<tr>
            <th colspan="2" rowspan="2">契約期間</th>
            <td colspan="2">開&nbsp;始&nbsp;日</td>
            <td colspan="9" class="remarks">2017/04/01</td>
	</tr>
	<tr>
            <td colspan="2">終&nbsp;了&nbsp;日</td>
            <td colspan="9" class="remarks">2017/04/30</td>
	</tr>
	<tr>
            <th colspan="4">技&nbsp;術&nbsp;者&nbsp;氏&nbsp;名</th>
            <td colspan="9" class="remarks">北山　光輝</td>
	</tr>
	<tr>
            <th colspan="4" rowspan="2">作&nbsp;業&nbsp;料&nbsp;金<br>(外税)</th>
            <td colspan="3" rowspan="2"><font size="-1">※小数点以下が発生する場合は<br>切捨てとする。</font><br>￥579,500&nbsp;／月</td>
            <td colspan="3">&nbsp;</td>
            <td colspan="3">&nbsp;</td>
	</tr>
	<tr>
            <td colspan="3">&nbsp;</td>
            <td colspan="3">&nbsp;</td>
	</tr>
	<tr>
            <th colspan="4">計&nbsp;算&nbsp;方&nbsp;法</th>
            <td colspan="3">日割稼働率</td>
            <td colspan="3">&nbsp;</td>
            <td colspan="3">&nbsp;</td>
	</tr>
	<tr>
	    <th colspan="2" rowspan="2">基準時間</th>
            <td colspan="2">下限時間</td>
            <td colspan="3">143</td>
            <td colspan="3">&nbsp;</td>
            <td colspan="3">&nbsp;</td>
	</tr>
	<tr>
            <td colspan="2">上限時間</td>
            <td colspan="3">190</td>
            <td colspan="3">&nbsp;</td>
            <td colspan="3">&nbsp;</td>
	</tr>
	<tr>
            <th colspan="2" rowspan="2">清算単価</th>
            <td colspan="2">控除単価</td>
            <td colspan="3">￥4,050&nbsp;／&nbsp;H</td>
            <td colspan="3">&nbsp;</td>
            <td colspan="3">&nbsp;</td>
	</tr>
	<tr>
            <td colspan="2">残業単価</td>
            <td colspan="3">￥3,050&nbsp;／&nbsp;H</td>
            <td colspan="3">&nbsp;</td>
            <td colspan="3">&nbsp;</td>
	</tr>
	<tr>
            <th colspan="4">時間単価</th>
            <td colspan="9">月次：&nbsp;30&nbsp;分</td>
	</tr>
	<tr>
            <th colspan="4">支払サイト</th>
            <td colspan="1">締日：毎月</td>
            <td colspan="3"class="hiddencell_l">月末</td>
            <td colspan="1"class="hiddencell_l">／</td>
            <td colspan="2"class="hiddencell_l">支払日：</td>
            <td colspan="2"class="hiddencell_l">翌々月25日</td>
	</tr>
	<tr>
            <th colspan="4" height=400px>その他</th>
            <td colspan="9"class="remarks">件名：コンビニ向け受発注システム開発</td>
	</tr>
    </table>
</center>

<p class="c">
<input type="button" value="Excelへ出力" onclick="return excel_out_10403();">
<input type="button" value="一覧に戻る" onclick="location.href='./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10400']; ?>'">
</p>

</form>

</section>

<?php
require_once('./footer.php');
?>
