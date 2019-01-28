<?php
/**
 * Class Products model for working with goods
 */

namespace Model;

use Base\Model;
use App\PDODB;

class Products extends Model
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

    const LIMIT = 6;
    /**
     * @param bool $id
     * @param $page
     * @return array
     */
    public function getByCategory($id = false, int $page = 1):array
    {
        $limit = self::LIMIT;
        $offset = ($page - 1) * self::LIMIT;
        if ($id) {
            $sql = 'SELECT  name, products.id, price, product_images.image, description, specifications, '.
                ' availability, brand, products.status'.
                ' FROM products  LEFT JOIN category  ON products.category_id = category.id'.
                ' LEFT JOIN product_images ON products.id = product_images.product_id  '.
              ' WHERE category.id=:id  AND products.status = "1" ORDER by products.id ASC LIMIT :limit OFFSET :offset ';

            $data = array(':id' => $id, ':limit' => $limit, ':offset' => $offset);
            $pdo = new PDODB();
            $product = $pdo->prepareData($sql, $data, 'fetchAll');
            $productList = array();
            for ($i = 0; $i<count($product); $i++) {
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
    public function get():array
    {
        $sql = 'SELECT  name, products.id, price, product_images.image, is_new, category_id, description, '.
            'specifications, availability, brand, status'.
            ' FROM products LEFT JOIN product_images ON products.id = product_images.product_id '.
            ' WHERE products.status = "1" ORDER by products.id ASC ';
        $pdo = new PDODB();
        $product = $pdo->queryData($sql);
        $productList = array();

        for ($i = 0; $i < count($product); $i++) {
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
     * @return array
     */
    public function getAdmin():array
    {
        $sql = 'SELECT  name, id, price, image, description, specifications, availability, brand, status'.
            ' FROM products';
        $pdo = new PDODB();
        $product = $pdo->queryData($sql);
        $productList = array();
        for ($i = 0; $i < count($product); $i++) {
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
     * @param int $id
     * @return Products
     */

    public function getById(int $id):Products
    {
        $sql = 'SELECT  name, products.id, price, product_images.image, is_new, category_id, description,'.
            ' specifications, availability, brand, status'.
           ' FROM products LEFT JOIN product_images ON products.id = product_images.product_id WHERE products.id = :id';

        $data = array (':id' => $id);
        $pdo = new PDODB();
        $product = $pdo->prepareData($sql, $data, 'fetchAll');
        $objProduct = new Products();
        for ($i = 0; $i < count($product); $i++) {
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
     * @param array $idsArray
     * @return array
     */
    public function getByIds(array $idsArray):array
    {
        $ids = implode(',', $idsArray);

        $sql = 'SELECT  name, products.id, price,  product_images.image, description, specifications, availability, brand,'.
          ' status FROM products LEFT JOIN product_images ON products.id = product_images.product_id WHERE status="1" '.
          ' AND products.id IN ('.$ids.')';
        $pdo = new PDODB();
        $product = $pdo->queryData($sql, 'setFetchMode');
        $productList = array();
        for ($i = 0; $i < count($product); $i++) {
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
     * @param int $id
     * @return int
     */

    public function getTotalProduct(int $id):int
    {
        $sql = "SELECT count(id) AS count FROM products WHERE status='1' AND category_id = '".$id."'";
        $pdo = new PDODB();
        $product = $pdo->queryData($sql, 'setFetchMode');
        return $product[0]['count'];
    }

    /**
     * @return array
     */
    public function getSortingByPrice():array
    {
        $sql = 'SELECT  name, products.id, price, products.image, description, specifications, availability, brand, '.
            ' status FROM products LEFT JOIN product_images ON products.id = product_images.product_id '.
            'WHERE status = "1" ORDER BY price ASC' ;
        $pdo = new PDODB();
        $product = $pdo->queryData($sql);
        $productList = array();

        for ($i = 0; $i < count($product); $i++) {
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
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id):bool
    {
        $sql = "DELETE FROM products WHERE id = :id";
        $data = array( ':id' => $id);
        $pdo = new PDODB();
        $product = $pdo->prepareData($sql, $data, 'execute');
        return $product;
    }

    /**
     * @return int
     */
    public function create():int
    {
        $sql ='INSERT INTO products (name, category_id, price, availability, brand, '.
            ' description, status, update_at, created_at, specifications, is_new) '.
            ' VALUES (:name, :category_id, :price, :availability, :brand, '.
            ' :description, :status, :update_at, :created_at, :specifications, :is_new)';

        $data = array(':name' => $this->getName(), ':category_id' => $this->getCategoryId(),
           ':price' => $this->getPrice(), ':availability' => $this->getAvailability(),
           ':brand' => $this->getBrand(), ':description' => $this->getDescription(),
           ':status' => $this->getStatus(), ':update_at' => $this->getUpdatedAt(),
           ':created_at' => $this->getCreatedAt(),
           ':specifications' => $this->getSpecifications(), ':is_new' => $this->getIsNew());
        $pdo = new PDODB();
        $result=$pdo->prepareData($sql, $data, 'lastId');
        return $result;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function updateById(int $id):bool
    {
        $sql = 'UPDATE products SET name = :name, category_id = :category_id, price = :price, '.
           ' availability = :availability, brand = :brand, description = :description, status = :status, '.
           ' update_at = :update_at,  specifications = :specifications, ' .
           ' is_new = :is_new WHERE id = :id';

        $data = array(':name' => $this->getName(), ':category_id' => $this->getCategoryId(),
           ':price' => $this->getPrice(), ':availability' => $this->getAvailability(),
            ':brand' => $this->getBrand(), ':description' => $this->getDescription(),
           ':status' => $this->getStatus(), ':update_at' => $this->getUpdatedAt(),
           ':specifications' => $this->getSpecifications(), ':is_new' => $this->getIsNew(), ':id' => $id);
        $pdo = new PDODB();
        $result = $pdo->prepareData($sql, $data, 'execute');
        return $result;
    }

    /**
     * @param int $id
     * @param int $value
     * @return bool
     */
    public function updateQuantity(int $id, int $value):bool
    {
        $sql = 'UPDATE products SET availability = availability + :value  WHERE id = :id';
        $data = array( ':id' => $id, ':value' =>$value);
        $pdo = new PDODB();
        $result = $pdo->prepareData($sql, $data, 'execute');
        return $result;
    }

    public function setName(string $name):void
    {
        $this->name = $name;
    }

    public function getName():string
    {
        return $this->name;
    }

    public function setDescription(string $description):void
    {
        $this->description = $description;
    }

    public function getDescription():string
    {
        return $this->description;
    }

    public function setImage($image):void
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setPrice(int $price):void
    {
        $this->price = $price;
    }

    public function getPrice():int
    {
        return $this->price;
    }
    public function setId(int $id):void
    {
        $this->id = $id;
    }

    public function getId():int
    {
        return $this->id;
    }

    public function setSpecifications(string $specifications):void
    {
        $this->specifications = $specifications;
    }

    public function getSpecifications():string
    {
        return $this->specifications;
    }

    public function setAvailability(int $availability):void
    {
        $this->availability = $availability;
    }

    public function getAvailability():int
    {
        return $this->availability;
    }

    public function setBrand(string $brand):void
    {
        $this->brand = $brand;
    }

    public function getBrand():string
    {
        return $this->brand;
    }

    public function setStatus(int $status):void
    {
         $this->status = $status;
    }

    public function getStatus():int
    {
        return $this->status;
    }

    public function setCategoryId(int $categoryId):void
    {
        $this->categoryId = $categoryId;
    }

    public function getCategoryId():int
    {
        return $this->categoryId;
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

    public function setIsNew(int $isNew):void
    {
        $this->isNew = $isNew;
    }

    public function getIsNew():int
    {
        return $this->isNew;
    }
}
