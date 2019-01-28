<?php
/**
 * Class Response
 */

namespace App;

class Response
{
    /**
     * @param string $path
     */
    public static function redirect(string $path):void
    {
        header('Location: '.$path);
    }
}
