<?php
/**
 * Controller CatalogController
 */
use Model\Category;
use Model\Products;
use Base\Controller;

class CatalogController extends Controller
{

    /**
     * Action for display all products
     * @return bool
     */
    public function actionIndex():bool
    {

        $categories = new Category();
        $categories = $categories->get();
        $dataPage['categories'] = $categories;
        $productList = new Products();
        $productList = $productList->get();
        $dataPage['productList'] = $productList;

        $this->view->render('catalog.php', $dataPage);
        return true;
    }

    /**
     * Action for display products by category
     * @param int $id
     * @param int $page
     * @return bool
     */
    public function actionCategory(int $id, int $page = 1):bool
    {

        $categoryObj = new Category();
        $categories = $categoryObj->get();
        $dataPage['categories'] = $categories;
        $productList = new Products();
        $productList = $productList->getByCategory($id, $page);
        $dataPage['productList'] = $productList;

        $this->view->render('category.php', $dataPage);
        return true;
    }

    /**
     * Action for sorting by price
     * @return bool
     */
    public function actionPrice():bool
    {
        $categories = new Category();
        $categories = $categories->get();
        $dataPage['categories'] = $categories;
        $productList = new Products();
        $productList = $productList->getSortingByPrice();
        $dataPage['productList'] = $productList;

        $this->view->render('catalog.php', $dataPage);
        return true;
    }

    /**
     * Action for sorting by price
     * @param int $id
     * @return bool
     */
    public function actionPriceCategory(int $id):bool
    {
        $categories = new Category();
        $categories = $categories->get();
        $dataPage['categories'] = $categories;
        $productList = new Products();
        $productList = $productList->getByCategory($id);
        $dataPage['productList'] = $productList;

        $this->view->render('catalog.php', $dataPage);
        return true;
    }

}