<?php
/******************************************************************/
// Initialize
/******************************************************************/
include ("../check.php");
include ("../../endechn.php");

$_table = TABLE_PREFIX.'SeqDB';

/******************************************************************/
// Configuring unit
/******************************************************************/
$_manageButton = 1;
$_enablemanage = 0;
$_enableAdd = 0;
$_enableEdit = 0;
$_enableDelete = 0;
$_enableView = 0;
$_enableSrch = 1;
$_enableSort = 1;
$_enableExport = 0;
$_enableImport = 0;
$_dataPerPage = 20;

	
$_srchArray = array
(
	$_table.'_ID',
	$_table.'_winnerName',
	$_table.'_winnerPhone',
	$_table.'_winnerEMail',
	$_table.'_SeqID',
	$_table.'_Prize',
	$_table.'_Date',
	$_table.'_PrizeSeqID',
	$_table.'_PrizeStatCheck'
);

$_sortArray = array
(
	$_table.'_ID',
	$_table.'_winnerName',
	$_table.'_winnerPhone',
	$_table.'_winnerEMail',
	$_table.'_SeqID',
	$_table.'_Prize',
	$_table.'_Date',
	$_table.'_PrizeSeqID',
	$_table.'_PrizeStatCheck'
		
);

$_listArray = array
(
	$_table.'_ID',
	$_table.'_winnerName',
	$_table.'_winnerPhone',
	$_table.'_winnerEMail',
	$_table.'_SeqID',
	$_table.'_Prize',
	$_table.'_Date',
	$_table.'_PrizeSeqID',
	$_table.'_PrizeStatCheck'
	
	
);

$_defaultSort = $_table . '_ID';
//$_defaultSort = $_sortArray[0];

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
$_sortBy = ($_GET['sort']) ? $_GET['sort'] : $_defaultSort;
$_orderBy = ($_GET['order']) ? $_GET['order'] : 'DESC';
$_pageQuery .= " ORDER BY " . $_sortBy . " " . $_orderBy;
$_sortBar .= "&sort=" . $_sortBy . "&order=" . $_orderBy;

/******************************************************************/
// Paging unit
/******************************************************************/
$_pageBar = $_srchBar . $_sortBar;
$_pageNo = (empty($_GET['page'])) ? 1 : $_GET['page'];
$_queryCount = $DB->Num($DB->Query("SELECT * FROM " . $_table . $_pageQuery.""));

$_pageTotal = ceil($_queryCount / $_dataPerPage);
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
function ModifyAct(act,no)
{
	if (act == 1)
	{
		if (confirm("是否確定編輯？") == true)
		{
			location.href='<?php echo $_table?>_edit.php?controlNo=' + no;
		}
	}
	else if (act == 2)
	{
		if (confirm("是否確定刪除？") == true)
		{
			location.href='<?php echo $_table?>_delete.php?controlNo=' + no;
		}
	}
	else if (act == 3)
	{
		location.href='<?php echo $_table?>_view.php?controlNo=' + no;
	}
	else
	{
		alert("動作錯誤！");
	}
}

