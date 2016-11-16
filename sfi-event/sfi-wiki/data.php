<?php
require('../modules/Lib.php');
if (empty($_POST['word'])) ErrorMsg('請先留下您的金句！');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>財團法人中華民國證券暨期貨市場發展基金會-金融知識闖通關</title>
<link href="web.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
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
function MM_showHideLayers() { //v9.0
  var i,p,v,obj,args=MM_showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3) 
  with (document) if (getElementById && ((obj=getElementById(args[i]))!=null)) { v=args[i+2];
    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v=='hide')?'hidden':v; }
    obj.visibility=v; }
}
</script>
</head>

<body onload="MM_preloadImages('images/btn-01b.png','images/btn-05b.png','images/btn-03b.png','images/btn-04b.png')">
<div id="all" align="center">
<div id="bg-shadow">
<div id="wrapper">
<!--main-->
<div id="in-box-03">
<div id="in-tai"><img src="images/in-tai.png" usemap="#Map" style="border-radius:15px 15px 0 0;" border="0" />
    <map name="Map" id="Map">
      <area shape="poly" coords="698,74,868,92,867,123,696,109" href="#" onclick="MM_showHideLayers('info-01','','show')" />
      <area shape="poly" coords="697,147,804,162,796,195,700,182" href="#" onclick="MM_showHideLayers('info-02','','show')" />
      <area shape="poly" coords="849,130,948,141,949,174,839,164" href="list.html" />
      <area shape="rect" coords="68,27,651,246" href="index.html" />
    </map>
</div>
<div id="in-data">
<div style="width:90%; height:150px; border:1px #CCCCCC solid; margin:40px 0 0 5%; overflow:auto; font-size:12px; float:left;">
  <p class="word-red"><strong>主辦單位告知事項</strong></p>
  <p>本行銷推廣活動，擬蒐集參加者之個人資料，為保障您的權益，謹依個人資料保護法第八條規定，告知下列事項：</p>
  <p>1.蒐集之目的：參加活動所蒐集之個資資料將使用於中獎通知、獎項寄送及所得稅扣繳，不另用於其他事宜。</p>
  <p>2.當事人得行使權利及方式：您可以透過書面申請方式，行使個人資料保護法第三條規定，當事人得行使權利：</p>
  <p>(1)查詢或請求閱覽</p>
  <p>(2)請求製給複製本</p>
  <p>(3)請求補充或更正</p>
  <p>(4)請求停止蒐集、處理或利用</p>
  <p>(5)請求刪除</p>
  <p>主辦單位依個人資料保護法第13條規定，得於15或30日內為當事人申請准駁之決定，並以書面將原因通知當事人。另依個人資料保護法第14條規定，主辦單位得酌收行政作業費用。</p>
  <p>3.當事人得自由選擇提供個人資料時，不提供將對其權益之影響：基於以上特定目的，您需提供相關之個人資料予主辦單位，若您未能或無法 提供，主辦單位將無法提供您相關業務之服務，請您見諒！</p>
</div>

<form name="f" method="POST" action="submit.php">
<input type="hidden" name="word" value="<?php echo $_POST['word']?>" />
<div style="width:90%; margin:10px 0 10px 5%; font-size:12px; clear:both; float:left;">
  <input type="checkbox" name="checkbox" id="checkbox" value="1" />
  <label for="checkbox"></label>
  同意以上條款 </div>
<ul>
<li>姓　　名：
  <label for="textfield"></label>
  <input type="text" name="name" id="textfield" style="width:400px;" />
</li>
<li>連絡電話：
  <label for="textfield"></label>
  <input type="text" name="phone" id="textfield" style="width:400px;" />
</li>
<li>電子信箱：
  <label for="textfield"></label>
  <input type="text" name="email" id="textfield" style="width:400px;" />
</li>
</ul>
</form>

<div style="width:100%; text-align:center; margin-top:15px; clear:both; float:left;">
<a href="#" onClick="f.submit()"><img src="images/btn-06.png" /></a>　<a href="#" onClick="f.reset()"><img src="images/btn-07.png" /></a>
</div>
</div>
</div>
<!--<div id="prize"><img src="images/prize02.png" usemap="#Map2" border="0" />
  <map name="Map2" id="Map2">
    <area shape="circle" coords="120,135,22" href="../sfi-cup/index.html" />
  </map>
  <map name="Map" id="Map">
    <area shape="rect" coords="91,114,147,168" href="../web-wk/index.html" />
    <area shape="rect" coords="158,114,209,168" href="index.html" />
