<?php
/**
 * Class User component for working with users
 */
namespace Model;

use App\PDODB;
use Model\Authenticate;

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
    private $phone;
    private $role;

    /**
     * Adds a new user to the database
     * @return bool
     */

    public function createUser():bool
    {
        $sql ='INSERT INTO user (first_name, last_name, user_name, email, password, phone) '.
               ' VALUES (:firstName, :lastName, :userName, :email, :password, :phone)';
        $pdo = new PDODB();
        $data = array(':firstName' => $this->getFirstName(), ':lastName' => $this->getLastName(),
            ':userName' => $this->getUserName(), ':email' => $this->getEmail(),
            ':password' => $this->getPassword(), ':phone' => $this->getPhone());
        $result=$pdo->prepareData($sql, $data, 'execute');

        return $result;
    }

    /**
     * Returns authorized user
     * Return user
     * @return User
     */

    public function get():User
    {
        $sql ='SELECT  user_name, first_name, last_name, email, id, password, phone FROM user '.
            ' WHERE email = :email AND password = :password';
        $pdo = new PDODB();
        $data = array(':email' => $this->getEmail(), ':password' => $this->getPassword());
        $user = $pdo->prepareData($sql, $data, 'fetch');
        $objUser = new User();
        for ($i=0; $i<count($user); $i++) {
            $objUser->setEmail($user['email']);
            $objUser->setFirstName($user['first_name']);
            $objUser->setLastName($user['last_name']);
            $objUser->setPassword($user['password']);
            $objUser->setId($user['id']);
            $objUser->setUserName($user['user_name']);
            $objUser->setPhone($user['phone']);
        }
        return $objUser;
    }

    /**
     * Returns authorized user by id
     * @param int $id
     * @return User
     */
    public function getById(int $id):User
    {
        $sql ='SELECT  user_name, first_name, last_name, email, id, password, phone, role FROM user  WHERE id = :id';
        $pdo = new PDODB();
        $data = array(':id' => $id);
        $user = $pdo-> prepareData($sql, $data, 'fetchAll');
        $objUser = new User();
        for ($i=0; $i<count($user); $i++) {
            $objUser->setEmail($user[$i]['email']);
            $objUser->setFirstName($user[$i]['first_name']);
            $objUser->setLastName($user[$i]['last_name']);
            $objUser->setPassword($user[$i]['password']);
            $objUser->setId($user[$i]['id']);
            $objUser->setUserName($user[$i]['user_name']);
            $objUser->setPhone($user[$i]['phone']);
            $objUser->setRole($user[$i]['role']);
        }
          return $objUser;
    }

    /**
     * Updates user data by id
     * @param int $id
     * @return bool
     */
    public function updateUser(int $id):bool
    {
        $sql ='UPDATE user SET first_name = :firstName, last_name = :lastName, password = :password, phone = :phone'.
            ' WHERE id = :id';
        $pdo = new PDODB();
        $data = array( ':firstName' => $this->getFirstName(), ':lastName' => $this->getLastName(),
            ':password' => $this->getPassword(), ':phone' => $this->getPhone(), ':id' => $id);
        $result=$pdo->prepareData($sql, $data, 'execute');
        return $result;
    }

    public function setUserName(string $userName):void
    {
        $this->userName = $userName;
    }

    public function getUserName():string
    {
        return $this->userName;
    }

    public function setLastName(string $lastName):void
    {
        $this->lastName = $lastName;
    }

    public function getLastName():string
    {
        return $this->lastName;
    }

    public function setFirstName(string $firstName):void
    {
        $this->firstName = $firstName;
    }

    public function getFirstName():string
    {
        return $this->firstName;
    }

    public function setPassword(string $password):void
    {
        $this->password = $password;
    }

    public function getPassword():string
    {
        return $this->password;
    }

    public function setEmail(string $email):void
    {
        $this->email = $email;
    }

    public function getEmail():string
    {
        return $this->email;
    }

    public function setId(int $id):void
    {
        $this->id = $id;
    }

    public function getId():int
    {
        return $this->id;
    }

    public function setPhone(string $phone):void
    {
        $this->phone = $phone;
    }

    public function getPhone():string
    {
        return $this->phone;
    }

    public function setRole(string $role):void
    {
        $this->role = $role;
    }

    public function getRole():string
    {
        return $this->role;
    }
}
