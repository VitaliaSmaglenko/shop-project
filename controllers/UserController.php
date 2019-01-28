<?php
/**
 *  Controller UserController
 */
use Base\Controller;
use Model\User;
use Model\CheckUser;
use Model\Authenticate;
use App\Response;
use App\Request;

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
        $request = new Request();
        if (null !== $request->post('submitReg')) {
            $dataPage['firstName']  = $firstName = $request->post('firstName');
            $dataPage['lastName'] = $lastName = $request->post('lastName');
            $dataPage['userName'] = $userName = $request->post('userName');
            $dataPage['email'] = $email = $request->post('email');
            $password = $request->post('password');
            $dataPage['phone'] = $phone = $request->post('phone');

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
        $request = new Request();
        $dataPage = [];
        if (null !== $request->post('submitLog')) {
            $email = $request->post('email');
            $password = $request->post('password');
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
