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
        //DBからユーザ情報取得
        $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
        $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $a_sql = "SELECT * FROM ".$GLOBALS['g_DB_m_user'];
        $a_sql .= " WHERE (idx=:idx);";
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

<link rel="stylesheet" href="css/hal-kanri-common.css">

<section>
    
<h2>ユーザ情報</h2>

<center>
<form action="" method="post">
    <table class='tbl_list'>
        <tr>
            <td class='td_titlee'><font color='#ffffff'>部署</font></td>
            <td class='td_line'><input type='text' size='36' maxlength='100' id='txt_branch' value='<?php if ($a_act == 'e'){echo $a_result['branch'];} ?>'>
            </td>
        </tr>
        <tr>
            <td class='td_titlee'><font color='#ffffff'>名前</font></td>
            <td class='td_line'><input type='text' size='36' maxlength='100' id='txt_person' value='<?php if ($a_act == 'e'){echo $a_result['person'];} ?>'>
            </td>
        </tr>
        <tr>
            <td class='td_titlee'><font color='#ffffff'>権限</font></td>
            <td class='td_line'>
                <select name='cmb_auth'>
                    <option value='0' <?php if ($a_act == 'e'){if ($a_result['auth']==0){echo 'selected';}} ?>>特権</option>
                    <option value='1' <?php if ($a_act == 'e'){if ($a_result['auth']==1){echo 'selected';}} ?>>ユーザ１</option>
                    <option value='2' <?php if ($a_act == 'e'){if ($a_result['auth']==2){echo 'selected';}} ?>>ユーザ２</option>
                    <option value='3' <?php if ($a_act == 'e'){if ($a_result['auth']==3){echo 'selected';}} ?>>ユーザ３</option>
                </select>
            </td>
        </tr>
        <tr>
            <td class='td_titlee'><font color='#ffffff'>パスワード</font></td>
            <td class='td_line'><input type='text' size='36' maxlength='16' id='txt_pass' value='<?php if ($a_act == 'e'){echo $a_result['pass'];} ?>'>
            </td>
        </tr>
    </table>
    <br>
    
<p class="c">
<?php if ($a_act == 'e'){ ?>
    <input type="button" value="更新" onclick="check_m_user_input(<?php echo $_GET['IDX']; ?>);">
    <input type="button" value="削除" onclick="delete_m_user(<?php echo $_GET['IDX']; ?>);">
<?php } else { ?>
<input type="button" value="登録" onclick="check_m_user_input(-1);">
<?php } ?>
<input type="button" value="一覧に戻る" onclick="location.href='./index.php?mnu=<?php echo $GLOBALS['g_MENU_MAINTENANCE_90100']; ?>'">
</p>

</form>

<div id="my-result" style="z-index:100; text-align:center; width:auto; color: #ff0000;"></div>
<center>

</section>

<?php
require_once('./footer.php');
?>

<script src="./js/hal-kanri-90100.js"></script>
