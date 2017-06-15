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

<link rel="stylesheet" href="css/hal-kanri-10503.css">

<section>
    
<h2>契約書台帳</h2>
<h3>労働契約書（再発行）</h3>

<form action="index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10500']; ?>" method="post">
<center>
    <div class="width">
        <p style="width:150px; margin-left:auto; text-align:left;">
            No.&nbsp;<?php echo $ag_no; ?>
            <br>
        </p>
        <font size="+2"><B><u>労働契約書(再発行)</u></B></font>
        <br>
        <br>
    </div>
    <table border="1" rules="all">
	<tr>
            <td width=15%><font size=-1>ﾌﾘｶﾞﾅ</font></td>
            <td colspan="4" width=55%><font size=-1><?php echo $engneer_name_phonetic; ?></font></td>
            <td colspan="4" width=15%><font size=-1>　</font></td>
            <td colspan="4" width=5%><font size=-1>性別</font></td>
            <td colspan="4" width=25%><font size=-1>生年月日</font></td>
	</tr>
	<tr>
            <td height=40>氏名</td>
            <td colspan="4"><?php echo $engineer_name; ?></td>
            <td colspan="4">（有期雇用）</td>
            <td colspan="4"><?php echo $sex; ?></td>
            <td colspan="4"><?php echo $birthday; ?></td>
	</tr>
	<tr>
            <td height=40 rowspan="2">現住所</td>
            <td class="hiddencell_b remarks" colspan="16">（〒
            <?php echo $person_post_no; ?>
                ）
            </td>
	</tr>
	<tr>
            <td class="remarks" colspan="16">
            <?php echo $person_address; ?>
            </td>
	</tr>
	<tr>
            <td  rowspan="2">雇用期間<br>（派遣期間）</td>
            <td colspan="8"><?php echo $claim_agreement_start; ?>　より</td>
            <td colspan="4">基本給</td>
            <td class="remarksR" colspan="4"><?php echo com_db_number_format($payment_normal_unit_price_2); ?>円</td>
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
            <td class="remarks" rowspan="2" colspan="8"><?php echo $work_start; ?>から<?php echo $work_end; ?><br>　（うち休憩時間　<?php echo $break_start; ?>から<?php echo $break_end; ?>までの間<?php echo $break_hours; ?>分間）</td>
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
            <td>契約更新の<br>有無</td>
            <td colspan="8">イ．更新する場合がありえる<br>ロ．更新しない</td>
            <td colspan="4">賃金締切日</td>
            <td class="hiddencell_r" colspan="2" class="hiddencell_r"><?php echo $payment_settlement_closingday; ?></td>
            <td class="remarks" colspan="2"><?php echo $payment_settlement_paymentday; ?></td>
	</tr>
	<tr>
            <td>抵触日</td>
            <td colspan="2" width=20%>組織単位</td>
            <td colspan="6" width=35%><?php echo $contact_date_org; ?></td>
            <td colspan="4">賃金支払日</td>
            <td class="hiddencell_r" colspan="2"><?php echo $payment_settlement_closingday; ?></td>
            <td class="remarks" colspan="2"><?php echo $payment_settlement_paymentday; ?></td>
	</tr>
	<tr>
            <td rowspan="13">派遣契約に<br>関する通知</td>
            <td rowspan="4" colspan="4">就業場所</td>
            <td colspan="4">名称・部署</td>
            <td class="remarks" colspan="12"><?php echo $dd_name; ?>・<?php echo $dd_branch; ?></td>
	</tr>
	<tr>
            <td colspan="4">組織単位</td>
            <td class="remarks" colspan="12"><?php echo $organization; ?></td>
	</tr>
	<tr>
            <td colspan="4">所在地</td>
            <td class="remarks" colspan="12"><?php echo $dd_address; ?></td>
	</tr>
	<tr>
            <td colspan="4">電話番号</td>
            <td class="remarks" colspan="12"><?php echo $dd_tel; ?></td>
	</tr>
	<tr>
            <td colspan="4">指揮命令者</td>
            <td colspan="4">職名・氏名</td>
            <td class="hiddencell_r" colspan="2" width=10%><?php echo $ip_position; ?></td>
            <td class="remarks" colspan="12" width=32%><?php echo $ip_name; ?></td>
	</tr>
	<tr>
            <td colspan="4">派遣先責任者</td>
            <td colspan="4">職名・氏名</td>
            <td class="hiddencell_r" colspan="2"><?php echo $dd_responsible_position; ?></td>
            <td class="remarks" colspan="12"><?php echo $dd_responsible_name; ?></td>
	</tr>
	<tr>
            <td colspan="4">派遣元責任者</td>
            <td colspan="4">職名・氏名</td>
            <td class="hiddencell_r" colspan="2"><?php echo $dm_responsible_position; ?></td>
            <td class="remarks" colspan="12"><?php echo $dm_responsible_name; ?></td>
	</tr>
	<tr>
            <td colspan="4" rowspan="2">苦情の処理・申出先(1)</td>
            <td colspan="4">派遣先：職名・氏名</td>
            <td class="hiddencell_r" colspan="2"><?php echo $chs_position2; ?></td>
            <td class="remarks" colspan="12"><?php echo $chs_name2; ?>
            </td>
	</tr>
	<tr>
            <td colspan="4">派遣元：職名・氏名</td>
            <td class="hiddencell_r" colspan="2"><?php echo $chs_position1; ?></td>
            <td class="remarks" colspan="12"><?php echo $chs_name1; ?>
            </td>
	</tr>
	<tr>
            <td colspan="4" height=200>苦情処理方法、連携体制</td>
            <td class="remarks" colspan="12">
            ① 派遣元における（1）記載者の者が苦情の申し出を受けたときは、ただちに派遣元責任者へ連絡することとし、当該派遣元責任者が中心となって、誠意をもって、遅滞なく、当該苦情の適切かつ迅速な処理を図ることとし、その結果について必ず派遣労働者に通知することとする。
            ➁派遣先における（1）記載者の者が苦情の申出を受けたときは、ただちに派遣先責任者へ連絡することとし、当該派遣先責任者が中心となって、誠意をもって、遅滞なく、当該苦情の適切かつ迅速な処理を図ることとし、その結果について必ず派遣労働者に通知することとする。
            ③ 派遣元事業主及び派遣先は、自らでその解決が容易であり、即時に処理した苦情の他は、相互に遅滞なく通知するとともに、密接に連絡調整を行いつつ、その解決を図ることとする。
            </td>
        </tr>
        <tr>
	   <td colspan="4">安全および衛生</td>
	   <td class="remarks" colspan="12">派遣先の安全衛生に関する規定を適用し、その他については、派遣元の安全衛生に関する規定を適用する。</td>
        </tr>
        <tr>
	   <td colspan="4">福利厚生施設</td>
	   <td class="remarks" colspan="12">就業規則による</td>
        </tr>
        <tr>
	   <td colspan="4">契約解除の措置</td>
	   <td class="remarks" colspan="12">派遣元事業主は、労働者派遣契約の契約期間が満了する前に派遣労働者の責に帰すべき事由以外の事由によって労働者派遣契約の解除が行われた場合には、当該労働者派遣契約に係る派遣先と連携して、当該派遣先からその関連会社での就業のあっせんを受けること、当該派遣元事業主において他の派遣先を確保すること等により、当該労働者派遣契約に係る派遣労働者の新たな就業機会の確保を図ることとする。また、当該派遣元事業主は、当該労働者派遣契約の解除に当たって、新たな就業機会の確保ができない場合は、まず休業等を行い、当該派遣労働者の雇用の維持を図るようにするとともに、休業手当の支払の労働基準法等に基づく責任を果たすこととする。さらに、やむを得ない事由によりこれができない場合において、当該派遣労働者を解雇しようとするときであっても、労働契約法の規定を遵守することはもとより、少なくとも30日前に予告することとし、30日前に予告しないときは労働基準法第20条第1項に基づく解雇予告手当を支払うこと、休業させる場合には労働基準法第26条に基づく休業手当を支払うこと等、雇用主に係る労働基準法等の責任を負うこととする。
		</td>
        </tr>
        <tr>
	   <td>時間外勤務及び<br>休日勤務</td>
	   <td class="remarks" colspan="16">時間外勤務(有)　1日15時間、週15時間、年360時間<br>休日勤務(有)　法廷休日につき月2回</td>
        </tr>
        <tr>
	   <td>派遣先労働者を雇用する場合の<br>紛争防止措置</td>
	   <td class="remarks" colspan="16">派遣先企業が、労働者派遣の終了後に当該派遣労働者を直接雇用する意思がある場合には、当該意思を事前に派遣会社に示すものとする。尚、職業安定法に基づく職業紹介を行うことができる場合は、紹介手数料を支払うものとし、その手数料の額については、甲乙協議の上、決定するものとする。
		 </td>
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
                <!-- ・源泉所得税控除<br --> 
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
        <p style="width:275px; margin-left:auto; text-align:left;">
        雇用者　株式会社　<font size=+1>HAL</font><br>
        代表取締役　寺　西　信　夫　　　㊞<br>
        <br>
        被雇用者　　　　　　　　　　　　㊞<br>
        </p>
    </div>
</center>
    
<p class="c">
<input type="button" value="更新" onclick="return regist_agreement_10503('e',<?php echo $cr_id; ?>);">
<input type="button" value="Excelへ出力" onclick="return excel_out_10503(<?php echo $cr_id; ?>);">
<input type="button" value="一覧に戻る" onclick="location.href='./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10500']; ?>'">
</p>

</form>

</section>

<?php
require_once('./footer.php');
?>

<script src="./js/hal-kanri-10500.js"></script>
