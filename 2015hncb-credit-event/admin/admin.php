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
if ($ae->filtdatefrom) $ae->filtdatefrom=$ae->DateConversion($ae->filtdatefrom);
if ($ae->filtdateto) $ae->filtdateto=$ae->DateConversion($ae->filtdateto);
setcookie('filtarticlenumber',$ae->filtarticlenumber,time()+999999999,'/');
setcookie('filtTranType',$ae->filtTranType,time()+999999999,'/');
// setcookie('filtuserID',$ae->filtuserID,time()+999999999,'/');
if (isset($ae->filtdatefrom)) setcookie('filtdatefrom',$ae->filtdatefrom,time()+999999999,'/');
if (isset($ae->filtdateto)) setcookie('filtdateto',$ae->filtdateto,time()+999999999,'/');
if ($ae->filtTranType)
   {
   $condition.=" AND TranType = '".$ae->filtTranType."'";
   }
if ($ae->filtdatefrom)
   {
   $condition.=" AND TranDate>='".$ae->filtdatefrom."'";
   }
if ($ae->filtdateto)
   {
   $condition.=" AND TranDate<='".$ae->filtdateto."'";
   }
if ($ae->filtCheckID)
   {
   $condition.=" AND CheckID='".$ae->filtCheckID."'";
   }
$condition.=" GROUP BY ID ORDER BY ";
if ($ae->sortby=="date")
   {
   setcookie('sortby','date',time()+999999999,'/');
   setcookie('sortorder',$ae->sortorder,time()+999999999,'/');
   if ($ae->sortorder=="asc") $ae->sortorder="desc"; else $ae->sortorder="asc";
   $condition.="TranDate ".$ae->sortorder.",TranTime ".$ae->sortorder;
   }
elseif ($ae->sortby=="TranType")
   {
   setcookie('sortby','TranType',time()+999999999,'/');
   setcookie('sortorder',$ae->sortorder,time()+999999999,'/');
   if ($ae->sortorder=="asc") $ae->sortorder="desc"; else $ae->sortorder="asc";
   $condition.="TranType ".$ae->sortorder;
   }
elseif ($ae->sortby=="CheckID")
   {
   setcookie('sortby','CheckID',time()+999999999,'/');
   setcookie('sortorder',$ae->sortorder,time()+999999999,'/');
   if ($ae->sortorder=="asc") $ae->sortorder="desc"; else $ae->sortorder="asc";
   $condition.="CheckID ".$ae->sortorder;
   }
elseif ($ae->sortby=="Status")
   {
   setcookie('sortby','Status',time()+999999999,'/');
   setcookie('sortorder',$ae->sortorder,time()+999999999,'/');
   if ($ae->sortorder=="asc") $ae->sortorder="desc"; else $ae->sortorder="asc";
   $condition.="Status ".$ae->sortorder;
   }
else
   {
   $condition.="TranDate DESC, TranTime DESC";
   }
@include("header.php");

@include("menu.php");

echo '<div id="content">';

if ($ae->currentuserposition<=3) @include('filter.php');

//$ae->DisplayEngineModuleParts();

