<?
	session_start();
//		echo 'server' .  $_SERVER['HTTP_REFERER'];
		if ($_SESSION['curPage']=='p04.php'){
			echo "<script>alert('forbidden action!') ; </script> ";
			exit;
		}
//	echo 'frecL ' . $_SESSION['FreeRec'];	
//	echo 'urecL ' . $_SESSION['UsedRec'];	
		
	if(!isset($_SERVER['HTTP_REFERER'])|| $_SERVER['HTTP_REFERER'] =='')
			exit;
	$bAllow	=false;
	if ( strpos(strtolower($_SERVER['HTTP_REFERER']),'p-game-01.php'))
		$bAllow	=true;
	if (strpos(strtolower($_SERVER['HTTP_REFERER']),'p05.php'))
		$bAllow	=true;
	//if (false == strpos(strtolower($_SERVER['HTTP_REFERER']),'hnfhc.ielife.net'))
	if (false==$bAllow)
		exit;
	$_SESSION['curPage']='loading.php';
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
<script> 
//---禁回此頁Begin--- 
	function forwardP() { 
	    setTimeout("gotoUrl('p04.php')",2000); 
		//gotoUrl('p04.php');
	} 
//---禁回此頁End--- 
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
12	</script> 
</head>

<body onload="MM_preloadImages('images/btn-start-b.png','images/btn-01b.png','images/btn-02b.png','images/btn-03b.png','images/btn-04b.png','images/btn-06b.png');forwardP();_">
<div id="all" align="center">
<div id="wrapper" style="height:500px;">
  <div id="loading"><img src="images/loading.gif" /></div>
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
