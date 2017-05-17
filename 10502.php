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

<link rel="stylesheet" href="css/hal-kanri-10502.css">

<section>
    
<h2>契約書台帳</h2>
<h3>労働契約書</h3>

<form action="index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10500']; ?>" method="post">
<center>
    <div class="width">
        <p style="width:150px; margin-left:auto; text-align:left;">
                No.&nbsp;B00351&nbsp;-&nbsp;10978<br>
        </p>
        <font size="+2"><B><u>労働契約書</u></B></font>
        <br>
        <br>
    </div>
    <table border="1" rules="all">
	<tr>
            <td width=15%><font size=-1>ﾌﾘｶﾞﾅ</font></td>
            <td colspan="8" width=70%><font size=-1>ﾑﾗﾏﾂ ﾉﾌﾞｱｷ</font></td>
            <td colspan="4" width=5%><font size=-1>性別</font></td>
            <td colspan="4" width=25%><font size=-1>生年月日</font></td>
	</tr>
	<tr>
            <td height=40>氏名</td>
            <td colspan="8">村松　信明</td>
            <td colspan="4">男</td>
            <td colspan="4">昭和31年5月12日</td>
	</tr>
	<tr>
            <td height=40 rowspan="2">現住所</td>
            <td class="hiddencell_b remarks" colspan="16">（〒496-0801）</td>
	</tr>
	<tr>
            <td class="remarks hiddencell_t" colspan="16">愛知県津島市藤浪町2丁目1-2津島団地3棟403号</td>
	</tr>
	<tr>
            <td  rowspan="2" width=15%>雇用期間</td>
            <td colspan="8" width=35%>2017年4月1日　より</td>
            <td colspan="4" width=15%>基本給</td>
            <td class="remarksR" colspan="4" width=35%>272,600円</td>
	</tr>
	<tr>
            <td colspan="8">2017年6月30日　まで</td>
            <td colspan="4">残業単価</td>
            <td class="remarksR" colspan="4">1,430円</td>
	</tr>
	<tr>
            <td  rowspan="2">従事する<br>業務の種類</td>
            <td class="remarks" rowspan="2" colspan="8">システム開発</td>
            <td colspan="4">控除単価</td>
            <td class="remarksR" colspan="4">2,610円</td>
	</tr>
	<tr>
            <td colspan="4">上限時間</td>
            <td class="remarksR" colspan="4">190時間</td>
	</tr>
	<tr>
            <td rowspan="2">就業時間</td>
            <td class="remarks" rowspan="2" colspan="8">09時00分から18時00分<br>　（うち休憩時間　12時00分から12時45分までの間45分間）</td>
            <td colspan="4">下限時間</td>
            <td class="remarksR" colspan="4">140時間</td>
	</tr>
	<tr>
            <td class="remarks" colspan="8">　</td>
	</tr>
	<tr>
            <td>休日</td>
            <td class="remarks" colspan="8">土曜日、日曜日、祝祭日、その他就業先の規定に準拠する。</td>
            <td class="remarks" colspan="8">　</td>
	</tr>
	<tr>
            <td rowspan="2">契約更新の<br>有無</td>
            <td colspan="8" class="remarks hiddencell_b">イ．更新する場合がありえる</td>
            <td colspan="4">賃金締切日</td>
            <td class="hiddencell_r" colspan="2" class="hiddencell_r">月末</td>
            <td class="remarks" colspan="2">締め</td>
	</tr>
	<tr>
            <td colspan="8" class="remarks hiddencell_t">ロ．更新しない</td>
            <td colspan="4">賃金支払日</td>
            <td class="hiddencell_r" colspan="2" class="hiddencell_r">翌々月11日</td>
            <td class="remarks" colspan="2">支払</td>
        <tr>
	   <td rowspan="2">契約更新の<br>基準</td>
	   <td class="hiddencell_b hiddencell_r remarks" colspan="8">イ．要員の必要性、本人の能力、健康状態</td>
	   <td class="hiddencell_b remarks" colspan="8">ハ．会社の経営状況</td>
        </tr>
        <tr>
            <td class="hiddencell_r remarks" colspan="8">ロ．勤務態度、従事している業務の進捗状況</td>
            <td class="remarks" colspan="8">ニ．その他（　　　　　　　　　　　　）</td>
        </tr>
        <tr>
            <td height=400>備考</td>
            <td class="remarks" colspan="16">
            ・源泉所得税控除<br>
            ・社会保険（健康保険、厚生年金、雇用保険）適用有り<br>
            ・基本給のうち、35％相当は定額割増賃金として支給する（残業代換算で70時間相当）。<br>
            ※時間外休憩あり(17:45～18:00)<br>
            </td>
        </tr>
    </table>
    <br>
    <p style="width:450px; margin-right:auto; text-align:right;">上記以外の労働条件等については当社就業規則によります。</p>
    <br>
    <p style="width:150px; margin-right:auto; text-align:right;">2017年03月31日</p>
    <div class="width">
        <p style="width:350px; margin-left:auto; text-align:left;">
    雇用者<br>
		　　　　株式会社　<font size=+1>HAL</font><br>
  　　　　  代表取締役　寺　西　信　夫　　　㊞<br>
    <br>
    被雇用者　　　　　　　　　　　 　　　　　㊞<br>
        </p>
    </div>
</center>

<p class="c">
<input type="button" value="Excelへ出力" onclick="return excel_out_10502();">
<input type="button" value="一覧に戻る" onclick="location.href='./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10500']; ?>'">
</p>

</form>

</section>

<?php
require_once('./footer.php');
?>
