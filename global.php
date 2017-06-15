<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();

date_default_timezone_set('Asia/Tokyo');    //タイムゾーン設定

/*******************************************************************************
* DB
*******************************************************************************/
$g_DB_server = "localhost";
$g_DB_name = "hal_kanri";
$g_DB_uid = "root";
$g_DB_pwd = "kanri999";

$g_DB_m_base = "m_base";
$g_DB_m_contract_absence_deduction = "m_contract_absence_deduction";
$g_DB_m_contract_bill_form = "m_contract_bill_form";
$g_DB_m_contract_bill_pay = "m_contract_bill_pay";
$g_DB_m_contract_calc = "m_contract_calc";
$g_DB_m_contract_conversation = "m_contract_conversation";
$g_DB_m_contract_employ_insurance = "m_contract_employ_insurance";
$g_DB_m_contract_end_reason = "m_contract_end_reason";
$g_DB_m_contract_end_status = "m_contract_end_status";
$g_DB_m_contract_engineer_list = "m_contract_engineer_list";
$g_DB_m_contract_from_now = "m_contract_from_now";
$g_DB_m_contract_insurance_crad = "m_contract_insurance_crad";
$g_DB_m_contract_kind = "m_contract_kind";
$g_DB_m_contract_lower_limit = "m_contract_lower_limit";
$g_DB_m_contract_pay_form = "m_contract_pay_form";
$g_DB_m_contract_pay_pay = "m_contract_pay_pay";
$g_DB_m_contract_personality = "m_contract_personality";
$g_DB_m_contract_projects_confirm = "m_contract_projects_confirm";
$g_DB_m_contract_reduction = "m_contract_reduction";
$g_DB_m_contract_replace = "m_contract_replace";
$g_DB_m_contract_skill = "m_contract_skill";
$g_DB_m_contract_status = "m_contract_status";
$g_DB_m_contract_tax_class = "m_contract_tax_class";
$g_DB_m_contract_tighten = "m_contract_tighten";
$g_DB_m_contract_time_inc = "m_contract_time_inc";
$g_DB_m_contract_trunc_unit = "m_contract_trunc_unit";
$g_DB_m_contract_upper_limit = "m_contract_upper_limit";
$g_DB_m_contract_work_attitude = "m_contract_work_attitude";
$g_DB_m_contract_yesno = "m_contract_yesno";
$g_DB_m_covering_letter = "m_covering_letter";
$g_DB_m_department = "m_department";
$g_DB_m_engineer = "m_engineer";
$g_DB_m_information = "m_information";
$g_DB_m_user = "m_user";

$g_DB_t_acceptance_ledger = "t_acceptance_ledger";
$g_DB_t_agreement_ledger = "t_agreement_ledger";
$g_DB_t_contract_estimate = "t_contract_estimate";
$g_DB_t_contract_end_report = "t_contract_end_report";
$g_DB_t_contract_report = "t_contract_report";
$g_DB_t_dispatching_management_ledger = "t_dispatching_management_ledger";
$g_DB_t_payroll = "t_payroll";
$g_DB_t_purchase_order_ledger = "t_purchase_order_ledger";

/*******************************************************************************
* メニュー
*******************************************************************************/
//台帳関連
$g_MENU_CONTRACT_10000 = 10000;    //台帳関連

$g_MENU_CONTRACT_10100 = 10100;    //契約管理全体
$g_MENU_CONTRACT_10101 = 10101;    //契約管理全体：検索
$g_MENU_CONTRACT_10102 = 10102;    //契約レポート：新規
$g_MENU_CONTRACT_10103 = 10103;    //契約レポート：修正
$g_MENU_CONTRACT_10104 = 10104;    //契約レポート：削除
$g_MENU_CONTRACT_10105 = 10105;    //契約終了レポート：新規
$g_MENU_CONTRACT_10106 = 10106;    //契約終了レポート：修正
$g_MENU_CONTRACT_10107 = 10107;    //見積書作成

$g_MENU_CONTRACT_10200 = 10200;    //給与台帳一覧
$g_MENU_CONTRACT_10201 = 10201;    //給与台帳一覧：検索

