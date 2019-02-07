<?php
/**
 * Model CommentProduct
 */
namespace Model;

use App\PDODB;
use Base\Model;

class CommentProduct extends Model
{
    /**
     * @var
     */
    private $id;
    private $userId;
    private $productId;
    private $text;
    private $updatedAt;
    private $createdAt;
    private $userName;

    /**
     * @return bool
     */
    public function create():bool
    {
        $sql = 'INSERT INTO comment_product (id_product, id_user, text, created_at, updated_at) '.
            'VALUES (:idProduct, :idUser, :text, :created_at, :updated_at);';
        $data = array(':idProduct' => $this->getProductId(), ':idUser' => $this->getUserId(),
           ':text' => $this->getText(), ':created_at' => $this->getCreatedAt(), ':updated_at' => $this->getUpdatedAt());
        $result = PDODB::prepareData($sql, $data, 'execute');
        return $result;
    }

    /**
     * @param int $id
     * @return array
     */
    public function get(int $id):array
    {
        $sql = 'SELECT  comment_product.id, text, created_at, updated_at, user_name, id_product, id_user '.
               ' FROM comment_product LEFT JOIN user ON comment_product.id_user = user.id '.
               ' WHERE id_product = :id ';
        $data = array(':id' => $id);
        $result = PDODB::prepareData($sql, $data, 'fetchAll');
        $commentList = array();

        for ($i = 0; $i < count($result); $i++) {
            $comment = new CommentProduct();
            $comment->setId($result[$i]['id']);
            $comment->setText($result[$i]['text']);
            $comment->setCreatedAt($result[$i]['created_at']);
            $comment->setUpdatedAt($result[$i]['updated_at']);
            $comment->setUserName($result[$i]['user_name']);
            $comment->setUserId($result[$i]['id_user']);
            $comment->setProductId($result[$i]['id_product']);
            $commentList[$i] = $comment;
        }

        return  $commentList;
    }

    /**
     * Returns the number of comments for the product
     * @param int $id
     * @return int
     */
    public function count(int $id):int
    {
        $sql = 'SELECT count(*) FROM comment_product WHERE id_product = :id';
        $data = array(':id' => $id);
        $result = PDODB::prepareData($sql, $data, 'fetchColumn');

        return $result;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id):bool
    {
        $sql = "DELETE FROM comment_product WHERE id = :id";
        $data = array( ':id' => $id);
        $result = PDODB::prepareData($sql, $data, 'execute');
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

    public function setProductId(int $id):void
    {
        $this->productId = $id;
    }

    public function getProductId():int
    {
        return $this->productId;
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
