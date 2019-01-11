<?php
/**
 * Class Session
 */

namespace App;


class Session
{
    public function start()
    {
        if(!$this->sessionExist()){
            session_start();
           }
        else return;
    }

    public function sessionExist()
    {
            return session_status() == PHP_SESSION_ACTIVE;
    }

    public function set($key, $val)
    {
        if($this->sessionExist()){
            $_SESSION[$key] = $val;
        }
        else return;
    }

    public function get($key)
    {
        if($this->sessionExist()){
            return $_SESSION[$key];
        }
        else return;
    }
    public function setName($name)
    {
        if(!$this->sessionExist()){
            session_name($name);
        }
        else return;
    }

    public function getName()
    {
        if($this->sessionExist()){
            return session_name();
        }
        else return;
    }

    public function cookieExists()
    {
        if(isset($_COOKIE['PHPSESSID'])){
            return true;
        }
        else return false;
    }

    public function destroy()
    {

        if(!$this->sessionExist() && !$this->cookieExists()){
            return;
        }
        else session_destroy();

    }

}