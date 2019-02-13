<?php

/**
 * Controller CartController
 */

use Model\Cart;
use Base\Controller;
use App\Response;
use Service\CartService;

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
        $cartService = new CartService();

        if ($cart) {
            $dataPage = $cartService->cart($cart);
        }
        $dataPage['cart'] = $cart;
        $this->view->render('cart.php', $dataPage);
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
        $result = $cart->addProduct($id);
        $path = ('/product/' . $id);
        Response::redirect($path);
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
        Response::redirect($path);
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
        Response::redirect($path);
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
        Response::redirect($path);
        return true;
    }
}
