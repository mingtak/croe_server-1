<?php
require('../config/config.php');
require('../modules/DBmySQL.php');
require('../modules/Lib.php');

if ($_POST['checkbox'] != 1) ErrorMsg('請先同意主辦單位條款！');
if (empty($_POST['name'])) ErrorMsg('請填寫姓名欄位！');
if (empty($_POST['phone'])) ErrorMsg('請填寫聯絡電話欄位！');
if (empty($_POST['email'])) ErrorMsg('請填寫電子信箱欄位！');

$DB->Connect();
$DB->Select('core_marketing');

$DB->Query("INSERT INTO sfievent_cup VALUES(null, '{$_POST['name']}', '{$_POST['phone']}', '{$_POST['email']}');");

$DB->Close();

setCookie('game', '');
setCookie('q1', '');
setCookie('q2', '');
setCookie('q3', '');
setCookie('q4', '');
setCookie('q5', '');
setCookie('q6', '');

#Msg("活動登錄完成！", "index.html");
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body onLoad="if(confirm('活動登錄完成！是否要繼續挑戰「金融知識 WIKI 百科創作」？')){ location.href='../sfi-wiki/'; }else{location.href='../';}">
</body>
</html>