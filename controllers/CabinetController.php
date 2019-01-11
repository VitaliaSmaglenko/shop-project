<?php
/**
 * Controller CabinetController
 */
use Model\Authenticate;

class CabinetController
{
    public $checkAuth;
    public function __construct()
    {
        $this->checkAuth = new Authenticate();
    }

    public function actionIndex()
    {
        $user = new Authenticate();
        $userId=$user->checkLogged();
        //echo $userId;
        include_once ('views/cabinet.php');
        return true;
    }

}