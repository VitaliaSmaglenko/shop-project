<?php
/**
 * Controller AdminOrdersController
 */
use Base\Controller;
use Model\Orders;
use Model\ProductOrder;
use Model\Buyers;
use Model\Authenticate;
use Model\User;
use App\Response;
use App\Request;

class AdminOrdersController extends Controller
{
    /**
     * AdminOrdersController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $isUser = new Authenticate();
        $userId = $isUser->checkLogged();
        if ($userId == false) {
            Response::redirect('/login');
        }
        $user = new User();
        $user = $user->getById($userId);
        if ($user->getRole() == "admin") {
            return true;
        }
        die("Access denied");
    }

    /**
     * @return bool
     */
    public function actionIndex():bool
    {
        $buyers = new Buyers();
        $buyers = $buyers->get();
        $dataPage["buyers"] = $buyers;

        $this->view->render('admin/orders.php', $dataPage);
        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function actionDelete(int $id):bool
    {
        $pageData['id'] = $id;
        $request = new Request();
        if (null !== $request->post('submitDelete')) {
            $buyers = new Buyers();
            $buyers->deleteById($id);
            Response::redirect('/admin/orders');
        }

        $this->view->render('admin/deleteOrders.php', $pageData);
        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function actionShow(int $id):bool
    {
        $order = new Orders();
        $orders = $order->getById($id);
        $buyers = new Buyers();
        $buyers = $buyers->getById($id);
        $productOrder = new ProductOrder();
        $productOrder=$productOrder->getById($orders->getId());
        $status = $order->getStatusText($orders->getStatus());
        $dataPage["buyers"] = $buyers;
        $dataPage['orders'] = $orders;
        $dataPage['productOrder'] = $productOrder;
        $dataPage['status'] = $status;

        $this->view->render('admin/showOrder.php', $dataPage);
        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function actionUpdate(int $id):bool
    {
        $buyer = new Buyers();
        $buyers = $buyer->getById($id);
        $dataPage["buyers"] = $buyers;
        $request = new Request();
        if (null !== $request->post("submitEdit")) {
            $options['last_name'] = $request->post("last_name");
            $options['first_name'] = $request->post("first_name");
            $options['phone'] = $request->post("phone");
            $options['status'] = $request->post("status");
            $errors = false;

            foreach ($options as $option) {
                if (!isset($option) || strlen($option) == 0) {
                    $errors[] = "Fill in the field ".key($options);
                }
                next($options);
            }
            $dataPage['errors'] = $errors;

            if ($errors == false) {
                $buyer->setLastName($options['last_name']);
                $buyer->setFirstName($options['first_name']);
                $buyer->setPhone($options['phone']);
                $buyer->setStatusOrder($options['status']);
                $buyer->updateById($id);
                Response::redirect('/admin/orders');
            }
        }
        unset($_POST);

        $this->view->render('admin/updateOrders.php', $dataPage);
        return true;
    }
}
