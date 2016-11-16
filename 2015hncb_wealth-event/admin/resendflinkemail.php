<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">-->
<title>羊羊得意送紅包</title>
<link href="css/main2.css" rel="stylesheet" type="text/css" />
<script language="javascript">
(function(){
// 重新載入圖形的函數，適用於任何圖形
var reloadImg = function(dImg) {
// 取得圖形原本的來源 url
var sOldUrl = dImg.src;
// 在原本的 url 後面加上亂數的參數，變成新的 url
var sNewUrl = sOldUrl + "?rnd=" + Math.random();
//將圖形的來源改為新的 url，就會重新載入圖形了
dImg.src = sNewUrl;
};
// 取得重新載入的超連結元素
var dReloadLink = document.getElementById("reload-img");
// 取得驗證碼圖形元素
var dImg = document.getElementById("rand-img");
// 定義這個超連結的 onclick 事件
dReloadLink.onclick = function(e) {
// 呼叫函數重新載入驗證碼圖形
reloadImg(dImg);
//停止事件預設的動作，也就是不要跳到超連結的網址
 if(e) e.preventDefault();
 return false;

};

})();

</script>
</head>

<body>

<?php
//include_once ("check.php");
//include_once (PAGES . "back_top.php");
include ('./config/config.php');

include ('./modules/Lib.php');
include ('./modules/DBmySQL.php');
include ('./modules/String.php');

include('./plugin/phpMailer/class.phpmailer.php');


$t = '2014hncb_app_lottery';
$t2 = '2014hncb_app_feeoffer';
$ExecCode=$_GET['ExecCode'];
if (!isset($ExecCode))
  ErrorMsg("抱歉！指令錯誤！");
$cmd=date("md") . "core";

if ($ExecCode != $cmd )
    ErrorMsg("抱歉！密碼錯誤！");

$DebugMode=1;
if (isset($_GET['Debug']))
   $DebugMode=  $_GET['Debug']; 

//$subject = mb_convert_encoding('友情抽抽獎活動', 'big5', 'UTF-8');
$subject =  '';
#$headers  = 'MIME-Version: 1.0' . "\r\n";
#$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
#$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
#$headers .= 'From: '. $subject. ' <claire@core-integrated.com.tw>' . "\r\n";
#$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
#$headers .= 'Bcc: allan.sung@gmail.com' . "\r\n";

//$headers   = array();
//$headers[] = "MIME-Version: 1.0";
//$headers[] = "Content-type: text/html; charset=UTF-8";
//$headers[] = "From: {$sendername} <{$sender}>";
//$headers[] = "Reply-To: {$sendername} <{$sender}>";
//$headers[] = "Subject: {$subject}";
//$headers[] = "X-Mailer: PHP/".phpversion();

//$h = implode("\r\n", $headers);
$body = '<!doctype html>';
$body .= '<html>';
$body .= '<head>';
$body .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
$body .= '<link href="http://www.core-marketing.com.tw/2014hncb/sh_css.css" rel="stylesheet" type="text/css" />';
$body .= '</head>';
$body .= '<img src="http://www.core-marketing.com.tw/2014hncb/image/a.jpg">';
$body .= '<div id="C">';
$bodyh =$body;         
//echo $bodyh; 
$DB->Select(DATABASE);
$dbQuery = $DB->Query("SELECT * FROM ". $t ." WHERE `2014hncb_app_lotteryCheck` =1 AND `2014hncb_app_lotterySent` =1 AND  `2014hncb_app_lotteryFriendPhone` IS NOT NULL AND NOT  `2014hncb_app_lotteryFriendPhone` =  '' AND   `2014hncb_app_lotteryFriendPhone` !=  `2014hncb_app_lotteryPhone` ;");

///
$sender = 'service@core-marketing.com.tw';
$sendername = '華南網銀羊羊得意活動小組';
$subject = '「您的朋友邀請您參加華南網銀羊羊得意送紅包活動」';

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
#$mail->Host = 'smtp.gmail.com';
$mail->Host = 'mail.coreintegrated.com.tw';
$mail->Port = 465;

