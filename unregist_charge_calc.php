<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./global.php');

$a_sRet = '';

//POST情報取得
//$a_act = $_POST['act'];
$a_cc_id = $_POST['no'];
$a_engineer_no = $_POST['eno'];
$a_start_day = $_POST['sd'];
$a_end_day = $_POST['ed'];
$a_isExists = false;

try{
    //DBからユーザ情報取得
    $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
    $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $a_conn->beginTransaction();  //トランザクション開始

    $a_sql = "DELETE FROM ".$GLOBALS['g_DB_t_charge_calc']." WHERE (cc_id=:cc_id);";
    $a_stmt = $a_conn->prepare($a_sql);
    com_pdo_bindValue($a_stmt, ':cc_id', $a_cc_id);
    $a_stmt->execute();
    
    $a_sql = "DELETE FROM ".$GLOBALS['g_DB_t_time_table']." WHERE (engineer_no=:engineer_no)";
    $a_sql .= " AND (work_day>=:work_day_start) AND (work_day<=:work_day_end);";
    $a_stmt = $a_conn->prepare($a_sql);
    $a_stmt->bindParam(':engineer_no', $a_engineer_no,PDO::PARAM_STR);
    com_pdo_bindValue($a_stmt, ':work_day_start', $a_start_day);
    com_pdo_bindValue($a_stmt, ':work_day_end', $a_end_day);
    $a_stmt->execute();
    
    $a_conn->commit();
    
    $a_sRet = 'OK';
    //$a_sRet .= "--->".$inp_tankin_b1;
    
} catch (PDOException $e){
    $a_conn->rollBack();
    $a_sRet = 'Error:'.$e->getMessage();
    //print('Error:'.$e->getMessage());
    //die();
}
$a_conn = null;

echo $a_sRet;

?>
