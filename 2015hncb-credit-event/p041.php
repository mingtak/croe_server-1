<?php 
include ('./config/config.php');

include ('./modules/Lib.php');
include ('./modules/DBmySQL.php');
include ('./modules/String.php');
define('TEMPDIR','./admin/');
require(TEMPDIR."endechn.php");


	session_start();
	$url='http://hnfhc.ielife.net/r_prize.asp?par=';
	$DB->Connect();
	$DB->Select(DATABASE);
	
if (isset($_POST['Name'])){
	
	//httpGet($url . trans_encrypt($usedrec) );
		$SeqID =$_POST['SeqID'];
				$sql="SELECT * FROM HNCr_SeqDB WHERE HNCr_SeqDB_SeqID='" . $_POST['SeqID'] .  "'";
			//echo 'sql=' .$sql.'<br>';
			$DB->Query($sql) ;
			$num = $DB->Num($DB->Query($sql));
			if ($num>0 ){
				$r = $DB->Query($sql);
				if ($a = $DB->Arrays($r)){
					$Date=$a["HNCr_SeqDB_Date"];
					$Date = date('Ymd',strtotime($Date));
					$Prize=$a["HNCr_SeqDB_Prize"];
					$PrizeSeqId=$a["HNCr_SeqDB_PrizeSeqID"];
					
					if ($Prize=="" ||$Prize==" ")
					{
						$freerec=$freerec.$SeqID;	
						$Prize="Y";
					}else{
						$usedrec=$usedrec.$SeqID;
						if ($PrizeSeqId=="")
							$PrizeSeqId="0000000000";
						$usedrecx=$SeqID . $Date . $Prize . $PrizeSeqId;
						//echo $url. $usedrecx.'<br>';	
						if( httpGet($url . trans_encrypt($usedrecx) )!="0000")
							httpGet($url . trans_encrypt($usedrecx) );
					}
				}	
			}
		
		
	
	$DB->Query("Update HNCr_SeqDB SET HNCr_SeqDB_winnerName  ='". $_POST['Name']."',HNCr_SeqDB_winnerEMail = '".$_POST['EMail']."',HNCr_SeqDB_winnerSecID  ='". trans_encrypt( $_POST['SecID'] ) . "',HNCr_SeqDB_winnerPhone = '".$_POST['TelPhone']."' where HNCr_SeqDB_SeqID='".  $_POST['SeqID'] ."';") ;
	//echo "Update HNCr_SeqDB SET HNCr_SeqDB_winnerName  ='". $_POST['Name']."',HNCr_SeqDB_winnerEMail = '".$_POST['EMail']."',HNCr_SeqDB_winnerSecID  ='". $_POST['SecID']."',HNCr_SeqDB_winnerPhone = '".$_POST['TelPhone']."' where HNCr_SeqDB_SeqID='".$_POST['SeqID']."';";
    //echo 'noFreeRec=' . $noFreeRec ; 
	Transfer('p-game.php');
	
} 
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
//-->
</script>

</head>

<body onload="MM_preloadImages('images/btn-start-b.png','images/btn-01b.png','images/btn-02b.png','images/btn-03b.png','images/btn-04b.png')">

<?
//	
		
	$freerec=$_SESSION['DataRec'] ;
	if ($freerec==""){
			echo '<div  id="msg">無資料需補登</div>';
			exit;	
	}
	
$RefName="";
$RefSecID="";
$RefPhone="";
$RefEMail="";
//echo 'usedrec ' . $_SESSION['UsedRec'];
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
?>


<div id="all" align="center">
<div id="wrapper">
<!--menu-->
<div id="m_top_menu">手機板選單</div>
<div id="top_menu">
<ul>
<li><a href="prize.php?par=<?echo $_SESSION['par']?>" class="white-blink">回首頁</a></li>
<li><a href="p-game.php" class="white-blink">開始遊戲</a></li>
<li><a href="p01.php" class="white-blink">活動辦法</a></li>
<li><a href="p02.php" class="white-blink">活動獎品</a></li>
<li><a href="p03.php" class="white-blink">中獎名單</a></li>
<li style="border-bottom:0px;"><a href="https://hnfhc.ielife.net/signin1.asp" target="_blank" class="white-blink">加入會員</a></li>
</ul>
</div>
<!--menu end-->
<!--tai-->
<div id="in-btn"><a href="prize.php"><img src="images/small-pic.png" border="0" /></a></div>
<div id="in-btn-menu">
<ul>
<!--<li><a href="p01.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image4','','images/btn-01b.png',1)"><img src="images/btn-01.png" name="Image4" border="0" id="Image4" /></a></li>-->
<li><a href="p02.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image5','','images/btn-02b.png',1)"><img src="images/btn-02.png" name="Image5" border="0" id="Image5" /></a></li>
<li><a href="p03.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image6','','images/btn-03b.png',1)"><img src="images/btn-03.png" name="Image6" border="0" id="Image6" /></a></li>
<li><a href="https://hnfhc.ielife.net/signin1.asp" target="_blank" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image10','','images/btn-04b.png',1)"><img src="images/btn-04.png" name="Image10" border="0" id="Image10" /></a></li>
<li><a href="p-game.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image8','','images/btn-start-b.png',1)"><img src="images/btn-start.png" name="Image8" border="0" id="Image8" /></a></li>
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
	
      <p>&nbsp;</p>
      <p>鴻運參加獎獎項：<strong>江蕙絕版祝福悠遊卡、iPhone 6s Plus</strong></p>
      <p>&nbsp;</p>
      </td>
  </tr>
</table>
<form method="POST" action="p041.php" name="f" id="f" onsubmit="return validateForm();"  >
		<input type="hidden" name="SeqID" value="<?php echo  $freerec?>">
		
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
    <td>連絡電話：</td>
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
  <p>建議瀏覽器版本為IE9以後版本，並將語系設為中文Big5，以獲得最佳瀏覽效果。</p>
</div>
<!--footer end-->
</div>
<!--控制手機版選單-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="js/mmenu.js"></script>
</body>
</html>
