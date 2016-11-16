<?php

$url='http://www.abc100.com.tw/zip/endetest.php?xxx=12345';
echo httpGet($url);
//$r = new HttpRequest($url, HttpRequest::METH_GET);
//$r->addQueryData(array('xxx' => '12345'));
//try {
//    $r->send();
//    if ($r->getResponseCode() == 200) {
//		echo $r->getResponseBody();
//        //file_put_contents('local.rss', $r->getResponseBody());
//    }
//} catch (HttpException $ex) {
//    echo $ex;
//}
function httpGet($url)
{
    $ch = curl_init();  
 
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//  curl_setopt($ch,CURLOPT_HEADER, false); 
 
    $output=curl_exec($ch);
 
    curl_close($ch);
    return $output;
}
 


?>