$g_MENU_CONTRACT_10300 = 10300;    //検収台帳一覧
$g_MENU_CONTRACT_10301 = 10301;    //検収台帳一覧：検索

$g_MENU_CONTRACT_10310 = 10310;    //検収台帳一覧：行追加
$g_MENU_CONTRACT_10311 = 10311;    //検収台帳一覧：現在行削除

$g_MENU_CONTRACT_10400 = 10400;    //注文書台帳一覧
$g_MENU_CONTRACT_10401 = 10401;    //注文書台帳一覧：検索
$g_MENU_CONTRACT_10402 = 10402;    //注文書
$g_MENU_CONTRACT_10403 = 10403;    //注文請書

$g_MENU_CONTRACT_10500 = 10500;    //契約書台帳一覧
$g_MENU_CONTRACT_10501 = 10501;    //契約書台帳一覧：検索
$g_MENU_CONTRACT_10502 = 10502;    //労働契約書
$g_MENU_CONTRACT_10503 = 10503;    //労働契約書（再発行）
$g_MENU_CONTRACT_10504 = 10504;    //就業条件明示書

$g_MENU_CONTRACT_10600 = 10600;    //派遣元台帳一覧
$g_MENU_CONTRACT_10601 = 10601;    //派遣元台帳一覧：検索

//マスタ情報
$g_MENU_MAINTENANCE_90000 = 90000;    //マスタ情報

$g_MENU_MAINTENANCE_90100 = 90100;    //ユーザ一覧
$g_MENU_MAINTENANCE_90102 = 90102;    //ユーザ：新規
$g_MENU_MAINTENANCE_90103 = 90103;    //ユーザ：修正
$g_MENU_MAINTENANCE_90104 = 90104;    //ユーザ：削除

$g_MENU_MAINTENANCE_90200 = 90200;    //エンジニア一覧
$g_MENU_MAINTENANCE_90201 = 90201;    //エンジニア検索
$g_MENU_MAINTENANCE_90211 = 90211;    //エンジニアExcelアップロード

$g_MENU_MAINTENANCE_90300 = 90300;    //お知らせ一覧
$g_MENU_MAINTENANCE_90302 = 90302;    //お知らせ：新規
$g_MENU_MAINTENANCE_90303 = 90303;    //お知らせ：修正
$g_MENU_MAINTENANCE_90304 = 90304;    //お知らせ：削除

$g_MENU_MAINTENANCE_90400 = 90400;    //送付状一覧
$g_MENU_MAINTENANCE_90401 = 90401;    //送付状検索
$g_MENU_MAINTENANCE_90411 = 90411;    //送付状Excelアップロード

//グラフ表示
$g_MENU_CONTRACT_SHOW_CHART = 10001;
$g_MENU_LOGOUT_00000 = 0;           //ログアウト
        
/*******************************************************************************
* Excel出力
*******************************************************************************/
//windows
$g_EXCEL_TMP_PATH = "C:/Users/hal/Documents/NetBeansProjects/hal-kanri/tmp/";
//linux
//$g_EXCEL_TMP_PATH = "/var/www/html/tmp/";

//windows
$g_EXCEL_LIB_PATH = "c:/php-7.1.4/pear/PHPExcel-1.8/Classes/";
//linux
//$g_EXCEL_LIB_PATH = "/usr/share/php7/PHPExcel-1.8/Classes/";
 
//windows
$g_EXCEL_TEMPLATE_PATH = "C:/Users/hal/Documents/NetBeansProjects/hal-kanri/excel/";
//linux
//$g_EXCEL_TEMPLATE_PATH = "/var/www/html/excel/";

