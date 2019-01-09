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


    public function create(){

    }

    /**
     * Returns an array of categories for the list on the site.
     * @return  array
     */

    public function getCategories() {
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

    public function update()
    {

    }

    public function delete()
    {

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
}