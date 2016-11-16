<?
define('INCLUDEWYSIWYG',1);
@include("coreclass.php");
$ae=new CArticles();
$ae->RequestVariables();
$ae->EngineInitialize();
$ae->UserVerifySession();
$ae->UserVerifyLevel(3);
@include("header.php");
@include("menu.php");
?>
<div id="content">
<?
$object=$ae->DisplayError(8);
if (isset($ae->fdate) && isset($ae->tdate) ) {
   //echo 'ss' . $ae->PrizeCode .'<br>';
   $ae->fdate= str_replace("/","-",$ae->fdate);
   $ae->tdate= str_replace("/","-",$ae->tdate);
   if ( $ae->PrizeCode =='1%' || $ae->PrizeCode =='%' )
   {
        
    $sql= "SELECT *  FROM HN_CBBouns WHERE UseDate>='". $ae->fdate ."' AND UseDate <='". $ae->tdate ."' AND  CheckId IS NOT NULL AND PrizeCode LIKE '". $ae->PrizeCode . "' ORDER BY PrizeCode,UseDate,UseTime ";
    //echo $sql;
    $ae->DBQuery( $sql);
    
   }else
    $ae->DBQuery("SELECT *,sec.UserName as EMail FROM HN_CBBouns as bonus LEFT JOIN HN_UserMessage As sec On bonus.CheckId = sec.CheckId WHERE UseDate>='". $ae->fdate ."' AND UseDate <='". $ae->tdate ."' AND  bonus.CheckId IS NOT NULL AND PrizeCode LIKE '". $ae->PrizeCode . "' ORDER BY UseDate" );
   
   $size=$ae->rowsnumber;
   $filename = './../../hncbpoint/fcore/' . 'COREBSAWARD_' .date("Ymd")  . '.DAT';
   echo $filename .'generated<br>';
   $fp = fopen($filename, "w");
   $today=date("Ymd");
    $write =  fwrite($fp ,$today ,strlen($today));
    $rec= str_pad ( $size , 7 ,'0',STR_PAD_LEFT );
    $write =  fwrite( $fp ,$rec ,strlen($rec));
    $write =  fwrite( $fp ,NL ,strlen(NL));
    echo $rec. 'exported<br>';
    
   if ($size){
    
    //$write =  fwrite($fp ,'this is a  test' );
    //fclose($fp);
    //$fp = fopen($filename, "a+");
    while ($ae->DBGetRow())
      {
      if ($ae->PrizeCode == '1%' || $ae->PrizeCode =='%' ) 
      {
      
        $CheckId=str_pad($ae->access["CheckId"],14,' ',STR_PAD_RIGHT);
        $UseDate= str_replace("/","",str_replace("-","", $ae->access["UseDate"]));
        if ($ae->access["UseTime"] != "")
          $UseTime= str_replace(":","", $ae->access["UseTime"]);
        else
          $UseTime='080000';
        $ExpDate=str_pad($UseDate . $UseTime,14,' ',STR_PAD_RIGHT);
        $write =  fwrite( $fp ,$CheckId . '|',strlen($CheckId . '|'));
        $write =  fwrite( $fp ,$ExpDate . '|' ,strlen($ExpDate . '|'));
        $PrizeCode= str_pad($ae->access["PrizeCode"],2,' ',STR_PAD_RIGHT);
        $write =  fwrite( $fp ,$PrizeCode . '|01|' ,strlen($PrizeCode. '|01|'));
        $TranCode= str_pad($ae->access["TranCode"],30,' ',STR_PAD_RIGHT);
        $write =  fwrite( $fp ,$TranCode  ,strlen($TranCode));
        $write =  fwrite( $fp ,NL ,strlen(NL));
        //$write =  fwrite( $fp ,$TxCount .NL,strlen($TxCount .NL));
      } else
      {
        $Email=$ae->access["EMail"];
        $UseDate= str_replace("/","",str_replace("-","", $ae->access["UseDate"]));
        if ($ae->access["UseTime"] != "")
          $UseTime= str_replace(":","", $ae->access["UseTime"]);
        else
          $UseTime='080000';
        $ExpDate=str_pad($UseDate . UseTime,14,' ',STR_PAD_RIGHT);
        $write =  fwrite( $fp ,$EMail . '|',strlen($EMail . '|'));
        $write =  fwrite( $fp ,$ExpDate . '|' ,strlen($ExpDate . '|'));
        $TranCode= str_pad($ae->access["TranCode"],8,' ',STR_PAD_RIGHT);
        $write =  fwrite( $fp ,$TranCode .NL,strlen($TranCode .NL));
      }
      
      //echo '<option value="',$optionvalue,'">',$optiontext,'</option>';
      }                   
    
    //$ae->DBQuery("UPDATE HN_UserMessage  SET ConfirmState=1 WHERE RegDate>='". $ae->fdate ."' AND RegDate <='". $ae->tdate ."'");
    
   }
   echo 'end of export<br>';
  fclose($fp);
   
   exit;
   
}   
//$files=read_all_files('../applyhncb/');
//while (sizeof($files['files'])) {
//  $file  = array_pop($files['files']);
//  echo $file . '<br>';
//}

