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

    public function setId(){

    }

    public function setCategory($category){
        $this->category = $category;

    }
    public function getCategory(){
        return $this->category;
    }
    public function create(){

    }

    /**
     * Returns an array of categories for the list on the site.
     * @return  array
     */

    public function getCategories() {
        $sql ='SELECT  category, id FROM category  WHERE status = "1"';
        $pdo = new PDODB();
        $result=$pdo->selectData($sql);
        return $result;
    }

    public function update()
    {

    }

    public function delete()
    {

    }

}