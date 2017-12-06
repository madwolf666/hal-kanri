<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./global.php');

#require_once('./90400-com.php');

//POSTデータを取得
$a_cc_id = $_POST['cc_id'];

$a_sRet = "";

try{
    //DBからユーザ情報取得
    $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
    $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    #$a_sql_src = set_10400_selectDB();

    $a_sql_src = "SELECT t1.*,";
    $a_sql_src .= "t2.cc_id,";
    $a_sql_src .= "t2.engineer_no,";
    $a_sql_src .= "t2.calc_day_start_bill,";
    $a_sql_src .= "t2.calc_day_end_bill";
    $a_sql_src .= " FROM ".$GLOBALS['g_DB_t_contract_report']." t1";
    $a_sql_src .= " LEFT JOIN ";
    $a_sql_src .= $GLOBALS['g_DB_t_charge_calc']." t2";
    $a_sql_src .= " ON (t1.cr_id=t2.cr_id)";

    $a_sql = "SELECT s1.*";
    $a_sql .= " FROM (".$a_sql_src.") s1";
    $a_sql .= " WHERE (s1.cc_id=:cc_id);";

    $a_stmt = $a_conn->prepare($a_sql);
    com_pdo_bindValue($a_stmt, ':cc_id', $a_cc_id);
    $a_stmt->execute();

    while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
        $a_sRet = $a_result['contract_number']." ".$a_result['engineer_number']." ".$a_result['engineer_name']."<br>";
        $a_sRet .= "<table border='0'>";
        $a_sRet .= "<tr>";
        $a_sRet .= "<td>●<a href='#' onclick=\"return unregist_charge_calc('".$a_cc_id."','".$a_result['engineer_number']."','".$a_result['calc_day_start_bill']."','".$a_result['calc_day_end_bill']."');\">現在行を削除</a></td>";
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
