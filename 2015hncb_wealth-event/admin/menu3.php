<?
echo '<h2>',$ae->textbasic[64],'</h2>';
echo '<ul>';
echo '<li><a href="',TEMPDIR,'admin.php?username=',$ae->username,'&session=',$ae->session,'">',$ae->textbasic[151],'</a></li>';
echo '<li><a href="',TEMPDIR,'addarticle.php?username=',$ae->username,'&session=',$ae->session,'">',$ae->textbasic[65],'</a></li>';
echo '<li><a href="',TEMPDIR,'generatebonus.php?username=',$ae->username,'&session=',$ae->session,'">',$ae->textbasic[69],'</a></li>';
echo '<li><a href="',TEMPDIR,'managerbonus.php?username=',$ae->username,'&session=',$ae->session,'">',$ae->textbasic[73],'</a></li>';
echo '<li><a href="',TEMPDIR,'exportbonus.php?username=',$ae->username,'&session=',$ae->session,'">',$ae->textbasic[70],'</a></li>';
echo '<li><a href="',TEMPDIR,'importpoint.php?username=',$ae->username,'&session=',$ae->session,'">匯入紅利集點檔</a></li>';
echo '<li><a href="',TEMPDIR,'edituser.php?username=',$ae->username,'&session=',$ae->session,'&userID=',$ae->currentuserID,'">',$ae->textbasic[68],'</a></li>';
$ae->DBQuery("SELECT * FROM ".$ae->table[8]." WHERE menu3='1' ORDER BY module");
while ($ae->DBGetRow())
      {
      $temp=$ae->outcome;
      $moduledir=TEMPDIR."modules/".$ae->access["directory"];
      $menuitem=join('',file($moduledir.'/menu3.php'));
      $menuitem=str_replace('<a href="','<a href="'.$moduledir.'/',$menuitem);
      $menuitem=str_replace('action="','action="'.$moduledir.'/',$menuitem);
      $menuitem=str_replace('<?','',$menuitem);
      $menuitem=str_replace('<?php','',$menuitem);
      $menuitem=str_replace('?>','',$menuitem);
      eval ($menuitem);
      $ae->outcome=$temp;
      }
echo '</ul>';
?>