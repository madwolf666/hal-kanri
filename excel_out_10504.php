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

if (isset($_GET['NO'])) {
    $a_no = $_GET['NO'];
    try{
        //DBからユーザ情報取得
        $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
        $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $a_sql = set_10500_selectDB();

        $a_sql .= " WHERE (t1.cr_id=:cr_id);";

        $a_stmt = $a_conn->prepare($a_sql);
        $a_stmt->bindParam(':cr_id', $a_no, PDO::PARAM_STR);
        $a_stmt->execute();

        while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
            set_10500_fromDB($a_result);
        }
    } catch (PDOException $e){
        echo 'Error:'.$e->getMessage();
        die();
    }
}

//読み書きするファイルのパスを設定
$target_file = $GLOBALS['g_EXCEL_TEMPLATE_PATH'].$GLOBALS['g_EXCEL_CONTRACT_10504'];

//1. リーダーを作成して既存ファイルを読み込む
$obj_reader = PHPExcel_IOFactory::createReader('Excel2007');
$obj_book   = $obj_reader->load($target_file);

//2. ファイルを編集（先頭のシートのA1セルに文字列を書き込み）
$obj_sheet = $obj_book->getSheet(0);

$obj_sheet->setCellValue("E6", $engineer_name);

$obj_sheet->setCellValue("H13", $skill_type);

$obj_sheet->setCellValue("J18", $dd_name);
$obj_sheet->setCellValue("J20", $dd_branch);
$obj_sheet->setCellValue("J22", $dd_address);
$obj_sheet->setCellValue("J24", $dd_tel);

$obj_sheet->setCellValue("H26", $organization);

$obj_sheet->setCellValue("I29", $ip_position);
$obj_sheet->setCellValue("Q29", $ip_name);

com_setValue_Date($claim_agreement_start,  $obj_sheet, "H32", "yyyy年MM月dd日");
com_setValue_Date($claim_agreement_end,  $obj_sheet, "P32", "yyyy年MM月dd日");

$obj_sheet->setCellValue("H35", $contact_date_org);

$obj_sheet->setCellValue("H41", $work_start."から".$work_end.chr(13)."（うち休憩時間　".$break_start."から".$break_end."までの間".$break_hours."）");

$obj_sheet->setCellValue("I56", $dd_responsible_position);
$obj_sheet->setCellValue("P56", $dd_responsible_name);
$obj_sheet->setCellValue("W56", $dd_responsible_tel);

$obj_sheet->setCellValue("I59", $dm_responsible_position);
$obj_sheet->setCellValue("P59", $dm_responsible_name);

$obj_sheet->setCellValue("L69", $chs_position2);
$obj_sheet->setCellValue("Q69", $chs_name2);
$obj_sheet->setCellValue("W69", $chs_tel2);

$obj_sheet->setCellValue("L71", $chs_position1);
$obj_sheet->setCellValue("Q71", $chs_name1);

$obj_sheet->setCellValue("I113", com_db_number_format($payment_normal_unit_price_2));

$a_biko= "";
if ($remarks != ''){
    $a_biko .= chr(13).$remarks.chr(13);
}
if ($remarks_pay != ''){
    #$a_biko .= chr(13).$remarks_pay.chr(13);
}
if ($payment_middle_unit_price_2 != ''){
    $a_biko .= chr(13).'【途中入場】';
    $a_biko .= chr(13).'  単価：'. com_db_number_format_symbol($payment_middle_unit_price_2);
    $a_biko .= chr(13).'  上限時間：'.$payment_middle_upper_limit_2.'h';
    $a_biko .= chr(13).'  下限時間：'.$payment_middle_lower_limit_2.'h';
    $a_biko .= chr(13).'  控除単価：'. com_db_number_format_symbol($payment_middle_deduction_unit_price_2);
    $a_biko .= chr(13).'  超過単価：'. com_db_number_format_symbol($payment_middle_overtime_unit_price_2);
    $a_biko .= chr(13);
}
if ($payment_leaving_unit_price_2 != ''){
    $a_biko .= chr(13).'【途中退場】';
    $a_biko .= chr(13).'  単価：'. com_db_number_format_symbol($payment_leaving_unit_price_2);
    $a_biko .= chr(13).'  上限時間：'.$payment_leaving_upper_limit_2.'h';
    $a_biko .= chr(13).'  下限時間：'.$payment_leaving_lower_limit_2.'h';
    $a_biko .= chr(13).'  控除単価：'. com_db_number_format_symbol($payment_leaving_deduction_unit_price_2);
    $a_biko .= chr(13).'  超過単価：'. com_db_number_format_symbol($payment_leaving_overtime_unit_price_2);
    $a_biko .= chr(13);
}

$obj_sheet->setCellValue("H118", $a_biko);

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment;filename='".$GLOBALS['g_EXCEL_CONTRACT_10504']."'");
header("Cache-Control: max-age=0");

$obj_writer = PHPExcel_IOFactory::createWriter($obj_book, 'Excel2007');
$obj_writer->save("php://output"); 

exit;

?>
