<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./global.php');

$a_sRet = '';

//POST情報取得
$a_cr_id = $_POST['cr_id'];
$a_kind = $_POST['kind'];
$a_field = $_POST['field'];
$a_val = $_POST['val'];

try{
    //DBからユーザ情報取得
    $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
    $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $a_sql = "UPDATE ".$GLOBALS['g_DB_t_contract_report']." SET ";
    $a_sql .= $a_field."=:".$a_field;
    $a_sql .= ",upd_id=:upd_id";
    $a_sql .= ",upd_date=:upd_date";
    $a_sql .= " WHERE (cr_id=:cr_id);";
    
    $a_stmt = $a_conn->prepare($a_sql);

    switch ($a_kind){
        case 2: //日付
            com_pdo_bindValue($a_stmt,':'.$a_field, $a_val);
            break;
        case 3: //時間
            break;
        default:
            $a_stmt->bindParam(':'.$a_field, $a_val, PDO::PARAM_STR);
            break;
    }
   
    com_pdo_bindValue($a_stmt, ':upd_id', $_SESSION['hal_idx']);
    com_pdo_bindValue($a_stmt, ':upd_date', date("Y/m/d"));
    com_pdo_bindValue($a_stmt, ':cr_id', $_POST['cr_id']);

    $a_stmt->execute();

    $a_sRet = 'OK';
    //$a_sRet .= "--->".$inp_tankin_b1;
    
} catch (PDOException $e){
    $a_sRet = 'Error:'.$e->getMessage();
    //print('Error:'.$e->getMessage());
    //die();
}
$a_conn = null;

echo $a_sRet;

?>
