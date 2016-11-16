<?

echo '<form method="post" id="filterform" name="filterform" action="managerbonus.php">';
echo '<fieldset><img src="images/filter.gif" alt="" />';
echo '<label for="filtarticlenumberb" class="nofloat">',$ae->textbasic[98],'</label>';
echo '<input type="text" name="filtarticlenumberb" id="filtarticlenumberb" size="1" value="',$ae->filtarticlenumberb,'" />';
echo '<label for="filttitle" class="nofloat">兌換獎項代碼</label>';
echo '<input type="text" name="filtPrizeCode" id="filtPrizeCode" size="10" value="',$ae->filtPrizeCode,'" />';
if ($ae->filtdatefromb) $ae->filtdatefromb=$ae->DateConversion($ae->filtdatefromb,2);
if ($ae->filtdatetob) $ae->filtdatetob=$ae->DateConversion($ae->filtdatetob,2);
echo '<label for="filtdatefrom" class="nofloat">兌換日期',$ae->textbasic[84],'</label>';
echo '<input type="text" name="filtdatefromb" id="filtdatefromb" size="6" maxlength="10" value="',$ae->filtdatefromb,'" />';
echo '<label for="filtdatefromb" class="nofloat">',$ae->textbasic[93],'</label>';
echo '<input type="text" name="filtdatetob" id="filtdatetob" size="6" maxlength="10" value="',$ae->filtdatetob,'" />';
echo '<input type="submit" name="submitb" id="submitb" value="',$ae->textbasic[96],'" class="button" />';
echo '<input type="hidden" name="username" value="',$ae->username,'" />';
echo '<input type="hidden" name="session" value="',$ae->session,'" />';
echo '<input type="hidden" name="offset" id="offset" value="0" />';
echo '</fieldset></form>';
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
