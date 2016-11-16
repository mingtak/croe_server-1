<?php
define (SYSNAME, 'NAIP');
define (VERSION, 'V3.4');
define (BUILD, '1003');
define (SYSOP, 'sysop');
define (SYSOPLOGIN, '7599e787a3efb2d06317a9bd7ab9808f');

define (SITETITLE, '金融知識');
define (SYSTITLE, SITETITLE . ' - 後端管理系統');
define (MASTERMAIL, 'allan.sung@gmail.com');

define (DBCONSERVER, 'localhost');
define (DBCONID, 'sfievent');
define (DBCONPASSWORD, 'sfieventpasswd');
define (DATABASE, 'sfievent');
define (MAINFOLDER, 'sfi-event');

define (SYSPATH, '/var/www/html/core_web/sfi1108/'. MAINFOLDER .'/');
define (SITEURL, 'http://event.sfi.org.tw/'. MAINFOLDER .'/');
define (ADMINURL, 'http://event.sfi.org.tw/'. MAINFOLDER .'/admin/');

define (CONFIG, SYSPATH . 'config/');
define (MODULES, SYSPATH . 'modules/');
define (INCLUDES, SYSPATH . 'includes/');
define (PAGES, SYSPATH . 'pages/');
define (UPLOADPATH, SYSPATH . 'upload/');
define (PLUGINPATH, SYSPATH . 'plugin/');

define (CSS, SITEURL . '../css/');
define (JSCRIPT, SITEURL . '../js/');
define (IMAGES, SITEURL . '../images/');
define (POPUPS, SITEURL . '../popups/');
define (PLUGIN, SITEURL . '../plugin/');
define (UPLOAD, SITEURL . '../upload/');

define (DB, ADMINURL . 'db/');
define (COMMON, DB . 'common/');

define ('TABLE_PREFIX', 'sfievent_');
define ('TABLE_PAGE', TABLE_PREFIX.'page');
define ('TABLE_LOGIN', TABLE_PREFIX.'login');
define ('TABLE_LOG', TABLE_PREFIX.'log');
?>
