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

        $a_sql = "SELECT t1.*,";
        $a_sql .= "
     t2.ag_no
    ,t2.publication
    ,t2.person_post_no
    ,t2.person_address
    ,t2.contact_date_brn
    ,t2.conflict_prevention
    ,t2.thing1
    ,t2.chs_tel2
    ,t2.dd_responsible_tel
    ,t2.reserve1
    ,t2.reserve2
    ,t2.reserve3
    ,t2.reserve4
    ,t2.reserve5
    ,t2.reserve6
    ,t2.reserve7
    ,t2.guide_ships
    ,t3.sex
    ,t3.birthday
    ,t3.skill_type
        ";
        $a_sql .= " FROM ".$GLOBALS['g_DB_t_contract_report']." t1";
        $a_sql .= " LEFT JOIN ";
        $a_sql .= $GLOBALS['g_DB_t_agreement_ledger']." t2";
        $a_sql .= " ON (t1.cr_id=t2.cr_id)";
        $a_sql .= " LEFT JOIN ";
        $a_sql .= $GLOBALS['g_DB_m_engineer']." t3";
        $a_sql .= " ON (t1.engineer_number=t3.entry_no)";
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

<link rel="stylesheet" href="css/hal-kanri-10504.css">

<section>
    
<h2>契約書台帳</h2>
<h3>就業条件明示書</h3>

<form action="index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10500']; ?>" method="post">
<center>
    <div class="width">
        <br>
        <font size="+2"><B><u>就業条件明示書</u></B></font>
        <p style="width:120px; margin-left:auto; text-align:left;"><font color="#ff0000">平成29年4月7日</font></p>
        <p style="width:150px; margin-right:auto; text-align:right;"><u>　<?php echo $engineer_name; ?>　様</u></p>
        <p style="width:270px; margin-left:auto; text-align:left;">
                東京都渋谷区広尾１－１－３９<br>
                恵比寿プライムスクエアタワー18階<br>
                株式会社　ＨＡＬ<br>
                代表取締役　　　寺　西　　信　夫<br>
        </p>
        <p style="width:260px; margin-right:auto; text-align:right;">次の条件で労働者派遣を行います。</p>
    </div>
    <table border="1" rules="all" width=100%>
	<tr>
            <td width=20%>業務内容</td>
            <td class="remarks" colspan="5" width=80%>
情報処理システム開発（１号）業務<br>
ソフトウェア開発補助業務<br>
派遣法施行令第４条第一項第一号<br>
            </td>
	</tr>
	<tr>
            <td rowspan="4" width=20%>就業場所</td>
            <td class="remarks hiddencell_r hiddencell_b" width=10%>事業所名</td>
            <td class="remarks hiddencell_b" colspan="4" width=70%><?php echo $dd_name; ?></td>
	</tr>
	<tr>
            <td class="remarks hiddencell_r hiddencell_b">部署名</td>
            <td class="remarks hiddencell_b" colspan="4"><?php echo $dd_branch; ?></td>
	</tr>
	<tr>
            <td class="remarks hiddencell_r hiddencell_b">所在地</td>
            <td class="remarks hiddencell_b" colspan="4"><?php echo $dd_address; ?></td>
	</tr>
	<tr>
            <td class="remarks hiddencell_r">電話番号</td>
            <td class="remarks" colspan="4"><?php echo $dd_tel; ?></td>
	</tr>
	<tr>
            <td width=20%>組織単位</td>
            <td class="remarks" colspan="5" width=80%><?php echo $organization; ?></td>
	</tr>
	<tr>
            <td width=20%>指揮命令者</td>
            <td width=5% class="hiddencell_r">職名</td>
            <td width=15% class="hiddencell_r remarks"><?php echo $ip_position; ?></td>
            <td width=10% class="hiddencell_r">氏名</td>
            <td width=50% class="remarks" colspan="2"><?php echo $ip_name; ?></td>
	</tr>
	<tr>
            <td width=20%>抵触日</td>
            <td class="remarks" colspan="5" width=80%><?php echo $contact_date_org; ?></td>
	</tr>
	<tr>
            <td width=20%>就業日</td>
            <td class="remarks" colspan="5" width=80%>派遣先の就業日に準ずる</td>
	</tr>
	<tr>
            <td width=20%>就業時間</td>
            <td class="remarks" colspan="5" width=80%>
                   <?php echo $work_start; ?>から<?php echo $work_end; ?><br>
    （うち休憩時間　<?php echo $break_start; ?>から<?php echo $break_end; ?>までの間<?php echo $break_hours; ?>）</td>
	</tr>
	<tr>
            <td width=20%>安全及び衛生</td>
            <td class="remarks" colspan="5" width=80%>派遣先の安全衛生に関する規定を適用し、その他については、派遣元の安全衛生に関する規定を適用する。</td>
	</tr>
	<tr>
            <td rowspan="2" width=20%>時間外勤務<br>及び休日勤務</td>
            <td class="remarks hiddencell_r" colspan="2" width=20%>時間外勤務（有）</td>
            <td class="remarks" colspan="3" width=60%>１日１５時間、週１５時間、年３６０時間</td>
	</tr>
	<tr>
            <td class="remarks hiddencell_r" colspan="2" width=20%>休日勤務　（有）</td>
            <td class="remarks" colspan="3" width=60%>法定休日につき２回</td>
	</tr>
	<tr>
            <td width=20%>派遣先責任者</td>
            <td width=3% class="hiddencell_r">職名</td>
            <td width=7% class="hiddencell_r"><?php echo $dd_responsible_position; ?></td>
            <td width=3% class="hiddencell_r">氏名</td>
            <td width=17% class="hiddencell_r"><?php echo $dd_responsible_name; ?>
            </td>
            <td width=50%>（電話：<font color="#ff0000">０６－４８０７－６６２０</font>）</td>
	</tr>
	<tr>
            <td width=20%>派遣元責任者</td>
            <td width=3% class="hiddencell_r">職名</td>
            <td width=7% class="hiddencell_r"><?php echo $dm_responsible_position; ?></td>
            <td width=3% class="hiddencell_r">氏名</td>
            <td width=17% class="hiddencell_r"><?php echo $dm_responsible_name; ?>
            </td>
            <td width=50%>（電話：<font color="#ff0000">０６－６１３６－５７７２</font>）</td>
	</tr>
	<tr>
            <td width=20%>福利厚生施設<br>の利用等</td>
            <td class="remarks" colspan="5" width=80%>派遣労働者に対し、派遣先が雇用する労働者が利用する施設または設備について、利用することができるように便宜供与するものとする。</td>
	</tr>
	<tr>
            <td rowspan="3"  width=20%>苦情の処理・<br>申出先（1）</td>
            <td colspan="5" width=80%  class="remarks hiddencell_b">申込先</td>
	</tr>
	<tr>
            <td width=15% class="hiddencell_r hiddencell_b">派遣先：職名</td>
            <td width=5% class="hiddencell_r hiddencell_b"><?php echo $chs_position2; ?></td>
            <td width=5% class="hiddencell_r hiddencell_b">氏名</td>
            <td width=10% class="hiddencell_r hiddencell_b"><?php echo $chs_name2; ?>
            </td>
            <td width=45% class="hiddencell_b">（電話：<font color=#ff0000">０６－４８０７－６６２０</font>）</td>
	</tr>
	<tr>
            <td width=15% class="hiddencell_r">派遣元：職名</td>
            <td width=5% class="hiddencell_r"><?php echo $chs_position1; ?></td>
            <td width=5% class="hiddencell_r">氏名</td>
            <td width=10% class="hiddencell_r"><?php echo $chs_name1; ?>
            </td>
            <td width=45%>（電話：<font color=#ff0000">０６－６１３６－５７７２</font>）</td>
	</tr>
	<tr>
            <td width=20%>苦情処理方、<br>連携体制等</td>
            <td colspan="5" class="remarks" width=80%>
			①　派遣元における（１）記載者の者が苦情の申し出を受けたときは、ただちに<br>
