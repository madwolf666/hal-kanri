<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./global.php');

if (!isset($_GET['mnu'])){
    //初期画面へ遷移
    header('Location: ./top.php');
}else{
    switch($_GET['mnu']){
    case $GLOBALS['g_MENU_CONTRACT_10000']:   //台帳：モバイル用
        header('Location: ./10000.php');
        break;
    case $GLOBALS['g_MENU_CONTRACT_10100']:   //契約管理全体
        if (isset($_GET['ENO'])){
            $_SESSION['f_engineer_number'] = $_GET['ENO'];
            $_SESSION['f_engineer_name'] = "";
            $_SESSION['f_contract_number'] = "";
            $_SESSION['f_customer_name'] = "";
            $_SESSION['f_claim_agreement_start'] = "";
            $_SESSION['f_claim_agreement_end'] = "";
            $_SESSION['f_claim_contract_form'] = "";
            $_SESSION['f_claim_settlement_closingday'] = "";
            $_SESSION['f_claim_settlement_paymentday'] = "";
            $_SESSION['f_remarks'] = "";
        } else {
            #POST
            if (isset($_POST['f_engineer_number'])){
                $_SESSION['f_engineer_number'] = $_POST['f_engineer_number'];
            }
            if (isset($_POST['f_engineer_name'])){
                $_SESSION['f_engineer_name'] = $_POST['f_engineer_name'];
            }
            if (isset($_POST['f_contract_number'])){
                $_SESSION['f_contract_number'] = $_POST['f_contract_number'];
            }
            if (isset($_POST['f_customer_name'])){
                $_SESSION['f_customer_name'] = $_POST['f_customer_name'];
            }
            if (isset($_POST['f_claim_agreement_start'])){
                $_SESSION['f_claim_agreement_start'] = $_POST['f_claim_agreement_start'];
            }
            if (isset($_POST['f_claim_agreement_end'])){
                $_SESSION['f_claim_agreement_end'] = $_POST['f_claim_agreement_end'];
            }
            if (isset($_POST['f_claim_contract_form'])){
                $_SESSION['f_claim_contract_form'] = $_POST['f_claim_contract_form'];
            }
            if (isset($_POST['f_claim_settlement_closingday'])){
                $_SESSION['f_claim_settlement_closingday'] = $_POST['f_claim_settlement_closingday'];
            }
            if (isset($_POST['f_claim_settlement_paymentday'])){
                $_SESSION['f_claim_settlement_paymentday'] = $_POST['f_claim_settlement_paymentday'];
            }
            if (isset($_POST['f_remarks'])){
                $_SESSION['f_remarks'] = $_POST['f_remarks'];
            }
            #AND OR
            if (isset($_POST['f_engineer_number_andor'])){
            $_SESSION['f_engineer_number_andor'] = $_POST['f_engineer_number_andor'];
            }
            if (isset($_POST['f_contract_number_andor'])){
                $_SESSION['f_contract_number_andor'] = $_POST['f_contract_number_andor'];
            }
            if (isset($_POST['f_customer_name_andor'])){
                $_SESSION['f_customer_name_andor'] = $_POST['f_customer_name_andor'];
            }
            if (isset($_POST['f_claim_agreement_start_andor'])){
                $_SESSION['f_claim_agreement_start_andor'] = $_POST['f_claim_agreement_start_andor'];
            }
            if (isset($_POST['f_claim_agreement_end_andor'])){
                $_SESSION['f_claim_agreement_end_andor'] = $_POST['f_claim_agreement_end_andor'];
            }
            if (isset($_POST['f_claim_contract_form_andor'])){
                $_SESSION['f_claim_contract_form_andor'] = $_POST['f_claim_contract_form_andor'];
            }
            if (isset($_POST['f_claim_settlement_closingday_andor'])){
                $_SESSION['f_claim_settlement_closingday_andor'] = $_POST['f_claim_settlement_closingday_andor'];
            }
            if (isset($_POST['f_claim_settlement_paymentday_andor'])){
                $_SESSION['f_claim_settlement_paymentday_andor'] = $_POST['f_claim_settlement_paymentday_andor'];
            }
            if (isset($_POST['f_remarks_andor'])){
                $_SESSION['f_remarks_andor'] = $_POST['f_remarks_andor'];
            }
        }
        
        header('Location: ./10100.php');
        break;
    case $GLOBALS['g_MENU_CONTRACT_10101']:   //契約管理全体：検索
        header('Location: ./10101.php');
        break;
    case $GLOBALS['g_MENU_CONTRACT_10102']:   //契約レポート：新規
    case $GLOBALS['g_MENU_CONTRACT_10103']:   //契約レポート：修正
        header('Location: ./10102.php?ACT='.$_GET['ACT'].'&ENO='.$_GET['ENO'].'&NO='.$_GET['NO']);
        break;
    case $GLOBALS['g_MENU_CONTRACT_10104']:   //契約レポート：削除
        header('Location: ./10104.php');
        break;
    case $GLOBALS['g_MENU_CONTRACT_10105']:   //契約終了レポート：新規
        if ($_SESSION["hal_auth"] <= 0) {
            header('Location: ./10105.php?ACT=e&NO='.$_GET['NO']);
        }
        break;
    case $GLOBALS['g_MENU_CONTRACT_10106']:   //契約終了レポート：修正
        if ($_SESSION["hal_auth"] <= 0) {
            header('Location: ./10106.php');
        }
        break;
    case $GLOBALS['g_MENU_CONTRACT_10107']:   //見積書作成
        header('Location: ./10107.php?ACT=e&NO='.$_GET['NO']);
        break;
    case $GLOBALS['g_MENU_CONTRACT_10200']:   //給与台帳
        if ($_SESSION["hal_auth"] <= 0) {
            if (isset($_GET['ENM'])){
                #$_SESSION['f_engineer_number_10200'] = $_GET['ENO'];
                $_SESSION['f_payment_contract_form_10200'] = "";
                $_SESSION['f_engineer_name_10200'] = $_GET['ENM'];
                $_SESSION['f_date_entering_10200'] = "";
                $_SESSION['f_date_retire_10200'] = "";
                $_SESSION['f_payment_settlement_paymentday_10200'] = "";
                $_SESSION['f_date_modify_salary_10200'] = "";
                $_SESSION['f_date_first_salary_10200'] = "";
                $_SESSION['f_labor_contact_date_10200'] = "";
                $_SESSION['f_labor_yayoi_changed_10200'] = "";
                $_SESSION['f_labor_remarks_10200'] = "";
            } else {
                #POST
                #$_SESSION['f_engineer_number_10200'] = "";
                if (isset($_POST['f_payment_contract_form_10200'])){
                    $_SESSION['f_payment_contract_form_10200'] = $_POST['f_payment_contract_form_10200'];
                }
                if (isset($_POST['f_engineer_name_10200'])){
                $_SESSION['f_engineer_name_10200'] = $_POST['f_engineer_name_10200'];
                }
                if (isset($_POST['f_date_entering_10200'])){
                    $_SESSION['f_date_entering_10200'] = $_POST['f_date_entering_10200'];
                }
                if (isset($_POST['f_date_retire_10200'])){
                    $_SESSION['f_date_retire_10200'] = $_POST['f_date_retire_10200'];
                }
                if (isset($_POST['f_payment_settlement_paymentday_10200'])){
                    $_SESSION['f_payment_settlement_paymentday_10200'] = $_POST['f_payment_settlement_paymentday_10200'];
                }
                if (isset($_POST['f_date_modify_salary_10200'])){
                    $_SESSION['f_date_modify_salary_10200'] = $_POST['f_date_modify_salary_10200'];
                }
                if (isset($_POST['f_date_first_salary_10200'])){
                    $_SESSION['f_date_first_salary_10200'] = $_POST['f_date_first_salary_10200'];
                }
                if (isset($_POST['f_labor_contact_date_10200'])){
                    $_SESSION['f_labor_contact_date_10200'] = $_POST['f_labor_contact_date_10200'];
                }
                if (isset($_POST['f_labor_yayoi_changed_10200'])){
                    $_SESSION['f_labor_yayoi_changed_10200'] = $_POST['f_labor_yayoi_changed_10200'];
                }
                if (isset($_POST['f_labor_remarks_10200'])){
                    $_SESSION['f_labor_remarks_10200'] = $_POST['f_labor_remarks_10200'];
                }
                #AND OR
                if (isset($_POST['f_engineer_name_10200_andor'])){
                    $_SESSION['f_engineer_name_10200_andor'] = $_POST['f_engineer_name_10200_andor'];
                }
                if (isset($_POST['f_date_entering_10200_andor'])){
                    $_SESSION['f_date_entering_10200_andor'] = $_POST['f_date_entering_10200_andor'];
                }
                if (isset($_POST['f_date_retire_10200_andor'])){
                    $_SESSION['f_date_retire_10200_andor'] = $_POST['f_date_retire_10200_andor'];
                }
                if (isset($_POST['f_payment_settlement_paymentday_10200_andor'])){
                    $_SESSION['f_payment_settlement_paymentday_10200_andor'] = $_POST['f_payment_settlement_paymentday_10200_andor'];
                }
                if (isset($_POST['f_date_modify_salary_10200_andor'])){
                    $_SESSION['f_date_modify_salary_10200_andor'] = $_POST['f_date_modify_salary_10200_andor'];
                }
                if (isset($_POST['f_date_first_salary_10200_andor'])){
                    $_SESSION['f_date_first_salary_10200_andor'] = $_POST['f_date_first_salary_10200_andor'];
                }
                if (isset($_POST['f_labor_contact_date_10200_andor'])){
                    $_SESSION['f_labor_contact_date_10200_andor'] = $_POST['f_labor_contact_date_10200_andor'];
                }
                if (isset($_POST['f_labor_yayoi_changed_10200_andor'])){
                    $_SESSION['f_labor_yayoi_changed_10200_andor'] = $_POST['f_labor_yayoi_changed_10200_andor'];
                }
                if (isset($_POST['f_labor_remarks_10200_andor'])){
                    $_SESSION['f_labor_remarks_10200_andor'] = $_POST['f_labor_remarks_10200_andor'];
                }
            }

            header('Location: ./10200.php');
        }
        break;
    case $GLOBALS['g_MENU_CONTRACT_10201']:   //給与台帳：検索
        if ($_SESSION["hal_auth"] <= 0) {
            header('Location: ./10201.php');
        }
        break;
    case $GLOBALS['g_MENU_CONTRACT_10210']:   //給与台帳：行追加[2017.07.20]課題解決表No.72
        if ($_SESSION["hal_auth"] <= 0) {
            //POSTデータを取得
            $a_cr_id = $_GET['NO'];
            $a_pr_id = $_GET['SN'];
            $a_isExists = false;

            try{
                //DBからユーザ情報取得
                $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
                $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $a_sql = "SELECT * FROM ".$GLOBALS['g_DB_t_payroll']." WHERE (cr_id=:cr_id);";
                $a_stmt = $a_conn->prepare($a_sql);
                $a_stmt->bindParam(':cr_id', $a_cr_id,PDO::PARAM_STR);
                $a_stmt->execute();

                $a_sql2 = "";
                while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
                    $a_isExists = true;
                }

                $a_rec = 1;
                if ($a_isExists == false){
                    echo 'false';
                    $a_rec = 1;
                } else {
                    echo 'true';
                    $a_sql2 = "INSERT INTO ".$GLOBALS['g_DB_t_payroll']." (";
                    $a_sql2 .= "
    cr_id
    ,reg_id
    ,reg_date
    ,is_manual
                ";
                    $a_sql2 .= ") SELECT";
                    $a_sql2 .= "
    :cr_id AS cr_id
    ,:reg_id AS reg_id
    ,:reg_date AS reg_date
    ,1 AS is_manual
                ";
                    $a_sql2 .= " FROM ".$GLOBALS['g_DB_t_payroll']." WHERE (cr_id=:cr_id) AND (pr_id=:pr_id);";
                }

                if ($a_isExists == false){
                    for ($a_i = 1; $a_i <= $a_rec; $a_i++) {
                        $a_sql = "INSERT INTO ".$GLOBALS['g_DB_t_payroll']." (";
                        $a_sql .= "cr_id,reg_id,reg_date,is_manual";
                        $a_sql .= ") VALUES(";
                        $a_sql .= ":cr_id,:reg_id,:reg_date,1";
                        $a_sql .= ");";

                        $a_stmt = $a_conn->prepare($a_sql);

                        com_pdo_bindValue($a_stmt, ':reg_id', $_SESSION['hal_idx']);
                        com_pdo_bindValue($a_stmt, ':reg_date', date("Y/m/d"));
                        com_pdo_bindValue($a_stmt, ':cr_id', $a_cr_id);
                        $a_stmt->execute();
                    }
                } else {
                        $a_stmt = $a_conn->prepare($a_sql2);

                        com_pdo_bindValue($a_stmt, ':reg_id', $_SESSION['hal_idx']);
                        com_pdo_bindValue($a_stmt, ':reg_date', date("Y/m/d"));
                        com_pdo_bindValue($a_stmt, ':cr_id', $a_cr_id);
                        com_pdo_bindValue($a_stmt, ':pr_id', $a_pr_id);
                        $a_stmt->execute();
                }
            } catch (PDOException $e){
                $a_sRet = 'Error:'.$e->getMessage();
            }
            $a_conn = null;

            header('Location: ./10200.php');
        }
        break;    case $GLOBALS['g_MENU_CONTRACT_10211']:   //給与台帳：現在行削除[2017.07.20]課題解決表No.72
        if ($_SESSION["hal_auth"] <= 0) {
            //POSTデータを取得
            $a_cr_id = $_GET['NO'];
            $a_pr_id = $_GET['SN'];
            $a_isExists = false;

            try{
                //DBからユーザ情報取得
                $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
                $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $a_sql = "DELETE FROM ".$GLOBALS['g_DB_t_payroll']." WHERE (cr_id=:cr_id) AND (pr_id=:pr_id);";
                $a_stmt = $a_conn->prepare($a_sql);
                com_pdo_bindValue($a_stmt, ':cr_id', $a_cr_id);
                com_pdo_bindValue($a_stmt, ':pr_id', $a_pr_id);
                $a_stmt->execute();
            } catch (PDOException $e){
                $a_sRet = 'Error:'.$e->getMessage();
            }
            $a_conn = null;

            header('Location: ./10200.php');
        }
        break;
    case $GLOBALS['g_MENU_CONTRACT_10300']:   //検収台帳
        if ($_SESSION["hal_auth"] <= 0) {
            if (isset($_GET['ENO'])){
                $_SESSION['f_contract_number_10300'] = "";
                $_SESSION['f_engineer_number_10300'] = $_GET['ENO'];
                #$_SESSION['f_engineer_number_10300'] = "";
                $_SESSION['f_engineer_name_10300'] = "";
                $_SESSION['f_customer_name_10300'] = "";
                $_SESSION['f_claim_contract_form_10300'] = "";
                $_SESSION['f_ag_no_10300'] = "";
                $_SESSION['f_accounts_bai_previous_day_10300'] = "";
                $_SESSION['f_accounts_actual_working_hours_10300'] = "";
                $_SESSION['f_accounts_expenses_10300'] = "";
                $_SESSION['f_payment_contract_form_10300'] = "";
                $_SESSION['f_payment_acceptance_date_10300'] = "";
                $_SESSION['f_payment_settlement_paymentday_10300'] = "";
            } else {
                #POST
                if (isset($_POST['f_contract_number_10300'])){
                    $_SESSION['f_contract_number_10300'] = $_POST['f_contract_number_10300'];
                }
                if (isset($_POST['f_engineer_number_10300'])){
                    $_SESSION['f_engineer_number_10300'] = $_POST['f_engineer_number_10300'];
                }
                if (isset($_POST['f_engineer_name_10300'])){
                    $_SESSION['f_engineer_name_10300'] = $_POST['f_engineer_name_10300'];
                }
                if (isset($_POST['f_customer_name_10300'])){
                    $_SESSION['f_customer_name_10300'] = $_POST['f_customer_name_10300'];
                }
                if (isset($_POST['f_claim_contract_form_10300'])){
                    $_SESSION['f_claim_contract_form_10300'] = $_POST['f_claim_contract_form_10300'];
                }
                if (isset($_POST['f_ag_no_10300'])){
                    $_SESSION['f_ag_no_10300'] = $_POST['f_ag_no_10300'];
                }
                if (isset($_POST['f_accounts_bai_previous_day_10300'])){
                    $_SESSION['f_accounts_bai_previous_day_10300'] = $_POST['f_accounts_bai_previous_day_10300'];
                }
                if (isset($_POST['f_accounts_actual_working_hours_10300'])){
                    $_SESSION['f_accounts_actual_working_hours_10300'] = $_POST['f_accounts_actual_working_hours_10300'];
                }
                if (isset($_POST['f_accounts_expenses_10300'])){
                    $_SESSION['f_accounts_expenses_10300'] = $_POST['f_accounts_expenses_10300'];
                }
                if (isset($_POST['f_payment_contract_form_10300'])){
                    $_SESSION['f_payment_contract_form_10300'] = $_POST['f_payment_contract_form_10300'];
                }
                if (isset($_POST['f_payment_acceptance_date_10300'])){
                    $_SESSION['f_payment_acceptance_date_10300'] = $_POST['f_payment_acceptance_date_10300'];
                }
                if (isset($_POST['f_payment_settlement_paymentday_10300'])){
                    $_SESSION['f_payment_settlement_paymentday_10300'] = $_POST['f_payment_settlement_paymentday_10300'];
                }
                # AND OR
                if (isset($_POST['f_engineer_number_10300_andor'])){
                    $_SESSION['f_engineer_number_10300_andor'] = $_POST['f_engineer_number_10300_andor'];
                }
                if (isset($_POST['f_engineer_name_10300_andor'])){
                    $_SESSION['f_engineer_name_10300_andor'] = $_POST['f_engineer_name_10300_andor'];
                }
                if (isset($_POST['f_customer_name_10300_andor'])){
                    $_SESSION['f_customer_name_10300_andor'] = $_POST['f_customer_name_10300_andor'];
                }
                if (isset($_POST['f_claim_contract_form_10300_andor'])){
                    $_SESSION['f_claim_contract_form_10300_andor'] = $_POST['f_claim_contract_form_10300_andor'];
                }
                if (isset($_POST['f_ag_no_10300_andor'])){
                    $_SESSION['f_ag_no_10300_andor'] = $_POST['f_ag_no_10300_andor'];
                }
                if (isset($_POST['f_accounts_bai_previous_day_10300_andor'])){
                    $_SESSION['f_accounts_bai_previous_day_10300_andor'] = $_POST['f_accounts_bai_previous_day_10300_andor'];
                }
                if (isset($_POST['f_accounts_actual_working_hours_10300_andor'])){
                    $_SESSION['f_accounts_actual_working_hours_10300_andor'] = $_POST['f_accounts_actual_working_hours_10300_andor'];
                }
                if (isset($_POST['f_accounts_expenses_10300_andor'])){
                    $_SESSION['f_accounts_expenses_10300_andor'] = $_POST['f_accounts_expenses_10300_andor'];
                }
                if (isset($_POST['f_payment_contract_form_10300_andor'])){
                    $_SESSION['f_payment_contract_form_10300_andor'] = $_POST['f_payment_contract_form_10300_andor'];
                }
                if (isset($_POST['f_payment_acceptance_date_10300_andor'])){
                    $_SESSION['f_payment_acceptance_date_10300_andor'] = $_POST['f_payment_acceptance_date_10300_andor'];
                }
                if (isset($_POST['f_payment_settlement_paymentday_10300_andor'])){
                    $_SESSION['f_payment_settlement_paymentday_10300_andor'] = $_POST['f_payment_settlement_paymentday_10300_andor'];
                }
            }

            header('Location: ./10300.php');
        }
        break;
    case $GLOBALS['g_MENU_CONTRACT_10301']:   //検収台帳：検索
        if ($_SESSION["hal_auth"] <= 0) {
            header('Location: ./10301.php');
        }
        break;
    case $GLOBALS['g_MENU_CONTRACT_10310']:   //検収台帳：行追加
        if ($_SESSION["hal_auth"] <= 0) {
            //POSTデータを取得
            $a_cr_id = $_GET['NO'];
            $a_al_id = $_GET['SN'];
            $a_isExists = false;

            try{
                //DBからユーザ情報取得
                $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
                $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $a_sql = "SELECT * FROM ".$GLOBALS['g_DB_t_acceptance_ledger']." WHERE (cr_id=:cr_id) AND (al_id=:al_id);";
                $a_stmt = $a_conn->prepare($a_sql);
                $a_stmt->bindParam(':cr_id', $a_cr_id,PDO::PARAM_STR);
                com_pdo_bindValue($a_stmt, ':al_id', $a_al_id);
                $a_stmt->execute();

                $a_sql2 = "";
                while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
                    $a_isExists = true;
                }

                $a_rec = 1;
                if ($a_isExists == false){
                    $a_rec = 2;
                } else {
                    $a_sql2 = "INSERT INTO ".$GLOBALS['g_DB_t_acceptance_ledger']." (";
                    $a_sql2 .= "
    cr_id
    ,reg_id
    ,reg_date
    ,accounts_estimate_no
    ,accounts_contract_purchase_no
    ,accounts_bai_previous_day
    ,accounts_sales_will_amount
    ,accounts_working_hours_manage
    ,accounts_actual_working_hours
    ,accounts_actual_amount_money
    ,accounts_expenses
    ,accounts_tax_meter_noinclude
    ,accounts_tax_meter_include
    ,accounts_invoicing
    ,ordering_purchase_no
    ,payment_acceptance_date
    ,payment_schedule_amount
    ,payment_actual_working_hours
    ,payment_actual_amount_money
    ,payment_commuting_expenses
    ,payment_tax_meter_noinclude
    ,payment_tax_meter_include
    ,payment_bill_acceptance
    ,payment_expenses
    ,payment_else
    ,payment_pre_paid
    ,payment_advance
    ,payment_commission
    ,payment_total
    ,payment_plan_month_after_next_1
    ,payment_plan_next_month_15
    ,payment_plan_month_after_next_15
    ,payment_plan_else
    ,payment_payroll_schedule
    ,payment_transfer_processing_amount1
    ,payment_transfer_processing_amount2
    ,payment_difference
    ,payment_actual_working_hours_difference
    ,payment_gross_profit
    ,payment_gross_profit_margin
                ";
                    $a_sql2 .= ") SELECT";
                    $a_sql2 .= "
    :cr_id AS cr_id
    ,:reg_id AS reg_id
    ,:reg_date AS reg_date
    ,accounts_estimate_no
    ,accounts_contract_purchase_no
    ,accounts_bai_previous_day
    ,accounts_sales_will_amount
    ,accounts_working_hours_manage
    ,accounts_actual_working_hours
    ,accounts_actual_amount_money
    ,accounts_expenses
    ,accounts_tax_meter_noinclude
    ,accounts_tax_meter_include
    ,accounts_invoicing
    ,ordering_purchase_no
    ,payment_acceptance_date
    ,payment_schedule_amount
    ,payment_actual_working_hours
    ,payment_actual_amount_money
    ,payment_commuting_expenses
    ,payment_tax_meter_noinclude
    ,payment_tax_meter_include
    ,payment_bill_acceptance
    ,payment_expenses
    ,payment_else
    ,payment_pre_paid
    ,payment_advance
    ,payment_commission
    ,payment_total
    ,payment_plan_month_after_next_1
    ,payment_plan_next_month_15
    ,payment_plan_month_after_next_15
    ,payment_plan_else
    ,payment_payroll_schedule
    ,payment_transfer_processing_amount1
    ,payment_transfer_processing_amount2
    ,payment_difference
    ,payment_actual_working_hours_difference
    ,payment_gross_profit
    ,payment_gross_profit_margin
                ";
                    $a_sql2 .= " FROM ".$GLOBALS['g_DB_t_acceptance_ledger']." WHERE (cr_id=:cr_id) AND (al_id=:al_id);";
                }

                if ($a_isExists == false){
                    for ($a_i = 1; $a_i <= $a_rec; $a_i++) {
                        $a_sql = "INSERT INTO ".$GLOBALS['g_DB_t_acceptance_ledger']." (";
                        $a_sql .= "cr_id,reg_id,reg_date";
                        $a_sql .= ") VALUES(";
                        $a_sql .= ":cr_id,:reg_id,:reg_date";
                        $a_sql .= ");";

                        $a_stmt = $a_conn->prepare($a_sql);

                        com_pdo_bindValue($a_stmt, ':reg_id', $_SESSION['hal_idx']);
                        com_pdo_bindValue($a_stmt, ':reg_date', date("Y/m/d"));
                        com_pdo_bindValue($a_stmt, ':cr_id', $a_cr_id);
                        $a_stmt->execute();
                    }
                } else {
                        $a_stmt = $a_conn->prepare($a_sql2);

                        com_pdo_bindValue($a_stmt, ':reg_id', $_SESSION['hal_idx']);
                        com_pdo_bindValue($a_stmt, ':reg_date', date("Y/m/d"));
                        com_pdo_bindValue($a_stmt, ':cr_id', $a_cr_id);
                        com_pdo_bindValue($a_stmt, ':al_id', $a_al_id);
                        $a_stmt->execute();
                }
            } catch (PDOException $e){
                $a_sRet = 'Error:'.$e->getMessage();
            }
            $a_conn = null;

            header('Location: ./10300.php');
        }
        break;
    case $GLOBALS['g_MENU_CONTRACT_10311']:   //検収台帳：現在行削除
        if ($_SESSION["hal_auth"] <= 0) {
            //POSTデータを取得
            $a_cr_id = $_GET['NO'];
            $a_al_id = $_GET['SN'];
            $a_isExists = false;

            try{
                //DBからユーザ情報取得
                $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
                $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $a_sql = "SELECT * FROM ".$GLOBALS['g_DB_t_acceptance_ledger']." WHERE (cr_id=:cr_id);";
                $a_stmt = $a_conn->prepare($a_sql);
                $a_stmt->bindParam(':cr_id', $a_cr_id,PDO::PARAM_STR);
                $a_stmt->execute();

                $a_num = 0;
                while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
                    $a_num++;
                }

                if ($a_num > 1) {
                    $a_sql = "DELETE FROM ".$GLOBALS['g_DB_t_acceptance_ledger']." WHERE (cr_id=:cr_id) AND (al_id=:al_id);";
                    $a_stmt = $a_conn->prepare($a_sql);
                    com_pdo_bindValue($a_stmt, ':cr_id', $a_cr_id);
                    com_pdo_bindValue($a_stmt, ':al_id', $a_al_id);
                    $a_stmt->execute();
                }
            } catch (PDOException $e){
                $a_sRet = 'Error:'.$e->getMessage();
            }
            $a_conn = null;

            header('Location: ./10300.php');
        }
        break;
    case $GLOBALS['g_MENU_CONTRACT_10400']:   //注文書台帳
        if ($_SESSION["hal_auth"] <= 0) {
            if (isset($_GET['ENM'])){
                #$_SESSION['f_engineer_number_10400'] = $_GET['ENO'];
                $_SESSION['f_contract_number_10400'] = "";
                $_SESSION['f_engineer_name_10400'] = $_GET['ENM'];
            } else {
                #$_SESSION['f_engineer_number_10400'] = "";
                #POST
                if (isset($_POST['f_contract_number_10400'])){
                    $_SESSION['f_contract_number_10400'] = $_POST['f_contract_number_10400'];
                }
                if (isset($_POST['f_engineer_name_10400'])){
                    $_SESSION['f_engineer_name_10400'] = $_POST['f_engineer_name_10400'];
                }
                #AND OR
                if (isset($_POST['f_engineer_name_10400_andor'])){
                    $_SESSION['f_engineer_name_10400_andor'] = $_POST['f_engineer_name_10400_andor'];
                }
            }

            header('Location: ./10400.php');
        }
        break;
    case $GLOBALS['g_MENU_CONTRACT_10401']:   //注文書台帳：検索
        if ($_SESSION["hal_auth"] <= 0) {
            header('Location: ./10401.php');
        }
        break;
    case $GLOBALS['g_MENU_CONTRACT_10402']:   //注文書
        if ($_SESSION["hal_auth"] <= 0) {
            header('Location: ./10402.php?ACT='.$_GET['ACT'].'&NO='.$_GET['NO']);
        }
        break;
    case $GLOBALS['g_MENU_CONTRACT_10403']:   //注文請書
        if ($_SESSION["hal_auth"] <= 0) {
            header('Location: ./10403.php?ACT='.$_GET['ACT'].'&NO='.$_GET['NO']);
        }
        break;
    case $GLOBALS['g_MENU_CONTRACT_10500']:   //契約書台帳
        if ($_SESSION["hal_auth"] <= 0) {
            if (isset($_GET['ENM'])){
                #$_SESSION['f_engineer_number_10500'] = $_GET['ENO'];
                $_SESSION['f_contract_number_10500'] = "";
                $_SESSION['f_engineer_name_10500'] = $_GET['ENM'];
            } else {
                #$_SESSION['f_engineer_number_10500'] = "";
                #POST
                if (isset($_POST['f_contract_number_10500'])){
                    $_SESSION['f_contract_number_10500'] = $_POST['f_contract_number_10500'];
                }
                if (isset($_POST['f_engineer_name_10500'])){
                    $_SESSION['f_engineer_name_10500'] = $_POST['f_engineer_name_10500'];
                }
                #AND OR
                if (isset($_POST['f_engineer_name_10500_andor'])){
                    $f_engineer_name_10500_andor = $_POST['f_engineer_name_10500_andor'];
                }
            }

            header('Location: ./10500.php');
        }
        break;
    case $GLOBALS['g_MENU_CONTRACT_10501']:   //契約書台帳：検索
        if ($_SESSION["hal_auth"] <= 0) {
            header('Location: ./10501.php');
        }
        break;
    case $GLOBALS['g_MENU_CONTRACT_10502']:   //労働契約書
        if ($_SESSION["hal_auth"] <= 0) {
            header('Location: ./10502.php?ACT='.$_GET['ACT'].'&NO='.$_GET['NO']);
        }
        break;
    case $GLOBALS['g_MENU_CONTRACT_10503']:   //労働契約書（再発行）
        if ($_SESSION["hal_auth"] <= 0) {
            header('Location: ./10503.php?ACT='.$_GET['ACT'].'&NO='.$_GET['NO']);
        }
        break;
    case $GLOBALS['g_MENU_CONTRACT_10504']:   //就業条件明示書
        if ($_SESSION["hal_auth"] <= 0) {
            header('Location: ./10504.php?ACT='.$_GET['ACT'].'&NO='.$_GET['NO']);
        }
        break;
    case $GLOBALS['g_MENU_CONTRACT_10600']:   //派遣元台帳
        if ($_SESSION["hal_auth"] <= 0) {
            if (isset($_GET['ENM'])){
                #$_SESSION['f_engineer_number_10600'] = $_GET['ENO'];
                $_SESSION['f_contract_number_10600'] = "";
                $_SESSION['f_engineer_name_10600'] = $_GET['ENM'];
            } else {
                #$_SESSION['f_engineer_number_10600'] = "";
                #POST
                if (isset($_POST['f_contract_number_10600'])){
                    $_SESSION['f_contract_number_10600'] = $_POST['f_contract_number_10600'];
                }
                if (isset($_POST['f_engineer_name_10600'])){
                    $_SESSION['f_engineer_name_10600'] = $_POST['f_engineer_name_10600'];
                }
                #AND OR
                if (isset($_POST['f_engineer_name_10600_andor'])){
                    $f_engineer_name_10600_andor = $_POST['f_engineer_name_10600_andor'];
                }
            }

            header('Location: ./10600.php');
        }
        break;
    case $GLOBALS['g_MENU_CONTRACT_10601']:   //派遣元台帳：検索
        if ($_SESSION["hal_auth"] <= 0) {
            header('Location: ./10601.php');
        }
        break;
    case $GLOBALS['g_MENU_MAINTENANCE_90000']:   //メンテナンス
        header('Location: ./90000.php');
        break;
    case $GLOBALS['g_MENU_MAINTENANCE_90100']:   //ユーザ情報：一覧
        if ($_SESSION["hal_auth"] <= 0) {
            header('Location: ./90100.php');
        }
        break;
    case $GLOBALS['g_MENU_MAINTENANCE_90102']:   //ユーザ：新規
    case $GLOBALS['g_MENU_MAINTENANCE_90103']:   //ユーザ：修正
        if ($_SESSION["hal_auth"] <= 0) {
            header('Location: ./90102.php?ACT='.$_GET['ACT'].'&IDX='.$_GET['IDX']);
        }
        break;
    case $GLOBALS['g_MENU_MAINTENANCE_90200']:   //エンジニア一覧
        header('Location: ./90200.php');
        break;
    case $GLOBALS['g_MENU_MAINTENANCE_90201']:   //エンジニア：検索
        header('Location: ./90201.php');
        break;
    case $GLOBALS['g_MENU_MAINTENANCE_90211']:   //エンジニア：アップロード
        header('Location: ./90211.php');
        break;
    case $GLOBALS['g_MENU_CONTRACT_SHOW_CHART']:   //エンジニア：アップロード
        header('Location: ./show_chart.php?BAK='.$_GET['BAK'].'&NO='.$_GET['NO']);
        break;
    case $GLOBALS['g_MENU_MAINTENANCE_90300']:   //お知らせ情報：一覧
        if ($_SESSION["hal_auth"] <= 0) {
            header('Location: ./90300.php');
        }
        break;
    case $GLOBALS['g_MENU_MAINTENANCE_90302']:   //お知らせ：新規
    case $GLOBALS['g_MENU_MAINTENANCE_90303']:   //お知らせ：修正
        if ($_SESSION["hal_auth"] <= 0) {
            header('Location: ./90302.php?ACT='.$_GET['ACT'].'&IDX='.$_GET['IDX']);
        }
        break;
    case $GLOBALS['g_MENU_MAINTENANCE_90400']:   //送付状一覧
        header('Location: ./90400.php');
        break;
    case $GLOBALS['g_MENU_MAINTENANCE_90401']:   //送付状：検索
        header('Location: ./90401.php');
        break;
    case $GLOBALS['g_MENU_MAINTENANCE_90411']:   //送付状：アップロード
        header('Location: ./90411.php');
        break;
    case $GLOBALS['g_MENU_CONTRACT_SHOW_CHART']:   //エンジニア：アップロード
        header('Location: ./show_chart.php?BAK='.$_GET['BAK'].'&NO='.$_GET['NO']);
        break;
    case $GLOBALS['g_MENU_LOGOUT_00000']:       //ログアウト
        $_SESSION["hal_idx"] = -1;
        $_SESSION["hal_base_cd"] = "";
        $_SESSION["hal_department_cd"] = "";
        $_SESSION["hal_person"] = "";
        $_SESSION["hal_auth"] = -1;
        $_SESSION["hal_base_name"] = "";
        $_SESSION["hal_department_name"] = "";

        setcookie('hal_idx', '', time() - 1800);
        setcookie('hal_base_cd', '', time() - 1800);
        setcookie('hal_department_cd', '', time() - 1800);
        setcookie('hal_person', '', time() - 1800);
        setcookie('hal_auth', '', time() - 1800);
        setcookie('hal_base_name', '', time() - 1800);
        setcookie('hal_department_name', '', time() - 1800);

        header('Location: ./login.php');
        break;
    default:
        break;
    }
}

?>
