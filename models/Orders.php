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
    private $status;

    public function createOrder()
    {

            $sql = 'INSERT INTO orders (id_buyers, total_price, total_count) '.
                'VALUES (:idBuyers, :totalPrice, :totalCount);';
            $pdo = new PDODB();
            $data = array(':idBuyers' => $this->getIdBuyers(), ':totalPrice' => $this->getTotalPrice(),
                ':totalCount' => $this->getTotalCount());
            $result = $pdo->prepareData($sql,$data, 'execute');
            return $result;
    }

    public function getOrdersId()
    {
        $sql = "SELECT id FROM orders  ORDER BY id DESC LIMIT 1";
        $pdo = new PDODB();
        $result = $pdo->queryData($sql);

        for ($i=0; $i<count($result); $i++) {
            $this->setId($result[$i]['id']);
        }
        return $this->getId();
    }

    public function deleteById($id)
    {
        $sql = "DELETE FROM orders WHERE id = :id";
        $pdo = new PDODB();
        $data = array(':id' => $id);
        $buyer = $pdo->prepareData($sql, $data, 'execute');
        return $buyer;
    }

    public function getById($id)
    {
        $sql = 'SELECT orders.id, id_buyers, total_price, total_count, orders.status'.
            ' FROM orders INNER JOIN buyers  ON orders.id_buyers=buyers.id WHERE orders.id_buyers = :id';
        $pdo = new PDODB();
        $data = array('id' => $id);
        $result = $pdo->prepareData($sql, $data, 'fetchAll');
        $objOrder = new Orders();
        for ($i=0; $i<count($result); $i++) {
            $objOrder ->setId($result[$i]['id']);
            $objOrder ->setIdBuyers($result[$i]['id_buyers']);
            $objOrder ->setStatus($result[$i]['status']);
            $objOrder -> setTotalPrice($result[$i]['total_price']);
            $objOrder ->setTotalCount($result[$i]['total_count']);
        }
        return $objOrder;
    }

    public function getStatusText($status)
    {
        switch ($status){
            case '1':
                return "New orders";
                break;
            case '2':
                return "In processing";
                break;
            case '3':
                return "is delivered";
                break;
            case '4':
                return"Is closed";
                break;
        }
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
    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }
}