#$mail->Username = 'core.marketing.2015';
#$mail->Password = 'OW15z@xl';
$mail->Username = 'service@coreintegrated.com.tw';
$mail->Password = 'M!WOf],ob{~y';

$mail->From = $sender;		// Email address
$mail->FromName = $sendername;

//$mail->AddAddress($_POST['email'.$i]);
	
$mail->CharSet="UTF-8";
$mail->Encoding = "base64";
$mail->IsHTML(true);
$mail->WordWrap = 50;

$mail->Subject='恭喜您獲得1次華南羊羊得意送紅包友情抽抽獎機會！';

///

if (!$DB->Num($dbQuery))
{
 	ErrorMsg("抱歉！無資料！");
}
else
{
  $recNo=0;
  $recSent=0;
	while($f = $DB->Arrays($dbQuery))
	{
	  echo '<br><br>lottery:'. $f[ $t.'Nickname'] ;
		$recNo++;
     
	  if ($DB->Num($DB->Query("SELECT {$t2}Email FROM {$t2} WHERE {$t2}Phone = '{$f['2014hncb_app_lotteryFriendPhone']}' and {$t2}Check=0 and {$t2}Active=0 ;")))
		{
		  $res=$DB->Query("SELECT {$t2}Email,{$t2}Nickname,{$t2}Code FROM {$t2} WHERE {$t2}Phone = '{$f['2014hncb_app_lotteryFriendPhone']}' and {$t2}Check=0 and {$t2}Active=0 ;");
		  if ($a = $DB->Arrays($res))
		  {
       $recSent++;     
	     $body=$bodyh;
	     $body .= $a[ $t2.'Nickname'] . '您好：<br/><br/>';
        $body .= '感謝您參與華南網銀羊羊得意送紅包活動，因為您的推薦，您的朋友 '. $f[ $t.'Nickname'] .' <br/>';
        $body .= '已經參加本活動了，也恭喜您得到一次抽獎機會。推薦越多，朋友參加越多，中獎機會越大喔！<br/><br/>';
        $body .= '請您點擊以下網址，即可抽出您得到的獎項喔，祝您幸運中大獎！<br/>';
        $body .= '<a href="http://www.core-marketing.com.tw/2014hncb_app/lottery.php?IDCode='. $a[$t2.'Code'] .'">一次性連結網址</a><br/>';
        $body .= '<br/><br/></div>';
        $body .= '<img src="http://www.core-marketing.com.tw/2014hncb/image/b.jpg">';
        //$subject = "=?UTF-8?B?".base64_encode("恭喜您獲得1次華南羊羊得意送紅包友情抽抽獎機會！" )."?=";
        $mail->Body = $body;
        echo '<br>feeoffer:'. $a[ $t2.'Nickname'];
        echo '<br>   Email:'. $a[ $t2.'Email'];
        $mail->AddAddress($a[ $t2.'Email']);
        if ($DebugMode==2)
            $mail->Send();
        //mail($a[ $t2.'Email'], $subject, $body, $h);
        if ($recSent==1)
        {
         echo 'debug mail sent';
        // $mail->ClearAddresses();
        $mail->Body = $body;
         $mail->AddAddress('claire@core-integrated.com.tw');
         $mail->Send();
         
         $mail->ClearAddresses();
         $mail->AddAddress('yuh@sohonetwork.com.tw');
         $mail->Body = $body;
         $mail->Send();
          //mail('claire@core-integrated.com.tw', $subject, $body, $h);
          //mail('yuh@sohonetwork.com.tw', $subject, $body, $h);
        }
		    usleep(mt_rand ( 10000 , 100000 ));
      }
		  $mail->ClearAddresses();
      		  
    }
 //   if ($DebugMode==2)
 //     $DB->Query("Update 2014hncb_app_lottery SET 2014hncb_app_lotterySent =  1 where 2014hncb_app_lotteryNo='" . $f[ $t.'No'] . "';") ;
      
	}
	echo "<br>總記錄數=" . $recNo;
	echo "<br>總發信數 =" . $recSent;
}

//Transfer('Friend_result.php?pa='.$_POST['pa'].'&pb='.$_POST['pb'].'&pc='.$_POST['pc']);
?>