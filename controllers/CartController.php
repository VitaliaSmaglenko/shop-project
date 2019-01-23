<?php

/**
 * Controller CartController
 */

use Model\Cart;
use Model\Products;
use Base\Controller;

class CartController extends Controller
{
    /**
     * Action for cart page
     * @return bool
     */
    public function actionCart():bool
    {
        $cartProducts = new Cart();
        $cart = $cartProducts->getProducts();
        $dataPage['cart'] = $cart;
        $products = new Products();
        if($cart) {
            $productsId = array_keys($cart);
            $products = $products->getByIds($productsId);
            $dataPage['products'] = $products;
            $price = $cartProducts->getPrice($products);
            $dataPage['price'] = $price;

        }

        $this->view->render('cart.php',  $dataPage);
        return true;
    }

    /**
     * Action for add product to cart
     * @param int $id
     * @return bool
     */
    public function actionAdd(int $id):bool
    {
        $cart = new Cart();
     //   $product = new Products();
      //  $item = $product->getById($id);
        //$cart->setAvailability($item->getAvailability());
       // $count = $cart->updateAvailability();
        var_dump($_SESSION['availability'.$id]);
        if($_SESSION['availability'.$id] > 0) {
            $count = $cart->updateAvailability($id);
           // var_dump($count);
            $result = $cart->addProduct($id);


        }
        $path = ('/product/' . $id);
        header('Location:' . $path);
        return true;
    }

    /**
     * Action for delete product in cart
     * @param int $id
     * @return bool
     */
    public function actionDelete(int $id):bool
    {
        $cart = new Cart();
        $cart->deleteProduct($id);
        $path = ('/cart');
        header('Location:'.$path);
        return true;
    }

    /**
     * Action for plus product in cart
     * @param int $id
     * @return bool
     */
    public function actionPlus(int $id):bool
    {
        $cart = new Cart();
        $cart->plusProduct($id);
        $path = ('/cart');
        header('Location:'.$path);
        return true;
    }

    /**
     * Action for minus product in cart
     * @param int $id
     * @return bool
     */
    public function actionMinus(int $id):bool
    {
        $cart = new Cart();
        $cart->minusProduct($id);
        $path = ('/cart');
        header('Location:'.$path);
        return true;
    }
}