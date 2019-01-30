<?php
/**
 * Model NestedComment
 */

namespace Model;

use App\PDODB;
use Base\Model;

class NestedComment extends Model
{
    /**
     * @var
     */
    private $userId;
    private $commentId;
    private $text;
    private $updatedAt;
    private $createdAt;
    private $userName;
    private $id;

    /**
     * @return bool
     */
    public function create():bool
    {
        $sql = 'INSERT INTO nested_comment (id_comment, id_user, text, created_at, updated_at) '.
            'VALUES (:idComment, :idUser, :text, :created_at, :updated_at);';
        $pdo = new PDODB();
        $data = array(':idComment' => $this->getCommentId(), ':idUser' => $this->getUserId(),
           ':text' => $this->getText(), ':created_at' => $this->getCreatedAt(), ':updated_at' => $this->getUpdatedAt());
        $result = $pdo->prepareData($sql, $data, 'execute');
        return $result;
    }

    /**
     * @param int $id
     * @return array
     */
    public function get(int $id):array
    {
        $sql = 'SELECT  nested_comment.id, text, created_at, updated_at, user_name, id_comment, id_user ' .
            ' FROM nested_comment LEFT JOIN user ON nested_comment.id_user = user.id ' .
            ' WHERE id_comment = :id ';
        $data = array(':id' => $id);
        $pdo = new PDODB();
        $result = $pdo->prepareData($sql, $data, 'fetchAll');
        $commentList = array();

        for ($i = 0; $i < count($result); $i++) {
            $comment = new NestedComment();
            $comment->setId($result[$i]['id']);
            $comment->setText($result[$i]['text']);
            $comment->setCreatedAt($result[$i]['created_at']);
            $comment->setUpdatedAt($result[$i]['updated_at']);
            $comment->setUserName($result[$i]['user_name']);
            $comment->setUserId($result[$i]['id_user']);
            $comment->setCommentId($result[$i]['id_comment']);
            $commentList[$i] = $comment;
        }
        return $commentList;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id):bool
    {
        $sql = "DELETE FROM nested_comment WHERE id = :id";
        $data = array( ':id' => $id);
        $pdo = new PDODB();
        $result = $pdo->prepareData($sql, $data, 'execute');
        return $result;
    }

    public function setId(int $id):void
    {
        $this->id = $id;
    }

    public function getId():int
    {
        return $this->id;
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