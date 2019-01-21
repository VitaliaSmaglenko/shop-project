<?php

/**
 * Controller AdminController
 */
use App\View;


class AdminController extends App\Admin
{
    public function actionIndex()
    {
        $this->checkAdmin();
        $view = new View();
        $view->render('admin/index.php');
        return true;
    }
}