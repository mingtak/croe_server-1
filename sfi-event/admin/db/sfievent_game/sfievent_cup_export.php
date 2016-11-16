<?php
/******************************************************************/
// 引入模組檔
/******************************************************************/
include ("../check.php");

/******************************************************************/
// Initialize
/******************************************************************/
$_table = TABLE_PREFIX.'cup';

$DB->Select(DATABASE);
$fieldInfo = $DB->Query("SHOW FULL COLUMNS FROM " . $_table);
$_fa = array();
while ($row = mysqli_fetch_assoc($fieldInfo))
{
	$_fieldData[$row['Field']] = $row['Comment'];
	$_fa[] = $row['Field'];
}

/******************************************************************/
// Searching unit
/******************************************************************/
$_srchKeyword = ($_GET['keyword']) ? urldecode($_GET['keyword']) : '';
$_srchMode = (!(empty($_GET['target'])) && !(empty($_srchKeyword))) ? 1 : 0;
$_srchComp = (!$_GET['compare']) ? '%' : '';
$_pageQuery = ($_srchMode) ? " WHERE " . $_GET['target'] . " LIKE '" . $_srchComp . $_srchKeyword . $_srchComp . "'" : '';

/******************************************************************/
// 取得資料
/******************************************************************/
$dbQuery = $DB->Query("SELECT * FROM ". $_table . $_pageQuery. ";");

$_filename = 'temp_'. date('U') .'.csv';

$fp = fopen(UPLOADPATH . $_filename, 'w');
$fw1 = '';
foreach ($_fieldData as $c => $f)
{
	$fw1 .= mb_convert_encoding($f, 'big5', 'UTF-8') . ',';
}

$fw1 = substr($fw1, 0, -1);
fwrite($fp, $fw1);

while ($dbArray = $DB->Arrays($dbQuery))
{
	$fw2 = "\n";
	foreach ($_fa as $fc => $fa)
	{
		$fw2 .= '="' . mb_convert_encoding($dbArray[$fa], 'big5', 'UTF-8') .'",';
	}
	$fw2 = substr($fw2, 0, -1);
	fwrite($fp, $fw2);
}

fclose($fp);

header("Location: " . UPLOAD . $_filename);
#header("Content-type:application/vnd.ms-excel");
#header("Content-Disposition:filename=".$_filename);
#readfile(UPLOAD . $_filename);
?>