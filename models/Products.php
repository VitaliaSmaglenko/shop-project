<?php

namespace Model;
use App\PDODB;

class Products
{
    public $name;
    public $category_id;
    public $price;
    public $availability;
    public $brand;
    public $image;
    public $description;
    public $specifications;
    public $status;
    public $id;




    public static function getProductsByCategory($id){
        if($id){

        }
    }



    public function getProducts() {
        $sql ='SELECT  name, id, price, image  FROM products WHERE status = "1"';
        $pdo = new PDODB();
        $listProduct=$pdo->selectData($sql);
        return $listProduct;
    }


    public function getProductsById($id) {
        $sql ='SELECT  name, id, price, image, description, specifications FROM products WHERE id = :id';
        $pdo = new PDODB();
        $product=$pdo->selectDataById($sql, $id);

        for ($i=0; $i<count($product); $i++){
            $this->setName($product[$i]['name']);
            $this->setDescription($product[$i]['description']);
            $this->setImage($product[$i]['image']);
            $this->setPrice($product[$i]['price']);
            $this->setId($product[$i]['id']);
            $this->setSpecifications($product[$i]['specifications']);
        }
        return true;
    }



    public function update()
    {

    }

    public function delete()
    {

    }

    public function create(){

    }

    public function setName($name){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setImage($image){
        $this->image = $image;
    }

    public function getImage(){
        return $this->image;
    }

    public function setPrice($price){
        $this->price = $price;
    }

    public function getPrice(){
        return $this->price;
    }
    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setSpecifications($specifications){
        $specifications = explode(';', $specifications);
        $this->specifications = $specifications;
    }

    public function getSpecifications(){
        return $this->specifications;
    }

}