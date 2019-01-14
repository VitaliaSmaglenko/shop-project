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

    /**
     * Adds a new user to the database
     * @return bool
     */

    public function createUser()
    {
        $sql ='INSERT INTO user (first_name, last_name, user_name, email, password, phone) '.
               ' VALUES (:firstName, :lastName, :userName, :email, :password, :phone)';
        $pdo = new PDODB();
        $result=$pdo->addUser($sql, $this->getUserName(), $this->getFirstName(),
                              $this->getLastName(), $this->getEmail(), $this->getPassword(), $this->getPhone()
        );
        return $result;

    }

    /**
     * Returns authorized user
     * Return user
     * @return User
     */

    public function getUser(){
        $sql ='SELECT  user_name, first_name, last_name, email, id, password, phone FROM user  WHERE email = :email AND password = :password';
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
            $objUser->setPhone($user['phone']);
           }
        $auth = new Authenticate();
        $auth->auth($objUser);

        return $objUser;

    }

    /**
     * Returns authorized user by id
     * @param $id
     * @return User
     */
    public function getUserById($id){
        $sql ='SELECT  user_name, first_name, last_name, email, id, password, phone FROM user  WHERE id = :id';
        $pdo = new PDODB();
        $user=$pdo-> selectDataById($sql, $id);
        $objUser = new User();
        for ($i=0; $i<count($user); $i++){
            $objUser->setEmail($user[$i]['email']);
            $objUser->setFirstName($user[$i]['first_name']);
            $objUser->setLastName($user[$i]['last_name']);
            $objUser->setPassword($user[$i]['password']);
            $objUser->setId($user[$i]['id']);
            $objUser->setUserName($user[$i]['user_name']);
            $objUser->setPhone($user[$i]['phone']);
        }
          return $objUser;

    }

    /**
     * Updates user data by id
     * @param $id
     * @return bool
     */
    public function updateUser($id)
    {
        $sql ='UPDATE user SET first_name = :firstName, last_name = :lastName, password = :password, phone = :phone'.
            ' WHERE id = :id';
        $pdo = new PDODB();
        $result=$pdo->updateData($sql, $this->getFirstName(), $this->getLastName(), $this->getPassword(), $this->getPhone(), $id);
        return $result;
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

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getPhone()
    {
        return $this->phone;
    }

}