</map>
</div>-->
<!--main end-->
<!--footer-->
<div id="footer">主辦單位：<a href="http://www.tfsr.org.tw/" target="_blank">台灣金融服務業聯合總會</a>　　承辦單位：<a href="http://www.sfi.org.tw/" target="_blank">(財)中華民國證券暨期貨市場發展基金會</a>　　協辦單位：<a href="https://www.tsfvm.com.tw/web/index.aspx" target="_blank">臺灣證券期貨虛擬博物館</a></div>
<!--footer end-->
</div>
</div>
<!--info-01-->
<div id="info-01">
<div id="info-words">
  <img src="images/prize.png" align="right" /><p class="word-big-red" style="border-bottom:1px #FF0000 dashed;">活動時間與獎項</p>
  <p>&nbsp;</p>
  <p>於2016/11/16~2017/1/15可線上參加「金融知識Wiki百科創作」活動，參加者只要藉由簡單、溫馨、感性的創作，提出金融、投資理財相關的認知與心得，字數限30字以內，還可以繼續加碼挑戰「金融知識疊疊樂」，與朋友比比看誰先完成疊杯喔，歡迎兩項遊戲一起參加。</p>
  <p>&nbsp;</p>
  <p>主辦單位將於2017/2/10評選出投稿金句的參賽者，第一名獎品為Dyson V8 fluffy SV10 無線吸塵器一台，第二名獎品為SONY Xperia XZ智慧型手機一台，第三名獎品為Canon EOS M10 15-45mm STM相機一台，另外再抽威秀影城雙人套票共50個名額。 </p>
  <p style="text-align:center;"><a href="#" class="blue-link" onclick="MM_showHideLayers('info-01','','hide')">關閉視窗</a></p>
</div>
</div>
<!--info-01 end-->
<!--info-02-->
<div id="info-02">
<div id="info-words">
  <p class="word-big-red" style="border-bottom:1px #FF0000 dashed;">注意事項</p>
  <p>&nbsp;</p>
  <ul>
  <li>參加金句投稿須為投稿者本人之創作指始得參加。</li>
  <li>參加投稿者一旦報名，則視同同意本徵選辦法之相關規定及主辦單位另行公佈之附屬規定。</li>
  <li>若投稿者及其作品不符合本活動辦法之規格，主辦單位有權取消該參賽資格。</li>
  <li>投稿內容請勿使用無意義的符號，以免系統無法讀取或出現亂碼；同時請勿以謾罵及不雅文字投稿，主辦單位保留刪稿權利，不另通知。</li>
  <li>參加投稿作品之著作權歸屬原創作人所有，但投稿者者需同意授權主辦單位與贊助承辦單位無償使用或轉授權其參賽作品之相關著作權利，以下列方法利用參選作品: 廣播、電視、電信平台、網路平台等公開播送、公開上映、 重製、公開傳輸及散布其重製物。</li>
  <li>參加投稿者需保證所提供之作品，並無侵害他人智慧財產權之情事，若有任何第三者主張受侵害之事，參賽者需自行出面處理，與主辦單位無涉。同時， 主辦單位有權取消該參賽者入選資格。</li>
  <li>參加之作品如有同樣內容或高度相似，則以先行投稿之投稿者為優先。</li>
  <li>主辦單位將於2017/02/10公佈得獎名單於本活動網頁。個人資料若填寫不完整或不實，主辦單位有權取消其參加與中獎資格並另行通知。</li>
  <li>得獎者若未收到中獎確認書需於2017/02/17前向主辦單位反應，逾期恕不再受理。主辦單位保留活動修改終止之權利。</li>
  <li>參加者若以惡意之電腦程式或其他違反活動公平性之方式，意圖影響活動結果者，一經察覺，得立即取消參加者之得獎資格，並得追回獎品。</li>
  <li>因違反相關規定所產生之一切法律責任，需由參加者自行負擔。如有任何因電腦、網路、電話、技術或不可歸責於主辦單位之事由，而使參加者所上傳之資料有遲延、遺失、錯誤、無法辨識或毀損之情況，致使無法參加活動時，主辦單位不負任何法律責任，參加者亦不得因此提出異議。</li>
  <li>本活動獎項以所提供實物為準，得獎者不得要求更換獎項或轉換、轉讓或折換現金，並且主辦單位保留更改活動或獎項之權利。</li>
  <li>獎品運送範圍，限於台灣本島、澎湖、金門、馬祖地區，否則視同放棄得獎資格。依中華民國稅法及相關規定，凡中獎價值超過新台幣1,000元者，得獎者需依規定繳交身分證正反面影本填寫相關收據。</li>
  <li>得獎者若無法配合，視同放棄得獎資格。獎品之保固和維修，以其原廠商之服務條款為主，主辦單位不負任何維護或保固責任。</li>
  <li>每名中獎者至多獲得一項獎品，若有重複中獎將僅保留抽中獎品價值最高者。</li>
  <li>對活動有任何疑問可來信至活動小組cola@core-integrated.com.tw，服務電話：02-2718-9028#17 林小姐。</li>
  </ul>
  <p style="text-align:center;"><a href="#" class="blue-link" onclick="MM_showHideLayers('info-02','','hide')">關閉視窗</a></p>
</div>
</div>
<!--info-02 end-->
</div>
</body>
</html>
