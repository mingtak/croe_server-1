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
if (isset($ae->fdate)  ) {
   //echo 'point=' , $ae->point , 'fdate=',$ae->fdate,'prizecode=',$ae->prizecode,'<br>';
   $ae->fdate=str_replace("/","-",$ae->fdate) ;
   if (($ae->prizecode=='1A') || ($ae->prizecode=='1B'))
   {
    for ($i=1 ; $i<=$ae->transetno ;$i++ )
    {
      $ae->DBQuery("INSERT INTO ".$ae->table[0]." ( PrizeCode,ValidDate,Point,TranCode) VALUES ('".$ae->prizecode."','".$ae->fdate."','".$ae->point."','". str_pad ( $i , 7 ,'0',STR_PAD_LEFT )."')");
       
    }
    echo 'generate OK';
   } else 
   {
    if ( $_FILES['uploadedfile']['error'] != UPLOAD_ERR_OK)
    {
       echo 'file upload error ';
      exit;
    }
    if ( is_uploaded_file($_FILES['uploadedfile']['tmp_name'])) { //checks that file is uploaded
        $fstr = file_get_contents($_FILES['uploadedfile']['tmp_name']);
        $lines = preg_split('/' . NL . '/' , $fstr, -1);
        $i=0;
        foreach ($lines as $line)
        {
          $i=$i+1;
          if ( $i <= $ae->transetno)
          {
            $sql="INSERT INTO ".$ae->table[0]." ( PrizeCode,ValidDate,Point,TranCode) VALUES ('".$ae->prizecode."','".$ae->fdate."','".$ae->point."','". $line."')";
            //echo $sql;
            $ae->DBQuery($sql);
            echo $i . '=>';
            echo $line . '<br>';
          }
        } 
    }
    echo 'end of generation!'; 
   }
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
<form method="post" action="generatebonus.php" enctype="multipart/form-data" >
<label for="fdate">有效日期</label>
<input type="text" name="fdate" id="fdate" value="<? echo $ae->DateConversion(date("Y-m-d",mktime(0,0,0,date("m")+1,0,date("Y"))),2); ?>" size="10" maxlength="10" /><br class="clear" />
<label for="point">兌換點數</label>
<input type="text" name="point" id="point" value="" size="8" maxlength="8" /><br class="clear" />
<label for="prizecode">獎項類型</label>
<select name="prizecode" onChange="PrizeChange()"  id="prizecode">
<option value=""  selected="selected"  >請選擇獎項類型</option>
<option value="1A"   >跨行轉帳手續費優惠3次</option>
<option value="1B" >基金申購手續費3.5折優惠</option>
<option value="2A"  >「摩斯漢堡熱摩斯咖啡」兌換券 (市價40元)</option>
<option value="2B"  >「摩斯漢堡+冰紅茶」兌換券 (市價100元)</option>
<option value="3A"  >GOHAPPY平台購物金100元</option>
<option value="3B"  >C2 HAPPYGO點數100點</option>
</select><br class="clear" />
<label for="trancode">獎項序號檔</label>
<input type="file" name="uploadedfile" id="uploadedfile"  size="40" maxlength="40" /><br class="clear" />
<label for="transetno">獎項組別總數</label>
<input type="text" name="transetno" id="transetno" value="" size="10" maxlength="10" /><br class="clear" />
<br class="clear" />
<label for="submit"></label>
<?
echo '<input type="submit" name="submit" id="submit" value="',$ae->textbasic[103],'"';
echo ' class="button" />';
?>
<input type="hidden" name="username" value="<? echo $ae->username; ?>" />
<input type="hidden" name="session" value="<? echo $ae->session; ?>" />
<input type="hidden" name="authorID" value="<? echo $ae->currentuserID; ?>" />
<input type="hidden" id="defaultdate" name="defaultdate" value="<? echo $ae->DateConversion(date("Y-m-d",mktime(0,0,0,date("m")+1,0,date("Y"))),2); ?>" />
</fieldset>
</form>
<script type="text/javascript">
function PrizeChange(){
  var myselect = document.getElementById("prizecode");
  switch (myselect.options[myselect.selectedIndex].value )
  {
    case '1A':
     
     document.getElementById("fdate").value='2013/12/31';
     document.getElementById("point").value='5'; 
     document.getElementById("transetno").value='8000';
     break;
    case '1B':
     document.getElementById("fdate").value='2013/12/31';
     document.getElementById("point").value='10';
     document.getElementById("transetno").value='8000';
     break;
    case '2A':
     //alert( document.getElementById("defaultdate").value);
     document.getElementById("fdate").value= document.getElementById("defaultdate").value;
     document.getElementById("point").value='8';
     document.getElementById("transetno").value='250';
     break;
    case '2B':
     //alert( document.getElementById("defaultdate").value);
     document.getElementById("fdate").value= document.getElementById("defaultdate").value;
     document.getElementById("point").value='20';
     document.getElementById("transetno").value='400';
     break;
    case '3A':
     document.getElementById("fdate").value='2013/12/31';
     document.getElementById("point").value='20';
     document.getElementById("transetno").value='6000';
     break;
   case '3B':
     document.getElementById("fdate").value='2013/12/31';
     document.getElementById("point").value='20';
     document.getElementById("transetno").value='2000';
     break; 
  } 
}
</script>
</div>
<? @include("footer.php") ?>