$g_EXCEL_CONTRACT_10100 = "contrcat_10100.xlsx";
$g_EXCEL_CONTRACT_10102 = "contrcat_10102.xlsx";
$g_EXCEL_CONTRACT_10105 = "contrcat_10105.xlsx";
$g_EXCEL_CONTRACT_10107 = "contrcat_10107.xlsx";
$g_EXCEL_CONTRACT_10200 = "contrcat_10200.xlsx";
$g_EXCEL_CONTRACT_10300 = "contrcat_10300.xlsx";
$g_EXCEL_CONTRACT_10400 = "contrcat_10400.xlsx";
$g_EXCEL_CONTRACT_10402 = "contrcat_10402.xlsx";
$g_EXCEL_CONTRACT_10403 = "contrcat_10403.xlsx";
$g_EXCEL_CONTRACT_10500 = "contrcat_10500.xlsx";
$g_EXCEL_CONTRACT_10502 = "contrcat_10502.xlsx";
$g_EXCEL_CONTRACT_10503 = "contrcat_10503.xlsx";
$g_EXCEL_CONTRACT_10504 = "contrcat_10504.xlsx";
$g_EXCEL_CONTRACT_10600 = "contrcat_10600.xlsx";

/*******************************************************************************
* ELSE
*******************************************************************************/
$g_MAX_LINE_PAGE = 100; //一覧の1ページ毎の行数

$g_REQUEST_URI = $_SERVER['REQUEST_URI'];
$g_URL_ARRAY = explode("/", $g_REQUEST_URI);
$g_NOW_URI = $g_URL_ARRAY[count($g_URL_ARRAY)-1];
//echo $g_NOW_URI;
//exit;

//[2017.05.18]
if ((isset($_COOKIE['hal_auth'])) &&
    (isset($_COOKIE['hal_person'])) &&
    (isset($_COOKIE['hal_department_name'])) &&
    (isset($_COOKIE['hal_base_name'])) &&
    (isset($_COOKIE['hal_department_cd'])) &&
    (isset($_COOKIE['hal_base_cd'])) &&
    (isset($_COOKIE['hal_idx']))) {
    
    if (($_COOKIE['hal_auth'] != '') &&
        ($_COOKIE["hal_person"] != '') &&
        ($_COOKIE["hal_department_name"] != '') &&
        ($_COOKIE["hal_base_name"] != '') &&
        ($_COOKIE["hal_department_cd"] != '') &&
        ($_COOKIE["hal_base_cd"] != '') &&
        ($_COOKIE["hal_idx"] != '')){
        $_SESSION["hal_idx"] = $_COOKIE['hal_idx'];
        $_SESSION["hal_base_cd"] = $_COOKIE['hal_base_cd'];
        $_SESSION["hal_department_cd"] = $_COOKIE['hal_department_cd'];
        $_SESSION["hal_base_name"] = $_COOKIE['hal_base_name'];
        $_SESSION["hal_department_name"] = $_COOKIE['hal_department_name'];
        $_SESSION["hal_person"] = $_COOKIE['hal_person'];
        $_SESSION["hal_auth"] = $_COOKIE['hal_auth'];
    }
}

if ($g_NOW_URI == 'login.php'){
    //ログイン画面
    if ((!isset($_SESSION['hal_auth'])) ||
        (!isset($_SESSION["hal_person"])) ||
        (!isset($_SESSION["hal_department_name"])) ||
        (!isset($_SESSION["hal_base_name"])) ||
        (!isset($_SESSION["hal_department_cd"])) ||
        (!isset($_SESSION["hal_base_cd"])) ||
        (!isset($_SESSION["hal_idx"]))){
    }else{
        if (($_SESSION['hal_auth'] != '') &&
            ($_SESSION["hal_person"] != '') &&
            ($_SESSION["hal_department_name"] != '') &&
            ($_SESSION["hal_base_name"] != '') &&
            ($_SESSION["hal_department_cd"] != '') &&
            ($_SESSION["hal_base_cd"] != '') &&
            ($_SESSION["hal_idx"] != '')){
            //ログイン画面へ遷移
            header('Location: ./index.php');
            exit;
        }
    }
}elseif ($g_NOW_URI == 'exec_login.php'){
    //ログイン認証
}else{
    //その他
    if ((!isset($_SESSION['hal_auth'])) ||
        (!isset($_SESSION["hal_person"])) ||
        (!isset($_SESSION["hal_department_name"])) ||
        (!isset($_SESSION["hal_base_name"])) ||
        (!isset($_SESSION["hal_department_cd"])) ||
        (!isset($_SESSION["hal_base_cd"])) ||
        (!isset($_SESSION["hal_idx"]))){
        //ログイン画面へ遷移
        header('Location: ./login.php');
        exit;
    }else{
        if (($_SESSION['hal_auth'] == '') ||
            ($_SESSION["hal_person"] == '') ||
            ($_SESSION["hal_department_name"] == '') ||
            ($_SESSION["hal_base_name"] == '') ||
            ($_SESSION["hal_department_cd"] == '') ||
            ($_SESSION["hal_base_cd"] == '') ||
            ($_SESSION["hal_idx"] == '')){
            //ログイン画面へ遷移
            header('Location: ./login.php');
            exit;
        }
    }
}

