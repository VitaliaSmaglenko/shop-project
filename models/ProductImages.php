<?php
/**
 * Created by PhpStorm.
 * User: Виталия
 * Date: 20.01.2019
 * Time: 19:06
 */

namespace Model;

use App\PDODB;


class ProductImages

{
    private $image;
    private $productId;

    public function create()
    {
        $sql ='INSERT INTO product_images (product_id, image) '.
            ' VALUES (:product_id, :image)';
        $pdo = new PDODB();
        $data = array(':product_id' => $this->getProductId(), ':image' => $this->getImage());
        $result=$pdo->prepareData($sql, $data, 'execute');
        return $result;
    }

    public function updateById($id)
    {
        $sql = 'UPDATE  product_images SET image = :image WHERE product_id = :id';

        $pdo = new PDODB();
        $data= array(':image' => $this->getImage(), ':id' => $id);
        $result=$pdo->prepareData($sql, $data,'execute');
        return $result;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    public function getProductId()
    {
        return $this->productId;
    }
}