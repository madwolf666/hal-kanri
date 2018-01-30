<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./header.php');

if (!isset($_GET['ACT'])){
    $a_act = '';
}else{
    $a_act = $_GET['ACT'];
}

#[2018.01.29]課題解決管理表No.87
if ($_SESSION['contract_del'] == 1){
    $a_act = '';
}

require_once('./10500-com.php');

if (isset($_GET['NO'])) {
    $a_no = $_GET['NO'];
    try{
        //DBからユーザ情報取得
        $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
        $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $a_sql = set_10500_selectDB();

        $a_sql .= " WHERE (t1.cr_id=:cr_id);";

        $a_stmt = $a_conn->prepare($a_sql);
        $a_stmt->bindParam(':cr_id', $a_no, PDO::PARAM_STR);
        $a_stmt->execute();

        while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
            set_10500_fromDB($a_result);
        }
    } catch (PDOException $e){
        echo 'Error:'.$e->getMessage();
        die();
    }
}

?>

<link rel="stylesheet" href="./jquery/jquery-ui.css">
<link rel="stylesheet" href="./jquery/jquery.datetimepicker.css">
<script type="text/javascript" src="./jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="./jquery/jquery.ui.datepicker-ja.min.js"></script>
<script type="text/javascript" src="./jquery/jquery.datetimepicker.js"></script>

<link rel="stylesheet" href="css/hal-kanri-10502.css">

<section>
    
<h2>契約書台帳<?php if($_SESSION['contract_del'] == 1){echo '(削除済)';} ?></h2>
<h3>労働契約書<?php if($_SESSION['contract_del'] == 1){echo '(削除済)';} ?></h3>

