<HTML>
<HEAD>
<TITLE>Encode /Decode Process</TITLE>
</HEAD>
<BODY>
<?
$data = $_GET['xxx'] ;
//$data =  'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%^&*():?,.' ;

echo ' Data=>'. $data . '<=' . strlen($data) . '<br>';
$dataenc=trans_encrypt($data);
echo 'Encode Data =>' . $dataenc . '<=' . strlen($dataenc) . '<br>';
echo 'Decode Data =>' . trans_decrypt($dataenc) . '<=' . strlen(trans_decrypt($dataenc)) . '<br>';

function trans_encrypt($data){
    $Encode = "";
    $abform = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789" ;
	$temp = substr($abform,13,strlen($abform) - 13) . substr($abform,0, 13);

    
	for($i = 0; $i < strlen($temp) ; $i++){
		$abto = $abto . substr($temp, strlen($temp) - $i - 1, 1);
    }
	$temp = substr($abto,20,strlen($abto) - 20) . substr($abto,0, 20);
    $abto = "";
    
	$y = floor(strlen($temp) / 2);
    
	for($i = 0; $i < $y ; $i++){
		$abto = $abto . substr($temp, $i*2 +1, 1) . substr($temp, $i*2, 1);
    }
	
	$str="";
	for($i = 0; $i < strlen($data) ; $i++){
		$str = $str . substr($data, strlen($data)-$i -1, 1) . substr($abform, floor(rand(0,61)), 1);
		
    }
	
	$str= strval(rand(1000,9999)) . $str ;
	
	for($i = 0; $i < strlen($str) ; $i++){
		if (strpos($abform, substr($str, $i, 1)) === false){
			$Encode = $Encode . substr($str, $i, 1);
		}else{
			$Encode = $Encode . substr($abto, strpos($abform, substr($str, $i, 1), 1),1);
		}
    }
	//echo 'dfa' . $Encode . '<br>';
    return $Encode;
	    
}

function trans_decrypt($data){
    
	$Decode = "";
        $abform = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789" ;
	$temp = substr($abform,13,strlen($abform) - 13) . substr($abform,0, 13);

    
	for($i = 0; $i < strlen($temp) ; $i++){
		$abto = $abto . substr($temp, strlen($temp) - $i - 1, 1);
    }
	$temp = substr($abto,20,strlen($abto) - 20) . substr($abto,0, 20);
    $abto = "";
    
	$y = floor(strlen($temp) / 2);
    
	for($i = 0; $i < $y ; $i++){
		$abto = $abto . substr($temp, $i*2 +1, 1) . substr($temp, $i*2, 1);
    }
	$y = floor((strlen($data) -4) / 2);
	if ($y <= 0) return $Decode;
	$str = "";
    
	for($i = 0; $i < $y ; $i++){
		$str = $str . substr($data,strlen($data) -$i*2 -2, 1) ;
    }
	//echo  'str' . $str . '<br>';
	for($i = 0; $i < strlen($str) ; $i++){
		if (strpos($abto, substr($str, $i, 1)) === false){
			$Decode = $Decode . substr($str, $i, 1);
		}else{
			$Decode = $Decode . substr($abform, strpos($abto, substr($str, $i, 1), 1),1);
		//	echo 'sf'. substr($abform, strpos($abto, substr($str, $i, 1), 1),1). '<br>';
		}
		

    }
    return $Decode;	
 
}
?>
</BODY>
</HTML>
