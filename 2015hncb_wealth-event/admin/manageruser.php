<?
$condition=" 1 ";
@include("coreclass.php");
$ae=new CArticles();
$ae->RequestVariables();
$ae->EngineInitialize();

//$ae->UserVerifySession();
//$ae->UserVerifyLevel(4);

if ($ae->filtdatefrom) $ae->filtdatefrom=$ae->DateConversion($ae->filtdatefrom);
if ($ae->filtdateto) $ae->filtdateto=$ae->DateConversion($ae->filtdateto);
setcookie('filtarticlenumber',$ae->filtarticlenumber,time()+999999999,'/');
setcookie('filtUserName',$ae->filtUserName,time()+999999999,'/');
// setcookie('filtuserID',$ae->filtuserID,time()+999999999,'/');
if (isset($ae->filtdatefrom)) setcookie('filtdatefrom',$ae->filtdatefrom,time()+999999999,'/');
if (isset($ae->filtdateto)) setcookie('filtdateto',$ae->filtdateto,time()+999999999,'/');
if ($ae->filtUserName)
   {
   $condition.=" AND UserName Like '%".$ae->filtUserName."%'";
   }
if ($ae->filtdatefrom)
   {
   $condition.=" AND TranDate>='".$ae->filtdatefrom."'";
   }
if ($ae->filtdateto)
   {
   $condition.=" AND TranDate<='".$ae->filtdateto."'";
   }
if ($ae->filtCheckId)
   {
   $condition.=" AND CheckId LIKE '%".$ae->filtCheckId."%'";
   }
if ($ae->filtUserName)
   {
   $condition.=" AND UserName LIKE '%".$ae->filtUserName."%'";
   }
$condition.=" GROUP BY ID ORDER BY ";
if ($ae->sortby=="date")
   {
   setcookie('sortby','date',time()+999999999,'/');
   setcookie('sortorder',$ae->sortorder,time()+999999999,'/');
   if ($ae->sortorder=="asc") $ae->sortorder="desc"; else $ae->sortorder="asc";
   $condition.="RegDate ".$ae->sortorder . ",RegTime " . $ae->sortorder;
   }
elseif ($ae->sortby=="UserName")
   {
   setcookie('sortby','UserName',time()+999999999,'/');
   setcookie('sortorder',$ae->sortorder,time()+999999999,'/');
   if ($ae->sortorder=="asc") $ae->sortorder="desc"; else $ae->sortorder="asc";
   $condition.="UserName ".$ae->sortorder;
   }
elseif ($ae->sortby=="CheckId")
   {
   setcookie('sortby','CheckId',time()+999999999,'/');
   setcookie('sortorder',$ae->sortorder,time()+999999999,'/');
   if ($ae->sortorder=="asc") $ae->sortorder="desc"; else $ae->sortorder="asc";
   $condition.="CheckId ".$ae->sortorder;
   }
elseif ($ae->sortby=="ConfirmState")
   {
   setcookie('sortby','ConfirmState',time()+999999999,'/');
   setcookie('sortorder',$ae->sortorder,time()+999999999,'/');
   if ($ae->sortorder=="asc") $ae->sortorder="desc"; else $ae->sortorder="asc";
   $condition.="ConfirmState ".$ae->sortorder;
   }
else
   {
   $condition.="RegDate DESC, RegTime DESC";
   }
@include("header.php");

@include("menu.php");

echo '<div id="content">';

if ($ae->currentuserposition<=3) @include('filterc.php');

//$ae->DisplayEngineModuleParts();

if ($ae->currentuserposition<=3)
   {
   if (!$ae->filtarticlenumber) $ae->filtarticlenumber=20;
   
   $ae->DBQuery("SELECT * FROM HN_UserMessage WHERE ".$condition);
   
   $RowNumber=$ae->rowsnumber;
   $NumPerPage=  $ae->filtarticlenumber;
   $LastPage =  intval(($RowNumber-1)/$NumPerPage) +1;
   
   if (!isset($ae->offset))
      $ae->offset=0;
      
   $PageStart=(intval($ae->offset /$NumPerPage))+1;
   $PageCurrent=$PageStart;
   $PageStart= (intval(($PageStart-1) /10)*10)+1; 
   $condition.=" LIMIT " . $ae->offset . "," .$ae->filtarticlenumber;
   
   $ae->DBQuery("SELECT * FROM HN_UserMessage  WHERE ".$condition);
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
   echo $ae->textbasic[22],'<a href="manageruser.php?sortby=date&sortorder=',$ae->sortorder,'&username=',$ae->username,'&session=',$ae->session,'" title="',$ae->textbasic[87],'">';
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
   
   if ($ae->sortby=="UserName") echo '<span title="帳戶">*</span>';
   echo '帳戶<a href="manageruser.php?sortby=UserName&sortorder=',$ae->sortorder,'&username=',$ae->username,'&session=',$ae->session,'" title="帳戶">';
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
   
   if ($ae->sortby=="CheckId") echo '<span title="CheckId">*</span>';
   echo 'CheckId<a href="manageruser.php?sortby=CheckId&sortorder=',$ae->sortorder,'&username=',$ae->username,'&session=',$ae->session,'" title="CheckId">';
   if ($ae->sortorder=="asc")
      {
      echo '<img src="images/asc.gif" alt="',$ae->textbasic[87],'" />';
      }
   else
      {
      echo '<img src="images/desc.gif" alt="',$ae->textbasic[87],'" />';
      }
   echo '</a></td>';
   echo '<td >電話</td><td>';
   
   if ($ae->sortby=="ConfirmState") echo '<span title="',$ae->textbasic[88],'">*</span>';
   echo '確認匯出註記<a href="manageruser.php?sortby=ConfirmState&sortorder=',$ae->sortorder,'&username=',$ae->username,'&session=',$ae->session,'" title="',$ae->textbasic[87],'">';
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
     //HN_UserMessage (CheckId,UserName,Password,TelPhone,RegDate,RegTime,ConfirmState)    
         
         $temp=$ae->outcome;
         $articleID=$ae->access["Id"];
         $RegDate=$ae->access["RegDate"];
         $RegTime=$ae->access["RegTime"];
         $UserName=$ae->access["UserName"];
         $CheckId=$ae->access["CheckId"];
         $TelPhone=$ae->access["TelPhone"];
         $ConfirmState=$ae->access["ConfirmState"];
         
         echo '<td>';
         echo $ae->access["Id"];
         echo '</td><td>';
         echo $ae->DateConversion($RegDate,2);
         echo ' ';
         echo $RegTime;
         echo '</td><td>';
         echo $UserName;
         echo '</td><td>';
         echo $CheckId;
         echo '</td><td>';
         echo $TelPhone;
         echo '</td><td>';
         echo $ConfirmState;
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