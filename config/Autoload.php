<?php


class Autoload
{
   static public  function  myAutoload($className){

        $path = array(
            'models/',
            'controllers/',
            'core/',
            'views/',
            'config/'

        );

        foreach ($path as $pathToClass){
            $pathToClass = $pathToClass.$className.'.php';
            if(is_file($pathToClass)){
                include_once $pathToClass;
            }
        }
       // $file=$path.$className.'.php';
       // echo $file;
      //  echo ROOT;
       // include_once ($file);
    }




}

  spl_autoload_register('Autoload::myAutoload');