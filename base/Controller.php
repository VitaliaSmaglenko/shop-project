<?php

namespace Base;

use Base\View;

abstract class Controller
{
    public $view;

    public function __construct()
    {
        $this->view = new View();
    }
}
