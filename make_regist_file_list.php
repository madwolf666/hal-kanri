<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./global.php');

//POSTデータを取得
$a_my_id = $_POST['my_id']; #[2017.12.13]要望
$a_act = $_POST['act'];
$a_cr_id = 0;
if (isset($_POST['cr_id']) == true){
    $a_cr_id = $_POST['cr_id'];
}

try{
    //DBからユーザ情報取得
    $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
    $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $a_sql = "SELECT * FROM ";
    #[2017.12.13]要望
    if ($a_my_id == 'my-evidence'){
        $a_sql .= $GLOBALS['g_DB_t_evidence'];
    }else if ($a_my_id == 'my-payroll'){
        $a_sql .= $GLOBALS['g_DB_t_payroll_file'];
    }
    $a_sql .= " WHERE (cr_id=:cr_id) ORDER BY ed_id;";
    $a_stmt = $a_conn->prepare($a_sql);
    com_pdo_bindValue($a_stmt, ':cr_id', $a_cr_id);
    $a_stmt->execute();

    $a_rec = 0;
    $a_sRet = "";
    //$a_sRet = "<table class='tbl_list'>";

    while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
        $a_rec++;

        if (($a_rec % 2)==0){
            //$a_sRet .= "<tr class='linee'>";
        }else{
            //$a_sRet .= "<tr class='lineo'>";
        }
        if ($a_act == 'e'){
            #[2017.12.13]要望
            $a_sRet .= "<input type='button' value='×' onclick='delete_regist_file(\"".$a_my_id."\",\"".$a_cr_id."\",\"".$a_result['ed_id']."\");' style='padding: 0px 4px 0px 4px; height:20px; background-color: #0000ff;'>";
            //$a_sRet .= "<td class='td_line'><input type='button' value='×' style='padding: 0px 4px 0px 4px; height:20px;'></td>";
        }
        $a_sRet .= "<a href='#' onclick='open_file(\"";
        #[2017.12.13]要望
        if ($a_my_id == 'my-evidence'){
            $a_sRet .= $GLOBALS['g_EVIDENCE_URL'];
        }else if ($a_my_id == 'my-payroll'){
            $a_sRet .= $GLOBALS['g_PAYROLL_URL'];
        }
        $a_sRet .= $a_cr_id."/".$a_result['file_name_sys']."\");'>".$a_result['file_name_src']."</a><br>";
        //$a_sRet .= "<a href='".$GLOBALS['g_EVIDENCE_URL'].$a_cr_id."/".$a_result['file_name_sys']."' target='_blank'>".$a_result['file_name_src']."</a><br>";

        //$a_sRet .= "<td class='td_line'>".$a_result['file_name_src']."</td>";
        //$a_sRet .= "</tr>";

    }
    
    if ($a_rec > 0){
        //$a_sRet .= "</table>";
        //$a_sRet = $a_rec."件<br>".$a_sRet;
    }else{
        $a_sRet = "登録データはありません。";
    }

} catch (PDOException $e){
    $a_sRet = 'Error:'.$e->getMessage();
}
$a_conn = null;

echo $a_sRet;

?>
