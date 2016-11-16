<?
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
<div id="left">
<form method="post" action="managerrelated.php">
<fieldset><legend><? echo $ae->textbasic[44]; ?></legend>
<label for="title"><? echo $ae->textbasic[40]; ?></label>
<input type="text" name="title" id="title" size="20" value="<? echo $ae->title; ?>" />
<br class="clear" />
<label for="submit"></label>
<input type="submit" name="submit" id="submit" value="<? echo $ae->textbasic[116]; ?>" class="button" />
<input type="hidden" name="username" value="<? echo $ae->username; ?>" />
<input type="hidden" name="session" value="<? echo $ae->session; ?>" />
<input type="hidden" name="action" value="show" />
</fieldset>
</form>
<? if ($ae->action=="show"): ?>
<?
if ($ae->title) $ae->DBQuery("SELECT * FROM ".$ae->table[3]." WHERE title LIKE '%".$ae->title."%' ORDER BY title");
else $ae->DBQuery("SELECT * FROM ".$ae->table[3]." WHERE ID='".$ae->articleID."'");
if ($ae->rowsnumber==1 OR $ae->articleID)
   {
   $ae->DBGetRow();
   $ae->articleID=$ae->access["ID"];
   echo '<form method="post" action="modify.php?command=14">';
   echo '<fieldset><legend>',$ae->textbasic[41],'</legend>';
   echo '<p><strong>',$ae->textbasic[40],'</strong> ',$ae->access["title"],'</p>';
   $ae->DBQuery("SELECT relart.relatedID AS relatedID,art.title AS title,art.text AS text FROM ".$ae->table[7]." AS relart LEFT JOIN ".$ae->table[3]." AS art ON relart.relatedID=art.ID WHERE relart.articleID='".$ae->articleID."'");
   if ($ae->rowsnumber)
      {
      echo '<table width="95%">';
      $i=0;
      while ($ae->DBGetRow())
            {
            echo '<tr>';
            $optionvalue=$ae->access["relatedID"];
            $optiontitle=$ae->access["title"];
            $optiontext=$ae->access["text"];
            echo '<td><input type="checkbox" name="relatedID[',$i,']" id="relatedID[',$i,']" value="',$optionvalue,'" /><label for="relatedID[',$i,']">',$optiontitle,'</label></td>';
            echo '<td>',substr(strip_tags($optiontext),0,300),'</label></td>';
            $i++;
            echo '</tr>';
            }
      echo '</table>';
      echo '<label for="submit"></label>';
      echo '<input type="submit" name="submit" id="submit" value="',$ae->textbasic[110],'" class="button" />';
      echo '<input type="hidden" name="username" value="',$ae->username,'" />';
      echo '<input type="hidden" name="session" value="',$ae->session,'" />';
      echo '<input type="hidden" name="articleID" value="',$ae->articleID,'" />';
      echo '</fieldset>';
      echo '</form>';
      }
   }
else
   {
   while ($ae->DBGetRow())
         {
         $articleID=$ae->access["ID"];
         $title=$ae->access["title"];
         echo '<a href="managerrelated.php?username=',$ae->username,'&session=',$ae->session,'&action=show&articleID=',$articleID,'">',$title,'</a><br />';
         }
   }
?>
<? endif; ?>
</div>
<div id="right">
<form method="post" action="modify.php?command=15">
<fieldset><legend><? echo $ae->textbasic[43] ?></legend>
<label for="articleID"><? echo $ae->textbasic[40] ?></label>
<select name="articleID" id="articleID">
<option value="0"<? if (!$ae->articleID) echo " selected"; ?>><? echo $ae->textbasic[39]; ?>
<?
$ae->DBQuery("SELECT * FROM ".$ae->table[3]." ORDER BY title");
while ($ae->DBGetRow())
      {
      $optionvalue=$ae->access["ID"];
      $optiontext=$ae->access["title"];
      echo '<option value="',$optionvalue,'"';
      if ($ae->articleID==$optionvalue) echo ' selected="selected"';
      echo '>',$optiontext,'</option>';
      }
?>
</select>
<br class="clear" />
<label for="title"><? echo $ae->textbasic[150]; ?></label>
<input type="text" name="title" id="title" size="30" value="<? echo $ae->title; ?>"><br class="clear" />
<label for="search"></label>
<input type="submit" name="submit" id="search" value="<? echo $ae->textbasic[112]; ?>" class="button" /><br class="clear" /><br class="clear" />
<?
if ($ae->title)
   {
   $ae->DBQuery("SELECT * FROM ".$ae->table[3]." WHERE title LIKE '%".$ae->title."%' AND ID<>'".$ae->articleID."' ORDER BY title");
   if ($ae->rowsnumber)
      {
      echo '<table width="95%">';
      $i=0;
      while ($ae->DBGetRow())
            {
            echo '<tr>';
            $optionvalue=$ae->access["ID"];
            $optiontitle=$ae->access["title"];
            $optiontext=$ae->access["text"];
            echo '<td title="',substr(strip_tags($optiontext),0,300),'"><input type="checkbox" name="relatedID[',$i,']" id="relatedID[',$i,']" value="',$optionvalue,'" /><label for="relatedID[',$i,']">',$optiontitle,'</label></td>';
            $i++;
            echo '</tr>';
            }
      echo '</table>';
      echo '<input type="submit" name="submit" id="submit" value="',$ae->textbasic[103],'" class="button" />';
      }
   }
?>
<input type="hidden" name="username" value="<? echo $ae->username; ?>" />
<input type="hidden" name="session" value="<? echo $ae->session; ?>" />
</fieldset>
</form>
</div>
</div>
<? @include("footer.php"); ?>