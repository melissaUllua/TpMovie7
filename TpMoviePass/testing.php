
<?php

$date = date('Y-m-d H:i:s');
echo $date;
date_default_timezone_set('America/Argentina/Buenos_Aires');
$script_tz = date_default_timezone_get();
var_dump($script_tz);
$date = date('Y-m-d H:i:s');
echo $date;


?>

