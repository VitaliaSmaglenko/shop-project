<?php

/**
 * Created by PhpStorm.
 * User: Виталия
 * Date: 13.12.2018
 * Time: 16:36
 */
class cartController
{
    public function actionCart(){
        include_once ('views/cart.php');
        return true;
    }
}