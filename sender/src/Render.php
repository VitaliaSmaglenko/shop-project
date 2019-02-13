<?php
/**
 * Class Render
 */

namespace Sender;

class Render
{
    /**
     * Method for render page
     * @param $params
     * @return false|string
     */
    public function renderPhpFile($params)
    {
        $path = $params['path'];
        if (file_exists($path)) {
             ob_start();
             extract($params, EXTR_OVERWRITE);
             require $path;
             $page = ob_get_clean();
             return $page;
        }
        return false;
    }
}
