<?
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


function httpGet($url)
{
	//return "0000";
    $ch = curl_init();  
 
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
 //  curl_setopt($ch,CURLOPT_HEADER, false); 
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS ,3500);
	curl_setopt($ch,CURLOPT_TIMEOUT_MS,3500);
	curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
	
    $output=curl_exec($ch);
 
    curl_close($ch);
    return $output;
}
class SocketHttpRequest
{
    var $sUrl;
    var $sResponse;

    function HttpRequest($sUrl)
    {
            $this->sUrl = $sUrl;
    }
    
    function sendRequest()
    {
		$ch = curl_init(); 
		curl_setopt($ch,CURLOPT_URL,$this->sUrl);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch,CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS ,3500);
		curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);
 
		$this->sResponse=curl_exec($ch);
		if(curl_errno($ch))
			echo 'Curl error: '.curl_error($ch) . ' no='. curl_errno($ch) . '<br>';

		curl_close($ch);
        
    }

    function getResponse()
    {
        return $this->sResponse;
    }
	 function getResponseBody2()
    {
        return $this->sResponse;
    }
    function getResponseBody()
    {
		//echo $this->sResponse;
        $sPatternSeperate = '/\r\n/';
        $arMatchResponsePart = preg_split($sPatternSeperate, $this->sResponse);
		$pos=strpos($arMatchResponsePart[2],'=');
		if ($pos>=0)
			return substr($arMatchResponsePart[2],$pos+1);
		else
			return '-9';
    }
}
?>