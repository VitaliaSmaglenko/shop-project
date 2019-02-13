<?php

/**
 * Class Category model for working with product categories
 */

namespace Model;

use App\PDODB;
use Base\Model;

class Category extends Model
{
    /**
     * @var
     */

    public $category;
    public $status;
    public $id;
    private $updatedAt;
    private $createdAt;

    /**
     * @return bool
     */
    public function create():bool
    {
        $sql = 'INSERT INTO category (category,  status, updated_at, created_at)'.
            ' VALUES (:category, :status, :update_at, :created_at)';
        $data = array(':category' => $this->getCategory(), ':status' => $this->getStatus(),
            ':update_at' => $this->getUpdatedAt(), ':created_at' => $this->getCreatedAt());
        $result = PDODB::prepareData($sql, $data, 'execute');
        return $result;
    }

    /**
     * Returns an array of categories for the list on the site.
     * @return  array
     */

    public function get():array
    {
        $sql ='SELECT  category, id, status FROM category  WHERE status = "1"';
        $category = PDODB::queryData($sql);
        $categoryList = array();
        for ($i = 0; $i<count($category); $i++) {
            $objCategory = new Category();
            $objCategory->setCategory($category[$i]['category']);
            $objCategory->setId($category[$i]['id']);
            $objCategory->setStatus($category[$i]['status']);
            $categoryList[$i] = $objCategory;
        }
        return $categoryList;
    }

    /**
     * Display all categories
     * @return array
     */
    public function getAdmin():array
    {
        $sql = 'SELECT  category, id, status FROM category';
        $category = PDODB::queryData($sql);
        $categoryList = array();

        for ($i=0; $i<count($category); $i++) {
            $objCategory = new Category();
            $objCategory->setCategory($category[$i]['category']);
            $objCategory->setId($category[$i]['id']);
            $objCategory->setStatus($category[$i]['status']);
            $categoryList[$i] = $objCategory;
        }
        return $categoryList;
    }

    /**
     * @param int $id
     * @return Category
     */
    public function getById(int $id):Category
    {
        $sql ='SELECT  category, id, status FROM category WHERE id = :id';
        $data = array('id' => $id);
        $category = PDODB::prepareData($sql, $data, 'fetchAll');
        $objCategory = new Category();
        for ($i=0; $i<count($category); $i++) {
            $objCategory->setCategory($category[$i]['category']);
            $objCategory->setId($category[$i]['id']);
            $objCategory->setStatus($category[$i]['status']);
        }
        return $objCategory;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function updateById(int $id):bool
    {
        $sql = 'UPDATE category SET  category = :category, status = :status, '.
            ' updated_at = :update_at WHERE id = :id';
        $data = array(':category' => $this->getCategory(), ':status' => $this->getStatus(),
           ':update_at' => $this->getUpdatedAt(), ':id' => $id);
        $result = PDODB::prepareData($sql, $data, 'execute');
        return $result;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id):bool
    {
        $sql = "DELETE FROM category WHERE id = :id";
        $data = array(':id' => $id);
        $category = PDODB::prepareData($sql, $data, 'execute');
        return $category;
    }

    public function setId(int $id):void
    {
        $this->id = $id;
    }

    public function getId():int
    {
        return $this->id;
    }

    public function setCategory(string $category):void
    {
        $this->category = $category;
    }

    public function getCategory():string
    {
        return $this->category;
    }

    public function setStatus(int $status):void
    {
        $this->status = $status;
    }

    public function getStatus():int
    {
        return $this->status;
    }

    public function setUpdatedAt():void
    {
        $this->updatedAt = date('Y-m-d');
    }

    public function getUpdatedAt():string
    {
        return $this->updatedAt;
    }

    public function setCreatedAt():void
    {
        $this->createdAt = date('Y-m-d');
    }

    public function getCreatedAt():string
    {
        return $this->createdAt;
    }
}
