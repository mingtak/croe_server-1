<?
echo '<form method="post" id="filterform" name="filterform" action="admin.php">';
echo '<fieldset><img src="images/filter.gif" alt="" />';
echo '<label for="filtarticlenumber" class="nofloat">',$ae->textbasic[98],'</label>';
echo '<input type="text" name="filtarticlenumber" id="filtarticlenumber" size="1" value="',$ae->filtarticlenumber,'" />';
echo '<label for="filttitle" class="nofloat">',$ae->textbasic[117],'</label>';
echo '<input type="text" name="filtTranType" id="filtTranType" size="10" value="',$ae->filtTranType,'" />';
echo '<label for="filtcheckid" class="nofloat">CheckID</label>';
echo '<input type="text" name="filtCheckID" id="filtCheckID" size="10" value="',$ae->filtCheckID,'" />';

if ($ae->filtdatefrom) $ae->filtdatefrom=$ae->DateConversion($ae->filtdatefrom,2);
if ($ae->filtdateto) $ae->filtdateto=$ae->DateConversion($ae->filtdateto,2);
echo '<label for="filtdatefrom" class="nofloat">',$ae->textbasic[84],'</label>';
echo '<input type="text" name="filtdatefrom" id="filtdatefrom" size="6" maxlength="10" value="',$ae->filtdatefrom,'" />';
echo '<label for="filtdatefrom" class="nofloat">',$ae->textbasic[93],'</label>';
echo '<input type="text" name="filtdateto" id="filtdateto" size="6" maxlength="10" value="',$ae->filtdateto,'" />';
echo '<input type="submit" name="submitb" id="submitb" value="',$ae->textbasic[96],'" class="button" />';
//  <input type="button" value="',$ae->textbasic[99],'" class="button" onclick="SetCookie(\'filtdatefrom\',\'0\',0,\'/\');SetCookie(\'filtdateto\',\'0\',0,\'/\');forms.fid2.datefrom.value=\'\';forms.fid2.dateto.value=\'\';forms.fid2.submit();"/>
echo '<input type="hidden" name="username" value="',$ae->username,'" />';
echo '<input type="hidden" name="session" value="',$ae->session,'" />';
echo '<input type="hidden" name="offset" id="offset" value="0" />';
echo '</fieldset>';
echo '</form>';
?>

<script type="text/javascript">
<!--
    
function query_auto_commit(offset) {
    
    document.getElementById( 'offset' ).value =  offset;
    //alert(document.getElementById( 'offset' ).value );
    document.forms["filterform"].submit();
    //document.forms[0].submit();
    //.submit();
    return true;
}

//-->
</script>