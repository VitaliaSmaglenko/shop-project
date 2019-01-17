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
        $isUser = new Authenticate();
        $user = new User();
        $product = new Products();
        $buyer = new Buyers();
        $order = new Orders();
        $productOrder = new ProductOrder();
        $result = false;

        if($cartProduct == false){
         unset($_POST);
        }

        if (isset($_POST['submitSave'])) {
            $firstName=$_POST['firstName'];
            $lastName = $_POST['lastName'];
            $phone = $_POST['phone'];
            $comment = $_POST['comment'];

            $errors = new CheckUser();
            $errors = $errors->checkCheckout( $firstName, $lastName, $phone);
            $productsIds = array_keys($cartProduct);
            $items = $product->getProductsByIds($productsIds);
            $price = $cart->getPrice($items);
            $quantity = $cart->countProducts();
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
                $order->setTotalCount($quantity);
                $order->setTotalPrice( $price);
                $order->createOrder();
                foreach($cartProduct as $cartPr) {
                    $productOrder->setIdOrders($order->getOrdersId());
                    $item=$product->getProductsById(key($cartProduct));
                    next($cartProduct);
                    $productOrder->setIdProduct($item->getId());
                    $productOrder->setPrice($item->getPrice());
                    $productOrder->setQuantity($cartPr);
                    $productOrder->createProductOrder();
                }
                if($result){
                    $cart->clear();

                }
            }

        } else{
            /// form not submit
            /// if products has'nt in cart
            if($cartProduct == false){
                header('Location: /');
           } else{
                //if in cart exists products
                $productsIds = array_keys($cartProduct);
                $items = $product->getProductsByIds($productsIds);
                $price = $cart->getPrice($items);
                $quantity = $cart->countProducts();
                $firstName = false;
                $lastName = false;
                $phone = false;
                $comment = false;

                if($isUser->isAuth()){
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