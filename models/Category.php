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

    public function create(){

    }

    /**
     * Returns an array of categories for the list on the site.
     * @return  array
     */

    public function get() {
        $sql ='SELECT  category, id FROM category WHERE status = "1"';
        $pdo = new PDODB();
        $this->category=$pdo->selectData($sql);
        return $this->category;
    }

    public function update()
    {

    }

    public function delete()
    {

    }

}