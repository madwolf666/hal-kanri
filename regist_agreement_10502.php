<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./global.php');

$a_sRet = '';

//POST情報取得
$a_act = $_POST['act'];
$a_cr_id = $_POST['no'];
$a_isExists = false;

try{
    //DBからユーザ情報取得
    $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
    $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //レコードが存在するかチェック
    $a_sql = "SELECT * FROM ".$GLOBALS['g_DB_t_agreement_ledger']." WHERE (cr_id=:cr_id);";
    $a_stmt = $a_conn->prepare($a_sql);
    $a_stmt->bindParam(':cr_id', $a_cr_id,PDO::PARAM_STR);
    $a_stmt->execute();

    while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
        $a_isExists = true;
    }

    if ($a_isExists == false){
        $a_sql = "INSERT INTO ".$GLOBALS['g_DB_t_agreement_ledger']." (";
        $a_sql .= "
            cr_id
            ,ag_no
            ,person_birthday
            ,person_post_no
            ,person_address
            ,reg_id
            ,reg_date
            ";
        $a_sql .= ") VALUES(";
        $a_sql .= "
            :cr_id
            ,:ag_no
            ,:person_birthday
            ,:person_post_no
            ,:person_address
            ,:reg_id
            ,:reg_date
            ";
        $a_sql .= ");";
    }else{
        $a_sql = "UPDATE ".$GLOBALS['g_DB_t_agreement_ledger']." SET ";
        $a_sql .= "
            ag_no=:ag_no
            ,person_birthday=:person_birthday
            ,person_post_no=:person_post_no
            ,person_address=:person_address
            ,upd_id=:upd_id
            ,upd_date=:upd_date
            ";
        $a_sql .= " WHERE (cr_id=:cr_id);";
    }
    
    $a_stmt = $a_conn->prepare($a_sql);

    $a_stmt->bindParam(':cr_id', $a_cr_id, PDO::PARAM_STR);
    $a_stmt->bindParam(':ag_no', $_POST['ag_no'], PDO::PARAM_STR);
    com_pdo_bindValue($a_stmt, ':person_birthday', $_POST['person_birthday']);
    $a_stmt->bindParam(':person_post_no', $_POST['person_post_no'], PDO::PARAM_STR);
    $a_stmt->bindParam(':person_address', $_POST['person_address'], PDO::PARAM_STR);

    if ($a_isExists == false) {
        com_pdo_bindValue($a_stmt, ':reg_id', $_SESSION['hal_idx']);
        com_pdo_bindValue($a_stmt, ':reg_date', date("Y/m/d"));
    } else {
        com_pdo_bindValue($a_stmt, ':upd_id', $_SESSION['hal_idx']);
        com_pdo_bindValue($a_stmt, ':upd_date', date("Y/m/d"));
    }

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
