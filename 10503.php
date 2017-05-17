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

<link rel="stylesheet" href="css/hal-kanri-10503.css">

<section>
    
<h2>契約書台帳</h2>
<h3>労働契約書（再発行）</h3>

<form action="index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10500']; ?>" method="post">
<center>
    <div class="width">
        <p style="width:150px; margin-left:auto; text-align:left;">
        No.&nbsp;A07777&nbsp;-&nbsp;07777<br>
        </p>
        <font size="+2"><B><u>労働契約書(再発行)</u></B></font>
        <br>
        <br>
    </div>
    <table border="1" rules="all">
        <tr>
            <td width=15%><font size=-1>ﾌﾘｶﾞﾅ</font></td>
            <td colspan="8" width=70%><font size=-1>ﾊﾙ ﾀﾛｳ</font></td>
            <td colspan="4" width=5%><font size=-1>性別</font></td>
            <td colspan="4" width=25%><font size=-1>生年月日</font></td>
        </tr>
        <tr>
            <td height=40>氏名</td>
            <td colspan="8">春　太郎</td>
            <td colspan="4">男</td>
            <td colspan="4">昭和53年1月1日</td>
        </tr>
        <tr>
            <td height=40 rowspan="2">現住所</td>
            <td class="hiddencell_b remarks" colspan="16">（〒150-0012）</td>
        </tr>
        <tr>
            <td class="remarks hiddencell_t" colspan="16">東京都渋谷区広尾1-1-39恵比寿プライムスクエアタワー18階</td>
        </tr>
        <tr>
            <td  rowspan="2" width=15%>雇用期間<br>（派遣期間）</td>
            <td colspan="8" width=35%>2016年8月1日　より</td>
            <td colspan="4" width=25%>時給</td>
            <td colspan="4" width=25%>5,000円</td>
        </tr>
        <tr>
            <td colspan="8">2016年9月30日　まで</td>
            <td colspan="4">　</td>
            <td colspan="4">　</td>
        </tr>
        <tr>
            <td  rowspan="2">従事する<br>業務の種類</td>
            <td class="remarks" rowspan="2" colspan="8">システム開発（第４条第一項第一号業務）</td>
            <td colspan="4">　</td>
            <td colspan="4">　</td>
        </tr>
        <tr>
            <td colspan="4">　</td>
            <td colspan="4">　</td>
        </tr>
        <tr>
            <td rowspan="2">就業時間</td>
            <td class="remarks" rowspan="2" colspan="8">就業現場の規定に準ずる<br>（休日・時間外は就業規則による）</td>
            <td colspan="4">　</td>
            <td colspan="4">　</td>
        </tr>
        <tr>
            <td colspan="4">　</td>
            <td colspan="4">　</td>
        </tr>
        <tr>
            <td>休日</td>
            <td class="remarks" colspan="8">土曜日、日曜日、祝祭日、その他就業先の規定に準拠する。</td>
            <td colspan="4">　</td>
            <td colspan="4">　</td>
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
        </tr>
        <tr>
            <td rowspan="11">派遣契約に<br>関する通知</td>
            <td rowspan="3" colspan="4">就業場所</td>
            <td colspan="4">名称・部署</td>
            <td class="hiddencell_r remarks" colspan="4">株式会社テスト</td>
            <td class="remarks" colspan="8">第2技術本部　第2部</td>
        </tr>
        <tr>
            <td colspan="4">所在地</td>
            <td class="remarks" colspan="12">東京都江東区豊洲3-2-20　豊洲フロント5階</td>
        </tr>
        <tr>
            <td colspan="4">電話番号</td>
            <td class="remarks" colspan="12">03-6821-5111</td>
        </tr>
        <tr>
            <td colspan="4">指揮命令者</td>
            <td colspan="4">職名・氏名</td>
            <td class="hiddencell_r" colspan="2" width=10%>課長</td>
            <td class="remarks" colspan="12" width=32%>・藤山　勝</td>
        </tr>
        <tr>
            <td colspan="4">派遣先責任者</td>
            <td colspan="4">職名・氏名</td>
            <td class="hiddencell_r" colspan="2">部長</td>
            <td class="remarks" colspan="12">・北村　穣</td>
        </tr>
        <tr>
            <td colspan="4">派遣元責任者</td>
            <td colspan="4">職名・氏名</td>
            <td class="hiddencell_r" colspan="2">部長</td>
            <td class="remarks" colspan="12">・根本　真吾</td>
        </tr>
        <tr>
            <td colspan="4">苦情の処理</td>
            <td colspan="4" class="hiddencell_r">申出先</td>
            <td colspan="16" class="remarks">派遣元責任者および派遣先責任者に同じ</td>
        </tr>
        <tr>
            <td colspan="4">安全および衛生</td>
            <td colspan="18" class="remarks">就業規則による</td>
        </tr>
        <tr>
            <td colspan="4">福利厚生施設</td>
            <td colspan="18" class="remarks">就業規則による（作業先の施設等の利用ができる場合は追記）</td>
        </tr>
        <tr>
            <td colspan="4">契約解除の措置</td>
            <td colspan="18" class="remarks">本人の責によらない契約解除の場合は、速やかに次の派遣先を探すように努める</td>
        </tr>
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
                             ・社会保険（健康保険、厚生年金、雇用保険）適用有り<br>

                             ・源泉所得税控除<br>

                             ここから備考です。時間外休日等色々な事を書きます。<br>
            </td>
        </tr>
    </table>
    <br>
    <p style="width:450px; margin-right:auto; text-align:right;">上記以外の労働条件等については当社就業規則によります。</p>
    <br>
    <p style="width:150px; margin-right:auto; text-align:right;">2016年6月13日</p>
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
<input type="button" value="Excelへ出力" onclick="return excel_out_10503();">
<input type="button" value="一覧に戻る" onclick="location.href='./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10500']; ?>'">
</p>

</form>

</section>

<?php
require_once('./footer.php');
?>
