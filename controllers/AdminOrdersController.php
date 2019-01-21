<?php

use App\View;
use Model\Products;
use Model\Category;
use Model\Orders;
use Model\ProductOrder;
use Model\Buyers;

class AdminOrdersController extends App\Admin
{
    public function actionIndex()
    {
        $this->checkAdmin();
        $buyers = new Buyers();
        $buyers = $buyers->get();
        $orders = new Orders();
        $dataPage["buyers"] = $buyers;
        $view = new View();
        $view->render('admin/orders.php', $dataPage);
        return true;

    }

    public function actionDelete($id)
    {
        $this->checkAdmin();
        $pageData['id'] = $id;
        if(isset($_POST['submitDelete'])){
            $buyers = new Buyers();
            $buyers->deleteById($id);
            header('Location: /admin/orders');
        }
        $view = new View();
        $view->render('admin/deleteOrders.php', $pageData);
        return true;
    }

    public function actionShow($id)
    {
        $this->checkAdmin();
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
        $view = new View();
        $view->render('admin/showOrder.php', $dataPage);
        return true;
    }

    public function actionUpdate($id)
    {
        $this->checkAdmin();
        $buyer = new Buyers();
        $buyers = $buyer->getById($id);
        $dataPage["buyers"] = $buyers;

        if(isset($_POST["submitEdit"])){
            $options['last_name'] = $_POST["last_name"];
            $options['first_name'] = $_POST["first_name"];
            $options['phone'] = $_POST["phone"];
            $options['status'] = $_POST["status"];

            $errors = false;

            foreach ($options as $option){
                if(!isset($option) || strlen ($option)== 0){
                    $errors[] = "Fill in the field ".key($options);

                }
                next($options);
            }
            $dataPage['errors'] = $errors;

            if($errors == false){
                $buyer->setLastName( $options['last_name']);
                $buyer->setFirstName( $options['first_name']);
                $buyer->setPhone($options['phone']);
                $buyer->setStatusOrder($options['status']);
                $buyer->updateById($id);

                header("Location: /admin/orders");

            }
        }
        unset($_POST);
        $view = new View();
        $view->render('admin/updateOrders.php', $dataPage);
        return true;

    }

}