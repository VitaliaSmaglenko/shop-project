<?php
/**
 * Created by PhpStorm.
 * User: Виталия
 * Date: 10.01.2019
 * Time: 14:52
 */

namespace Model;
use App\PDODB;

class CheckUser
{
    public $errors = array( );
    public function __construct($userName, $firstName, $lastName, $email, $password)
    {
        $this->checkUserName($userName);
        $this->checkUserNameExists($userName);
        $this->checkEmail($email);
        $this->checkEmailExists($email);
        $this->checkPassword($password);
        $this->checkFirstName($firstName);
        $this->checkLastName($lastName);

        return $this->errors;
    }

    public function checkUserName($userName)
    {
        if(strlen($userName) >=5){
            return true;
        }
        $this->errors[] = 'User name must not be shorter than 5 characters';
        return false;
    }

    public function checkLastName($lastName)
    {
        if(strlen($lastName) >=2){
            return true;
        }
        $this->errors[] = 'Last name must not be shorter than 2 characters';
        return false;
    }

    public function checkFirstName($firstName)
    {
        if(strlen($firstName) >=2){
            return true;
        }
        $this->errors[] = 'First Name must not be shorter than 2 characters';
        return false;
    }
    public  function checkEmail($email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }
        $this->errors[] = 'Invalid email';
        return false;
    }
    public  function checkPassword($password)
    {
        if(strlen($password) >=6){
            return true;
        }
        $this->errors[] = 'Password must not be shorter than 6 characters';
        return false;
    }

    public  function checkEmailExists($email)
    {
        $sql ='SELECT  COUNT(*) FROM user  WHERE email = :email';
        $pdo = new PDODB();
        $result=$pdo->checkData($sql, $email);

        if($result){
            $this->errors[] = 'This email already exists.';
            return false;
        }
        return true;
    }

    public  function checkUserNameExists($userName)
    {
        $sql ='SELECT  COUNT(*) FROM user  WHERE user_name = :userName';
        $pdo = new PDODB();
        $result=$pdo->checkData($sql, $userName);

        if($result){
            $this->errors[] = 'This user name already exists.';
            return false;
        }
        return true;
    }
}