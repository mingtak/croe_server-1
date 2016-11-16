<?php
require(__DIR__ . '/config/config.php');
require(__DIR__ . '/modules/DBmySQL.php');
require(__DIR__ . '/modules/Lib.php');

if ($_POST['checkbox'] != 1) ErrorMsg('請先同意主辦單位條款！');
if (empty($_POST['name'])) ErrorMsg('請填寫姓名欄位！');
if (empty($_POST['phone'])) ErrorMsg('請填寫聯絡電話欄位！');
if (empty($_POST['email'])) ErrorMsg('請填寫電子信箱欄位！');
if (empty($_POST['address'])) ErrorMsg('請填寫聯絡地址欄位！');

$DB->Connect();
$DB->Select('core_marketing');

$DB->Query("INSERT INTO sfimonopoly_member VALUES(null, '{$_POST['name']}', '{$_POST['phone']}', '{$_POST['email']}', '{$_POST['address']}');");

$DB->Close();

Msg("活動登錄完成！", "index.html");
?>