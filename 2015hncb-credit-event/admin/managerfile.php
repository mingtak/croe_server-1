<?
$description="";
@include("coreclass.php");
$ae=new CEngine();
$ae->RequestVariables();
$ae->EngineInitialize();
$ae->UserVerifySession();
$ae->UserVerifyLevel(3);
if ($ae->filesetID)
   {
   $ae->DBQuery("SELECT * FROM ".$ae->table[12]." WHERE ID='".$ae->filesetID."'");
   $ae->DBGetRow();
   $description=$ae->access["description"];
   if (!$ae->uploadnumber)
      {
      $ae->DBQuery("SELECT * FROM ".$ae->table[2]." WHERE filesetID='".$ae->filesetID."'");
      $ae->uploadnumber=$ae->rowsnumber+1;
      }
   }
@include("header.php");
@include("menu.php");
if (!$ae->uploadnumber) $ae->uploadnumber=5;
for ($i=0;$i<$ae->uploadnumber;$i++)
    {
    $file[$i]="";
    }
?>
<div id="content">
<?
$object=$ae->DisplayError(8);
if ($object->description) $description=$object->description;
?>
<form method="post" action="modify.php?command=6">
<fieldset><legend><? echo $ae->textbasic[78]; ?></legend>
<label for="filesetID[]"><? echo $ae->textbasic[124]; ?></label>
<?
if ($ae->currentuserposition>2) @$ae->DBQuery("SELECT * FROM ".$ae->table[12]." WHERE authorID='".$ae->currentuserID."' ORDER BY description");
else @$ae->DBQuery("SELECT * FROM ".$ae->table[12]." ORDER BY description");
$size=$ae->rowsnumber;
if ($size<1) $size=1;
if ($size>15) $size=15;
echo '<select name="filesetID[]" id="filesetID[]" size="',$size,'" multiple="multiple">';
while ($ae->DBGetRow())
      {
      $optionvalue=$ae->access["ID"];
      $optiontext=$ae->access["description"];
      echo '<option value="',$optionvalue,'">',$optiontext,'</option>';
      }
?>
</select><br class="clear" />
<label for="submit"></label>
<input type="submit" name="submit" value="<? echo $ae->textbasic[106]; ?>" class="button" />
<input type="submit" name="submit" id="submit" value="<? echo $ae->textbasic[110]; ?>" onclick="return ConfirmAction('<? echo $ae->textbasic[53]; ?>')" class="button" />
<input type="hidden" name="username" value="<? echo $ae->username; ?>" />
<input type="hidden" name="session" value="<? echo $ae->session; ?>" />
</fieldset>
</form>
<form method="post" action="managerfile.php">
<fieldset>
<label for="uploadnumber"><? echo $ae->textbasic[148]; ?></label>
<input type="text" name="uploadnumber" id="uploadnumber" size="2" value="<? echo $ae->uploadnumber; ?>" />
<input type="submit" name="submit" value="<? echo $ae->textbasic[116]; ?>" class="button" />
<input type="hidden" name="username" value="<? echo $ae->username; ?>" />
<input type="hidden" name="session" value="<? echo $ae->session; ?>" />
<input type="hidden" name="filesetID" value="<? echo $ae->filesetID; ?>">
</fieldset>
</form>
<form method="post" action="modify.php?<? if (!$ae->filesetID) echo "command=7"; else echo "command=13"; ?>" enctype="multipart/form-data">
<fieldset><legend><? echo $ae->textbasic[124]; ?></legend>
<label for="description"><? echo $ae->textbasic[80] ?></label>
<input type="text" name="description" id="description" size="50" value="<? echo $description; ?>" /><br class="clear" />
<?
for ($i=0;$i<$ae->uploadnumber;$i++)
    {
    echo '<label for="file[',$i,']">#',$i+1,' ',$ae->textbasic[79],'</label>';
    echo '<input type="file" name="file[',$i,']" size="50" /><br class="clear" />';
    $ae->DBQuery("SELECT * FROM ".$ae->table[2]." WHERE filesetID='".$ae->filesetID."' ORDER BY ID LIMIT ".$i.",1");
    if ($ae->rowsnumber)
       {
       $ae->DBGetRow();
       echo '<label for="" class="description"></label>';
       echo ' <a href="',$ae->pathfiles,$ae->access["filename"],'">',$ae->access["filename"],'</a>';
       echo ' <input type="checkbox" name="delete[',$i,']" id="delete[',$i,']" value="',$ae->access["ID"],'" /><label for="delete[',$i,']" class="nofloat">',$ae->textbasic[110],'</label><br class="clear" />';
       }
    }
?>
<br class="clear" />
<label for="submit"></label>
<input type="submit" name="submit" id="submit" value="<? echo $ae->textbasic[103]; ?>" class="button" />
<input type="hidden" name="username" value="<? echo $ae->username; ?>" />
<input type="hidden" name="session" value="<? echo $ae->session; ?>" />
<input type="hidden" name="MAX_FILE_SIZE" value="<? echo $ae->sizemaxfiles; ?>" />
<input type="hidden" name="filesetID" value="<? echo $ae->filesetID; ?>" />
<input type="hidden" name="uploadnumber" value="<? echo $ae->uploadnumber; ?>" />
</fieldset>
</form>
</div>
<? @include("footer.php"); ?>