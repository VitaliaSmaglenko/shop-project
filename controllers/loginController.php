<?php

/**
 * Created by PhpStorm.
 * User: Виталия
 * Date: 13.12.2018
 * Time: 16:10
 */
class loginController
{
    public function actionIndex(){

        include_once ('views/login.php');
        return true;
    }
}