<?php
if (empty($_GET['ans']) || !is_numeric($_GET['ans'])) exit;
if (!sizeof($_COOKIE)) exit;

require('__game.php');

if ($_GET['ans'] != $q[$_COOKIE['q'.$_COOKIE['game']]]['a'])
{
	header('location:wrong.html');
	exit;
}

setCookie('game', (intval($_COOKIE['game']) + 1));

if ((intval($_COOKIE['game']) + 1) > 6)
{
	require('ok-finish.html');
}
else
{
	require('ok0'.$_COOKIE['game'].'.html');
}
?>