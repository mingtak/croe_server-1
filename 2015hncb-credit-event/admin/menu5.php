<?
echo '<h2>Affiliate system</h2>';
echo '<ul>';
$ae->DBQuery("SELECT * FROM ".$ae->table[8]." WHERE menu5='1' ORDER BY module");
while ($ae->DBGetRow())
      {
      $temp=$ae->outcome;
      $moduledir=TEMPDIR."modules/".$ae->access["directory"];
      $menuitem=join('',file($moduledir.'/menu5.php'));
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