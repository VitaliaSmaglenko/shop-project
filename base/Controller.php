<?php
/**
 * Abstract base class controller
 */
namespace Base;

use Base\View;

abstract class Controller
{
    /**
     * @var \Base\View
     */
    public $view;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->view = new View();
    }
}
