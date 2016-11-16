<?php
$headers   = array();
$headers[] = "MIME-Version: 1.0";
$headers[] = "Content-type: text/plain; charset=UTF-8";
$headers[] = "From: Allan <allan.sung@gmail.com>";
#$headers[] = "Bcc: JJ Chong <bcc@domain2.com>";
#$headers[] = "Reply-To: Recipient Name <receiver@domain3.com>";
#$headers[] = "Subject: Test";
#$headers[] = "X-Mailer: PHP/".phpversion();

mail('allan.sung@gmail.com', 'Test', 'form the sendmail', implode("\r\n", $headers));
?>