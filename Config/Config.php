<?php namespace Config;

define("ROOT", dirname(__DIR__) . "/");
//Path to your project's root folder
define("FRONT_ROOT", "/TpMoviePass/TpMoviePass/");
define("VIEWS_PATH", "Views/");
define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "css/");
define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "js/");
define("CINEMA_ROOT", "Controllers/CinemaController/");

define("DB_HOST", "localhost");
define("DB_NAME", "tpmoviepass");
define("DB_USER", "root");
//define("DB_PASS", "6990");
define("DB_PASS", "");

?>

