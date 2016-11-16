<?php
/******************************************************************/
// Initialize
/******************************************************************/
include ("../check.php");

$_table = TABLE_PREFIX.'member';

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
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'Name']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<input type="text" name="<?php echo $_table?>Name" maxlength="30" size="30">
							</td>
						</tr>
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'Phone']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<input type="text" name="<?php echo $_table?>Phone" maxlength="16" size="30">
							</td>
						</tr>
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'Email']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<input type="text" name="<?php echo $_table?>Email" maxlength="50" size="30">
							</td>
						</tr>
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'Datetime']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<input type="text" name="<?php echo $_table?>Datetime" maxlength="16" size="30" value="<?php echo date('Y-m-d H:i:s')?>">
							</td>
						</tr>
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'IPAddr']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<input type="text" name="<?php echo $_table?>IPAddr" maxlength="16" size="30" value="<?php echo getenv('REMOTE_ADDR')?>">
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