//キャッシュクリア
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); 
header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT'); 
header('Cache-Control: no-store, no-cache, must-revalidate'); 
header('Cache-Control: post-check=0, pre-check=0', false); 
header('Pragma: no-cache'); 

//inputタグ生成
function com_make_tag_input(
        $h_act,
        $h_val,
        $h_name,
        $h_style
        )
{
    $a_sRet = "";
    
    try{
        $a_sRet = "<input type='text' name='".$h_name."' id='".$h_name."' style='".$h_style."' value='";
        //if ($h_act == 'e')
        //{
            $a_sRet .= $h_val;
        //}
        $a_sRet .= "'>";
    } catch (PDOException $e){
        echo 'Error:'.$e->getMessage();
        die();
    }
    
    return $a_sRet;
}

//textareaタグ生成
function com_make_tag_textarea(
        $h_act,
        $h_val,
        $h_name,
        $h_style
        )
{
    $a_sRet = "";
    
    try{
        $a_sRet = "<textarea name='".$h_name."' id='".$h_name."' style='".$h_style."'>";
        //if ($h_act == 'e')
        //{
            $a_sRet .= $h_val;
        //}
        $a_sRet .= "</textarea>";
    } catch (PDOException $e){
        echo 'Error:'.$e->getMessage();
        die();
    }
    
    return $a_sRet;
}

//optionタグ生成
function com_make_tag_option(
        $h_act,
        $h_val,
        $h_name,
        $h_table,
        $h_style,
        &$h_selected
        )
{
    $a_sRet = "";
    $h_selected = false;
    
    try{
        //DBから契約情報取得
        $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
        $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $a_sql = "SELECT * FROM ".$h_table." ORDER BY idx;";
        //echo $a_sql;
        $a_stmt = $a_conn->prepare($a_sql);
        $a_stmt->execute();

        $a_isFound = false;
        
        $a_sRet = "<select id='".$h_name."' name='".$h_name."' style='".$h_style."'>";

        while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
            $a_sRet .= "<option value='".$a_result['idx']."'";
            //if ($h_act == 'e'){
                //if ($a_result['idx'] == $h_val)
                if ($a_result['m_name'] == $h_val)
                {
                    $a_sRet .= 'selected';
                    $a_isFound = true;
                    $h_selected = true;
                    //echo '$h_selected:'.$h_selected;
                }
            //}
            $a_sRet .= ">".$a_result['m_name']."</option>";
        }
        /*
        if (($h_val != '') && ($a_isFound == false)) {
            $a_sRet .= "<option value='".$h_val."'";
            $a_sRet .= " selected>".$h_val."</option>";
        }
        */
        $a_sRet .= "</select>";
    
    } catch (PDOException $e){
        echo 'Error:'.$e->getMessage();
        die();
    }
    
    //$a_conn = null;
    
    return $a_sRet;
}

