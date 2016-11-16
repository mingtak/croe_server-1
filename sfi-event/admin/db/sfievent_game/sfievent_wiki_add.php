<?php
/******************************************************************/
// Initialize
/******************************************************************/
include ("../check.php");

$_table = TABLE_PREFIX.'wiki';

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
								<input type="text" name="<?php echo $_table?>Name" maxlength="255" size="50">
							</td>
						</tr>
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'Phone']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<input type="text" name="<?php echo $_table?>Phone" maxlength="255" size="50">
							</td>
						</tr>
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'Email']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<input type="text" name="<?php echo $_table?>Email" maxlength="255" size="50">
							</td>
						</tr>
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'Word']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<input type="text" name="<?php echo $_table?>Word" maxlength="255" size="50">
							</td>
						</tr>
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'Hide']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<input type="radio" name="<?php echo $_table?>Hide" value="0" checked> 顯示於前端
								<input type="radio" name="<?php echo $_table?>Hide" value="1"> 隱藏於前端
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
