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

    #[2017.07.19]課題解決表No.68
    $a_sql = "SELECT *";
    $a_sql .= ",(SELECT idx FROM ".$GLOBALS['g_DB_m_contract_status']." WHERE (m_name=".$GLOBALS['g_DB_t_contract_report'].".status_cd)) AS status_cd_num";
    $a_sql .= " FROM ".$GLOBALS['g_DB_t_contract_report']." WHERE (cr_id=:cr_id);";
    $a_stmt = $a_conn->prepare($a_sql);
    $a_stmt->bindParam(':cr_id', $a_cr_id,PDO::PARAM_STR);
    $a_stmt->execute();

    while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
        $a_sRet = $a_result['contract_number']." ".$a_result['engineer_number']." ".$a_result['engineer_name']."<br>";
        $a_sRet .= "<table border='0'>";
        $a_sRet .= "<tr>";
        $a_sRet .= "<td>●<a href='./index.php?mnu=".$GLOBALS['g_MENU_CONTRACT_10103']."&ACT=e&NO=".$a_result['cr_id']."'>契約レポート参照・更新へ</a></td>";
        $a_sRet .= "<td>&nbsp;&nbsp;</td>";
        $a_sRet .= "<td>●<a href='./index.php?mnu=".$GLOBALS['g_MENU_CONTRACT_10107']."&NO=".$a_result['cr_id']."'>見積書へ</a></td>";
        $a_sRet .= "</tr>";

        $a_sRet .= "<tr>";
        #[2017.08.04]「管理承認」のみ契約継続
        $status_cd_num = $a_result['status_cd_num'];
        $a_sRet .= "<td>";
        if ($status_cd_num == 2){
            $a_sRet .= "●<a href='./index.php?mnu=".$GLOBALS['g_MENU_CONTRACT_10103']."&ACT=c&NO=".$a_result['cr_id']."'>契約継続へ</a>";
        }else{
            $a_sRet .= "&nbsp;&nbsp;";
        }
        $a_sRet .= "</td>";
        $a_sRet .= "<td>&nbsp;&nbsp;</td>";
        
        #[2017.07.19]課題解決表No.68
        #管理本部以外で、かつステータスが「営業提出」「管理承認」の場合は更新不可
        #$status_cd_num = $a_result['status_cd_num'];[2017.08.04]
        if (($_SESSION['hal_department_cd'] != 3) && (($status_cd_num == 1) || ($status_cd_num == 2))){
            $a_sRet .= "<td>&nbsp;&nbsp;</td>";
        }else{
            $a_sRet .= "<td>●<a href='#' onclick=\"return unregist_contract_report(".$a_result['cr_id'].");\">契約レポート削除</a></td>";
        }

        $a_sRet .= "</tr>";
 
        $a_sRet .= "<tr>";
        if ($_SESSION["hal_auth"] <= 0) {
            #[2017.08.04]「管理承認」のみ契約継続
            $a_sRet .= "<td>";
            if ($status_cd_num == 2){
                $a_sRet .= "●<a href='./index.php?mnu=".$GLOBALS['g_MENU_CONTRACT_10105']."&NO=".$a_result['cr_id']."'>契約終了レポートへ</a>";
            }else{
                $a_sRet .= "&nbsp;&nbsp;";
            }
            $a_sRet .= "</td>";
        } else {
            $a_sRet .= "<td>&nbsp;&nbsp;</td>";
        }
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
