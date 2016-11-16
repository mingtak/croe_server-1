<?php
include('./__include.php');
//if ($type==1)
	$candidates = $DB->Num($DB->Query("SELECT * FROM 20160921_user where 20160921_userStatus = {$type} ;"));
//else
//	$candidates = $DB->Num($DB->Query("SELECT * FROM 20160921_user ;"));
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title?></title>
<style type="text/css">
<!--
.style2 {font-size: 36px;
text-align:center;}
.style3 {font-size: 15px;
text-align:center;
color:#FF0000;
font-family:"微軟正黑體";}
body {
	background-image: url(images/bg.gif);
}
-->
</style>
<script language="JavaScript">
function lottery()
{
	document.getElementById('lo').src = 'lottery_go.php?w=' + document.getElementById('winner').value + '&t=<?php echo $type?>';
}
</script>
</head>

<body>
<div align="center"><table width="961" border="0" cellpadding="0" cellspacing="0" background="images/bg2.png" style="background-repeat:no-repeat;">
  <!--DWLayoutTable-->
  <tr>
    <td height="140" colspan="5" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
  <tr>
    <td height="39" colspan="5" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
  <tr>
    <td width="93" height="470" valign="top"><img src="images/ggg.png" width="93" height="422" /></td>
    <td colspan="3" rowspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="style2">
      <!--DWLayoutTable-->
      <tr>
        
        <td width="238" height="115" valign="top"><table width="90%" border="0" align="left" cellpadding="0" cellspacing="0">
          <!--DWLayoutTable-->
          <tr>
            <td height="41" align="center" valign="middle">參與抽獎人數</td>
                </tr>
          <tr>
            <td height="74" align="center" valign="middle"><form id="form1" name="form1" method="post" action="">
              <label>
                <input name="candidates" type="text" class="style2" id="candidates" value="<?php echo number_format($candidates)?>" size="10" />
                </label>
              </form></td>
                </tr>
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          </table></td>
            <td width="554" rowspan="2" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
            <td width="1"></td>
          </tr>
      
      <tr>
        <td rowspan="2" valign="top"><table width="90%" border="0" align="left" cellpadding="0" cellspacing="0">
          <!--DWLayoutTable-->
          <tr>
            <td height="41" align="center" valign="middle">抽出中獎人數</td>
                </tr>
          <tr>
            <td height="74" align="center" valign="middle"><form action="" method="post" name="form1" class="style2" id="form1">
              <label>
                <input name="winner" type="text" class="style2" id="winner" value="<?php echo $winner[$type]?>" size="10" />
                </label>
              </form></td>
                </tr>
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          </table>        </td>
            <td height="38"></td>
          </tr>
      <tr>
        <td rowspan="3" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <!--DWLayoutTable-->
          <tr>
            <td width="544" height="303" valign="middle" bgcolor="#EEF1EA" class="style3"><iframe src="lottery_empty.php?type=<?php echo $type?>" id="lo" frameborder="0" width="544" height="303" alt=""></iframe></td>
                  <td width="10">&nbsp;</td>
          </tr>
          <tr>
            <td height="40">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          
          
          
          
          
          
          
          
        </table></td>
            <td height="103"></td>
      </tr>
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      <tr>
        <td height="106" valign="top"><a href="#" onClick="lottery();"><img src="images/Lottery-003_09.png" width="238" height="106" alt="" border="0" /></a></td>
            <td></td>
          </tr>
      <tr>
        <td rowspan="2" valign="top"><a href="lottery01.php"><img src="images/Lottery-003_15-1.png" width="189" height="78" vspace="8" / border="0"></a></td>
            <td height="124"></td>
          </tr>
      <tr>
        <td height="3"></td>
        <td></td>
      </tr>
      
      <tr>
        <td height="12"></td>
        <td></td>
        <td></td>
      </tr>
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
      
    </table></td>
    <td width="75" valign="top"><!--DWLayoutEmptyCell-->&nbsp;</td>
    </tr>
  
  <tr>
    <td height="15"></td>
    <td></td>
    </tr>
  
  
  
  
  
  
  
  
  
  
  
  <tr>
    <td height="45">&nbsp;</td>
    <td width="634">&nbsp;</td>
    <td width="148" valign="top"><a href="lottery_export.php?type=<?php echo $type?>"><img src="images/Lottery-003_15-3.png" border="0" width="148" height="45" /></a></td>
    <td width="11">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td height="41" colspan="5" valign="top"><img src="images/Lottery-003_20.png" width="960" height="41" alt="" /></td>
    </tr>
  
  
  
  
  
  
  
  
  
  
  
  
</table>
</div>
</body>
</html>
