<?
@include("coreclass.php");
$ae=new CEngine();
$ae->RequestVariables();
$ae->EngineInitialize();
$ae->UserVerifySession();
$ae->UserVerifyLevel();
@include("header.php");
@include("menu.php");
?>
<div id="content">
<?
$ae->DBQuery("SELECT * FROM ".$ae->table[8]." ORDER BY module");
if ($ae->rowsnumber)
   {
   echo '<form method="post" action="modify.php?command=53">';
   echo '<fieldset><legend>',$ae->textbasic[51],'</legend>';
   echo '<table width="98%">';
   echo '<thead>';
   echo '<tr>';
   echo '<td><h2>',$ae->textbasic[63],'</h2></td>';
   echo '<td><h2>',$ae->textbasic[90],'</h2></td>';
   echo '</tr>';
   echo '</thead>';
   echo '<tbody>';
   $i=0;
   while ($ae->DBGetRow())
         {
         echo '<tr>';
         echo '<td><input type="checkbox" name="modules[',$i,']" id="modules[',$i,']" value="',$ae->access["directory"],'" /> <label for="modules[',$i,']">',$ae->access["module"],'</label></td>';
         echo '<td>',$ae->access["description"],'</td>';
         echo '</tr>';
         $i++;
         }
   echo '</tbody>';
   echo '</table>';
   echo '<p class="warning"><span>!</span>',$ae->textbasic[36],'<br class="clear" /></p>';
   echo '<input type="checkbox" name="leavedb" id="leavedb" value="1" /><label for="leavedb" class="nofloat">',$ae->textbasic[152],'</label><br class="clear" />';
   echo '<input type="submit" value="',$ae->textbasic[92],'" onclick="return ConfirmAction(\'',$ae->textbasic[53],'\')" class="button" />';
   echo '<input type="hidden" name="username" value="',$ae->username,'" />';
   echo '<input type="hidden" name="session" value="',$ae->session,'" />';
   echo '</fieldset>';
   echo '</form>';
   }
$modules=$ae->RetrieveModules();
foreach ($modules as $key=>$value)
        {
        $ae->DBQuery("SELECT * FROM ".$ae->table[8]." WHERE directory='".$value["moduledir"]."'");
        if ($ae->rowsnumber) unset($modules[$key]);
        }
if ($modules)
   {
   echo '<form method="post" action="modify.php?command=54">';
   echo '<fieldset><legend>',$ae->textbasic[35],'</legend>';
   echo '<table width="98%">';
   echo '<thead>';
   echo '<tr>';
   echo '<td><h2>',$ae->textbasic[63],'</h2></td>';
   echo '<td><h2>',$ae->textbasic[90],'</h2></td>';
   echo '</tr>';
   echo '</thead>';
   echo '<tbody>';
   $i=0;
   foreach ($modules as $value)
           {
           $ae->DBQuery("SELECT * FROM ".$ae->table[8]." WHERE directory='".$value["moduledir"]."'");
           if ($ae->rowsnumber) continue;
           echo '<tr>';
           echo '<td><input type="checkbox" name="modules[',$i,']" id="availmodules[',$i,']" value="',$value["moduledir"],'" /> <label for="availmodules[',$i,']">',$value["name"],'</label></td>';
           echo '<td>',$value["description"],'</td>';
           echo '</tr>';
           $i++;
           }
   echo '</tbody>';
   echo '</table>';
   echo '<p class="warning"><span>!</span>',$ae->textbasic[118],'<br class="clear" /></p>';
   echo '<input type="checkbox" name="leavedb" id="leavedb" value="1" /><label for="leavedb" class="nofloat">',$ae->textbasic[152],'</label><br class="clear" />';
   echo '<input type="submit" value="',$ae->textbasic[52],'" class="button" />';
   echo '<input type="hidden" name="username" value="',$ae->username,'" />';
   echo '<input type="hidden" name="session" value="',$ae->session,'" />';
   echo '</fieldset>';
   echo '</form>';
   }
?>
</div>
<? @include("footer.php"); ?>