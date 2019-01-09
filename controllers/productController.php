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
        $productObg = new Products();
        $product=$productObg->getProductsById($id);
        include_once ('views/product.php');

        return true;
    }

}