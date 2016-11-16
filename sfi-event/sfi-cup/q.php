<?php
require('__game.php');

$x = array_rand($q, 6);
shuffle($x);

setCookie('game', 1);
for ($i = 0; $i < sizeof($x); $i++)
{
	setCookie('q'.($i+1), $x[$i]);
}

header('location:game.php');
?>
