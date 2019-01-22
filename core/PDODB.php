<?php
/**
 * Class PDODB
 * Component for working with database
 */

namespace App;
use PDO;
use PDOException;
use Logger\Log;



class PDODB

{
    /**
     * @var Log
     */
    private $logger;

    /**
     * PDODB constructor.
     */
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
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          return $pdo;
        } catch (PDOException $e) {
            die('Подключение не удалось: ' . $this->logger->error($e->getMessage()));
        }


    }


    /**
     * Executes queries
     * @param $sql
     * @param string $method
     * @return array
     */
    public function queryData($sql, $method=''){
        $pdo = $this->connect();

        try{
            $result = $pdo->query($sql);
            if($method == "setFetchMode"){
                $result->setFetchMode(PDO::FETCH_ASSOC);
            }
            return $result->fetchAll( );

        }catch (PDOException $e){
            die("You have errors: {$e->getMessage()}\n");
        }

    }

    /**
     * Executes a prepared query
     * @param $sql
     * @param $data
     * @param $method
     * @return array|bool|mixed|string
     */
    public function prepareData($sql, $data, $method)
    {
        $pdo = $this->connect();
        try {
            $result = $pdo->prepare($sql);
            foreach ($data as $k => $v){
                $result->bindValue($k, $v);
            }

            if($result->execute()){
                  if ($method == 'fetchAll') {
                      return $result->fetchAll();

                  } elseif ($method == 'fetch') {
                       return $result->fetch();

                  } elseif ($method == 'fetchColumn') {
                        return $result->fetchColumn();

                  } elseif ($method == 'lastId') {
                        return $pdo->lastInsertId();
                  }
                return true;
            }

            return false;

        }catch (PDOException $e ){
            die("You have errors: {$e->getMessage()}\n");
        }
    }
}