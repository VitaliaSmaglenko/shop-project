<?php
/**
 * Class User component for working with users
 */
namespace Model;
use App\PDODB;

class User

{
    /**
     * @var
     */
    private $userName;
    private $firstName;
    private $lastName;
    private $email;
    private $password;

    /**
     * Adds a new user to the database
     */

    public function createUser()
    {
        $sql ='INSERT INTO user (first_name, last_name, user_name, email, password) '.
               ' VALUES (:firstName, :lastName, :userName, :email, :password)';
        $pdo = new PDODB();
        $result=$pdo->addUser($sql, $this->getUserName(), $this->getFirstName(),
                              $this->getLastName(), $this->getEmail(), $this->getPassword());

    }


    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }



}