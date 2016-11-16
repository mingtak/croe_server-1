<?php
$_ACTION = array(
	'list' => '列表',
	'add' => '新增',
	'edit' => '修改', 
	'delete' => '刪除',
	'view' => '瀏覽',
	'send' => '發送'
);

$_tableData = array();
$_fieldData = array();

$query_string = ($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : '';
preg_match('/^(.*)db\/(.*)\/(.*)\_(.*)\.php$/', $_SERVER['SCRIPT_NAME'], $reg);

$location = array('系統首頁', '../../default.php');

$DB->Select(DATABASE);

/*$tagQuery = $DB->Query("SELECT * FROM page WHERE pageID = '". $reg[3] ."_list';");
$tagArray = $DB->Arrays($tagQuery);
array_push($location, $tagArray['pageName'], $tagArray['pageID'] . '.php', $_ACTION[$reg[4]] . $tagArray['pageName'], $reg[3] . '_'. $reg[4] .'.php' . $query_string);
*/

$tableInfoQuery = $DB->Query("SHOW TABLE STATUS");
while ($tableInfoArray = $DB->Arrays($tableInfoQuery))
{
	 $_tableData[$tableInfoArray['Name']] = $tableInfoArray['Comment'];
}

array_push($location, $_tableData[$_table], '');

if (array_key_exists($reg[4], $_ACTION))
{
	array_push($location, $_ACTION[$reg[4]] . ' - ' . $_tableData[$_table], $_SERVER['SCRIPT_NAME'] . $query_string);
}
else
{
	array_push($location, $_tableData[$_table], $_SERVER['SCRIPT_NAME'] . $query_string);	
}

$tagArray['pageName'] = $_tableData[$_table];

/****************************************************/
$fieldInfo = $DB->Query("SHOW FULL COLUMNS FROM " . $reg[3]);
while ($row = mysqli_fetch_assoc($fieldInfo))
{
	$_fieldData[$row['Field']] = $row['Comment'];
}
/****************************************************/

?>