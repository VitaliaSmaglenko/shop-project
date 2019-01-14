<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


require_once (__DIR__."/vendor/autoload.php");


use App\Router;
use App\Controller;
use Model\Authenticate;

$checkAuth = new Authenticate();
//$checkAuth->isAuth();

$router = new Router();
$result=$router ->run();

$contrloller = new Controller();
$contrloller->start($result);

