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

$opt_contarct_replace = "";
$opt_contarct_end_status = "";
$inp_retire_date = "";
$opt_contarct_insurance_crad = "";
$opt_contarct_employ_insurance = "";
$opt_contarct_end_reason1 = "";
$opt_contarct_end_reason2 = "";
$opt_contarct_end_reason3 = "";
$inp_end_reason_detail = "";
$opt_contarct_from_now = "";
$opt_contarct_skill = "";
$opt_contarct_conversation = "";
$opt_contarct_work_attitude = "";
$opt_contarct_personality = "";
$opt_contarct_projects_confirm = "";
$opt_contarct_engineer_list = "";

if (isset($_GET['NO'])) {
    $a_no = $_GET['NO'];
    try{
        //DBからユーザ情報取得
        $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
        $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $a_sql_src = set_10100_selectDB();

        //担当営業情報は契約レポートから持ってくる。
        $a_sql = "SELECT s1.*";
        $a_sql .= "
            ,s2.replace_person
            ,s2.end_status
            ,s2.retire_date
            ,s2.insurance_crad
            ,s2.employ_insurance
            ,s2.end_reason1
            ,s2.end_reason2
            ,s2.end_reason3
            ,s2.end_reason_detail
            ,s2.from_now
            ,s2.skill
            ,s2.remarks AS remarks_end
            ,s2.conversation
            ,s2.work_attitude
            ,s2.personality
            ,s2.projects_confirm
            ,s2.engineer_list
            ,s2.remarks_pay AS remarks_pay_end
            ,(SELECT person FROM ".$GLOBALS['g_DB_m_user']." WHERE (idx=s2.cnf_id)) AS cnf_person_end
            ";
        $a_sql .= " FROM (".$a_sql_src.") s1 LEFT JOIN ".$GLOBALS['g_DB_t_contract_end_report']." s2";
        $a_sql .= " ON (s1.cr_id=s2.cr_id)";
        $a_sql .= " WHERE (s1.cr_id=:cr_id)";

        $a_stmt = $a_conn->prepare($a_sql);
        $a_stmt->bindParam(':cr_id', $a_no, PDO::PARAM_STR);
        $a_stmt->execute();

        while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
            set_10100_fromDB($a_result);

            $opt_contarct_replace = $a_result['replace_person'];
            $opt_contarct_end_status = $a_result['end_status'];
            $inp_retire_date = str_replace("-", "/", $a_result['retire_date']);
            $opt_contarct_insurance_crad = $a_result['insurance_crad'];
            $opt_contarct_employ_insurance = $a_result['employ_insurance'];
            $opt_contarct_end_reason1 = $a_result['end_reason1'];
            $opt_contarct_end_reason2 = $a_result['end_reason2'];
            $opt_contarct_end_reason3 = $a_result['end_reason3'];
            $inp_end_reason_detail = $a_result['end_reason_detail'];
            $opt_contarct_from_now = $a_result['from_now'];
            $opt_contarct_skill = $a_result['skill'];
            $inp_biko = $a_result['remarks_end'];
            $opt_contarct_conversation = $a_result['conversation'];
            $opt_contarct_work_attitude = $a_result['work_attitude'];
            $opt_contarct_personality = $a_result['personality'];
            $opt_contarct_projects_confirm = $a_result['projects_confirm'];
            $opt_contarct_engineer_list = $a_result['engineer_list'];
            $remarks_pay = $a_result['remarks_pay_end'];

            /*$reg_id = $a_result['reg_id'];
            $reg_person = $a_result['reg_person'];
            $upd_id = $a_result['upd_id'];
            $upd_person = $a_result['upd_person'];
            $cnf_person = $a_result['cnf_person'];*/

            $cnf_person = $a_result['cnf_person_end'];
        }
        if ($upd_person != ''){
            $reg_id = $upd_id;
            $reg_person = $upd_person;
        }
    } catch (PDOException $e){
        echo 'Error:'.$e->getMessage();
        die();
    }
}

//読み書きするファイルのパスを設定
$target_file = $GLOBALS['g_EXCEL_TEMPLATE_PATH'].$GLOBALS['g_EXCEL_CONTRACT_10105'];

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
$obj_sheet->setCellValue("C7",$inp_kaishi1);
$obj_sheet->setCellValue("H7",$inp_syuryo1);
$obj_sheet->setCellValue("N7",$txt_sagyo_jikan);
$obj_sheet->setCellValue("C8",$inp_kaishi2);
$obj_sheet->setCellValue("H8",$inp_syuryo2);
$obj_sheet->setCellValue("N8",$txt_kyukei_jikan);

