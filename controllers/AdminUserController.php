<?php
/**
 * Controller AdminUserController
 */
use Base\Controller;
use Model\Authenticate;
use Model\User;
use App\Response;
use App\Request;

class AdminUserController extends Controller
{
    /**
     * AdminUserController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $isUser = new Authenticate();
        $userId = $isUser->checkLogged();
        if ($userId == false) {
            Response::redirect('/login');
        }
        $user = new User();
        $user = $user->getById($userId);
        if ($user->getRole() == "admin") {
            return true;
        }
        die("Access denied");
    }

    /**
     * @return bool
     */
    public function actionIndex():bool
    {
         $user = new User();
         $userList  = $user->getAdmin();
         $pageData['user'] = $userList;
         $this->view->render('admin/users.php', $pageData);
         return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function actionUpdate(int $id):bool
    {
        $userObj = new User;
        $user = $userObj->getById($id);
        $dataPage['user'] = $user;
        $request = new Request();

        if (null !== $request->post("submitEdit")) {
            $options['firstName'] = $request->post('firstName');
            $options['lastName'] = $request->post('lastName');
            $options['userName'] = $request->post('userName');
            $options['phone'] = $request->post('phone');
            $options['email'] = $request->post('email');
            $options['role'] = $request->post('role');
            $errors = false;

            foreach ($options as $option) {
                if (!isset($option) || strlen($option) == 0) {
                    $errors[] = "Fill in the field " . key($options);
                }
                next($options);
            }
            $dataPage['errors'] = $errors;

            if ($errors == false) {
                $user->setUserName($options['userName']);
                $user->setPhone($options['phone']);
                $user->setFirstName($options['firstName']);
                $user->setLastName($options['lastName']);
                $user->setEmail($options['email']);
                $user->setRole($options['role']);
                $user->updateAdmin($id);
                Response::redirect('/admin/user');
            }
        }
        $this->view->render('admin/updateUser.php', $dataPage);
        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function actionUpdatePassword(int $id):bool
    {
        $userObj = new User;
        $request = new Request();
        $dataPage[]='';
        if (null !== $request->post("submitEdit")) {
            $options['password'] = $request->post('password');
            $errors = false;

            foreach ($options as $option) {
                if (!isset($option) || strlen($option) == 0) {
                    $errors[] = "Fill in the field " . key($options);
                }
                next($options);
            }
            $dataPage['errors'] = $errors;

            if ($errors == false) {

                $userObj->setPassword(hash("md5", $options['password']));
                $userObj->updatePasswordAdmin($id);
                Response::redirect('/admin/user');
            }
        }
        $this->view->render('admin/updatePassword.php',  $dataPage);
        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function actionDelete(int $id):bool
    {
        $pageData['id'] = $id;
        $request = new Request();
        if (null !== $request->post('submitDelete')) {
            $userObj = new User;
            $userObj->deleteById($id);
            Response::redirect('/admin/user');
        }
        $this->view->render('admin/deleteUser.php', $pageData);
        return true;
    }
}