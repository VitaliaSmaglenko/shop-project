<?php

/**
 * Controller CartController
 */

use Model\Cart;
use Model\Products;


class CartController
{
    /**
     * Action for cart page
     * @return bool
     */
    public function actionCart(){
        $cartProducts = new Cart();
        $cart=$cartProducts->getProducts();
        $products = new Products();
        if($cart) {
            $productsId = array_keys($cart);
            $products = $products->getProductsByIds($productsId);
            $price = $cartProducts->getPrice($products);

        }
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