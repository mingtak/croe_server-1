<?
define('INCLUDEWYSIWYG',1);
@include("coreclass.php");
$ae=new CArticles();
$ae->RequestVariables();
$ae->EngineInitialize();
@include("header.php");

?>
<div id="content">
<label for="fdate">���浲�G</label>
<textarea name="log" id="log" rows="30" cols="80">LOG</textarea>
<br class="clear" />
<script type="text/javascript">
var runonce;
function chkTask(){
    var hours =new Date().getHours();
     
    if ( hours >=0 && hours <= 1 )   // 
    {
      if (runonce==0)
      {
        runonce=1;
        //alert('RUN ');
        //var content = document.getElementById ('log');
        content.value = content.value + '\r\n' + 'autoexportuserconfirm.php';
        ajaxSendRequest('http://www.core-marketing.com.tw/hncbpoint/admin/autoexportuserconfirm.php');
        content.value = content.value + '\r\n' + 'autoexportbonus.php';
        ajaxSendRequest('http://www.core-marketing.com.tw/hncbpoint/admin/autoexportbonus.php');
       //if ( document.getElementById("chkRun").checked == false)
    
      //  document.forms["form2"].submit();
      }
    }else
     runonce =0;                                           // sunday between 12:00 and 13:00
        // Do what you want here:
}
runonce=0;
setInterval(chkTask, 900000); // 15 min check once.
//setInterval(chkTask, 1800); // half hour check once.


// AJAX ����
var ajax;

// �̾ڤ��P���s�����A���o XMLHttpRequest ����
function createAJAX() {
�@if (window.ActiveXObject) {
�@�@try {
�@�@�@return new ActiveXObject("Msxml2.XMLHTTP");
�@�@} catch (e) {
�@�@�@try {
�@�@�@�@return new ActiveXObject("Microsoft.XMLHTTP");
�@�@�@} catch (e2) {
�@�@�@�@return null;
�@�@�@}
�@�@}
�@} else if (window.XMLHttpRequest) {
�@�@return new XMLHttpRequest();
�@} else {
�@�@return null;
�@}
}

// �D�P�B�ǿ骺�^���禡�A�ΨӳB�z���A���^�Ǫ����
function onRcvData () {
�@if (ajax.readyState == 4) {
�@�@if (ajax.status == 200) {
�@�@�@var content = document.getElementById ('log');
�@�@�@content.value = content.value + ajax.responseText;
�@�@} else {
�@�@�@alert ("���A���B�z���~");
�@�@}
�@} 
}

// �D�P�B�e�X���
function ajaxSendRequest(uri) {
�@ajax = createAJAX() ;
�@if (!ajax) {
�@�@alert ('�ϥΤ��ۮe XMLHttpRequest ���s����');
�@�@return 0;
�@}
�@//ajax.onreadystatechange = onRcvData;
 //alert('AJAX');
�@ajax.open ("GET", uri, false);
�@ajax.send ("");
  var content = document.getElementById ('log');
  content.value = content.value + '\r\n'+ ajax.responseText;
}


</script>
</fieldset>
</div>
<? @include("footer.php") ?>