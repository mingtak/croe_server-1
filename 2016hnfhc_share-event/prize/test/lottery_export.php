<?php
include('./__include.php');

$_table = '20160921_winner';
$_type = ($_GET['type']) ? $_GET['type'] : 0;

$dbQuery = $DB->Query("SELECT * FROM ". $_table ." ORDER BY 20160921_winnerPK;");
mb_internal_encoding('UTF-8');

$_filename = 'temp_'. date('U') .'.csv';
$fp = fopen('./upload/' . $_filename, 'w');
if ($_type==0)
{
  fwrite($fp, '訂單編號');
  //fwrite($fp, mb_convert_encoding('"訂單編號"', 'big5', 'UTF-8'));
}else
{
  fwrite($fp, '訂單編號,="姓名",="身分證字號"');
  //fwrite($fp, mb_convert_encoding('"訂單編號","姓名","身分證字號"', 'big5', 'UTF-8'));
}
  

while ($dbArray = $DB->Arrays($dbQuery))
{
	$fw2 = "\n";
  if ($_type==0)
  {
    $fw2 .= '="' . $dbArray['20160921_winnerPNo'].'"';
  }else
  {
    $fw2 .= '="' . $dbArray['20160921_winnerPNo'].'",';
  	$fw2 .= '="' . $dbArray['20160921_winnerName'] .'",';
  	$fw2 .= '="' . $dbArray['20160921_winnerID'] .'"';
    
   //   $fw2 .= '="' . mb_convert_encoding($dbArray['20160921_winnerPNo'], 'big5', 'UTF-8').'",';
  	//$fw2 .= '="' . mb_convert_encoding($dbArray['20160921_winnerName'], 'big5', 'UTF-8') .'",';
  	//$fw2 .= '="' . mb_convert_encoding($dbArray['20160921_winnerID'], 'big5', 'UTF-8') .'"';
    
  }
	fwrite($fp, $fw2);
}

fclose($fp);

header("Content-type:application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition:filename=".$_filename);
readfile('./upload/' . $_filename);
?>