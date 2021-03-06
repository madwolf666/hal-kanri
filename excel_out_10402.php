<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./global.php');
require_once($GLOBALS['g_EXCEL_LIB_PATH']."PHPExcel.php");
require_once($GLOBALS['g_EXCEL_LIB_PATH']."PHPExcel/IOFactory.php");

require_once('./10400-com.php');

if (isset($_GET['NO'])) {
    $a_no = $_GET['NO'];
    try{
        //DBからユーザ情報取得
        $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
        $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $a_sql = set_10400_selectDB();

        $a_sql .= " WHERE (t1.cr_id=:cr_id);";

        $a_stmt = $a_conn->prepare($a_sql);
        $a_stmt->bindParam(':cr_id', $a_no, PDO::PARAM_STR);
        $a_stmt->execute();

        while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
            set_10400_fromDB($a_result);
        }
    } catch (PDOException $e){
        echo 'Error:'.$e->getMessage();
        die();
    }
}

//読み書きするファイルのパスを設定
$target_file = $GLOBALS['g_EXCEL_TEMPLATE_PATH'].$GLOBALS['g_EXCEL_CONTRACT_10402'];

//1. リーダーを作成して既存ファイルを読み込む
$obj_reader = PHPExcel_IOFactory::createReader('Excel2007');
$obj_book   = $obj_reader->load($target_file);

//2. ファイルを編集（先頭のシートのA1セルに文字列を書き込み）
$obj_sheet = $obj_book->getSheet(0);
        
$obj_sheet->setCellValue("A3", $customer_name);

com_setValue_Date($publication,  $obj_sheet, "AE3", "yyyy年MM月dd日");
#$obj_sheet->setCellValue("AE4", $po_no);
$obj_sheet->setCellValue("AE4", $ag_no);

$obj_sheet->setCellValue("L10", $claim_contract_form);
com_setValue_Date($claim_agreement_start,  $obj_sheet, "L11", "yyyy年MM月dd日");
com_setValue_Date($claim_agreement_end,  $obj_sheet, "L12", "yyyy年MM月dd日");
$obj_sheet->setCellValue("L13", $engineer_name);
$obj_sheet->setCellValue("M16", $payment_normal_unit_price_1);
$obj_sheet->setCellValue("M17", $payment_normal_calculation_1);

$obj_sheet->setCellValue("M18", $payment_normal_lower_limit_1);
$obj_sheet->setCellValue("M19", $payment_normal_upper_limit_1);
$obj_sheet->setCellValue("M20", $payment_normal_deduction_unit_price_1);
$obj_sheet->setCellValue("M21", $payment_normal_overtime_unit_price_1);

$obj_sheet->setCellValue("O22", $payment_hourly_monthly);
$obj_sheet->setCellValue("R23", $payment_settlement_closingday);
$obj_sheet->setCellValue("AE23", $payment_settlement_paymentday);

$obj_sheet->setCellValue("L24", $remarks1.chr(13).$remarks2.chr(13).$remarks3.chr(13).$remarks4);

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment;filename='".$GLOBALS['g_EXCEL_CONTRACT_10402']."'");
header("Cache-Control: max-age=0");

$obj_writer = PHPExcel_IOFactory::createWriter($obj_book, 'Excel2007');
$obj_writer->save("php://output"); 

exit;

?>
