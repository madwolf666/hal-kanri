<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./global.php');

$a_sRet = '';

//POST情報取得

try{
    //DBからユーザ情報取得
    $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
    $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_POST['idx'] == -1){
        $a_sql = "INSERT INTO ".$GLOBALS['g_DB_m_information']." (publication, information, reg_id, reg_date) VALUES(:publication, :information, :reg_id, :reg_date);";
    }else{
        $a_sql = "UPDATE ".$GLOBALS['g_DB_m_information']." SET";
        $a_sql .= " publication=:publication";
        $a_sql .= ",information=:information";
        $a_sql .= ",upd_id=:upd_id";
        $a_sql .= ",upd_date=:upd_date";
        $a_sql .= " WHERE (idx=:idx);";
    }
    $a_stmt = $a_conn->prepare($a_sql);
    com_pdo_bindValue($a_stmt, ':publication', $_POST['publication']);
    $a_stmt->bindParam(':information', $_POST['information'], PDO::PARAM_STR);
    if ($_POST['idx'] != -1){
        com_pdo_bindValue($a_stmt, ':upd_id', $_SESSION['hal_idx']);
        com_pdo_bindValue($a_stmt, ':upd_date', date("Y/m/d"));
        $a_stmt->bindParam(':idx', $_POST['idx'], PDO::PARAM_INT);
    }else{
        com_pdo_bindValue($a_stmt, ':reg_id', $_SESSION['hal_idx']);
        com_pdo_bindValue($a_stmt, ':reg_date', date("Y/m/d"));
    }
    $a_stmt->execute();

    $a_sRet = 'OK';
    
} catch (PDOException $e){
    $a_sRet = 'Error:'.$e->getMessage();
    //print('Error:'.$e->getMessage());
    //die();
}
$a_conn = null;

echo $a_sRet;

?>
