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

$base_cd = "";
$department_cd = "";
$person = "";
$pass = "";
$email_addr = "";   #[2017.11.21]要望

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
        
        $base_cd = $a_result['base_cd'];
        $department_cd = $a_result['department_cd'];
        $person = $a_result['person'];
        $pass = $a_result['pass'];
        $email_addr = $a_result['email_addr'];   #[2017.11.21]要望

    } catch (PDOException $e){
        echo 'Error:'.$e->getMessage();
        die();
    }
}

$a_selected = false;

?>

<link rel="stylesheet" href="css/hal-kanri-common.css">

<section>
    
<h2>ユーザ情報</h2>

<center>
<form action="" method="post">
    <table class='tbl_list'>
        <tr>
            <td class='td_titlee'><font color='#ffffff'>拠点</font></td>
            <td class='td_line'>
                <?php
                echo com_make_tag_option2($a_act, $base_cd, "base_cd", $GLOBALS['g_DB_m_base'], "", $a_selected);
                ?>
            </td>
        </tr>
        <tr>
            <td class='td_titlee'><font color='#ffffff'>部署</font></td>
            <td class='td_line'>
                <?php
                echo com_make_tag_option2($a_act, $department_cd, "department_cd", $GLOBALS['g_DB_m_department'], "", $a_selected);
                ?>
            </td>
        </tr>
        <tr>
            <td class='td_titlee'><font color='#ffffff'>名前</font></td>
            <td class='td_line'>
                <?php
                echo com_make_tag_input($a_act, $person, "person", "width: 260px; text-align: left;");
                ?>
            </td>
        </tr>
        <tr>
            <td class='td_titlee'><font color='#ffffff'>パスワード</font></td>
            <td class='td_line'>
                <?php
                echo com_make_tag_input($a_act, $pass, "pass", "width: 260px; text-align: left;");
                ?>
            </td>
        </tr>
        <tr>
            <td class='td_titlee'><font color='#ffffff'>メールアドレス</font></td>
            <td class='td_line'>
                <?php
                echo com_make_tag_input($a_act, $email_addr, "email_addr", "width: 260px; text-align: left;");
                ?>
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
