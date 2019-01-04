<?php
namespace App;


class Router
{
    private $routes;

    public function __construct()
    {
        $this->routes = include('config/routes.php');
    }

    public function run()
    {

        if (!empty ($_SERVER['REQUEST_URI'])) {
            $uri = trim($_SERVER['REQUEST_URI'], '/');
        }

        foreach ($this->routes as $request => $path) {

            //echo "<br> $pattern -> $path";
            if (preg_match("~$request~", $uri)) {
                //f($uri==$pattern){

                $fullPath = preg_replace("~$request~", $path, $uri);
               // echo "<br>" . $uri;
                ///  echo "<br>".$path;
                //  echo "<br>".$request;
               // echo "<br> " . $fullPath . "<br>";

                $separators = explode('/', $fullPath);
                $controllerName = array_shift($separators) . 'Controller';
                $actionName = 'action' . ucfirst((array_shift($separators)));

              //  echo "<br> controller name " . $controllerName;
               // echo "<br> action name " . $actionName;
                $parameters = $separators;

                 $result = array($controllerName,$actionName, $parameters);
                 return $result;}


            }
        }

}