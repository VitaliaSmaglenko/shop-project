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
use Base\Controller;
use App\Response;

class OrderController extends Controller
{
    /**
     * Action for make an order
     * @return bool
     */
    public function actionCheckout():bool
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
        $dataPage['result'] = $result;
        if ($cartProduct == false) {
            unset($_POST);
        }

        if (isset($_POST['submitSave'])) {
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $phone = $_POST['phone'];
            $comment = $_POST['comment'];

            $dataPage['phone'] = $phone;
            $dataPage['lastName'] = $lastName;
            $dataPage['firstName'] = $firstName;

            $errors = new CheckUser();
            $errors = $errors->checkCheckout($firstName, $lastName, $phone);
            $dataPage ['errors'] = $errors;
            $productsIds = array_keys($cartProduct);
            $items = $product->getByIds($productsIds);
            $price = $cart->getPrice($items);
            $dataPage['price'] = $price;
            $quantity = $cart->countProducts();
            $dataPage['quantity'] = $quantity;
            if (empty($errors)) {
                if (!$isUser->isAuth()) {
                        $userId = false;
                } else {
                    $userId = $isUser->checkLogged();
                    if ($userId == false) {
                        header('Location: /login');
                    }
                }
                $buyer->setLastName($lastName);
                $buyer->setFirstName($firstName);
                $buyer->setPhone($phone);
                $buyer->setComment($comment);
                $buyer->setData();
                $buyer->setUserId($userId);
                $result = $buyer->createBuyers();

                $dataPage['result'] = $result;
                $order->setIdBuyers($buyer->getBuyersId());
                $order->setTotalCount($quantity);
                $order->setTotalPrice($price);
                $order->createOrder();

                foreach ($cartProduct as $cartPr) {
                    $productOrder->setIdOrders($order->getOrdersId());
                    $item = $product->getById(key($cartProduct));
                    next($cartProduct);
                    $productOrder->setIdProduct($item->getId());
                    $productOrder->setPrice($item->getPrice());
                    $productOrder->setQuantity($cartPr);
                    $productOrder->createProductOrder();
                }
                if ($result) {
                    $cart->clear();
                }
            }
        } else {
            if ($cartProduct == false) {
                Response::redirect('/');
            } else {
                $productsIds = array_keys($cartProduct);
                $items = $product->getByIds($productsIds);
                $price = $cart->getPrice($items);
                $dataPage['price'] = $price;
                $quantity = $cart->countProducts();
                $dataPage['quantity'] = $quantity;
                $firstName = false;
                $lastName = false;
                $phone = false;
                $comment = false;
                $dataPage['phone'] = $phone;
                $dataPage['lastName'] = $lastName;
                $dataPage['firstName'] = $firstName;

                if ($isUser->isAuth()) {
                    $userId = $isUser->checkLogged();
                    if ($userId == false) {
                        Response::redirect('/login');
                    }
                    $user = $user->getById($userId);
                    $firstName = $user->getFirstName();
                    $dataPage['firstName'] = $firstName;
                    $lastName = $user->getLastName();
                    $dataPage['lastName'] = $lastName;
                    $phone = $user->getPhone();
                    $dataPage['phone'] = $phone;
                }
            }
        }
        $this->view->render('checkout.php', $dataPage);
        return true;
    }
}