//optionタグ生成
function com_make_tag_option2(
        $h_act,
        $h_val,
        $h_name,
        $h_table,
        $h_style,
        &$h_selected
        )
{
    $a_sRet = "";
    $h_selected = false;
    
    try{
        //DBから契約情報取得
        $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
        $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $a_sql = "SELECT * FROM ".$h_table." ORDER BY idx;";
        //echo $a_sql;
        $a_stmt = $a_conn->prepare($a_sql);
        $a_stmt->execute();

        $a_isFound = false;
        
        $a_sRet = "<select id='".$h_name."' name='".$h_name."' style='".$h_style."'>";

        while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
            $a_sRet .= "<option value='".$a_result['idx']."'";
            //if ($h_act == 'e'){
                //if ($a_result['idx'] == $h_val)
                if ($a_result['idx'] == $h_val)
                {
                    $a_sRet .= 'selected';
                    $a_isFound = true;
                    $h_selected = true;
                    //echo '$h_selected:'.$h_selected;
                }
            //}
            $a_sRet .= ">".$a_result['m_name']."</option>";
        }
        /*
        if (($h_val != '') && ($a_isFound == false)) {
            $a_sRet .= "<option value='".$h_val."'";
            $a_sRet .= " selected>".$h_val."</option>";
        }
        */
        $a_sRet .= "</select>";
    
    } catch (PDOException $e){
        echo 'Error:'.$e->getMessage();
        die();
    }
    
    //$a_conn = null;
    
    return $a_sRet;
}

//optionタグ生成（契約作成ステータス専用）
function com_make_tag_option_contract_status(
        $h_act,
        $h_val,
        $h_name,
        $h_table,
        $h_style,
        &$h_selected
        )
{
    $a_sRet = "";
    $a_str_sub = "";
    $h_selected = false;
    
    try{
        //DBから契約情報取得
        $a_conn = new PDO("mysql:server=".$GLOBALS['g_DB_server'].";dbname=".$GLOBALS['g_DB_name'].";charset=utf8mb4", $GLOBALS['g_DB_uid'], $GLOBALS['g_DB_pwd']);
        $a_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $a_sql = "SELECT * FROM ".$h_table." ORDER BY idx;";
        //echo $a_sql;
        $a_stmt = $a_conn->prepare($a_sql);
        $a_stmt->execute();

        $a_isFound = false;
        
        $a_sRet = "<select id='".$h_name."' name='".$h_name."' style='".$h_style."'>";

        $a_isSelect = true;
        $a_name = "";
        
        while($a_result = $a_stmt->fetch(PDO::FETCH_ASSOC)){
            $a_isOK = true;
            if ($_SESSION['hal_department_cd'] != 3){
                #echo $_SESSION['hal_department_cd'].'<br>';
                //管理本部以外
                if ($a_result['idx'] >= 2){
                    #echo $a_result['idx'].'<br>';
                    //0：営業作成中、1：営業提出以外は選択不可
                    $a_isOK = false;
                    #echo $a_isOK.'<br>';
                }
            }
            
            #echo $a_isOK.'<br>';
            #echo $a_result['idx'].'<br>';
            $a_str_sub = "<option value='".$a_result['idx']."'";
        //if ($h_act == 'e'){
            //if ($a_result['idx'] == $h_val)
            if ($a_result['m_name'] == $h_val)
            {
                $a_str_sub .= 'selected';
                $a_isFound = true;
                $h_selected = true;
                if ($_SESSION['hal_department_cd'] != 3){
                    if ($a_result['idx'] >= 2){
                        #echo '変更不可<br>';
                        //変更不可
                        $a_isSelect = false;
                        $a_name = $a_result['m_name'];
                    }
                }
            }
        //}
            $a_str_sub .= ">".$a_result['m_name']."</option>";
            if ($a_isOK == true){
                $a_sRet .= $a_str_sub;
            }
        }
        /*
        if (($h_val != '') && ($a_isFound == false)) {
            $a_sRet .= "<option value='".$h_val."'";
            $a_sRet .= " selected>".$h_val."</option>";
        }
        */
        $a_sRet .= "</select>";
    
        if ($a_isSelect == false){
            $a_sRet = $a_name;
        }
        
    } catch (PDOException $e){
        echo 'Error:'.$e->getMessage();
        die();
    }
    
    //$a_conn = null;
    
    return $a_sRet;
}

