<?php 
include ('./config/config.php');

include ('./modules/Lib.php');
include ('./modules/DBmySQL.php');
include ('./modules/String.php');
define('TEMPDIR','./admin/');
require(TEMPDIR."endechn.php");


//	echo '1';
	session_start();
//		echo '<br>frec1 ' . $_SESSION['FreeRec'];	
//		echo '<br>urec1 ' . $_SESSION['UsedRec'];	
		if ($_SESSION['curPage']=='p05.php'){
			echo "<script>alert('forbidden action!') ; </script> ";
			exit;
		}
	$noFreeRec=floor(strlen($_SESSION['FreeRec'])/10);
	$noUsedRec=floor(strlen($_SESSION['UsedRec'])/10);
//	echo 'noFreeRec='. $noFreeRec;	 
	
	$url='http://hnfhc.ielife.net/r_prize.asp?par=';
	$DB->Connect();
	$DB->Select(DATABASE);
			$_SESSION['curPage']='p04.php';
if (isset($_POST['Name'])){
//echo '3';
	if ($_POST['Prize']=='A'){
		$SendGet = new SocketHttpRequest();  // 建立物件
		
		
		$SendGet->HttpRequest('http://60.250.14.67/SmSendGet.asp?username=24470810&password=core24470810&dstaddr='.$_POST['TelPhone'].'&DestName='.$_POST['Name'].'&dlvtime=&vldtime=&smbody=恭喜您獲得華南金融集團「2016財運指數翻翻樂」全家50元抵用券，兌換序號：'.$_POST['PrizeSeqID'].'，兌換期限：2016-04-30&encoding=UTF8'); 
		// $SendGet->sendRequest(); //發送
                $retval1= $SendGet->sendRequest();  //取回Curl error
                $retval2 = $SendGet->getResponseBody2(); //取回完整回傳值
				$retval= $SendGet->getResponseBody(); //取回傳值
		$SendGet2 = new SocketHttpRequest();
	//	echo 'ret1=' . $SendGet->getResponseBody(); //取回傳值
		$SendGet2->HttpRequest('http://60.250.14.67/SmSendGet.asp?username=24470810&password=core24470810&dstaddr='.$_POST['TelPhone'].'&DestName='.$_POST['Name'].'&dlvtime=&vldtime=&smbody=（承上封）請至全家FamiPort機台點選首頁(紅利)→紅利PIN碼→謝謝你好朋友→輸入序號→列印兌換券，詳情請見華得來活動網站公告&encoding=UTF8'); 
		  //$SendGet->sendRequest(); //發送
                $retval3= $SendGet2->sendRequest();  //取回Curl error
                $retval4= $SendGet2->getResponseBody2();  //取回完整回傳值
                
			$SMSLog='ret1=' . $retval1 . '\r\nret2=' . $retval2 . '\r\nret3=' .$retval3 . '\r\nret4=' .$retval4  ;
	}
	
//	$DB->Query("Update HNCr_SeqDB SET HNCr_SeqDB_winnerName  ='". $_POST['Name']."',HNCr_SeqDB_winnerEMail = '".$_POST['EMail']."',HNCr_SeqDB_winnerSecID  ='". trans_encrypt( $_POST['SecID'] ) . "',HNCr_SeqDB_winnerPhone = '".$_POST['TelPhone']."' where HNCr_SeqDB_SeqID='".  $_POST['SeqID'] ."';") ;
	$DB->Query("Update HNCr_SeqDB SET HNCr_SeqDB_winnerName  ='". $_POST['Name']."',HNCr_SeqDB_winnerEMail = '".$_POST['EMail']."',HNCr_SeqDB_winnerSecID  ='". trans_encrypt( $_POST['SecID'] ) . "',HNCr_SeqDB_winnerPhone = '".$_POST['TelPhone']. "',HNCr_SeqDB_SMSStat = '".$retval . "',HNCr_SeqDB_SMSLog = '".$SMSLog ."' where HNCr_SeqDB_SeqID='".  $_POST['SeqID'] ."';") ;
	//echo "Update HNCr_SeqDB SET HNCr_SeqDB_winnerName  ='". $_POST['Name']."',HNCr_SeqDB_winnerEMail = '".$_POST['EMail']."',HNCr_SeqDB_winnerSecID  ='". $_POST['SecID']."',HNCr_SeqDB_winnerPhone = '".$_POST['TelPhone']."' where HNCr_SeqDB_SeqID='".$_POST['SeqID']."';";
    //echo 'noFreeRec=' . $noFreeRec ; 
	if ($noFreeRec>0){
		Transfer('p05.php');
		exit;	
	}

} 
//echo '2';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>華得來財運指數翻翻樂</title>
<link href="web.css" rel="stylesheet" type="text/css" />
<meta name="viewport" content="width=device-width, initial-scale=1">

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

