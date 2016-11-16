<?php
include('./config/config.php');
include('./modules/Lib.php');
include('./modules/DBmySQL.php');

CheckEmpty($_POST['memberName'], '姓名');
CheckEmpty($_POST['memberPhone'], '電話');

$DB->Connect();
$DB->Select(DATABASE);

$_queryCount = $DB->Num($DB->Query("SELECT * FROM ". TABLE_PREFIX ."member where " . TABLE_PREFIX ."memberID='".$_POST['memberID']."'"));
if ($_queryCount==0)
{
$DB->Query("INSERT INTO ".TABLE_PREFIX."member VALUES (null, '{$_POST['memberFB_ID']}','{$_POST['memberName']}','{$_POST['memberID']}', '{$_POST['memberPhone']}', '{$_POST['memberEMail']}', NOW(), '". getenv('REMOTE_ADDR') ."')");
}else
{
	$DB->Query("Update ".TABLE_PREFIX."member SET ".TABLE_PREFIX."memberName  ='". $_POST['memberName']."',".TABLE_PREFIX."memberEMail = '".$_POST['memberEMail']."',".TABLE_PREFIX."memberPhone = '".$_POST['memberPhone']. "',".TABLE_PREFIX."memberFB_ID = '".$_POST['memberFB_ID'] . "' where ".TABLE_PREFIX."memberID='".  $_POST['memberID'] ."';") ;

}


$DB->Close();

Msg('填寫完成！', 'fbshare.html');
?>