<?php
use Model\Category;
use Model\Products;
class siteController
{
    public function actionIndex(){


        $categories = Category::getCategoryList();

        $productList = Products::getProductsList();

       include_once ('views/index.php');

       return true;
    }

}