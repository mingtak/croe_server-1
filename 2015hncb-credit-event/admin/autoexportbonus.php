<?
define('INCLUDEWYSIWYG',1);
@include("coreclass.php");
$ae=new CArticles();
$ae->RequestVariables();
$ae->EngineInitialize();
//$ae->UserVerifySession();
//$ae->UserVerifyLevel(3);
$fdate= date("Y-m-d",mktime(0,0,0,date("m"),date("d")-1,date("Y")));
$tdate= date("Y-m-d",mktime(0,0,0,date("m"),date("d")-1,date("Y")));
$PrizeCode ='%';

 {
   //echo 'ss' . $ae->PrizeCode .'<br>';
   $fdate= str_replace("/","-",$fdate);
   $tdate= str_replace("/","-",$tdate);
        
    $sql= "SELECT *  FROM HN_CBBouns WHERE UseDate>='". $fdate ."' AND UseDate <='". $tdate ."' AND  CheckId IS NOT NULL AND PrizeCode LIKE '". $PrizeCode . "' ORDER BY PrizeCode,UseDate,UseTime ";
    //echo $sql;
    $ae->DBQuery( $sql);
    
   
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
