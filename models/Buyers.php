<?php
/**
 * Created by PhpStorm.
 * User: phpstudent
 * Date: 16.01.19
 * Time: 18:26
 */

namespace Model;

use App\PDODB;

class Buyers
{
    private $firstName;
    private $lastName;
    private $comment;
    private $phone;
    private $updatedAt;
    private $createdAt;

    private $userId;
    private $id;
    private $orderStatus;



    public function createBuyers()
    {
        if($this->getUserId()==false) {
            $sql = 'INSERT INTO buyers (first_name, last_name, comment, phone,  updated_at, created_at) '
                . 'VALUES (:firstName, :lastName, :comment, :phone, :updatedAt, :createdAt);';
            $pdo = new PDODB();
            $data = array(':firstName' => $this->getFirstName(), ':lastName' => $this->getLastName(),
                ':comment' => $this->getComment(), ':phone' => $this->getPhone(),
                ':updatedAt' => $this->updatedAt, ':createdAt' => $this->getCreatedAt());
            $result = $pdo->prepareData($sql, $data, 'execute');
        } else {
            $sql = 'INSERT INTO buyers (first_name, last_name, comment, phone,  user_id, updated_at, created_at) '
                . 'VALUES (:firstName, :lastName, :comment, :phone, :userId, :updatedAt, :createdAt);';
            $pdo = new PDODB();
            $data = array(':firstName' => $this->getFirstName(), ':lastName' => $this->getLastName(),
                ':comment' => $this->getComment(), ':phone' => $this->getPhone(), ':userId' => $this->getUserId(),
               ':updatedAt' => $this->updatedAt, ':createdAt' => $this->getCreatedAt());
            $result = $pdo->prepareData($sql, $data, 'execute');
        }

        return $result;
    }

    public function getBuyersId()
    {
        $sql = "SELECT id FROM buyers ORDER BY id DESC LIMIT 1";
        $pdo = new PDODB();
        $result = $pdo->queryData($sql);

        for ($i=0; $i<count($result); $i++) {
            $this->setId($result[$i]['id']);
        }
        return $this->getId();
    }

    public function get()
    {
        $sql = "SELECT buyers.id, last_name, first_name, phone, updated_at, created_at, user_id, comment, status FROM buyers" .
            " INNER JOIN orders ON buyers.id = orders.id_buyers";
        $pdo = new PDODB();
        $result = $pdo->queryData($sql);
        $order = new Orders();
        $buyersList = array();
        for($i=0; $i<count($result); $i++){
            $objBuyers = new Buyers();
            $objBuyers->setId($result[$i]['id']);
            $objBuyers->setLastName($result[$i]["last_name"]);
            $objBuyers->setFirstName($result[$i]["first_name"]);
            $objBuyers->setPhone($result[$i]["phone"]);
            $objBuyers->setUpdatedAt($result[$i]["updated_at"]);
            $objBuyers->setCreatedAt($result[$i]["created_at"]);
            $objBuyers->setUserId($result[$i]["user_id"]);
            $objBuyers->setComment($result[$i]["comment"]);
            $objBuyers->setStatusOrder($order->getStatusText($result[$i]["status"]));
            $buyersList[] = $objBuyers;

        }

       return $buyersList;

    }

    public function updateById($id)
    {
        $sql = 'UPDATE buyers '.
            ' INNER JOIN orders ON buyers.id = orders.id_buyers ' .
            ' SET last_name = :last_name, first_name = :first_name, phone = :phone, status = :status '.
            '  WHERE buyers.id = :id';

        $pdo = new PDODB();
        $data= array(':last_name' => $this->getLastName(), ':first_name' => $this->getFirstName(), ':phone' => $this->getPhone(),
            ':status' => $this->getStatusOrder(), ':id' => $id);
        $result=$pdo->prepareData($sql, $data, 'execute');
        return $result;
    }

    public function deleteById($id)
    {
        $sql = "DELETE FROM buyers WHERE id = :id";
        $pdo = new PDODB();
        $data = array(':id' => $id);
        $buyer = $pdo->prepareData($sql, $data, 'execute');
        return $buyer;
    }

    public function getById($id)
    {
        $sql = 'SELECT buyers.id, status, first_name, last_name, phone, comment, user_id, created_at, updated_at '.
            ' FROM buyers INNER JOIN orders  ON orders.id_buyers=buyers.id WHERE buyers.id = :id';
        $pdo = new PDODB();
        $objBuyers = new Buyers();
        $data = array('id' => $id);
        $result = $pdo->prepareData($sql, $data, 'fetchAll');
        for($i=0; $i<count($result); $i++){
            $objBuyers->setId($result[$i]['id']);
            $objBuyers->setLastName($result[$i]["last_name"]);
            $objBuyers->setFirstName($result[$i]["first_name"]);
            $objBuyers->setPhone($result[$i]["phone"]);
            $objBuyers->setUpdatedAt($result[$i]["updated_at"]);
            $objBuyers->setCreatedAt($result[$i]["created_at"]);
            $objBuyers->setUserId($result[$i]["user_id"]);
            $objBuyers->setComment($result[$i]["comment"]);
            $objBuyers->setStatusOrder(($result[$i]["status"]));

        }
        return  $objBuyers;

    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    public function getComment()
    {
        return $this->comment;
    }


    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

    }
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

    }
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setStatusOrder($orderStatus)
    {
        $this->orderStatus = $orderStatus;
    }

    public function getStatusOrder()
    {
        return $this->orderStatus;
    }

    public function setData()
    {
        $this->createdAt = date('Y-m-d');
        $this->updatedAt = date('Y-m-d');
    }


}