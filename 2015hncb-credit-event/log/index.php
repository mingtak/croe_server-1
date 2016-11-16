<?php
$pa = $_GET['pa'];
$pb = $_GET['pb'];
echo '1)pa = ' . $pa . '<br>';
echo '2)pb = ' . $pb . '<br>';

$key = '';
$key .= substr($_GET['pa'], 0, 3);
$key .= substr($_GET['pb'], -10);
$key .= substr($_GET['pa'], -3);
echo '3)key = ' . $key . '<br>';

$sha = substr($key, 0, 8) . $pa . $pb . substr($key, -8);
echo '4)key for SHA = ' . $sha . '<br>';

$b64 = hash('sha256', $sha);
echo '5)key after SHA = ' . $b64 . '<br>';

$pc = $_GET['pc'];
echo '6)pc = ' . $pc . '<br>';

$pc = chunk_split(preg_replace('!\015\012|\015|\012!','',$pc)); 
$pc = base64_decode($pc);
echo '7)pc after base64 encode = ' . $pc . '<br>';

echo '5) must be equal to 7)';
?>