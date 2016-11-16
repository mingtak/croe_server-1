<?php
$location = array('系統首頁', '../../default.php');

if (!isset($disabledPaging))
{
	include (INCLUDES . "paging.php");
}
include_once (INCLUDES . "project.php");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo SYSTITLE?></title>
<link rel="stylesheet" href="<?php echo CSS?>main.css" type="text/css">
<link rel="stylesheet" href="<?php echo CSS?>theme.css" type="text/css">
<script language="JavaScript" src="<?php echo JSCRIPT?>CheckLib.js"></script>
<script language="JavaScript" src="<?php echo JSCRIPT?>JSCookTree.js"></script>
<script language="JavaScript" src="<?php echo JSCRIPT?>MenuTheme.js"></script>
<script language="JavaScript" src="<?php echo JSCRIPT?>CommonLib.js"></script>
<script language="JavaScript" src="<?php echo PLUGIN?>ckeditor/ckeditor.js"></script>
</head>
