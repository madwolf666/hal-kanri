<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./global.php');
require_once($GLOBALS['g_EXCEL_LIB_PATH']."PHPExcel.php");
require_once($GLOBALS['g_EXCEL_LIB_PATH']."PHPExcel/IOFactory.php");

if (!isset($_GET['ACT'])){
    $a_act = '';
}else{
    $a_act = $_GET['ACT'];
}

require_once('./10100-com.php');

$a_kind = "";

if (isset($_GET['NO'])) {
    $a_no = $_GET['NO'];
    $a_kind = $_GET['KIND'];
    try{
        //DBからユーザ情報取得
        $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
        $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $a_sql_src = set_10100_selectDB();

        $a_sql = "SELECT s1.*";
        $a_sql .= " FROM (".$a_sql_src.") s1";
        $a_sql .= " WHERE (s1.cr_id=:cr_id)";
        /*
        $a_sql = "SELECT s1.*";
        $a_sql .= ",s2.estimate_no,s2.estimate_date";
        $a_sql .= " FROM (".$a_sql_src.") s1 LEFT JOIN ".$GLOBALS['g_DB_t_contract_estimate']." s2";
        $a_sql .= " ON (s1.cr_id=s2.cr_id)";
        $a_sql .= " WHERE (s1.cr_id=:cr_id)";
         */

        $a_stmt = $a_conn->prepare($a_sql);
        $a_stmt->bindParam(':cr_id', $a_no, PDO::PARAM_STR);
        $a_stmt->execute();

        while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
            set_10100_fromDB($a_result);
        }
    } catch (PDOException $e){
        echo 'Error:'.$e->getMessage();
        die();
    }
}

$a_target_kind = "";
$a_target_sheet = "";
$a_target_cell_name = "";
$a_target_cell_charge = "";
$a_target_cell_charge2 = "";

if ($a_kind == "1"){
    $a_target_kind = "contrcat_10108_1.xlsx";
    $a_target_sheet = "入力フォーム";
    $a_target_cell_name = "G5";
    $a_target_cell_charge = "G7";
}elseif ($a_kind == "2"){
    $a_target_kind = "contrcat_10108_2.xlsx";
    $a_target_sheet = "入力フォーム";
    $a_target_cell_name = "G5";
    $a_target_cell_charge = "G7";
}elseif ($a_kind == "3"){
    $a_target_kind = "contrcat_10108_3.xlsx";
    $a_target_sheet = "入力フォーム";
    $a_target_cell_name = "G8";
    $a_target_cell_charge = "G16";
}elseif ($a_kind == "4"){
    $a_target_kind = "contrcat_10108_4.xlsx";
    $a_target_sheet = "入力フォーム";
    $a_target_cell_name = "G8";
    $a_target_cell_charge = "G16";
    $a_target_cell_charge2 = "G17";
}
//読み書きするファイルのパスを設定
$target_file = $GLOBALS['g_EXCEL_TEMPLATE_PATH'].$a_target_kind;

//1. リーダーを作成して既存ファイルを読み込む
$obj_reader = PHPExcel_IOFactory::createReader('Excel2007');
$obj_book   = $obj_reader->load($target_file);

//2. ファイルを編集（先頭のシートのA1セルに文字列を書き込み）
$obj_sheet = $obj_book->getSheetByName($a_target_sheet);
//$obj_sheet->setCellValue("A1", "Hello, PHPExcel!");

$obj_sheet->setCellValue($a_target_cell_name, $txt_engineer_name);
$obj_sheet->setCellValue($a_target_cell_charge, str_replace(",", "", $inp_tankin_b1));
if ($a_target_cell_charge2 != ""){
    $obj_sheet->setCellValue($a_target_cell_charge2, str_replace(",", "", $inp_tankin_b1));
}

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment;filename='".$a_target_kind."'");
header("Cache-Control: max-age=0");

$obj_writer = PHPExcel_IOFactory::createWriter($obj_book, 'Excel2007');
$obj_writer->save("php://output"); 

exit;

?>