function ConfirmURL(url){
	if (window.confirm('您確定要離開嗎？') == true) {
		
		var len = history.length;
    
		// 先回到 IE 啟動時的第一頁
		history.go(-len);
		// 再將網址轉向到目的頁面 ( 注意: 一定要用 location.replace 函式 )
		location.replace(url);
	
		//open('about:blank', '_self').close();
		//location.href=url;
        return true;
    } else {
        return false;
    }
}
//-->
</script>

</head>

<body onload="MM_preloadImages('images/btn-start-b.png','images/btn-01b.png','images/btn-02b.png','images/btn-03b.png','images/btn-04b.png')">
<?php include_once("analyticstracking.php") ?>

<?
//	echo 'rec ' . $_SESSION['UsedRec'];	
	if (isset($_POST['Name'])){
		if ($noFreeRec<=0){
			echo '<div  id="msg">輸入個人資料完畢,請關閉本視窗!</div>';
			exit;	
		}
	}
	if (!isset($_SESSION['FreeRec']) ||$_SESSION['FreeRec'] ==""){
		echo '<div  id="msg">無可用序號!</div>';
		exit;
	}
	//echo '4';
	$freerec="";
	$freerec=substr($_SESSION['FreeRec'],0,10);
	//echo '<br>frec2 ' . $_SESSION['FreeRec'];	
	//echo '<br>urec2 ' . $_SESSION['UsedRec'];	
	if ($noFreeRec >0 ) {
		$_SESSION['FreeRec']=substr($_SESSION['FreeRec'],10);
	}else{
		$_SESSION['FreeRec']="";
	}
	$_SESSION['UsedRec']=$_SESSION['UsedRec'].$freerec;
	
	//echo '<br>frec3 ' . $_SESSION['FreeRec'];	
	//echo '<br>urec3 ' . $_SESSION['UsedRec'];	
		
	

	//echo ' freerec=' . $freerec;
	
	if ($noFreeRec==0){
		echo '<div  id="msg">無可用序號</div>';
		exit;
	}
	$sql="SELECT * FROM HNCr_SeqDB  where  HNCr_SeqDB_SeqID  ='". $freerec ."' and HNCr_SeqDB_Prize ='';";
	//echo  $sql;

	$num = $DB->Num($DB->Query($sql));
	if ($num<=0 ){
		echo '<br>不是有用的序號';
		exit;
	}
$r = $DB->Query($sql);

