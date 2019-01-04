<?php
use Model\Category;
use Model\Products;

class catalogController
{
    public function actionIndex(){

        $categories = Category::getCategoryList();
        $productList = Products::getProductsList();

        include_once ('views/catalog.php');
        return true;
    }

    public function actionCategory($id){

        $categories = Category::getCategoryList();
        $productList = Products::getProductsByCategory($id);

        include_once ('views/category.php');
        return true;
    }

}