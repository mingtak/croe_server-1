<?
$Date = date('Ymd',strtotime(date("Y-m-d")));

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

<body onload="MM_preloadImages('images/btn-01b.png','images/btn-02b.png','images/btn-start-b.png','images/btn-03b.png','images/btn-04b.png')">

<?php
include ('./config/config.php');

include ('./modules/Lib.php');
include ('./modules/DBmySQL.php');
include ('./modules/String.php');
define('TEMPDIR','./admin/');
require(TEMPDIR."endechn.php");

$url='http://wonder.ielife.net/r_prize.asp?par=';
$data = $_GET['par'] ;

session_start();
	$_SESSION['par']=$data;	
	$prizeList="ABCZ";
	$errorMsg = "";
	$DB->Connect();
	$DB->Select(DATABASE);
//echo 'Decode Data =>' . trans_decrypt($data) . '<=' . strlen(trans_decrypt($data)) . '<br>';
  
	if (  isset($data) && $data != "") {  
  
		$data=trans_decrypt($data);
	//	echo $data;
		$recno=floor(strlen($data)/10);
		$usedrec="";
		$freerec="" ;
		$_SESSION['DataRec']="";
		//echo 'recno=' . $recno .'<br>';;
		for ($i=0;$i<$recno;$i++){
			$SeqID=substr($data,$i*10,10);
			//echo 'SeqID=' .$SeqID.'<br>';
			$sql="SELECT * FROM HNCr_SeqDB WHERE HNCr_SeqDB_SeqID='" . $SeqID .  "'";
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
						if ($a["HNCr_SeqDB_winnerName"]==""|| $a["HNCr_SeqDB_winnerPhone"]==""||$a["HNCr_SeqDB_winnerSecID"]=="")
							$_SESSION['DataRec']=$SeqID;
						$usedrec=$usedrec.$SeqID;
						$usedrecx=$SeqID . $Date . $Prize . $PrizeSeqId;
						//echo $url. $usedrecx.'<br>';	
						if( httpGet($url . trans_encrypt($usedrecx) )!="0000")
							httpGet($url . trans_encrypt($usedrecx) );
					}
					
				}	
					
			}else{
				echo '<div  id="msg">錯誤序號</div>';
				exit;
			}
		
		//search rec in data base  if this record used return the status by call ret.asp else 
		}
		//echo 'freerec' . $freerec.'<br>';	
		//echo 'usedrec' . $usedrec.'<br>';	
		$_SESSION['FreeRec']=$freerec;
		$_SESSION['UsedRec']=$usedrec;
		if ($_SESSION['DataRec'] !=""){
			//echo $_SESSION['DataRec'];
			header("location: p041.php");
			//echo '<script type="text/javascript">location.replace("p041.php");</script>'
			exit;
		}
		if ($freerec==""){
			echo '<div  id="msg">無序號已兌換完畢</div>';
			exit;
		}	
			
}else
{
	exit;
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
<!--main-->
<div id="index-pic"><img src="images/big-pic.png" width="818" height="711" /></div>
<div id="index-btn">
<ul>
<li style="margin-top:15px;"><a href="p01.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image3','','images/btn-01b.png',1)"><img src="images/btn-01.png" name="Image3" border="0" id="Image3" /></a></li>
<li style="margin-top:15px;"><a href="p02.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image4','','images/btn-02b.png',1)"><img src="images/btn-02.png" name="Image4" border="0" id="Image4" /></a></li>
<li class="start"><a href="p-game.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image5','','images/btn-start-b.png',1)"><img src="images/btn-start.png" name="Image5" border="0" id="Image5" /></a></li>
<li style="margin-top:15px;"><a href="p03.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image6','','images/btn-03b.png',1)"><img src="images/btn-03.png" name="Image6" border="0" id="Image6" /></a></li>
<li style="margin-top:15px;"><a href="https://hnfhc.ielife.net/signin1.asp" target="_blank" onmouseover="MM_swapImage('Image7','','images/btn-04b.png',1)" onmouseout="MM_swapImgRestore()"><img src="images/btn-04.png" name="Image7" border="0" id="Image7" /></a></li>
</ul> 
</div>
<div id="index-btn-2"><a href="p-game.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image8','','images/btn-start-b.png',1)"><img src="images/btn-start.png" name="Image8" border="0" id="Image8" /></a></div>
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
