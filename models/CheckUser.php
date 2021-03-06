<?php
/**
 *  Class CheckUser component for data validation
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
     * Validates registration data
     * @param $email
     * @param $password
     * @param $userName
     * @param $firstName
     * @param $lastName
     * @param $phone
     * @return array
     */
    public function checkRegistration($email, $password, $userName, $firstName, $lastName, $phone):array
    {
            $this->checkEmail($email);
            $this->checkEmailExists($email);
            $this->checkPassword($password);
            $this->checkUserName($userName);
            $this->checkUserNameExists($userName);
            $this->checkFirstName($firstName);
            $this->checkLastName($lastName);
            $this->checkPhone($phone);

            return $this->errors;
    }

    /**
     * Validates authorisation data
     * @param $email
     * @param $password
     * @return array
     */
    public function checkAuthorisation($email, $password):array
    {
            $this->checkEmail($email);
            $this->checkPassword($password);
            $this->checkUserExists($email, $password);
            return $this->errors;
    }

    /**
     * Validates data when it editing
     * @param $password
     * @param $firstName
     * @param $lastName
     * @param $phone
     * @return array
     */
    public function checkEdit($password, $firstName, $lastName, $phone):array
    {
            $this->checkPassword($password);
            $this->checkFirstName($firstName);
            $this->checkLastName($lastName);
            $this->checkPhone($phone);

            return $this->errors;
    }

    public function checkCheckout($firstName, $lastName, $phone):array
    {
            $this->checkFirstName($firstName);
            $this->checkLastName($lastName);
            $this->checkPhone($phone);

            return $this->errors;
    }

    /**
     * Checks userName length
     * @param $userName
     * @return bool
     */
    public function checkUserName($userName):bool
    {
        if (strlen($userName) >=5) {
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
    public function checkLastName($lastName):bool
    {
        if (strlen($lastName) >=2) {
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
    public function checkFirstName($firstName):bool
    {
        if (strlen($firstName) >=2) {
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
    public function checkEmail($email):bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
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
    public function checkPassword($password):bool
    {
        if (strlen($password) >=6) {
            return true;
        }
        $this->errors[] = 'Password must not be shorter than 6 characters';
        return false;
    }

    /**
     * Checks that the value is a phone number
     * @param $phone
     * @return bool
     */

    public function checkPhone($phone):bool
    {
        if (strlen($phone) >=10 && strlen($phone) <= 13) {
            return true;
        }
        $this->errors[] = 'Invalid phone number';
        return false;
    }

    /**
     * Checks email already exists in database
     * @param $email
     * @return bool
     */
    public function checkEmailExists($email):bool
    {
        $sql ='SELECT  COUNT(*) FROM user  WHERE email = :email';
        $data = array(':email' => $email);
        $result = PDODB::prepareData($sql, $data, 'fetchColumn');

        if ($result) {
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
    public function checkUserNameExists($userName):bool
    {
        $sql ='SELECT  COUNT(*) FROM user  WHERE user_name = :userName';
        $data = array(':userName'=> $userName);
        $result = PDODB::prepareData($sql, $data, 'fetchColumn');

        if ($result) {
            $this->errors[] = 'This user name already exists.';
            return false;
        }
        return true;
    }

    /**
     * Return true if user exists in database
     * @param $email
     * @param $password
     * @return bool
     */
    public function checkUserExists($email, $password):bool
    {
        $sql ='SELECT  user_name FROM user  WHERE email = :email AND password = :password';
        $data = array('email' => $email, 'password' => $password);
        $result = PDODB::prepareData($sql, $data, 'fetch');
        if ($result) {
            return true;
        }
        $this->errors[] = 'Wrong email or password';
        return false;
    }
}
