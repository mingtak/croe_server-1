<?php
/***********************************************************************************/
// PHP Module
/***********************************************************************************/
// Version			: V3.2
// LastModify	: 2004/10/16
// Author			: AllanSong	(allan@allan.idv.tw)
/***********************************************************************************/
// History			:
//	V1.0		=>	2000/07/14
// V2.0		=>	2002/07/21
//	V2.8		=>	2004/07/27
//	V3.0		=>	2004/09/10		** 重寫模組結構
//	V3.1		=>	2004/10/16		** 新增 CheckDate	 函數
//	V3.2		=> 2013/08/25		** replace ereg to preg_match
/***********************************************************************************/

// ================================================================================= //
// Function AnitMonkey()
// Created By Allan
// Frist Created on 2002/7/21
// Description: Anti the illegal connections, links, and reads.
// ================================================================================= //

function AntiMonkey($server) {
	$env = getenv('HTTP_REFERER');
	if (preg_match("/^".$server."\/(.+)$/", $env) == false) {
		ErrorMsg("抱歉！您非法的存取了本系統！");
	}
}

// ================================================================================= //
// Function CheckEmpty()
// Created By Allan
// Frist Created on 2002/7/21
// Last Modify on 2002/8/6
// Description: Check the empty field and alert it
// ================================================================================= //

function CheckEmpty($value,$field) {
	if (empty($value)) {
		ErrorMsg("抱歉！您的「".$field."」欄位未填寫。");
	}
	else {
		#$value = eregi_replace(" |\n|\r|<br>|<p>","",$value);
		if (empty($value)) {
			ErrorMsg("抱歉！您的「".$field."」欄位未填寫。");
			exit;
		}
	}
}

// ================================================================================= //
// Function CheckLevel()
// Created By Allan
// Frist Created on 2002/7/21
// Last Modify on 2002/8/6
// Description: Check this user's level and accpet who process or none
// ================================================================================= //

function CheckLevel($level, $standard) {
	if ($level < $standard) {
		ErrorMsg("抱歉！您的等級未能執行本權限！");
	}
}

// ================================================================================= //
// Function CheckEmail()
// Created By Allan
// Frist Created on 2002/7/21
// Last Modify on 2002/8/6
// Description: Check the Email is true and conform rules of logic
// ================================================================================= //

function CheckEmail($value) {
	if (empty($value)) {
		ErrorMsg("抱歉！您沒有填寫您的 E-mail");
	}
	else {
		if ($value = preg_match("/^(.+)@(.+)\\.(.+)$/i",$value)==false) {
			ErrorMsg("抱歉！您的 E-mail 位置不正確！請檢查之。");
		}
	}
}

// ================================================================================= //
// Function CheckURL()
// Created By Allan
// Frist Created on 2002/7/21
// Last Modify on 2002/8/6
// Description: Check the Web URL is true and conform rules of logic
// ================================================================================= //

function CheckURL($value,$name) {
	if (empty($value)) {
		ErrorMsg("抱歉！您沒有填寫". $name);
	}
	else {
		if ($value = preg_match("/^http:\/\/(.+)/",$value)==false) {
			ErrorMsg("抱歉！".$name."不正確！請檢查之。");
		}
	}
}

// ================================================================================= //
// Function CheckEQ()
// Created By Allan
// Frist Created on 2002/9/9
// Last Modify on 2002/9/9
// Description: Check the SomeA and SomeB is equal
// ================================================================================= //

function CheckEQ($VarA,$VarB,$SomeA,$SomeB) {
	if (empty($VarA) || empty($VarB)) {
		ErrorMsg("您部份欄位沒有正常填寫");
	}
	else {
		if ($VarA != $VarB) {
			ErrorMsg("您輸入的「". $SomeA ."」與「".  $SomeB ."」不相同！");
		}
	}
}
// ================================================================================= //
// Function CheckPID()
// Created By kwenjoe
// Frist Created on 2007/9/2
// Description: Check the PID is true and conform rules of logic
// ================================================================================= //
function CheckPID($id)
{
	$first_char = array(
		'A' => 10, 'B' => 11, 'C' => 12, 'D' => 13, 'E' => 14,
		'F' => 15, 'G' => 16, 'H' => 17, 'J' => 18, 'K' => 19,
		'L' => 20, 'M' => 21, 'N' => 22, 'P' => 23, 'Q' => 24,
		'R' => 25, 'S' => 26, 'T' => 27, 'U' => 28, 'V' => 29,
		'W' => 30, 'X' => 31, 'Y' => 32, 'Z' => 33, 'I' => 34,
		'O' => 35
	);

	$n0 = $first_char[strtoupper(substr($id, 0, 1))];
	$n[] = substr($n0, 0, 1);
	$n[] = substr($n0, 1, 1);

	for ($i = 1; $i < strlen($id); $i++)
	{
		$n[] = substr($id, $i, 1);
	}

	$mod = ($n[0] + ($n[1]*9) + ($n[2]* 8)+ ($n[3]*7) + ($n[4]*6) +
	($n[5]*5) + ($n[6]*4) + ($n[7]*3) + ($n[8]*2) + $n[9]) % 10;

	if ($mod == 0 && $n[10] == 0)
	{
	  $check = TRUE;
	}
	else
	{
		$check = (10 - $mod == $n[10]) ? TRUE : FALSE;
	}

	return($check);
}

