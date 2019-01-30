<?php
/**
 * Model Order
 */

namespace Model;

use App\PDODB;
use Base\Model;

class Orders extends Model
{
    /**
     * @var
     */
    private $idBuyers;
    private $id;
    private $totalPrice;
    private $totalCount;
    private $status;

    /**
     * @return bool
     */
    public function createOrder():bool
    {

            $sql = 'INSERT INTO orders (id_buyers, total_price, total_count) '.
                'VALUES (:idBuyers, :totalPrice, :totalCount);';
            $pdo = new PDODB();
            $data = array(':idBuyers' => $this->getIdBuyers(), ':totalPrice' => $this->getTotalPrice(),
                ':totalCount' => $this->getTotalCount());
            $result = $pdo->prepareData($sql, $data, 'execute');
            return $result;
    }

    /**
     * @return int
     */
    public function getOrdersId():int
    {
        $sql = "SELECT id FROM orders  ORDER BY id DESC LIMIT 1";
        $pdo = new PDODB();
        $result = $pdo->queryData($sql);

        for ($i=0; $i<count($result); $i++) {
            $this->setId($result[$i]['id']);
        }
        return $this->getId();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id):bool
    {
        $sql = "DELETE FROM orders WHERE id = :id";
        $pdo = new PDODB();
        $data = array(':id' => $id);
        $buyer = $pdo->prepareData($sql, $data, 'execute');
        return $buyer;
    }

    /**
     * @param int $id
     * @return int
     */
    public function getById(int $id)
    {
        $sql = 'SELECT orders.id, id_buyers, total_price, total_count, orders.status'.
            ' FROM orders INNER JOIN buyers  ON orders.id_buyers=buyers.id WHERE orders.id_buyers = :id';
        $pdo = new PDODB();
        $data = array('id' => $id);
        $result = $pdo->prepareData($sql, $data, 'fetchAll');
        $objOrder = new Orders();
        for ($i=0; $i<count($result); $i++) {
            $objOrder ->setId($result[$i]['id']);
            $objOrder ->setIdBuyers($result[$i]['id_buyers']);
            $objOrder ->setStatus($result[$i]['status']);
            $objOrder -> setTotalPrice($result[$i]['total_price']);
            $objOrder ->setTotalCount($result[$i]['total_count']);
        }
        return $objOrder;
    }

    /**
     * @param int $id
     * @return Orders
     */
    public function getByBuyersId(int $id):Orders
    {
        $sql = 'SELECT id, total_price, total_count, id_buyers, status FROM orders WHERE id_buyers = :id';
        $pdo = new PDODB();
        $data = array(':id' => $id);
        $result = $pdo->prepareData($sql, $data, 'fetchAll');
        $objOrder = new Orders();
        for ($i=0; $i<count($result); $i++) {
            $objOrder ->setId($result[$i]['id']);
            $objOrder ->setIdBuyers($result[$i]['id_buyers']);
            $objOrder ->setStatus($this->getStatusText($result[$i]['status']));
            $objOrder -> setTotalPrice($result[$i]['total_price']);
            $objOrder ->setTotalCount($result[$i]['total_count']);
        }
        return $objOrder;
    }

    /**
     * @param int $status
     * @return string
     */
    public function getStatusText(int $status):string
    {
        switch ($status) {
            case '1':
                return "New orders";
                break;
            case '2':
                return "In processing";
                break;
            case '3':
                return "is delivered";
                break;
            case '4':
                return"Is closed";
                break;
        }
    }
    public function setId(int $id):void
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setIdBuyers(int $id):void
    {
        $this->idBuyers = $id;
    }

    public function getIdBuyers():int
    {
        return $this->idBuyers;
    }

    public function setTotalPrice(int $totalPrice):void
    {
        $this->totalPrice = $totalPrice;
    }

    public function getTotalPrice():int
    {
        return $this->totalPrice;
    }
    public function setTotalCount(int $totalCount):void
    {
        $this->totalCount = $totalCount;
    }

    public function getTotalCount():int
    {
        return $this->totalCount;
    }
    public function setStatus($status):void
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }
}
