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
        $categories = new Category();
        $categories = $categories->get();
        $dataPage['categories'] = $categories;
        $productList = new Products();
        $productList = $productList->get();
        $dataPage['productList'] =  $productList;
        $view = new View();
        $view->render('index.php',  $dataPage);

        return true;
    }

    public function actionNotFound()
    {
        $view = new View();
        $view->render('404.php');
        return true;
    }

}