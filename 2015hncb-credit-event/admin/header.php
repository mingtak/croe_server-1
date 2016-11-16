<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="big5" lang="big5">

<head>
<meta http-equiv="content-type" content="text/html; charset=<? echo $ae->charset ?>" />
<meta name="author" content="XHTML + CSS + PHP: Daniel Duris, dusoft[at]staznosti[dot]sk" />
<meta name="author" content="Design: Daniel Duris, dusoft[at]staznosti[dot]sk" />
<meta name="author" content="Logo + graphics: Rudolf Hausleitner" />
<meta name="copyright" content="Daniel Duris, 2001-<? echo date("Y"); ?>" />
<meta name="licence" content="GNU General Public Licence" />
<meta name="keywords" content="news publishing system, content management system, cms, news publishing engine, php, mysql, xhtml, css, absolut engine" />
<meta name="description" content="Absolut Engine is a news publishing system developed in PHP and MySQL. Built with web standards in mind." />
<meta name="robots" content="all" />
<title>Absolut Engine news publishing system by Daniel Duris</title>
<style type="text/css">@import "<? echo TEMPDIR; ?>main.css";</style>
<?
if (file_exists(TEMPDIR."additional.css")) echo '<style type="text/css">@import ',TEMPDIR,'"additional.css";</style>';
if (file_exists("additional.css")) echo '<style type="text/css">@import "additional.css";</style>';
?>
<link rel="shortcut icon" type="image/x-icon" href="<? echo TEMPDIR; ?>images/favicon.ico" />
<script type="text/javascript" src="<? echo TEMPDIR; ?>form.js"></script>
<?
if (file_exists("additional.js")) echo '<script type="text/javascript" src="additional.js"></script>';
if (defined('INCLUDEWYSIWYG') AND $ae->wysiwygeditor)
   {
   if (file_exists($ae->wysiwygeditor."css/style.css"))
      {
      echo '<style type="text/css" media="all">@import "',TEMPDIR,$ae->wysiwygeditor,'css/style.css";</style>';
      }
   if (file_exists($ae->wysiwygeditor."scripts/functions.js"))
      {
      echo '<script type="text/javascript">';
      @include(TEMPDIR.$ae->wysiwygeditor.'scripts/functions.js');
      echo '</script>';
      }
   }
?>
</head>

<body>
<div id="header">
<?
if ($ae->username AND $ae->session)
   {
   $ae->DBQuery("SELECT * FROM ".$ae->table[5]." WHERE ID='".$ae->currentuserID."'");
   $ae->DBGetRow();
   echo $ae->textbasic[48],' <strong>',$ae->access["fullname"],'</strong>! ';
   if ($ae->currentuserposition<=3)
      {
      echo '<strong>',$ae->textbasic[46] ,'</strong> ';
      $ae->DBQuery("SELECT fullname FROM ".$ae->table[6]." AS login LEFT JOIN ".$ae->table[5]." AS users ON login.userID=users.ID WHERE login.userID<>'".$ae->currentuserID."' ORDER BY fullname");
      $i=$ae->rowsnumber;
      while ($ae->DBGetRow())
            {
            $i--;
            echo $ae->access["fullname"];
            if ($i) echo ', ';
            }
      if (!$ae->rowsnumber) echo $ae->textbasic[47];
      else echo '.';
      }
   echo '<form action="',TEMPDIR,'admin.php" method="post">';
   echo '<input type="submit" name="submit" id="submit" value="',$ae->textbasic[67],'" class="button" />';
   echo '<input type="hidden" name="username" value="',$ae->username,'" />';
   echo '<input type="hidden" name="session" value="',$ae->session,'" />';
   echo '<input type="hidden" name="action" value="2" />';
   echo '</form>';
   }
?>

</div>