//PDOのbindValue
function com_pdo_bindValue($h_stmt, $h_name, $h_value)
{
    if ($h_value === "") { 
        $h_stmt->bindValue($h_name, null, PDO::PARAM_NULL);
    } else {
        $h_stmt->bindValue($h_name, $h_value);
    }
}

function com_db_number_format($h_value)
{
    $h_value = str_replace("￥", "", str_replace(",", "", $h_value));
    
    if (ctype_digit($h_value) == false) {
        return "";
    } else {
        return number_format($h_value);
    }
}

function com_db_number_format_symbol($h_value)
{
    $h_value = str_replace("￥", "", str_replace(",", "", $h_value));

    if (ctype_digit($h_value) == false) {
        return "";
    } else {
        return "￥".number_format($h_value);
    }
}

//PHPExcel
function com_setValue_Date($h_date, $h_sheet, $h_cell, $h_format)
{
    $a_date = PHPExcel_Shared_Date::PHPToExcel(new DateTime(str_replace("-", "/", $h_date)));
    $h_sheet->setCellValue($h_cell,$a_date);
    $h_sheet->getStyle($h_cell)->getNumberFormat()->setFormatCode($h_format);
}

//else
function com_replace_toDate($h_val)
{
    return str_replace("-", "/", $h_val);
}

function com_replace_toNumber($h_val)
{
    return str_replace("￥", "", str_replace(",", "", $h_val));
}

//入力タグ生成
function com_make_input_text($h_idx, $h_field, $h_rec, $h_kind)
{
    $a_sRet = "id='".$h_field.$h_rec."'";
    $a_sRet .= " onClick='make_input_text(".$h_idx.",\"".$h_field."\",".$h_rec.",".$h_kind."); after_focus(\"".$h_field."\",".$h_rec.");'";
    
    /*
    if ($h_kind == 2) {
        #$a_sRet .= "<script type='text/javascript'>";
        #$a_sRet .= "$(function () {";
        $a_sRet .= "$('#i_".$h_field.$h_idx."').datepicker({});";
        #$a_sRet .= "});";
        #$a_sRet .= "</script>";
    }
     */
    return $a_sRet;
}

function com_make_input_text2($h_idx, $h_sidx, $h_field, $h_rec, $h_kind)
{
    $a_sRet = "id='".$h_field.$h_rec."'";
    $a_sRet .= " onClick='make_input_text2(".$h_idx.",".$h_sidx.",\"".$h_field."\",".$h_rec.",".$h_kind."); after_focus(\"".$h_field."\",".$h_rec.");'";
    
    return $a_sRet;
}

//***************************************
// 日時の差を計算
//***************************************
function com_time_diff($time_from, $time_to, $mode) 
{
    // 日時差を秒数で取得
    $dif = $time_to - $time_from;
    #echo '$dif：'.$dif.'<br>';
    // 時間単位の差
    $dif_time = date("H:i:s", $dif);
    #echo '$dif_time：'.$dif_time.'<br>';
    // 日付単位の差
    $dif_days = (strtotime(date("Y-m-d", $dif)) - strtotime("1970-01-01")) / 86400;
    #echo '$dif_days：'.$dif_days.'<br>';
    
    if ($mode == 'd'){
        return $dif_days;
    }else{
        return $dif_time;
    }
}

function com_make_where_session($h_mode, $h_where, $h_column, $h_sname, $h_table){
    $a_where = "";
    if (isset($_SESSION[$h_sname])){
        $a_sess = $_SESSION[$h_sname];
        if ($a_sess != ""){
            if ($h_mode == 1){
                #text
                $a_where .= "(".$h_column." LIKE '".$a_sess."%')";
            }
            elseif ($h_mode == 2){
                #date
                $a_where .= "(".$h_column."='".$a_sess."')";
            }elseif ($h_mode == 3){
                #option
                if ($a_sess != 0){
                    $a_where .= "(".$h_column."=(SELECT m_name FROM ".$h_table." WHERE (idx=".$a_sess.")))";
                }
            }

            if (($h_where != "") && ($a_where != "")){
                $a_where = " AND ".$a_where;
            }
        }
    }
    return $h_where.$a_where;
}

