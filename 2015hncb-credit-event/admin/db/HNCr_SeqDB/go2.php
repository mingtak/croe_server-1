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

$_table = TABLE_PREFIX.'winner';

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
?>

<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<?php
$r = $DB->Query("SELECT * FROM {$_table} WHERE {$_table}Stage = '". $_GET['d'] ."';");
$c = $DB->Num($r);

if ($c)
{
	echo '<input type="button" value="回抽獎首頁" onClick="location.href=\'go.php\';">　';
	echo '<input type="button" value="匯出原始資料 (無亂碼，但須用記事本開啟) (有*記號)" onClick="location.href=\'go3.php?d='.$_GET['d'].'\';">　';
	echo '<input type="button" value="匯出 EXCEL 資料 (可能有亂碼可用 EXCEL 開啟) (有*記號)" onClick="location.href=\'go4.php?d='.$_GET['d'].'\';">　';
	echo '<br>';

	echo '<table width="100%" border="1">';
	echo '<tr>';
	echo '<td>抽中獎項</td>';
	echo '<td>姓名</td>';
	echo '<td>身分證後六碼</td>';
	echo '<td>生日</td>';
	echo '<td>Email</td>';
	echo '<td>電話</td>';
	echo '</tr>';

	while($f = $DB->Arrays($r))
	{
		echo '<tr>';
		
		echo '<td>'. $_title[$f[$_table.'Code']] .'</td>';
		echo '<td>'. $f[$_table.'Name'] .'</td>';
		echo '<td>'. $f[$_table.'ID6'] .'</td>';
		echo '<td>'. $f[$_table.'Birthday'] .'</td>';
		echo '<td>'. $f[$_table.'Email'] .'</td>';
		echo '<td>'. $f[$_table.'Phone'] .'</td>';

		echo '</tr>';
	}
	
	echo '</table>';
}

else
{
	$dd = str_replace('-', '', $_GET['d']);

	# 讀華南交換檔
	if (!file_exists('../../../record/HNCB_LOTTERY_SUCC_'. $dd .'.TXT'))
	{
		echo '華南確認檔還沒上傳，無法進行抽獎';
		exit;
	}
	
	#UPDATE check field from lottery
	$f = '../../../record/HNCB_LOTTERY_SUCC_'. $dd .'.TXT';
	$file = file($f);
	for ($i = 0; $i < sizeof($file); $i++)
	{
		if ($i == 0) continue; 
		
		$id6 = substr($file[$i], 0, 6);
		$bd = substr($file[$i], 8, 6);
		
		$DB->Query("UPDATE 2014hncb_app_lottery SET 2014hncb_app_lotteryCheck = 1 WHERE 2014hncb_app_lotteryID6 = '{$id6}' AND 2014hncb_app_lotteryBirthday = '{$bd}';");
	}
	
	#SELECT * FROM 2014hncb_app_lottery WHERE 2014hncb_app_lotteryWinner = 0 AND 2014hncb_app_lotteryCheck = 1 ORDER BY RAND() LIMIT 1071;
	$r = $DB->Query("SELECT * FROM 2014hncb_app_lottery WHERE 2014hncb_app_lotteryWinner = 0 AND 2014hncb_app_lotteryCheck = 1 ORDER BY RAND() LIMIT 1071;");
	
	#將 SELECT 出的資料寫進 TEMP 檔
	$fp = fopen('../../../record/temp.txt', 'w');
	while($f = $DB->Arrays($r))
	{
		fwrite($fp, $f['2014hncb_app_lotteryNo'].'│'.$f['2014hncb_app_lotteryName'].'│'.$f['2014hncb_app_lotteryID6'].'│'.$f['2014hncb_app_lotteryBirthday'].'│'.$f['2014hncb_app_lotteryEmail'].'│'.$f['2014hncb_app_lotteryPhone'].'│'.$f['2014hncb_app_lotteryFriendPhone'].'│'.$f['2014hncb_app_lotteryDatetime'] ."\n");
	}
	fclose($fp);
	
	#讀 TEMP 檔
	#0 ~ 900 算 A
	#901 ~ 1030 算 B
	#1031 ~ 1055 算 C
	#1056 ~ 1056 算 D
	#1057 ~ 1071 算 E
	echo '<input type="button" value="回抽獎首頁" onClick="location.href=\'go.php\';">　';
	echo '<input type="button" value="重抽一次" onClick="alert(\'跟華南資料同步可能需要一點時間，請耐心等候！\');location.href=\'go2.php?d='.$_GET['d'].'\';">　';
	echo '<input type="button" value="確定抽獎名單 (注意！確定後便無法重抽，確定前可無限重抽！)" onClick="location.href=\'go8.php?d='.$_GET['d'].'\';">　';
	echo '<br>';

	echo '<table width="100%" border="1">';
	echo '<tr>';
	echo '<td>抽中獎項</td>';
	echo '<td>姓名</td>';
	echo '<td>身分證後六碼</td>';
	echo '<td>生日</td>';
	echo '<td>Email</td>';
	echo '<td>電話</td>';
	echo '</tr>';
	
	$temp = file('../../../record/temp.txt');
	$i = 0;
	$bais = 0;
	foreach ($_prize as $code => $count)
	{
		echo '<tr><td bgcolor="#CCCCCC" colspan="6">'. $_title[$code] .'</td></tr>';
		
		for (; $i < ($count+$bais); $i++)
		{
			list($no, $name, $id6, $bd, $email, $phone, $friend, $dt) = explode('│', $temp[$i]);
		
			echo '<tr>';
			
			echo '<td>'. $_title[$code] .'</td>';
			echo '<td>'. $name .'</td>';
			echo '<td>'. $id6 .'</td>';
			echo '<td>'. $bd .'</td>';
			echo '<td>'. $email .'</td>';
			echo '<td>'. $phone .'</td>';

			echo '</tr>';
		}
		$bais = $i;
	}
	
	#可重抽 重覆上面三個動作
}

$DB->Close();
?>

</body>
</html>