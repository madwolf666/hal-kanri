<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require_once('./header.php');

if (!isset($_GET['ACT'])){
    $a_act = 'n';
}else{
    $a_act = $_GET['ACT'];
}

if ($a_act == 'e'){
    try{
        //DBからお知らせ情報取得
        $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
        $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $a_sql = "SELECT t1.*";
        $a_sql .= ",(SELECT person FROM ".$GLOBALS['g_DB_m_user']." WHERE (idx=t1.reg_id)) AS reg_person";
        $a_sql .= ",(SELECT person FROM ".$GLOBALS['g_DB_m_user']." WHERE (idx=t1.upd_id)) AS upd_person";
        $a_sql .= " FROM ".$GLOBALS['g_DB_m_information']." t1";
        $a_sql .= " WHERE (t1.idx=:idx);";
        $a_stmt = $a_conn->prepare($a_sql);
        $a_stmt->bindParam(':idx', $_GET['IDX'],PDO::PARAM_INT);
        $a_stmt->execute();

        $a_result = $a_stmt->fetch(PDO::FETCH_ASSOC);
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

<link rel="stylesheet" href="css/hal-kanri-common.css">

<section>
    
<h2>お知らせ情報</h2>

<center>
<form action="" method="post">
    <table class='tbl_list'>
        <tr>
            <td class='td_titlee'><font color='#ffffff'>日付</font></td>
            <td class='td_line'><input type='text' size='36' maxlength='100' id='publication' value='<?php if ($a_act == 'e'){echo com_replace_toDate($a_result['publication']);} ?>'>
            </td>
        </tr>
        <tr>
            <td class='td_titlee'><font color='#ffffff'>お知らせ</font></td>
            <td class='td_line'>
                <textarea size='36' rows='10' cols='80' id='information'><?php if ($a_act == 'e'){echo $a_result['information'];} ?></textarea>
            </td>
        </tr>
        <tr>
            <td class='td_titlee'><font color='#ffffff'>登録ユーザ</font></td>
            <td class='td_line'>
                <?php if ($a_act == 'e'){echo $a_result['reg_person'];} ?>
            </td>
        </tr>
        <tr>
            <td class='td_titlee'><font color='#ffffff'>更新ユーザ</font></td>
            <td class='td_line'>
                <?php if ($a_act == 'e'){echo $a_result['upd_person'];} ?>
            </td>
        </tr>
    </table>
    <br>
    
<p class="c">
<?php if ($a_act == 'e'){ ?>
    <input type="button" value="更新" onclick="check_m_information_input(<?php echo $_GET['IDX']; ?>);">
    <input type="button" value="削除" onclick="delete_m_information(<?php echo $_GET['IDX']; ?>);">
<?php } else { ?>
<input type="button" value="登録" onclick="check_m_information_input(-1);">
<?php } ?>
<input type="button" value="一覧に戻る" onclick="location.href='./index.php?mnu=<?php echo $GLOBALS['g_MENU_MAINTENANCE_90300']; ?>'">
</p>

</form>

<div id="my-result" style="z-index:100; text-align:center; width:auto; color: #ff0000;"></div>
<center>

</section>

<?php
require_once('./footer.php');
?>

<script src="./js/hal-kanri-90300.js"></script>
