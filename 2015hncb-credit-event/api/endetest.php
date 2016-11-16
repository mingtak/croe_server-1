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
    $randNum=strval(rand(1000,9999)) . strval(rand(1000,9999)) . strval(rand(1000,9999)). strval(rand(1000,9999)) . strval(rand(10,99));
    $data= strval(rand(1000,9999)) . $data ;
    $data2=$data ;
    $len = strlen($data);
    if ($len >18) return '';
    $data='';
    for($i = 0; $i < $len; $i++){
        $data = $data . $randNum[$i] . $data2[$len-1-$i];
    }   
    
    for($i = 0, $key = 27, $c = 48; $i <= 255; $i++){
        $c = 255 & ($key ^ ($c << 1));
        $table[$key] = $c;
        $key = 255 & ($key + 1);
    }
    $len = strlen($data);
    for($i = 0; $i < $len; $i++){
        $data[$i] = chr($table[ord($data[$i])]);
    }
    
    //return base64_encode($data2);
    return str2hex($data);
    //    return chunk_split(base64_encode($data));
}

function trans_decrypt($data){
    //$data = base64_decode($data);
    $data = hex2str($data);
    
    //for($i = 0, $key = 27, $c = 48; $i <= 255; $i++){
      for($i = 0, $key = 27, $c = 48; $i <= 255; $i++){
        $c = 255 & ($key ^ ($c << 1));
        $table[$c] = $key;
        $key = 255 & ($key + 1);
    }
    $len = strlen($data);
    for($i = 0; $i < $len; $i++){
        $data[$i] = chr($table[ord($data[$i])]);
    }
  //  return $data;
    $data2='';
    for ($i = 0 ; $i < $len/2 ;$i++){
        $data2 = $data2 . $data[$len-1-$i*2-8];
    }
    return $data2;
}

function randomAlphaNum($length){

    $rangeMin = pow(36, $length-1); //smallest number to give length digits in base 36
    $rangeMax = pow(36, $length)-1; //largest number to give length digits in base 36
    $base10Rand = mt_rand($rangeMin, $rangeMax); //get the random number
    $newRand = base_convert($base10Rand, 10, 36); //convert it
   
    return $newRand; //spit it out

} 
//$key = "E4HD9h4DhS23DYfhHemkS3Nf";// 24 bit Key
$key = "A4HD8h4DhS23DYfhHemkS3Nf";// 24 bit Key
$iv = "fYfhHeDm";// 8 bit IV
//$input = "Text to be encrypted";// text to encrypt

$input = $_GET['xxx']. randomAlphaNum(4);


$bit_check=8;// bit amount for diff algor.
$str= encrypt($input,$key,$iv,$bit_check);
//$str = $str . strlen($str);

echo "Start: $input - ". strlen($input)."Excrypted: $str - ".strlen($str)."Decrypted: ".decrypt($str,$key,$iv,$bit_check);

function encrypt($text,$key,$iv,$bit_check) {
    $data2='';
    $len=strlen($text);
    for($i = 0; $i < $len; $i++){
         $data2 = $data2 . $text[$i] . $text[$len-$i-1];
    }
$text= $data2;
$text_num =str_split($text,$bit_check);
$text_num = $bit_check-strlen($text_num[count($text_num)-1]);
for ($i=0;$i<$text_num; $i++) {$text = $text . chr($text_num);}
$cipher = mcrypt_module_open(MCRYPT_TRIPLEDES,'','cbc','');
mcrypt_generic_init($cipher, $key, $iv);
$decrypted = mcrypt_generic($cipher,$text);
mcrypt_generic_deinit($cipher);
//return base64_encode($decrypted);
return str2hex($decrypted);
}

function hex2str( $hex ) {
  return pack('H*', $hex);
}


function str2hex( $str ) {
  return array_shift( unpack('H*', $str) );
}

function decrypt($encrypted_text,$key,$iv,$bit_check){
$cipher = mcrypt_module_open(MCRYPT_TRIPLEDES,'','cbc','');
mcrypt_generic_init($cipher, $key, $iv);
//$decrypted = mdecrypt_generic($cipher,base64_decode($encrypted_text));
$decrypted = mdecrypt_generic($cipher,hex2str($encrypted_text));
mcrypt_generic_deinit($cipher);
$last_char=substr($decrypted,-1);
for($i=0;$i<$bit_check-1; $i++){
    if(chr($i)==$last_char){
        $decrypted=substr($decrypted,0,strlen($decrypted)-$i);
        break;
    }
}
    $data2='';
    for ($i = 0 ; $i < strlen($decrypted)/2;$i++){
        $data2 = $data2 . $decrypted[$i*2];
    }

//return $decrypted;
return $data2;
}
?>
</BODY>
</HTML>
