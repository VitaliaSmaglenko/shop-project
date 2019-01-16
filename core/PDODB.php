<?php
/**
 * Class PDODB
 * Component for working with database
 */

namespace App;
use PDO;
use Logger\Log;

class PDODB

{
    private $logger;

    public function __construct()
    {
        $this->logger = new Log('pdo');
    }

    /**
     * Establishes a database connection
     * @return PDO
     */

    public  function connect(){
        $conf = include ('config/db.php');
        $host = $conf['host'];
        $db   = $conf['db'];
        $user = $conf['user'];
        $pass = $conf['pass'];
        $charset = $conf['charset'];
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
          $pdo = new PDO($dsn, $user, $pass, $opt);
          return $pdo;
        } catch (PDOException $e) {
            die('Подключение не удалось: ' . $this->logger->error($e->getMessage()));
        }


    }

    /**
     * Receives data from the database
     * @param $sql
     * @return array
     */

    public function selectData($sql){
        $pdo = $this->connect();
        $result = $pdo->query($sql);
        return $result->fetchAll( );
    }

    /**
     * Receives data from the database by id
     * @param $sql
     * @param $id
     * @return array
     */
    public function selectDataById($sql, $id){
        $pdo = $this->connect();
        $result = $pdo->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        return $result->fetchAll( );

    }

    /**
     * Receives data from the database by category_id
     * @param $sql
     * @param $id
     * @param $limit
     * @param $offset
     * @return array
     */
    public function selectCategoryById($sql, $id, $limit, $offset){
    $pdo = $this->connect();
    $result = $pdo->prepare($sql);
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    $result->bindParam(':limit', $limit, PDO::PARAM_INT);
    $result->bindParam(':offset', $offset, PDO::PARAM_INT);
    $result->execute();
    return $result->fetchAll( );
    }

    /**
     * Checks for a match in the database
     * @param $sql
     * @param $data
     * @return bool
     */
    public function checkData($sql, $data)
    {
        $pdo = $this->connect();
        $result = $pdo->prepare($sql);
        $result->bindParam(1, $data, PDO::PARAM_STR);
        $result->execute();
        if($result->fetchColumn()){
            return true;
        }
        return false;
    }

    /**
     * Check user for a match in the database
     * @param $sql
     * @param $param1
     * @param $param2
     * @return bool
     */
    public function checkUser($sql, $param1, $param2)
    {
        $pdo = $this->connect();
        $result = $pdo->prepare($sql);
        $result->bindParam(1, $param1, PDO::PARAM_STR);
        $result->bindParam(2, $param2, PDO::PARAM_STR);
        $result->execute();
        if($result->fetch()){
            return true;
        }
        return false;
    }


    /**
     * Adds a new user to the database
     * @param $sql
     * @param $userName
     * @param $firstName
     * @param $lastName
     * @param $email
     * @param $password
     * @return bool
     */
    public function addUser($sql, $userName, $firstName, $lastName, $email, $password, $phone)
    {
        $pdo = $this->connect();
        $result = $pdo->prepare($sql);
        $result->bindParam(':userName', $userName, PDO::PARAM_STR);
        $result->bindParam(':firstName', $firstName, PDO::PARAM_STR);
        $result->bindParam(':lastName', $lastName, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->bindParam(':phone', $phone, PDO::PARAM_STR);
        return $result->execute();
    }

    /**
     * Receives user from the database
     * @param $sql
     * @param $email
     * @param $password
     * @return mixed
     */

    public function getUser($sql, $email, $password)
    {
        $pdo = $this->connect();
        $result = $pdo->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();
        return $result->fetch();
     }

    /**
     * Updates user data
     * @param $sql
     * @param $par1
     * @param $par2
     * @param $par3
     * @param $par4
     * @return bool
     */
    public function updateData($sql, $par1, $par2, $par3, $par4, $par5)
    {
        $pdo = $this->connect();

        $result = $pdo->prepare($sql);
        $result->bindParam(1, $par1, PDO::PARAM_STR);
        $result->bindParam(2, $par2, PDO::PARAM_STR);
        $result->bindParam(3, $par3, PDO::PARAM_STR);
        $result->bindParam(4, $par4, PDO::PARAM_INT);
        $result->bindParam(5, $par5, PDO::PARAM_STR);
        return $result->execute();


    }

    /**
     * Returns an array of products by ids
     * @param $sql
     * @param $ids
     * @return array
     */
    public function getDataByIds($sql, $ids)
    {
        $pdo = $this->connect();
        $result = $pdo->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);
        return $result->fetchAll();

    }

    public function addBuyers($sql, $firstName, $lastName, $comment, $phone, $userId,  $updatedAt, $createdAt)
    {
        $pdo = $this->connect();
        $result = $pdo->prepare($sql);
        $result->bindParam(':firstName', $firstName, PDO::PARAM_STR);
        $result->bindParam(':lastName', $lastName, PDO::PARAM_STR);
        $result->bindParam(':comment', $comment, PDO::PARAM_STR);
        $result->bindParam(':phone', $phone, PDO::PARAM_STR);
        if(!$userId==false){$result->bindParam(':userId', $userId, PDO::PARAM_INT);}
        $result->bindParam(':updatedAt', $updatedAt, PDO::PARAM_STR);
        $result->bindParam(':createdAt', $createdAt, PDO::PARAM_STR);
        return $result->execute();
    }

    public  function addOrders($sql, $buyersID)
    {
        $pdo = $this->connect();
        $result = $pdo->prepare($sql);
        $result->bindParam(':id_buyers', $buyersID, PDO::PARAM_INT);
        return $result->execute();
    }

    public  function addProductOrder($sql, $idProduct, $idOrders, $price, $quantity)
    {
        $pdo = $this->connect();
        $result = $pdo->prepare($sql);
        $result->bindParam(':id_product', $idProduct, PDO::PARAM_INT);
        $result->bindParam(':id_orders', $idOrders, PDO::PARAM_INT);
        $result->bindParam(':price', $price, PDO::PARAM_INT);
        $result->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        return $result->execute();
    }
}