<form action="index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10500']; ?>" method="post">
<center>
    <div class="width">
        <p style="width:150px; margin-left:auto; text-align:left;">
                No.&nbsp;<?php echo $ag_no; ?>
                <br>
        </p>
        <font size="+2"><B><u>労働契約書</u></B></font>
        <br>
        <br>
    </div>
    <table border="1" rules="all">
	<tr>
            <td width=15%><font size=-1>ﾌﾘｶﾞﾅ</font></td>
            <td colspan="8" width=70%><font size=-1><?php echo $engneer_name_phonetic; ?></font></td>
            <td colspan="4" width=5%><font size=-1>性別</font></td>
            <td colspan="4" width=25%><font size=-1>生年月日</font></td>
	</tr>
	<tr>
            <td height=40>氏名</td>
            <td colspan="8"><?php echo $engineer_name; ?></td>
            <td colspan="4"><?php echo $sex; ?></td>
            <td colspan="4"><?php echo $birthday; ?></td>
	</tr>
	<tr>
            <td height=40 rowspan="2">現住所</td>
            <td class="hiddencell_b remarks" colspan="16">（〒
            <?php echo $person_post_no; ?>
                ）</td>
	</tr>
	<tr>
            <td class="remarks hiddencell_t" colspan="16">
            <?php echo $person_address; ?>
            </td>
	</tr>
	<tr>
            <td  rowspan="2" width=15%>雇用期間</td>
            <td colspan="8" width=35%><?php echo $claim_agreement_start; ?>　より</td>
            <td colspan="4" width=15%>基本給</td>
            <td class="remarksR" colspan="4" width=35%><?php echo com_db_number_format($payment_normal_unit_price_2); ?>円</td>
	</tr>
	<tr>
            <td colspan="8"><?php echo $claim_agreement_end; ?>　まで</td>
            <td colspan="4">残業単価</td>
            <td class="remarksR" colspan="4"><?php echo com_db_number_format($payment_normal_overtime_unit_price_2); ?>円</td>
	</tr>
	<tr>
            <td  rowspan="2">従事する<br>業務の種類</td>
            <td class="remarks" rowspan="2" colspan="8">システム開発（第4条第1項1号業務）</td>
            <td colspan="4">控除単価</td>
            <td class="remarksR" colspan="4"><?php echo com_db_number_format($payment_normal_deduction_unit_price_2); ?>円</td>
	</tr>
	<tr>
            <td colspan="4">上限時間</td>
            <td class="remarksR" colspan="4"><?php echo $payment_normal_upper_limit_2; ?>時間</td>
	</tr>
	<tr>
            <td rowspan="2">就業時間</td>
            <td class="remarks" rowspan="2" colspan="8"><?php echo $work_start; ?>から<?php echo $work_end; ?><br>　（うち休憩時間　<?php echo $break_start; ?>から<?php echo $break_end; ?>までの間<?php echo $break_hours; ?>）</td>
            <td colspan="4">下限時間</td>
            <td class="remarksR" colspan="4"><?php echo $payment_normal_lower_limit_2; ?>時間</td>
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
            <td class="hiddencell_r" colspan="2" class="hiddencell_r"><?php echo $payment_settlement_closingday; ?></td>
            <td class="remarks" colspan="2">締め</td>
	</tr>
	<tr>
            <td colspan="8" class="remarks hiddencell_t">ロ．更新しない</td>
            <td colspan="4">賃金支払日</td>
            <td class="hiddencell_r" colspan="2" class="hiddencell_r"><?php echo $payment_settlement_paymentday; ?></td>
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
                <?php if ($payment_normal_calculation_2 != '時給'){ ?>
                ・基本給のうち、35％相当は定額割増賃金として支給する（残業代換算で70時間相当）。<br>
                <?php } ?>
                         <?php
                            if ($remarks != ''){
                                echo '<br>'.com_convertEOL($remarks).'<br>';
                            }
                            if ($remarks_pay != ''){
                                #echo '<br>'.com_convertEOL($remarks_pay).'<br>';
                            }
                            if ($payment_middle_unit_price_2 != ''){
                                echo '<br>【途中入場】';
                                echo '<br>&nbsp;&nbsp;単価：'. com_db_number_format_symbol($payment_middle_unit_price_2);
                                echo '<br>&nbsp;&nbsp;上限時間：'.$payment_middle_upper_limit_2.'h';
                                echo '<br>&nbsp;&nbsp;下限時間：'.$payment_middle_lower_limit_2.'h';
                                echo '<br>&nbsp;&nbsp;控除単価：'. com_db_number_format_symbol($payment_middle_deduction_unit_price_2);
                                echo '<br>&nbsp;&nbsp;超過単価：'. com_db_number_format_symbol($payment_middle_overtime_unit_price_2);
                                echo '<br>';
                            }
                            if ($payment_leaving_unit_price_2 != ''){
                                echo '<br>【途中退場】';
                                echo '<br>&nbsp;&nbsp;単価：'. com_db_number_format_symbol($payment_leaving_unit_price_2);
                                echo '<br>&nbsp;&nbsp;上限時間：'.$payment_leaving_upper_limit_2.'h';
                                echo '<br>&nbsp;&nbsp;下限時間：'.$payment_leaving_lower_limit_2.'h';
                                echo '<br>&nbsp;&nbsp;控除単価：'. com_db_number_format_symbol($payment_leaving_deduction_unit_price_2);
                                echo '<br>&nbsp;&nbsp;超過単価：'. com_db_number_format_symbol($payment_leaving_overtime_unit_price_2);
                                echo '<br>';
                            }
                         ?>
            </td>
        </tr>
    </table>
    <br>
    <p style="width:450px; margin-right:auto; text-align:right;">上記以外の労働条件等については当社就業規則によります。</p>
    <br>
    <p style="width:150px; margin-right:auto; text-align:right;">
        <?php
            if ($a_act == '') {
                echo $publication;
            } else {
                echo com_make_tag_input($a_act, $publication, "publication", "width: 100px;; text-align: center;");
            }
        ?>
    </p>
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
<?php if ($a_act != ''){ ?>
<input type="button" value="更新" onclick="return regist_agreement_10502('e',<?php echo $cr_id; ?>);">
<?php } ?>
<input type="button" value="Excelへ出力" onclick="return excel_out_10502(<?php echo $cr_id; ?>);">
<input type="button" value="一覧に戻る" onclick="location.href='./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10500']; ?>&DEL=<?php echo $_SESSION['contract_del']; ?>'">
</p>

</form>

</section>

<?php
require_once('./footer.php');
?>

<script src="./js/hal-kanri-10500.js"></script>
