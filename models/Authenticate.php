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


    }

    /**
     * Checks user is authorisation
     * @return bool
     */
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