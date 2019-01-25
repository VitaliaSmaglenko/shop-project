<?php
/**
 * Controller CabinetController
 */
use Model\Authenticate;
use Model\User;
use Model\CheckUser;
use Base\Controller;
use Model\Buyers;
use Model\Orders;
use Model\ProductOrder;

class CabinetController extends Controller
{
    /**
     * Action for show user cabinet
     * @return bool
     */
    public function actionIndex():bool
    {
        $user = new Authenticate();
        $userId = $user->checkLogged();
        if ($userId == false) {
            header('Location: /login');
        }
        $user = new User();
        $user = $user->getById($userId);
        $dataPage['user'] = $user;
        $role = false;
        if ($user->getRole() == "admin") {
            $role = true;
        }
        $dataPage['role'] = $role;
        $this->view->render('cabinet.php', $dataPage);
        return true;
    }

    /**
     * Action for edit data
     * @return bool
     */
    public function actionEdit():bool
    {
        $user = new Authenticate();
        $userId = $user->checkLogged();
        if ($userId == false) {
            header('Location: /login');
        }
        $user = new User();
        $user = $user->getById($userId);
        $dataPage['user'] = $user;

        $firstName = '';
        $lastName = '';
        $password='';
        $phone='';

        $result = false;
        $dataPage['result'] = $result;
        if (isset($_POST['submitSave'])) {
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $password=$_POST['password'];
            $phone = $_POST['phone'];
            $errors = new CheckUser();
            $errors = $errors->checkEdit((hash("md5", $password)), $firstName, $lastName, $phone);
            $dataPage['errors'] = $errors;
            if (empty($errors)) {
                $user->setFirstName($firstName);
                $user->setLastName($lastName);
                $user->setPassword((hash("md5", $password)));
                $user->setPhone($phone);
                $result = $user->updateUser($userId);
                $dataPage['result'] = $result;
            }
        }
        $this->view->render('edit.php', $dataPage);
        return true;
    }

    public function actionOrders():bool
    {
        $user = new Authenticate();
        $userId = $user->checkLogged();

        $buyers = new Buyers();

        $buyersId = $buyers->getUserById($userId);
        $dataPage['buyers'] = $buyersId;
        $ordersData = array();
        for ($i = 0; $i < count($buyersId); $i++) {
               $orders = new Orders();
               $ordersData[$i] = $orders->getByBuyersId($buyersId[$i]->getId());
        }
        $dataPage['orders'] = $ordersData;
        $productOrder = new ProductOrder();
        for ($i = 0; $i < count($ordersData); $i++) {
            $productOrderData[$i] = $productOrder->getByOrdersId($ordersData[$i]->getId());
        }
        $dataPage['productOrder'] = $productOrderData;
        $this->view->render('orders.php', $dataPage);
        return true;
    }
}
