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
    private $status;
    private $userId;
    private $id;



    public function createBuyers()
    {
        if($this->getUserId()==false) {
            $sql = 'INSERT INTO buyers (first_name, last_name, comment, phone,  updated_at, created_at) '
                . 'VALUES (:firstName, :lastName, :comment, :phone, :updatedAt, :createdAt);';
            $pdo = new PDODB();
            $result = $pdo->addBuyers($sql, $this->getFirstName(), $this->getLastName(), $this->getComment(), $this->getPhone(), $this->getUserId(),
                $this->updatedAt, $this->getCreatedAt());
        } else {
            $sql = 'INSERT INTO buyers (first_name, last_name, comment, phone,  user_id, updated_at, created_at) '
                . 'VALUES (:firstName, :lastName, :comment, :phone, :userId, :updatedAt, :createdAt);';
            $pdo = new PDODB();
            $result = $pdo->addBuyers($sql, $this->getFirstName(), $this->getLastName(), $this->getComment(), $this->getPhone(), $this->getUserId(),
                $this->updatedAt, $this->getCreatedAt());
        }

        return $result;
    }

    public function getBuyersId()
    {
        $sql = "SELECT id FROM buyers ORDER BY id DESC LIMIT 1";
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


    public function setUpdatedAt()
    {
        $this->updatedAt = date('Y-m-d');

    }
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setCreatedAt()
    {
        $this->createdAt = date('Y-m-d');

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
}