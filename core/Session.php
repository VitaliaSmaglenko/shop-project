<?php
/**
 * Class Session for working with sessions
 */

namespace App;


class Session
{
    /**
     *  Includes session if it does not exist yet
     */
    public function start()
    {
        if(!$this->sessionExist()){
            session_start();
           }
        else return;
    }

    /**
     * Checks session existence
     * @return bool
     */

    public function sessionExist()
    {
            return session_status() == PHP_SESSION_ACTIVE;
    }

    /**
     * Sets values in session
     * @param $key
     * @param $val
     */
    public function set($key, $val)
    {
        if($this->sessionExist()){
            $_SESSION[$key] = $val;
        }
        else return;
    }

    /**
     * Gets sessions values by key
     * @param $key
     */
    public function get($key)
    {
        if($this->sessionExist()){
            return $_SESSION[$key];
        }
        else return;
    }

    /**
     * Sets session name
     * @param $name
     */

    public function setName($name)
    {
        if(!$this->sessionExist()){
            session_name($name);
        }
        else return;
    }

    /**
     * Gets session name
     * @return string|void
     */

    public function getName()
    {
        if($this->sessionExist()){
            return session_name();
        }
        else return;
    }


    /**
     * Checks cookie existence
     * @return bool
     */
    public function cookieExists()
    {
        if(isset($_COOKIE['PHPSESSID'])){
            return true;
        }
        else return false;
    }

    /**
     * Destroys session if it exists
     */
    public function destroy()
    {

        if(!$this->sessionExist() && !$this->cookieExists()){
            return;
        }
        else
        {
            session_unset();
            session_destroy();
        }

    }

}