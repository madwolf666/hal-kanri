<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

#Session
$f_contract_number_10600 = "";
$f_engineer_name_10600 = "";
if (isset($_SESSION['f_contract_number_10600'])){
    $f_contract_number_10600 = $_SESSION['f_contract_number_10600'];
}
if (isset($_SESSION['f_engineer_name_10600'])){
    $f_engineer_name_10600 = $_SESSION['f_engineer_name_10600'];
}

#Session(AND OR)
$f_engineer_name_10600_andor = "";
if (isset($_SESSION['f_engineer_name_10600_andor'])){
    $f_engineer_name_10600_andor = $_SESSION['f_engineer_name_10600_andor'];
}

$cr_id = "";
$dm_no = "";
$contract_number = "";
$payment_contract_form = "";
$engineer_name = "";
$engneer_name_phonetic = "";

$customer_name = "";

$dd_office = "";
$dd_name = "";
$dd_address = "";
$dd_tel = "";
$dd_fax = "";

$claim_agreement_start = "";
$claim_agreement_end = "";
$work_start = "";
$work_end = "";
$break_start = "";
$break_end = "";

$chs_date1 = "";
$chs_status1 = "";
$chs_date2 = "";
$chs_status2 = "";
$chs_date3 = "";
$chs_status3 = "";
$chs_date4 = "";
$chs_status4 = "";

$dm_responsible_position = "";
$dm_responsible_name = "";

$dd_responsible_position = "";
$dd_responsible_name = "";

$employment_date1 = "";
$employment_status1 = "";
$employment_date2 = "";
$employment_status2 = "";
$employment_date3 = "";
$employment_status3 = "";
$employment_date4 = "";
$employment_status4 = "";

$dd_worker_name = "";
$dd_worker_business = "";
$dd_worker_holiday_start = "";
$dd_worker_holiday_end = "";

$employment_insurance = "";
$health_insurance = "";
$welfare_pension = "";
$jurisdiction = "";
$specified_worker = "";

function set_10600_selectDB()
{
    $a_sql_src = "SELECT t1.*,";
    $a_sql_src .= "
 t2.dm_no				
,t2.dd_office			
,t2.dd_fax				
,t2.chs_date1			
,t2.chs_status1			
,t2.chs_date2			
,t2.chs_status2			
,t2.chs_date3			
,t2.chs_status3			
,t2.chs_date4			
,t2.chs_status4			
,t2.employment_date1	
,t2.employment_status1	
,t2.employment_date2	
,t2.employment_status2	
,t2.employment_date3	
,t2.employment_status3	
,t2.employment_date4	
,t2.employment_status4	
,t2.dd_worker_name		
,t2.dd_worker_business	
,t2.dd_worker_holiday_start
,t2.dd_worker_holiday_end
,t2.employment_insurance
,t2.health_insurance	
,t2.welfare_pension		
,t2.jurisdiction		
,t2.specified_worker
        ";
    $a_sql_src .= " FROM ".$GLOBALS['g_DB_t_contract_report']." t1";
    $a_sql_src .= " LEFT JOIN ";
    $a_sql_src .= $GLOBALS['g_DB_t_dispatching_management_ledger']." t2";
    $a_sql_src .= " ON (t1.cr_id=t2.cr_id)";
    /*$a_sql .= " LEFT JOIN ";
    $a_sql .= $GLOBALS['g_DB_t_agreement_ledger']." t3";
    $a_sql .= " ON (t1.cr_id=t3.cr_id)";*/
    
    return $a_sql_src;
}

function set_10600_fromDB($a_result)
{
    $GLOBALS['cr_id'] = $a_result['cr_id'];
    $GLOBALS['dm_no'] = $a_result['dm_no'];
    $GLOBALS['contract_number'] = $a_result['contract_number'];
    $GLOBALS['payment_contract_form'] = $a_result['payment_contract_form'];
    $GLOBALS['engineer_name'] = $a_result['engineer_name'];
    $GLOBALS['engneer_name_phonetic'] = $a_result['engneer_name_phonetic'];

    $GLOBALS['customer_name'] = $a_result['customer_name'];

    $GLOBALS['dd_office'] = $a_result['dd_office'];
    $GLOBALS['dd_name'] = $a_result['dd_name'];
    $GLOBALS['dd_address'] = $a_result['dd_address'];
    $GLOBALS['dd_tel'] = $a_result['dd_tel'];
    $GLOBALS['dd_fax'] = $a_result['dd_fax'];

    $GLOBALS['claim_agreement_start'] = str_replace("-", "/", $a_result['claim_agreement_start']);
    $GLOBALS['claim_agreement_end'] = str_replace("-", "/", $a_result['claim_agreement_end']);
    $GLOBALS['work_start'] = substr($a_result['work_start'], 0, 5);
    $GLOBALS['work_end'] = substr($a_result['work_end'], 0, 5);
    $GLOBALS['break_start'] = substr($a_result['break_start'], 0, 5);
    $GLOBALS['break_end'] = substr($a_result['break_end'], 0, 5);

    $GLOBALS['chs_date1'] = com_replace_toDate($a_result['chs_date1']);
    $GLOBALS['chs_status1'] = $a_result['chs_status1'];
    $GLOBALS['chs_date2'] = com_replace_toDate($a_result['chs_date2']);
    $GLOBALS['chs_status2'] = $a_result['chs_status2'];
    $GLOBALS['chs_date3'] = com_replace_toDate($a_result['chs_date3']);
    $GLOBALS['chs_status3'] = $a_result['chs_status3'];
    $GLOBALS['chs_date4'] = com_replace_toDate($a_result['chs_date4']);
    $GLOBALS['chs_status4'] = $a_result['chs_status4'];

    $GLOBALS['dm_responsible_position'] = $a_result['dm_responsible_position'];
    $GLOBALS['dm_responsible_name'] = $a_result['dm_responsible_name'];

    $GLOBALS['dd_responsible_position'] = $a_result['dd_responsible_position'];
    $GLOBALS['dd_responsible_name'] = $a_result['dd_responsible_name'];

    $GLOBALS['employment_date1'] = com_replace_toDate($a_result['employment_date1']);
    $GLOBALS['employment_status1'] = $a_result['employment_status1'];
    $GLOBALS['employment_date2'] = com_replace_toDate($a_result['employment_date2']);
    $GLOBALS['employment_status2'] = $a_result['employment_status2'];
    $GLOBALS['employment_date3'] = com_replace_toDate($a_result['employment_date3']);
    $GLOBALS['employment_status3'] = $a_result['employment_status3'];
    $GLOBALS['employment_date4'] = com_replace_toDate($a_result['employment_date4']);
    $GLOBALS['employment_status4'] = $a_result['employment_status4'];

    $GLOBALS['dd_worker_name'] = $a_result['dd_worker_name'];
    $GLOBALS['dd_worker_business'] = $a_result['dd_worker_business'];
    $GLOBALS['dd_worker_holiday_start'] = com_replace_toDate($a_result['dd_worker_holiday_start']);
    $GLOBALS['dd_worker_holiday_end'] = com_replace_toDate($a_result['dd_worker_holiday_end']);

    $GLOBALS['employment_insurance'] = $a_result['employment_insurance'];
    $GLOBALS['health_insurance'] = $a_result['health_insurance'];
    $GLOBALS['welfare_pension'] = $a_result['welfare_pension'];
    $GLOBALS['jurisdiction'] = $a_result['jurisdiction'];
    $GLOBALS['specified_worker'] = $a_result['specified_worker'];
}

?>
