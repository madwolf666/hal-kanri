<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./global.php');

//POSTデータを取得
$a_cr_id = $_POST['cr_id'];
$a_al_id = $_POST['al_id'];

$a_sRet = "";

try{
    //DBからユーザ情報取得
    $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
    $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $a_sql = "SELECT * FROM ".$GLOBALS['g_DB_t_contract_report']." WHERE (cr_id=:cr_id);";
    $a_stmt = $a_conn->prepare($a_sql);
    $a_stmt->bindParam(':cr_id', $a_cr_id,PDO::PARAM_STR);
    $a_stmt->execute();

    while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
        $a_sRet = $a_result['contract_number']." ".$a_result['engineer_number']." ".$a_result['engineer_name']."<br>";
        $a_sRet .= "<table border='0'>";
        $a_sRet .= "<tr>";
        $a_sRet .= "<td>●<a href='./index.php?mnu=".$GLOBALS['g_MENU_CONTRACT_10310']."&NO=".$a_result['cr_id']."&SN=".$a_al_id."'>行を追加</a></td>";
        $a_sRet .= "<td>&nbsp;&nbsp;</td>";
        $a_sRet .= "<td>●<a href='./index.php?mnu=".$GLOBALS['g_MENU_CONTRACT_10311']."&NO=".$a_result['cr_id']."&SN=".$a_al_id."'>現在行を削除</a></td>";
        $a_sRet .= "</tr>";
        $a_sRet .= "<tr>";
        $a_sRet .= "<td>●<a href='./index.php?mnu=".$GLOBALS['g_MENU_CONTRACT_SHOW_CHART']."&BAK=".$GLOBALS['g_MENU_CONTRACT_10300']."&NO=".$a_result['cr_id']."&SN=".$a_al_id."'>グラフを表示</a></td>";
        $a_sRet .= "<td>&nbsp;&nbsp;</td>";
        $a_sRet .= "<td>&nbsp;&nbsp;</td>";
        $a_sRet .= "</tr>";
        $a_sRet .= "</table>";
        $a_sRet .= "<br>";
        $a_sRet .= "<div id='chart_div' style='width: 320px; height: 240px; display: block;'></div>";
        $a_sRet .= "<center><a href='#' onclick='hide_popup();'>閉じる</a></center>";

    }
} catch (PDOException $e){
    //$a_sRet = 'Error:'.$e->getMessage();
}
$a_conn = null;

echo $a_sRet;

?>