$obj_sheet->setCellValue("D10",$inp_kyakusaki_busyo);
$obj_sheet->setCellValue("D11",$inp_kyakusaki_tantosya);
$obj_sheet->setCellValue("D12",$inp_kyakusaki_jimutantosya);
$obj_sheet->setCellValue("D13",$inp_kyakusaki_yakusyoku);
$obj_sheet->setCellValue("D14",$inp_kyakusaki_tel);
com_setValue_Date($inp_kyakusaki_kaishi, $obj_sheet, "G15", 'yyyy年m月d日');
com_setValue_Date($inp_kyakusaki_syuryo, $obj_sheet, "G16", 'yyyy年m月d日');

$obj_sheet->setCellValue("G18",$opt_contract_calc_b1);
$obj_sheet->setCellValue("G19",str_replace(",", "", $inp_tankin_b1));
$obj_sheet->setCellValue("G20",$opt_contract_lower_limit_b1);
$obj_sheet->setCellValue("G21",$opt_contract_upper_limit_b1);
$obj_sheet->setCellValue("G22",str_replace(",", "", $txt_contract_kojyo_unit_b1));
$obj_sheet->setCellValue("G23",str_replace(",", "", $txt_contract_zangyo_unit_b1));

$obj_sheet->setCellValue("G24",$inp_syugyonisu_b3);
$obj_sheet->setCellValue("G25",$inp_zeneigyonisu_b3);
$obj_sheet->setCellValue("G26",$opt_contract_calc_b3);
$obj_sheet->setCellValue("G27",str_replace(",", "", $txt_tankin_b3));
$obj_sheet->setCellValue("G28",$opt_contract_lower_limit_b3);
$obj_sheet->setCellValue("G29",$opt_contract_upper_limit_b3);
$obj_sheet->setCellValue("G30",str_replace(",", "", $txt_contract_kojyo_unit_b3));
$obj_sheet->setCellValue("G31",str_replace(",", "", $txt_contract_zangyo_unit_b3));

$obj_sheet->setCellValue("H32",$opt_m_contract_time_inc_bd);
$obj_sheet->setCellValue("N32",$opt_m_contract_time_inc_bm);
$obj_sheet->setCellValue("H33",$opt_contract_tighten_b);
$obj_sheet->setCellValue("N33",$opt_contract_bill_pay);

$obj_sheet->setCellValue("Y4",$inp_keiyaku_no);
com_setValue_Date($inp_hakkobi, $obj_sheet, "Y5", 'yyyy年m月d日');
$obj_sheet->setCellValue("Y6",$inp_sakuseisya);

$obj_sheet->setCellValue("Y7",$inp_engineer_no);
$obj_sheet->setCellValue("Z8",$txt_engineer_name);
$obj_sheet->setCellValue("AF8",$txt_engineer_kana);

$obj_sheet->setCellValue("Y11",$txt_jigyosya_name);
$obj_sheet->setCellValue("Y12",$opt_contract_pay_form);
$obj_sheet->setCellValue("AD12",$txt_jigyosya_kana);
$obj_sheet->setCellValue("Y13",$inp_jigyosya_tanto);
$obj_sheet->setCellValue("V14",$opt_social_insurance);
$obj_sheet->setCellValue("AD14",$opt_tax_withholding);
com_setValue_Date($txt_kyakusaki_kaishi, $obj_sheet, "Y15", 'yyyy年m月d日');
com_setValue_Date($txt_kyakusaki_syuryo, $obj_sheet, "Y16", 'yyyy年m月d日');
$obj_sheet->setCellValue("AI14",$opt_contract_reduction);

