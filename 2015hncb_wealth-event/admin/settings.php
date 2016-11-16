<?
/*
Absolut Engine by Daniel Duris (c) 2001-2007
Absolut Engine settings file
*/
if (!defined('AE_VERSION')) define('AE_VERSION','1.73'); // FOR INTERNAL PURPOSES - DO NOT CHANGE
if (!defined('DEBUG')) define('DEBUG',0); // FOR INTERNAL PURPOSES - DO NOT CHANGE
if (!defined('SYNDICATION')) define('SYNDICATION',0); // FOR INTERNAL PURPOSES - DO NOT CHANGE
if (!defined('NL'))define("NL", chr(13) . chr(10));
// BASIC SETTINGS:
$server="www.core-marketing.com.tw"; // Server name (domain name), i.e. www.yoursite.com
$path="2015hncb-credit-event/"; // Path from domain root to engine, finish by slash "/"; Empty if root (!)
// Path to image upload directory; Start by "../", finish by slash "/":
$pathimages="../images/articles/";
// Path to file upload directory; Start by "../", finish by slash "/":
$pathfiles="../files/articles/";
// If there hasn't been any activity for this time, user is promted to relogin:
$timeout=86400; // In seconds

// MYSQL DATABASE SETTINGS:
$dbserver="localhost"; // Address of database server, localhost by default
$dbuser="vhost67436"; // Username to access database
$dbpass="core27120822"; // Password to access database
$dbname="vhost67436"; // Database name, absolut by default
// TABLE NAMES:
$tableprefix="HNCredit_"; // Prefix for all tables - if changed, changes required in system.sql!!!
$tableprefixmod="HN_mod_"; // Prefix for all module tables - if changed, changes required in modules' system.sql!!!
$table[0]="CBBouns"; // Table Bons
$table[1]="CBRule"; // Table Rule
$table[2]="CBBounsLimit"; // Table files
$table[3]="CBPoint"; // Table articles
$table[4]="stats"; // Table stats
$table[5]="users"; // Table users
$table[6]="login"; // Table login
$table[7]="relatedarticles"; // Table related articles
$table[8]="modules"; // Table modules
$table[9]="UserMessage"; // Table articlesections
$table[10]="cleanurlspool"; // Table clean urls storage
$table[11]="temporary"; // Table for temporary storage
$table[12]="filesets"; // Table for file sets
$table[13]="imagesets"; // Table for image sets
$table[14]="activehooks"; // Table for system hooks already hooked
$table[15]="availablehooks"; // Table for system hooks available
$table[16]="mod_discussions"; // Table for guest's comment 
// OTHER SETTINGS:
$emailwebmaster="yuh@sohonetwork.com.tw"; // Webmaster's (Admin's) email
$wysiwygeditor="wysiwyg/tinymce/"; // path to WYSIWYG editor relative to admin/ directory (empty if no WYSIWYG editor used)
$cleanurls=0; // 0 disabled, 1 - generate physical files, 2 - use mod_rewrite .htaccess rewriting
$sizemaximages=1024000; // Limits maximal size of uploaded images (in bytes)
$thumbwidth=200; // Desired width of thumbnails (could vary - depends on image)
$thumbheight=200; // Desired height of thumbnails (could vary - depends on image)
$jpegquality=80; // Quality of JPEG image thumbnails (JPEG quality)
$sizemaxfiles=1024000; // Limits maximal size of uploaded files (in bytes)
// Filetypes that are forbidden to be uploaded (file extensions):
$uploadforbid="php,php3,phtml,html,htm,shtml,asp,cgi"; // Separate by commas
// Date format and delimiter - engine checks for DD, MM and YYYY only
$dateformat="YYYY/MM/DD"; // e.g. 02.07.1980, US style MM/DD/YYYY: 07/02/1980
?>