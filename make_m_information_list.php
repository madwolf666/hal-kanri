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
    $a_sRet = "<table class='tbl_list'>";
    //ヘッダ部
    $a_sRet .= "<tr class='tr_title'>";
    $a_sRet .= "<td class='td_title' nowrap><font color='#ffffff'>No</font></td>";
    $a_sRet .= "<td class='td_title' nowrap><font color='#ffffff'>日付</font></td>";
    $a_sRet .= "<td class='td_title'><font color='#ffffff'>お知らせ</font></td>";
    $a_sRet .= "<td class='td_title' nowrap><font color='#ffffff'>登録ユーザ</font></td>";
    $a_sRet .= "<td class='td_title' nowrap><font color='#ffffff'>更新ユーザ</font></td>";
    $a_sRet .= "</tr>";

    while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
        $a_rec++;

        if (($a_rec % 2)==0){
            $a_sRet .= "<tr class='linee'>";
        }else{
            $a_sRet .= "<tr class='lineo'>";
        }
        $a_sRet .= "<td class='td_line'>".strval($a_rec)."</td>";
        //$a_sRet .= "<td class='td_line'>".$a_result['idx']."</td>";
        $a_sRet .= "<td class='td_line'><a href='./index.php?mnu=".$GLOBALS['g_MENU_MAINTENANCE_90303']."&ACT=e&IDX=".$a_result['idx']."'>".com_replace_toDate($a_result['publication'])."</a></td>";
        $a_sRet .= "<td class='td_line'>";
        $a_sRet .= com_db_string_format($a_result['information']);  //[2017.11.07]
        $a_sRet .= "</td>";
        $a_sRet .= "<td class='td_line'>";
        $a_sRet .= $a_result['reg_person'];
        $a_sRet .= "</td>";
        $a_sRet .= "<td class='td_line'>";
        $a_sRet .= $a_result['upd_person'];
        $a_sRet .= "</td>";
        
        $a_sRet .= "</tr>";

    }
    
    if ($a_rec > 0){
        $a_sRet .= "</table>";
        $a_sRet = $a_rec."件<br>".$a_sRet;
    }else{
        $a_sRet = "登録データはありません。";
    }

} catch (PDOException $e){
    $a_sRet = 'Error:'.$e->getMessage();
}
$a_conn = null;

echo $a_sRet;

?>
