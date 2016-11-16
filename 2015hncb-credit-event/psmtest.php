<?php
       
	   $SendGet = new SocketHttpRequest();  // 建立物件
		$SendGet->HttpRequest('http://60.250.14.67/SmSendGet.asp?username=24470810&password=core24470810&dstaddr=0961533394&DestName=陳燦煜&dlvtime=&vldtime=&smbody=陳燦煜 恭喜您獲得全家禮券,編號為123456&encoding=UTF8'); 

		$SendGet->sendRequest(); //發送
		echo 'ret=' . $SendGet->getResponseBody(); //取回傳值
		exit;
        
 
 
 
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