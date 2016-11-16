<?
$section=""; $filename="";
@include("coreclass.php");
$ae=new CArticles();
$ae->RequestVariables();
$ae->EngineInitialize();
$ae->UserVerifySession();
$ae->UserVerifyLevel(2);
$ae->DBQuery("SELECT * FROM ".$ae->table[0]." WHERE ID='".$ae->sectionID."'");
$ae->DBGetRow();
$section=$ae->access["section"];
$parentsectionID=$ae->access["parentsectionID"];
$articleID=$ae->access["articleID"];
$filename=$ae->access["filename"];
@include("header.php");
@include("menu.php");
if (isset($object->section)) $section=$object->section;
if (isset($object->parentsectionID)) $ae->sectionID=$object->parentsectionID;
if (isset($object->filename)) $filename=$object->filename;
?>
<div id="content">
<?
$object=$ae->DisplayError(8);
?>
<div id="left">
<fieldset><legend><? echo $ae->textbasic[81]; ?></legend>
<?
$ae->LoopThroughSectionList(0,1);
?>
<?
if ($ae->sectionID)
   {
   $ae->DBQuery("SELECT * FROM ".$ae->table[0]." WHERE ID='".$ae->sectionID."'");
   $ae->DBGetRow();
   $section=$ae->access["section"];
   $parentsectionID=$ae->access["parentsectionID"];
   $filename=$ae->access["filename"];
   }
?>
</fieldset>
</div>
<div id="right">
<form method="post" action="modify.php?command=<? if (!$ae->sectionID) echo '31'; else echo '33'; ?>">
<fieldset><legend><? if (!$ae->sectionID) echo $ae->textbasic[82]; else echo $ae->textbasic[145]; ?></legend>
<label for="section"><? echo $ae->textbasic[83]; ?></label>
<input type="text" name="section" id="section" size="40" value="<? echo $section; ?>" /><br class="clear" />
<label for="parentsectionID"><? echo $ae->textbasic[143]; ?></label>
<select name="parentsectionID">
<option value="0"><? echo $ae->textbasic[144]; ?></option>
<?
$ae->LoopThroughSectionList(0,2);
?>
</select>
<br class="clear" />
<label for="articleID"><? echo $ae->textbasic[40]; ?></label>
<select name="articleID" id="articleID">
<option> </option>
<?
$ae->DBQuery("SELECT ID,title FROM ".$ae->table[3]." ORDER BY title");
while ($ae->DBGetRow())
      {
      $optionvalue=$ae->access["ID"];
      $optiontext=$ae->access["title"];
      echo '<option value="',$optionvalue,'"';
      if ($articleID==$optionvalue) echo ' selected="selected"';
      echo '>',$optiontext,'</option>';
      }
?>
</select><br class="clear" />
<?
if ($ae->cleanurls==2)
   {
   echo '<label for="filename">',$ae->textbasic[54],'</label>';
   echo '<input type="text" name="filename" size="40" value="',$filename,'" /><br class="clear" />';
   }
?>
<label for="submit"></label>
<input type="submit" name="submit" id="submit" value="<? echo $ae->textbasic[103] ?>" class="button" />
<input type="hidden" name="username" value="<? echo $ae->username; ?>" />
<input type="hidden" name="session" value="<? echo $ae->session; ?>" />
<input type="hidden" name="sectionID" value="<? echo $ae->sectionID; ?>" />
</fieldset>
</form>
</div>
</div>
<? @include("footer.php"); ?>