<?php

namespace Base;


class View
{
    public function render($views, $data=null){
         $path = "views/";
            if( file_exists($path.$views)) {
            ob_start();
            extract($data, EXTR_OVERWRITE);
            include ($path.$views);
            $page = ob_get_clean();
            include ($path.$views);

        }

    }
}