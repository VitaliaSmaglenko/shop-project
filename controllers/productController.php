<?php
/**
 * Controller productController
 */
use Model\Products;


class productController
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