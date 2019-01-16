<?php
/**
 * Controller OrderController
 */
use Model\Cart;
use Model\ProductOrder;
use Model\Products;
use Model\Authenticate;
use Model\User;
use Model\CheckUser;

class OrderController
{
    public function actionCheckout()
    {
        $cart = new Cart();
        $cartProduct = $cart->getProducts();
        $isUser = new Authenticate();
        $user = new User();
        $product = new Products();
        $order = new ProductOrder();

        $result = false;

        if (isset($_POST['submitSave'])) {
            $firstName=$_POST['firstName'];
            $lastName = $_POST['lastName'];
            $phone = $_POST['phone'];
            $comment = $_POST['comment'];

            $errors = new CheckUser();
            $errors = $errors->checkCheckout( $firstName, $lastName, $phone);

            if(empty($errors)){


                if(!$isUser->isAuth()){
                        $userId = false;
                } else {
                    $userId = $isUser->checkLogged();
                }

                $result = $order->createOrder();
                if($result){
                    $cart->clear();
                }
            } else
            {
                $productsIds = array_keys($cartProduct);
                $product = $product->getProductsByIds($productsIds);
                $price = $cart->getPrice($product);
                $quantity = $cart->countProducts();
            }

        } else{
            /// form not submit
            /// if products has'nt in cart
            if($cartProduct == false){
                header('Location: /');
           } else{
                //if in cart exists products
                $productsIds = array_keys($cartProduct);
                $product = $product->getProductsByIds($productsIds);
                $price = $cart->getPrice($product);
                $quantity = $cart->countProducts();
                $firstName = false;
                $lastName = false;
                $phone = false;
                $comment = false;

                if(!$isUser->isAuth()){

                } else {
                    $userId = $isUser->checkLogged();
                    $user = $user->getUserById($userId);
                    $firstName = $user->getFirstName();
                }
            }
        }
        include ('views/checkout.php');
    }

}