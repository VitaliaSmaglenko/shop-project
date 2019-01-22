<?php
/**
 * Controller AdminCategoryController
 */
use Model\Authenticate;
use Model\User;
use Base\Controller;
use Model\Category;

class AdminCategoryController extends Controller
{
    /**
     * AdminCategoryController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $isUser = new Authenticate();
        $userId = $isUser->checkLogged();
        if($userId == false){
            header('Location: /login');
        }
        $user = new User();
        $user = $user->getById($userId);
        if($user->getRole() == "admin"){
            return true;
        }
        die("Access denied");
    }

    /**
     * @return bool
     */
    public  function  actionIndex():bool
    {
        $category = new Category();
        $categories = $category->getAdmin();
        $pageData['categories'] = $categories;

        $this->view->render('admin/category.php', $pageData);
        return true;
    }

    /**
     * @return bool
     */
    public function actionCreate():bool
    {
        $category = new Category();
        $dataPage[] = '';

        if(isset($_POST["submitSave"])){
            $options['category'] = $_POST['category'];
            $options['status'] = $_POST['status'];

            $errors = false;
              if(!isset($options['category']) || empty($options['category'])){
                    $errors[] = "Fill in the field ".$options['category'];
              }
              $dataPage['errors'] = $errors;
              if ($errors == false){
                  $category->setCategory($options['category']);
                  $category->setStatus( $options['status']);
                  $category->setCreatedAt();
                  $category->setUpdatedAt();
                  $category->create();
                  header("Location: /admin/category");
              }


        }
        unset($_POST);
        $this->view->render('admin/addCategory.php',  $dataPage);
        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function actionUpdate(int $id):bool
    {
        $category = new Category();
        $categories = $category->getById($id);
        $dataPage['categories'] = $categories;

        if(isset($_POST["submitSave"])){
            $options['category'] = $_POST['category'];
            $options['status'] = $_POST['status'];
            $errors = false;
            if(!isset($options['category']) || empty($options['category'])){
                $errors[] = "Fill in the field ".$options['category'];
            }
            $dataPage['errors'] = $errors;
            if ($errors == false){
                $category->setCategory($options['category']);
                $category->setStatus( $options['status']);
                $category->setUpdatedAt();
                $category->updateById($id);
                header("Location: /admin/category");
            }
        }
        unset($_POST);

        $this->view->render('admin/updateCategory.php',  $dataPage);
        return true;

    }

    /**
     * @param int $id
     * @return bool
     */
    public function actionDelete(int $id):bool
    {
        $pageData['id'] = $id;
        if(isset($_POST['submitDelete'])){
            $category = new Category();
            $category->deleteById($id);
            header('Location: /admin/category');
        }
        $this->view->render('admin/deleteCategory.php', $pageData);
        return true;
    }
}