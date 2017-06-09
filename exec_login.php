<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./global.php');

$a_sRet = '';

//POST情報取得
$a_pass = $_POST['pass'];
$a_remember = $_POST['remember'];
//$a_pass = 'hitoshi999';

setcookie('hal_remember', $a_remember, time() + 60 * 60 * 24 * 14);

try{
    //DBからユーザ情報取得
    $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
    $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $a_sql = "SELECT t1.*";
    $a_sql .= ",(SELECT m_name FROM m_base WHERE (idx=t1.base_cd)) AS base_name";
    $a_sql .= ",(SELECT m_name FROM m_department WHERE (idx=t1.department_cd)) AS department_name";
    $a_sql .= ",(SELECT auth FROM m_department WHERE (idx=t1.department_cd)) AS auth";
    $a_sql .= " FROM ".$GLOBALS['g_DB_m_user']." t1";
    $a_sql .= " WHERE (pass=:pass);";
    $a_stmt = $a_conn->prepare($a_sql);
    $a_stmt->bindParam(':pass', $a_pass,PDO::PARAM_STR);
    $a_stmt->execute();

    while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
        //print($a_result['branch']);
        //print($a_result['person']);

        //認証OKの場合は、セッション変数にパスワードを保存する。
        $_SESSION["hal_idx"] = $a_result['idx'];
        $_SESSION["hal_base_cd"] = $a_result['base_cd'];
        $_SESSION["hal_department_cd"] = $a_result['department_cd'];
        $_SESSION["hal_person"] = $a_result['person'];
        $_SESSION["hal_auth"] = $a_result['auth'];
        $_SESSION["hal_base_name"] = $a_result['base_name'];
        $_SESSION["hal_department_name"] = $a_result['department_name'];

        //cookie
        if ($a_remember == 'true'){
            //cookieに保存
            setcookie('hal_idx', $a_result['idx'], time() + 60 * 60 * 24 * 14);
            setcookie('hal_base_cd', $a_result['base_cd'], time() + 60 * 60 * 24 * 14);
            setcookie('hal_department_cd', $a_result['department_cd'], time() + 60 * 60 * 24 * 14);
            setcookie('hal_person', $a_result['person'], time() + 60 * 60 * 24 * 14);
            setcookie('hal_auth', $a_result['auth'], time() + 60 * 60 * 24 * 14);
            setcookie('hal_base_name', $a_result['base_name'], time() + 60 * 60 * 24 * 14);
            setcookie('hal_department_name', $a_result['department_name'], time() + 60 * 60 * 24 * 14);
        }else{
            //cookieから削除
            setcookie('hal_idx', '', time() - 1800);
            setcookie('hal_base_cd', '', time() - 1800);
            setcookie('hal_department_cd', '', time() - 1800);
            setcookie('hal_person', '', time() - 1800);
            setcookie('hal_auth', '', time() - 1800);
            setcookie('hal_base_name', '', time() - 1800);
            setcookie('hal_department_name', '', time() - 1800);
        }
        
        $a_sRet = 'OK';
    }
    
    if ($a_sRet != 'OK'){
        $a_sRet = 'パスワードに誤りがあります！';
    }
} catch (PDOException $e){
    $a_sRet = 'Error:'.$e->getMessage();
    //print('Error:'.$e->getMessage());
    //die();
}
$a_conn = null;

echo $a_sRet;

?>
