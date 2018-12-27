<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


require_once (__DIR__."/vendor/autoload.php");

//require_once ("config/Autoload.php");
use App\Router;
use App\Controller;
use Logger\Log;
$router = new Router();
$result=$router ->run();


$contrloller = new Controller();
$contrloller->start($result);


function userErrorHandler($errno, $errmsg, $filename, $errline){

$time = date("Y-m-d H:i:s");
    $err = "Time " . $time . "\n";
    $err .= "Error massege " . $errmsg . "\n";
    $err .= "Error file " . $filename . "\n";
    $err .= "Line " . $errline. "\n";
    ob_start();
    debug_print_backtrace();
    $err.= debug_print_backtrace();
    $err.=ob_get_clean();
    echo $errmsg."<br>";
    $log = new Log('name');
    $log->error($err);
    $log->warning($err);
    return true;
}


function myExample($a, $b){
    if ($a == 0 || $b == 0){
        trigger_error('Невозможно совершить операцию деления, один из параметров равен нулю',E_USER_ERROR);
    }
    if(is_string($a) || is_string($b) ){
        trigger_error('Один из параметров не является числом, и будет заменен на 1', E_USER_WARNING);
        $log = new Log('name');
        // $log->error('Один из параметров не является числом, и будет заменен на 1');
    }
    if(is_float($a) || is_float($b)){
        trigger_error('Один из параметров принадлежит к типу float и будет округлен в сторону к нулю', E_USER_NOTICE);
    }
}
set_error_handler("userErrorHandler");


myExample(10, '11');