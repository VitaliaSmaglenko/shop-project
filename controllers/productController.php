<?php
include_once ('models/Products.php');
class productController
{
    public function actionView($id){
        $product = Products::getProductsList();

        $id = Products::getProductsItems($id);

        include_once ('views/product.php');

        return true;
    }

}