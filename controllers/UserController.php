<?php
/**
 *  Controller UserController
 */
use Model\User;
use Model\CheckUser;

class UserController
{
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

            $errors = new CheckUser($userName, $firstName, $lastName, $email, $password);
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
}