<?php
/**
 * Abstract base class controller
 */
namespace Base;

use Base\View;
use App\Response;
use App\Request;

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
        $request = new Request();
        if (null !== $request->post('subSearch')) {
            Response::redirect('/search/'.$request->post('search').'/page-1');
        }
    }
}