$obj_sheet->setCellValue("Y18",$opt_contract_calc_p11);
$obj_sheet->setCellValue("AF18",$opt_contract_calc_p21);
$obj_sheet->setCellValue("Y19",str_replace(",", "", $txt_tankin_p11));
$obj_sheet->setCellValue("AF19",str_replace(",", "", $txt_tankin_p21));
$obj_sheet->setCellValue("Y20",$txt_contract_lower_limit_p11);
$obj_sheet->setCellValue("AF20",$txt_contract_lower_limit_p21);
$obj_sheet->setCellValue("Y21",$txt_contract_upper_limit_p11);
$obj_sheet->setCellValue("AF21",$txt_contract_upper_limit_p21);
$obj_sheet->setCellValue("Y22",str_replace(",", "", $txt_contract_kojyo_unit_p11));
$obj_sheet->setCellValue("AF22",str_replace(",", "", $txt_contract_kojyo_unit_p21));
$obj_sheet->setCellValue("Y23",str_replace(",", "", $txt_contract_zangyo_unit_p11));
$obj_sheet->setCellValue("AF23",str_replace(",", "", $txt_contract_zangyo_unit_p21));

$obj_sheet->setCellValue("Y24",$txt_syugyonisu_p13);
$obj_sheet->setCellValue("AF24",$txt_syugyonisu_p23);
$obj_sheet->setCellValue("Y25",$txt_zeneigyonisu_p13);
$obj_sheet->setCellValue("AF25",$txt_zeneigyonisu_p23);
$obj_sheet->setCellValue("Y26",$opt_contract_calc_p13);
$obj_sheet->setCellValue("AF26",$opt_contract_calc_p23);
$obj_sheet->setCellValue("Y27",str_replace(",", "", $txt_tankin_p13));
$obj_sheet->setCellValue("AF27",str_replace(",", "", $txt_tankin_p23));
$obj_sheet->setCellValue("Y28",$txt_contract_lower_limit_p13);
$obj_sheet->setCellValue("AF28",$txt_contract_lower_limit_p23);
$obj_sheet->setCellValue("Y29",$txt_contract_upper_limit_p13);
$obj_sheet->setCellValue("AF29",$txt_contract_upper_limit_p23);
$obj_sheet->setCellValue("Y30",str_replace(",", "", $txt_contract_kojyo_unit_p13));
$obj_sheet->setCellValue("AF30",str_replace(",", "", $txt_contract_kojyo_unit_p23));
$obj_sheet->setCellValue("Y31",str_replace(",", "", $txt_contract_zangyo_unit_p13));
$obj_sheet->setCellValue("AF31",str_replace(",", "", $txt_contract_zangyo_unit_p23));

$obj_sheet->setCellValue("Z32",$opt_m_contract_time_inc_pd);
$obj_sheet->setCellValue("AF32",$opt_m_contract_time_inc_pm);
$obj_sheet->setCellValue("Z33",$opt_contract_tighten_p);
$obj_sheet->setCellValue("AF33",$opt_contract_pay_pay);

$obj_sheet->setCellValue("E35",$opt_contarct_replace);
$obj_sheet->setCellValue("Y2",$opt_contarct_end_status);
com_setValue_Date($inp_retire_date, $obj_sheet, "Y3", 'yyyy年m月d日');
$obj_sheet->setCellValue("W35",$opt_contarct_insurance_crad);
$obj_sheet->setCellValue("AC35",$opt_contarct_employ_insurance);
$obj_sheet->setCellValue("E37",$opt_contarct_end_reason1);
$obj_sheet->setCellValue("O37",$opt_contarct_end_reason2);
$obj_sheet->setCellValue("Y37",$opt_contarct_end_reason3);
$obj_sheet->setCellValue("E38",$inp_end_reason_detail);
$obj_sheet->setCellValue("E46",$opt_contarct_from_now);
$obj_sheet->setCellValue("N46",$opt_contarct_skill);
$obj_sheet->setCellValue("C50",$inp_biko);
$obj_sheet->setCellValue("W46",$opt_contarct_conversation);
$obj_sheet->setCellValue("AA46",$opt_contarct_work_attitude);
$obj_sheet->setCellValue("AE46",$opt_contarct_personality);
$obj_sheet->setCellValue("W48",$opt_contarct_projects_confirm);
$obj_sheet->setCellValue("AE48",$opt_contarct_engineer_list);
$obj_sheet->setCellValue("U50",$remarks_pay);

$obj_sheet->setCellValue("AI3",$reg_person);
$obj_sheet->setCellValue("AI33",$cnf_person);

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment;filename='".$GLOBALS['g_EXCEL_CONTRACT_10105']."'");
header("Cache-Control: max-age=0");

$obj_writer = PHPExcel_IOFactory::createWriter($obj_book, 'Excel2007');
$obj_writer->save("php://output"); 

exit;

?>
