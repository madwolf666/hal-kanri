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
        $a_sql = "INSERT INTO ".$GLOBALS['g_DB_m_user']." (branch, person, pass, auth) VALUES(:branch, :person, :pass, :auth);";
    }else{
        $a_sql = "UPDATE ".$GLOBALS['g_DB_m_user']." SET";
        $a_sql .= " branch=:branch";
        $a_sql .= ",person=:person";
        $a_sql .= ",pass=:pass";
        $a_sql .= ",auth=:auth";
        $a_sql .= " WHERE (idx=:idx);";
    }
    $a_stmt = $a_conn->prepare($a_sql);
    $a_stmt->bindParam(':branch', $_POST['txt_branch'], PDO::PARAM_STR);
    $a_stmt->bindParam(':person', $_POST['txt_person'], PDO::PARAM_STR);
    $a_stmt->bindParam(':pass', $_POST['txt_pass'], PDO::PARAM_STR);
    $a_stmt->bindParam(':auth', $_POST['cmb_auth'], PDO::PARAM_INT);
    if ($_POST['idx'] != -1){
        $a_stmt->bindParam(':idx', $_POST['idx'], PDO::PARAM_INT);
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
