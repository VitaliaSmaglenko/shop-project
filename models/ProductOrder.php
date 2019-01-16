<?php
/**
 * Created by PhpStorm.
 * User: Виталия
 * Date: 15.01.2019
 * Time: 12:45
 */

namespace Model;

use App\PDODB;


class ProductOrder
{
    private $idProduct;
    private $idOrders;
    private $price;
    private $quantity;

    public function createProductOrder()
    {
        $sql = 'INSERT INTO product_order(id_product, id_orders, price, quantity) ' .
               ' VALUES (:idProduct, :idOrders, :price, :quantity);';
        $pdo = new PDODB();
        $pdo = new PDODB();
        $result = $pdo->addProductOrder($sql, $this->getIdProduct(), $this->getIdOrders(), $this->price, $this->quantity);

        return $result;
    }

     public function setIdProduct($idProduct)
     {
         $this->idProduct = $idProduct;
     }

    public function getIdProduct()
    {
       return $this->idProduct;
     }

    public function setIdOrders($idOrders)
    {
        $this->idOrders = $idOrders;
     }

    public function getIdOrders()
    {
        return $this->idOrders;
     }

    public function setPrice($price)
    {
        $this->price = $price;
     }

    public function getPrice()
    {
        return $this->price;
     }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
     }

    public function getQuantity()
    {
        return $this->quantity;
     }
}