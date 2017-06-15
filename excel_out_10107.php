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

$inp_estimate_no = "";
$inp_estimate_date = "";

if (isset($_GET['NO'])) {
    $a_no = $_GET['NO'];
    try{
        //DBからユーザ情報取得
        $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
        $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $a_sql = set_10100_selectDB();

        $a_sql = "SELECT s1.*, s2.* FROM (".$a_sql.") s1 LEFT JOIN ".$GLOBALS['g_DB_t_contract_estimate']." s2";
        $a_sql .= " ON (s1.cr_id=s2.cr_id)";
        $a_sql .= " WHERE (s1.cr_id=:cr_id)";

        $a_stmt = $a_conn->prepare($a_sql);
        $a_stmt->bindParam(':cr_id', $a_no, PDO::PARAM_STR);
        $a_stmt->execute();

        while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
            set_10100_fromDB($a_result);

            $inp_estimate_no = $a_result['estimate_no'];
            $inp_estimate_date = str_replace("-", "/", $a_result['estimate_date']);
        }
    } catch (PDOException $e){
        echo 'Error:'.$e->getMessage();
        die();
    }
}

//読み書きするファイルのパスを設定
$target_file = $GLOBALS['g_EXCEL_TEMPLATE_PATH'].$GLOBALS['g_EXCEL_CONTRACT_10107'];

//1. リーダーを作成して既存ファイルを読み込む
$obj_reader = PHPExcel_IOFactory::createReader('Excel2007');
$obj_book   = $obj_reader->load($target_file);

//2. ファイルを編集（先頭のシートのA1セルに文字列を書き込み）
$obj_sheet = $obj_book->getSheet(0);
//$obj_sheet->setCellValue("A1", "Hello, PHPExcel!");

#$obj_sheet->setCellValue("M2",$inp_estimate_no);
com_setValue_Date($inp_estimate_date, $obj_sheet, "M3", '[$-ja-JP]ggge"年"m"月"d"日"');

$obj_sheet->setCellValue("A5",$inp_kyakusaki);
$obj_sheet->setCellValue("F12",$opt_contarct_bill_form);

com_setValue_Date($inp_kyakusaki_kaishi, $obj_sheet, "F13", 'yyyy年m月d日');
com_setValue_Date($inp_kyakusaki_syuryo, $obj_sheet, "K13", 'yyyy年m月d日');

$obj_sheet->setCellValue("F14",$txt_engineer_name);
$obj_sheet->setCellValue("F15",$inp_jigyosya_tanto);
$obj_sheet->setCellValue("F16",$inp_tankin_b1);
$obj_sheet->setCellValue("F17",$opt_contract_calc_b1);
$obj_sheet->setCellValue("F18",$opt_contract_lower_limit_b1);
$obj_sheet->setCellValue("K18",$opt_contract_upper_limit_b1);
$obj_sheet->setCellValue("K19","（".$opt_contract_trunc_unit_kojyo."）");
$obj_sheet->setCellValue("F19", str_replace(",", "", $txt_contract_kojyo_unit_b1));
$obj_sheet->setCellValue("K20","（".$opt_contract_trunc_unit_zangyo."）");
$obj_sheet->setCellValue("F20",str_replace(",", "", $txt_contract_zangyo_unit_b1));
$obj_sheet->setCellValue("F22",$opt_m_contract_time_inc_bd);
$obj_sheet->setCellValue("J22",str_replace(",", "", $opt_m_contract_time_inc_bm));
$obj_sheet->setCellValue("F24",$inp_biko);

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment;filename='".$GLOBALS['g_EXCEL_CONTRACT_10107']."'");
header("Cache-Control: max-age=0");

$obj_writer = PHPExcel_IOFactory::createWriter($obj_book, 'Excel2007');
$obj_writer->save("php://output"); 

exit;

?>
