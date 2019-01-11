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
    private $id;

    /**
     * Adds a new user to the database
     * @return bool
     */

    public function createUser()
    {
        $sql ='INSERT INTO user (first_name, last_name, user_name, email, password) '.
               ' VALUES (:firstName, :lastName, :userName, :email, :password)';
        $pdo = new PDODB();
        $result=$pdo->addUser($sql, $this->getUserName(), $this->getFirstName(),
                              $this->getLastName(), $this->getEmail(), $this->getPassword());
        return true;

    }

    /**
     * Returns authorized user
     * Return user
     * @return User
     */

    public function getUser(){
        $sql ='SELECT  user_name, first_name, last_name, email, id, password FROM user  WHERE email = :email AND password = :password';
        $pdo = new PDODB();
        $user=$pdo->getUser($sql, $this->getEmail(),$this->getPassword());
        $objUser = new User();
        for ($i=0; $i<count($user); $i++){
            $objUser->setEmail($user['email']);
            $objUser->setFirstName($user['first_name']);
            $objUser->setLastName($user['last_name']);
            $objUser->setPassword($user['password']);
            $objUser->setId($user['id']);
            $objUser->setUserName($user['user_name']);

        }
        return $objUser;

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

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

}