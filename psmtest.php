<?php 
	//phpinfo();
	//die;
	//echo "Update HNCr_SeqDB SET HNCr_SeqDB_winnerName  ='". $_POST['Name']."',HNCr_SeqDB_winnerEMail = '".$_POST['EMail']."',HNCr_SeqDB_winnerSecID  ='". $_POST['SecID']."',HNCr_SeqDB_winnerPhone = '".$_POST['TelPhone']."' where HNCr_SeqDB_SeqID='".$_POST['SeqID']."';";
	$Send=GethttpGet('http://smexpress.mitake.com.tw:9600/SmSendGet.asp?username=24470810&password=core24470810&dstaddr=0961533394&DestName=陳燦煜&dlvtime=&vldtime=&smbody=陳燦煜恭喜您獲得全家電子現金劵,編號為' .$_POST['Name'] );         // 呼叫成員

	echo $Send; //取回傳值
	
function httpGet($url)
{
	//return "0000";
    $ch = curl_init();  
 
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//  curl_setopt($ch,CURLOPT_HEADER, false); 
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS ,500);
	curl_setopt($ch,CURLOPT_TIMEOUT_MS,500);
	curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
	
    $output=curl_exec($ch);
 
    curl_close($ch);
    return $output;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>華得來財運指數翻翻樂</title>
<link href="web.css" rel="stylesheet" type="text/css" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Expires" CONTENT="0"> 
<meta http-equiv="Cache-Control" CONTENT="no-cache"> 
<meta http-equiv="Pragma" CONTENT="no-cache"> 

<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>

</head>

<body onload="MM_preloadImages('images/btn-start-b.png','images/btn-01b.png','images/btn-02b.png','images/btn-03b.png','images/btn-04b.png')">
test 
</body>
</html>
