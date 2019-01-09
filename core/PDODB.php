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
        $data=$result->fetchAll( );

        //$data = $result;
        return $data;
    }

    public function selectDataById($sql, $id){
        $pdo = $this->connect();
        $result = $pdo->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();


        //$result = $pdo->query($sql);
        $data=$result->fetchAll( );

        //$data = $result;
        return $data;

    }

    public function selectCategoryById($sql, $id, $limit, $offset){
    $pdo = $this->connect();
    $result = $pdo->prepare($sql);
    $result->bindParam(':id', $id, PDO::PARAM_INT);
    $result->bindParam(':limit', $limit, PDO::PARAM_INT);
    $result->bindParam(':offset', $offset, PDO::PARAM_INT);
    $result->execute();


    //$result = $pdo->query($sql);
    $data=$result->fetchAll( );
     //$data = $result;
    return $data;

}

}