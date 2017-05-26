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
$target_file = $GLOBALS['g_EXCEL_TEMPLATE_PATH'].$GLOBALS['g_EXCEL_CONTRACT_10503'];

//1. リーダーを作成して既存ファイルを読み込む
$obj_reader = PHPExcel_IOFactory::createReader('Excel2007');
$obj_book   = $obj_reader->load($target_file);

//2. ファイルを編集（先頭のシートのA1セルに文字列を書き込み）
$obj_sheet = $obj_book->getSheet(0);

$obj_sheet->setCellValue("Z1", $ag_no);

$obj_sheet->setCellValue("E4", $engneer_name_phonetic);

$obj_sheet->setCellValue("E5", $engineer_name);

$obj_sheet->setCellValue("X5", $person_birthday);

$obj_sheet->setCellValue("G11", $person_post_no);
$obj_sheet->setCellValue("E12", $person_address);

com_setValue_Date($claim_agreement_start,  $obj_sheet, "E15", "yyyy年MM月dd日");
com_setValue_Date($claim_agreement_end,  $obj_sheet, "E17", "yyyy年MM月dd日");

$obj_sheet->setCellValue("W15", $claim_normal__unit_price);
$obj_sheet->setCellValue("W23", $claim_normal_lower_limit);
$obj_sheet->setCellValue("W21", $claim_normal_upper_limit);
$obj_sheet->setCellValue("W19", $claim_normal_deduction_unit_price);
$obj_sheet->setCellValue("W17", $claim_normal_overtime_unit_price);

$obj_sheet->setCellValue("E22", $work_start."から".$work_end.chr(13)."（うち休憩時間　".$break_start."から".$break_end."までの間".$break_hours."）");

$obj_sheet->setCellValue("W29", $claim_settlement_closingday);
$obj_sheet->setCellValue("AB29", $claim_settlement_paymentday);
$obj_sheet->setCellValue("W31", $payment_settlement_closingday);
$obj_sheet->setCellValue("AB31", $payment_settlement_paymentday);

com_setValue_Date($contact_date_org,  $obj_sheet, "H31", "yyyy年MM月dd日");
$obj_sheet->setCellValue("Q33", $dd_office);
$obj_sheet->setCellValue("Q35", $organization);
$obj_sheet->setCellValue("Q37", $dd_address);
$obj_sheet->setCellValue("Q39", $dd_tel);

$obj_sheet->setCellValue("Q41", $ip_position);
$obj_sheet->setCellValue("U41", $ip_name);
$obj_sheet->setCellValue("Q43", $dd_responsible_position);
$obj_sheet->setCellValue("U43", $dd_responsible_name);
$obj_sheet->setCellValue("Q45", $dm_responsible_position);
$obj_sheet->setCellValue("U45", $dm_responsible_name);

$obj_sheet->setCellValue("Q47", $chs_position1);
$obj_sheet->setCellValue("U47", $chs_name1);
$obj_sheet->setCellValue("Q49", $chs_position2);
$obj_sheet->setCellValue("U49", $chs_name2);

$obj_sheet->setCellValue("E70", $remarks);

com_setValue_Date($publication,  $obj_sheet, "B84", "yyyy年MM月dd日");

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment;filename='".$GLOBALS['g_EXCEL_CONTRACT_10503']."'");
header("Cache-Control: max-age=0");

$obj_writer = PHPExcel_IOFactory::createWriter($obj_book, 'Excel2007');
$obj_writer->save("php://output"); 

exit;

?>
