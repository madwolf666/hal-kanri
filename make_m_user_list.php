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

    $a_sql = "SELECT";
    $a_sql .= " t1.*";
    $a_sql .= ",(SELECT m_name FROM m_base WHERE (idx=t1.base_cd)) AS base_name";
    $a_sql .= ",(SELECT m_name FROM m_department WHERE (idx=t1.department_cd)) AS department_name";
    $a_sql .= " FROM ".$GLOBALS['g_DB_m_user']." t1 WHERE (base_cd>=0) ORDER BY idx;";
    $a_stmt = $a_conn->prepare($a_sql);
    //$a_stmt->bindParam(':pass', $a_pass,PDO::PARAM_STR);
    $a_stmt->execute();

    $a_rec = 0;
    $a_sRet = "<table class='tbl_list'>";
    //ヘッダ部
    $a_sRet .= "<tr class='tr_title'>";
    $a_sRet .= "<td class='td_title'><font color='#ffffff'>No</font></td>";
    $a_sRet .= "<td class='td_title'><font color='#ffffff'>拠点</font></td>";
    $a_sRet .= "<td class='td_title'><font color='#ffffff'>部署</font></td>";
    $a_sRet .= "<td class='td_title'><font color='#ffffff'>名前</font></td>";
    $a_sRet .= "</tr>";

    while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
        $a_rec++;

        if (($a_rec % 2)==0){
            $a_sRet .= "<tr class='linee'>";
        }else{
            $a_sRet .= "<tr class='lineo'>";
        }
        $a_sRet .= "<td class='td_line'>".$a_rec."</td>";
        $a_sRet .= "<td class='td_line'>".$a_result['base_name']."</td>";
        $a_sRet .= "<td class='td_line'>".$a_result['department_name']."</td>";
        $a_sRet .= "<td class='td_line'><a href='./index.php?mnu=".$GLOBALS['g_MENU_MAINTENANCE_90103']."&ACT=e&IDX=".$a_result['idx']."'>".$a_result['person']."</a></td>";
        
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
