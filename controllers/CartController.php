<?php

/**
 * Controller CartController
 */

use Model\Cart;
use Model\Products;
use App\View;

class CartController
{
    /**
     * Action for cart page
     * @return bool
     */
    public function actionCart(){
        $cartProducts = new Cart();
        $dataPage['cart'] = $cart=$cartProducts->getProducts();
        $products = new Products();
        if($cart) {
            $productsId = array_keys($cart);
            $dataPage['products'] = $products = $products->getByIds($productsId);
            $dataPage['price'] = $price = $cartProducts->getPrice($products);

        }
        $view = new View();
        $view->render('cart.php',  $dataPage);
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

    public function actionDelete($id)
    {
        $cart = new Cart();
        $cart->deleteProduct($id);
        $path = ('/cart');
        header('Location:'.$path);
        return true;
    }

    public function actionPlus($id)
    {
        $cart = new Cart();
        $cart->plusProduct($id);
        $path = ('/cart');
        header('Location:'.$path);
        return true;
    }

    public function actionMinus($id)
    {
        $cart = new Cart();
        $cart->minusProduct($id);
        $path = ('/cart');
        header('Location:'.$path);
        return true;
    }
}