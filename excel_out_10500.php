<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./global.php');
require_once($GLOBALS['g_EXCEL_LIB_PATH']."PHPExcel.php");
require_once($GLOBALS['g_EXCEL_LIB_PATH']."PHPExcel/IOFactory.php");

require_once('./10500-com.php');

//読み書きするファイルのパスを設定
$target_file = $GLOBALS['g_EXCEL_TEMPLATE_PATH'].$GLOBALS['g_EXCEL_CONTRACT_10500'];

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
 t2.ag_no
,t2.publication
,t2.dd_office
,t2.dd_address
,t2.dd_tel
,t2.ip_position
,t2.ip_name
,t2.dm_responsible_position
,t2.dm_responsible_name
,t2.dd_responsible_position
,t2.dd_responsible_name
,t2.person_post_no
,t2.person_address
,t2.person_birthday
,t2.contact_date_org
,t2.contact_date_brn
,t2.organization
,t2.conflict_prevention
,t2.thing1
,t2.chs_position1
,t2.chs_name1
,t2.chs_position2
,t2.chs_name2
,t2.chs_tel2
,t2.dd_responsible_tel
,t2.reserve1
,t2.reserve2
,t2.reserve3
,t2.reserve4
,t2.reserve5
,t2.reserve6
,t2.reserve7
,t2.guide_ships
    ";
    $a_sql .= " FROM ".$GLOBALS['g_DB_t_contract_report']." t1";
    $a_sql .= " LEFT JOIN ";
    $a_sql .= $GLOBALS['g_DB_t_agreement_ledger']." t2";
    $a_sql .= " ON (t1.cr_id=t2.cr_id)";
    $a_sql .= " ORDER BY t2.ag_no;";

    $a_stmt = $a_conn->prepare($a_sql);
    $a_stmt->execute();

    //PHPExcelでは、rowは1始まり、colは0始まりのようである。
    $a_row = 6;
    while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){

        set_10500_fromDB($a_result);
        
        $obj_sheet->setCellValueByColumnAndRow(0, $a_row, $ag_no);
        $obj_sheet->setCellValueByColumnAndRow(1, $a_row, $contract_number);
        $obj_sheet->setCellValueByColumnAndRow(2, $a_row, $publication);
        
        $obj_sheet->setCellValueByColumnAndRow(3, $a_row, $engineer_number);
        $obj_sheet->setCellValueByColumnAndRow(4, $a_row, $engineer_name);
        $obj_sheet->setCellValueByColumnAndRow(5, $a_row, $engneer_name_phonetic);

        $obj_sheet->setCellValueByColumnAndRow(6, $a_row, $customer_name);
        $obj_sheet->setCellValueByColumnAndRow(7, $a_row, $claim_contract_form);
        $obj_sheet->setCellValueByColumnAndRow(8, $a_row, $claim_agreement_start);
        $obj_sheet->setCellValueByColumnAndRow(9, $a_row, $claim_agreement_end);
        
        $obj_sheet->setCellValueByColumnAndRow(10, $a_row, $work_start);
        $obj_sheet->setCellValueByColumnAndRow(11, $a_row, $work_end);
        $obj_sheet->setCellValueByColumnAndRow(12, $a_row, $work_hours);
        $obj_sheet->setCellValueByColumnAndRow(13, $a_row, $break_start);
        $obj_sheet->setCellValueByColumnAndRow(14, $a_row, $break_end);
        $obj_sheet->setCellValueByColumnAndRow(15, $a_row, $break_hours);
        $obj_sheet->setCellValueByColumnAndRow(16, $a_row, $social_insurance);
        $obj_sheet->setCellValueByColumnAndRow(17, $a_row, $tax_withholding);

        $obj_sheet->setCellValueByColumnAndRow(18, $a_row, $payment_normal_calculation_2);
        $obj_sheet->setCellValueByColumnAndRow(19, $a_row, $payment_normal_unit_price_2);
        $obj_sheet->setCellValueByColumnAndRow(20, $a_row, $payment_normal_lower_limit_2);
        $obj_sheet->setCellValueByColumnAndRow(21, $a_row, $payment_normal_upper_limit_2);
        $obj_sheet->setCellValueByColumnAndRow(22, $a_row, $payment_normal_deduction_unit_price_2);
        $obj_sheet->setCellValueByColumnAndRow(23, $a_row, $payment_normal_overtime_unit_price_2);
        
        $obj_sheet->setCellValueByColumnAndRow(24, $a_row, $payment_middle_calculation_2);
        $obj_sheet->setCellValueByColumnAndRow(25, $a_row, $payment_middle_unit_price_2);
        $obj_sheet->setCellValueByColumnAndRow(26, $a_row, $payment_middle_lower_limit_2);
        $obj_sheet->setCellValueByColumnAndRow(27, $a_row, $payment_middle_upper_limit_2);
        $obj_sheet->setCellValueByColumnAndRow(28, $a_row, $payment_middle_deduction_unit_price_2);
        $obj_sheet->setCellValueByColumnAndRow(29, $a_row, $payment_middle_overtime_unit_price_2);
        
        $obj_sheet->setCellValueByColumnAndRow(30, $a_row, $payment_leaving_calculation_2);
        $obj_sheet->setCellValueByColumnAndRow(31, $a_row, $payment_leaving_unit_price_2);
        $obj_sheet->setCellValueByColumnAndRow(32, $a_row, $payment_leaving_lower_limit_2);
        $obj_sheet->setCellValueByColumnAndRow(33, $a_row, $payment_leaving_upper_limit_2);
        $obj_sheet->setCellValueByColumnAndRow(34, $a_row, $payment_leaving_deduction_unit_price_2);
        $obj_sheet->setCellValueByColumnAndRow(35, $a_row, $payment_leaving_overtime_unit_price_2);
        
        $obj_sheet->setCellValueByColumnAndRow(36, $a_row, $payment_hourly_daily);
        $obj_sheet->setCellValueByColumnAndRow(37, $a_row, $payment_hourly_monthly);
        $obj_sheet->setCellValueByColumnAndRow(38, $a_row, $payment_settlement_closingday);
        $obj_sheet->setCellValueByColumnAndRow(39, $a_row, $payment_settlement_paymentday);
        $obj_sheet->setCellValueByColumnAndRow(40, $a_row, $remarks);

        $obj_sheet->setCellValueByColumnAndRow(41, $a_row, $dd_office);
        $obj_sheet->setCellValueByColumnAndRow(42, $a_row, $dd_address);
        $obj_sheet->setCellValueByColumnAndRow(43, $a_row, $dd_tel);
        $obj_sheet->setCellValueByColumnAndRow(44, $a_row, $ip_position);
        $obj_sheet->setCellValueByColumnAndRow(45, $a_row, $ip_name);
        $obj_sheet->setCellValueByColumnAndRow(46, $a_row, $dm_responsible_position);
        $obj_sheet->setCellValueByColumnAndRow(47, $a_row, $dm_responsible_name);
        $obj_sheet->setCellValueByColumnAndRow(48, $a_row, $dd_responsible_position);
        $obj_sheet->setCellValueByColumnAndRow(49, $a_row, $dd_responsible_name);
        
        $obj_sheet->setCellValueByColumnAndRow(50, $a_row, $person_post_no);
        $obj_sheet->setCellValueByColumnAndRow(51, $a_row, $person_address);
        $obj_sheet->setCellValueByColumnAndRow(52, $a_row, $person_birthday);
        $obj_sheet->setCellValueByColumnAndRow(53, $a_row, "");
        $obj_sheet->setCellValueByColumnAndRow(54, $a_row, "");
        $obj_sheet->setCellValueByColumnAndRow(55, $a_row, "");
        
        $obj_sheet->setCellValueByColumnAndRow(56, $a_row, $contact_date_org);
        $obj_sheet->setCellValueByColumnAndRow(57, $a_row, $contact_date_brn);
        $obj_sheet->setCellValueByColumnAndRow(58, $a_row, $organization);
        $obj_sheet->setCellValueByColumnAndRow(59, $a_row, $conflict_prevention);
        #$obj_sheet->setCellValueByColumnAndRow(60, $a_row, $thing1);

        $obj_sheet->setCellValueByColumnAndRow(60, $a_row, $chs_position1);
        $obj_sheet->setCellValueByColumnAndRow(61, $a_row, $chs_name1);
        $obj_sheet->setCellValueByColumnAndRow(62, $a_row, $chs_position2);
        $obj_sheet->setCellValueByColumnAndRow(63, $a_row, $chs_name2);
        $obj_sheet->setCellValueByColumnAndRow(64, $a_row, $chs_tel2);
        $obj_sheet->setCellValueByColumnAndRow(65, $a_row, $dd_responsible_tel);
        /*
        $obj_sheet->setCellValueByColumnAndRow(67, $a_row, $reserve1);
        $obj_sheet->setCellValueByColumnAndRow(68, $a_row, $reserve2);
        $obj_sheet->setCellValueByColumnAndRow(69, $a_row, $reserve3);
        $obj_sheet->setCellValueByColumnAndRow(70, $a_row, $reserve4);
        $obj_sheet->setCellValueByColumnAndRow(71, $a_row, $reserve5);
        $obj_sheet->setCellValueByColumnAndRow(72, $a_row, $reserve6);
        $obj_sheet->setCellValueByColumnAndRow(73, $a_row, $reserve7);
        */
        $obj_sheet->setCellValueByColumnAndRow(66, $a_row, $guide_ships);

        $a_row++;
    }
} catch (PDOException $e){
    echo 'Error:'.$e->getMessage();
    //die();
}

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment;filename='".$GLOBALS['g_EXCEL_CONTRACT_10500']."'");
header("Cache-Control: max-age=0");

$obj_writer = PHPExcel_IOFactory::createWriter($obj_book, 'Excel2007');
$obj_writer->save("php://output"); 

exit;

?>
