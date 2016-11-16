<?php
include('./__include.php');

$_winner = ($_GET['w']) ? $_GET['w'] : $winner[0];
$_type = ($_GET['t']) ? $_GET['t'] : 0;

$_table = '20160921_winner';
$_lottery = '20160921_user';

if ($DB->Num($DB->Query("SELECT {$_table}No FROM {$_table} ;")))
{
	$DB->Query("DELETE FROM {$_table} ;");
}

//if ($_type==0)
//	$r = $DB->Query("SELECT {$_lottery}.* FROM {$_lottery} LEFT JOIN {$_table} ON {$_lottery}.{$_lottery}No = {$_table}.{$_table}No WHERE {$_table}.{$_table}No IS NULL ORDER BY RAND() LIMIT {$_winner};");
//else
	$r = $DB->Query("SELECT {$_lottery}.* FROM {$_lottery} LEFT JOIN {$_table} ON {$_lottery}.{$_lottery}No = {$_table}.{$_table}No WHERE {$_lottery}.{$_lottery}Status ={$_type} AND {$_table}.{$_table}No IS NULL ORDER BY RAND() LIMIT {$_winner};");
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title?></title>
<style type="text/css">
<!--
.style2 {font-size: 36px;
text-align:center;}
.style3 {font-size: 15px;
text-align:center;
color:#FF0000;
font-family:"微軟正黑體";}
-->
</style>

</head>

<body><td width="493" valign="top" bgcolor="#EEF1EA">
<?php
$k = 0;
while($a = $DB->Arrays($r))
{
	mb_internal_encoding('UTF-8');
	if ($_type==0)
	{
		$n = $a[$_lottery.'PNo'];
		$DB->Query("INSERT INTO {$_table} ({$_table}PK, {$_table}No,  {$_table}PNo, {$_table}Status) VALUES (null, '{$a[$_lottery.'No']}', '{$a[$_lottery.'PNo']}', '{$a[$_lottery.'Status']}');");
		echo '<span class="style3">' . $n. '</span><br>';

	}else
	{
		$n = $a[$_lottery.'Name'];
		$n = (mb_strlen($n) >= 3) ? mb_substr($n, 0, 1) . 'Ｏ' . mb_substr($n, 2, 1) : mb_substr($n, 0, 1) . 'Ｏ';
	
	//$p = $a[$_lottery.'ID'];
	$p1 = substr($a[$_lottery.'ID'], 0, 1);
	$p2 = substr($a[$_lottery.'ID'], -5);
	$p = $p1 . '＊＊＊＊' . $p2;
	
	$DB->Query("INSERT INTO {$_table} ({$_table}PK, {$_table}No,  {$_table}Name, {$_table}Email, {$_table}Phone, {$_table}PNo, {$_table}ID, {$_table}Status) VALUES   (null, '{$a[$_lottery.'No']}', '{$a[$_lottery.'Name']}', '{$a[$_lottery.'Email']}', '{$a[$_lottery.'Phone']}' , '{$a[$_lottery.'PNo']}', '{$a[$_lottery.'ID']}' ,  '{$a[$_lottery.'Status']}');");

	#echo '<span class="style3">' . sprintf('%03d', ++$kk) . '　　'. $n. '　　'. $p . '</span><br>';
	echo '<span class="style3">' . $a[$_lottery.'PNo'] . '　　'. $n. '　　'. $p . '　　' . '</span><br>';

	}
}
?>

</td>
</body>
</html>
