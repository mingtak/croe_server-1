<? session_start();
$bStart=false ;
//echo 'freerec' . $_SESSION['FreeRec'];
if ($_SESSION['FreeRec']!=""){
	//	echo 'sssf';
		$bStart=true;
}
//if(strtotime(date("Y-m-d"))>=strtotime("2016-01-01")){
//	$bStart=true
//}
$_SESSION['curPage']='p01.php';
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
<!--<li><a href="p01.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image4','','images/btn-01b.png',1)"><img src="images/btn-01.png" name="Image4" border="0" id="Image4" /></a></li>-->
<li><a href="p02.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image5','','images/btn-02b.png',1)"><img src="images/btn-02.png" name="Image5" border="0" id="Image5" /></a></li>
<li><a href="p03.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image6','','images/btn-03b.png',1)"><img src="images/btn-03.png" name="Image6" border="0" id="Image6" /></a></li>
<li><a href="https://hnfhc.ielife.net/signin1.asp" target="_blank" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image10','','images/btn-04b.png',1)"><img src="images/btn-04.png" name="Image10" border="0" id="Image10" /></a></li>
<? if ($bStart) {?>
<li><a href="p-game.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image8','','images/btn-start-b.png',1)"><img src="images/btn-start.png" name="Image8" border="0" id="Image8" /></a></li>
<?	}?>
</ul>
</div>
<!--tai end-->
<!--main-->
<div id="words">
<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="center" valign="top"><h3 style="color:#F00;">華南翻翻樂 免費紅包、iPhone 6S Plus  大方抽</h3></td>
    </tr>
  <tr>
    <td colspan="2" valign="top"> 無論您是新客戶還是華南既有客戶，只要活動期間於華得來點數兌換網站兌換商品成功，即可享有多項好禮大方抽。</td>
  </tr>
  <tr>
    <td width="12" valign="top"><img src="images/icon-01.gif" /></td>
    <td>本活動期間為：105年1月1日起至105年2月29日止。</td>
  </tr>
  <tr>
    <td valign="top"><img src="images/icon-01.gif" /></td>
    <td><strong>新人獎：</strong>於華得來點數兌換網站註冊成功即贈送華得來點數一千點。</td>
  </tr>
  <tr>
    <td valign="top"><img src="images/icon-01.gif" /></td>
    <td><strong>立即獎：</strong>華得來點數兌換網站之會員在活動期間內兌換商品成功，即可參加『2016 財運指數翻翻樂』並獲得紅包立即抽之抽獎機會，換越多抽獎機會越多。</td>
  </tr>
  <tr>
    <td valign="top"><img src="images/icon-01.gif" /></td>
    <td><strong>鴻運參加獎：</strong>只要兌換商品成功並參加『2016 財運指數翻翻樂』，不論立即抽有無中獎，皆有資格參加iPhone 6S Plus、江蕙紀念悠遊卡等好禮抽獎。</td>
  </tr>
  <tr>
    <td valign="top"><img src="images/icon-01.gif" /></td>
    <td>運勢牌組文字僅供參考。</td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top"><h3 style="color:#F00;">抽獎相關事項</h3></td>
    </tr>
  <tr>
    <td valign="top"><img src="images/icon-01.gif" /></td>
    <td>請先登入華得來點數兌換網站或加入華得來會員，並於活動期間成功兌換商品，即可參加『2016 財運指數翻翻樂』遊戲及紅包立即抽的活動。</td>
  </tr>
  <tr>
    <td valign="top"><img src="images/icon-01.gif" /></td>
    <td>立即抽獎項，為等值電子禮券序號，將以簡訊發送至中獎者手機，可憑此序號換取等值商品。兌換期限至105年4月30號止。<br />
      電子禮券兌獎方式：至全家便利商店FamiPort機台點選首頁(紅利)→紅利PIN碼→謝謝你好朋友→輸入序號→列印兌換券</td>
  </tr>
  <tr>
    <td valign="top"><img src="images/icon-01.gif" /></td>
    <td>鴻運參加獎之抽獎資格為參加立即抽並留下姓名及相關聯絡資料之華得來會員，將以ID歸戶後之名單進行抽獎。中獎名單將於105年3月底前公告於活動網頁。</td>
  </tr>
  <tr>
    <td valign="top"><img src="images/icon-01.gif" /></td>
    <td>鴻運參加獎之中獎者以符合抽獎資格之華得來會員為限，領獎及相關事宜將另行通知。</td>
  </tr>
  <tr>
    <td valign="top"><img src="images/icon-01.gif" /></td>
    <td>獎品寄送將由本集團合作之活動執行廠商，辦理通知領獎及寄送等相關事宜。</td>
  </tr>
  <tr>
    <td valign="top"><img src="images/icon-01.gif" /></td>
    <td>活動期間兌換商品成功後，如因可歸責於客戶之原因而退貨2次以上之情形，將喪失抽獎資格，並將追回獲得獎項。</td>
  </tr>
  <tr>
    <td valign="top"><img src="images/icon-01.gif" /></td>
    <td>活動期間若有惡意行為或破壞活動公平性者，本集團有權終止其活動資格。</td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="top"><h3 style="color:#F00;">活動注意事項</h3></td>
    </tr>
  <tr>
    <td valign="top"><img src="images/icon-01.gif" /></td>
    <td>參加者請務必留下正確的聯絡資訊，若因e-mail帳號或活動獎項寄送地址等相關聯絡資訊填寫不完整，導致無法通知中獎訊息或寄送活動獎項，視同放棄中獎資格。</td>
  </tr>
  <tr>
    <td valign="top"><img src="images/icon-01.gif" /></td>
    <td>參加者保證所填寫或提出之資料均為真實完整且正確，且未冒用或盜用任何第三人之資料。如有不實、不完整或不正確之情事，將被取消參加與中獎資格。如因此致無法通知中獎訊息、或導致獎項遭冒領、遺失者，本集團不負補發獎項責任。</td>
  </tr>
  <tr>
    <td valign="top"><img src="images/icon-01.gif" /></td>
    <td>依中華民國稅法規定，機會中獎之給予價值超過新臺幣1,000元(含)以上者，須申報主管機關並列入中獎人年度所得，本集團將開立扣繳憑單予中獎人。中獎人應配合提供身分證明文件影本供本集團作為申報依據；若機會中獎之給予價值超過新臺幣20,000元者，須先繳納10%稅金(非中華民國境內居住之個人，依法扣繳20%稅金)，方可領取贈獎。</td>
  </tr>
  <tr>
    <td valign="top"><img src="images/icon-01.gif" /></td>
    <td>本活動之抽獎、中獎與有效交易紀錄(包含符合抽獎資格之次數等)，均依相關電腦系統之紀錄與認定為準。</td>
  </tr>
  <tr>
    <td valign="top"><img src="images/icon-01.gif" /></td>
    <td>本活動獎項以實物為準，中獎人不得要求更換、或折換現金，除獎項外其他衍生之相關費用由中獎人自行負擔。</td>
  </tr>
  <tr>
    <td valign="top"><img src="images/icon-01.gif" /></td>
    <td>活動獎項若發生不可抗拒之原因而造成缺貨、出貨延後或無法贈送之情事，本集團有權更換等值獎項，中獎人不得異議。</td>
  </tr>
  <tr>
    <td valign="top"><img src="images/icon-01.gif" /></td>
    <td>活動獎項發出後，若有遺失或被竊等喪失占有之情形，本集團不負補發獎項責任。若因e-mail或通訊住址錯漏、郵寄或運送過程中所造成的損壞、遲遞、錯遞或遺失，本集團概不負責，相關保固及維修問題請洽商品原廠。</td>
  </tr>
  <tr>
    <td valign="top"><img src="images/icon-01.gif" /></td>
    <td>參加者同意本集團得於本活動範圍內，進行蒐集、處理、利用個人資料；並同意於中獎時，公布部分姓名及e-mail帳號於中獎名單。</td>
  </tr>
  <tr>
    <td valign="top"><img src="images/icon-01.gif" /></td>
    <td>參加者應留意本活動公布得獎訊息，並於各獎項領獎期間主動與本集團洽繫領獎事宜。</td>
  </tr>
  <tr>
    <td valign="top"><img src="images/icon-01.gif" /></td>
    <td>本活動事項載明於活動網頁中，參加本活動者，視為同意接受本活動注意事項之規範。若有違反本活動注意事項之行為，本集團得取消其參加或得獎資格，並對於任何破壞本活動之行為保留相關權利。</td>
  </tr>
  <tr>
    <td valign="top"><img src="images/icon-01.gif" /></td>
    <td>如有任何因網路、電腦、電話、技術或其他不可歸責於本集團之事由，而使寄送中獎人之獎品有延遲、遺失、錯誤、無法辨識或毀損之情況，本集團不負任何法律責任，中獎人視同放棄中獎資格，亦不得因此而主張任何法律權利。</td>
  </tr>
  <tr>
    <td valign="top"><img src="images/icon-01.gif" /></td>
    <td>本集團保有取消、終止、修改或暫停及解釋本活動相關事項之權利，更動之活動時間與內容方式，將公告於本活動網頁。</td>
  </tr>
  <tr>
    <td valign="top"><img src="images/icon-01.gif" /></td>
    <td>本活動立即獎為亂數抽出，為維護網路活動之公平性，如過程中有任何因網路、電腦、電話、技術或其他不可歸責於本集團之事由，致抽獎未順利完成，本集團將無法另行給予抽獎機會。</td>
  </tr>
  <tr>
    <td valign="top"><img src="images/icon-01.gif" /></td>
    <td>若您對活動內容有任何疑問，請致電本集團客戶服務專線：華南銀行02-21810101；華南永昌證券02-4128889；華南產險02-27616969。</td>
  </tr>
  <tr>
    <td colspan="3" align="center" valign="top"><h3 style="color:#F00;">蒐集處理及利用個人資料告知事項</h3></td>
    </tr>
  <tr>
    <td colspan="2" valign="top">華南金融控股股份有限公司(以下稱本公司)依據個人資料保護法(以下稱個資法)第八條第一項規定，向台端告知下列事項，敬請台端詳閱及知悉：</td>
    </tr>
  <tr>
    <td valign="top"><img src="images/icon-01.gif" /></td>
    <td><strong>蒐集之目的：</strong><br />
    本公司蒐集、處理與利用您的個人資料之目的，係為「2016 財運指數翻翻樂」活動兌獎、領獎及依中華民國稅法辦理申報及代扣繳作業使用。
    </td>
  </tr>
  <tr>
    <td valign="top"><img src="images/icon-01.gif" /></td>
    <td><strong>蒐集之個人資料類別：：</strong><br />
