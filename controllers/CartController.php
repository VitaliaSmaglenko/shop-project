<?php

/**
 * Controller CartController
 */

class CartController
{
    public function actionCart(){
        include_once ('views/cart.php');
        return true;
    }
}