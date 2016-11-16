<?php
/******************************************************************/
// Initialize
/******************************************************************/
include ("../check.php");

$_table = TABLE_PREFIX.'lottery';

if($_GET['no'])
{
	$q = $DB->Query("SELECT * FROM {$_table} WHERE {$_table}No = '". $_GET['no'] ."';");
	$a = $DB->Arrays($q);

	header("Content-type: " . $a[$_table.'PicType']);
	echo $a[$_table.'PicBlob'];
	exit;
}
?>
