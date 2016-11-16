<?
echo '<h2>',$ae->textbasic[61],'</h2>';
echo '<ul>';
echo '<li><a href=manageruser.php?username=',$ae->username,'&session=',$ae->session,'">會員管理</a></li>';
$ae->DBQuery("SELECT * FROM ".$ae->table[8]." WHERE menu2='1' ORDER BY module");
while ($ae->DBGetRow())
      {
      $temp=$ae->outcome;
      $moduledir=TEMPDIR."modules/".$ae->access["directory"];
      $menuitem=join('',file($moduledir.'/menu2.php'));
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