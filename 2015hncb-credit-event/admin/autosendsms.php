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
      	$SendGet = new SocketHttpRequest();  // �إߪ���
		$SendGet->HttpRequest('http://60.250.14.67/SmSendGet.asp?username=24470810&password=core24470810&dstaddr='.$f[$t.'_winnerPhone'].'&DestName='.$f[$t.'_winnerName'].'&dlvtime=&vldtime=&smbody=���߱z��o�ثn���Ķ��Ρu2016�]�B����½½�֡v���a50����Ψ�A�I���Ǹ��G'. $f[ $t.'_PrizeSeqID'] .'�A�I�������G2016-04-30&encoding=UTF8'); 
        $retval1= $SendGet->sendRequest();  //���^Curl error
        $retval2 = $SendGet->getResponseBody2(); //���^����^�ǭ�
		$retval= $SendGet->getResponseBody(); //���^�ǭ�
		$SendGet2 = new SocketHttpRequest();
	//	echo 'ret1=' . $SendGet->getResponseBody(); //���^�ǭ�
		$SendGet2->HttpRequest('http://60.250.14.67/SmSendGet.asp?username=24470810&password=core24470810&dstaddr='.$f[$t.'_winnerPhone'].'&DestName='.$f[$t.'_winnerName'].'&dlvtime=&vldtime=&smbody=�]�ӤW�ʡ^�Цܥ��aFamiPort���x�I�ﭺ��(���Q)�����QPIN�X�����§A�n�B�͡���J�Ǹ����C�L�I����A�Ա��Ш��رo�Ӭ��ʺ������i&encoding=UTF8'); 
		$retval3= $SendGet2->sendRequest();  //���^Curl error
        $retval4= $SendGet2->getResponseBody2();  //���^����^�ǭ�
                
		$SMSLog='SendAgain ret1=' . $retval1 . '\r\nret2=' . $retval2 . '\r\nret3=' .$retval3 . '\r\nret4=' .$retval4  ;
	
		$DB->Query("Update HNCr_SeqDB SET HNCr_SeqDB_SMSStat = '".$retval . "',HNCr_SeqDB_SMSLog = '".$SMSLog ."' where HNCr_SeqDB_SeqID='".  $f[ $t.'_SeqID']."';") ;
	}
      
}

?>
