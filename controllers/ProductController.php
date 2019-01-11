<?php
/**
 * Controller ProductController
 */
use Model\Products;


class ProductController
{
    public $checkAuth;
    public function __construct()
    {
        $this->checkAuth = new Authenticate();
    }

    /**
     * Action for the product review page
     * @param $id
     * @return bool
     */

    public function actionView($id){
        $product = new Products();
        $product=$product->getProductsById($id);
        include_once ('views/product.php');

        return true;
    }

}