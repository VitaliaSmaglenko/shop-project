<?php
/**
 * Class Controller
 * Component for connecting controllers
 */

namespace App;

class Controller
{
    /**
     * Connects the controller class file
     * @param $result
     */
    public function start($result){


        $controllerName = $result[0];
        $actionName = $result[1];
        $parameters  = $result[2];


       $controllerFile = 'controllers/'.$controllerName.'.php';
       if(file_exists($controllerFile)){
            include_once ($controllerFile);
        }

        $controllerObject = new $controllerName;
        $contrloler = call_user_func_array(array($controllerObject,$actionName), $parameters);

        
    }


}