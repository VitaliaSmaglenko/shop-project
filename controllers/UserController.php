<?php
/**
 *  Controller UserController
 */
use Base\Controller;
use Model\User;
use Model\CheckUser;
use Model\Authenticate;
use App\Response;

class UserController extends Controller
{
    /**
     * Action for user registration
     * @return bool
     */
    public function actionRegister():bool
    {
        $dataPage['firstName'] = $firstName = '';
        $dataPage['lastName'] = $lastName = '';
        $dataPage['userName'] =  $userName = '';
        $dataPage['email'] = $email = '';
        $password = '';
        $dataPage['phone'] = $phone = '';
        if (isset($_POST['submitReg'])) {
            $dataPage['firstName']  = $firstName = $_POST['firstName'];
            $dataPage['lastName'] = $lastName = $_POST['lastName'];
            $dataPage['userName'] = $userName = $_POST['userName'];
            $dataPage['email'] = $email = $_POST['email'];
            $password=$_POST['password'];
            $dataPage['phone'] = $phone= $_POST['phone'];

            $errors = new CheckUser();
            $errors = $errors->checkRegistration($email, $password, $userName, $firstName, $lastName, $phone);
            $dataPage['errors'] =  $errors;
            if (empty($errors)) {
                $user = new User();
                $user->setUserName($userName);
                $user->setFirstName($firstName);
                $user->setLastName($lastName);
                $user->setEmail($email);
                $user->setPassword(hash("md5", $password));
                $user->setPhone($phone);
                $user->createUser();
                $user = $user->get();
                $auth = new Authenticate();
                $auth->auth($user);
                Response::redirect('/cabinet');
            }
        }
        $this->view->render('register.php', $dataPage);
        return true;
    }

    /**
     * Action for user authorisation
     * @return bool
     */

    public function actionLogin():bool
    {
        $dataPage = [];
        if (isset($_POST['submitLog'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $errors = new CheckUser();
            $dataPage['errors'] = $errors = $errors->checkAuthorisation($email, hash("md5", $password));

            if (empty($errors)) {
                $user = new User();
                $user->setEmail($email);
                $user->setPassword(hash("md5", $password));
                $user = $user->get();
                $auth = new Authenticate();
                $auth->auth($user);
                Response::redirect('/cabinet');
            }
        }
        $this->view->render('login.php', $dataPage);
        return true;
    }

    /**
     * Action for exit the page
     * @return bool
     */
    public function actionLogout():bool
    {
        $user = new Authenticate();
        $user->logout();
        Response::redirect('/');
        return true;
    }
}