function checkID($checkID, $checkPW)
{
	return (($checkID === SYSOP) && (md5($checkPW) === SYSOPLOGIN)) ? 1 : 0;
}

// ================================================================================= //
// Function CheckDate()
// Created By Allan
// Frist Created on 2004/10/16
// Description:
// ================================================================================= //

function CheckDays($year,$mon) {
	$chk = ($year % 4) ? 0 : 1;
	if ($mon == 4 || $mone == 6 || $mon == 9 || $mone == 11) {
		$day = 30;
	}
	elseif ($mon == 2) {
		$day = ($chk) ? 29 : 28;
	}
	else {
		$day = 31;
	}
	return $day;
}

// ================================================================================= //
// Function SendMail()
// Created By Allan
// Frist Created on 2002/7/28
// Description: SendMail function
// ================================================================================= //

function SendMail($to,$from,$subject,$body) {
	@mail($to,$subject,$body,"From: ".$from."\nReply-To: ".$from."\n");
}

// ================================================================================= //
// Function WinClose()
// Created By Allan
// Frist Created on 2002/7/21
// Description: Show the message and close current pop-up window 
// ================================================================================= //
function WinClose($msg) {
?>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	</head>
		<body onLoad="alert('<?php echo $msg?>'); window.close()">
		</body>
	</html>
<?php
	exit;
}

// ================================================================================= //
// Function CloseReload()
// Created By Allan
// Frist Created on 2003/12/14
// Description: Show the message and close current pop-up window and reload the parent window
// ================================================================================= //
function CloseReload($msg) {
?>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	</head>
		<body onLoad="alert('<?php echo $msg?>'); window.opener.location.reload(); window.close()">
		</body>
	</html>
<?php
	exit;
}

// ================================================================================= //
// Function Msg()
// Created By Allan
// Frist Created on 2002/7/21
// Description: Show the message to tell user and transfer to somewhere
// ================================================================================= //
function Msg($msg,$href) {
?>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	</head>
		<body onLoad="alert('<?php echo $msg?>'); location.href='<?php echo $href?>';">
		</body>
	</html>
<?php
	exit;
}

// ================================================================================= //
// Function ErrorMsg()
// Created By Allan
// Frist Created on 2002/7/21
// Description: Show the basic and simple message of error, just alert (JavaScript default)
// ================================================================================= //
function ErrorMsg($msg) {
?>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	</head>
		<body onLoad="alert('<?php echo $msg?>'); history.back()">
		</body>
	</html>
<?php
	exit;
}

// ================================================================================= //
// Function Transfer()
// Created By Allan
// Frist Created on 2003/4/25
// Description: Transfer the page to target (url)
// ================================================================================= //
function Transfer($url) {
?>
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	</head>
		<body onLoad="location.href='<?php echo $url?>';">
		</body>
	</html>
<?php
}

function utf8_substr($StrInput, $strStart, $strLen)
{
	// 對字串做URL Eecode
	// Reference:	http://blog.xuite.net/chenbruse/bruse/13351768
	$StrInput = mb_substr($StrInput, $strStart, mb_strlen($StrInput));
	$iString = urlencode($StrInput);
	$lstrResult="";
	$istrLen = 0;
	$k = 0;

	do
	{
		$lstrChar = substr($iString, $k, 1);
		if($lstrChar == "%")
		{
			$ThisChr = hexdec(substr($iString, $k+1, 2));
			if($ThisChr >= 128)
			{
				if($istrLen+3 < $strLen)
				{
					$lstrResult .= urldecode(substr($iString, $k, 9));
					$k = $k + 9;
					$istrLen+=3;
				}
				else
				{
					$k = $k + 9;
					$istrLen+=3;
				}
			}
			else
			{
				$lstrResult .= urldecode(substr($iString, $k, 3));
				$k = $k + 3;
				$istrLen+=2;
			}
		}
		else
		{
			$lstrResult .= urldecode(substr($iString, $k, 1));
			$k = $k + 1;
			$istrLen++;
		}
	} while ($k < strlen($iString) && $istrLen < $strLen); 

	return $lstrResult;
}


function filterHTML($content)
{
	        $filterTag = array (
            "'<script[^>]*?>.*?</script>'si",
            "'<[\/\!]*?[^<>]*?>'si",
            "'([\r\n])[\s]+'",
            "'&(quot|#34);'i",
            "'&(amp|#38);'i",
            "'&(lt|#60);'i",
            "'&(gt|#62);'i",
            "'&(nbsp|#160);'i",
            "'&(iexcl|#161);'i",
            "'&(cent|#162);'i",
            "'&(pound|#163);'i",
            "'&(copy|#169);'i",
            "'&#(\d+);'e"
        );
        
        $replaceTag = array (
            "",
            "",
            "\\1",
            "\"",
            "&",
            "<",
            ">",
            " ",
            chr(161),
            chr(162),
            chr(163),
            chr(169),
            "chr(\\1)"
        );
        
        return preg_replace ($filterTag, $replaceTag, $content);

}
?>