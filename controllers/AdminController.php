<?php

/**
 * Controller AdminController
 */
use Base\Controller;
use Model\Authenticate;
use Model\User;
use App\Response;

class AdminController extends Controller
{
    /**
     * AdminController constructor.
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
        $this->view->render('admin/index.php');
        return true;
    }
}
