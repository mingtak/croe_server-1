<?php
include ("../config/config.php");
include_once (MODULES ."DBmySQL.php");
include_once (MODULES ."Lib.php");

CheckEmpty($_POST['LoginID'], "管理帳號");
CheckEmpty($_POST['LoginPW'], "管理密碼");

$DB->Connect();
$DB->Select(DATABASE);

if (!checkID($_POST['LoginID'], $_POST['LoginPW']))
{
	$loginQuery = $DB->Query("SELECT * FROM ". TABLE_LOGIN ." WHERE ".TABLE_LOGIN."ID='" . $_POST['LoginID'] . "' AND ".TABLE_LOGIN."PW='" . $_POST['LoginPW'] . "';");
	$loginCount = $DB->Num($loginQuery);

	if (!($loginCount))
		ErrorMsg("抱歉！您沒有使用管理區的權限！");
	else
		$loginArray = $DB->Arrays($loginQuery);
}

SetCookie("loginNo", $loginArray[TABLE_LOGIN.'No'], 0);
SetCookie("loginID", $_POST['LoginID'], 0);
SetCookie("loginPW", $_POST['LoginPW'], 0);
SetCookie("loginAccess", $loginArray[TABLE_LOGIN.'Access'], 0);

$DB->Log("使用者登入", $_POST['LoginID']);

Transfer("frame.php");
?>