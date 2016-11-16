<?
$condition=" 1 ";
@include("coreclass.php");
$ae=new CArticles();
$ae->RequestVariables();
$ae->EngineInitialize();
// Logs user in
if ($ae->action==1)
   {
   $ae->RequestVariables(1);
   $ae->UserLogin($ae->user,$ae->pass);
   }
$ae->UserVerifySession();
// Logs user out
if ($ae->action==2)
   {
   $ae->RequestVariables(1);
   $ae->UserLogout();
   }
if ($ae->filtdatefromb) $ae->filtdatefromb=$ae->DateConversion($ae->filtdatefromb);
if ($ae->filtdatetob) $ae->filtdatetob=$ae->DateConversion($ae->filtdatetob);
setcookie('filtarticlenumberbb',$ae->filtarticlenumberb,time()+999999999,'/');
setcookie('filtPrizeCode',$ae->filtPrizeCode,time()+999999999,'/');
// setcookie('filtuserID',$ae->filtuserID,time()+999999999,'/');
if (isset($ae->filtdatefromb)) setcookie('filtdatefromb',$ae->filtdatefromb,time()+999999999,'/');
if (isset($ae->filtdatetob)) setcookie('filtdatetob',$ae->filtdatetob,time()+999999999,'/');
if ($ae->filtPrizeCode)
   {
   $condition.=" AND PrizeCode = '".$ae->filtPrizeCode."'";
   }
if ($ae->filtdatefromb)
   {
   $condition.=" AND UseDate>='".$ae->filtdatefromb."'";
   }
if ($ae->filtdatetob)
   {
   $condition.=" AND UseDate<='".$ae->filtdatetob."'";
   }
if ($ae->filtCheckId)
   {
   $condition.=" AND sec.CheckId LIKE '%".$ae->filtCheckId."%'";
   }
$condition.=" GROUP BY ID ORDER BY ";
if ($ae->sortbyb=="date")
   {
   setcookie('sortbyb','date',time()+999999999,'/');
   setcookie('sortorderb',$ae->sortorderb,time()+999999999,'/');
   if ($ae->sortorderb=="asc") $ae->sortorderb="desc"; else $ae->sortorderb="asc";
   $condition.="UseDate ".$ae->sortorderb.",UseTime ".$ae->sortorderb;
   }
elseif ($ae->sortbyb=="PrizeCode")
   {
   setcookie('sortbyb','PrizeCode',time()+999999999,'/');
   setcookie('sortorderb',$ae->sortorderb,time()+999999999,'/');
   if ($ae->sortorderb=="asc") $ae->sortorderb="desc"; else $ae->sortorderb="asc";
   $condition.="PrizeCode ".$ae->sortorderb;
   }
elseif ($ae->sortbyb=="CheckId")
   {
   setcookie('sortbyb','CheckId',time()+999999999,'/');
   setcookie('sortorderb',$ae->sortorderb,time()+999999999,'/');
   if ($ae->sortorderb=="asc") $ae->sortorderb="desc"; else $ae->sortorderb="asc";
   $condition.="CheckId ".$ae->sortorderb;
   }
elseif ($ae->sortbyb=="ValidDate")
   {
   setcookie('sortbyb','ValidDate',time()+999999999,'/');
   setcookie('sortorderb',$ae->sortorderb,time()+999999999,'/');
   if ($ae->sortorderb=="asc") $ae->sortorderb="desc"; else $ae->sortorderb="asc";
   $condition.="ValidDate ".$ae->sortorderb;
   }
else
   {
   $condition.="UseDate DESC, UseTime DESC";
   }
@include("header.php");

@include("menu.php");

echo '<div id="content">';

if ($ae->currentuserposition<=3) @include('filterb.php');

//$ae->DisplayEngineModuleParts();

