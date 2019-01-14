<?php
/**
 * Controller OrderController
 */

class OrderController
{
    public function actionCheckout()
    {
        if (isset($_POST['submitSave'])) {
            $firstName=$_POST['firstName'];
            $lastName = $_POST['lastName'];
            $phone = $_POST['phone'];
            $comment = $_POST['comment'];

        }
        include ('views/checkout.php');
    }

}