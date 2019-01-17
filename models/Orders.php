<?php
/**
 * Created by PhpStorm.
 * User: Виталия
 * Date: 15.01.2019
 * Time: 12:45
 */

namespace Model;

use App\PDODB;


class Orders
{
    private $idBuyers;
    private $id;
    private $totalPrice;
    private $totalCount;

    public function createOrder()
    {

            $sql = 'INSERT INTO orders (id_buyers, total_price, total_count) '.
                'VALUES (:idBuyers, :totalPrice, :totalCount);';
            $pdo = new PDODB();
            $pdo = new PDODB();
            $result = $pdo->addOrders($sql, $this->getIdBuyers(),
                    $this->getTotalPrice(), $this->getTotalCount());
            return $result;
    }

    public function getOrdersId()
    {
        $sql = "SELECT id FROM orders  ORDER BY id DESC LIMIT 1";
        $pdo = new PDODB();
        $result = $pdo->selectData($sql);

        for ($i=0; $i<count($result); $i++) {
            $this->setId($result[$i]['id']);
        }
        return $this->getId();
    }


    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setIdBuyers($id){
        $this->idBuyers = $id;
    }

    public function getIdBuyers(){
        return $this->idBuyers;
    }

    public function setTotalPrice($totalPrice){
        $this->totalPrice = $totalPrice;
    }

    public function getTotalPrice(){
        return $this->totalPrice;
    }
    public function setTotalCount($totalCount){
        $this->totalCount = $totalCount;
    }

    public function getTotalCount(){
        return $this->totalCount;
    }
}