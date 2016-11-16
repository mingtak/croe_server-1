<?php
include ('./config/config.php');
include ('./modules/Lib.php');
include ('./modules/DBmySQL.php');

$title = '抽獎程式';
$login = 1;
$id = 'core';
$pw = 'core';

$prize_winner = array('電影卷' => 160, '烤肉卷' => 30);

$prize = array_keys($prize_winner);
$winner = array_values($prize_winner);

$type = $_GET['type'];

$DB->Connect();
$DB->Select(DATABASE);
?>