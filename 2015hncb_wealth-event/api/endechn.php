<?
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
?>