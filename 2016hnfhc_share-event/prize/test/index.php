<?php
include('./__include.php');
if (!$login) header('location:index2.php');
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title?></title>
<style type="text/css">
<!--
.style2 {font-size: 36px;
text-align:center}
body {
	background-image: url(images/bg.gif);
}
-->
</style>
</head>

<body style="text-align:center; line-height:30px;">
<div style="margin:0 auto; margin-top:150px; width:350px; padding:20px 20px 20px 20px; border:1px #FFF solid; border-radius:15px;">
<form method="POST" action="login.php">
<span style="color:#FFF">帳號：</span><input type="text" name="id"><br>
<span style="color:#FFF">密碼：</span><input type="password" name="pw"><br>
<input type="submit" value="送出">
</form>
</div>
</body>
</html>
