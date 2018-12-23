<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once ("config/Autoload.php");
use App\Router\Router;
use App\Controller;

$router = new Router();
$result=$router ->run();


$contrloller = new Controller();
$contrloller->start($result);



//echo"start";