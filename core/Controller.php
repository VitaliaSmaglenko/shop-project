<?php
/**
 * Class Controller
 * Component for connecting controllers
 */

namespace App;

use PHPUnit\Runner\Exception;

class Controller
{
    /**
     * Connects the controller class file
     * @param array $result
     * @throws \Exception
     */
    public function start(array $result):void
    {
        $controllerName = $result['controllerName'];
        $actionName = $result['actionName'];
        $parameters  = $result['parameters'];

       $controllerFile = 'controllers/'.$controllerName.'.php';


        try{
            if(!file_exists($controllerFile)){
                throw new \Exception("File doesn't exist");
            }
            include_once ($controllerFile);
        }catch (\Exception $e){
            echo("You have errors: {$e->getMessage()}\n");
        }

        $controllerObject = new $controllerName;
        $controller = call_user_func_array(array($controllerObject,$actionName), $parameters);
    }
}