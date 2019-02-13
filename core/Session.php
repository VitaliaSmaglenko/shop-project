<?php
/**
 * Class Session for working with sessions
 */

namespace App;

class Session
{
    /**
     *  Includes session if it does not exist yet
     * @return bool
     */
    public function start()
    {
        if (!$this->sessionExist()) {
            session_start();
            return true;
        } else {
            return false;
        }
    }

    /**
     * Checks session existence
     * @return bool
     */

    public function sessionExist():bool
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
        if ($this->sessionExist()) {
            $_SESSION[$key] = $val;
        }
    }

    /**
     * Gets sessions values by key
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        if ($this->sessionExist()) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    /**
     * Sets session name
     * @param $name
     */

    public function setName($name)
    {
        if (!$this->sessionExist()) {
            session_name($name);
        }
    }

    /**
     * Gets session name
     * @return string|false
     */

    public function getName()
    {
        if ($this->sessionExist()) {
            return session_name();
        } else {
            return false;
        }
    }
    /**
     * Checks cookie existence
     * @return bool
     */
    public function cookieExists():bool
    {
        if (isset($_COOKIE['PHPSESSID'])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Destroys session if it exists
     * @return bool
     */
    public function destroy()
    {
        if (!$this->sessionExist() && !$this->cookieExists()) {
            return false;
        } else {
            session_unset();
            session_destroy();
            return true;
        }
    }
}