if ($a = $DB->Arrays($r)){
    $ID=$a['HNCr_SeqDB_ID'];
	$_prize = array(
	'A' => 3000,
	'B' => 2,
	'C' => 50
	);

	$_title = array(
	'A' => '全家電子現金劵',
	'B' => 'iPhone 6SPlus',
	'C' => '江蕙悠遊卡'
	);
	$bHit=false;
	$Prize="Z";//內定未中獎	
	$PrizeSeqID="";	
    $Date=  date("Y-m-d");
    //echo '5';
	if ($freerec!=""){
        $bLock=0;
	    $val=GetParameter("PrizeLocking",$DB);
        if ($val !=null){
            if ($val=='1')
                $bLock=1;
            else
                $DB->Query("Update HNCr_app_parameter SET varValue =  '1' where varName='PrizeLocking';") ;
        }
        $valRate=GetParameter("rate",$DB);
        $val= mt_rand ( 1 , 100000 );
        //echo '<br>randomvalue='. $val ."<br>bLock" .$bLock; 
        if (0== $bLock  )
        {
            //echo "<br>varggRate=".$valRate;
			
            //if (true)
			if ($val<=$valRate)
			{
              //echo "<br>bingo!!!!";
              $bHit=true;
              $valPrize=GetParameter("PrizeA",$DB);
              $strPrize="";
              if ($valPrize!=null) {
                $_prize['A']= $valPrize;
              }
              if ($_prize['A']>0)
              {
                $Prize="A";
				//echo "<br>bingoA!!!!";
				$_prize[$Prize]=$_prize[$Prize]-1;
                $DB->Query("Update HNCr_app_parameter SET varValue =  varValue -1 where varName='Prize" . $Prize. "';") ;
				$sql="SELECT * FROM HNCr_PrizeSeq  where  HNCr_PrizeSeq_PrizeStatCheck  =0 ;";
				$num = $DB->Num($DB->Query($sql));
				if ($num<=0 ){
					$Prize="Z";//改成未中獎	
					$PrizeSeqID="";
					$bHit=false;
				}else{
					$r = $DB->Query($sql);
					if ($a = $DB->Arrays($r)){
						$PrizeSeqID=$a['HNCr_PrizeSeq_PrizeSeqID'];
						$DB->Query("Update HNCr_PrizeSeq SET HNCr_PrizeSeq_PrizeStatCheck  =1 where HNCr_PrizeSeq_ID=".$a['HNCr_PrizeSeq_ID'].";") ;
					}
		        }
                //$DB->Query("Update HNCr_app_parameter SET varValue =  '0' where varName='PrizeLocking';") ;
              }else{
				  	$Prize="Z";//改成未中獎	
					$PrizeSeqID="";
					$bHit=false;
			  }
			
            }
			$DB->Query("Update HNCr_app_parameter SET varValue =  '0' where varName='PrizeLocking';") ;  
		}
		
	}
	$Date = date('Ymd',strtotime($Date));
	//echo '<br>'.$url . trans_encrypt($usedrec);
	if ($PrizeSeqID=='')
		$PrizeSeqID='0000000000';
	$usedrec=$freerec . $Date . $Prize . $PrizeSeqID;
	
	if (false == $bHit){
		$DB->Query("Update HNCr_SeqDB SET HNCr_SeqDB_Prize  ='". $Prize."',HNCr_SeqDB_Date = '".$Date."',HNCr_SeqDB_HNLog = '".$usedrec."' where HNCr_SeqDB_ID=".$ID.";") ;
	}else{
		$DB->Query("Update HNCr_SeqDB SET HNCr_SeqDB_Prize  ='". $Prize."',HNCr_SeqDB_Date = '".$Date."',HNCr_SeqDB_HNLog = '".$usedrec."',HNCr_SeqDB_PrizeSeqID = '".$PrizeSeqID."' where HNCr_SeqDB_ID=".$ID.";") ;
		
	}
	
	httpGet($url . trans_encrypt($usedrec) );
	$noFreeRec=$noFreeRec-1;
	$noUsedRec=$noUsedRec+1;

}
$RefName="";
$RefSecID="";
$RefPhone="";
$RefEMail="";
//echo 'rec ' . $_SESSION['UsedRec'];
if (strlen($_SESSION['UsedRec'])>=10) {
	$sql="SELECT * FROM HNCr_SeqDB  where  HNCr_SeqDB_SeqID  ='". substr($_SESSION['UsedRec'],0,10) ."';";
	//echo 'sql ' . $sql;
	$num = $DB->Num($DB->Query($sql));
	if ($num>0 ){
		$r = $DB->Query($sql);

		if ($a = $DB->Arrays($r)){
			$RefName=$a['HNCr_SeqDB_winnerName'];
			$RefSecID=trans_decrypt($a['HNCr_SeqDB_winnerSecID']) ;
			$RefPhone=$a['HNCr_SeqDB_winnerPhone'];
			$RefEMail=$a['HNCr_SeqDB_winnerEMail'];
		}
	}
}
	
