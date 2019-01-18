<?php

/**
 * Controller AdminController
 */

class AdminController
{
    public function actionIndex()
    {

        include_once('views/admin/index.php');
        return true;
    }
}