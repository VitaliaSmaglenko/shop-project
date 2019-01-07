<?php
/**
 *
 */
use Model\Products;


class productController
{
    public function actionView($id){
        $productObg = new Products();
        $product=$productObg->getProductsById($id);
        include_once ('views/product.php');

        return true;
    }

}