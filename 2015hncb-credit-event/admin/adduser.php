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
$object=$ae->DisplayError(8);
?>
<form method="post" action="modify.php?command=51" enctype="multipart/form-data">
<fieldset><legend><? echo $ae->textbasic[57]; ?></legend>
<label for="user"><? echo $ae->textbasic[0] ?></label>
<input type="text" name="user" id="user" size="20" value="<? echo $object->user; ?>" /><br class="clear" />
<label for="password"><? echo $ae->textbasic[1] ?></label>
<input type="password" name="password" id="password" size="30"><br class="clear" />
<label for="password2"><? echo $ae->textbasic[2] ?></label>
<input type="password" name="password2" id="password2" size="30"><br class="clear" />
<label for="fullname"><? echo $ae->textbasic[3] ?></label>
<input type="text" name="fullname" id="fullname" size="50" value="<? echo $object->fullname; ?>" /><br class="clear" />
<label for="email"><? echo $ae->textbasic[27] ?></label>
<input type="text" name="email" id="email" size="30" value="<? echo $object->email; ?>" /><br class="clear" />
<label for="position"><? echo $ae->textbasic[4] ?></label>
<select name="position" id="position">
<option value="0"<? if (!$object->position) echo ' selected="selected"'; ?>><? echo $ae->textbasic[15] ?></option>
<option value="1"<? if ($object->position==1) echo ' selected="selected"'; ?>><? echo $ae->textbasic[5] ?></option>
<option value="2"<? if ($object->position==2) echo ' selected="selected"'; ?>><? echo $ae->textbasic[6] ?></option>
<option value="3"<? if ($object->position==3) echo ' selected="selected"'; ?>><? echo $ae->textbasic[7] ?></option>
<option value="4"<? if ($object->position==4) echo ' selected="selected"'; ?>><? echo $ae->textbasic[146] ?> (4)</option>
<option value="5"<? if ($object->position==5) echo ' selected="selected"'; ?>><? echo $ae->textbasic[146] ?> (5)</option>
</select><br class="clear" />
<label for="language"><? echo $ae->textbasic[26] ?></label>
<select name="language" id="language">
<?
$ae->RequestLanguageVersions();
while (list($key,$optionvalue)=each($ae->languagearray))
{
echo '<option value="',$optionvalue,'"';
if (!$object AND $optionvalue=="EN") echo ' selected="selected"';
elseif ($object->language==$optionvalue) echo ' selected="selected"';
echo '>',$optionvalue,'</option>';
}
?>
</select><br class="clear" />
<label for="file"><? echo $ae->textbasic[30] ?></label>
<input type="file" name="file" id="file" size="50"><br class="clear" />
<label for="otherinfo"><? echo $ae->textbasic[31] ?></label>
<textarea cols="78" rows="5" name="otherinfo" id="otherinfo"><? echo $object->otherinfo; ?></textarea>
<br class="clear" />
<label for="submit"></label>
<input type="submit" name="submit" id="submit" value="<? echo $ae->textbasic[103] ?>" class="button" />
<input type="hidden" name="username" value="<? echo $ae->username ?>" />
<input type="hidden" name="session" value="<? echo $ae->session ?>" />
<input type="hidden" name="MAX_FILE_SIZE" value="<? echo $ae->sizemaximages ?>">
</fieldset>
</form>
</div>
<? @include("footer.php");