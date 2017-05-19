<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./global.php');

if (!isset($_GET['mnu'])){
    //初期画面へ遷移
    header('Location: ./top.php');
}else{
    switch($_GET['mnu']){
    case $GLOBALS['g_MENU_CONTRACT_10000']:   //台帳：モバイル用
        header('Location: ./10000.php');
        break;
    case $GLOBALS['g_MENU_CONTRACT_10100']:   //契約管理全体
        header('Location: ./10100.php');
        break;
    case $GLOBALS['g_MENU_CONTRACT_10101']:   //契約管理全体：検索
        header('Location: ./10101.php');
        break;
    case $GLOBALS['g_MENU_CONTRACT_10102']:   //契約レポート：新規
    case $GLOBALS['g_MENU_CONTRACT_10103']:   //契約レポート：修正
        header('Location: ./10102.php?ACT='.$_GET['ACT'].'&ENO='.$_GET['ENO'].'&NO='.$_GET['NO']);
        break;
    case $GLOBALS['g_MENU_CONTRACT_10104']:   //契約レポート：削除
        header('Location: ./10104.php');
        break;
    case $GLOBALS['g_MENU_CONTRACT_10105']:   //契約終了レポート：新規
        header('Location: ./10105.php?ACT=e&NO='.$_GET['NO']);
        break;
    case $GLOBALS['g_MENU_CONTRACT_10106']:   //契約終了レポート：修正
        header('Location: ./10106.php');
        break;
    case $GLOBALS['g_MENU_CONTRACT_10107']:   //見積書作成
        header('Location: ./10107.php?ACT=e&NO='.$_GET['NO']);
        break;
    case $GLOBALS['g_MENU_CONTRACT_10200']:   //給与台帳
        header('Location: ./10200.php');
        break;
    case $GLOBALS['g_MENU_CONTRACT_10201']:   //給与台帳：検索
        header('Location: ./10201.php');
        break;
    case $GLOBALS['g_MENU_CONTRACT_10300']:   //検収台帳
        header('Location: ./10300.php');
        break;
    case $GLOBALS['g_MENU_CONTRACT_10301']:   //検収台帳：検索
        header('Location: ./10301.php');
        break;
    case $GLOBALS['g_MENU_CONTRACT_10400']:   //注文書台帳
        header('Location: ./10400.php');
        break;
    case $GLOBALS['g_MENU_CONTRACT_10401']:   //注文書台帳：検索
        header('Location: ./10401.php');
        break;
    case $GLOBALS['g_MENU_CONTRACT_10402']:   //注文書
        header('Location: ./10402.php?ACT='.$_GET['ACT'].'&NO='.$_GET['NO']);
        break;
    case $GLOBALS['g_MENU_CONTRACT_10403']:   //注文請書
        header('Location: ./10403.php?ACT='.$_GET['ACT'].'&NO='.$_GET['NO']);
        break;
    case $GLOBALS['g_MENU_CONTRACT_10500']:   //契約書台帳
        header('Location: ./10500.php');
        break;
    case $GLOBALS['g_MENU_CONTRACT_10501']:   //契約書台帳：検索
        header('Location: ./10501.php');
        break;
    case $GLOBALS['g_MENU_CONTRACT_10502']:   //労働契約書
        header('Location: ./10502.php?ACT='.$_GET['ACT'].'&NO='.$_GET['NO']);
        break;
    case $GLOBALS['g_MENU_CONTRACT_10503']:   //労働契約書（再発行）
        header('Location: ./10503.php?ACT='.$_GET['ACT'].'&NO='.$_GET['NO']);
        break;
    case $GLOBALS['g_MENU_CONTRACT_10504']:   //就業条件明示書
        header('Location: ./10504.php?ACT='.$_GET['ACT'].'&NO='.$_GET['NO']);
        break;
    case $GLOBALS['g_MENU_CONTRACT_10600']:   //派遣元台帳
        header('Location: ./10600.php');
        break;
    case $GLOBALS['g_MENU_CONTRACT_10601']:   //派遣元台帳：検索
        header('Location: ./10601.php');
        break;
    case $GLOBALS['g_MENU_MAINTENANCE_90000']:   //メンテナンス
        header('Location: ./90000.php');
        break;
    case $GLOBALS['g_MENU_MAINTENANCE_90100']:   //ユーザ情報：一覧
        header('Location: ./90100.php');
        break;
    case $GLOBALS['g_MENU_MAINTENANCE_90102']:   //ユーザ：新規
    case $GLOBALS['g_MENU_MAINTENANCE_90103']:   //ユーザ：修正
        header('Location: ./90102.php?ACT='.$_GET['ACT'].'&IDX='.$_GET['IDX']);
        break;
    case $GLOBALS['g_MENU_MAINTENANCE_90200']:   //エンジニア一覧
        header('Location: ./90200.php');
        break;
    case $GLOBALS['g_MENU_MAINTENANCE_90201']:   //エンジニア：検索
        header('Location: ./90201.php');
        break;
    case $GLOBALS['g_MENU_MAINTENANCE_90211']:   //エンジニア：アップロード
        header('Location: ./90211.php');
        break;
    default:
        break;
    }
}

?>
