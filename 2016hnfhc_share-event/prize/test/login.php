<?php
include('./__include.php');
if ($_POST['id'] == $id && $_POST['pw'] == $pw)
{
	header('location:index2.php');
	exit;
}
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

<body>
<div align="center"><table width="294" border="0" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr>
    <td width="294" height="82" valign="top"><span style="color:#FFF">帳號密碼錯誤！</span></a></td>
  </tr>
</table></div>
</body>
</html>