function GetParameter($ParamName,$DB)
{
     $r=$DB->Query("Select * from HNCr_app_parameter  where varName='" .$ParamName. "';") ;
     if ($a = $DB->Arrays($r))
        return  $a['varValue'];
      return null;
                
}
$pars = "?par=" . $_SESSION["par"];
?>


<div id="all" align="center">
<div id="wrapper">
<!--menu-->
<div id="m_top_menu">手機板選單</div>
<div id="top_menu">
<ul>
<? if ($noFreeRec>0){?>
<li><a href="#" onclick="javascript:ConfirmURL('prize.php<?echo $pars;?>');" class="white-blink">回首頁</a></li>
<li><a href="#" onclick="javascript:ConfirmURL('p-game.php');" class="white-blink">開始遊戲</a></li>
<?  }?>
<li><a href="p01.php" target="_blank" class="white-blink">活動辦法</a></li>
<li><a href="p02.php" target="_blank" class="white-blink">活動獎品</a></li>
<li><a href="p03.php" target="_blank" class="white-blink">中獎名單</a></li>
<li style="border-bottom:0px;"><a href="https://hnfhc.ielife.net/signin1.asp" target="_blank" class="white-blink">加入會員</a></li>
</ul>
</div>
<!--menu end-->
<!--tai-->
<div id="in-btn"><a href="#" onclick="javascript:ConfirmURL('prize.php<?echo $pars;?>');"><img src="images/small-pic.png" border="0" /></a></div>
<div id="in-btn-menu">
<ul>
<!--<li><a href="p01.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image4','','images/btn-01b.png',1)"><img src="images/btn-01.png" name="Image4" border="0" id="Image4" /></a></li>-->
<li><a href="p02.php" target="_blank" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image5','','images/btn-02b.png',1)"><img src="images/btn-02.png" name="Image5" border="0" id="Image5" /></a></li>
<li><a href="p03.php" target="_blank" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image6','','images/btn-03b.png',1)"><img src="images/btn-03.png" name="Image6" border="0" id="Image6" /></a></li>
<li><a href="https://hnfhc.ielife.net/signin1.asp" target="_blank" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image10','','images/btn-04b.png',1)"><img src="images/btn-04.png" name="Image10" border="0" id="Image10" /></a></li>
<? if ($noFreeRec>0){?>
<li><a href="#" onclick="javascript:ConfirmURL('p-game.php');" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image8','','images/btn-start-b.png',1)"><img src="images/btn-start.png" name="Image8" border="0" id="Image8" /></a></li>
<?  }?>
</ul>
</div>
<!--tai end-->
<!--main-->
<div id="words">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
	<?
		if ($bHit){
			echo '<p style="color:#F00; font-weight:bold;">您手氣真好！恭喜您抽中50元全家電子禮券，我們會在統整得獎名單後統一以簡訊發送到您的手機，還請您協助填寫以下資訊以方便我們寄送，而且可以參加鴻運參加獎抽獎喔，如果填寫資料點選送出前就離開此頁，將無法領獎與參加鴻運參加獎，謝謝。</p>';	
		}else{
			echo '<p style="color:#F00; font-weight:bold;">喔喔~殘念，這次沒有中立即獎下次還有機會喔，請您留下您的連絡資料，我們還有鴻運參加獎等您來挑戰，如果沒有填寫就離開此頁，將無法參加鴻運參加獎抽獎活動喔！</p>';	
		}
	?>
	
	
      <p>&nbsp;</p>
      <p style="color:#F00; font-weight:bold;">鴻運參加獎獎項：<strong>江蕙紀念祝福悠遊卡、iPhone 6s Plus</strong></p>
      <p>&nbsp;</p>
      <p>您還有 <span style="color:#F00"><? echo $noFreeRec?></span> 次抽獎機會，再接再厲好運跟著您！ </p></td>
  </tr>
</table>
<form method="POST" action="p04.php" name="f" id="f" onsubmit="return validateForm();"  >
		<input type="hidden" name="SeqID" value="<?php echo  $freerec?>">
		<input type="hidden" name="PrizeSeqID" value="<?php echo  $PrizeSeqID?>">
		<input type="hidden" name="Prize" value="<?php echo  $Prize?>">
		
