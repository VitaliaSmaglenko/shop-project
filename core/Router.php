<?php
/**
 * Component for working with routes
 */

namespace App;

class Router
{
    /*
     * Property to store an array of routes
     * @var array
     */
    private $routes;

    /**
     * Router constructor.
     */

    public function __construct()
    {
        $this->routes = include('config/routes.php');
    }

    /**
     * Method to handle the request
     * @return array
     */

    public function run():array
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            $uri = trim($_SERVER['REQUEST_URI'], '/');
        }
        foreach ($this->routes as $request => $path) {
            if (preg_match("~$request~", $uri)) {
                $fullPath = preg_replace("~$request~", $path, $uri);
                $separators = explode('/', $fullPath);

                $controllerName = ucfirst(array_shift($separators)) . 'Controller';
                $actionName = 'action' . ucfirst((array_shift($separators)));

                $parameters = $separators;
                $result = array('controllerName' => $controllerName,
                              'actionName' => $actionName, 'parameters' => $parameters);
                return $result;
            }
        }
    }
}
