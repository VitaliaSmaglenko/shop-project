<?php
/**
 * Created by PhpStorm.
 * User: Виталия
 * Date: 18.01.2019
 * Time: 13:31
 */

namespace Model;
use Model\Authenticate;
use Model\User;


class Admin
{
    public function checkAdmin()
    {
        $isUser = new Authenticate();
        $userId = $isUser->checkLogged();
        $user = new User();
        $user->getUserById($userId);
    }
}