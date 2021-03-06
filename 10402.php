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

require_once('./10400-com.php');

if (isset($_GET['NO'])) {
    $a_no = $_GET['NO'];
    try{
        //DBからユーザ情報取得
        $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
        $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $a_sql = set_10400_selectDB();

        $a_sql .= " WHERE (t1.cr_id=:cr_id);";

        $a_stmt = $a_conn->prepare($a_sql);
        $a_stmt->bindParam(':cr_id', $a_no, PDO::PARAM_STR);
        $a_stmt->execute();

        while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
            set_10400_fromDB($a_result);
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

<link rel="stylesheet" href="css/hal-kanri-10402.css">

<section>
    
<h2>注文書台帳<?php if($_SESSION['contract_del'] == 1){echo '(削除済)';} ?></h2>
<h3>注文書<?php if($_SESSION['contract_del'] == 1){echo '(削除済)';} ?></h3>

<form action="index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10400']; ?>" method="post">
<center>
    <br>
    <font size="+2"><B>注文書</B></font>
    <br>
    <br>
    <div>
        <div style="float: left"><u><B>&nbsp;&nbsp;株式会社GOOYA&nbsp;&nbsp;</B>&nbsp;&nbsp;&nbsp;&nbsp;御中</u></div>
        <div style="text-align: left; margin-left:auto; width:300px;"><u>発&nbsp;&nbsp;&nbsp;行&nbsp;&nbsp;&nbsp;日&nbsp;&nbsp;
            <?php
                if ($a_act == '') {
                    echo $publication;
                } else {
                    echo com_make_tag_input($a_act, $publication, "publication", "width: 100px; text-align: center;");
                }
            ?>
            </u></div>
        <div style="text-align: left; margin-left:auto; width:300px;"><u>注文書番号&nbsp;&nbsp;
            <?php echo $ag_no; ?>
        </u></div>
        <div style="text-align: left; margin-left:auto; width:300px;">株式会社&nbsp;H A L</div>
        <div style="text-align: left; margin-left:auto; width:300px;">代表取締役&nbsp;&nbsp;寺&nbsp;西&nbsp;信&nbsp;夫</div>
        <div style="text-align: left; margin-left:auto; width:300px;"><font size="-2">東京都渋谷区広尾1-1-39&nbsp;恵比寿プライムスクエアタワー18F</font></div>
        <div style="text-align: left; margin-left:auto; width:300px;"><font size="-1">　TEL 03-6712-5027  FAX  03-6712-5029</font></div>
    </div>
    <br>
    <div>
	<div style="float: left">以下の通り、ご注文申し上げます。</div>
	<br>
	<table border="1" rules="all">
            <tr>
                <th colspan="4">契&nbsp;約&nbsp;形&nbsp;態</th>
                <td colspan="9" class="remarks"><?php echo $claim_contract_form; ?></td>
            </tr>
            <tr>
                <th colspan="2" rowspan="2">契約期間</th>
                <td colspan="2">開&nbsp;始&nbsp;日</td>
                <td colspan="9" class="remarks"><?php echo $claim_agreement_start; ?></td>
            </tr>
            <tr>
                <td colspan="2">終&nbsp;了&nbsp;日</td>
                <td colspan="9" class="remarks"><?php echo $claim_agreement_end; ?></td>
            </tr>
            <tr>
                <th colspan="4">技&nbsp;術&nbsp;者&nbsp;氏&nbsp;名</th>
                <td colspan="9" class="remarks"><?php echo $engineer_name; ?></td>
            </tr>
            <tr>
                <th colspan="4" rowspan="2">作&nbsp;業&nbsp;料&nbsp;金<br>(外税)</th>
                <td colspan="3" rowspan="2"><font size="-1">※小数点以下が発生する場合は<br>切捨てとする。</font><br><?php echo $payment_normal_unit_price_1; ?>&nbsp;／
                    <?php if ($payment_normal_calculation_1 != '時給'){ ?>
                    月
                    <?php }else{ ?>
                    時間
                    <?php } ?>
                </td>
                <td colspan="3">&nbsp;</td>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3">&nbsp;</td>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <th colspan="4">計&nbsp;算&nbsp;方&nbsp;法</th>
                <td colspan="3"><?php echo $payment_normal_calculation_1; ?></td>
                <td colspan="3">&nbsp;</td>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <th colspan="2" rowspan="2">基準時間</th>
                <td colspan="2">下限時間</td>
                <td colspan="3"><?php echo $payment_normal_lower_limit_1; ?></td>
                <td colspan="3">&nbsp;</td>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">上限時間</td>
                <td colspan="3"><?php echo $payment_normal_upper_limit_1; ?></td>
                <td colspan="3">&nbsp;</td>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <th colspan="2" rowspan="2">清算単価</th>
                <td colspan="2">控除単価</td>
                <td colspan="3"><?php echo $payment_normal_deduction_unit_price_1; ?>
                    <?php if ($payment_normal_calculation_1 != '時給'){ ?>
                    &nbsp;／&nbsp;H
                    <?php } ?>
                </td>
                <td colspan="3">&nbsp;</td>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">残業単価</td>
                <td colspan="3"><?php echo $payment_normal_overtime_unit_price_1; ?>
                    <?php if ($payment_normal_calculation_1 != '時給'){ ?>
                    &nbsp;／&nbsp;H</td>
                    <?php } ?>
                <td colspan="3">&nbsp;</td>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <th colspan="4">
                    <?php if ($payment_normal_calculation_1 != '時給'){ ?>
                    時間単価
                    <?php }else{ ?>
                    時間単位
                    <?php } ?>
                </th>
                <td colspan="9">月次：&nbsp;30&nbsp;分</td>
            </tr>
            <tr>
                <th colspan="4">支払サイト</th>
                <td colspan="1">締日：毎月</td>
                <td colspan="3"class="hiddencell_l"><?php echo $payment_settlement_closingday; ?></td>
                <td colspan="1"class="hiddencell_l">／</td>
                <td colspan="2"class="hiddencell_l">支払日：</td>
                <td colspan="2"class="hiddencell_l"><?php echo $payment_settlement_paymentday; ?></td>
            </tr>
            <tr>
                <th colspan="4" height=400px>その他</th>
                <td colspan="9" class="remarks">
                    <?php
                        if ($a_act == ''){
                            echo $remarks1."<br>";
                        }else{
                            echo com_make_tag_textarea($a_act, $remarks1, "remarks1", "width: 96%; height: 90px;");
                        }
                    ?>
                    <?php
                        if ($a_act == ''){
                            echo $remarks2."<br>";
                        }else{
                            echo com_make_tag_textarea($a_act, $remarks2, "remarks2", "width: 96%; height: 90px;");
                        }
                    ?>
                    <?php
                        if ($a_act == ''){
                            echo $remarks3."<br>";
                        }else{
                            echo com_make_tag_textarea($a_act, $remarks3, "remarks3", "width: 96%; height: 90px;");
                        }
                    ?>
                    <?php
                        if ($a_act == ''){
                            echo $remarks4."<br>";
                        }else{
                            echo com_make_tag_textarea($a_act, $remarks4, "remarks4", "width: 96%; height: 90px;");
                        }
                    ?>
                </td>
            </tr>
        </table>
    </div>
</center>

<p class="c">
<?php if ($a_act != ''){ ?>
<input type="button" value="更新" onclick="return regist_purchase_order_10402('e',<?php echo $cr_id; ?>);">
<?php } ?>
<input type="button" value="Excelへ出力" onclick="return excel_out_10402(<?php echo $cr_id; ?>);">
<input type="button" value="一覧に戻る" onclick="location.href='./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10400']; ?>&DEL=<?php echo $_SESSION['contract_del']; ?>'">
</p>

</form>

</section>

<?php
require_once('./footer.php');
?>

<script src="./js/hal-kanri-10400.js"></script>