包括姓名、身分證統一編號、連絡電話、戶籍地址及通訊地址。</td>
  </tr>
  <tr>
    <td valign="top"><img src="images/icon-01.gif" /></td>
    <td><p><strong>個人資料利用之期間、地區、對象及方式：</strong><br />
      期間：個人資料蒐集之特定目的存續期間、依相關法令或契約約定之保存期限（如：商業會計法等）或本公司因執行業務所必須之保存期間。
     </p>
      <p>(1)地區：本國、本公司業務委外機構所在地。</p>
      <p>(2)對象：本公司、華南商業銀行股份有限公司、華南永昌綜合證券股份有限公司、華南產物保險股份有限公司業務委外機構、司法機關及其他依法有調查權機關或金融監理機關。</p>
      <p>(3)方式：以自動化機器或其他非自動化之利用方式。</p></td>
  </tr>
  <tr>
    <td valign="top"><img src="images/icon-01.gif" /></td>
    <td><p><strong>依據個資法第三條規定，台端就本公司保有台端之個人資料得行使下列權利：</strong><br />
      (1)得向本公司查詢、請求閱覽或請求製給複製本，而本公司依法得酌收必要成本費用。</p>
      <p>(2)得向本公司請求補充或更正，惟依法台端應為適當之釋明。</p>
      <p>(3)得向本公司請求停止蒐集、處理或利用及請求刪除，惟依法本公司因執行業務所必須者，得不依台端請求為之。</p></td>
  </tr>
  <tr>
    <td valign="top"><img src="images/icon-01.gif" /></td>
    <td><strong>台端不提供個人資料所致權益之影響：</strong><br />
台端得自由選擇是否提供相關個人資料，惟台端若拒絕提供相關個人資料，本公司將無法進行必要之身分審核及兌獎處理作業，致無法提供台端獎項，視為您放棄此項領獎權益。</td>
  </tr>
  <tr>
    <td colspan="2" valign="top">經 貴公司向本人告知，本人已清楚瞭解並同意 貴公司蒐集、處理、利用本人個人資料之目的及用途，並同意 貴公司於上開「履行個人資料保護法告知事項」1至5項範圍內，得蒐集、處理及利用本人資料。</td>
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
