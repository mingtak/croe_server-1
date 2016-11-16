<?php
include_once ("check.php");
include_once (PAGES . "back_top.php");

$loginAccess = explode(",", $_COOKIE['loginAccess']);
?>

<script type="text/JavaScript">
<!--
var ListMenu =
[
<?php
buildRows(0, 0, "./db/");

function buildRows($refer, $referAccess, $path) {
	// 讀取全域變數
	global $DB, $loginAccess;

	// 讀取物件本身
	$objectQuery = $DB->Query("SELECT * FROM ". TABLE_PAGE ." WHERE ".TABLE_PAGE."Index = '". $refer ."' AND ".TABLE_PAGE."Disabled != '1' ORDER BY ".TABLE_PAGE."Sort;");
	while ($objectArray = $DB->Arrays($objectQuery)) {

		$referAccess = ($refer == 0 || $referAccess == 0) ? $objectArray[TABLE_PAGE.'No'] : $referAccess;

		// 確認該使用者是否有權限使用本功能模組
		if ((checkID( $_COOKIE['loginID'],  $_COOKIE['loginPW'])) || (in_Array($referAccess, $loginAccess))) {

			// 確認是否有子物件
			$childQuery = $DB->Query("SELECT * FROM ". TABLE_PAGE ." WHERE ".TABLE_PAGE."Index = '". $objectArray[TABLE_PAGE.'No'] ."' AND ".TABLE_PAGE."Disabled != '1';");
			$childCount = $DB->Num($childQuery);

			// 還有子物件
			if ($childCount) {
				echo "[null, '". $objectArray[TABLE_PAGE.'Name'] ."', null, 'main', '". $objectArray[TABLE_PAGE.'Intro'] ."',";
				buildRows($objectArray[TABLE_PAGE.'No'], $referAccess, $path . $objectArray[TABLE_PAGE.'ID'] . "/");
				echo "],\n";
			}

			// 已沒有子物件，可以直接輸出
			else {
				echo "[null, '". $objectArray[TABLE_PAGE.'Name'] ."', '". $path . $objectArray[TABLE_PAGE.'ID'] .".php', 'main', '". $objectArray[TABLE_PAGE.'Intro'] ."'],\n";
			}

		}

	}
}

//$DB->Close();
?>
	['<img src=<?php echo IMAGES?>/interface/door.gif>', '&nbsp;登出系統', 'logout.php', '_top', '登出本系統']
];
-->
</script>

<body bgcolor="#FFFFFF" text="#000000" topmargin="0" marginwidth="0" marginheight="0">

<table width="140" border="0" cellspacing="0" cellpadding="0">
  <tr><td height="20"></td></tr>
	<tr>
		<td>
			<fieldset>
				<legend align="center" style="color: #888888;">系統功能選單</legend>
				<div id="List"></div>
				<script type="text/JavaScript">
                                <!--
				ctDraw ('List', ListMenu, ctThemeXP2, 'ThemeXP', 0, 1);
                                -->
				</script>
			</fieldset>
		</td>
	</tr>
</table>

</body>
</html>
