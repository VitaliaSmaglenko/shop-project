<?php

    //include_once ('models/Category.php');
    //include_once ('models/Products.php');

class siteController
{
    public function actionIndex(){


        $categories = Category::getCategoryList();

        $productList = Products::getProductsList();

       include_once ('views/index.php');

       return true;
    }

}