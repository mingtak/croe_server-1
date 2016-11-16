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
// Uploading unit
/******************************************************************/
if ($_FILES['importFile']['name'])
{
	$row = file($_FILES['importFile']['tmp_name']);

	for ($i = 0; $i < 1; $i++)
	{
		$sql = 'INSERT INTO ' . $_table . ' ('. $row[$i] .') VALUES (';
	}
	
	for ($i = 2; $i < sizeof($row); $i++)
	{
		$insert = $sql;
		foreach (explode(',', $row[$i]) as $data)
		{
			$insert .= "'". mb_convert_encoding($data, 'UTF-8', 'big5') ."',";
		}
		$insert = substr($insert, 0, -1);
		$insert .= ');';
		
		$DB->Query($insert);
	}

}
else
{
	ErrorMsg('找不到上傳的檔案！');
}
	
/******************************************************************/
// 輸出結果
/******************************************************************/
Msg("資料匯入完成！成功匯入 ". (sizeof($row) - 2) ." 筆", $_table."_list.php");
?>