<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

date_default_timezone_set('Asia/Taipei');
$datetime = date ("Y/m/d H:i:s" , mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'))) ; 
$aryJason=array("Time"=>$datetime);
echo json_encode($aryJason);
		
?>                                    