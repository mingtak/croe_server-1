<?
@include("coreclass.php");
$ae=new CEngine();
$ae->RequestVariables();
$ae->EngineInitialize();
$ae->UserVerifySession();
$ae->UserVerifyLevel(3);
if ($ae->currentuserposition<>1 AND $ae->currentuserID<>$ae->userID) $ae->DisplayError(12);
$ae->DBQuery("SELECT * FROM ".$ae->table[5]." WHERE ID='".$ae->userID."'");
$ae->DBGetRow();
$user=$ae->access["user"];
$fullname=$ae->access["fullname"];
$email=$ae->access["email"];
$position=$ae->access["position"];
$language=$ae->access["language"];
$photo=$ae->access["photo"];
if ($photo) $thumbnail=$ae->GetThumbnailName($photo);
$otherinfo=$ae->access["otherinfo"];
@include("header.php");
@include("menu.php");
?>
<div id="content">
<form method="post" action="modify.php?command=<? if ($ae->currentuserposition==1) echo 52; else echo 4; ?>" enctype="multipart/form-data">
<fieldset><legend><? echo $ae->textbasic[58]; ?></legend>
<label for="name"><? echo $ae->textbasic[0]; ?></label>
<input type="text" name="name" id="name" size="30" readonly="readonly" value="<? echo $user; ?>" class="noborder" /><br class="clear" />
<label for="password"><? echo $ae->textbasic[1]; ?></label>
<input type="password" name="password" id="password" size="30" /><br class="clear" />
<label for="password2"><? echo $ae->textbasic[2]; ?></label>
<input type="password" name="password2" id="password2" size="30" /><br class="clear" />
<label for="fullname"><? echo $ae->textbasic[3]; ?></label>
<input type="text" name="fullname" id="fullname" size="50" value="<? echo $fullname; ?>" /><br class="clear" />
<label for="email"><? echo $ae->textbasic[27]; ?></label>
<input type="text" name="email" id="email" size="30" maxlength="255" value="<? echo $email; ?>" /><br class="clear" />
<label for="position"><? echo $ae->textbasic[4]; ?></label>
<?
if ($ae->currentuserposition<>1)
{
if ($ae->currentuserposition==1) echo $ae->textbasic[5];
if ($ae->currentuserposition==2) echo $ae->textbasic[6];
if ($ae->currentuserposition==3) echo $ae->textbasic[7];
if ($ae->currentuserposition==4) echo $ae->textbasic[146],' (4)';
if ($ae->currentuserposition==5) echo $ae->textbasic[146],' (5)';
}
else
{
echo '<select name="position" id="position">';
echo '<option value="1"'; if ($position==1) echo ' selected';
echo '>',$ae->textbasic[5],'</option>';
echo '<option value="2"'; if ($position==2) echo ' selected';
echo '>',$ae->textbasic[6],'</option>';
echo '<option value="3"'; if ($position==3) echo ' selected';
echo '>',$ae->textbasic[7],'</option>';
echo '<option value="4"'; if ($position==4) echo ' selected';
echo '>',$ae->textbasic[146],' (4)</option>';
echo '<option value="5"'; if ($position==5) echo ' selected';
echo '>',$ae->textbasic[146],' (5)</option>';
echo '</select>';
}
?>
<br class="clear" />
<label for="language"><? echo $ae->textbasic[26]; ?></label>
<select name="language" id="language">
<?
$languagearray=$ae->RequestLanguageVersions();
while (list($key,$optionvalue)=each($languagearray))
{
echo '<option value="',$optionvalue,'"';
if ($optionvalue==$language) echo ' selected';
echo '>',$optionvalue,'</option>';
}
?>
</select>
<br class="clear" />
<label for="file"><? echo $ae->textbasic[30]; ?></label>
<input type="file" name="file" id="file" size="50" /><br class="clear" />
<?
if ($photo)
   {
   echo ' <a href="',$ae->pathimages,$photo,'"><img src="',$ae->pathimages,$thumbnail,'" class="preview"></a> ';
   echo ' <input type="checkbox" name="delete" id="delete" value="1" /><label for="delete" class="nofloat">',$ae->textbasic[110],' ',$photo,'</label><br class="clear" />';
   }
?>
<label for="otherinfo"><? echo $ae->textbasic[31]; ?></label>
<textarea cols="78" rows="5" name="otherinfo" id="otherinfo"><? echo $otherinfo; ?></textarea><br class="clear" />
<label for="submit"></label>
<input type="submit" name="submit" id="submit" value="<? echo $ae->textbasic[103]; ?>" class="button" />
<input type="hidden" name="userID" value="<? echo $ae->userID; ?>" />
<input type="hidden" name="username" value="<? echo $ae->username; ?>" />
<input type="hidden" name="session" value="<? echo $ae->session; ?>" />
<input type="hidden" name="MAX_FILE_SIZE" value="<? echo $ae->sizemaximages; ?>" />
</fieldset>
</form>
</div>
<? @include("footer.php"); ?>