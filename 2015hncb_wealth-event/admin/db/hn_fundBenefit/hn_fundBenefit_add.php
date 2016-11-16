<?php
/******************************************************************/
// Initialize
/******************************************************************/
include ("../check.php");

$_table = TABLE_PREFIX.'fundBenefit';

include_once (PAGES . "back_top.php");
?>

<body bgcolor="#FFFFFF" text="#000000" topmargin="0" leftmargin="0">
<script language="JavaScript" src="<?php echo JSCRIPT?>scw.js"></script>

<div align="center"><center>
	<?php echo $UI->StatusBar($location)?>
	<table><tr><td></td></tr></table>
	<?php echo $UI->Win('新增 - ' . $tagArray['pageName'])?>
		<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td>
					<table width="100%" cellspacing="1" bgcolor="#9E9E9E">
						<form name="form" method="post" action="<?php echo $_table?>_adding.php" enctype="multipart/form-data">
						
						<tr height="25">
							<td width="15%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'_fundType']?>：
							</td>
							<td width="85%" bgcolor="#FFFFFF">
								<input type="text" name="<?php echo $_table?>_fundType" size="50">
							</td>
						</tr>
						<tr height="25">
							<td width="15%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'_fundName']?>：
							</td>
							<td width="85%" bgcolor="#FFFFFF">
								<input type="text" name="<?php echo $_table?>_fundName" size="100">
							</td>
						</tr>
						<tr height="25">
							<td width="15%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'_fundWarn']?>：
							</td>
							<td width="85%" bgcolor="#FFFFFF">
								<input type="text" name="<?php echo $_table?>_fundWarn" size="100">
							</td>
						</tr>
						<tr height="25">
							<td width="15%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'_fundRisk']?>：
							</td>
							<td width="85%" bgcolor="#FFFFFF">
								<input type="text" name="<?php echo $_table?>_fundRisk" size="50">
							</td>
						</tr>
						
						<tr height="25">
							<td width="15%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'_fundHnID']?>：
							</td>
							<td width="85%" bgcolor="#FFFFFF">
								<input type="text" name="<?php echo $_table?>_fundHnID" size="50">
							</td>
						</tr>
						<tr height="25">
							<td width="15%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'_fundIntr']?>：
							</td>
							<td width="85%" bgcolor="#FFFFFF">
								<input type="text" name="<?php echo $_table?>_fundIntr" size="50">
							</td>
						</tr>
						<tr height="25">
							<td width="15%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'_fundCurrency']?>：
							</td>
							<td width="85%" bgcolor="#FFFFFF">
								<input type="text" name="<?php echo $_table?>_fundCurrency" size="50">
							</td>
						</tr>
						<tr height="25">
							<td width="15%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'_fundLink']?>：
							</td>
							<td width="85%" bgcolor="#FFFFFF">
								<input type="text" name="<?php echo $_table?>_fundLink" size="100">
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