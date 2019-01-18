<?php

/**
 * Controller AdminController
 */
use App\View;

class AdminController
{
    public function actionIndex()
    {

        $view = new View();
        $view->render('admin/index.php');
        return true;
    }
}