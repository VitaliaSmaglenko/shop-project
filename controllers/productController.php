<?php

use Model\Products;


class productController
{
    public function actionView($id){
        $product = Products::getProductsList();

        $id = Products::getProductsItems($id);

        include_once ('views/product.php');

        return true;
    }

}