﻿<?php
include_once ("check.php");
include_once (PAGES . "back_top.php");

$loginAccess = explode(",", $_COOKIE['loginAccess']);
?>

<div id="content">
<label for="fdate">執行結果</label>
<textarea name="log" id="log" rows="30" cols="80">LOG</textarea>
<br class="clear" />
<script type="text/javascript">
var runonce;
function chkTask(){
    var min =new Date().getMinutes();
    var hour=new Date().getHours(); 
    if( ( min >=0 && min <= 14 ) ||( min >=30 && min <= 44 ))  // 
    {
      if (runonce==0)
      {
        runonce=1;
        //alert('RUN ');
         content = document.getElementById ('log');
        content.value = content.value + '\r\n' + 'autosendsms.php' + ' '+ hour + ':' + min ;
        ajaxSendRequest('http://www.core-marketing.com.tw/2015hncb-credit-event/admin/autosendsms.php');
       
      }
    }else
     runonce =0;                                           // sunday between 12:00 and 13:00
        // Do what you want here:
}
runonce=0;
setInterval(chkTask, 900000); // 15 min check once.
//setInterval(chkTask, 1800); // half hour check once.


// AJAX 物件
var ajax;

// 依據不同的瀏覽器，取得 XMLHttpRequest 物件
function createAJAX() {
　if (window.ActiveXObject) {
　　try {
　　　return new ActiveXObject("Msxml2.XMLHTTP");
　　} catch (e) {
　　　try {
　　　　return new ActiveXObject("Microsoft.XMLHTTP");
　　　} catch (e2) {
　　　　return null;
　　　}
　　}
　} else if (window.XMLHttpRequest) {
　　return new XMLHttpRequest();
　} else {
　　return null;
　}
}

// 非同步傳輸的回應函式，用來處理伺服器回傳的資料
function onRcvData () {
　if (ajax.readyState == 4) {
　　if (ajax.status == 200) {
　　　var content = document.getElementById ('log');
　　　content.value = content.value + ajax.responseText;
　　} else {
　　　alert ("伺服器處理錯誤");
　　}
　} 
}

// 非同步送出資料
function ajaxSendRequest(uri) {
　ajax = createAJAX() ;
　if (!ajax) {
　　alert ('使用不相容 XMLHttpRequest 的瀏覽器');
　　return 0;
　}
　//ajax.onreadystatechange = onRcvData;
 //alert('AJAX');
　ajax.open ("GET", uri, false);
　ajax.send ("");
  var content = document.getElementById ('log');
  content.value = content.value + '\r\n'+ ajax.responseText;
}


</script>
</fieldset>
</div>
</body>
</html>