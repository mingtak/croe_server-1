<?php
/******************************************************************/
// Initialize
/******************************************************************/
include ("../check.php");

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

#若確定名單，則 UPDATE 2014hncb_app_lottery SET 2014hncb_app_lotteryWinner = 1 WHERE xxx

#INSERT INTO 2014hncb_app_winner 所有得獎者資料

#做兩種匯出格式 UTF8 CSV 跟 BIG5 CSV

$temp = file('../../../record/temp.txt');
$i = 0;
$bais = 0;
foreach ($_prize as $code => $count)
{
	for (; $i < ($count+$bais); $i++)
	{
		list($no, $name, $id6, $bd, $email, $phone, $friend, $dt) = explode('│', $temp[$i]);
		
		$DB->Query("UPDATE 2014hncb_app_lottery SET 2014hncb_app_lotteryWinner = 1 WHERE 2014hncb_app_lotteryNo = '{$no}';");
		
		$DB->Query("INSERT INTO 2014hncb_app_winner VALUES (null, '{$code}', '". $_GET['d'] ."', '{$name}', '{$id6}', '{$bd}', '{$email}', '{$phone}');");
	}
	$bais = $i;
}

$DB->Close();

header('location:go2.php?d='.$_GET['d']);
?>