<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./global.php');

$a_sRet = 'OK';

//POST情報取得
$a_cr_id = $_POST['cr_id'];

try{
    //DBからユーザ情報取得
    $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
    $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_FILES["file"]["tmp_name"]){
        //$a_cr_id = $_FILES['cr_id'];
        $a_name_src = $_FILES['file']['name'];
        list($a_file_name, $a_file_type) = explode(".", $_FILES['file']['name']);
        $a_name_sys = date("YmdHis").".".$a_file_type;
        $a_file = $GLOBALS['g_EVIDENCE_PATH'].$a_cr_id;
        if (!file_exists($a_file)){
            mkdir($a_file, 0755);
        }
        if (move_uploaded_file($_FILES['file']['tmp_name'], $a_file."/".$a_name_sys)) {
            chmod($a_file."/".$a_name_sys, 0644);
            //var_dump($a_file."/".$a_name_sys);
        }

        $a_sql = "INSERT INTO ".$GLOBALS['g_DB_t_evidence']." (";
        $a_sql .= "
            cr_id
            ,file_name_src
            ,file_name_sys
            ,reg_id
            ,reg_date
            ";
        $a_sql .= ") VALUES(";
        $a_sql .= "
            :cr_id
            ,:file_name_src
            ,:file_name_sys
            ,:reg_id
            ,:reg_date
            );";

        $a_stmt = $a_conn->prepare($a_sql);

        com_pdo_bindValue($a_stmt, ':cr_id', $a_cr_id);
        $a_stmt->bindParam(':file_name_src', $a_name_src, PDO::PARAM_STR);
        $a_stmt->bindParam(':file_name_sys', $a_name_sys, PDO::PARAM_STR);
        com_pdo_bindValue($a_stmt, ':reg_id', $_SESSION['hal_idx']);
        com_pdo_bindValue($a_stmt, ':reg_date', date("Y/m/d"));
    
        $a_stmt->execute();
    }
} catch (PDOException $e){
    $a_sRet = 'Error:'.$e->getMessage();
}
$a_conn = null;

echo $a_sRet;

?>
