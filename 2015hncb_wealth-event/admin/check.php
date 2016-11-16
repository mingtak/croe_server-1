<?php
$disabledPaging = TRUE;

include_once ("../config/config.php");
include_once (MODULES ."DBmySQL.php");
include_once (MODULES ."Lib.php");
include_once (INCLUDES . "uimaker.php");

CheckEmpty($_COOKIE['loginID'], "管理帳號");
CheckEmpty($_COOKIE['loginPW'], "管理密碼");

$DB->Connect();
$DB->Select(DATABASE);

if (!checkID( $_COOKIE['loginID'],  $_COOKIE['loginPW']))
{
	$query = $DB->Query("SELECT * FROM ". TABLE_LOGIN ." WHERE ".TABLE_LOGIN."ID='" . $_COOKIE['loginID'] . "' AND ".TABLE_LOGIN."PW='".$_COOKIE['loginPW']."';");
	$chk = $DB->Num($query);

	if (!($chk)) {
		ErrorMsg("抱歉！您的管理權限認證失敗，或您已連線逾時！");
	}
}

//$DB->Close();
?>