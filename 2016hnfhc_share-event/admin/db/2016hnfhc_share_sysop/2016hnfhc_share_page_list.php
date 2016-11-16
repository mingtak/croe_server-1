<?php
include ("../check.php");

$_table = TABLE_PAGE;

/******************************************************************/
// Start to show interface
/******************************************************************/
include_once (PAGES . "back_top.php");

?>
<body bgcolor="#FFFFFF" text="#000000" topmargin="0" leftmargin="0">

<div align="center"><center>
	<?php echo $UI->StatusBar($location)?>
	<table><tr><td></td></tr></table>
	<?php echo $UI->Win($tagArray['pageName'])?>
		<table width="100%" cellspacing="0" cellpadding="0">
			<form method="post" action="<?php echo $_table?>_modify.php">
			<tr>
				<td>
					<table width="100%" cellspacing="1" bgcolor="#9E9E9E">
						<?php						
						$DB->Select(DATABASE);

						pageRows(0, 0);

						function pageRows($refer, $level)
						{
							global $DB, $_COOKIE, $_table;

							$objectQuery = $DB->Query("SELECT * FROM ". $_table ." WHERE ".$_table."Index = '". $refer ."' ORDER BY ".$_table."Sort;");
							while ($objectArray = $DB->Arrays($objectQuery))
							{
								$childQuery = $DB->Query("SELECT * FROM ". $_table ." WHERE ".$_table."Index = '". $objectArray[$_table.'No'] ."';");
								$childCount = $DB->Num($childQuery);
						?>
						<tr bgcolor="#FFFFFF" height="30" onMouseOver="TdColor(this,'#DEEEF3')" onMouseOut="TdColor(this,'#FFFFFF')">
							<td>
								<?php
								echo "&nbsp;";
								for ($ii = 0; $ii < $level; $ii++)
								{
									echo "　";
								}
								for ($ii = 0; $ii <= $level; $ii++)
								{
									echo "&gt;";
								}
								?>
								排序值：<input type="text" size="2" name="pageSort_<?php echo $objectArray[$_table.'No']?>" value="<?php echo $objectArray[$_table.'Sort']?>">
								名稱：<input type="text" size="20" name="pageName_<?php echo $objectArray[$_table.'No']?>" value="<?php echo $objectArray[$_table.'Name']?>"<?php echo ($_COOKIE['loginID'] == SYSOP) ? '' : ' readonly'?>>
								說明：<input type="text" size="50" name="pageIntro_<?php echo $objectArray[$_table.'No']?>" value="<?php echo $objectArray[$_table.'Intro']?>">
								前端隱藏：<input type="checkbox" value="1" name="pageDisabled_<?php echo $objectArray[$_table.'No']?>"<?php echo ($objectArray[$_table.'Disabled']) ? ' checked' : ''?>>
							</td>
						</tr>
						<?php
								if ($childCount)
								{
									pageRows($objectArray[$_table.'No'], $level + 1);
								}
							}
						}
						?>
					</table>
				</td>
			</tr>
			<tr><td height="5"></td></tr>
			<tr>
				<td height="50" align="center">
					<input type="submit" value=" 確 定 送 出 修 改 頁 面 資 訊 及 排 序 ">
				</td>
			</tr>
			</form>
		</table>
	<?php echo $UI->Dow()?>
</center></div>

</body>
</html>