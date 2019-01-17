<?php
/**
 *  Controller UserController
 */
use Model\User;
use Model\CheckUser;
use Model\Authenticate;

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
        $phone = '';


        if(isset($_POST['submitReg'])){

            $firstName= $_POST['firstName'];
            $lastName= $_POST['lastName'];
            $userName= $_POST['userName'];
            $email= $_POST['email'];
            $password=$_POST['password'];
            $phone= $_POST['phone'];

            $errors = new CheckUser();
            $errors = $errors->checkRegistration($email, $password, $userName, $firstName, $lastName, $phone);

            if(empty($errors)){

                $user = new User();
                $user->setUserName($userName);
                $user->setFirstName($firstName);
                $user->setLastName($lastName);
                $user->setEmail($email);
                $user->setPassword(hash( "md5",$password));
                $user->setPhone($phone);
                $user->createUser();
                $user->getUser();
                header('Location: /cabinet');
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

        $a = 'romashka1234';
         if(isset($_POST['submitLog'])){


            $email= $_POST['email'];
            $password=$_POST['password'];
           // var_dump(password_hash($password, PASSWORD_BCRYPT));
            $errors = new CheckUser();
            $errors = $errors->checkAuthorisation($email, hash( "md5",$password));

            if(empty($errors)){
                $user = new User();
                $user->setEmail($email);
                $user->setPassword(hash( "md5",$password));

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