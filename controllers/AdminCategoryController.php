<?php

use App\View;
use Model\Products;
use Model\Category;

class AdminCategoryController extends  App\Admin
{
    public  function  actionIndex()
    {
        $this->checkAdmin();
        $category = new Category();
        $categories = $category->getAdmin();
        $pageData['categories'] = $categories;
        $view = new View();
        $view->render('admin/category.php', $pageData);
        return true;
    }

    public function actionCreate()
    {
        $this->checkAdmin();
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

        $view = new View();
        $view->render('admin/addCategory.php',  $dataPage);
        return true;
    }

    public function actionUpdate($id)
    {
        $this->checkAdmin();
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

        $view = new View();
        $view->render('admin/updateCategory.php',  $dataPage);
        return true;

    }

    public function actionDelete($id)
    {
        $this->checkAdmin();
        $pageData['id'] = $id;
        if(isset($_POST['submitDelete'])){
            $category = new Category();
            $category->deleteById($id);
            header('Location: /admin/category');
        }
        $view = new View();
        $view->render('admin/deleteCategory.php', $pageData);
        return true;
    }
}