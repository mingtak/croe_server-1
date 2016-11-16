<?php
include('../config/config.php');

$l = mysql_connect(DBCONSERVER, DBCONID, DBCONPASSWORD);
mysql_select_db(DATABASE);
mysql_query('set character set utf8;');

foreach (file('abc.sql') as $line)
{
	mysql_query($line);
}

mysql_close($l);
echo 'done';
?>