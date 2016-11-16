<?php
/******************************************************************/
// Initialize
/******************************************************************/
include ("../check.php");

$_table = TABLE_LOGIN;

/******************************************************************/
// Configuring unit
/******************************************************************/
$_manageButton = 1;
$_enableAdd = 1;
$_enableEdit = 1;
$_enableDelete = 1;
$_enableView = 1;
$_enableSrch = 1;
$_enableSort = 1;
$_dataPerPage = 20;

$_srchArray = array
(
	$_table.'ID',
	$_table.'Email'
);

$_sortArray = array
(
	$_table.'ID',
	$_table.'Email'
);

/******************************************************************/
// Searching unit
/******************************************************************/
$_srchKeyword = ($_GET['keyword']) ? urldecode($_GET['keyword']) : "";
$_srchMode = (!(empty($_GET['target'])) && !(empty($_srchKeyword))) ? 1 : 0;
$_srchComp = (!$_GET['compare']) ? "%" : "";
$_pageQuery = ($_srchMode) ? " WHERE " . $_GET['target'] . " LIKE '" . $_srchComp . $_srchKeyword . $_srchComp . "'" : "";
$_srchBar = ($_srchMode) ? "&target=" .  $_GET['target'] . "&keyword=" . $_GET['keyword'] . "&compare=" . $_GET['compare'] : "";

/******************************************************************/
// Sorting unit
/******************************************************************/
$_sortBy = ($_GET['sort']) ? $_GET['sort'] : $_sortArray[0];
$_orderBy = ($_GET['order']) ? $_GET['order'] : 'ASC';
$_pageQuery .= " ORDER BY " . $_sortBy . " " . $_orderBy;
$_sortBar .= "&sort=" . $_sortBy . "&order=" . $_orderBy;

/******************************************************************/
// Paging unit
/******************************************************************/
$_pageBar = $_srchBar . $_sortBar;
$_pageNo = (empty($_GET['page'])) ? 1 : $_GET['page'];
$_queryCount = $DB->Num($DB->Query("SELECT * FROM " . $_table . $_pageQuery.""));

$_pageTotal = intval($_queryCount / $_dataPerPage);
$_pageTotal = ($_queryCount / $_dataPerPage != intval ($_queryCount / $_dataPerPage)) ? $_pageTotal = $_pageTotal + 1: $_pageTotal;
$_pageTotal = ($_pageTotal < 1) ? 1 : $_pageTotal;
$_pageStart = ($_pageNo * $_dataPerPage) - $_dataPerPage;
$_pageFirst = intval ($_pageNo / 10) * 10 + 1;
$_pageLast = $_pageFirst + 9;

if ($_pageNo < $_pageFirst)
{
	$_pageFirst = $_pageFirst - 10;
	$_pageLast = $_pageLast - 10;
}
if ($_pageLast > $_pageTotal)
{
	$_pageLast = $_pageTotal;
}

/******************************************************************/
// Start to show interface
/******************************************************************/
include_once (PAGES . "back_top.php");

?>
<body bgcolor="#FFFFFF" text="#000000" topmargin="0" leftmargin="0">
<script language="JavaScript">
<!--
function ModifyAct(act,no) {
	if (act == 1) {
		if (confirm("是否確定編輯？") == true) {
			location.href='<?php echo $_table?>_edit.php?controlNo=' + no;
		}
	}
	else if (act == 2) {
		if (confirm("是否確定刪除？") == true) {
			location.href='<?php echo $_table?>_delete.php?controlNo=' + no;
		}
	}
	else if (act == 3) {
		location.href='<?php echo $_table?>_view.php?controlNo=' + no;
	}
	else {
		alert("動作錯誤！");
	}
}

function goSearch(obj) {
	if (obj.target.value == "") {
		alert("請選擇您欲搜尋的目標！");
		obj.target.focus();
	}
	else if (obj.keyword.value == "") {
		alert("請輸入搜尋關鍵字！");
		obj.keyword.focus();
	}
	else {
		//location.href = "<?php echo $_table?>.php?target=" + obj.target.value + "&keyword=" + obj.keyword.value + "&compare=" + obj.compare.value;
		obj.submit();
	}
}
//-->
</script>

