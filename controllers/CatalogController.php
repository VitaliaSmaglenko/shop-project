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
       $dataPage[] =$categories=$categories->getCategories();
        $productList = new Products();
        $dataPage[] = $productList = $productList->getProducts();
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
        $categories=$categoryObj->getCategories();
        $productList = new Products();
        $productList = $productList->getProductsByCategory($id, $page);
        include_once ('views/category.php');
        return true;
    }

    public function actionPrice()
    {
        $categories = new Category();
        $categories=$categories->getCategories();
        $productList = new Products();
        $productList = $productList->getProductsSortingByPrice();
        include_once ('views/catalog.php');
        return true;
    }

    public function actionPriceCategory($id)
    {
        $categories = new Category();
        $categories=$categories->getCategories();
        $productList = new Products();
        $productList = $productList->getProductsByCategory($id);
        include_once ('views/category.php');
        return true;
    }

}