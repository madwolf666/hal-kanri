<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./global.php');

//POSTデータを取得
$a_cr_id = $_POST['cr_id'];

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

        if ($a_result['payment_contract_form'] == '契'){
            if ($a_result['claim_contract_form'] != '派遣'){
                //契約社員で、かつ派遣以外の場合は、労働契約書
                $a_sRet .= "<td>●<a href='./index.php?mnu=".$GLOBALS['g_MENU_CONTRACT_10502']."&ACT=e&NO=".$a_result['cr_id']."'>労働契約書へ</a></td>";
            }else{
                //契約社員で、かる派遣の場合は、労働契約書（再発行）
                $a_sRet .= "<td>●<a href='./index.php?mnu=".$GLOBALS['g_MENU_CONTRACT_10503']."&ACT=e&NO=".$a_result['cr_id']."'>労働契約書へ</a></td>";
            }
        }elseif ($a_result['payment_contract_form'] == '正'){
            //正社員の場合は、就業条件明示書
            $a_sRet .= "<td>●<a href='./index.php?mnu=".$GLOBALS['g_MENU_CONTRACT_10504']."&ACT=e&NO=".$a_result['cr_id']."'>就業条件明示書へ</a></td>";
        }else{
            $a_sRet .= "<td><font color='#ff0000'>選択できる機能はありません</font></td>";
        }
        
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
