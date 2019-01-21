<?php

/**
 * Class Category model for working with product categories
 */

namespace Model;
use App\PDODB;

class Category{

    /**
     * @param string $category
     * @param int $status
     */

    public $category;
    public $status;
    public $id;
    private $updatedAt;
    private $createdAt;

    public function create()
    {
        $sql ='INSERT INTO category (category,  status, updated_at, created_at)'.
            ' VALUES (:category, :status, :update_at, :created_at)';
        $pdo = new PDODB();
        $data= array( $this->getCategory(),  $this->getStatus(), $this->getUpdatedAt(), $this->getCreatedAt());
        $result=$pdo->add($sql, $data);
        return $result;

    }

    /**
     * Returns an array of categories for the list on the site.
     * @return  array
     */

    public function get() {
        $sql ='SELECT  category, id, status FROM category  WHERE status = "1"';
        $pdo = new PDODB();
        $category=$pdo->selectData($sql);

        $categoryList = array();

        for ($i=0; $i<count($category); $i++){
            $objCategory = new Category();
            $objCategory->setCategory($category[$i]['category']);
            $objCategory->setId($category[$i]['id']);
            $objCategory->setStatus($category[$i]['status']);
            $categoryList[$i] = $objCategory;
        }
        return $categoryList;
    }

    public function getAdmin() {
        $sql ='SELECT  category, id, status FROM category';
        $pdo = new PDODB();
        $category=$pdo->selectData($sql);

        $categoryList = array();

        for ($i=0; $i<count($category); $i++){
            $objCategory = new Category();
            $objCategory->setCategory($category[$i]['category']);
            $objCategory->setId($category[$i]['id']);
            $objCategory->setStatus($category[$i]['status']);
            $categoryList[$i] = $objCategory;
        }
        return $categoryList;
    }

    public function getById($id) {
        $sql ='SELECT  category, id, status FROM category WHERE id = :id';
        $pdo = new PDODB();
        $category=$pdo->selectDataById($sql, $id);
        $objCategory = new Category();
        for ($i=0; $i<count($category); $i++){
            $objCategory->setCategory($category[$i]['category']);
            $objCategory->setId($category[$i]['id']);
            $objCategory->setStatus($category[$i]['status']);
          }
        return $objCategory;
    }

    public function updateById($id)
    {
        $sql = 'UPDATE category SET  category = :category, status = :status, '.
            ' updated_at = :update_at WHERE id = :id';

        $pdo = new PDODB();
        $data= array($this->getCategory(),  $this->getStatus(), $this->getUpdatedAt(), $id);
        $result=$pdo->add($sql, $data);
        return $result;
    }

    public function deleteById($id)
    {
        $sql = "DELETE FROM category WHERE id = :id";
        $pdo = new PDODB();
        $product = $pdo->deleteData($sql, $id);
        return $product;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setCategory($category){
        $this->category = $category;

    }
    public function getCategory(){
        return $this->category;
    }

    public function setStatus($status){
        $this->status = $status;

    }
    public function getStatus(){
        return $this->status;
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

}