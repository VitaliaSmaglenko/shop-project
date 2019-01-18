<?php
/**
 * Controller CabinetController
 */
use Model\Authenticate;
use Model\User;
use Model\CheckUser;
use App\View;

class CabinetController
{

    /**
     * Action for show user cabinet
     * @return bool
     */
    public function actionIndex()
    {
        $user = new Authenticate();
        $userId = $user->checkLogged();
        if($userId == false){
            header('Location: /login');
        }
        $user = new User();
        $dataPage['user'] = $user=$user->getById($userId);
        $view = new View();
        $view->render('cabinet.php',  $dataPage);
        return true;
    }

    /**
     * Action for edit data
     * @return bool
     */
    public function actionEdit()
    {
        $user = new Authenticate();
        $userId = $user->checkLogged();
        if($userId == false){
            header('Location: /login');
        }
        $user = new User();
        $dataPage['user'] = $user = $user->getById($userId);

        $firstName = '';
        $lastName = '';
        $password='';
        $phone='';

        $dataPage['result'] = $result = false;
        if(isset($_POST['submitSave'])){

            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $password=$_POST['password'];
            $phone = $_POST['phone'];

            $errors = new CheckUser();
            $errors = $errors->checkEdit((hash( "md5",$password)), $firstName, $lastName, $phone);
            $dataPage['errors'] = $errors;
            if(empty($errors)){
                $user->setFirstName($firstName);
                $user->setLastName($lastName);
                $user->setPassword((hash( "md5",$password)));
                $user->setPhone($phone);
                $dataPage['result'] = $result = $user->updateUser($userId);

            }
        }
        $view = new View();
        $view->render('edit.php',  $dataPage);
        return true;

    }

}