function com_convertEOL($h_string, $h_to="<br>"){
    return preg_replace("/\r\n|\r|\n/", $h_to, $h_string);
}

function com_make_pager($h_func, $h_sum, $h_pno, $h_max_line_page)
{
    $a_sRet = "[".com_db_number_format($h_sum)."件]";
    
    if ($h_sum > 0){
#echo '$h_sum / $h_max_line_page:'.$h_sum / $h_max_line_page.'<br>';
        $a_page_sum = floor($h_sum / $h_max_line_page);
        $a_test = ($h_sum % $h_max_line_page);
#echo '$h_sum % $h_max_line_page:'.$a_test.'<br>';
        if (($h_sum % $h_max_line_page) > 0){
            $a_page_sum++;
        }
#echo '$a_page_sum:'.$a_page_sum.'<br>';
        $a_yoko_num = 10;    //最大10ページ
        $a_yoko_syo = floor(($h_pno-1) / $a_yoko_num);
        $a_yoko_amari = $h_pno % $a_yoko_num;
        $a_start_page = $a_yoko_syo*$a_yoko_num;
        $a_start_page++;

        if ($a_start_page > 1){
            //前へを表示
            $a_sRet .= "&nbsp;&nbsp;<a href='#' onclick='".$h_func."(".($a_start_page-1).");'>前へ</a>";
        }
#echo '$a_yoko_num:'.$a_yoko_num.'<br>';
        for ($a_iCnt=1; $a_iCnt<=$a_yoko_num; $a_iCnt++){
#echo '$a_iCnt:'.$a_iCnt.'<br>';
            if ($a_start_page != $h_pno){
                $a_sRet .= "&nbsp;&nbsp;<a href='#' onclick='".$h_func."(".$a_start_page.");'>".$a_start_page."</a>";
            }else{
                $a_sRet .= "&nbsp;&nbsp;".$a_start_page;
            }
            $a_start_page++;
            if ($a_start_page > $a_page_sum){
                break;
            }
        }

        if ($a_start_page <= $a_page_sum){    //[2016.09.21]bug-fixed.
            //前へを表示
            $a_sRet .= "&nbsp;&nbsp;<a href='#' onclick='".$h_func."(".$a_start_page.");'>次へ</a>";
        }

    }else{
        $a_sRet = "<font color='#ff0000'>現在、登録データはありません。</font>";
    }    
    
    return $a_sRet;
}

function com_select_pager(&$h_conn, &$h_stmt, $h_sql_src, $h_PageNo, &$h_total_num)
{
    //①件数を取得する。
    $a_sql = "SELECT COUNT(s1.cr_id) AS total_num FROM (".$h_sql_src.") s1;";
    $h_stmt = $h_conn->prepare($a_sql);
    //$a_stmt->bindParam(':pass', $a_pass,PDO::PARAM_STR);
    $h_stmt->execute();
    $a_result = $h_stmt->fetch(PDO::FETCH_ASSOC);
    $h_total_num = $a_result['total_num'];
#echo '$a_total_num:'.$a_total_num.'<br>';    
    $a_start_idx = (($h_PageNo-1)*$GLOBALS['g_MAX_LINE_PAGE']) + 1;
    $a_end_idx = ($h_PageNo*$GLOBALS['g_MAX_LINE_PAGE']);

    //②ページ対象のSELECT
    $h_conn->exec("SET @rownum=0");
    $a_sql = "SELECT s2.* FROM (";
    $a_sql .= " SELECT  s1.*, @rownum:=@rownum+1 AS ROW_NUM FROM (".$h_sql_src.") s1";
    $a_sql .= ") s2 WHERE (s2.ROW_NUM BETWEEN ".$a_start_idx." AND ".$a_end_idx.");";
    $h_stmt = $h_conn->prepare($a_sql);
    //$a_stmt->bindParam(':pass', $a_pass,PDO::PARAM_STR);
    $h_stmt->execute();
    
}
?>
