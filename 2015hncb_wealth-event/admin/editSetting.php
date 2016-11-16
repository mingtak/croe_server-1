<?
define('INCLUDEWYSIWYG',1);
@include("coreclass.php");
$ae=new CArticles();
$ae->RequestVariables();
$ae->EngineInitialize();
$ae->UserVerifySession();
$ae->UserVerifyLevel(1);
$ae->DBQuery("SELECT * FROM ae_variable WHERE 1 order by ID");
$i=0;
while ($ae->DBGetRow())
{
  $VariableID[$i] = $ae->access["ID"];
  $VariableName[$i] = $ae->access["Name"];
  $VariableSValue[$i]= $ae->access["sValue"];
  $VariableIValue[$i]= $ae->access["iValue"];
  $i++;
}
$iTotalRec=$i++;
@include("header.php");
@include("menu.php");
?>
<div id="content">
<?
$object=$ae->DisplayError(8);
?>
<form method="post" action="modify.php?command=19" enctype="multipart/form-data">
<fieldset><legend></legend>
<?  
     for($j=0;$j<$iTotalRec;$j++)
    {
      echo '<label for="IDS' . $j .'">'.$VariableName[$j] .':'. $VariableID[$j].'</label>';
      echo '<input type="hidden" name="IDN'.$j.'" value="'.  $VariableID[$j].'" />';
      echo '<textarea name="IDS'.$j.'" id="IDS'.$j.'" cols="75" rows="2">'.  $VariableSValue[$j].'</textarea>';
      echo '<input type="text" name="IDI'.$j.'" value="'.  $VariableIValue[$j].'" size="10" /><br class="clear" />';
    }
?>
<label for="submit"></label>
<?
echo '<input type="submit" name="submit" value="',$ae->textbasic[103],'"';
echo ' class="button" />';
?>
<br class="clear" />
<br class="clear" />
<br class="clear" />
<label for="blogID">blogID</label>
<select name="blogID" id="blogID">
<option value="0"  selected="selected" >0-總站</option>
<?
  $ae->DBQuery("Select blogID,blogSName from ae_blog where bOn=1 Order by blogID");
  while ($ae->DBGetRow())
  {
     echo '<option value="' . $ae->access["blogID"] . '">' . $ae->access["blogID"] .'-'. $ae->access["blogSName"] . '</option>';  
       
  }
?>
</select>
<br class="clear" />

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
<input type="hidden" name="username" value="<? echo $ae->username; ?>" />
<input type="hidden" name="TotalRecord" value="<? echo $iTotalRec; ?>" />
<input type="hidden" name="session" value="<? echo $ae->session; ?>" />
<input type="hidden" name="currentblogID" value="<? echo $ae->currentblogID; ?>" />
<input type="hidden" name="blogID" value="<? echo $blogID; ?>" />
</fieldset>
</form>
</div>
<? @include("footer.php") ?>