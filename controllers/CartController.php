<?php

/**
 * Controller CartController
 */
use Model\Authenticate;

class CartController
{
    public $checkAuth;
    public function __construct()
    {
        $this->checkAuth = new Authenticate();
    }

    public function actionCart(){
        include_once ('views/cart.php');
        return true;
    }
}