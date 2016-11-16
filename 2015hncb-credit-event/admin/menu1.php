<?
echo '<h2>',$ae->textbasic[56],'</h2>';
echo '<ul>';
echo '<li><a href="',TEMPDIR,'adduser.php?username=',$ae->username,'&session=',$ae->session,'">',$ae->textbasic[57],'</a></li>';
echo '<li><form method="post" action="',TEMPDIR,'modify.php?command=50">';
echo '<label for="userID">',$ae->textbasic[58],'</label><br class="clear" />';
$ae->DBQuery("SELECT * FROM ".$ae->table[5]." ORDER BY fullname");
echo '<select name="userID" id="userID">';
while ($ae->DBGetRow())
      {
      $optionvalue=$ae->access["ID"];
      $optiontext=$ae->access["fullname"];
      echo '<option value="',$optionvalue,'">',$optiontext,'</option>';
      }
echo '</select><br class="clear" />';
echo '<label for="submit"></label>';
echo '<input type="submit" name="submit" value="',$ae->textbasic[106],'" class="button" />';
echo '<input type="submit" name="submit" id="submit" value="',$ae->textbasic[110],'" onclick="return ConfirmAction(\'',$ae->textbasic[53],'\')" class="button" />';
echo '<input type="hidden" name="username" value="',$ae->username,'" />';
echo '<input type="hidden" name="session" value="',$ae->session,'" />';
echo '</fieldset></form>';
echo '</li>';
//echo '<li><a href="',TEMPDIR,'managermodule.php?username=',$ae->username,'&session=',$ae->session,'">',$ae->textbasic[34],'</a></li>';
$ae->DBQuery("SELECT * FROM ".$ae->table[8]." WHERE menu1='1' ORDER BY module");
while ($ae->DBGetRow())
      {
      $temp=$ae->outcome;
      $moduledir=TEMPDIR."modules/".$ae->access["directory"];
      $menuitem=join('',file($moduledir.'/menu1.php'));
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