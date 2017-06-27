<?php

require_once('./global.php');

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HAL社内管理システム</title>
  <link href="./bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="./css/hal-kanri-login.css" rel="stylesheet">
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
 
<body>
<script src="./jquery/1.12.4/jquery.min.js"></script>
<!-- script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script -->
<script src="./bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

<link href="http://fonts.googleapis.com/css?family=Oxygen:400,300,700" rel="stylesheet" type="text/css"/>
<link href="http://code.ionicframework.com/ionicons/1.4.1/css/ionicons.min.css" rel="stylesheet" type="text/css"/>

<script src="./js/hal-kanri-common.js"></script>

<div class="signin cf">
  <div class="avatar"></div>
  <form name="frm_login" action="./index.php" method="post">
    <!--
    <div class="inputrow">
      <input type="text" id="name" placeholder="Username"/>
      <label class="ion-person" for="name"></label>
    </div>
    -->
    <div class="inputrow">
        <input type="password" id="pass" placeholder="パスワード" autocomplete="off" onkeydown="check_keydown();"/>
      <label class="ion-locked" for="pass"></label>
    </div>
    <input type="checkbox" name="remember" id="remember"/>
    <label class="radio" for="remember">ログイン状態を保持する</label>
    <input type="button" value="ログイン"　 onclick="exec_login(false);" />
  </form>
</div>

<div id="my-result" style="z-index:100; text-align:center; width:auto; color: #ff0000;"></div>

</body>
</html>

<script src="./js/hal-kanri-login.js"></script>

