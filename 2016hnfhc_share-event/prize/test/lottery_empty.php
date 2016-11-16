<?php
include('./__include.php');

$_table = '20160921_winner';

$r = $DB->Query("SELECT * FROM ". $_table ." ;");
$c = $DB->Num($r);
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

<body>
<center><?php echo $prize[$type]?>，共 <?php echo $winner[$type]?> 名</center>
<br><br>
<center>尚未抽中得獎者</center>
<?php

/*

if (!$c)
{
	echo '<center>尚未抽中得獎者</center>';
}
else
{
	$kk = 0;
	while($a = $DB->Arrays($r))
	{
		echo '<span class="style3">' . sprintf('%03d', ++$kk) . '　　'. $a[$_table.'Name'] . '　　' . $a[$_table.'Phone'] . '　　' . $a[$_table.'Email'] . '</span><br>';
	}
}

*/
?>

</body>
</html>
