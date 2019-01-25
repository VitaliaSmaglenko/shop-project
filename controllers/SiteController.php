<?php
/**
 * Controller SiteController
 */
use Base\Controller;
use Model\Category;
use Model\Products;

class SiteController extends Controller
{

    /**
     * Action for main page
     * @return bool
     */
    public function actionIndex():bool
    {
        $categories = new Category();
        $categories = $categories->get();
        $dataPage['categories'] = $categories;
        $productList = new Products();
        $productList = $productList->get();
        $dataPage['productList'] =  $productList;
        $this->view->render('index.php', $dataPage);
        return true;
    }

    /**
     * @return bool
     */
    public function actionNotFound():bool
    {
        $this->view->render('404.php');
        return true;
    }
}