function read_all_files($root = '.'){
  $files  = array('files'=>array(), 'dirs'=>array());
  $directories  = array();
  $last_letter  = $root[strlen($root)-1];
  $root  = ($last_letter == '\\' || $last_letter == '/') ? $root : $root.DIRECTORY_SEPARATOR;
 
  $directories[]  = $root;
 
  while (sizeof($directories)) {
    $dir  = array_pop($directories);
    if ($handle = opendir($dir)) {
      while (false !== ($file = readdir($handle))) {
        if ($file == '.' || $file == '..') {
          continue;
        }
        $file  = $dir.$file;
        //echo $file . '<br>';
        if (is_dir($file)) {
          $directory_path = $file.DIRECTORY_SEPARATOR;
          array_push($directories, $directory_path);
          $files['dirs'][]  = $directory_path;
        } elseif (is_file($file)) {
          $files['files'][]  = $file;
        }
      }
      closedir($handle);
    }
  }
 
  return $files;
}
?>
<form name = "form2" method="post" action="exportbonus.php">
<label for="fdate">自動執行</label>
<input type="checkbox" name="chkRun" id="chkRun"  ><br class="clear" />
<label for="fdate">匯出起始日期</label>
<input type="text" name="fdate" id="fdate" value="<? echo $ae->DateConversion(date("Y-m-d",mktime(0,0,0,date("m"),date("d")-7,date("Y"))),2); ?>" size="10" maxlength="10" /><br class="clear" />
<label for="tdate">匯出結束日期</label>
<input type="text" name="tdate" id="tdate" value="<? echo $ae->DateConversion(date("Y-m-d",mktime(0,0,0,date("m"),date("d"),date("Y"))),2); ?>" size="10" maxlength="10" /><br class="clear" />
<label for="PrizeCode">匯出獎項類型</label>
<select name="PrizeCode" id="PrizeCode">
<option value="%"  >全部獎項</option>
<option value="1%"  selected="selected" >華南銀行提供</option>
<option value="2%"  >摩斯漢堡提供</option>
<option value="3%"  >GOHAPPY提供</option>
</select><br class="clear" />
<br class="clear" />
<label for="submit"></label>
<?
echo '<input type="submit" name="submits" id="submits" value="',$ae->textbasic[103],'"';
echo ' class="button" />';
?>
<input type="hidden" name="username" value="<? echo $ae->username; ?>" />
<input type="hidden" name="session" value="<? echo $ae->session; ?>" />
<input type="hidden" name="authorID" value="<? echo $ae->currentuserID; ?>" />
</fieldset>
</form>
<script type="text/javascript">
var runonce;
function chkTask(){
    var hours =new Date().getHours();
    if ( document.getElementById("chkRun").checked == false)
      return;
    if ( hours >=0 && hours <= 1 )   // 
    {
      if (runonce==0)
      {
        runonce=1;
      //  alert('RUN ');
        document.forms["form2"].submit();
      }
    }                                           // sunday between 12:00 and 13:00
        // Do what you want here:
}
runonce=0;
setInterval(chkTask, 1800000); // half hour check once.
//setInterval(chkTask, 1800); // half hour check once.
</script>

</div>
<? @include("footer.php") ?>