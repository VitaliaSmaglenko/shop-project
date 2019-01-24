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
    private $nameProduct;

    public function createProductOrder()
    {
        $sql = 'INSERT INTO product_order(id_product, id_orders, price, quantity) ' .
               ' VALUES (:idProduct, :idOrders, :price, :quantity);';
        $pdo = new PDODB();
        $data = array(':idProduct' => $this->getIdProduct(), ':idOrders' => $this->getIdOrders(),
            ':price' => $this->price, ':quantity' => $this->quantity);
        $result = $pdo->prepareData($sql, $data, 'execute');

        return $result;
    }
    public function getById($id)
    {
        $sql = 'SELECT id_product, id_orders, product_order.price, quantity, name '.
            ' FROM product_order INNER JOIN products  ON product_order.id_product=products.id WHERE '.
            ' product_order.id_orders = :id';
        $pdo = new PDODB();
        $data = array('id' => $id);
        $result = $pdo->prepareData($sql, $data, 'fetchAll');
        $productOrderList = array();
        for ($i=0; $i<count($result); $i++) {
            $objProductOrder = new ProductOrder();
            $objProductOrder->setIdProduct($result[$i]["id_product"]);
            $objProductOrder->setNameProduct($result[$i]["name"]);
            $objProductOrder->setPrice($result[$i]["price"]);
            $objProductOrder->setQuantity($result[$i]["quantity"]);
            $productOrderList[]=$objProductOrder;
        }
        return $productOrderList;
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

    public function setNameProduct($nameProduct)
    {
        $this->nameProduct = $nameProduct;
    }

    public function getNameProduct()
    {
        return $this->nameProduct;
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
