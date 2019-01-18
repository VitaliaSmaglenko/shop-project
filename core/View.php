<?php

namespace App;


class View
{
    public function render($views, $data=null){
         $path = "views/";
         //echo "<pre>";
        // var_dump($data);
         //include_once($path.$views);

        ob_start();
        extract($data, EXTR_OVERWRITE);
        require $path.$views;
        return ob_get_clean();
    }
}