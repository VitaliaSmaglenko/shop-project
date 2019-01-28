<?php
/**
 * Created by PhpStorm.
 * User: phpstudent
 * Date: 28.01.19
 * Time: 17:00
 */

namespace Model;

use App\PDODB;

class NestedComment
{
    private $userId;
    private $commentId;
    private $text;
    private $updatedAt;
    private $createdAt;
    private $userName;

    public function create()
    {
        $sql = 'INSERT INTO nested_comment (id_comment, id_user, text, created_at, updated_at) '.
            'VALUES (:idComment, :idUser, :text, :created_at, :updated_at);';
        $pdo = new PDODB();
        $data = array(':idComment' => $this->getCommentId(), ':idUser' => $this->getUserId(),
            ':text' => $this->getText(), ':created_at' => $this->getCreatedAt(), ':updated_at' => $this->getUpdatedAt());
        $result = $pdo->prepareData($sql, $data, 'execute');
        return $result;
    }

    public function setUserId(int $id):void
    {
        $this->userId = $id;
    }

    public function getUserId():int
    {
        return $this->userId;
    }

    public function setCommentId(int $id):void
    {
        $this->commentId = $id;
    }

    public function getCommentId():int
    {
        return $this->commentId;
    }

    public function setText(string $text):void
    {
        $this->text = $text;
    }

    public function getText():string
    {
        return $this->text;
    }

    public function setUserName(string $name):void
    {
        $this->userName = $name;
    }

    public function getUserName():string
    {
        return $this->userName;
    }

    public function setData():void
    {
        $this->createdAt = date('Y-m-d H:i:s');
        $this->updatedAt = date('Y-m-d H:i:s');
    }

    public function setUpdatedAt($updatedAt):void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getUpdatedAt():string
    {
        return $this->updatedAt;
    }

    public function setCreatedAt($createdAt):void
    {
        $this->createdAt = $createdAt;
    }

    public function getCreatedAt():string
    {
        return $this->createdAt;
    }
}