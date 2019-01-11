<?php
/**
 * Created by PhpStorm.
 * User: phpstudent
 * Date: 11.01.19
 * Time: 16:50
 */

namespace Model;
use App\Session;
use Model\User;

class Authenticate
{
    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function auth($user)
    {
        $this->session->start();
        $this->session->set('userName', $user->getUserName());
        $this->session->set('userId', $user->getId());
        $this->session->set('userEmail', $user->getEmail());


    }
    public function isAuth()
    {
        if(isset($_SESSION['id'])){
            return true;
        } else return false;
    }


    public function logout()
    {

    }
}