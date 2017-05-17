<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./global.php');

//POSTデータを取得
$a_cr_id = $_POST['cr_id'];
$a_kind = $_POST['kind'];
$a_field = $_POST['field'];
$a_val = $_POST['val'];

$a_sRet = "";

try{
    //DBからユーザ情報取得
    $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
    $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $a_sql = "SELECT ".$a_field." FROM ".$GLOBALS['g_DB_t_contract_estimate']." WHERE (cr_id=:cr_id);";
    $a_stmt = $a_conn->prepare($a_sql);
    $a_stmt->bindParam(':cr_id', $a_cr_id,PDO::PARAM_STR);
    $a_stmt->execute();

    while($a_result = $a_stmt->fetch(PDO::FETCH_NUM)){
        switch ($a_kind){
            case 2: //日付
                $a_tmp = com_replace_toDate($a_result[0]);
                if ($a_tmp == $a_val) {
                    $a_sRet = "OK";
                } else {
                    $a_sRet = "NG";
                }
                break;
            case 3: //時間
                $a_tmp1 = explode(":", $a_val);
                $a_tmp2 = explode(":", $a_result[0]);
                if ((intval($a_tmp1[0]) == intval($a_tmp2[0])) && (intval($a_tmp1[1]) == intval($a_tmp2[1]))) {
                    $a_sRet = "OK";
                } else {
                    $a_sRet = "NG";
                }
                break;
            default:
                if ($a_result[0] == $a_val) {
                    $a_sRet = "OK";
                } else {
                    $a_sRet = "NG";
                }
                break;
        }
    }
} catch (PDOException $e){
    $a_sRet = 'Error:'.$e->getMessage();
}
$a_conn = null;

echo $a_sRet;

?>
