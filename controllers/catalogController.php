<?php
use Model\Category;
use Model\Products;

class catalogController
{
    public function actionIndex(){

        $categoryObj = new Category();
        $categories=$categoryObj->getCategories();


        $productObj = new Products();
        $productList = $productObj->getProducts();

        include_once ('views/catalog.php');
        return true;
    }

    public function actionCategory($id, $page = 1){

        $categoryObj = new Category();
        $categories=$categoryObj->getCategories();

        $productObj = new Products();
        $productList = $productObj->getProductsByCategory($id, $page);

        include_once ('views/category.php');
        return true;
    }

}