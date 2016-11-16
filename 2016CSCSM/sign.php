<?php
include('./config/config.php');
include('./modules/Lib.php');
include('./modules/DBmySQL.php');

CheckEmpty($_POST['memberName'], '姓名');
CheckEmpty($_POST['memberPhone'], '電話');
CheckEmail($_POST['memberEmail']);

$DB->Connect();
$DB->Select(DATABASE);

$DB->Query("INSERT INTO ".TABLE_PREFIX."member VALUES (null, '{$_POST['memberName']}', '{$_POST['memberPhone']}', '{$_POST['memberEmail']}', NOW(), '". getenv('REMOTE_ADDR') ."')");

$DB->Close();

Msg('報名完成！', 'index.html');
?>