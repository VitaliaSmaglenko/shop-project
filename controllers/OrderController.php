<?php
/**
 * Controller OrderController
 */
use Model\Cart;
use Base\Controller;
use App\Response;
use App\Request;
use Service\OrderService;

class OrderController extends Controller
{
    /**
     * Action for make an order
     * @return bool
     */
    public function actionCheckout():bool
    {
        $orderService = new OrderService();
        $cart = new Cart();
        $cartProduct = $cart->getProducts();
        $result = false;
        $dataPage['result'] = $result;
        $request = new Request();

        if ($cartProduct == false) {
            Response::redirect('/');
        }
        $info = $orderService->totalInfo($cartProduct);
        $dataPage['info'] = $info;

        if (null !== $request->post('submitSave')) {
            $options = $orderService->setOptions();
            $errors = $orderService->errors($options);
            $dataPage ['errors'] = $errors;

            if (empty($errors)) {
                $options['userId'] = $orderService->isUser();
                $result = $orderService->createBuyers($options);
                $dataPage['result'] = $result;
                $orderService->createOrder($info['quantity'], $info['price']);
                $orderService->createProductOrder($cartProduct);

                if ($result) {
                    $cart->clear();
                }
            }
        } else {
                $dataPage['user'] = $orderService->userInfo();
        }
        $this->view->render('checkout.php', $dataPage);
        return true;
    }
}
