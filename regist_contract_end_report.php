<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./global.php');

$a_sRet = '';

//POST情報取得
$a_act = $_POST['act'];
$a_cr_id = $_POST['no'];
$a_isExists = false;

try{
    //DBからユーザ情報取得
    $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
    $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //レコードが存在するかチェック
    //担当営業情報は契約レポートから持ってくる。
    $a_sql = "SELECT * FROM ".$GLOBALS['g_DB_t_contract_end_report']." WHERE (cr_id=:cr_id);";
    $a_stmt = $a_conn->prepare($a_sql);
    $a_stmt->bindParam(':cr_id', $a_cr_id,PDO::PARAM_STR);
    $a_stmt->execute();

    while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
        $a_isExists = true;
    }

    if ($a_isExists == false){
        $a_sql = "INSERT INTO ".$GLOBALS['g_DB_t_contract_end_report']." (";
        #[2018.01.12]追加
        #[2018.01.18]課題解決管理表No.92
        $a_sql .= "
            cr_id
            ,replace_person
            ,end_status
            ,retire_date
            ,insurance_crad
            ,employ_insurance
            ,end_reason1
            ,end_reason2
            ,end_reason3
            ,end_reason_detail
            ,from_now
            ,skill
            ,remarks
            ,conversation
            ,work_attitude
            ,personality
            ,projects_confirm
            ,engineer_list
            ,reg_id
            ,reg_date
            ,remarks_pay
            ,cnf_id
            ,cnf_date
            ,retirement_date
            ,insurance_card_retirement
            ,leave_date_start
            ,leave_date_end
            ,insurance_card_leave
            ,remarks2
            ,remarks_pay2
            ";
        $a_sql .= ") VALUES(";
        #[2018.01.12]追加
        #[2018.01.18]課題解決管理表No.92
        $a_sql .= "
            :cr_id
            ,:replace_person
            ,:end_status
            ,:retire_date
            ,:insurance_crad
            ,:employ_insurance
            ,:end_reason1
            ,:end_reason2
            ,:end_reason3
            ,:end_reason_detail
            ,:from_now
            ,:skill
            ,:remarks
            ,:conversation
            ,:work_attitude
            ,:personality
            ,:projects_confirm
            ,:engineer_list
            ,:reg_id
            ,:reg_date
            ,:remarks_pay
            ,:cnf_id
            ,:cnf_date
            ,:retirement_date
            ,:insurance_card_retirement
            ,:leave_date_start
            ,:leave_date_end
            ,:insurance_card_leave
            ,:remarks2
            ,:remarks_pay2
            ";
        $a_sql .= ");";
    }else{
        $a_sql = "UPDATE ".$GLOBALS['g_DB_t_contract_end_report']." SET ";
        #[2018.01.12]追加
        #[2018.01.18]課題解決管理表No.92
        $a_sql .= "
            replace_person=:replace_person
            ,end_status=:end_status
            ,retire_date=:retire_date
            ,insurance_crad=:insurance_crad
            ,employ_insurance=:employ_insurance
            ,end_reason1=:end_reason1
            ,end_reason2=:end_reason2
            ,end_reason3=:end_reason3
            ,end_reason_detail=:end_reason_detail
            ,from_now=:from_now
            ,skill=:skill
            ,remarks=:remarks
            ,conversation=:conversation
            ,work_attitude=:work_attitude
            ,personality=:personality
            ,projects_confirm=:projects_confirm
            ,engineer_list=:engineer_list
            ,upd_id=:upd_id
            ,upd_date=:upd_date
            ,remarks_pay=:remarks_pay
            ,cnf_id=:cnf_id
            ,cnf_date=:cnf_date
            ,retirement_date=:retirement_date
            ,insurance_card_retirement=:insurance_card_retirement
            ,leave_date_start=:leave_date_start
            ,leave_date_end=:leave_date_end
            ,insurance_card_leave=:insurance_card_leave
            ,remarks2=:remarks2
            ,remarks_pay2=:remarks_pay2
            ";
        $a_sql .= " WHERE (cr_id=:cr_id);";
    }
    
    $a_stmt = $a_conn->prepare($a_sql);

    $a_stmt->bindParam(':cr_id', $a_cr_id, PDO::PARAM_STR);
    $a_stmt->bindParam(':replace_person', $_POST['opt_contarct_replace'], PDO::PARAM_STR);
    $a_stmt->bindParam(':end_status', $_POST['opt_contarct_end_status'], PDO::PARAM_STR);
    com_pdo_bindValue($a_stmt, ':retire_date', $_POST['inp_retire_date']);
    $a_stmt->bindParam(':insurance_crad', $_POST['opt_contarct_insurance_crad'], PDO::PARAM_STR);
    $a_stmt->bindParam(':employ_insurance', $_POST['opt_contarct_employ_insurance'], PDO::PARAM_STR);
    $a_stmt->bindParam(':end_reason1', $_POST['opt_contarct_end_reason1'], PDO::PARAM_STR);
    $a_stmt->bindParam(':end_reason2', $_POST['opt_contarct_end_reason2'], PDO::PARAM_STR);
    $a_stmt->bindParam(':end_reason3', $_POST['opt_contarct_end_reason3'], PDO::PARAM_STR);
    $a_stmt->bindParam(':end_reason_detail', $_POST['inp_end_reason_detail'], PDO::PARAM_STR);
    $a_stmt->bindParam(':from_now', $_POST['opt_contarct_from_now'], PDO::PARAM_STR);
    $a_stmt->bindParam(':skill', $_POST['opt_contarct_skill'], PDO::PARAM_STR);
    $a_stmt->bindParam(':remarks', $_POST['inp_biko'], PDO::PARAM_STR);
    $a_stmt->bindParam(':conversation', $_POST['opt_contarct_conversation'], PDO::PARAM_STR);
    $a_stmt->bindParam(':work_attitude', $_POST['opt_contarct_work_attitude'], PDO::PARAM_STR);
    $a_stmt->bindParam(':personality', $_POST['opt_contarct_personality'], PDO::PARAM_STR);
    $a_stmt->bindParam(':projects_confirm', $_POST['opt_contarct_projects_confirm'], PDO::PARAM_STR);
    $a_stmt->bindParam(':engineer_list', $_POST['opt_contarct_engineer_list'], PDO::PARAM_STR);
    $a_stmt->bindParam(':remarks_pay', $_POST['remarks_pay'], PDO::PARAM_STR);

    # [2018.01.12]追加
    com_pdo_bindValue($a_stmt, ':retirement_date', $_POST['retirement_date']);
    $a_stmt->bindParam(':insurance_card_retirement', $_POST['insurance_card_retirement'], PDO::PARAM_STR);
    com_pdo_bindValue($a_stmt, ':leave_date_start', $_POST['leave_date_start']);
    com_pdo_bindValue($a_stmt, ':leave_date_end', $_POST['leave_date_end']);
    $a_stmt->bindParam(':insurance_card_leave', $_POST['insurance_card_leave'], PDO::PARAM_STR);
    
    #[2018.01.18]課題解決管理表No.92
    $a_stmt->bindParam(':remarks2', $_POST['remarks2'], PDO::PARAM_STR);
    $a_stmt->bindParam(':remarks_pay2', $_POST['remarks_pay2'], PDO::PARAM_STR);

    if ($a_isExists == false) {
        com_pdo_bindValue($a_stmt, ':reg_id', $_POST['reg_id']);
        #com_pdo_bindValue($a_stmt, ':reg_id', $_SESSION['hal_idx']);
        com_pdo_bindValue($a_stmt, ':reg_date', date("Y/m/d"));
    } else {
        com_pdo_bindValue($a_stmt, ':upd_id', $_POST['reg_id']);
        #com_pdo_bindValue($a_stmt, ':upd_id', $_SESSION['hal_idx']);
        com_pdo_bindValue($a_stmt, ':upd_date', date("Y/m/d"));
    }

    if ($_SESSION['hal_department_cd'] == 3){
        //管理部門でログイン
        com_pdo_bindValue($a_stmt, ':cnf_id', $_SESSION['hal_idx']);
        com_pdo_bindValue($a_stmt, ':cnf_date', date("Y/m/d"));
    }else{
        com_pdo_bindValue($a_stmt, ':cnf_id', null);
        com_pdo_bindValue($a_stmt, ':cnf_date', null);
    }
    $a_stmt->execute();

    $a_sRet = 'OK';
    //$a_sRet .= "--->".$inp_tankin_b1;
    
} catch (PDOException $e){
    $a_sRet = 'Error:'.$e->getMessage();
    //print('Error:'.$e->getMessage());
    //die();
}
$a_conn = null;

echo $a_sRet;

?>
