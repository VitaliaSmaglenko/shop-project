<?php
/**
 * Controller CatalogController
 */
use Model\Category;
use Model\Products;

class CatalogController
{

    /**
     * Action for display all products
     * @return bool
     */
    public function actionIndex(){

        $categories = new Category();
        $categories=$categories->getCategories();
        $productList = new Products();
        $productList = $productList->getProducts();
        include_once ('views/catalog.php');
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

}