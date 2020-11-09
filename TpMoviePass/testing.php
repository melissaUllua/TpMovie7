<?php
require_once "Config/Autoload.php";
require_once "Config/Config.php";
use Models\Show as Show;
use Models\Movie as Movie;

//$today = date_format(new DateTime('now'), "Y-m-d");

//echo $today;
$show = new Show();
$movie = new Movie();
$date = date(new DateTime('2020-12-23'), "Y-m-d");
$time = date(new Time('16:50'), "H:i:s");
var_dump($time);
var_dump($date);

$movie->setId(531219);
$show->setShowMovie($movie);
$show->setShowTime($time);
$show->setShowDate($date);


?>