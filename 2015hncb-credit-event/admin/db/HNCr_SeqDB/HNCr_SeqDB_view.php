<?php
/******************************************************************/
// Initialize
/******************************************************************/
include ("../check.php");

$_table = TABLE_PREFIX.'SeqDB';

CheckEmpty($_GET['controlNo'], "控制代碼");

$DB->Select(DATABASE);
$dbQuery = $DB->Query("SELECT * FROM ".$_table." WHERE ".$_table."_ID = '". $_GET['controlNo'] ."';");

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
								<?php echo $_fieldData[$_table.'_ID']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<?php echo $dbArray[$_table.'_ID']?>
							</td>
						</tr>
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'_winnerName']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<?php echo $dbArray[$_table.'_winnerName']?>
							</td>
						</tr>
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'_winnerSecID']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<?php echo $dbArray[$_table.'_winnerSecID']?>
							</td>
						</tr>
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'_winnerPhone']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<?php echo $dbArray[$_table.'_winnerPhone']?>
							</td>
						</tr>
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'_winnerEMail']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<?php echo $dbArray[$_table.'_winnerEMail']?>
							</td>
						</tr>
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'_SeqID']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<?php echo $dbArray[$_table.'_SeqID']?>
							</td>
						</tr>
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'_Prize']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<?php echo $dbArray[$_table.'_Prize']?>
							</td>
						</tr>
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'_PrizeSeqID']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<?php echo $dbArray[$_table.'_PrizeSeqID']?>
							</td>
						</tr>
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'_PrizeStatCheck']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<?php echo $dbArray[$_table.'_PrizeStatCheck']?>
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