<?php
/**
 * Controller OrderController
 */
use Model\Cart;
use Model\ProductOrder;
use Model\Orders;
use Model\Products;
use Model\Authenticate;
use Model\User;
use Model\CheckUser;
use Model\Buyers;

class OrderController
{
    public function actionCheckout()
    {
        $cart = new Cart();
        $cartProduct = $cart->getProducts();

        var_dump($cartProduct);
        $isUser = new Authenticate();
        $user = new User();
        $product = new Products();

        $buyer = new Buyers();
        $order = new Orders();
        $productOrder = new ProductOrder();
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


                $buyer->setLastName($lastName);
                $buyer->setFirstName($firstName);
                $buyer->setPhone($phone);
                $buyer->setComment($comment);
                $buyer->setCreatedAt();
                $buyer->setUpdatedAt();
                $buyer->setUserId($userId);


                $result = $buyer->createBuyers();
                $order->setIdBuyers($buyer->getBuyersId());
                $order->createOrder();

                for($i=0; $i<count($cartProduct); $i++) {
                    $productOrder->setIdOrders($order->getOrdersId());
                    $product->getProductsById(key($cartProduct));
                    $productOrder->setIdProduct();
                    $productOrder->setPrice();
                    $productOrder->setQuantity();
                    $productOrder->createProductOrder();
                }

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
                    $lastName = $user->getLastName();
                    $phone = $user->getPhone();
                }
            }
        }
        include ('views/checkout.php');
    }

}