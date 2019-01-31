<?php
/**
 * Controller CatalogController
 */
use Model\Category;
use Model\Products;
use Base\Controller;
use App\Pagination;

class CatalogController extends Controller
{

    /**
     * Action for display all products
     * @return bool
     */
    public function actionIndex(int $page = 1):bool
    {

        $categories = new Category();
        $categories = $categories->get();
        $dataPage['categories'] = $categories;
        $product = new Products();
        $productList = $product->getCatalog($page);
        $dataPage['productList'] = $productList;
        $total = $product->getTotalProduct();
        $pagination = new Pagination($total, $page, Products::LIMIT, 'page-');
        $dataPage['pagination'] = $pagination;

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
        $product = new Products();
        $productList = $product->getByCategory($id, $page);
        $dataPage['productList'] = $productList;
        $total = $product->getTotalProductById($id);

        $pagination = new Pagination($total, $page, Products::LIMIT, 'page-');
        $dataPage['pagination'] = $pagination;

        $this->view->render('category.php', $dataPage);
        return true;
    }

    /**
     * Action for sorting by price
     * @return bool
     */
    public function actionPrice(int $page = 1):bool
    {
        $categories = new Category();
        $categories = $categories->get();
        $dataPage['categories'] = $categories;
        $product = new Products();
        $productList = $product->getSortingByPrice($page);
        $dataPage['productList'] = $productList;

        $total = $product->getTotalProduct();
        $pagination = new Pagination($total, $page, Products::LIMIT, 'page-');
        $dataPage['pagination'] = $pagination;

        $this->view->render('catalog.php', $dataPage);
        return true;
    }

    /**
     * Action for search product by brand
     * @param string $search
     * @param int $page
     * @return bool
     */
    public function actionSearch(string $search = '', int $page = 1):bool
    {
        $categories = new Category();
        $categories = $categories->get();
        $dataPage['categories'] = $categories;
        $product = new Products();
        $productList = $product->getSearch($search, $page);
        $dataPage['productList'] = $productList;

        if ($productList) {
            $total = $product->getTotalSearch($search);
            $pagination = new Pagination($total, $page, Products::LIMIT, 'page-');
            $dataPage['pagination'] = $pagination;
            $this->view->render('category.php', $dataPage);
        } else {
            $productList = $product->getCatalog($page);
            $dataPage['productList'] = $productList;
            $total = $product->getTotalProduct();
            $pagination = new Pagination($total, $page, Products::LIMIT, 'page-');
            $dataPage['pagination'] = $pagination;
            $this->view->render('catalog.php', $dataPage);
        }
        return true;
    }
}
