<?php
include ("../config/config.php");
include_once (MODULES ."DBmySQL.php");

$DB->Select(DATABASE);
$DB->Log("使用者登出");

SetCookie("loginNo", "", 0);
SetCookie("loginID", "", 0);
SetCookie("loginPW", "", 0);
SetCookie("loginAccess", "", 0);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body onLoad="alert('您已成功登出管理系統！'); window.top.location.href='index.php';">
</body>
</html>