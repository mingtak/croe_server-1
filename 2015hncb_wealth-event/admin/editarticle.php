<?
define('INCLUDEWYSIWYG',1);
@include("coreclass.php");
$ae=new CArticles();
$ae->RequestVariables();
$ae->EngineInitialize();
$ae->UserVerifySession();
$ae->UserVerifyLevel(3);
$ae->DBQuery("SELECT * FROM ".$ae->table[3]." WHERE ID='".$ae->articleID."'");
$ae->DBGetRow();
$articleID=$ae->access["ID"];
$title=$ae->access["title"];
$text=$ae->access["text"];
$authorID=$ae->access["authorID"];
$imagesetID=$ae->access["imagesetID"];
$filesetID=$ae->access["filesetID"];
$priority=$ae->access["priority"];
$status=$ae->access["status"];
$adate=$ae->access["adate"];
$adate=$ae->DateConversion($adate,2);
$atime=$ae->access["atime"];
$filename=$ae->access["filename"];
@include("header.php");
@include("menu.php");
?>
<div id="content">
<?
$object=$ae->DisplayError(8);
?>
<form method="post" action="modify.php?command=3">
<fieldset><legend></legend>
<label for="title"><? echo $ae->textbasic[117] ?></label>
<input type="text" name="title" value="<? echo $title ?>" size="78" /><br class="clear" />
<label for="text"><? echo $ae->textbasic[119] ?></label>
<?
$ae->text=$text;
if (!$ae->wysiwygeditor)
   {
   echo '<textarea name="text" id="text" cols="70" rows="20">',$ae->text,'</textarea>';
   }
else
   {
   include($ae->wysiwygeditor."edit.php");
   }
?>
<br class="clear" />
<? if ($ae->cleanurls): ?>
<label for="filename"><? echo $ae->textbasic[54]; ?></label>
<input type="text" name="filename" size="60" value="<? echo $filename; ?>" /><br class="clear" />
<? endif; ?>
<label for="authorID"><? echo $ae->textbasic[120]; ?></label>
<?
$ae->DBQuery("SELECT fullname FROM ".$ae->table[5]." WHERE ID='$authorID'");
$ae->DBGetRow();
$author=$ae->access["fullname"];
echo '<input type="text" name="status" id="status" size="30" readonly="readonly" value="',$author,'" class="noborder" />';
?><br class="clear" />
<label for="adate"><? echo $ae->textbasic[121] ?></label>
<input type="text" name="adate" value="<? echo $adate; ?>" size="10" maxlength="10" /><br class="clear" />
<label for="atime"><? echo $ae->textbasic[126] ?></label>
<input type="text" name="atime" value="<? echo $atime; ?>" size="8" maxlength="8" /><br class="clear" />
<label for="sectionID"><? echo $ae->textbasic[122] ?></label><br class="clear" />
<?
/*
$ae->DBQuery("SELECT ID FROM ".$ae->table[0]);
$size=$ae->rowsnumber;
<select name="sectionID[]" id="sectionID" multiple="multiple" size="<? echo $size; ?>">
*/
?>
<?
$ae->LoopThroughSectionList(0,3);
?>
<? /* </select> */ ?><br class="clear" />
<label for="imagesetID"><? echo $ae->textbasic[123] ?></label>
<select name="imagesetID">
<option value="0"><? echo $ae->textbasic[125] ?></option>
<?
$ae->DBQuery("SELECT * FROM ".$ae->table[13]." ORDER BY description");
while ($ae->DBGetRow())
{
$optionvalue=$ae->access["ID"];
$optiontext=$ae->access["description"];
echo '<option value="',$optionvalue,'"';
if ($imagesetID==$optionvalue) echo ' selected';
echo '>',$optiontext,'</option>';
}
?>
</select><br class="clear" />
<label for="filesetID"><? echo $ae->textbasic[124] ?></label>
<select name="filesetID">
<option value="0"><? echo $ae->textbasic[127] ?></option>
<?
$ae->DBQuery("SELECT * FROM ".$ae->table[12]." ORDER BY description");
while ($ae->DBGetRow())
{
$optionvalue=$ae->access["ID"];
$optiontext=$ae->access["description"];
echo '<option value="',$optionvalue,'"';
if ($filesetID==$optionvalue) echo ' selected';
echo '>',$optiontext,'</option>';
}
?>
</select><br class="clear" />
<label for="priority"><? echo $ae->textbasic[128] ?></label>
<select name="priority">
<option value="0"<? if (!$priority) echo ' selected'; ?>><? echo $ae->textbasic[130] ?></option>
<option value="1"<? if ($priority) echo ' selected'; ?>><? echo $ae->textbasic[131] ?></option>
</select><br class="clear" />
<label for="status"><? echo $ae->textbasic[129] ?></label>
<?
if ($ae->currentuserposition>2)
{
if (!$status) echo $ae->textbasic[132];
else echo $ae->textbasic[132];
}
else
{
echo '<select name="status">';
echo '<option value="0"';
if (!$status) echo ' selected';
echo '>',$ae->textbasic[132],'</option>';
echo '<option value="1"';
if ($status) echo ' selected';
echo '>',$ae->textbasic[133],'</option>';
echo '</select>';
}
?>
<br class="clear" />
<label for="submit"></label>
<?
echo '<input type="submit" name="submit" value="',$ae->textbasic[103],'"';
if ($ae->wysiwygeditor AND file_exists($ae->wysiwygeditor."hooks.txt"))
   {
   $hooks=join("",file($ae->wysiwygeditor."hooks.txt"));
   echo $hooks;
   }
echo ' class="button" />';
?>
<input type="hidden" name="username" value="<? echo $ae->username; ?>" />
<input type="hidden" name="session" value="<? echo $ae->session; ?>" />
<input type="hidden" name="articleID" value="<? echo $ae->articleID; ?>" />
<input type="hidden" name="authorID" value="<? echo $authorID; ?>" />
</fieldset>
</form>
</div>
<? @include("footer.php") ?>