if ($ae->currentuserposition<=3)
   {
   if (!$ae->filtarticlenumberb) $ae->filtarticlenumberb=20;
   
   
   
     $ae->DBQuery("SELECT * FROM ".$ae->table[0]. " WHERE ".$condition);
   
   $RowNumber=$ae->rowsnumber;
   $NumPerPage=  $ae->filtarticlenumberb;
   $LastPage =  intval(($RowNumber-1)/$NumPerPage) +1;
   
   if (!isset($ae->offset))
      $ae->offset=0;
      
   $PageStart=(intval($ae->offset /$NumPerPage))+1;
   $PageCurrent=$PageStart;
   $PageStart= (intval(($PageStart-1) /10)*10)+1; 
   $condition.=" LIMIT " . $ae->offset . "," .$ae->filtarticlenumberb;
   
   $ae->DBQuery("SELECT * FROM ".$ae->table[0]."  WHERE ".$condition);
   echo 'Total ' . $RowNumber . '  records   ' ;
   
   echo '<a href="javascript:query_auto_commit(\'0\');">第一頁</a>';
   if ($LastPage !=1)
   {
    echo '｜';
    for($i=$PageStart;$i<=$LastPage&& $i<=$PageStart+10;$i++ )
     {
        echo '<a href="javascript:query_auto_commit(\'' . (($i-1)*$NumPerPage) . '\');">&nbsp;&nbsp;' ;
        if ( $i ==$PageCurrent)
          echo '<strong><' . $i . '></strong>';
        else
          echo $i; 
        echo '&nbsp;&nbsp; </a>'; 
     }
    echo '｜';
    echo '<a href="javascript:query_auto_commit(\'' . (($LastPage-1)*$NumPerPage) . '\');">最末頁</a></br>';  
   }
   
   
   
//   $condition.=" LIMIT ".$ae->filtarticlenumberb;
//   $ae->DBQuery("SELECT * FROM ".$ae->table[0]. " WHERE ".$condition);
   echo '<table width="98%">';
   echo '<thead>';
   echo '<tr>';
   echo '<td>ID</td>';
   echo '<td>';
   if ($ae->sortbyb=="date" OR !$ae->sortbyb) echo '<span class="help" title="',$ae->textbasic[88],'">*</span>';
   echo '兌換日期<a href="managerbonus.php?sortbyb=date&sortorderb=',$ae->sortorderb,'&username=',$ae->username,'&session=',$ae->session,'" title="',$ae->textbasic[87],'">';
   if ($ae->sortorderb=="asc")
      {
      echo '<img src="images/asc.gif" alt="',$ae->textbasic[87],'" />';
      }
   else
      {
      echo '<img src="images/desc.gif" alt="',$ae->textbasic[87],'" />';
      }
   echo '</a></td>';
   echo '<td >';
   if ($ae->sortbyb=="CheckId") echo '<span title="',$ae->textbasic[88],'">*</span>';
   echo 'CheckId<a href="managerbonus.php?sortbyb=CheckId&sortorderb=',$ae->sortorderb,'&username=',$ae->username,'&session=',$ae->session,'" title="',$ae->textbasic[87],'">';
   if ($ae->sortorderb=="asc")
      {
      echo '<img src="images/asc.gif" alt="',$ae->textbasic[87],'" />';
      }
   else
      {
      echo '<img src="images/desc.gif" alt="',$ae->textbasic[87],'" />';
      }
   echo '</a></td>';
   
   echo '<td >';    
   
   if ($ae->sortbyb=="PrizeCode") echo '<span title="',$ae->textbasic[88],'">*</span>';
   echo '兌換獎項代碼<a href="managerbonus.php?sortbyb=PrizeCode&sortorderb=',$ae->sortorderb,'&username=',$ae->username,'&session=',$ae->session,'" title="',$ae->textbasic[87],'">';
   if ($ae->sortorderb=="asc")
      {
      echo '<img src="images/asc.gif" alt="',$ae->textbasic[87],'" />';
      }
   else
      {
      echo '<img src="images/desc.gif" alt="',$ae->textbasic[87],'" />';
      }
   echo '</a></td>';
   echo '<td >';
   if ($ae->sortbyb=="ValidDate") echo '<span title="',$ae->textbasic[88],'">*</span>';
   echo '有效日期<a href="managerbonus.php?sortbyb=ValidDate&sortorderb=',$ae->sortorderb,'&username=',$ae->username,'&session=',$ae->session,'" title="',$ae->textbasic[87],'">';
   if ($ae->sortorderb=="asc")
      {
      echo '<img src="images/asc.gif" alt="',$ae->textbasic[87],'" />';
      }
   else
      {
      echo '<img src="images/desc.gif" alt="',$ae->textbasic[87],'" />';
      }
   echo '</a></td>';
   echo '<td >';
   if ($ae->sortbyb=="TranCode") echo '<span title="',$ae->textbasic[88],'">*</span>';
   echo '交易序號<a href="managerbonus.php?sortbyb=TranCode&sortorderb=',$ae->sortorderb,'&username=',$ae->username,'&session=',$ae->session,'" title="',$ae->textbasic[87],'">';
   if ($ae->sortorderb=="asc")
      {
      echo '<img src="images/asc.gif" alt="',$ae->textbasic[87],'" />';
      }
   else
      {
      echo '<img src="images/desc.gif" alt="',$ae->textbasic[87],'" />';
      }
   echo '</a></td>';
   echo '<td >點數</td>';
   echo '</tr>';
   echo '</thead>';
   echo '<tbody>';
   while ($ae->DBGetRow())
         {
         $temp=$ae->outcome;
         $articleID=$ae->access["Id"];
         $UseDate=$ae->access["UseDate"];
         $UseTime=$ae->access["UseTime"];
         $CheckId=$ae->access["CheckId"];
         $PrizeCode=$ae->access["PrizeCode"];
         $ValidDate=$ae->access["ValidDate"];
         $TranCode=$ae->access["TranCode"];
         $Point=$ae->access["Point"];
         echo '<td>';
         echo $ae->access["Id"];
         echo '</td><td>';
         echo $ae->DateConversion($UseDate,2);
         echo ' ';
         echo $UseTime;
         echo '</td><td>';
         echo $CheckId;
         echo '</td><td>';
         echo $PrizeCode;
         echo '</td><td>';
         echo $ValidDate;
         echo '</td><td>';
         echo $TranCode;
         echo '</td><td>';
         echo $Point;
         echo '</td>';
         echo '</tr>';
         $ae->outcome=$temp;
         }
   echo '</tbody>';
   echo '</table>';
   }
echo '</div>';
@include("footer.php");
?>