　　派遣元責任者へ連絡することとし、当該派遣元責任者が中心となって、<br>
　　誠意をもって、遅滞なく、当該苦情の適切かつ迅速な処理を図ることとし、<br>
　　その結果について必ず派遣労働者に通知することとする。<br>
			<br>
			②　派遣先における（1）記載者の者が苦情の申出を受けたときは、ただちに<br>
　　派遣先責任者へ連絡することとし、当該派遣先責任者が中心となって、<br>
　　誠意をもって、遅滞なく、当該苦情の適切かつ迅速な処理を図ることとし、<br>
　　その結果について必ず派遣労働者に通知することとする。<br>
			<br>
			③　派遣元事業主及び派遣先は、自らでその解決が容易であり、即時に処理した<br>
　　苦情の他は、相互に遅滞なく通知するとともに、密接に連絡調整を行いつつ、<br>
　　その解決を図ることとする。<br>
            </td>
	</tr>
	<tr>
            <td width=20%>派遣契約解除<br>の場合の措置</td>
            <td colspan="5" class="remarks" width=80%>
                    派遣元事業主は、労働者派遣契約の契約期間が満了する前に派遣労働者の責に帰すべき事由以外の事由によって労働者派遣契約の解除が行われた場合には、
                    当該労働者派遣契約に係る派遣先と連携して、当該派遣先からその関連会社での就業のあっせんを受けること、
                    当該派遣元事業主において他の派遣先を確保すること等により、当該労働者派遣契約に係る派遣労働者の新たな就業機会の確保を図ることとする。
                    また、当該派遣元事業主は、当該労働者派遣契約の解除に当たって、新たな就業機会の確保ができない場合は、まず休業等を行い、
                    当該派遣労働者の雇用の維持を図るようにするとともに、休業手当の支払の労働基準法等に基づく責任を果たすこととする。
                    さらに、やむを得ない事由によりこれができない場合において、当該派遣労働者を解雇しようとするときであっても、
                    労働契約法の規定を遵守することはもとより、少なくとも30日前に予告することとし、
                    30日前に予告しないときは労働基準法第20条第1項に基づく解雇予告手当を支払うこと、休業させる場合には労働基準法第26条に基づく休業手当を支払うこと等、
                    雇用主に係る労働基準法等の責任を負うこととする。
            </td>
	</tr>
	<tr>
            <td width=20%>派遣料金</td>
            <td colspan="2" width=40% class="hiddencell_r"><?php echo com_db_number_format($payment_normal_unit_price_2); ?>/月</td>
            <td colspan="3" width=40% class="remarks">※HALと客先の契約金額</td>
	</tr>
	<tr>
            <td width=20% height=300>備考</td>
            <td class="remarks" colspan="5" width=80%>
                         <?php
                            if ($remarks != ''){
                                echo '<br>'.com_convertEOL($remarks).'<br>';
                            }
                            if ($remarks_pay != ''){
                                echo '<br>'.com_convertEOL($remarks_pay).'<br>';
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
</center>

<p class="c">
<input type="button" value="更新" onclick="return regist_agreement_10504('e',<?php echo $cr_id; ?>);">
<input type="button" value="Excelへ出力" onclick="return excel_out_10504(<?php echo $cr_id; ?>);">
<input type="button" value="一覧に戻る" onclick="location.href='./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10500']; ?>'">
</p>

</form>

</section>

<?php
require_once('./footer.php');
?>

<script src="./js/hal-kanri-10500.js"></script>
