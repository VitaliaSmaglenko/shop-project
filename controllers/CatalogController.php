<?php
/**
 * Controller CatalogController
 */
use Model\Category;
use Model\Products;
use App\View;

class CatalogController
{

    /**
     * Action for display all products
     * @return bool
     */
    public function actionIndex(){

        $categories = new Category();
        $dataPage['categories'] = $categories = $categories->get();
        $productList = new Products();
        $dataPage['productList'] = $productList = $productList->get();
        $view = new View();
        $view->render('catalog.php', $dataPage);
        return true;
    }

    /**
     * Action for display products by category
     * @return bool
     */
    public function actionCategory($id, $page = 1){

        $categoryObj = new Category();
        $dataPage['categories'] = $categories = $categoryObj->get();
        $productList = new Products();
        $dataPage['productList'] = $productList = $productList->getByCategory($id, $page);
        $view = new View();
        $view->render('category.php', $dataPage);
        return true;
    }

    public function actionPrice()
    {
        $categories = new Category();
        $dataPage['categories'] = $categories = $categories->get();
        $productList = new Products();
        $dataPage['productList'] = $productList = $productList->getSortingByPrice();
        $view = new View();
        $view->render('catalog.php', $dataPage);
        return true;
    }

    public function actionPriceCategory($id)
    {
        $categories = new Category();
        $dataPage['categories'] = $categories = $categories->get();
        $productList = new Products();
        $dataPage['productList'] = $productList = $productList->getByCategory($id);
        $view = new View();
        $view->render('catalog.php', $dataPage);
        return true;
    }

}