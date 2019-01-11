<?php
/**
 * Controller SiteController
 */

use Model\Category;
use Model\Products;
use Model\Authenticate;

class SiteController
{
    public $checkAuth;
    public function __construct()
    {
       $this->checkAuth = new Authenticate();


    }

    /**
     * Action for main page
     * @return bool
     */
    public function actionIndex(){

        $categories = new Category();
        $categories=$categories->getCategories();

        $productList = new Products();
        $productList = $productList->getProducts();




       include_once ('views/index.php');

       return true;
    }

}