<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" align="center" valign="top"><h3 style="color:#F00;">資料填寫</h3></td>
    </tr>
  <tr>
    <td width="8" valign="top"><img src="images/icon-01.gif" /></td>
    <td width="90">姓　　名：</td>
    <td><label>
      <input style="width:98%" type="text" name="Name" id="Name" value="<? echo $RefName?>"/>
    </label></td>
  </tr>
  <tr>
    <td valign="top"><img src="images/icon-01.gif" /></td>
    <td width="80">身分證字號：</td>
    <td><label>
      <input style="width:98%" type="text" name="SecID" id="SecID" value="<? echo $RefSecID?>" />
    </label></td>
  </tr>
  <tr>
    <td valign="top"><img src="images/icon-01.gif" /></td>
    <td>手機號碼：</td>
    <td><input name="TelPhone" type="text" id="TelPhone" style="width:98%" value="<? echo $RefPhone?>" /></td>
  </tr>
  <tr>
    <td valign="top"><img src="images/icon-01.gif" /></td>
    <td>電子信箱：</td>
    <td><input name="EMail" type="text" id="EMail" style="width:98%"  value="<? echo $RefEMail?>"/></td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td>&nbsp;</td>
    <td>
    <label>
      <input type="submit" name="button" id="button" value="確定送出" />
    </label>
    <label>
      <input type="submit" name="button2" id="button2" value="取消重填" />
    </label></td>
  </tr>
</table>
</form>
<script type="text/JavaScript">

function validateEMail(email) {
   var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
function ValidateNum(num){
 var re = /^[0-9]+$/;
  return re.test(num);
}
function checkID( id ) {
  tab = "ABCDEFGHJKLMNPQRSTUVXYWZIO"                     
  A1 = new Array (1,1,1,1,1,1,1,1,1,1,2,2,2,2,2,2,2,2,2,2,3,3,3,3,3,3 );
  A2 = new Array (0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5,6,7,8,9,0,1,2,3,4,5 );
  Mx = new Array (9,8,7,6,5,4,3,2,1,1);

  if ( id.length != 10 ) return false;
  i = tab.indexOf( id.charAt(0) );
  if ( i == -1 ) return false;
  sum = A1[i] + A2[i]*9;

  for ( i=1; i<10; i++ ) {
    v = parseInt( id.charAt(i) );
    if ( isNaN(v) ) return false;
    sum = sum + v * Mx[i];
  }
  if ( sum % 10 != 0 ) return false;
  return true;
}

function validateForm()
{
	
    // Validate URL
	
    
    // Validate 
	if (null==document.getElementById('Name').value ||""==document.getElementById('Name').value ) {
		alert("請輸入姓名");
		return false;
    }
    if (document.getElementById('SecID').value==null||document.getElementById('SecID').value=="" ) {
		alert("請輸入身份證字號");
		return false;
    }
	if (checkID(document.getElementById('SecID').value)==false){
		alert("請輸入正確的 身份證字號");
		return false;
	}
	if (document.getElementById('TelPhone').value==null||document.getElementById('TelPhone').value=="" ) {
		alert("請輸入電話");
		return false;
    }
	
	if (ValidateNum(document.getElementById('TelPhone').value)==false || document.getElementById('TelPhone').value.length !=10 ){
		alert("請輸入正確的電話");
		return false;
	}
	if (document.getElementById('EMail').value==null||document.getElementById('EMail').value=="" ) {
		alert("請輸入 EMail");
		return false;
    }
    if (validateEMail(document.getElementById('EMail').value)==false){
		alert("請輸入正確的 EMail");
		return false;
	}
	
  return true;
}
</script>
</div>
<!--main end-->
</div>
<!--footer-->
<div id="footer-1"><img src="images/logo.jpg" /></div>
<div id="footer-2">
  <p>© 2015華南銀行</p>
</div>
<!--footer end-->
</div>
<!--控制手機版選單-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="js/mmenu.js"></script>
</body>
</html>
