<?
$ae->DBQuery("SELECT * FROM ".$ae->table[8]." WHERE menu4='1' ORDER BY module");
while ($ae->DBGetRow())
      {
      $temp=$ae->outcome;
      $moduledir=TEMPDIR."modules/".$ae->access["directory"];
      $menuitem=join('',file($moduledir.'/menu4.php'));
      $menuitem=str_replace('<a href="','<a href="'.$moduledir.'/',$menuitem);
      $menuitem=str_replace('action="','action="'.$moduledir.'/',$menuitem);
      $menuitem=str_replace('<?','',$menuitem);
      $menuitem=str_replace('<?php','',$menuitem);
      $menuitem=str_replace('?>','',$menuitem);
      eval ($menuitem);
      $ae->outcome=$temp;
      }
?>