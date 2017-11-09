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
$a_ed_id = $_POST['ed_id'];

try{
    //DBからユーザ情報取得
    $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
    $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $a_conn->beginTransaction();  //トランザクション開始

    $a_sql = "SELECT * FROM ".$GLOBALS['g_DB_t_evidence']." WHERE (cr_id=:cr_id) AND (ed_id=:ed_id);";
    $a_stmt = $a_conn->prepare($a_sql);
    com_pdo_bindValue($a_stmt, ':cr_id', $a_cr_id);
    com_pdo_bindValue($a_stmt, ':ed_id', $a_ed_id);
    $a_stmt->execute();

    $a_sRet = "";

    while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
        $a_name_sys = $a_result['file_name_sys'];
    }

    $a_sql = "DELETE FROM ".$GLOBALS['g_DB_t_evidence']." WHERE (cr_id=:cr_id) AND (ed_id=:ed_id);";

    $a_stmt = $a_conn->prepare($a_sql);
    com_pdo_bindValue($a_stmt, ':cr_id', $a_cr_id);
    com_pdo_bindValue($a_stmt, ':ed_id', $a_ed_id);
    $a_stmt->execute();

    //ファイルを削除
    unlink($GLOBALS['g_EVIDENCE_PATH'].$a_cr_id."/".$a_name_sys);

    $a_conn->commit();
    
    $a_sRet = 'OK';
    
} catch (PDOException $e){
    $a_conn->rollBack();
    $a_sRet = 'Error:'.$e->getMessage();
    //print('Error:'.$e->getMessage());
    //die();
}
$a_conn = null;

echo $a_sRet;

?>
