<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('./global.php');

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>HAL社内管理システム</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="ここにサイト説明を入れます">
<meta name="keywords" content="キーワード１,キーワード２,キーワード３,キーワード４,キーワード５">
<link rel="stylesheet" href="css/slide.css">
<link rel="stylesheet" href="css/style.css">
<script type="text/javascript" src="js/openclose.js"></script>
<script type="text/javascript" src="js/ddmenu_min.js"></script>
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
<script src="./jquery/1.12.4/jquery.min.js"></script>
<!-- script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script -->
<script src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script src="./jquery/jquery.blockUI.js"></script>

<link href="http://fonts.googleapis.com/css?family=Oxygen:400,300,700" rel="stylesheet" type="text/css"/>
<link href="http://code.ionicframework.com/ionicons/1.4.1/css/ionicons.min.css" rel="stylesheet" type="text/css"/>

<script src="./js/hal-kanri-common.js"></script>

<div id="container">

<header>
<?php
echo "<p style='padding-left: 4px;; color: #ffff00; margin-bottom: -20px;'>".$_SESSION["hal_branch"]." ".$_SESSION["hal_person"]." is logined.</p>";
?>
<h1 id="logo"><a href="./index.php"><img src="images/logo.png" alt="HAL社内管理システム"></a></h1>
<!--大きな端末用（901px以上端末）メニュー-->
<nav id="menubar">
<ul>
<li><a href="./index.php">ホーム</a></li>
<li class="arrow1"><a href="">台帳関連</a>
    <ul class="ddmenu">
        <li><a href="./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10100']; ?>">契約管理全体</a></li>
        <li><a href="./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10200']; ?>">給与台帳</a></li>
	<li><a href="./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10300']; ?>">検収台帳</a></li>
        <li><a href="./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10400']; ?>">注文書台帳</a></li>
	<li><a href="./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10500']; ?>">契約書台帳</a></li>
	<li><a href="./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10600']; ?>">派遣元台帳</a></li>
    </ul>
</li>
<?php if ($_SESSION['hal_auth'] == 0){ ?>
<li class="arrow1"><a href="">マスタ情報</a>
    <ul class="ddmenu">
        <li><a href="./index.php?mnu=<?php echo $GLOBALS['g_MENU_MAINTENANCE_90100']; ?>">ユーザ情報</a></li>
        <li><a href="./index.php?mnu=<?php echo $GLOBALS['g_MENU_MAINTENANCE_90200']; ?>">エンジニア情報</a></li>
    </ul>
</li>
<?php } ?>
</ul>
</nav>
</header>

<!--小さな端末用（900px以下端末）メニュー-->
<nav id="menubar-s">
<ul>
    <ul>
        <li><a href="./index.php">ホーム</a></li>
        <li><a href="./index.php?mnu=<?php echo $GLOBALS['g_MENU_CONTRACT_10000']; ?>">台帳関連</a></li>
<?php if ($_SESSION['hal_auth'] == 0){ ?>
        <li><a href="./index.php?mnu=<?php echo $GLOBALS['g_MENU_MAINTENANCE_90000']; ?>">マスタ情報</a></li>
<?php } ?>
    </ul>
</ul>
</nav>

<!--
<aside id="mainimg">
<img src="images/1.jpg" alt="" id="slide0">
<img src="images/1.jpg" alt="" id="slide1">
<img src="images/2.jpg" alt="" id="slide2">
<img src="images/3.jpg" alt="" id="slide3">
</aside>
-->

<?php
//echo "ようこそ ".$_SESSION["hal_branch"]." ".$_SESSION["hal_person"]."さん";
?>

<div id="contents">

    <div id="main">
