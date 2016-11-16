<? session_start();
$bStart=false ;
//echo 'freerec' . $_SESSION['FreeRec'];
if ($_SESSION['FreeRec']!=""){
		$bStart=true;
}
//if(strtotime(date("Y-m-d"))>=strtotime("2016-01-01")){
//	$bStart=true
//}
$_SESSION['curPage']='p03.php';
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
<?php include_once("analyticstracking.php") ?>
<div id="all" align="center">
<div id="wrapper">
<!--menu-->
<div id="m_top_menu">手機板選單</div>
<div id="top_menu">
<ul>
<li><a href="prize.php?par=<?echo $_SESSION['par']?>" class="white-blink">回首頁</a></li>
<? if ($bStart) {?>
<li><a href="p-game.php" class="white-blink">開始遊戲</a></li>
<?	}?>
<li><a href="p01.php" class="white-blink">活動辦法</a></li>
<li><a href="p02.php" class="white-blink">活動獎品</a></li>
<li><a href="p03.php" class="white-blink">中獎名單</a></li>
<li style="border-bottom:0px;"><a href="https://hnfhc.ielife.net/signin1.asp" target="_blank" class="white-blink">加入會員</a></li>
</ul>
</div>
<!--menu end-->
<!--tai-->
<div id="in-btn"><a href="#"><img src="images/small-pic.png" border="0" /></a></div>
<div id="in-btn-menu">
<ul>
<li><a href="p01.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image4','','images/btn-01b.png',1)"><img src="images/btn-01.png" name="Image4" border="0" id="Image4" /></a></li>
<li><a href="p02.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image5','','images/btn-02b.png',1)"><img src="images/btn-02.png" name="Image5" border="0" id="Image5" /></a></li>
<!--<li><a href="p03.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image6','','images/btn-03b.png',1)"><img src="images/btn-03.png" name="Image6" border="0" id="Image6" /></a></li>-->
<li><a href="https://hnfhc.ielife.net/signin1.asp" target="_blank" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image10','','images/btn-04b.png',1)"><img src="images/btn-04.png" name="Image10" border="0" id="Image10" /></a></li>
<? if ($bStart) {?>
<li><a href="p-game.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image8','','images/btn-start-b.png',1)"><img src="images/btn-start.png" name="Image8" border="0" id="Image8" /></a></li>
<?	}?>
</ul>
</div>
<!--tai end-->
<!--main-->
<div id="words">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="10%" bgcolor="#FFC46A">&nbsp;</td>
    <td width="15%" align="center" bgcolor="#FFC46A">姓　名</td>
    <td width="15%" bgcolor="#FFC46A">連絡電話</td>
    <td bgcolor="#FFC46A">E-Mail</td>
  </tr>
  <tr>
    <td rowspan="2" align="center" bgcolor="#FF9D0B"><strong>iPhone 6s Plus</strong></td>
    <td align="center" bgcolor="#FFFFFF">彭*貞</td>
    <td bgcolor="#FFFFFF">0932***392</td>
    <td bgcolor="#FFFFFF">***ostyle@gmail.com</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFDBA4">粘*云</td>
    <td bgcolor="#FFDBA4">0922***725</td>
    <td bgcolor="#FFDBA4">***inyun9367@gmail.com</td>
  </tr>
  <tr>
    <td rowspan="10" align="center" bgcolor="#FFB74A"><strong>江蕙紀念悠遊卡</strong></td>
    <td align="center" bgcolor="#FFFFFF">吳*庭</td>
    <td bgcolor="#FFFFFF">0975***709</td>
    <td bgcolor="#FFFFFF">***17@yahoo.com.tw</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFE8C4">廖*君</td>
    <td bgcolor="#FFE8C4">0933***590</td>
    <td bgcolor="#FFE8C4">***l35a@gmail.com</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF">吳*泰</td>
    <td bgcolor="#FFFFFF">0936***540</td>
    <td bgcolor="#FFFFFF">***@mail2000.com.tw</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFE8C4">陳*洋</td>
    <td bgcolor="#FFE8C4">0912***912</td>
    <td bgcolor="#FFE8C4">***nyang926@gmail.com</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF">吳*芳</td>
    <td bgcolor="#FFFFFF">0919***265</td>
    <td bgcolor="#FFFFFF">***6671@nanshanlife.com.tw</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFE8C4">賴*財</td>
    <td bgcolor="#FFE8C4">0909***588</td>
    <td bgcolor="#FFE8C4">***onplate@gmail.com</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF">郭*芬</td>
    <td bgcolor="#FFFFFF">0912***186</td>
    <td bgcolor="#FFFFFF">***3@entrust.com.tw</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFE8C4">柯*茹</td>
    <td bgcolor="#FFE8C4">0933***589</td>
    <td bgcolor="#FFE8C4">***5407@gmail.com</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF">陳*惠</td>
    <td bgcolor="#FFFFFF">0920***188</td>
    <td bgcolor="#FFFFFF">***.chen@hncb.com.tw</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFE8C4">張*</td>
    <td bgcolor="#FFE8C4">0928***260</td>
    <td bgcolor="#FFE8C4">***g630128@yahoo.com.tw</td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" bgcolor="#CCCCCC"><h4>華得來「2016財運指數翻翻樂」活動中獎須知</h4></td>
  </tr>
  <tr>
    <td bgcolor="#EEEEEE" style="padding:8px 8px 8px 8px;">
      <ul>
      <li style="padding-top:8px; padding-bottom:8px;">領獎須知：應備齊本人身份證正反面影本並填寫資料正確之簽收單。(未能親領者，請將上述資料傳真或郵寄至2016財運指數翻翻樂活動小組，以利辦理領獎事宜。)</li>
      <li style="padding-top:8px; padding-bottom:8px;">領獎方式：參加者經本公司通知並同意受領後(105年3月底前以email通知)，可採郵寄方式領獎。中獎者應於105年4月30日前完成領獎事宜，逾期仍未領獎或不同意受領者，視同放棄中獎資格。</li>
      <li style="padding-top:8px; padding-bottom:8px;">若採郵寄方式領獎，則獎品因e-mail或通訊住址錯漏、郵寄或運送過程中所造成的損壞、遲遞、錯遞或遺失，本公司概不負責。</li>
      <li style="padding-top:8px; padding-bottom:8px;">中獎者若不符合或違反本活動規定事項者，本公司保留取消得獎資格之權利。</li>
      <li style="padding-top:8px; padding-bottom:8px;">依中華民國稅法規定，機會中獎給予價值超過新臺幣1,000元(含)以上者，將開立扣繳憑單予中獎人，向主管機關申報並列入中獎人年度所得。若機會中獎給予價值超過新臺幣20,000元(含)以上者，須先繳納中獎稅金10%(非中華民國境內居住之個人，依法扣繳20%稅金)，方可領取獎項。</li>
      </ul>
    </td>
  </tr>
</table>
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
