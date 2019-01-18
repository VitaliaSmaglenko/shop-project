<?php
/**
 * Controller SiteController
 */

use Model\Category;
use Model\Products;
use App\View;

class SiteController
{

    /**
     * Action for main page
     * @return bool
     */
    public function actionIndex(){
        $view = new View();
        $categories = new Category();
        $dataPage[] = $categories=$categories->getCategories();
        $productList = new Products();
         $productList = $productList->getProducts();
        $dataPage[] =  $productList;
        //var_dump($categories);
        $view->render('index.php',  $dataPage);


        return true;
    }

}