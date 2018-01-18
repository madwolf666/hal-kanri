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

if (isset($_GET['NO'])) {
    $a_no = $_GET['NO'];
    try{
        //DBからユーザ情報取得
        $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
        $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $a_sql = set_10100_selectDB();

        $a_sql .= " WHERE (cr_id=:cr_id);";
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

//読み書きするファイルのパスを設定
$target_file = $GLOBALS['g_EXCEL_TEMPLATE_PATH'].$GLOBALS['g_EXCEL_CONTRACT_10102'];

//1. リーダーを作成して既存ファイルを読み込む
$obj_reader = PHPExcel_IOFactory::createReader('Excel2007');
$obj_book   = $obj_reader->load($target_file);

//2. ファイルを編集（先頭のシートのA1セルに文字列を書き込み）
$obj_sheet = $obj_book->getSheet(0);
//$obj_sheet->setCellValue("A1", "Hello, PHPExcel!");

$obj_sheet->setCellValue("D3",$inp_kyakusaki);
$obj_sheet->setCellValue("D4",$inp_kenmei);
$obj_sheet->setCellValue("D5",$opt_contarct_bill_form);
$obj_sheet->setCellValue("D6",$inp_sagyo_basyo);
$obj_sheet->setCellValue("D7",$inp_kaishi1);
$obj_sheet->setCellValue("I7",$inp_syuryo1);
$obj_sheet->setCellValue("O7",$txt_sagyo_jikan);
$obj_sheet->setCellValue("D8",$inp_kaishi2);
$obj_sheet->setCellValue("I8",$inp_syuryo2);
$obj_sheet->setCellValue("O8",$txt_kyukei_jikan);

$obj_sheet->setCellValue("E10",$inp_kyakusaki_busyo);
$obj_sheet->setCellValue("E11",$inp_kyakusaki_tantosya);
$obj_sheet->setCellValue("E12",$inp_kyakusaki_jimutantosya);
$obj_sheet->setCellValue("E13",$inp_kyakusaki_yakusyoku);
$obj_sheet->setCellValue("E14",$inp_kyakusaki_tel);
com_setValue_Date($inp_kyakusaki_kaishi, $obj_sheet, "G15", 'yyyy年m月d日');
com_setValue_Date($inp_kyakusaki_syuryo, $obj_sheet, "G16", 'yyyy年m月d日');

$obj_sheet->setCellValue("G18",$opt_contract_calc_b1);
$obj_sheet->setCellValue("G19",str_replace(",", "", $inp_tankin_b1));
$obj_sheet->setCellValue("G20",$opt_contract_lower_limit_b1);
$obj_sheet->setCellValue("G21",$opt_contract_upper_limit_b1);
$obj_sheet->setCellValue("J22",$opt_contract_trunc_unit_kojyo);
$obj_sheet->setCellValue("N22",str_replace(",", "", $txt_contract_kojyo_unit_b1));
$obj_sheet->setCellValue("J23",$opt_contract_trunc_unit_zangyo);
$obj_sheet->setCellValue("N23",str_replace(",", "", $txt_contract_zangyo_unit_b1));

$obj_sheet->setCellValue("G24",$inp_syugyonisu_b2);
$obj_sheet->setCellValue("G25",$inp_zeneigyonisu_b2);
$obj_sheet->setCellValue("G26",$opt_contract_calc_b2);
$obj_sheet->setCellValue("G27",str_replace(",", "", $txt_tankin_b2));
$obj_sheet->setCellValue("G28",$opt_contract_lower_limit_b2);
$obj_sheet->setCellValue("G29",$opt_contract_upper_limit_b2);
$obj_sheet->setCellValue("G30",str_replace(",", "", $txt_contract_kojyo_unit_b2));
$obj_sheet->setCellValue("G31",str_replace(",", "", $txt_contract_zangyo_unit_b2));

$obj_sheet->setCellValue("G32",$inp_syugyonisu_b3);
$obj_sheet->setCellValue("G33",$inp_zeneigyonisu_b3);
$obj_sheet->setCellValue("G34",$opt_contract_calc_b3);
$obj_sheet->setCellValue("G35",str_replace(",", "", $txt_tankin_b3));
$obj_sheet->setCellValue("G36",$opt_contract_lower_limit_b3);
$obj_sheet->setCellValue("G37",$opt_contract_upper_limit_b3);
$obj_sheet->setCellValue("G38",str_replace(",", "", $txt_contract_kojyo_unit_b3));
$obj_sheet->setCellValue("G39",str_replace(",", "", $txt_contract_zangyo_unit_b3));

$obj_sheet->setCellValue("I41",$opt_m_contract_time_inc_bd);
$obj_sheet->setCellValue("O41",$opt_m_contract_time_inc_bm);
$obj_sheet->setCellValue("I42",$opt_contract_tighten_b);
$obj_sheet->setCellValue("O42",$opt_contract_bill_pay);
$obj_sheet->setCellValue("F43",$opt_m_contract_yesno_b1);
$obj_sheet->setCellValue("N43",$opt_m_contract_yesno_b2);
$obj_sheet->setCellValue("F44",$opt_m_contract_yesno_b3);
$obj_sheet->setCellValue("N44",$opt_m_contract_yesno_b4);

$obj_sheet->setCellValue("Z2",$opt_contract_kind);
$obj_sheet->setCellValue("Z3",$inp_keiyaku_no);
com_setValue_Date($inp_hakkobi, $obj_sheet, "Z4", 'yyyy年m月d日');
$obj_sheet->setCellValue("Z5",$inp_sakuseisya);

$obj_sheet->setCellValue("Z7",$inp_engineer_no);
$obj_sheet->setCellValue("Z8",$txt_engineer_name);
$obj_sheet->setCellValue("AG8",$txt_engineer_kana);

$obj_sheet->setCellValue("Z10",$txt_jigyosya_name);
$obj_sheet->setCellValue("Z11",$opt_contract_pay_form);
$obj_sheet->setCellValue("AE11",$txt_jigyosya_kana);
$obj_sheet->setCellValue("Z12",$inp_jigyosya_tanto);
$obj_sheet->setCellValue("W13",$opt_social_insurance);
$obj_sheet->setCellValue("AE13",$opt_tax_withholding);
com_setValue_Date($txt_kyakusaki_kaishi, $obj_sheet, "Z14", 'yyyy年m月d日');
com_setValue_Date($txt_kyakusaki_syuryo, $obj_sheet, "Z15", 'yyyy年m月d日');
$obj_sheet->setCellValue("AJ13",$opt_contract_reduction);

$obj_sheet->setCellValue("Z18",$opt_contract_calc_p11);
$obj_sheet->setCellValue("AG18",$opt_contract_calc_p21);
$obj_sheet->setCellValue("Z19",str_replace(",", "", $txt_tankin_p11));
$obj_sheet->setCellValue("AG19",str_replace(",", "", $txt_tankin_p21));
$obj_sheet->setCellValue("Z20",$txt_contract_lower_limit_p11);
$obj_sheet->setCellValue("AG20",$txt_contract_lower_limit_p21);
$obj_sheet->setCellValue("Z21",$txt_contract_upper_limit_p11);
$obj_sheet->setCellValue("AG21",$txt_contract_upper_limit_p21);
$obj_sheet->setCellValue("Z22",str_replace(",", "", $txt_contract_kojyo_unit_p11));
$obj_sheet->setCellValue("AG22",str_replace(",", "", $txt_contract_kojyo_unit_p21));
$obj_sheet->setCellValue("Z23",str_replace(",", "", $txt_contract_zangyo_unit_p11));
$obj_sheet->setCellValue("AG23",str_replace(",", "", $txt_contract_zangyo_unit_p21));

$obj_sheet->setCellValue("Z24",$txt_syugyonisu_p12);
$obj_sheet->setCellValue("AG24",$txt_syugyonisu_p22);
$obj_sheet->setCellValue("Z25",$txt_zeneigyonisu_p12);
$obj_sheet->setCellValue("AG25",$txt_zeneigyonisu_p22);
$obj_sheet->setCellValue("Z26",$opt_contract_calc_p12);
$obj_sheet->setCellValue("AG26",$opt_contract_calc_p22);
$obj_sheet->setCellValue("Z27",str_replace(",", "", $txt_tankin_p12));
$obj_sheet->setCellValue("AG27",str_replace(",", "", $txt_tankin_p22));
$obj_sheet->setCellValue("Z28",$txt_contract_lower_limit_p12);
$obj_sheet->setCellValue("AG28",$txt_contract_lower_limit_p22);
$obj_sheet->setCellValue("Z29",$txt_contract_upper_limit_p12);
$obj_sheet->setCellValue("AG29",$txt_contract_upper_limit_p22);
$obj_sheet->setCellValue("Z30",str_replace(",", "", $txt_contract_kojyo_unit_p12));
$obj_sheet->setCellValue("AG30",str_replace(",", "", $txt_contract_kojyo_unit_p22));
$obj_sheet->setCellValue("Z31",str_replace(",", "", $txt_contract_zangyo_unit_p12));
$obj_sheet->setCellValue("AG31",str_replace(",", "", $txt_contract_zangyo_unit_p22));

$obj_sheet->setCellValue("Z32",$txt_syugyonisu_p13);
$obj_sheet->setCellValue("AG32",$txt_syugyonisu_p23);
$obj_sheet->setCellValue("Z33",$txt_zeneigyonisu_p13);
$obj_sheet->setCellValue("AG33",$txt_zeneigyonisu_p23);
$obj_sheet->setCellValue("Z34",$opt_contract_calc_p13);
$obj_sheet->setCellValue("AG34",$opt_contract_calc_p23);
$obj_sheet->setCellValue("Z35",str_replace(",", "", $txt_tankin_p13));
$obj_sheet->setCellValue("AG35",str_replace(",", "", $txt_tankin_p23));
$obj_sheet->setCellValue("Z36",$txt_contract_lower_limit_p13);
$obj_sheet->setCellValue("AG36",$txt_contract_lower_limit_p23);
$obj_sheet->setCellValue("Z37",$txt_contract_upper_limit_p13);
$obj_sheet->setCellValue("AG37",$txt_contract_upper_limit_p23);
$obj_sheet->setCellValue("Z38",str_replace(",", "", $txt_contract_kojyo_unit_p13));
$obj_sheet->setCellValue("AG38",str_replace(",", "", $txt_contract_kojyo_unit_p23));
$obj_sheet->setCellValue("Z39",str_replace(",", "", $txt_contract_zangyo_unit_p13));
$obj_sheet->setCellValue("AG39",str_replace(",", "", $txt_contract_zangyo_unit_p23));

$obj_sheet->setCellValue("AA41",$opt_m_contract_time_inc_pd);
$obj_sheet->setCellValue("AG41",$opt_m_contract_time_inc_pm);
$obj_sheet->setCellValue("AA42",$opt_contract_tighten_p);
$obj_sheet->setCellValue("AG42",$opt_contract_pay_pay);
$obj_sheet->setCellValue("X43",$opt_contract_yesno_p1);
$obj_sheet->setCellValue("AF43",$opt_contract_yesno_p2);
$obj_sheet->setCellValue("X44",$opt_contract_yesno_p3);
$obj_sheet->setCellValue("AF44",$opt_contract_yesno_p4);


$obj_sheet->setCellValue("AR25",$inp_wariai_nyujyo_c1);
$obj_sheet->setCellValue("AR26",$inp_wariai_nyujyo_c2);

$obj_sheet->setCellValue("AR30",$inp_wariai_taijyo_c1);
$obj_sheet->setCellValue("AR31",$inp_wariai_taijyo_c2);

//追加項目
$obj_sheet->setCellValue("H46",$contact_date_org);
$obj_sheet->setCellValue("R47",$dd_name);
$obj_sheet->setCellValue("AC47",$dd_branch);
$obj_sheet->setCellValue("R49",$organization);
$obj_sheet->setCellValue("R51",$dd_address);
$obj_sheet->setCellValue("R53",$dd_tel);

$obj_sheet->setCellValue("R54",$ip_position);
$obj_sheet->setCellValue("AC54",$ip_name);

$obj_sheet->setCellValue("R55",$dd_responsible_position);
$obj_sheet->setCellValue("AC55",$dd_responsible_name);
$obj_sheet->setCellValue("R56",$dd_responsible_tel);

$obj_sheet->setCellValue("R57",$dm_responsible_position);
$obj_sheet->setCellValue("AC57",$dm_responsible_name);
$obj_sheet->setCellValue("R58",$dm_responsible_tel);

$obj_sheet->setCellValue("R59",$chs_position2);
$obj_sheet->setCellValue("AC59",$chs_name2);
$obj_sheet->setCellValue("R60",$chs_tel2);

$obj_sheet->setCellValue("R61",$chs_position1);
$obj_sheet->setCellValue("AC61",$chs_name1);
$obj_sheet->setCellValue("R62",$chs_tel1);

$obj_sheet->setCellValue("C64",$inp_biko);
$obj_sheet->setCellValue("V64",$remarks_pay);

#[2018.01.18]課題解決管理表No.92
$obj_sheet->setCellValue("C69",$remarks2);
$obj_sheet->setCellValue("V69",$remarks_pay2);

$obj_sheet->setCellValue("AJ3",$reg_person);
$obj_sheet->setCellValue("AJ42",$cnf_person);

header("Content-Type: application/vnd.ms-excel");
//header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment;filename='".$GLOBALS['g_EXCEL_CONTRACT_10102']."'");
header("Cache-Control: max-age=0");

$obj_writer = PHPExcel_IOFactory::createWriter($obj_book, 'Excel2007');
$obj_writer->save("php://output"); 

exit();

?>
