<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./global.php');

$a_sRet = '';

//POST情報取得
$a_my_id = $_POST['my_id']; #[2017.12.13]要望
$a_cr_id = $_POST['cr_id'];
$a_ed_id = $_POST['ed_id'];

try{
    //DBからユーザ情報取得
    $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
    $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $a_conn->beginTransaction();  //トランザクション開始

    $a_sql = "SELECT * FROM ";
    #[2017.12.13]要望
    if ($a_my_id == 'my-evidence'){
        $a_sql .= $GLOBALS['g_DB_t_evidence'];
    }else if ($a_my_id == 'my-payroll'){
        $a_sql .= $GLOBALS['g_DB_t_payroll_file'];
    }
    $a_sql .= " WHERE (cr_id=:cr_id) AND (ed_id=:ed_id);";
    $a_stmt = $a_conn->prepare($a_sql);
    com_pdo_bindValue($a_stmt, ':cr_id', $a_cr_id);
    com_pdo_bindValue($a_stmt, ':ed_id', $a_ed_id);
    $a_stmt->execute();

    $a_sRet = "";

    while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
        $a_name_sys = $a_result['file_name_sys'];
    }

    $a_sql = "DELETE FROM ";
    #[2017.12.13]要望
    if ($a_my_id == 'my-evidence'){
        $a_sql .= $GLOBALS['g_DB_t_evidence'];
    }else if ($a_my_id == 'my-payroll'){
        $a_sql .= $GLOBALS['g_DB_t_payroll_file'];
    }
    $a_sql .= " WHERE (cr_id=:cr_id) AND (ed_id=:ed_id);";
    $a_stmt = $a_conn->prepare($a_sql);
    com_pdo_bindValue($a_stmt, ':cr_id', $a_cr_id);
    com_pdo_bindValue($a_stmt, ':ed_id', $a_ed_id);
    $a_stmt->execute();

    //ファイルを削除
    #[2017.12.13]要望
    if ($a_my_id == 'my-evidence'){
        unlink($GLOBALS['g_EVIDENCE_PATH'].$a_cr_id."/".$a_name_sys);
    }else if ($a_my_id == 'my-payroll'){
        unlink($GLOBALS['g_PAYROLL_PATH'].$a_cr_id."/".$a_name_sys);
    }

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
