<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./global.php');

//POSTデータを取得
$a_PageNo = $_POST['PageNo'];

try{
    //DBからユーザ情報取得
    $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
    $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $a_sql = "SELECT t1.*";
    $a_sql .= ",(SELECT person FROM ".$GLOBALS['g_DB_m_user']." WHERE (idx=t1.reg_id)) AS reg_person";
    $a_sql .= ",(SELECT person FROM ".$GLOBALS['g_DB_m_user']." WHERE (idx=t1.upd_id)) AS upd_person";
    $a_sql .= " FROM ".$GLOBALS['g_DB_m_information']." t1";
    $a_sql .= " ORDER BY publication DESC,idx DESC;";
    $a_stmt = $a_conn->prepare($a_sql);
    //$a_stmt->bindParam(':pass', $a_pass,PDO::PARAM_STR);
    $a_stmt->execute();

    $a_rec = 0;
    $a_sRet = "<dl id='newinfo'>";

    while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
        $a_rec++;

        $a_date_now = strtotime("now");
        $a_date_src = strtotime($a_result['publication']);
        $a_diff = com_time_diff($a_date_src, $a_date_now, "d");
        
        $a_sRet .= "<dt>".com_replace_toDate($a_result['publication'])."</dt>";
        $a_sRet .= "<dd>";
        $a_sRet .= $a_result['information'];
        if ($a_diff <= 7){
            $a_sRet .= "<span class='newicon'>NEW</span>";
        }
        $a_sRet .= "<br>by&nbsp;&nbsp;";
        if ($a_result['upd_person'] != ''){
            $a_sRet .= $a_result['upd_person'];
        }else{
            $a_sRet .= $a_result['reg_person'];
        }
        $a_sRet .= "</dd>";
        
    }
    
    if ($a_rec > 0){
        $a_sRet .= "</dl>";
        #$a_sRet = $a_rec."件<br>".$a_sRet;
    }else{
        $a_sRet = "現在、お知らせはありません。";
    }

} catch (PDOException $e){
    $a_sRet = 'Error:'.$e->getMessage();
}
$a_conn = null;

echo $a_sRet;

?>
