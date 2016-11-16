<?
$description=""; $filedescription="";
@include("coreclass.php");
$ae=new CEngine();
$ae->RequestVariables();
$ae->EngineInitialize();
$ae->UserVerifySession();
$ae->UserVerifyLevel(3);
if ($ae->imagesetID)
   {
   $ae->DBQuery("SELECT * FROM ".$ae->table[13]." WHERE ID='".$ae->imagesetID."'");
   $ae->DBGetRow();
   $description=$ae->access["description"];
   if (!$ae->uploadnumber)
      {
      $ae->DBQuery("SELECT * FROM ".$ae->table[1]." WHERE imagesetID='".$ae->imagesetID."'");
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
<form method="post" action="modify.php?command=10">
<fieldset><legend><? echo $ae->textbasic[74]; ?></legend>
<label for="imagesetID[]"><? echo $ae->textbasic[123]; ?></label>
<?
if ($ae->currentuserposition>2) @$ae->DBQuery("SELECT * FROM ".$ae->table[13]." WHERE authorID='".$ae->currentuserID."' ORDER BY description");
else @$ae->DBQuery("SELECT * FROM ".$ae->table[13]." ORDER BY description");
$size=$ae->rowsnumber;
if ($size<1) $size=1;
if ($size>15) $size=15;
echo '<select name="imagesetID[]" id="imagesetID[]" size="',$size,'" multiple="multiple">';
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
<form method="post" action="managerimage.php">
<fieldset><legend><? echo $ae->textbasic[149]; ?></legend>
<label for="uploadnumber"><? echo $ae->textbasic[37]; ?></label>
<input type="text" name="uploadnumber" id="uploadnumber" size="2" value="<? echo $ae->uploadnumber; ?>" />
<input type="submit" name="submit" value="<? echo $ae->textbasic[116]; ?>" class="button" />
<input type="hidden" name="username" value="<? echo $ae->username; ?>" />
<input type="hidden" name="session" value="<? echo $ae->session; ?>" />
<input type="hidden" name="imagesetID" value="<? echo $ae->imagesetID; ?>">
</fieldset>
</form>
<form method="post" action="modify.php?<? if (!$ae->imagesetID) echo "command=11"; else echo "command=12"; ?>" enctype="multipart/form-data">
<fieldset><legend><? echo $ae->textbasic[123]; ?></legend>
<label for="description"><? echo $ae->textbasic[77]; ?></label>
<input type="text" name="description" id="description" size="50" value="<? echo $description; ?>" /><br class="clear" />
<?
for ($i=0;$i<$ae->uploadnumber;$i++)
    {
    echo '<label for="file[',$i,']">#',$i+1,' ',$ae->textbasic[75],'</label>';
    echo '<input type="file" name="file[',$i,']" size="50"><br class="clear" />';
    echo '<label for="filedescription[',$i,']" class="additional">',$ae->textbasic[76],'</label>';
    if ($ae->imagesetID)
       {
       $ae->DBQuery("SELECT * FROM ".$ae->table[1]." WHERE imagesetID='".$ae->imagesetID."' ORDER BY ID LIMIT ".$i.",1");
       if ($ae->rowsnumber)
          {
          $ae->DBGetRow();
          $thumbnail=$ae->GetThumbnailName($ae->access["filename"]);
          echo '<input type="text" name="filedescription[',$i,']" id="filedescription[',$i,']" size="50" value="',$ae->access["description"],'" class="description" /><br class="clear" />';
          echo ' <a href="',$ae->pathimages,$ae->access["filename"],'"><img src="',$ae->pathimages,$thumbnail,'" class="preview" alt="',$ae->access["description"],'" /></a>';
          echo ' <input type="checkbox" name="delete[',$i,']" id="delete[',$i,']" value="',$ae->access["ID"],'" /><label for="delete[',$i,']" class="nofloat">',$ae->textbasic[110],' ',$ae->access["filename"],'</label><br class="clear" />';
          }
       else
          {
          echo '<input type="text" name="filedescription[',$i,']" id="filedescription[',$i,']" size="50" class="description" /><br class="clear" />';
          }
       }
    else
       {
       echo '<input type="text" name="filedescription[',$i,']" id="filedescription[',$i,']" size="50" class="description" /><br class="clear" />';
       }
    }
?>
<label for="submit"></label>
<input type="submit" name="submit" id="submit" value="<? echo $ae->textbasic[103]; ?>" class="button" />
<input type="hidden" name="username" value="<? echo $ae->username; ?>" />
<input type="hidden" name="session" value="<? echo $ae->session; ?>" />
<input type="hidden" name="MAX_FILE_SIZE" value="<? echo $ae->sizemaxfiles; ?>" />
<input type="hidden" name="imagesetID" value="<? echo $ae->imagesetID; ?>" />
<input type="hidden" name="uploadnumber" value="<? echo $ae->uploadnumber; ?>" />
</fieldset>
</form>
</div>
<? @include("footer.php"); ?>