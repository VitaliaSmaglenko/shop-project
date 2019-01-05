<?php
namespace Model;
use App\PDODB;

class Category{

    public $category;
    public $status;

    public function create(){

    }

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