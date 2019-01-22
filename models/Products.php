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
    private $name;
    private $categoryId;
    private $price;
    private $availability;
    private $brand;
    private $image;
    private $description;
    private $specifications;
    private $status;
    private $id;
    private $updatedAt;
    private $createdAt;
    private $isNew;

    /**
     * @param bool $id
     * @param $page
     * @return array
     */


    public function getByCategory($id=false, $page){
        $limit = 6;

        $offset = ($page - 1) * 6;

        if($id){
            $sql = 'SELECT  name, products.id, price, product_images.image, description, specifications, availability, brand, products.status'.
                  ' FROM products  LEFT JOIN category  ON products.category_id = category.id'.
                    ' LEFT JOIN product_images ON products.id = product_images.product_id  '.
                  '  WHERE category.id=:id  AND products.status = "1" ORDER by products.id ASC LIMIT :limit OFFSET :offset  ';
            $pdo = new PDODB();
            $data = array(':id' => $id, ':limit' => $limit, ':offset' => $offset);
            $product = $pdo->prepareData($sql, $data, 'fetchAll');

            $productList = array();

            for ($i = 0; $i<count($product); $i++){
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
        $sql = 'SELECT  name, products.id, price, product_images.image, is_new, category_id, description, specifications, availability, brand, status'.
            ' FROM products LEFT JOIN product_images ON products.id = product_images.product_id WHERE products.status = "1" ORDER by products.id ASC ';
        $pdo = new PDODB();
        $product=$pdo->queryData($sql);
        $productList = array();

        for ($i = 0; $i < count($product); $i++){
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

    public function getAdmin()
    {
        $sql = 'SELECT  name, id, price, image, description, specifications, availability, brand, status'.
            ' FROM products';
        $pdo = new PDODB();
        $product=$pdo->queryData($sql);
        $productList = array();

        for ($i = 0; $i < count($product); $i++){
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
        $sql = 'SELECT  name, products.id, price, product_images.image, is_new, category_id, description, specifications, availability, brand, status'.
             ' FROM products LEFT JOIN product_images ON products.id = product_images.product_id WHERE products.id = :id';
        $pdo = new PDODB();
        $data = array (':id' => $id);
        $product = $pdo->prepareData($sql, $data, 'fetchAll');
        $objProduct = new Products();
        for ($i = 0; $i < count($product); $i++){
            $objProduct->setName($product[$i]['name']);
            $objProduct->setDescription($product[$i]['description']);
            $objProduct->setImage($product[$i]['image']);
            $objProduct->setPrice($product[$i]['price']);
            $objProduct->setId($product[$i]['id']);
            $objProduct->setSpecifications($product[$i]['specifications']);
            $objProduct->setAvailability($product[$i]['availability']);
            $objProduct->setBrand($product[$i]['brand']);
            $objProduct->setStatus($product[$i]['status']);
            $objProduct->setCategoryId($product[$i]['category_id']);
            $objProduct->setIsNew($product[$i]['is_new']);
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

        $sql = 'SELECT  name, products.id, price, products.image, description, specifications, availability, brand, status'.
            ' FROM products LEFT JOIN product_images ON products.id = product_images.product_id WHERE status="1" AND products.id IN ('.$ids.')';
        $pdo = new PDODB();
        $product = $pdo->queryData($sql, 'setFetchMode');
        $productList = array();
        for ($i = 0; $i < count($product); $i++){
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
        $sql = 'SELECT  name, products.id, price, products.image, description, specifications, availability, brand, status'.
            ' FROM products LEFT JOIN product_images ON products.id = product_images.product_id WHERE status = "1" ORDER BY price ASC' ;
        $pdo = new PDODB();
        $product = $pdo->queryData($sql);
        $productList = array();

        for ($i = 0; $i < count($product); $i++){
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

    public function deleteById($id)
    {
        $sql = "DELETE FROM products WHERE id = :id";
        $pdo = new PDODB();
        $data = array( ':id' => $id);
        $product = $pdo->prepareData($sql, $data, 'execute');
        return $product;
    }

    public function create()
    {
        $sql ='INSERT INTO products (name, category_id, price, availability, brand, '.
            ' description, status, update_at, created_at, specifications, is_new) '.
            ' VALUES (:name, :category_id, :price, :availability, :brand, '.
            ' :description, :status, :update_at, :created_at, :specifications, :is_new)';
        $pdo = new PDODB();
        $data= array(':name' => $this->getName(), ':category_id' => $this->getCategoryId(), ':price' => $this->getPrice(),
           ':availability' => $this->getAvailability(), ':brand' => $this->getBrand(), ':description' => $this->getDescription(),
           ':status' => $this->getStatus(), ':update_at' => $this->getUpdatedAt(), ':created_at' => $this->getCreatedAt(),
           ':specifications' => $this->getSpecifications(), ':is_new' => $this->getIsNew());
        $result=$pdo->prepareData($sql, $data, 'lastId');
        return $result;

     }


    public function updateById($id)
    {
        $sql = 'UPDATE products SET name = :name, category_id = :category_id, price = :price, '.
           ' availability = :availability, brand = :brand, description = :description, status = :status, '.
           ' update_at = :update_at,  specifications = :specifications, ' .
           ' is_new = :is_new WHERE id = :id';

        $pdo = new PDODB();
        $data= array(':name' => $this->getName(), ':category_id' => $this->getCategoryId(), ':price' => $this->getPrice(),
           ':availability' => $this->getAvailability(), ':brand' => $this->getBrand(), ':description' => $this->getDescription(),
           ':status' => $this->getStatus(), ':update_at' => $this->getUpdatedAt(),
           ':specifications' => $this->getSpecifications(), ':is_new' => $this->getIsNew(), ':id' => $id);
        $result=$pdo->prepareData($sql, $data, 'execute');
        return $result;
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
       // $specifications = explode(';', $specifications);
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

    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
    }

    public function getCategoryId()
    {
        return $this->categoryId;
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

    public function setIsNew($isNew)
    {
        $this->isNew = $isNew;
    }

    public function getIsNew()
    {
        return $this->isNew;
    }
}