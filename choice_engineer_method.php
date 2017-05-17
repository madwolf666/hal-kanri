<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./global.php');

//POSTデータを取得
$a_entry_no = $_POST['entry_no'];

$a_sRet = "";

try{
    //DBからユーザ情報取得
    $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
    $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $a_sql = "SELECT * FROM ".$GLOBALS['g_DB_m_engineer']." WHERE (entry_no=:entry_no);";
    $a_stmt = $a_conn->prepare($a_sql);
    $a_stmt->bindParam(':entry_no', $a_entry_no,PDO::PARAM_STR);
    $a_stmt->execute();

    while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
        $a_sRet = $a_result['entry_no']." ".$a_result['last_name']." ".$a_result['first_name']."<br>";
        $a_sRet .= "<table border=0'>";
        $a_sRet .= "<tr>";
        $a_sRet .= "<td>●<a href='#' onclick=''>契約管理一覧へ</a></td>";
        $a_sRet .= "<td>&nbsp;&nbsp;</td>";
        $a_sRet .= "<td>●<a href='./index.php?mnu=".$GLOBALS['g_MENU_CONTRACT_10102']."&ACT=n&ENO=".$a_result['entry_no']."'>新規契約レポート作成へ</a></td>";
        $a_sRet .= "</tr>";
        $a_sRet .= "<tr>";
        $a_sRet .= "<td>●<a href='#' onclick=''>給与台帳へ</a></td>";
        $a_sRet .= "<td>&nbsp;&nbsp;</td>";
        $a_sRet .= "<td>&nbsp;&nbsp;</td>";
        $a_sRet .= "</tr>";
        $a_sRet .= "<tr>";
        $a_sRet .= "<td>●<a href='#' onclick=''>検収台帳へ</a></td>";
        $a_sRet .= "<td>&nbsp;&nbsp;</td>";
        $a_sRet .= "<td>&nbsp;&nbsp;</td>";
        $a_sRet .= "</tr>";
        $a_sRet .= "<tr>";
        $a_sRet .= "<td>●<a href='#' onclick=''>注文書台帳へ</a></td>";
        $a_sRet .= "<td>&nbsp;&nbsp;</td>";
        $a_sRet .= "<td>&nbsp;&nbsp;</td>";
        $a_sRet .= "</tr>";
        $a_sRet .= "<tr>";
        $a_sRet .= "<td>●<a href='#' onclick=''>契約書台帳へ</a></td>";
        $a_sRet .= "<td>&nbsp;&nbsp;</td>";
        $a_sRet .= "<td>&nbsp;&nbsp;</td>";
        $a_sRet .= "</tr>";
        $a_sRet .= "<tr>";
        $a_sRet .= "<td>●<a href='#' onclick=''>派遣元台帳へ</a></td>";
        $a_sRet .= "<td>&nbsp;&nbsp;</td>";
        $a_sRet .= "<td>&nbsp;&nbsp;</td>";
        $a_sRet .= "</tr>";
        $a_sRet .= "</table>";
        $a_sRet .= "<br>";
        $a_sRet .= "<center><a href='#' onclick='hide_popup();'>閉じる</a></center>";

    }
} catch (PDOException $e){
    //$a_sRet = 'Error:'.$e->getMessage();
}
$a_conn = null;

echo $a_sRet;

?>
