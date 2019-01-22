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

    public function createUser()
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

    public function get(){
        $sql ='SELECT  user_name, first_name, last_name, email, id, password, phone FROM user  WHERE email = :email AND password = :password';
        $pdo = new PDODB();
        $data = array(':email' => $this->getEmail(), ':password' => $this->getPassword());
        $user=$pdo->prepareData($sql, $data, 'fetch' );
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

        return $objUser;

    }

    /**
     * Returns authorized user by id
     * @param $id
     * @return User
     */
    public function getById($id){
        $sql ='SELECT  user_name, first_name, last_name, email, id, password, phone, role FROM user  WHERE id = :id';
        $pdo = new PDODB();
        $data = array(':id' => $id);
        $user = $pdo-> prepareData($sql, $data, 'fetchAll');
        $objUser = new User();
        for ($i=0; $i<count($user); $i++){
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
     * @param $id
     * @return bool
     */
    public function updateUser($id)
    {
        $sql ='UPDATE user SET first_name = :firstName, last_name = :lastName, password = :password, phone = :phone'.
            ' WHERE id = :id';
        $pdo = new PDODB();
        $data = array( ':firstName' => $this->getFirstName(), ':lastName' => $this->getLastName(),
            ':password' => $this->getPassword(), ':phone' => $this->getPhone(), ':id' => $id);
        $result=$pdo->prepareData($sql, $data, 'execute');
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

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getRole()
    {
        return $this->role;
    }
}