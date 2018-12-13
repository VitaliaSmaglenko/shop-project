<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once ("config/Autoload.php");

//require_once ("core/Router.php");

$router = new Router();
$router ->start();

//echo"start";