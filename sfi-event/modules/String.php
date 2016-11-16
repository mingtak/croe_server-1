<?php
function GetRandString($num) {
	$number = Array("0","1","2","3","4","5","6","7","8","9");
	$string1 = range("a", "z");
	$string2 = range("A", "Z");
	$merge = array_merge($number, $string1, $string2);

	$value = "";

	mt_srand((double)microtime()*1000000);

	for ($i = 0; $i < $num; $i++) {
		$result = mt_rand(0, count($merge)-1);
		$value .= $merge[$result];
	}

	return $value;
}
?>