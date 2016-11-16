<?php
/******************************************************************/
// 引入模組檔
/******************************************************************/
include ("../check.php");
include ("../../endechn.php");
/******************************************************************/
// Initialize
/******************************************************************/
$_table = TABLE_PREFIX.'SeqDB';

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
	$_table.'_SMSStat',
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
	$_table.'_SMSStat',
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
	$_table.'_SMSStat',
);

$DB->Select(DATABASE);
$fieldInfo = $DB->Query("SHOW FULL COLUMNS FROM " . $_table);
$_fa = array();
while ($row = mysql_fetch_assoc($fieldInfo))
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

//foreach ($_fieldData as $c => $f)
foreach ($_listArray as $_listItem)
{
	
	$fw1 .= mb_convert_encoding($_fieldData[$_listItem], 'big5', 'UTF-8') . ',';
}
$fw1 .= mb_convert_encoding('身分證ID', 'big5', 'UTF-8') . ',';
$fw1 = substr($fw1, 0, -1);
fwrite($fp, $fw1);

while ($dbArray = $DB->Arrays($dbQuery))
{
	
	$fw2 = "\n";
	
	foreach ($_listArray as $_listItem)
	{
		$fw2 .= '="' . mb_convert_encoding($dbArray[$_listItem], 'big5', 'UTF-8') .'",';
	}
	$fw2 .= '="' . mb_convert_encoding(trans_decrypt($dbArray['HNCr_SeqDB_winnerSecID']), 'big5', 'UTF-8') .'",';
	
	
	//foreach ($_fa as $fc => $fa)
	//{
	//	$fw2 .= '="' . mb_convert_encoding($dbArray[$fa], 'big5', 'UTF-8') .'",';
	//}
	$fw2 = substr($fw2, 0, -1);
	fwrite($fp, $fw2);
}

fclose($fp);

#header("Location: " . UPLOAD . $_filename);
header("Content-type:application/vnd.ms-excel");
header("Content-Disposition:filename=".$_filename);
readfile(UPLOAD . $_filename);
?>