﻿<?php
/******************************************************************/
// Initialize
/******************************************************************/
include ("../check.php");

$_table = TABLE_PREFIX.'SeqDB';

$_date = array('2015-01-22', '2015-01-29', '2015-02-05', '2015-02-12', '2015-02-17', '2015-03-02');

$i = 0;
foreach ($_date as $date)
{
	echo '<input type="button" value="第 '. ++$i .' 梯次抽獎 ('. $date .')" onClick="alert(\'跟華南資料同步可能需要一點時間，請耐心等候！\');location.href=\'go2.php?d='.$date.'\';"><br><br>';
}
?>