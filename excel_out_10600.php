<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./global.php');
require_once($GLOBALS['g_EXCEL_LIB_PATH']."PHPExcel.php");
require_once($GLOBALS['g_EXCEL_LIB_PATH']."PHPExcel/IOFactory.php");

require_once('./10600-com.php');

//読み書きするファイルのパスを設定
$target_file = $GLOBALS['g_EXCEL_TEMPLATE_PATH'].$GLOBALS['g_EXCEL_CONTRACT_10600'];

//1. リーダーを作成して既存ファイルを読み込む
$obj_reader = PHPExcel_IOFactory::createReader('Excel2007');
$obj_book   = $obj_reader->load($target_file);

//2. ファイルを編集（先頭のシートのA1セルに文字列を書き込み）
$obj_sheet = $obj_book->getSheet(0);

try{
    //DBからユーザ情報取得
    $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
    $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //一覧出力は何順？
    $a_sql = "SELECT t1.*,";
    $a_sql .= "
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
,t2.dm_responsible_position
,t2.dm_responsible_name	
,t2.dd_responsible_position
,t2.dd_responsible_name	
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
    $a_sql .= " FROM ".$GLOBALS['g_DB_t_contract_report']." t1";
    $a_sql .= " LEFT JOIN ";
    $a_sql .= $GLOBALS['g_DB_t_dispatching_management_ledger']." t2";
    $a_sql .= " ON (t1.cr_id=t2.cr_id)";
    /*$a_sql .= " LEFT JOIN ";
    $a_sql .= $GLOBALS['g_DB_t_agreement_ledger']." t3";
    $a_sql .= " ON (t1.cr_id=t3.cr_id)";
    $a_sql .= " ORDER BY t2.dm_no;";*/

    $a_stmt = $a_conn->prepare($a_sql);
    $a_stmt->execute();

    //PHPExcelでは、rowは1始まり、colは0始まりのようである。
    $a_row = 4;
    while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){

        set_10600_fromDB($a_result);
        
        $obj_sheet->setCellValueByColumnAndRow(0, $a_row, $dm_no);
        $obj_sheet->setCellValueByColumnAndRow(1, $a_row, $contract_number);
        $obj_sheet->setCellValueByColumnAndRow(2, $a_row, $payment_contract_form);
        $obj_sheet->setCellValueByColumnAndRow(3, $a_row, $engineer_name);
        $obj_sheet->setCellValueByColumnAndRow(4, $a_row, $engneer_name_phonetic);
        
        $obj_sheet->setCellValueByColumnAndRow(5, $a_row, $customer_name);
        
        $obj_sheet->setCellValueByColumnAndRow(6, $a_row, $dd_office);
        $obj_sheet->setCellValueByColumnAndRow(7, $a_row, $dd_name);
        $obj_sheet->setCellValueByColumnAndRow(8, $a_row, $dd_address);
        $obj_sheet->setCellValueByColumnAndRow(9, $a_row, $dd_tel);
        $obj_sheet->setCellValueByColumnAndRow(10, $a_row, $dd_fax);
        
        $obj_sheet->setCellValueByColumnAndRow(11, $a_row, $claim_agreement_start);
        $obj_sheet->setCellValueByColumnAndRow(12, $a_row, $claim_agreement_end);
        $obj_sheet->setCellValueByColumnAndRow(13, $a_row, $work_start);
        $obj_sheet->setCellValueByColumnAndRow(14, $a_row, $work_end);
        $obj_sheet->setCellValueByColumnAndRow(15, $a_row, $break_start);
        $obj_sheet->setCellValueByColumnAndRow(16, $a_row, $break_end);
        
        $obj_sheet->setCellValueByColumnAndRow(17, $a_row, $chs_date1);
        $obj_sheet->setCellValueByColumnAndRow(18, $a_row, $chs_status1);
        $obj_sheet->setCellValueByColumnAndRow(19, $a_row, $chs_date2);
        $obj_sheet->setCellValueByColumnAndRow(20, $a_row, $chs_status2);
        $obj_sheet->setCellValueByColumnAndRow(21, $a_row, $chs_date3);
        $obj_sheet->setCellValueByColumnAndRow(22, $a_row, $chs_status3);
        $obj_sheet->setCellValueByColumnAndRow(23, $a_row, $chs_date4);
        $obj_sheet->setCellValueByColumnAndRow(24, $a_row, $chs_status4);

        $obj_sheet->setCellValueByColumnAndRow(25, $a_row, $dm_responsible_position);
        $obj_sheet->setCellValueByColumnAndRow(26, $a_row, $dm_responsible_name);
        
        $obj_sheet->setCellValueByColumnAndRow(27, $a_row, $dd_responsible_position);
        $obj_sheet->setCellValueByColumnAndRow(28, $a_row, $dd_responsible_name);
        
        $obj_sheet->setCellValueByColumnAndRow(29, $a_row, $employment_date1);
        $obj_sheet->setCellValueByColumnAndRow(30, $a_row, $employment_status1);
        $obj_sheet->setCellValueByColumnAndRow(31, $a_row, $employment_date2);
        $obj_sheet->setCellValueByColumnAndRow(32, $a_row, $employment_status2);
        $obj_sheet->setCellValueByColumnAndRow(33, $a_row, $employment_date3);
        $obj_sheet->setCellValueByColumnAndRow(34, $a_row, $employment_status3);
        $obj_sheet->setCellValueByColumnAndRow(35, $a_row, $employment_date4);
        $obj_sheet->setCellValueByColumnAndRow(36, $a_row, $employment_status4);
        
        $obj_sheet->setCellValueByColumnAndRow(37, $a_row, $dd_worker_name);
        $obj_sheet->setCellValueByColumnAndRow(38, $a_row, $dd_worker_business);
        $obj_sheet->setCellValueByColumnAndRow(39, $a_row, $dd_worker_holiday_start);
        $obj_sheet->setCellValueByColumnAndRow(40, $a_row, $dd_worker_holiday_end);
        
        $obj_sheet->setCellValueByColumnAndRow(41, $a_row, $employment_insurance);
        $obj_sheet->setCellValueByColumnAndRow(42, $a_row, $health_insurance);
        $obj_sheet->setCellValueByColumnAndRow(43, $a_row, $welfare_pension);
        $obj_sheet->setCellValueByColumnAndRow(44, $a_row, $jurisdiction);
        $obj_sheet->setCellValueByColumnAndRow(45, $a_row, $specified_worker);
        
        $a_row++;
    }
} catch (PDOException $e){
    echo 'Error:'.$e->getMessage();
    //die();
}

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment;filename='".$GLOBALS['g_EXCEL_CONTRACT_10600']."'");
header("Cache-Control: max-age=0");

$obj_writer = PHPExcel_IOFactory::createWriter($obj_book, 'Excel2007');
$obj_writer->save("php://output"); 

exit;

?>
