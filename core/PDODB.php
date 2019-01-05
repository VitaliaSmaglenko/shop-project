<?php
/**
 * Class PDODB
 * Component for working with database
 */

namespace App;
use PDO;

class PDODB

{
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
            die('Подключение не удалось: ' . $e->getMessage());
        }


    }

    /**
     * Receives data from the database
     * @param $sql
     * @return array
     */

    public function selectData($sql){
        $pdo = $this->connect();
        $result = $pdo->query($sql)->fetchAll( );
        $data = $result;
        return $data;
    }

}