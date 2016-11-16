<?php
/******************************************************************/
// Initialize
/******************************************************************/
include ("../check.php");

$_table = TABLE_PREFIX.'wiki';

CheckEmpty($_GET['controlNo'], "控制代碼");

$DB->Select(DATABASE);
$dbQuery = $DB->Query("SELECT * FROM ". $_table ." WHERE ". $_table ."No = '". $_GET['controlNo'] ."';");

if (!$DB->Num($dbQuery))
{
	ErrorMsg("抱歉！控制代碼錯誤！");
}
else
{
	$dbArray = $DB->Arrays($dbQuery);
}

include_once (PAGES . "back_top.php");
?>

<body bgcolor="#FFFFFF" text="#000000" topmargin="0" leftmargin="0">
<script language="JavaScript" src="<?php echo JSCRIPT?>scw.js"></script>

<div align="center"><center>
	<?php echo $UI->StatusBar($location)?>
	<table><tr><td></td></tr></table>
	<?php echo $UI->Win('修改 - ' . $tagArray['pageName'])?>
		<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td>
					<table width="100%" cellspacing="1" bgcolor="#9E9E9E">
						<form name="form" method="post" action="<?php echo $_table?>_editing.php" enctype="multipart/form-data">
						<input type="hidden" name="controlNo" value="<?php echo $_GET['controlNo']?>">
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'Name']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<input type="text" name="<?php echo $_table?>Name" maxlength="255" size="50" value="<?php echo $dbArray[$_table.'Name']?>">
							</td>
						</tr>
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'Phone']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<input type="text" name="<?php echo $_table?>Phone" maxlength="255" size="50" value="<?php echo $dbArray[$_table.'Phone']?>">
							</td>
						</tr>
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'Email']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<input type="text" name="<?php echo $_table?>Email" maxlength="255" size="50" value="<?php echo $dbArray[$_table.'Email']?>">
							</td>
						</tr>
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'Word']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<input type="text" name="<?php echo $_table?>Word" maxlength="255" size="50" value="<?php echo $dbArray[$_table.'Word']?>">
							</td>
						</tr>
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'Hide']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<input type="radio" name="<?php echo $_table?>Hide" value="0"<?php echo ($dbArray[$_table.'Hide'] == 0) ? ' checked' : ''?>> 顯示於前端
								<input type="radio" name="<?php echo $_table?>Hide" value="1"<?php echo ($dbArray[$_table.'Hide'] == 1) ? ' checked' : ''?>> 隱藏於前端
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