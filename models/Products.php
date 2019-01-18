<?php
/**
 * Class Products model for working with goods
 */

namespace Model;
use App\PDODB;

class Products
{
    /**
     * @var
     */
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

    /**
     * @param bool $id
     * @param $page
     * @return array
     */


    public function getByCategory($id=false, $page){
        $limit = 6;

        $offset = ($page - 1) * 6;

        if($id){
            $sql ='SELECT  name, products.id, category.id, price, image, description, specifications, availability, brand, products.status'.
                  ' FROM products  LEFT JOIN category  ON products.category_id = category.id'.
                  ' WHERE category.id=:id LIMIT :limit OFFSET :offset';
            $pdo = new PDODB();
            $product=$pdo->selectCategoryById($sql, $id, $limit, $offset);

            $productList = array();

            for ($i=0; $i<count($product); $i++){
                $objProduct = new Products();
                $objProduct->setName($product[$i]['name']);
                $objProduct->setDescription($product[$i]['description']);
                $objProduct->setImage($product[$i]['image']);
                $objProduct->setPrice($product[$i]['price']);
                $objProduct->setId($product[$i]['id']);
                $objProduct->setSpecifications($product[$i]['specifications']);
                $objProduct->setAvailability($product[$i]['availability']);
                $objProduct->setBrand($product[$i]['brand']);
                $objProduct->setStatus($product[$i]['status']);
                $productList[$i] = $objProduct;
            }


        }
        return $productList;
    }


    /**
     * Returns an array of goods
     * @return array
     */
    public function get()
    {
        $sql ='SELECT  name, id, price, image, description, specifications, availability, brand, status'.
            ' FROM products WHERE status = "1"';
        $pdo = new PDODB();
        $product=$pdo->selectData($sql);
        $productList = array();

        for ($i=0; $i<count($product); $i++){
            $objProduct = new Products();
            $objProduct->setName($product[$i]['name']);
            $objProduct->setDescription($product[$i]['description']);
            $objProduct->setImage($product[$i]['image']);
            $objProduct->setPrice($product[$i]['price']);
            $objProduct->setId($product[$i]['id']);
            $objProduct->setSpecifications($product[$i]['specifications']);
            $objProduct->setAvailability($product[$i]['availability']);
            $objProduct->setBrand($product[$i]['brand']);
            $objProduct->setStatus($product[$i]['status']);
            $productList[$i] = $objProduct;
        }

        return $productList;
    }

    /**
     * Returns the product with the specified id
     * @param $id
     * @return Products
     */

    public function getById($id)
    {
        $sql ='SELECT  name, id, price, image, description, specifications, availability, brand, status'.
             ' FROM products WHERE id = :id';
        $pdo = new PDODB();
        $product=$pdo->selectDataById($sql, $id);
        $objProduct = new Products();
        for ($i=0; $i<count($product); $i++){
            $objProduct->setName($product[$i]['name']);
            $objProduct->setDescription($product[$i]['description']);
            $objProduct->setImage($product[$i]['image']);
            $objProduct->setPrice($product[$i]['price']);
            $objProduct->setId($product[$i]['id']);
            $objProduct->setSpecifications($product[$i]['specifications']);
            $objProduct->setAvailability($product[$i]['availability']);
            $objProduct->setBrand($product[$i]['brand']);
            $objProduct->setStatus($product[$i]['status']);
        }

        return $objProduct;
    }

    /**
     * Returns an array with products by their id
     * @param $idsArray
     * @return array
     */
    public function getByIds($idsArray)
    {
        $ids = implode(',', $idsArray);

        $sql ='SELECT  name, id, price, image, description, specifications, availability, brand, status'.
            ' FROM products WHERE status="1" AND id IN ('.$ids.')';
        $pdo = new PDODB();
        $product=$pdo->getDataByIds($sql, $ids);
        $productList = array();
        for ($i=0; $i<count($product); $i++){
            $objProduct = new Products();
            $objProduct->setName($product[$i]['name']);
            $objProduct->setDescription($product[$i]['description']);
            $objProduct->setImage($product[$i]['image']);
            $objProduct->setPrice($product[$i]['price']);
            $objProduct->setId($product[$i]['id']);
            $objProduct->setSpecifications($product[$i]['specifications']);
            $objProduct->setAvailability($product[$i]['availability']);
            $objProduct->setBrand($product[$i]['brand']);
            $objProduct->setStatus($product[$i]['status']);
            $productList[$i] = $objProduct;

        }

        return $productList;
    }


    public function getSortingByPrice()
    {
        $sql ='SELECT  name, id, price, image, description, specifications, availability, brand, status'.
            ' FROM products WHERE status = "1" ORDER BY price ASC' ;
        $pdo = new PDODB();
        $product=$pdo->selectData($sql);
        $productList = array();

        for ($i=0; $i<count($product); $i++){
            $objProduct = new Products();
            $objProduct->setName($product[$i]['name']);
            $objProduct->setDescription($product[$i]['description']);
            $objProduct->setImage($product[$i]['image']);
            $objProduct->setPrice($product[$i]['price']);
            $objProduct->setId($product[$i]['id']);
            $objProduct->setSpecifications($product[$i]['specifications']);
            $objProduct->setAvailability($product[$i]['availability']);
            $objProduct->setBrand($product[$i]['brand']);
            $objProduct->setStatus($product[$i]['status']);
            $productList[$i] = $objProduct;
        }

        return $productList;
    }

    public function update()
    {

    }

    public function delete()
    {

    }

    public function create(){

    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getPrice(){
        return $this->price;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setSpecifications($specifications)
    {
        $specifications = explode(';', $specifications);
        $this->specifications = $specifications;
    }

    public function getSpecifications()
    {
        return $this->specifications;
    }

    public function setAvailability($availability)
    {
       $this->availability = $availability;
    }

    public function getAvailability()
    {
        return $this->availability;
    }

    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    public function getBrand()
    {
        return $this->brand;
    }

    public function setStatus($status)
    {
         $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

}