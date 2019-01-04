<?php

class Autoload
{
   static public  function  myAutoload($className){
      $pathParts = explode('\\', $className);
      $class=array_pop($pathParts);

       $path = array(
            'models/',
            'controllers/',
            'core/',
            'views/',
            'config/'

        );
        foreach ($pathParts as $parts){
            if(!preg_match('%^\p{Lu}%u', $parts)){
                return;
            }
        }
        if(preg_match('%^\p{Lu}%u', $class)){
        foreach ($path as $pathToClass){
           $file = $pathToClass. str_replace('\\', '/', $class) . '.php';
            if(is_file( $file)){
                include_once  $file;
            }
        }
   } return;
    }




}
      spl_autoload_register('Autoload::myAutoload');