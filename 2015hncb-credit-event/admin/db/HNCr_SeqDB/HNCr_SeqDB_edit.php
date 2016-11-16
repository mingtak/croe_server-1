<?php
/******************************************************************/
// Initialize
/******************************************************************/
include ("../check.php");

$_table = TABLE_PREFIX.'SeqDB';

CheckEmpty($_GET['controlNo'], "控制代碼");

$DB->Select(DATABASE);
$dbQuery = $DB->Query("SELECT * FROM ". $_table ." WHERE ". $_table ."_ID = '". $_GET['controlNo'] ."';");

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
								<?php echo $_fieldData[$_table.'_winnerName']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<input type="text" name="<?php echo $_table?>_winnerName" size="20" value="<?php echo $dbArray[$_table.'_winnerName']?>">
							</td>
						</tr>
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'_winnerPhone']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<input type="text" name="<?php echo $_table?>_winnerPhone" size="10" maxlength="10" value="<?php echo $dbArray[$_table.'_winnerPhone']?>">
							</td>
						</tr>
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'_winnerEMail']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<input type="text" name="<?php echo $_table?>_winnerEMail" size="100" maxlength="100" value="<?php echo $dbArray[$_table.'_winnerEMail']?>">
							</td>
						</tr>
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'_SeqID']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<input type="text" name="<?php echo $_table?>_SeqID" size="30" value="<?php echo $dbArray[$_table.'_SeqID']?>">
							</td>
						</tr>
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'_Prize']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<input type="text" name="<?php echo $_table?>_Prize" size="8" maxlength="1" value="<?php echo $dbArray[$_table.'_Prize']?>">
							</td>
						</tr>
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'_Date']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<input type="text" name="<?php echo $_table?>_Date" size="30" value="<?php echo $dbArray[$_table.'_Date']?>">
							</td>
						</tr>
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'_PrizeSeqID']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<input type="text" name="<?php echo $_table?>_PrizeSeqID" size="30" value="<?php echo $dbArray[$_table.'_PrizeSeqID']?>">
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
<?php
$CKEditor->replace($_table . 'Content');
?>