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


        $categories = new Category();
        $categories = $categories->get();

        $productList = Products::getProductsList();

       include_once ('views/index.php');

       return true;
    }

}