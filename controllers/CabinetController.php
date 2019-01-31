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
use Model\FavoritesProduct;
use App\Response;
use App\Request;

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
            Response::redirect('/login');
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
            Response::redirect('/login');
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
        $request = new Request();
        if (null !== $request->post('submitSave')) {
            $firstName = $request->post('firstName');
            $lastName = $request->post('lastName');
            $password = $request->post('password');
            $phone = $request->post('phone');
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

    /**
     * Action for display orders
     * @return bool
     */
    public function actionOrders():bool
    {
        $user = new Authenticate();
        $userId = $user->checkLogged();

        $buyers = new Buyers();

        $buyersId = $buyers->getUserById($userId);
        $dataPage['buyers'] = $buyersId;

        if ($buyersId) {
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
        }
        $this->view->render('orders.php', $dataPage);
        return true;
    }

    /**
     * Action for display favorites products
     * @return bool
     */
    public function actionFavorites():bool
    {
        $user = new Authenticate();
        $userId = $user->checkLogged();
        if ($userId == false) {
            Response::redirect('/login');
        }
        $favoritesProduct = new FavoritesProduct();
        $favoritesProduct->setIdUser($userId);
        $product = $favoritesProduct->get();

        $dataPage['products'] = $product;
        $this->view->render('favorites.php', $dataPage);
        return true;
    }

    /**
     * Action for delete favorites products
     * @param int $id
     * @return bool
     */
    public function actionDelete(int $id):bool
    {
        $favoritesProduct = new FavoritesProduct();
        $favoritesProduct->setIdProduct($id);
        $favoritesProduct->delete();
        $path = ('/cabinet/favorites');
        Response::redirect($path);
        return true;
    }
}
