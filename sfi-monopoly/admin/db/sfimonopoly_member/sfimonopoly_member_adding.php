<?php
/**********************************************************************************************/
// 引入模組檔
/**********************************************************************************************/
include ("../check.php");

$_table = TABLE_PREFIX.'member';

/**********************************************************************************************/
// 取出欄位標題
/**********************************************************************************************/
$fieldInfo = $DB->Query("SHOW FULL COLUMNS FROM " . $_table);
while ($row = mysqli_fetch_assoc($fieldInfo))
{
	$_fieldData[$row['Field']] = $row['Comment'];
}

/**********************************************************************************************/
// 檢查空白欄位
/**********************************************************************************************/
#CheckEmpty($_POST[$_table.'Title'], $_fieldData[$_table.'Title']);

/**********************************************************************************************/
// 處理特別欄位
/**********************************************************************************************/
if ($_FILES[$_table.'Pic']['name'])
{
	$fp = fopen($_FILES[$_table.'Pic']['tmp_name'], 'r');
	$content = fread($fp, filesize($_FILES[$_table.'Pic']['tmp_name']));
	$content = addslashes($content);
	fclose($fp);
	
	$_POST[$_table.'PicType'] = $_FILES[$_table.'Pic']['type'];
	$_POST[$_table.'PicBlob'] = $content;
}

/**********************************************************************************************/
// 刪除多餘欄位
/**********************************************************************************************/
// none

/**********************************************************************************************/
// 組合 INSERT 指令
/**********************************************************************************************/
$insertField = '';
$insertValue = '';

foreach ($_POST as $_field => $_value)
{
	$insertField .= $_field . ', ';
	$insertValue .= "'". $_value ."', ";
}

$insertField = substr($insertField, 0, -2);
$insertValue = substr($insertValue, 0, -2);

/**********************************************************************************************/
// 存入資料庫 or 更新資料庫
/**********************************************************************************************/
$DB->Query("INSERT INTO ". $_table ." (". $insertField .")VALUES(". $insertValue .");");
$DB->Log("新增資料 - " . $_table, $_COOKIE['loginID']);

/**********************************************************************************************/
// 輸出成功訊息
/**********************************************************************************************/
Msg("新增完成！", $_table . "_list.php");
?>