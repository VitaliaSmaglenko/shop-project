<?php
/**
 * Class Authenticate for user authorisation
 */

namespace Model;
use App\Session;


class Authenticate
{
    /**
     * @var Session
     */
    private $session;


    /**
     * Authenticate constructor.
     */
    public function __construct()
    {
        $this->session = new Session();
    }

    /**
     * Includes session and sets values in session
     * @param $user
     */
    public function auth($user)
    {
        $this->session->start();
        $this->session->set('userName', $user->getUserName());
        $this->session->set('userId', $user->getId());
        $this->session->set('userEmail', $user->getEmail());
        $this->setCookie('userName', $user->getUserName());
        $this->setCookie('userId', $user->getId());
        $this->setCookie('userEmail', $user->getEmail());

    }

    /**
     * Checks user is authorisation
     * @return bool
     */
    public function isAuth()
    {

        $this->session->start();
        if(isset($_SESSION['userId'])){
            return true;
        } else return false;
    }

    public function checkLogged()
    {
        $this->session->start();
        if($this->isAuth()){

            return $_SESSION['userId'];
        }
        else {

            header('Location: /login');
            return false;
        }
    }

    public function setCookie($key, $val)
    {
        if($this->session->cookieExists()){
          setcookie($key, $val, time()+3600);
        } else return;
    }

    public function getCookie($key)
    {
        if($this->session->cookieExists()){

            return $_COOKIE[$key];
        }
        else return;
    }

    public function logout()
    {
        $this->session->start();
        $this->session->destroy();
    }
}