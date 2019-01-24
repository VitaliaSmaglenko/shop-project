<?php
require_once(__DIR__."/vendor/autoload.php");

use App\Router;
use App\Controller;
use App\PDODB;
use Model\Authenticate;

$checkAuth = new Authenticate();
//$checkAuth->isAuth();


ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);



$router = new Router();
$result=$router ->run();


$controloller = new Controller();
$controloller->start($result);
