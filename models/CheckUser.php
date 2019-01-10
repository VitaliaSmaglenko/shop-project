<?php
/**
    Class CheckUser component for data validation
 */

namespace Model;
use App\PDODB;

class CheckUser
{
    /**
     * @var array
     */
    public $errors = array( );

    /**
     * Sets values to functions for validation
     * CheckUser constructor.
     * @param $userName
     * @param $firstName
     * @param $lastName
     * @param $email
     * @param $password
     */

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

    /**
     * Checks userName length
     * @param $userName
     * @return bool
     */
    public function checkUserName($userName)
    {
        if(strlen($userName) >=5){
            return true;
        }
        $this->errors[] = 'User name must not be shorter than 5 characters';
        return false;
    }

    /**
     * checks lastName length
     * @param $lastName
     * @return bool
     */
    public function checkLastName($lastName)
    {
        if(strlen($lastName) >=2){
            return true;
        }
        $this->errors[] = 'Last name must not be shorter than 2 characters';
        return false;
    }

    /**
     * Checks firstName length
     * @param $firstName
     * @return bool
     */
    public function checkFirstName($firstName)
    {
        if(strlen($firstName) >=2){
            return true;
        }
        $this->errors[] = 'First Name must not be shorter than 2 characters';
        return false;
    }

    /**
     * Verifies that the value is a valid email
     * @param $email
     * @return bool
     */
    public  function checkEmail($email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            return true;
        }
        $this->errors[] = 'Invalid email';
        return false;
    }

    /**
     * Checks password length
     * @param $password
     * @return bool
     */
    public  function checkPassword($password)
    {
        if(strlen($password) >=6){
            return true;
        }
        $this->errors[] = 'Password must not be shorter than 6 characters';
        return false;
    }

    /**
     * Checks email already exists in database
     * @param $email
     * @return bool
     */
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

    /**
     * Checks email userName exists in database
     * @param $userName
     * @return bool
     */
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