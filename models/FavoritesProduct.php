<?php
/**
 * Model FavoritesProduct
 */

namespace Model;

use App\PDODB;
use Base\Model;

class FavoritesProduct extends Model
{
    /**
     * @var
     */
    private $idProduct;
    private $idUser;
    private $productName;
    private $price;
    private $brand;
    private $description;
    private $image;

    /**
     * @return bool
     */
    public function create():bool
    {
        $sql ='INSERT INTO favorites_products (id_product, id_user) '.
            ' VALUES (:id_product, :id_user)';
        $data = array('id_product' => $this->getIdProduct(), ':id_user' => $this->getIdUser());
        $result=PDODB::prepareData($sql, $data, 'execute');
        return $result;
    }

    /**
     * @return int
     */
    public function exist():int
    {
        $sql ='SELECT EXISTS(SELECT id_product, id_user FROM favorites_products'.
            ' WHERE id_product = :id_product AND id_user = :id_user)';
        $data = array('id_product' => $this->getIdProduct(), ':id_user' => $this->getIdUser());
        $result=PDODB::prepareData($sql, $data, 'fetchColumn');
        return $result;
    }

    /**
     * @return array
     */
    public function get():array
    {
        $sql ='SELECT name, products.id, price, brand, description, product_images.image FROM favorites_products'.
            ' INNER JOIN products ON favorites_products.id_product=products.id '.
            'INNER JOIN product_images ON product_images.product_id=products.id'.
            ' WHERE  id_user = :id_user';
        $data = array( ':id_user' => $this->getIdUser());
        $result=PDODB::prepareData($sql, $data, 'fetchAll');
        $favProductList = array();
        for ($i = 0; $i < count($result); $i++) {
            $objFavProduct = new FavoritesProduct();
            $objFavProduct->setProductName($result[$i]['name']);
            $objFavProduct->setPrice($result[$i]['price']);
            $objFavProduct->setBrand($result[$i]['brand']);
            $objFavProduct->setImage($result[$i]['image']);
            $objFavProduct->setDescription($result[$i]['description']);
            $objFavProduct->setIdProduct($result[$i]['id']);
            $favProductList[$i] = $objFavProduct;
        }
        return  $favProductList;
    }

    /**
     * @return bool
     */
    public function delete():bool
    {
        $sql ='DELETE  FROM favorites_products'.
            ' WHERE id_product = :id_product ';
        $data = array('id_product' => $this->getIdProduct());
        $result = PDODB::prepareData($sql, $data, 'execute');
        return $result;
    }
    public function setIdProduct(int $id):void
    {
        $this->idProduct=$id;
    }

    public function getIdProduct():int
    {
        return $this->idProduct;
    }

    public function setIdUser(int $id):void
    {
        $this->idUser=$id;
    }

    public function getIdUser():int
    {
        return $this->idUser;
    }

    public function setProductName(string $name):void
    {
        $this->productName=$name;
    }

    public function getProductName():string
    {
        return $this->productName;
    }

    public function setPrice(int $price):void
    {
        $this->price=$price;
    }

    public function getPrice():int
    {
        return $this->price;
    }

    public function setBrand(string $brand):void
    {
        $this->brand=$brand;
    }

    public function getBrand():string
    {
        return $this->brand;
    }

    public function setDescription(string $description):void
    {
        $this->description=$description;
    }

    public function getDescription():string
    {
        return $this->description;
    }

    public function setImage(string $image):void
    {
        $this->image=$image;
    }

    public function getImage():string
    {
        return $this->image;
    }
}