if ($ae->currentuserposition<=3)
   {
   if (!$ae->filtarticlenumber) $ae->filtarticlenumber=20;
   
   $ae->DBQuery("SELECT * FROM ".$ae->table[3]. " WHERE ".$condition);
   
   $RowNumber=$ae->rowsnumber;
   $NumPerPage=  $ae->filtarticlenumber;
   $LastPage =  intval(($RowNumber-1)/$NumPerPage) +1;
   
   if (!isset($ae->offset))
      $ae->offset=0;
      
   $PageStart=(intval($ae->offset /$NumPerPage))+1;
   $PageCurrent=$PageStart;
   $PageStart= (intval(($PageStart-1) /10)*10)+1; 
   $condition.=" LIMIT " . $ae->offset . "," .$ae->filtarticlenumber;
   
   $ae->DBQuery("SELECT * FROM ".$ae->table[3]."  WHERE ".$condition);
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
 
//   $condition.=" LIMIT ".$ae->filtarticlenumber;
//   $ae->DBQuery("SELECT * FROM ".$ae->table[3]. " WHERE ".$condition);
   echo '<table width="98%">';
   echo '<thead>';
   echo '<tr>';
   echo '<td>ID</td>';
   echo '<td>';
   if ($ae->sortby=="date" OR !$ae->sortby) echo '<span class="help" title="',$ae->textbasic[88],'">*</span>';
   echo $ae->textbasic[22],'<a href="admin.php?sortby=date&sortorder=',$ae->sortorder,'&username=',$ae->username,'&session=',$ae->session,'" title="',$ae->textbasic[87],'">';
   if ($ae->sortorder=="asc")
      {
      echo '<img src="images/asc.gif" alt="',$ae->textbasic[87],'" />';
      }
   else
      {
      echo '<img src="images/desc.gif" alt="',$ae->textbasic[87],'" />';
      }
   echo '</a></td>';
   echo '<td >';
   if ($ae->sortby=="TranType") echo '<span title="',$ae->textbasic[88],'">*</span>';
   echo $ae->textbasic[23],'<a href="admin.php?sortby=TranType&sortorder=',$ae->sortorder,'&username=',$ae->username,'&session=',$ae->session,'" title="',$ae->textbasic[87],'">';
   if ($ae->sortorder=="asc")
      {
      echo '<img src="images/asc.gif" alt="',$ae->textbasic[87],'" />';
      }
   else
      {
      echo '<img src="images/desc.gif" alt="',$ae->textbasic[87],'" />';
      }
   echo '</a></td>';
   echo '<td >';
   if ($ae->sortby=="TranNo") echo '<span title="',$ae->textbasic[88],'">*</span>';
   echo $ae->textbasic[33],'<a href="admin.php?sortby=TranNo&sortorder=',$ae->sortorder,'&username=',$ae->username,'&session=',$ae->session,'" title="',$ae->textbasic[87],'">';
   if ($ae->sortorder=="asc")
      {
      echo '<img src="images/asc.gif" alt="',$ae->textbasic[87],'" />';
      }
   else
      {
      echo '<img src="images/desc.gif" alt="',$ae->textbasic[87],'" />';
      }
   echo '</a></td>';
   echo '<td >';
   if ($ae->sortby=="TranAmount") echo '<span title="',$ae->textbasic[88],'">*</span>';
   echo $ae->textbasic[167],'<a href="admin.php?sortby=TranAmount&sortorder=',$ae->sortorder,'&username=',$ae->username,'&session=',$ae->session,'" title="',$ae->textbasic[87],'">';
   if ($ae->sortorder=="asc")
      {
      echo '<img src="images/asc.gif" alt="',$ae->textbasic[87],'" />';
      }
   else
      {
      echo '<img src="images/desc.gif" alt="',$ae->textbasic[87],'" />';
      }
   echo '</a></td>';
   echo '<td >交易次數</td><td>';
   if ($ae->sortby=="GovFlag") echo '<span title="',$ae->textbasic[88],'">*</span>';
   echo '公教註記<a href="admin.php?sortby=GovFlag&sortorder=',$ae->sortorder,'&username=',$ae->username,'&session=',$ae->session,'" title="',$ae->textbasic[87],'">';
   if ($ae->sortorder=="asc")
      {
      echo '<img src="images/asc.gif" alt="',$ae->textbasic[87],'" />';
      }
   else
      {
      echo '<img src="images/desc.gif" alt="',$ae->textbasic[87],'" />';
      }
   echo '</a></td>';
   echo '<td >點數</td><td>';
   if ($ae->sortby=="Status") echo '<span title="',$ae->textbasic[88],'">*</span>';
   echo '客戶確認註記<a href="admin.php?sortby=Status&sortorder=',$ae->sortorder,'&username=',$ae->username,'&session=',$ae->session,'" title="',$ae->textbasic[87],'">';
   if ($ae->sortorder=="asc")
      {
      echo '<img src="images/asc.gif" alt="',$ae->textbasic[87],'" />';
      }
   else
      {
      echo '<img src="images/desc.gif" alt="',$ae->textbasic[87],'" />';
      }
   echo '</a></td>';
   
   echo '</tr>';
   echo '</thead>';
   echo '<tbody>';
   while ($ae->DBGetRow())
         {
         $temp=$ae->outcome;
         $articleID=$ae->access["Id"];
         $TranDate=$ae->access["TranDate"];
         $TranTime=$ae->access["TranTime"];
         $TranType=$ae->access["TranType"];
         $TranNo=$ae->access["TranNo"];
         $TranAmount=$ae->access["TranAmount"];
         $TranCount=$ae->access["TranCount"];
         $GovFlag=$ae->access["GovFlag"];
         $Point=$ae->access["Point"];
         $Status=$ae->access["Status"];
         echo '<td>';
         echo $ae->access["CheckID"];
         echo '</td><td>';
         echo $ae->DateConversion($TranDate,2);
         echo ' ';
         echo $TranTime;
         echo '</td><td>';
         echo $ae->access["TranType"];
         echo '</td><td>';
         echo $ae->access["TranNo"];
         echo '</td><td>';
         echo $ae->access["TranAmount"];
         echo '</td><td>';
         echo $ae->access["TranCount"];
         echo '</td><td>';
         echo $ae->access["GovFlag"];
         echo '</td><td>';
         echo $ae->access["Point"];
         echo '</td><td>';
         echo $ae->access["Status"];
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