<?php
//include('__include.php');
include ('./config/config.php');

include ('./modules/Lib.php');
include ('./modules/DBmySQL.php');
include ('./modules/String.php');
define('TEMPDIR','./admin/');

	session_start();
	$DB->Connect();
	$DB->Select(DATABASE);

/*$t = 'HNCr_SeqDB';
CheckEmpty($_POST['SeqID'], '序號');
CheckEmpty($_POST['Name'], '姓名');
CheckEmpty($_POST['EMail'], 'e-mail');
CheckEmpty($_POST['SecID'], '身份證ID');
CheckEmpty($_POST['TelPhone'], '手機號碼');
if (!preg_match('/^[0-9]{10}$/', $_POST['phone']))	ErrorMsg('格式錯誤！手機號碼必須為 10位數字！');
CheckEmail($_POST['EMail']);

$DB->Query("Update HNCr_SeqDB SET HNCr_SeqDB_winnerName  ='". $_POST['Name']."',HNCr_SeqDB_winnerEMail = '".$_POST['EMail']."',HNCr_SeqDB_winnerSecID  ='". $_POST['SecID']."',HNCr_SeqDB_winnerPhone = '".$_POST['TelPhone']."' where HNCr_SeqDB_SeqID=".$_POST['SeqID'].";") ;*/
Transfer('p-game.php');
?>