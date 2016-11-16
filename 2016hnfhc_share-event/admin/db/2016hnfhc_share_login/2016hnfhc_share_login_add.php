<?php
/******************************************************************/
// Initialize
/******************************************************************/
include ("../check.php");
$_table = TABLE_LOGIN;
include_once (PAGES . "back_top.php");
?>

<body bgcolor="#FFFFFF" text="#000000" topmargin="0" leftmargin="0">
<script language="JavaScript">
<!--
function Check() {
	if (!CheckEmpty(form.<?php echo $_table?>ID, "管理帳號", 16, null)) return false;
}
//-->
</script>

<div align="center"><center>
	<?php echo $UI->StatusBar($location)?>
	<table><tr><td></td></tr></table>
	<?php echo $UI->Win('新增 - ' . $tagArray[$_table.'Name'])?>
		<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td>
					<table width="100%" cellspacing="1" bgcolor="#9E9E9E">
						<form name="form" method="post" action="<?php echo $_table?>_adding.php" onSubmit="return(Check())" enctype="multipart/form-data">
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'ID']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<input type="text" name="<?php echo $_table?>ID" maxlength="16" size="16">
							</td>
						</tr>
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'PW']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<input type="text" name="<?php echo $_table?>PW" maxlength="16" size="16">
							</td>
						</tr>
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'Email']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<input type="text" name="<?php echo $_table?>Email" maxlength="128" size="40">
							</td>
						</tr>
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'Access']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<table width="100%" cellspacing="1" bgcolor="#777777">
									<tr height="22" bgcolor="#BDBDBD" align="center">
										<td width="5%">--</td>
										<td width="30%">標題</td>
										<td width="65%">介紹</td>
									</tr>
									<?php
									$pageQuery = $DB->Query("SELECT * FROM ". TABLE_PAGE ." WHERE ".TABLE_PAGE."Index = '0' ORDER BY ".TABLE_PAGE."Sort ASC;");
									while ($pageArray = $DB->Arrays($pageQuery)) {
										echo "									<tr bgcolor=\"#FFFFFF\" height=\"22\">\n";
										echo "										<td width=\"5%\" align=\"center\"><input type=\"checkbox\" name=\"" . $_table. "Access[]\" value=\"". $pageArray[TABLE_PAGE.'No'] ."\"></td>\n";
										echo "										<td width=\"30%\">&nbsp;". $pageArray[TABLE_PAGE.'Name'] ."</td>\n";
										echo "										<td width=\"65%\">&nbsp;". $pageArray[TABLE_PAGE.'Intro'] ."</td>\n";
										echo "									</tr>\n";
									}
									?>
								</table>
							</td>
						</tr>
						<tr height="35">
							<td width="100%" bgcolor="#DEDEDE" align="center" colspan="3">
								<input type="submit" value="  確  定  送  出  ">
							</td>
						</tr>
						</form>
					</table>
				</td>
			</tr>
		</table>
	<?php echo $UI->Dow()?>
</center></div>

</body>
</html>