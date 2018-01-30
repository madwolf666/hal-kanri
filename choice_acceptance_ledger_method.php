<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./global.php');

require_once('./10300-com.php');

//POSTデータを取得
$a_cr_id = $_POST['cr_id'];
$a_al_id = $_POST['al_id'];

$a_sRet = "";

try{
    //DBからユーザ情報取得
    $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
    $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $a_sql_src = set_10300_selectDB();

    $a_sql = "SELECT s1.*";
    $a_sql .= " FROM (".$a_sql_src.") s1";
    $a_sql .= " WHERE  (s1.cr_id=:cr_id) AND (s1.al_id=:al_id);";

    $a_stmt = $a_conn->prepare($a_sql);
    com_pdo_bindValue($a_stmt, ':cr_id', $a_cr_id);
    com_pdo_bindValue($a_stmt, ':al_id', $a_al_id);
    $a_stmt->execute();

    while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
        $a_sRet = $a_result['contract_number']." ".$a_result['engineer_number']." ".$a_result['engineer_name']."<br>";
        $a_sRet .= "<table border='0'>";
        $a_sRet .= "<tr>";
        
        #[2018.01.29]課題解決管理表No.87
        $a_sRet .= "<td>";
        if ($_SESSION['contract_del'] != 1){
            $a_sRet .= "●<a href='./index.php?mnu=".$GLOBALS['g_MENU_CONTRACT_10310']."&NO=".$a_result['cr_id']."&SN=".$a_al_id."'>行を追加</a>";
        }else{
            $a_sRet .= "&nbsp;&nbsp;";
        }
        $a_sRet .= "</td>";

        $a_sRet .= "<td>&nbsp;&nbsp;</td>";
        
        #[2018.01.29]課題解決管理表No.87
        $a_sRet .= "<td>";
        if ($_SESSION['contract_del'] != 1){
            $a_sRet .= "●<a href='./index.php?mnu=".$GLOBALS['g_MENU_CONTRACT_10311']."&NO=".$a_result['cr_id']."&SN=".$a_al_id."'>現在行を削除</a></a>";
        }else{
            $a_sRet .= "&nbsp;&nbsp;";
        }
        $a_sRet .= "</td>";
        
        $a_sRet .= "</tr>";
        $a_sRet .= "<tr>";
        $a_sRet .= "<td>●<a href='#' onclick='return excel_out_10301(\"".$a_result['customer_name']."\",\"".$a_result['accounts_bai_previous_day']."\");'>請求書出力</a></td>";
        $a_sRet .= "<td>&nbsp;&nbsp;</td>";
        $a_sRet .= "<td>●<a href='./index.php?mnu=".$GLOBALS['g_MENU_CONTRACT_SHOW_CHART']."&BAK=".$GLOBALS['g_MENU_CONTRACT_10300']."&NO=".$a_result['cr_id']."&SN=".$a_al_id."'>グラフを表示</a></td>";
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
