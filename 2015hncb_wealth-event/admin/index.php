<?php
$disabledPaging = TRUE;

include ("../config/config.php");
include_once (PAGES . "back_top.php");
?>

<body onLoad="login.LoginID.focus();">
<script language="JavaScript">
<!--
function CheckForm() {
	if (!(CheckEmpty(login.LoginID,"您的管理帳號",16,2))) return false;
	if (!(CheckEmpty(login.LoginPW,"您的管理密碼",16,2))) return false;
}
//-->
</script>

<table><tr><td></td></tr></table>

<div align="center"><center>
	<form method="post" action="login.php" name="login" onSubmit="return(CheckForm())">
	<table width="300" cellspacing="1" bgcolor="#395B84">
		<tr bgcolor="#395B84" height="23">
			<td width="300" align="center" colspan="2">
				<font color="white" class="font2">
					「<?php echo SITETITLE?>」
				</font>
			</td>
		</tr>
		<tr height="25">
			<td width="120" bgcolor="#D8E3F1">
				&nbsp;&gt;&gt; 登入帳號：
			</td>
			<td width="180" bgcolor="#FFFFFF">
				&nbsp;<input type="text" name="LoginID" size="20" maxlength="16" style="width: 150px">
			</td>
		</tr>
		<tr height="25">
			<td width="120" bgcolor="#D8E3F1">
				&nbsp;&gt;&gt; 登入密碼：
			</td>
			<td width="180" bgcolor="#FFFFFF">
				&nbsp;<input type="password" name="LoginPW" size="20" maxlength="16" style="width: 150px">
			</td>
		</tr>
		<tr bgcolor="white" height="25">
			<td width="300" align="center" colspan="2">
				<input type="submit" value=" 確 定 登 入 ">
			</td>
		</tr>
	</table>
	</form>
</center></div>

</body>
</html>