function goSearch(obj)
{
	if (obj.target.value == "")
	{
		alert("請選擇您欲搜尋的目標！");
		obj.target.focus();
	}
	else if (obj.keyword.value == "")
	{
		alert("請輸入搜尋關鍵字！");
		obj.keyword.focus();
	}
	else
	{
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
							<?php if ($_enableExport) { ?>
							<td width="10"></td>
							<td>
								<input type="button" value="匯出所有序號資料" onClick="location.href='<?php echo $_table?>_export.php';">
							</td>
							<td width="10"></td>
							<td>
								<input type="button" value="僅匯出中獎的序號資料" onClick="location.href='<?php echo $_table?>_export2.php';">
							</td>
							<td width="10"></td>
							<?php } ?>
						</tr>
					</table>
				</td>
			</tr>
			<tr><td height="1" colspan="3" bgcolor="#CCCCCC"></td></tr>
			<tr><td height="1" colspan="3" bgcolor="#FFFFFF"></td></tr>
			<?php
			if ($_enableImport) {
			?>
			<tr>
				<td colspan="3">
					<table width="100%" height="30" bgcolor="#DEDEDE" cellspacing="0" cellpadding="0">
						<form method="POST" action="<?php echo $_table?>_import.php" enctype="multipart/form-data">
						<tr>
							<td width="10"></td>
							<td width="200">
								<input type="file" name="importFile">
							</td>
							<td><input type="submit" value="確定匯入"></td>
							<td width="10"></td>
							<td>
								<a href="<?php echo $_table?>_import.csv" target="_blank">[上傳範例檔]</a>
							</td>
						</tr>
						</form>
					</table>
				</td>
			</tr>
			<tr><td height="1" colspan="3" bgcolor="#CCCCCC"></td></tr>
			<tr><td height="1" colspan="3" bgcolor="#FFFFFF"></td></tr>
			<?php } ?>
			<tr>
				<td>
					<table width="100%" cellspacing="1" bgcolor="#9E9E9E">
						<tr bgcolor="#DEDEDE" height="23" align="center">
						
						<? if ($_eenablemanage == 1){ ?>
							
							<td colspan="3">
								管理
							</td>
						<?  } ?>	
							<?php
							foreach ($_listArray as $_listItem)
							{
								echo "<td>". $UI->fieldTitle($_listItem) ."</td>";
							}
							echo "<td>身分證ID</td>";
							?>
						</tr>

						<?php
						$DB->Select(DATABASE);
						$dbQuery = $DB->Query("SELECT * FROM ". $_table . $_pageQuery." LIMIT ".$_pageStart.",".$_dataPerPage.";");

						while ($dbArray = $DB->Arrays($dbQuery)) {
						?>
						<tr bgcolor="#FFFFFF" height="22" onMouseOver="TdColor(this,'#DEEEF3')" onMouseOut="TdColor(this,'#FFFFFF')">
						
							<?php
							if ($_eenablemanage == 1)
							{	
							if ($_manageButton == 1)
							{
							?>
							<td width="25" align="center"><img src="<?php echo IMAGES?>interface/edit1.gif" <?php echo ($_enableEdit) ? 'style="cursor: pointer" onClick="ModifyAct(1,\'' . $dbArray[$_table.'_ID'] . '\')"' : 'style="filter: gray"' ?> alt="修改這筆資料"></td>
							<td width="25" align="center"><img src="<?php echo IMAGES?>interface/delete.gif" <?php echo ($_enableDelete) ? 'style="cursor: pointer" onClick="ModifyAct(2,\'' . $dbArray[$_table.'_ID'] . '\')"' : 'style="filter: gray"' ?> alt="刪除這筆資料"></td>
							<td width="25" align="center"><img src="<?php echo IMAGES?>interface/view1.gif" <?php echo ($_enableView) ? 'style="cursor: pointer" onClick="ModifyAct(3,\'' . $dbArray[$_table.'_ID'] . '\')"' : 'style="filter: gray"' ?> alt="瀏覽這筆資料的詳細內容"></td>
							<?php
							}
							else
							{
							?>
							<td width="25" align="center"><input type="button" value="修" <?php echo ($_enableEdit) ? 'style="cursor: pointer" onClick="ModifyAct(1,\'' . $dbArray[$_table.'_ID'] . '\')"' : 'disabled' ?>></td>
							<td width="25" align="center"><input type="button" value="刪" <?php echo ($_enableDelete) ? 'style="cursor: pointer" onClick="ModifyAct(2,\'' . $dbArray[$_table.'_ID'] . '\')"' : 'disabled' ?>></td> 
							<td width="25" align="center"><input type="button" value="看" <?php echo ($_enableView) ? 'style="cursor: pointer" onClick="ModifyAct(3,\'' . $dbArray[$_table.'_ID'] . '\')"' : 'disabled' ?>></td>
							<?php
							}
							}
							?>
							</td>
							<?php
							foreach ($_listArray as $_listItem)
							{
								echo "<td>". $dbArray[$_listItem] ."</td>";
							}
							echo "<td>" . trans_decrypt($dbArray['HNCr_SeqDB_winnerSecID']) . "</td>";
							?>
							
						</tr>
						<?php
						}
						if (!$_queryCount) {
						?>
						<tr bgcolor="#FFFFFF" height="150">
							<td align="center" colspan="<?php echo sizeof($_listArray) + 5?>">
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