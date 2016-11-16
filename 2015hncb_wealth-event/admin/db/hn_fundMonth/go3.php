<?php
/******************************************************************/
// Initialize
/******************************************************************/
include ("../check.php");

if (!$_GET['d'])
{
	echo 'error';
	exit;
}

$_table = TABLE_PREFIX.'lottery';

$_date = array('2015-01-22', '2015-01-29', '2015-02-05', '2015-02-12', '2015-02-17', '2015-03-02');
$_prize = array(
	'A' => 900,
	'B' => 130,
	'C' => 25,
	'D' => 1,
	'E' => 15
);

$_title = array(
	'A' => '跨行轉帳手續費免收一次（使用期限至104年06月30日止）',
	'B' => '肯德基咔啦脆雞乙份電子兌換券',
	'C' => '丹堤咖啡美式豪華早午餐套餐電子兌換券', 
	'D' => '王品台塑餐券',
	'E' => '哈根達斯冰淇淋券100ML'
);

$dd = str_replace('-', '', $_GET['d']);

$_filename = 'temp_'. date('U') .'.csv';
$fp = fopen('../../../upload/' . $_filename, 'w');
fwrite($fp, '"姓名","遮蔽姓名","身分證後六碼","生日","Email","遮蔽Email","電話"'."\r\n\r\n");

foreach ($_prize as $code => $count)
{
	fwrite($fp, '="'.$_title[$code].'"'."\r\n");
	
	$r = $DB->Query("SELECT * FROM 2014hncb_app_winner WHERE 2014hncb_app_winnerStage = '". $_GET['d'] ."' AND 2014hncb_app_winnerCode = '". $code ."';");
	while ($f = $DB->Arrays($r))
	{
		mb_internal_encoding('UTF-8');
		$n = $f['2014hncb_app_winnerName'];
		$n = (mb_strlen($n) >= 3) ? mb_substr($n, 0, 1) . '○' . mb_substr($n, 2, mb_strlen($n) - 2) : mb_substr($n, 0, 1) . '○';
		
		$e = $f['2014hncb_app_winnerEmail'];
		$e = substr($f['2014hncb_app_winnerEmail'], 0, 1) . '***' . substr($f['2014hncb_app_winnerEmail'], 4);
	
		fwrite($fp, '="'. $f['2014hncb_app_winnerName'] .'",="'. $n .'",="'. $f['2014hncb_app_winnerID6'] .'",="'. $f['2014hncb_app_winnerBirthday'] .'",="'. $f['2014hncb_app_winnerEmail'] .'",="'. $e .'",="'. $f['2014hncb_app_winnerPhone'] .'"'."\r\n");
	}
	fwrite($fp, "\r\n");
}

header("Content-type:application/vnd.ms-excel");
header("Content-Disposition:filename=".$_filename);
readfile('../../../upload/' . $_filename);
?>