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
$ftpTCorePath ='./../../hncbpoint/tcore';
$object=$ae->DisplayError(8);
if (isset($ae->importfile)  ) {
  echo 'Test Option ' . $ae->ftest . '.<br>';
  echo 'Delete Option ' . $ae->fdelete . '.<br>'; 
 // exit;
//   $ae->point ,$ae->fdate,$ae->prizecode,  $ae->transetno, $ae->trancode;

        $fstr = file_get_contents($ae->importfile);
        if (strstr($fstr,NL) ==false )
          $lines = preg_split('/' . chr(10) . '/' , $fstr, -1);
        else
          $lines = preg_split('/' . NL . '/' , $fstr, -1);
                    
        $i=0;
        echo '<table><tr><td>recNo</td><td>CheckID</td><td>TranDate</td><td>TranTime</td><td>TranType</td><td>TranNo</td><td>TranAmount</td><td>TranCount</td><td>GovFlag</td><td>Point</td></tr>';
        foreach ($lines as $line)
        {
          $i=$i+1;
          //echo 'rec=' . $i . ' line' . $line;
          if ($i==1)
          {
            if ( strlen($line)!=17)
            {
              echo 'Invalid record format<br>';
              exit;
            }
            $fdate=substr($line,0,10);
            $recno=strval(substr($line,10,7));
            echo 'total recno is ' . $recno . '<br>';
            if ($recno<=0)
            {
              echo 'no record <br>';
              exit;
            }  
            if (!strtotime($fdate))
             {
              echo 'Invalid record format<br>';
              exit;
            }
          }else
          {
            if ($i > $recno+1 )
            {
              if (strlen($line) >3)
              {
                echo 'From the line=>' . $line ;
                echo  ' record ' . $i . 'overflow <br>';
              
              }
              exit;
              
            }
            else
            {
              if (strlen($line)<78)
              {
                echo 'From the line=>' . strlen($line) . '.' . $line;
                 echo ' Invalid record format, record length<br>';
                exit;
              }
              
              $CheckID=substr($line,0,14);
              $TranDate=trim(substr($line,15,10));
              if ($TranDate == '')
                  $TranDate=date("Y-m-d");
              $TranType=substr($line,26,2);
              $TranNo=substr($line,29,33);
              $TranAmount= strval(substr($line,63,14));
              //echo substr($line,63,14);
              $TranCount= trim(substr($line,78,2));
              if ($TranCount=='  ')
                $TranCount='01';
              if (strlen($line)>=82)  
                $GovFlag= substr($line,81,1);
              else
                 $GovFlag='N';
                    
              $ae->DBQuery("SELECT * FROM HN_CBRule Where TranType='" . $TranType . "' ORDER BY RuleDate DESC Limit 1");
              
              while ($ae->DBGetRow())
              {
              //Id 	RuleDate 	TranType 	TranKind 0 一般 1-一次性點數 2. 1月1次回饋	TranAmount 交易金額RULE	TranCount 交易次數RULE	VipRule
              
                $ID=$ae->access["Id"];
                $RuleDate=$ae->access["RuleDate"];
                $TranTypeRule=$ae->access["TranType"];
                $TranKindRule=strval($ae->access["TranKind"]); 
                $TranAmountRule=$ae->access["TranAmount"];
                $TranCountRule=$ae->access["TranCount"];
                $VipRule=$ae->access["VipRule"];
                //echo 'TrantypeRule=' . $TranTypeRule; 
              }
              $bInsert=true;
              switch ($TranKindRule)
              {
                case 1:
                  $sql= "SELECT * FROM HN_CBPoint WHERE CheckID='" . $CheckID . "' AND TranType ='" . $TranType . "'";
                   $ae->DBQuery($sql);
                   
                   if ($ae->rowsnumber)
                      $bInsert=false;
                   //echo 'rule1 found' . $sql .'<br>';   
                  break;
                case 2:
                  $StartDate=date("Y-m-d",mktime(0,0,0, strval(substr($TranDate,5,2)),1,strval(substr($TranDate,0,4))));
                  $EndDate= date("Y-m-d",mktime(0,0,0, strval(substr($TranDate,5,2))+1,0,strval(substr($TranDate,0,4))));
                  $sql=        "SELECT * FROM HN_CBPoint WHERE CheckID='" . $CheckID . "' AND TranType ='" . $TranType . "' AND TranDate>='" . $StartDate . "' AND TranDate <='" . $EndDate . "'" ;
                  $ae->DBQuery($sql);
                   if ($ae->rowsnumber)
                      $bInsert=false;
                   //echo 'rule2 found' . $sql. '<br>';   
                  break;
                
              }
              $sql= "SELECT * FROM HN_CBPoint WHERE CheckID='" . $CheckID . "' AND TranNo ='" . $TranNo . "'";
              $ae->DBQuery($sql);
              if ($ae->rowsnumber)
                      $bInsert=false;
              $vipFact=1;
              $Point=0;
              if ($bInsert) 
              {
                 if ($VipRule !="")
                 {
                    $viplines = preg_split('/,/' , $VipRule, -1);
                    $vipFact=strval($viplines[1]);
                    //echo 'vip0= ' . $viplines[0] ;
                    //echo '<br>vip1= ' . $viplines[1] . '<br>' ;
                    //echo '$vipFact= ' . $vipFact;
                 }
                 if ($TranAmountRule !="")
                 {
                    //echo $TranAmountRule; 
                    $TranAmountRuleLines = preg_split('/,/' , $TranAmountRule, -1);
                    for ( $ii=0; $ii < (sizeof($TranAmountRuleLines)/2) ;$ii++ ) {
                      $lamount  = $TranAmountRuleLines[2*$ii];
                      $lpoint= $TranAmountRuleLines[2*$ii+1];
                      if ( $TranAmount >= $lamount )
                            $Point = $lpoint;
                    }
                 }
                 if ($TranCountRule !="")
                 {
                    $TranCountRuleLines = preg_split('/,/' , $TranCountRule, -1);
                    for ( $ii=0; $ii < (sizeof($TranCountRuleLines)/2) ;$ii++ ) {
                      $lcount  = $TranCountRuleLines[2*$ii];
                      $lpoint= $TranCountRuleLines[2*$ii+1];
                      if ( strval($TranCount) == strval($lcount) )
                            $Point = $lpoint;
                    } 
                 }
                if ($GovFlag=='Y')
                  $iGovFlag=1;
                else
                  $iGovFlag=0;    

                 if ($Point !=0 && $iGovFlag )
                 {
                   $Point =  $Point * $vipFact;
                 }
                    echo '<tr><td>';
                    if ($Point==0 )
                      echo '<font color="red">';
                    echo  $i -1;
                    if ($Point==0 )
                      echo '</font >';  
                    echo '</td><td>';
                    echo  $CheckID ;
                    echo '</td><td>';
                    echo  $TranDate;
                    echo '</td><td>';
                    echo  '08:00:00';
                    echo '</td><td>';
                    echo  $TranType;
                    echo '</td><td>';
                    echo $TranNo;
                    echo '</td><td>';
                    echo  $TranAmount;
                    echo '</td><td>';
                    echo  $TranCount;
                    echo '</td><td>';
                    
                    echo  $iGovFlag;
                    echo '</td><td>';  
                    echo $Point;
                    echo '</td></tr>';
                    if ($ae->ftest !='ftest' && $Point )
                    {
                      
                      
                      
                      $sql="INSERT INTO HN_CBPoint ( CheckID,TranDate,TranTime,TranType,TranNo,TranAmount,TranCount, GovFlag,Point,Status)  VALUES ('".$CheckID."','".$TranDate."','08:00:00','".$TranType."','". $TranNo."','".$TranAmount."','". $TranCount."','" .$iGovFlag. "','". $Point . "','0') ";
                      $ae->DBQuery($sql);
                    }
                 
              }  else
              {
                echo '<tr><td><font color="red">' . ( $i -1) .'</font></td><td  colspan="9">' .$line.'</td></tr>';
              }
              //$ae->DBQuery("INSERT INTO ".$ae->table[0]." ( PrizeCode,ValidDate,Point,TranCode) VALUES ('".$ae->prizecode."','".$ae->fdate."','".$ae->point."','". $line."')");
              //echo $i . '=>';
              //echo $line . '<br>';
            }
          }
          
        }
        echo '</table>';
        
   echo 'generate OK';
   exit;
   
} 
$files=read_all_files($ftpTCorePath);
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

<form method="post" action="importpoint.php"  >
<label for="ftest">測試輸入</label>
<input type="checkbox" name="ftest" id="ftest" value="ftest"  checked="checked" size="10" maxlength="10" /><br class="clear" />
<label for="fdelete">是否刪檔</label>
<input type="checkbox" name="fdelete" id="fdelete" value="fdelete"  size="10" maxlength="10" /><br class="clear" />
<label for="prizecode">選擇檔案</label>
<select name="importfile"   id="importfile">
<?
  while (sizeof($files['files'])) 
  {
    $file  = array_pop($files['files']);
    echo  '<option value="' . $file . '" >' . $file . '</option>';
  }
?>
</select><br class="clear" />
<label for="submit"></label>
<?
echo '<input type="submit" name="submit" id="submit" value="',$ae->textbasic[103],'"';
echo ' class="button" />';
?>
<input type="hidden" name="username" value="<? echo $ae->username; ?>" />
<input type="hidden" name="session" value="<? echo $ae->session; ?>" />
<input type="hidden" name="authorID" value="<? echo $ae->currentuserID; ?>" />
</fieldset>
</form>
</div>
<? @include("footer.php") ?>