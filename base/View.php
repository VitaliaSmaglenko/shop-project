<?php
/**
 * Class View
 */
namespace Base;

class View
{
    /**
     * Method for render html
     * @param string $views
     * @param array|null $data
     */
    public function render(string $views, array $data = null):void
    {
         $path = "views/";
        if (file_exists($path.$views)) {
            ob_start();
            extract($data, EXTR_OVERWRITE);
            include($path.$views);
            $page = ob_get_clean();
            include($path.$views);

        }
    }
}
