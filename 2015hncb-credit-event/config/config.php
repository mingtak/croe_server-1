﻿<?php
define (SYSNAME, 'NAIP');
define (VERSION, 'V3.4');
define (BUILD, '1003');
define (SYSOP, 'sysop');
define (SYSOPLOGIN, '7599e787a3efb2d06317a9bd7ab9808f');

define (SITETITLE, '華得來財運指數翻翻樂');
define (SYSTITLE, SITETITLE . ' - 後端管理系統');
define (MASTERMAIL, 'terrychen0331@gmail.com');


define (DBCONSERVER, 'localhost');
define (DBCONID, 'core-marketing');
define (DBCONPASSWORD, 'core');
define (DATABASE, 'core_marketing');
define (MAINFOLDER, '2015hncb-credit-event');

define (SYSPATH, '/home/core-marketing/www/'. MAINFOLDER .'/');
define (SITEURL, 'http://www.core-marketing.com.tw/'. MAINFOLDER .'/');
define (ADMINURL, 'http://www.core-marketing.com.tw/'. MAINFOLDER .'/admin/');

define (CONFIG, SYSPATH . 'config/');
define (MODULES, SYSPATH . 'modules/');
define (INCLUDES, SYSPATH . 'includes/');
define (PAGES, SYSPATH . 'pages/');
define (UPLOADPATH, SYSPATH . 'upload/');
define (PLUGINPATH, SYSPATH . 'plugin/');

define (CSS, SITEURL . 'css/');
define (JSCRIPT, SITEURL . 'js/');
define (IMAGES, SITEURL . 'images/');
define (POPUPS, SITEURL . 'popups/');
define (PLUGIN, SITEURL . 'plugin/');
define (UPLOAD, SITEURL . 'upload/');

define (DB, ADMINURL . 'db/');
define (COMMON, DB . 'common/');

define ('TABLE_PREFIX', 'HNCr_');
define ('TABLE_PAGE', TABLE_PREFIX.'page');
define ('TABLE_LOGIN', TABLE_PREFIX.'login');
define ('TABLE_LOG', TABLE_PREFIX.'log');

?>