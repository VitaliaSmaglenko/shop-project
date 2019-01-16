<?php
/**
 * Created by PhpStorm.
 * User: Виталия
 * Date: 15.01.2019
 * Time: 12:45
 */

namespace Model;


class ProductOrder
{
    private $firstName;
    private $lastName;
    private $comment;
    private $phone;
    private $updated_at;
    private $created_at;
    private $products;
    private $status;


    public function createOrder()
    {
        $sql ='';
        $pdo = new PDODB();
        $result=$pdo->addUser();
        return $result;
    }

}