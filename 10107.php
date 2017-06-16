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

require_once('./10100-com.php');

$inp_estimate_no = "";
$inp_estimate_date = "";

if (isset($_GET['NO'])) {
    $a_no = $_GET['NO'];
    try{
        //DBからユーザ情報取得
        $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
        $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $a_sql_src = set_10100_selectDB();

        $a_sql = "SELECT s1.*";
        $a_sql .= ",s2.estimate_no,s2.estimate_date";
        $a_sql .= " FROM (".$a_sql_src.") s1 LEFT JOIN ".$GLOBALS['g_DB_t_contract_estimate']." s2";
        $a_sql .= " ON (s1.cr_id=s2.cr_id)";
        $a_sql .= " WHERE (s1.cr_id=:cr_id)";
        #echo $a_sql;
        $a_stmt = $a_conn->prepare($a_sql);
        $a_stmt->bindParam(':cr_id', $a_no, PDO::PARAM_STR);
        $a_stmt->execute();

        while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
            set_10100_fromDB($a_result);

            $inp_estimate_no = $a_result['estimate_no'];
            $inp_estimate_date = str_replace("-", "/", $a_result['estimate_date']);
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

<link rel="stylesheet" href="css/hal-kanri-10107.css">

<section>
    
<h2>契約管理全体</h2>
<h3>見積書</h3>

<form action="index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10100']; ?>" method="post">
<center>
    <div class="width">
	<font size="+2"><B><u>御　見　積　書</u></B></font>
	<br>
	<p style="width:300px; margin-left:auto; text-align:left;">
        <u>見積書No.</u>
            <?php echo com_make_estimate_no($inp_estimate_date, $inp_estimate_no); ?>
            <?php
                /*if ($a_act == '') {
                    echo $inp_estimate_no;
                } else {
                    echo com_make_tag_input($a_act, $inp_estimate_no, "inp_estimate_no", "width: 100px; text-align: center;");
                }*/
            ?>
            <input type="hidden" id="inp_estimate_no" value="<?php echo $inp_estimate_no; ?>">
        <br>
        <u>&nbsp;&nbsp;発行日&nbsp;&nbsp;&nbsp;</u>
            <?php //echo $inp_estimate_date; ?>
            <?php
                if ($a_act == '') {
                    echo $inp_estimate_date;
                } else {
                    echo com_make_tag_input($a_act, $inp_estimate_date, "inp_estimate_date", "width: 100px; text-align: center;");
                }
            ?>
            <input type="hidden" id="old_estimate_date" value="<?php echo $inp_estimate_date; ?>">
         &nbsp;<br>
	</p>
	<p style="width:330px; margin-right:auto; text-align:left;">
        <u><B><?php echo $inp_kyakusaki; ?></B>
	&nbsp;&nbsp;&nbsp;&nbsp;御中</u><br>
	</p>
	<p style="width:300px; margin-left:auto; text-align:left;">
	〒150-0012<br>
	東京都渋谷区広尾1-1-39<br>
	恵比寿プライムスクエアタワー18階<br>
	株式会社　ＨＡＬ<br>
	</p>
    </div>
    <br>
    <table>
        <tr>
            <th><B>契約形態</B></th>
            <td class="remarks" colspan="10"><?php echo $opt_contarct_bill_form; ?></td>
	</tr>
	<tr>
            <th><B>期間</B></th>
            <td colspan="10"><?php echo $inp_kyakusaki_kaishi; ?>　～　<?php echo $inp_kyakusaki_syuryo; ?></td>
        </tr>
        <tr>
            <th><B>技術者名</B></th>
            <td class="remarks" colspan="10"><?php echo $txt_engineer_name; ?></td>
	</tr>
	<tr>
            <th><B>責任者</B></th>
            <td class="remarks" colspan="10"><?php echo $inp_jigyosya_tanto; ?></td>
        </tr>
        <tr>
            <th><B>作業料金<?php if ($opt_contract_calc_b1 == '時給'){echo '（時給）';}else{echo '';} ?></B></th>
            <td colspan="10">
                <div style="float:left;">￥<?php echo number_format($inp_tankin_b1); ?></div>
                <div style="text-align:right;">（消費税別）&nbsp;</div>
            </td>
        </tr>
        <tr>
            <th><B>計算方法</B></th>
                <td class="remarks" colspan="10"><?php echo $opt_contract_calc_b1; ?></td>
            </tr>
<?php if ($opt_contract_calc_b1 != '時給') { ?>
        <tr>
            <th><B>基準時間</B></th>
            <td colspan="10"><?php echo $opt_contract_lower_limit_b1; ?>時間　～　<?php echo $opt_contract_upper_limit_b1; ?>時間</td>
        </tr>
            <th colspan="1"><B>未達控除</B></th>
            <td class="remarks hiddencell_r" colspan="1">￥<?php echo $txt_contract_kojyo_unit_b1; ?></td>
            <td class="remarksR" colspan="9">円／時間&nbsp;&nbsp;&nbsp;&nbsp;（<?php echo $opt_contract_trunc_unit_kojyo; ?>）</td>
	</tr>
	<tr>
            <th colspan="1"><B>残業金額</B></th>
            <td class="remarks hiddencell_r" colspan="1">￥<?php echo $txt_contract_zangyo_unit_b1; ?></td>
            <td class="remarksR" colspan="9">円／時間&nbsp;&nbsp;&nbsp;&nbsp;（<?php echo $opt_contract_trunc_unit_zangyo; ?>）</td>
	</tr>
<?php } ?>
        <tr>
            <th><B>時間切捨て</B></th>
            <td colspan="10">15分未満切捨て</td>
        </tr>
        <tr>
            <th><B>支払いサイト</B></th>
            <td colspan="2"><?php echo $opt_contract_tighten_b; ?></td>
            <td colspan="2" class="hiddencell_l">締め</td>
            <td colspan="1" class="hiddencell_l"><?php echo $opt_contract_bill_pay; ?></td>
            <td colspan="2" class="remarksR hiddencell_l">決済&nbsp;&nbsp;</td>
        </tr>
        <tr>
            <th><B>見積有効期限</B></th>
            <td colspan="10">発行日から30日間</td>
        </tr>
        <tr>
            <th height=400px><B>備考</B></th>
            <td colspan="10" class="remarks"><?php echo nl2br($inp_biko); ?></td>
        </tr>
    </table>
</center>

<input type="hidden" id="cr_id" value="<?php echo $cr_id; ?>">
    
<p class="c">
<input type="button" value="更新" onclick="return regist_contract_estimate('e',<?php echo $cr_id; ?>);">
<input type="button" value="Excelへ出力" onclick="return excel_out_10107(<?php echo $cr_id; ?>);">
<input type="button" value="一覧に戻る" onclick="location.href='./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10100']; ?>'">
</p>

<center>
<div id="my-result" style="z-index:100; text-align:center; width:auto; color: #ff0000;"></div>
</center>

</form>

</section>

<?php
require_once('./footer.php');
?>

<script src="./js/hal-kanri-10100.js"></script>
