<?php
/******************************************************************/
// Initialize
/******************************************************************/
include ("../check.php");

$_table = TABLE_LOGIN;

CheckEmpty($_GET['controlNo'], "控制代碼");

$DB->Select(DATABASE);
$dbQuery = $DB->Query("SELECT * FROM ".$_table." WHERE ".$_table."No = '". $_GET['controlNo'] ."';");

if (!$DB->Num($dbQuery)) {
	ErrorMsg("抱歉！控制代碼錯誤！");
}
else {
	$dbArray = $DB->Arrays($dbQuery);
	$dbAccess = explode(",", $dbArray[$_table.'Access']);
}

include_once (PAGES . "back_top.php");
?>

<body bgcolor="#FFFFFF" text="#000000" topmargin="0" leftmargin="0">

<div align="center"><center>
	<?php echo $UI->StatusBar($location)?>
	<table><tr><td></td></tr></table>
	<?php echo $UI->Win('瀏覽 - ' . $tagArray[$_table.'Name'])?>
		<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td>
					<table width="100%" cellspacing="1" bgcolor="#9E9E9E">
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'ID']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								<?php echo $dbArray[$_table.'ID']?>
							</td>
						</tr>
						<tr height="25">
							<td width="25%" bgcolor="#DEDEDE">
								<?php echo $_fieldData[$_table.'PW']?>：
							</td>
							<td width="75%" bgcolor="#FFFFFF">
								&nbsp;[<a href="#" onClick="if (confirm('確定在螢幕上顯示本管理者密碼？')==true) {alert('管理者密碼：<?php echo $dbArray[$_table.'PW']?>');} else {return false;}">按此觀看該管理者密碼</a>]
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
										if (in_Array($pageArray[TABLE_PAGE.'No'], $dbAccess)) {
											echo "									<tr bgcolor=\"#FFFFFF\" height=\"22\">\n";
											echo "										<td width=\"5%\" align=\"center\"><input type=\"checkbox\" name=\"".$_table."Access[]\" value=\"". $pageArray[TABLE_PAGE.'No'] ."\" checked onClick=\"return false;\"></td>\n";
											echo "										<td width=\"30%\">&nbsp;". $pageArray[TABLE_PAGE.'Name'] ."</td>\n";
											echo "										<td width=\"65%\">&nbsp;". $pageArray[TABLE_PAGE.'Intro'] ."</td>\n";
											echo "									</tr>\n";
										}
									}
									?>
								</table>
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