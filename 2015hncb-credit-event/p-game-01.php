<?
	session_start();
		if ($_SESSION['curPage']=='loading.php'||$_SESSION['curPage']=='p04.php'){
			echo "<script>alert('forbidden action!') ; </script> ";
			exit;
		}
			
	//echo 'server' .  $_SESSION['curPage'];
	if(!isset($_SERVER['HTTP_REFERER'])|| $_SERVER['HTTP_REFERER'] =='')
			exit;
	if (false == strpos(strtolower($_SERVER['HTTP_REFERER']),'p-game.php'))		
	//if (false == strpos(strtolower($_SERVER['HTTP_REFERER']),'hnfhc.ielife.net'))
		exit;
		$_SESSION['curPage']='p-game-01.php';
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
function gotoUrl(url)
{
	//open('about:blank', '_self').close();
	//location.href=url;
	//location.replace(url);

	
    var len = history.length;
    
    // 先回到 IE 啟動時的第一頁
    history.go(-len);
	// 再將網址轉向到目的頁面 ( 注意: 一定要用 location.replace 函式 )
    location.replace(url);
    return false;
}

//-->
</script>
</head>

<body onload="MM_preloadImages('images/btn-start-b.png','images/btn-01b.png','images/btn-02b.png','images/btn-03b.png','images/btn-04b.png','images/btn-06b.png')">
<?php include_once("analyticstracking.php") ?>
<? 
	session_start();
	if (!isset($_SESSION['PCard']) ||$_SESSION['PCard'] =="")
	$_SESSION['PCard']='1';
    $noFreeRec=floor(strlen($_SESSION['FreeRec'])/10);
	if ($noFreeRec<=0){
		echo "無可用序號";
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
<!--<li><a href="p-game.php" class="white-blink">開始遊戲</a></li>-->
<li><a href="p01.php" class="white-blink">活動辦法</a></li>
<li><a href="p02.php" class="white-blink">活動獎品</a></li>
<li><a href="p03.php" class="white-blink">中獎名單</a></li>
<!--<li style="border-bottom:0px;"><a href="https://hnfhc.ielife.net/signin1.asp" target="_blank" class="white-blink">加入會員</a></li>-->
</ul>
</div>
<!--menu end-->
<!--tai-->
<div id="in-btn"><a href="prize.php?par=<?echo $_SESSION['par']?>"><img src="images/small-pic.png" border="0" /></a></div>
<div id="in-btn-menu">
<ul>
<li><a href="p01.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image4','','images/btn-01b.png',1)"><img src="images/btn-01.png" name="Image4" border="0" id="Image4" /></a></li>
<li><a href="p02.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image5','','images/btn-02b.png',1)"><img src="images/btn-02.png" name="Image5" border="0" id="Image5" /></a></li>
<li><a href="p03.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image6','','images/btn-03b.png',1)"><img src="images/btn-03.png" name="Image6" border="0" id="Image6" /></a></li>
<!--<li><a href="https://hnfhc.ielife.net/signin1.asp" target="_blank" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image10','','images/btn-04b.png',1)"><img src="images/btn-04.png" name="Image10" border="0" id="Image10" /></a></li>
<li><a href="p-game.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image8','','images/btn-start-b.png',1)"><img src="images/btn-start.png" name="Image8" border="0" id="Image8" /></a></li>-->
</ul>
</div>
<div id="in-w2"><img src="images/word-02.png" /></div>
<div id="in-w3"><span style="color:#FFF;">恭喜您2016年財運亨通！想讓福氣加倍，快點看『抽獎去』，試試今年手氣有多旺！</span></div>
<!--tai end-->
<!--main-->
<div id="wadilie"><img src="images/wadilie.png" /></div>
<div id="in-btn-go2"><a href="loading.php" onclick="gotoUrl('loading.php'); onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image9','','images/btn-06b.png',1)"><img src="images/btn-06.png" name="Image9" border="0" id="Image9" /></a></div>
<div id="card-open"><img src="images/card-0<? echo $_SESSION['PCard'] ?>.png" /></div>
<div id="cards-pic-2"><img src="images/card-in-bg.png" /></div>
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
