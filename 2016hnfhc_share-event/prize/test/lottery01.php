<?php
include('./__include.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title?></title>
<style type="text/css">
<!--
.style2 {font-size: 50px;
text-align:center}
body {
	background-image: url(images/bg.gif);
}
-->
</style>
</head>

<body>
<div align="center"><table width="664" border="0" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr>
    <td width="960" height="150" valign="top"><img src="images/002_01.png" width="960" height="221" style="margin-bottom:20px;" /></td>
  </tr>
	
	<?php
	$i = 0;
	foreach ($prize_winner as $p => $w)
	{
	?>
	<tr>
		<td height="163" align="center" valign="top"><input type="button" value="抽<?php echo $p?>" onClick="location.href='lottery02.php?type=<?php echo $i++?>'" style="font-size:30px; font-weight:bold; width:500px;height:100px; border-radius:15px;"></td>
	</tr>
	<?php
	}
	?>

	<!--<tr>
    <td height="176" valign="top"><a href="Lottery-003-03.php"><img src="images/002_03.png" width="960" height="297" border="0" /></a></td>
  </tr>-->
  
</table>
</div>
</body>
</html>
