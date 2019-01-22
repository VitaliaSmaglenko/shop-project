<?php

use App\View;
use Model\Products;
use Model\Category;
use Model\ProductImages;

class AdminProductController extends App\Admin
{
    public function actionIndex()
    {
        $this->checkAdmin();

        $product = new Products();
        $productList = $product->getAdmin();
        $pageData['productList'] = $productList;
        $view = new View();
        $view->render('admin/products.php', $pageData);
        return true;
    }

    public function actionCreate()
    {
        $this->checkAdmin();
        $product = new Products();
        $category = new Category();
        $categories = $category->getAdmin();
        $dataPage['categories'] = $categories;
        if(isset($_POST["submitSave"])){
            $options['name'] = $_POST['name'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            //$options['image'] = $_POST['image'];
            $options['availability'] = $_POST['availability'];
            $options['brand'] = $_POST['brand'];
            $options['description'] = $_POST['description'];
            $options['specifications'] = $_POST['specifications'];
            $options['is_new'] = $_POST['is_new'];
            $options['status'] = $_POST['status'];

            $errors = false;

            foreach ($options as $option){
                if(!isset($option) || strlen ($option)== 0){
                    $errors[] = "Fill in the field ".key($options);

                }
                next($options);
            }
            $dataPage['errors'] = $errors;

            if ($errors == false){

                $product->setName($options['name']);
                $product->setPrice($options['price']);
                $product->setCategoryId($options['category_id']);
               // $product->setImage($options['image']);
                $product->setAvailability($options['availability']);
                $product->setBrand($options['brand']);
                $product->setDescription($options['description']);
                $product->setSpecifications($options['specifications']);
                $product->setIsNew($options['is_new']);
                $product->setStatus($options['status']);
                $product->setUpdatedAt();
                $product->setCreatedAt();
                $lastId = $product->create();


                if($lastId){
                    if(is_uploaded_file($_FILES['image']["tmp_name"])){
                        move_uploaded_file($_FILES['image']["tmp_name"],
                            $_SERVER['DOCUMENT_ROOT']."/components/img/".$lastId.".jpg");
                        $productImages = new ProductImages();
                        $productImages->setImage("img/".$lastId.".jpg");
                        $productImages->setProductId($lastId);
                        $productImages->create();

                    }

                }


                header("Location: /admin/product");
            }

        }
        unset($_POST);


        $view = new View();
        $view->render('admin/addProduct.php', $dataPage);
        return true;
    }
    public function actionUpdate($id)
    {
        $this->checkAdmin();
        $product = new Products();
        $item = $product->getById($id);

        $dataPage['product'] = $item;

        $category = new Category();
        $categories = $category->getAdmin();
        $dataPage['categories'] = $categories;


        if(isset($_POST["submitEdit"])){
            $options['name'] = $_POST['name'];
            $options['price'] = $_POST['price'];
            $options['category_id'] = $_POST['category_id'];
            //$options['image'] = $_POST['image'];
            $options['availability'] = $_POST['availability'];
            $options['brand'] = $_POST['brand'];
            $options['description'] = $_POST['description'];
            $options['specifications'] = $_POST['specifications'];
            $options['is_new'] = $_POST['is_new'];
            $options['status'] = $_POST['status'];


            $errors = false;

            foreach ($options as $option){
                if(!isset($option) || strlen ($option)== 0){
                    $errors[] = "Fill in the field ".key($options);

                }
                next($options);
            }
            $dataPage['errors'] = $errors;

            if ($errors == false){


                $product->setName($options['name']);
                $product->setPrice($options['price']);
                $product->setCategoryId($options['category_id']);
                // $product->setImage($options['image']);
                $product->setAvailability($options['availability']);
                $product->setBrand($options['brand']);
                $product->setDescription($options['description']);
                $product->setSpecifications($options['specifications']);
                $product->setIsNew($options['is_new']);
                $product->setStatus($options['status']);
                $product->setUpdatedAt();
                $product->updateById($id);


                    if(is_uploaded_file($_FILES['image']["tmp_name"])){
                        move_uploaded_file($_FILES['image']["tmp_name"],
                            $_SERVER['DOCUMENT_ROOT']."/components/img/".$id.".jpg");
                        $productImages = new ProductImages();
                        $productImages->setImage("img/".$id.".jpg");
                        $productImages->updateById($id);

                    }


                header("Location: /admin/product");
            }

        }
        unset($_POST);
        $view = new View();
        $view->render('admin/updateProduct.php', $dataPage);
        return true;
    }


    public function actionDelete($id)
    {
        $this->checkAdmin();
        $pageData['id'] = $id;
        if(isset($_POST['submitDelete'])){
            $product = new Products();
            $product->deleteById($id);
            header('Location: /admin/product');
        }
        $view = new View();
        $view->render('admin/delete.php', $pageData);
        return true;

    }
}