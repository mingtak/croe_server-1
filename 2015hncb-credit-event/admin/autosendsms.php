<?php
include_once ("check.php");
$loginAccess = explode(",", $_COOKIE['loginAccess']);
include_once ("endechn.php");

?>

<?
$t = 'HNCr_SeqDB';
$DB->Connect();
$sql="SELECT * FROM " . $t ." WHERE " . $t . "_Prize ='A' AND  NOT " . $t . "_SMSStat = '1' AND  DATEDIFF( NOW( ) , " .$t."_Date ) <=5 AND NOT  ".$t."_winnerPhone =  '' AND NOT  ".$t."_PrizeSeqID =  ''  ;";
//echo $sql;
$dbQuery = $DB->Query($sql);
if (!$DB->Num($dbQuery))
{
 	echo "\r\n<br>No Record need to send!";
}
else
{
  $recNo=0;
  $recSent=0;
	while($f = $DB->Arrays($dbQuery))
	{
		
	  echo '\r\n<br>winnerName:'. $f[ $t.'_winnerName'] . '>winnerPhone:'. $f[ $t.'_winnerPhone'] . '>SeqID:'. $f[ $t.'_SeqID'] ;
	  $recNo++;
      	$SendGet = new SocketHttpRequest();  // 建立物件
		$SendGet->HttpRequest('http://60.250.14.67/SmSendGet.asp?username=24470810&password=core24470810&dstaddr='.$f[$t.'_winnerPhone'].'&DestName='.$f[$t.'_winnerName'].'&dlvtime=&vldtime=&smbody=恭喜您獲得華南金融集團「2016財運指數翻翻樂」全家50元抵用券，兌換序號：'. $f[ $t.'_PrizeSeqID'] .'，兌換期限：2016-04-30&encoding=UTF8'); 
        $retval1= $SendGet->sendRequest();  //取回Curl error
        $retval2 = $SendGet->getResponseBody2(); //取回完整回傳值
		$retval= $SendGet->getResponseBody(); //取回傳值
		$SendGet2 = new SocketHttpRequest();
	//	echo 'ret1=' . $SendGet->getResponseBody(); //取回傳值
		$SendGet2->HttpRequest('http://60.250.14.67/SmSendGet.asp?username=24470810&password=core24470810&dstaddr='.$f[$t.'_winnerPhone'].'&DestName='.$f[$t.'_winnerName'].'&dlvtime=&vldtime=&smbody=（承上封）請至全家FamiPort機台點選首頁(紅利)→紅利PIN碼→謝謝你好朋友→輸入序號→列印兌換券，詳情請見華得來活動網站公告&encoding=UTF8'); 
		$retval3= $SendGet2->sendRequest();  //取回Curl error
        $retval4= $SendGet2->getResponseBody2();  //取回完整回傳值
                
		$SMSLog='SendAgain ret1=' . $retval1 . '\r\nret2=' . $retval2 . '\r\nret3=' .$retval3 . '\r\nret4=' .$retval4  ;
	
		$DB->Query("Update HNCr_SeqDB SET HNCr_SeqDB_SMSStat = '".$retval . "',HNCr_SeqDB_SMSLog = '".$SMSLog ."' where HNCr_SeqDB_SeqID='".  $f[ $t.'_SeqID']."';") ;
	}
      
}

?>
