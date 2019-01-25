<?php


namespace Sender;


class Render
{
    public function renderPhpFile($params)
    {
       $path = $params['path'];

        if( file_exists($path)) {
             ob_start();
            extract($params, EXTR_OVERWRITE);
            require $path;
            $page = ob_get_clean();
            return $page;
        }
    }
}