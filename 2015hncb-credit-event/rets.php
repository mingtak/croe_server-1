<?php
define('TEMPDIR','./admin/');
require(TEMPDIR."endechn.php");
require(TEMPDIR."coreclass.php");
$url='http://www.abc100.com.tw/zip/rets.php?par=';
$data = $_GET['par'] ;
//76C7kejCkGpgv619m0x55fqVdIk0iR2azjvPoNll4mzEoExRk4f70n7Mx3qooWrvy4nOv1mUkvovsGgm9zxjmgrjq5l3rd5mxuqrfNte
//echo ' Data=>'. $data . '<=' . strlen($data) . '<br>';
//$dataenc=trans_encrypt($data);
//echo 'Encode Data =>' . $dataenc . '<=' . strlen($dataenc) . '<br>';
//echo 'Decode Data =>' . trans_decrypt($data) . '<=' . strlen(trans_decrypt($data)) . '<br>';
session_start();
	
	$aepublic=new CEngine();
	$aepublic->PublicInitialize();
	$aepublic->RequestVariables();
	$prizeList="ABCZ";
	$errorMsg = "";
	
  if (  isset($aepublic->par) && $aepublic->par != "") {  
  
		$data=trans_decrypt($data);
		echo $data . ' len=' . strlen($data). '<br>';
		if (strlen($data)<19){
			exit;
		}
		$SeqID=substr($data,0,10);
		$Date=substr($data,10,8);
		$Prize=substr($data,18,1);
		if (strlen($data)>19){
			$PrizeSeqId=substr($data,19,10);	
		}
		echo 'SeqID='. $SeqID . 'Date=' . $Date . 'Prize=' . $Prize . 'PrizeSeqId='. $PrizeSeqId . '<br>'	;
	exit;
}





function httpGet($url)
{
    $ch = curl_init();  
 
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//  curl_setopt($ch,CURLOPT_HEADER, false); 
 
    $output=curl_exec($ch);
 
    curl_close($ch);
    return $output;
}
 


?>