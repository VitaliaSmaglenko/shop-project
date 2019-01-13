<?php
/**
 *  Controller UserController
 */
use Model\User;
use Model\CheckUser;
use Model\Authenticate;

class UserController
{
    public $checkAuth;
    public function __construct()
    {
        $this->checkAuth = new Authenticate();
    }

    /**
     * Action for user registration
     * @return bool
     */
    public function actionRegister(){


        $firstName= '';
        $lastName= '';
        $userName= '';
        $email= '';
        $password='';


        if(isset($_POST['submitReg'])){

            $firstName= $_POST['firstName'];
            $lastName= $_POST['lastName'];
            $userName= $_POST['userName'];
            $email= $_POST['email'];
            $password=$_POST['password'];
            $data = array($email, $password, $userName, $firstName, $lastName);

            $errors = new CheckUser($data);
            if(empty($errors->errors)){
                $user = new User();
                $user->setUserName($userName);
                $user->setFirstName($firstName);
                $user->setLastName($lastName);
                $user->setEmail($email);
                $user->setPassword($password);
                $user->createUser();
            }
        }
        include_once ('views/register.php');
        return true;
    }

    /**
     * Action for user authorisation
     * @return bool
     */

    public function actionLogin()
    {
        $email= '';
        $password='';

        if(isset($_POST['submitLog'])){


            $email= $_POST['email'];
            $password=$_POST['password'];

            $data = array($email, $password);
            $errors = new CheckUser($data);

            if(empty($errors->errors)){
                $user = new User();
                $user->setEmail($email);
                $user->setPassword($password);
                $user->getUser();
                header('Location: /cabinet');

            }
        }

        include_once ('views/login.php');
        return true;
    }

    /**
     * Action for exit the page
     * @return bool
     */
    public function actionLogout()
    {
        $user = new Authenticate();
        $user->logout();
        header('Location: /');
        return true;
    }
}