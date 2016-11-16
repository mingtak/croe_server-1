<?php
include ('./config/config.php');

include ('./modules/Lib.php');
include ('./modules/DBmySQL.php');

$DB->Connect();
$DB->Select(DATABASE);
?>
