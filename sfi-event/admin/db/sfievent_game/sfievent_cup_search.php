<?php
/******************************************************************/
// Initialize
/******************************************************************/
include ("../check.php");

$_table = TABLE_PREFIX.'cup';

CheckEmpty($_POST['target'], "搜尋目標");
CheckEmpty($_POST['keyword'], "搜尋關鍵字");

Transfer($_table . "_list.php?target=". $_POST['target'] ."&keyword=" .  urlencode($_POST['keyword']) . "&compare=" . $_POST['compare']);
?>