<?php
/**
 * Created by PhpStorm.
 * User: Виталия
 * Date: 18.01.2019
 * Time: 13:31
 */

namespace App;
use Model\Authenticate;
use Model\User;


abstract class Admin
{
    public function checkAdmin()
    {
        $isUser = new Authenticate();
        $userId = $isUser->checkLogged();
        if($userId == false){
            header('Location: /login');
        }
        $user = new User();
        $user = $user->getById($userId);
        if($user->getRole() == "admin"){
            return true;
        }
        die("Access denied");
    }
}