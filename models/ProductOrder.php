<?php
/**
 * Model ProductOrder
 */

namespace Model;

use App\PDODB;
use Base\Model;

class ProductOrder extends Model
{
    /**
     * @var
     */
    private $idProduct;
    private $idOrders;
    private $price;
    private $quantity;
    private $nameProduct;

    /**
     * @return bool
     */
    public function createProductOrder():bool
    {
        $sql = 'INSERT INTO product_order(id_product, id_orders, price, quantity) ' .
               ' VALUES (:idProduct, :idOrders, :price, :quantity);';
        $data = array(':idProduct' => $this->getIdProduct(), ':idOrders' => $this->getIdOrders(),
            ':price' => $this->price, ':quantity' => $this->quantity);
        $result = PDODB::prepareData($sql, $data, 'execute');

        return $result;
    }

    /**
     * @param int $id
     * @return array
     */
    public function getById(int $id):array
    {
        $sql = 'SELECT id_product, id_orders, product_order.price, quantity, name '.
            ' FROM product_order INNER JOIN products  ON product_order.id_product=products.id WHERE '.
            ' product_order.id_orders = :id';
        $data = array('id' => $id);
        $result = PDODB::prepareData($sql, $data, 'fetchAll');
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

    /**
     * @param int $id
     * @return array
     */
    public function getByOrdersId(int $id):array
    {
        $sql = 'SELECT id_product, id_orders, name, product_order.price, quantity  FROM product_order '.
            ' INNER JOIN products  ON product_order.id_product=products.id WHERE id_orders = :id';
        $data = array(':id' => $id);
        $result = PDODB::prepareData($sql, $data, 'fetchAll');
        $productOrderList = array();
        for ($i=0; $i<count($result); $i++) {
            $objProductOrder = new ProductOrder();
            $objProductOrder->setIdProduct($result[$i]["id_product"]);
            $objProductOrder->setPrice($result[$i]["price"]);
            $objProductOrder->setNameProduct($result[$i]["name"]);
            $objProductOrder->setQuantity($result[$i]["quantity"]);
            $productOrderList[]=$objProductOrder;
        }
        return  $productOrderList;
    }


    public function setIdProduct(int $idProduct):void
    {
         $this->idProduct = $idProduct;
    }

    public function getIdProduct():int
    {
        return $this->idProduct;
    }

    public function setIdOrders(int $idOrders):void
    {
        $this->idOrders = $idOrders;
    }

    public function getIdOrders():int
    {
        return $this->idOrders;
    }

    public function setPrice(int $price):void
    {
        $this->price = $price;
    }

    public function getPrice():int
    {
        return $this->price;
    }

    public function setNameProduct(string $nameProduct):void
    {
        $this->nameProduct = $nameProduct;
    }

    public function getNameProduct():string
    {
        return $this->nameProduct;
    }


    public function setQuantity(int $quantity):void
    {
        $this->quantity = $quantity;
    }

    public function getQuantity():int
    {
        return $this->quantity;
    }
}
