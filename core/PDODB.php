<?php
/**
 * Created by PhpStorm.
 * User: phpstudent
 * Date: 04.01.19
 * Time: 17:34
 */

namespace App;
use PDO;


class PDODB

{

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

    public function selectData($sql){
        $pdo = $this->connect();
        $result = $pdo->query($sql)->fetchAll( );
        $data = $result;
        return $data;
    }

}