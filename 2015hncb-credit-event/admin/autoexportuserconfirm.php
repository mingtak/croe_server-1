<?
define('INCLUDEWYSIWYG',1);
@include("coreclass.php");
$ae=new CArticles();
$ae->RequestVariables();
$ae->EngineInitialize();
?>
<?
$ftpFCorePath ='./../../hncbpoint/fcore/';

$object=$ae->DisplayError(8);
$fdate= date("Y-m-d",mktime(0,0,0,date("m"),date("d")-7,date("Y")));
$tdate= date("Y-m-d",mktime(0,0,0,date("m"),date("d")-1,date("Y")));

 {

   $ae->DBQuery("SELECT * FROM HN_UserMessage WHERE RegDate>='". $fdate ."' AND RegDate <='". $tdate ."' AND ConfirmState <= 0" );
   $size=$ae->rowsnumber;
   $filename = $ftpFCorePath . 'COREBSMEMBER_' . date("Ymd")  . '.DAT' ;
    echo $filename .'generated<br>';
    $fp = fopen($filename, "w");
    //$write =  fwrite($fp ,'this is a  test' );
    //fclose($fp);
    //$fp = fopen($filename, "a+");
    $today=date("Ymd");
    $write =  fwrite($fp ,$today ,strlen($today));
    $rec= str_pad ( $size , 7 ,'0',STR_PAD_LEFT );
    $write =  fwrite( $fp ,$rec ,strlen($rec));
    $write =  fwrite( $fp ,NL ,strlen(NL));
    echo $rec. 'exported<br>';
   if ($size){
    
    while ($ae->DBGetRow())
      {
      $CheckId=str_pad($ae->access["CheckId"],14,' ',STR_PAD_RIGHT);
      $RegDate= str_replace("/","",str_replace("-","", $ae->access["RegDate"]));
      $RegDate=str_pad($RegDate,8,' ',STR_PAD_RIGHT);
      $write =  fwrite( $fp ,$CheckId . '|',strlen($CheckId . '|'));
      $write =  fwrite( $fp ,$RegDate .NL,strlen($RegDate .NL));
      //echo '<option value="',$optionvalue,'">',$optiontext,'</option>';
      }                   
    $ae->DBQuery("UPDATE HN_UserMessage  SET ConfirmState=1 WHERE RegDate>='". $ae->fdate ."' AND RegDate <='". $ae->tdate ."'");
    
   }
   fclose($fp);
   echo 'end of export<br>';
    
   exit;
   
}   

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
