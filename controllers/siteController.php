<?php
/**
 * Controller siteController
 */

use Model\Category;
use Model\Products;

class siteController
{
    /**
     * Action for main page
     * @return bool
     */
    public function actionIndex(){

        $categoryObj = new Category();
        $categories=$categoryObj->getCategories();

        $productList = new Products();
        $productList = $productList->getProducts();

       include_once ('views/index.php');

       return true;
    }

}