<div align="center"><center>
	<?php echo $UI->StatusBar($location)?>
	<table><tr><td></td></tr></table>
	<?php echo $UI->Win('列表 - ' . $tagArray['pageName'])?>
		<table width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td colspan="3">
					<table width="100%" height="30" bgcolor="#DEDEDE" cellspacing="0" cellpadding="0">
						<tr>
							<?php if ($_enableAdd) {?>
							<td width="180" align="center" valign="middle" onMouseOver="TdColor(this, '#FFFFFF')" onMouseOut="TdColor(this, '#DEDEDE')">
								<table cellspacing="0" cellspacing="0" style="cursor: pointer" onClick="location.href='<?php echo $_table?>_add.php';">
									<tr>
										<td><img src="<?php echo IMAGES?>interface/write.gif"></td>
										<td></td>
										<td valign="bottom">新增 / 張貼 一則新資料</td>
									</tr>
								</table>
							</td>
							<?php } ?>
							<td width="1" bgcolor="#CCCCCC"></td>
							<td width="1" bgcolor="#FFFFFFF"></td>
							<td width="5"></td>
							<?php if ($_enableSrch) {?>
							<td align="left" valign="middle">
								<table cellspacing="0" cellspacing="0">
									<form name="search" method="post" action="<?php echo $_table?>_search.php">
									<tr>
										<td><img src="<?php echo IMAGES?>interface/search.gif"></td>
										<td></td>
										<td>搜尋資料：</td>
										<td>
											<select name="target">
												<option value="">搜尋目標</option>
												<?php
												foreach ($_srchArray as $srchItem)
												{
													echo '<option value="'. $srchItem .'"';
													if ($_GET['target'] == $srchItem)
													{
														echo ' selected';
													}
													echo '>'. $_fieldData[$srchItem] .'</option>';
												}
												?>
											</select>
										</td>
										<td>
											<input type="text" name="keyword" size="20" maxlength="128" value="<?php echo $_srchKeyword?>">
										</td>
										<td>
											<select name="compare">
												<option value="1"<?php echo ($_GET['compare']) ? "selected" : ""?>>完全比對</option>
												<option value="0"<?php echo (!$_GET['compare']) ? "selected" : ""?>>模糊比對</option>
											</select>
										</td>
										<td>
											<input type="submit" value="搜尋">
										</td>
										<td>
											<input type="button" value="清除" onClick="location.href='<?php echo $_table?>_list.php';">
										</td>
									</tr>
									</form>
								</table>
							</td>
							<?php } ?>
						</tr>
					</table>
				</td>
			</tr>
			<tr><td height="1" colspan="3" bgcolor="#CCCCCC"></td></tr>
			<tr><td height="1" colspan="3" bgcolor="#FFFFFF"></td></tr>
			<tr>
				<td>
					<table width="100%" cellspacing="1" bgcolor="#9E9E9E">
						<tr bgcolor="#DEDEDE" height="23" align="center">
							<td colspan="3">
								管理
							</td>
							<td>
								<?php echo $UI->fieldTitle($_table . 'ID')?>
							</td>
							<td>
								<?php echo $UI->fieldTitle($_table . 'Email')?>
							</td>							
						</tr>

						<?php
						$DB->Select(DATABASE);
						$dbQuery = $DB->Query("SELECT * FROM ". $_table . $_pageQuery." LIMIT ".$_pageStart.",".$_dataPerPage.";");

						while ($dbArray = $DB->Arrays($dbQuery)) {
						?>
						<tr bgcolor="#FFFFFF" height="22" onMouseOver="TdColor(this,'#DEEEF3')" onMouseOut="TdColor(this,'#FFFFFF')">
							<?php
							if ($_manageButton == 1)
							{
							?>
							<td width="25" align="center"><img src="<?php echo IMAGES?>interface/edit1.gif" <?php echo ($_enableEdit) ? 'style="cursor: pointer" onClick="ModifyAct(1,\'' . $dbArray[$_table.'No'] . '\')"' : 'style="filter: gray"' ?> alt="修改這筆資料"></td>
							<td width="25" align="center"><img src="<?php echo IMAGES?>interface/delete.gif" <?php echo ($_enableDelete) ? 'style="cursor: pointer" onClick="ModifyAct(2,\'' . $dbArray[$_table.'No'] . '\')"' : 'style="filter: gray"' ?> alt="刪除這筆資料"></td>
							<td width="25" align="center"><img src="<?php echo IMAGES?>interface/view1.gif" <?php echo ($_enableView) ? 'style="cursor: pointer" onClick="ModifyAct(3,\'' . $dbArray[$_table.'No'] . '\')"' : 'style="filter: gray"' ?> alt="瀏覽這筆資料的詳細內容"></td>
							<?php
							}
							else
							{
							?>
							<td width="25" align="center"><input type="button" value="修" <?php echo ($_enableEdit) ? 'style="cursor: pointer" onClick="ModifyAct(1,\'' . $dbArray[$_table.'No'] . '\')"' : 'disabled' ?>></td>
							<td width="25" align="center"><input type="button" value="刪" <?php echo ($_enableDelete) ? 'style="cursor: pointer" onClick="ModifyAct(2,\'' . $dbArray[$_table.'No'] . '\')"' : 'disabled' ?>></td> 
							<td width="25" align="center"><input type="button" value="看" <?php echo ($_enableView) ? 'style="cursor: pointer" onClick="ModifyAct(3,\'' . $dbArray[$_table.'No'] . '\')"' : 'disabled' ?>></td>
							<?php
							}
							?>
							</td>
							<td>
								<?php echo $dbArray[$_table.'ID']?>
							</td>
							<td>
								<?php echo $dbArray[$_table.'Email']?>
							</td>
						</tr>
						<?php
						}
						if (!$_queryCount) {
						?>
						<tr bgcolor="#FFFFFF" height="150">
							<td align="center" colspan="3">
								目 前 沒 有 相 關 的 資 料
							</td>
						</tr>
						<?php
						}
						?>

					</table>
				</td>
			</tr>
			<tr><td height="5" colspan="3"></td></tr>
			<tr>
				<td height="50" colspan="3" align="center">
					<?php echo $UI->page_bar($_pageBar)?>
				</td>
			</tr>
		</table>
	<?php echo $UI->Dow()?>
</center></div>

</body>
</html>