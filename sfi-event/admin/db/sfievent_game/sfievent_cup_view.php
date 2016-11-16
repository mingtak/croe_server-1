<?php
/******************************************************************/
// Initialize
/******************************************************************/
include ("../check.php");

$_table = TABLE_PREFIX.'cup';

CheckEmpty($_GET['controlNo'], "控制代碼");

$DB->Select(DATABASE);
$dbQuery = $DB->Query("SELECT * FROM ".$_table." WHERE ".$_table."No = '". $_GET['controlNo'] ."';");

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

<div align="center"><center>
	<?php echo $UI->StatusBar($location)?>
	<table><tr><td></td></tr></table>
	<?php echo $UI->Win('瀏覽 - ' . $tagArray['pageName'])?>
		<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td>
					<table width="100%" cellspacing="1" bgcolor="#9E9E9E">
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'Name']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<?php echo $dbArray[$_table.'Name']?>
							</td>
						</tr>
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'Phone']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<?php echo $dbArray[$_table.'Phone']?>
							</td>
						</tr>
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'Email']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<?php echo $dbArray[$_table.'Email']?>
							</td>
						</tr>
						<tr height="35">
							<td width="100%" bgcolor="#DEDEDE" align="center" colspan="3">
								<input type="button" value="  返  回  上  頁  " onClick="history.back()">
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	<?php echo $UI->Dow()?>
</center></div>

</body>
</html>