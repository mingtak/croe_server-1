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

function gotoUrl(url)
{
    // 取得歷史網址的長度
	
    var len = history.length;
    
    // 先回到 IE 啟動時的第一頁
    history.go(-len);
	// 再將網址轉向到目的頁面 ( 注意: 一定要用 location.replace 函式 )
    location.replace(url);

    return false;
}
function Func(val) 
{
	if (val){
		gotoUrl('p-game.php');
		return true;
	}
	else
		alert('請先詳閱『活動辦法』，或者點選『加入會員』方可進行遊戲喔');
	return false;
}
//-->
</script>
</head>

<body onload="MM_preloadImages('images/btn-01b.png','images/btn-02b.png','images/btn-start-b.png','images/btn-03b.png','images/btn-04b.png')">
<?php include_once("analyticstracking.php") ?>
<?php
include ('./config/config.php');

include ('./modules/Lib.php');
include ('./modules/DBmySQL.php');
include ('./modules/String.php');
define('TEMPDIR','./admin/');
require(TEMPDIR."endechn.php");

$url='http://hnfhc.ielife.net/r_prize.asp?par=';
$data = $_GET['par'] ;
if (strlen($data)<=4)
	$data='';	
//if(strtotime(date("Y-m-d"))>=strtotime("2016-01-01")){ 
	$bStart=true;
	$StartUrl="javascript: return Func(true);";
//}else{
//	$bStart=false;
	$StartUrl="javascript: return Func(false);";
//}
	
session_start();
	$_SESSION['par']=$data;	
	$_SESSION['FreeRec']="";
	$_SESSION['curPage']='prize.php';
	//$_SESSION['UsedRec']=$usedrec;
	$_SESSION['UsedRec']="";
	$prizeList="ABCZ";
	$errorMsg = "";
	$DB->Connect();
	$DB->Select(DATABASE);
//echo 'Decode Data =>' . trans_decrypt($data) . '<=' . strlen(trans_decrypt($data)) . '<br>';
  
	if (  isset($data) && $data != "") {  
		$StartUrl="javascript: return Func(true);";
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
					$StartUrl="javascript: return Func(true);";//='p-game.php';
					
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
		//$_SESSION['UsedRec']=$usedrec;
		$_SESSION['UsedRec']="";
		/*if ($_SESSION['DataRec'] !=""){
			//echo $_SESSION['DataRec'];
			header("location: p041.php");
			//echo '<script type="text/javascript">location.replace("p041.php");</script>'
			exit;
		}*/
		if ($freerec==""){
			echo '<div  id="msg">無序號已兌換完畢</div>';
			exit;
		}	
			
}else
{
//	if ($bStart)
//		exit;
}

?>


<div id="all" align="center">
<div id="wrapper">
<div style="width:100%; padding-top:10px;"><span>
<script type="text/javascript" src="//media.line.me/js/line-button.js?v=20140411" ></script>
<script type="text/javascript">
new media_line_me.LineButton({"pc":false,"lang":"zh-hant","type":"a","text":"華南金融集團 2016財運指數翻翻樂 http://www.core-marketing.com.tw/2015hncb-credit-event/prize.php","withUrl":false});
</script>
</span>
<a href="https://hnfhc.ielife.net/" target="_blank"><img src="images/btn-07.png" border="0" /></a>
</div>
<!--menu-->
<div id="m_top_menu">手機板選單</div>
<div id="top_menu">
<ul>
<li><a href="prize.php?par=<?echo $_SESSION['par']?>" class="white-blink">回首頁</a></li>
<?if ($bStart && $_SESSION['par']!="" ){?>
<li><a href="p-game.php" class="white-blink">開始遊戲</a></li>
<? } ?>
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
<li class="start"><a href="#" onclick="<? echo $StartUrl ?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image5','','images/btn-start-b.png',1)"><img src="images/btn-start.png" name="Image5" border="0" id="Image5" /></a></li>
<li style="margin-top:15px;"><a href="p03.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image6','','images/btn-03b.png',1)"><img src="images/btn-03.png" name="Image6" border="0" id="Image6" /></a></li>
<li style="margin-top:15px;"><a href="https://hnfhc.ielife.net/signin1.asp" target="_blank" onmouseover="MM_swapImage('Image7','','images/btn-04b.png',1)" onmouseout="MM_swapImgRestore()"><img src="images/btn-04.png" name="Image7" border="0" id="Image7" /></a></li>
</ul> 
</div>
<div id="index-btn-2"><a href="#" onclick="<? echo $StartUrl ?>" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image8','','images/btn-start-b.png',1)"><img src="images/btn-start.png" name="Image8" border="0" id="Image8" /></a></div>
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
