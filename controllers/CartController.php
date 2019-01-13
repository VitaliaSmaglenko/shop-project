<?php

/**
 * Controller CartController
 */

use Model\Cart;


class CartController
{
    /**
     * Action for cart page
     * @return bool
     */
    public function actionCart(){
        include_once ('views/cart.php');
        return true;
    }

    /**
     * Action for add product to cart
     * @param $id
     * @return bool
     */
    public function actionAdd($id)
    {
        $cart = new Cart();
        $result = $cart ->addProduct($id);
        $path = ('/product/'.$id);
        header('Location:'.$path);
        return true;
    }
}