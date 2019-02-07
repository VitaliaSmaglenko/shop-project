<?php
/**
 * Model ProductImages
 */

namespace Model;

use App\PDODB;
use Base\Model;

class ProductImages extends Model
{
    /**
     * @var
     */
    private $image;
    private $productId;

    /**
     * @return bool
     */
    public function create():bool
    {
        $sql ='INSERT INTO product_images (product_id, image) '.
            ' VALUES (:product_id, :image)';
        $data = array(':product_id' => $this->getProductId(), ':image' => $this->getImage());
        $result=PDODB::prepareData($sql, $data, 'execute');
        return $result;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function updateById(int $id):bool
    {
        $sql = 'UPDATE  product_images SET image = :image WHERE product_id = :id';
        $data= array(':image' => $this->getImage(), ':id' => $id);
        $result = PDODB::prepareData($sql, $data, 'execute');
        return $result;
    }

    public function setImage(string $image):void
    {
        $this->image = $image;
    }

    public function getImage():string
    {
        return $this->image;
    }

    public function setProductId(int $productId):void
    {
        $this->productId = $productId;
    }

    public function getProductId():int
    {
        return $this->productId;
    }
}
