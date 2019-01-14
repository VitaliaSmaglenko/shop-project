<?php
/**
 * Controller CabinetController
 */
use Model\Authenticate;
use Model\User;
use Model\CheckUser;

class CabinetController
{

    /**
     * Action for show user cabinet
     * @return bool
     */
    public function actionIndex()
    {
        $user = new Authenticate();
        $userId=$user->checkLogged();
        $user = new User();
        $user=$user->getUserById($userId);

        include_once ('views/cabinet.php');
        return true;
    }

    /**
     * Action for edit data
     * @return bool
     */
    public function actionEdit()
    {
        $user = new Authenticate();
        $userId=$user->checkLogged();
        $user = new User();
        $user=$user->getUserById($userId);

        $firstName= '';
        $lastName= '';
        $password='';
        $phone='';

        $result = false;
        if(isset($_POST['submitSave'])){

            $firstName= $_POST['firstName'];
            $lastName= $_POST['lastName'];
            $password=$_POST['password'];
            $phone=$_POST['phone'];

            $errors = new CheckUser();
            $errors = $errors->checkEdit($password, $firstName, $lastName, $phone);
            if(empty($errors)){
                $user->setFirstName($firstName);
                $user->setLastName($lastName);
                $user->setPassword($password);
                $user->setPhone($phone);
                $result = $user->updateUser($userId);

            }
        }
        include ('views/edit.php');
        return true;

    }

}