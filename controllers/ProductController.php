<?php
/**
 * Controller ProductController
 */
use Model\Products;


class ProductController
{
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