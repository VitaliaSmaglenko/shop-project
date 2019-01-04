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
    public $pdo;

    public function connect(){
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
        ///$pdo = new PDO($dsn, $user, $pass, $opt);

        try {
            $this->pdo = new PDO($dsn, $user, $pass, $opt);
        } catch (PDOException $e) {
            die('Подключение не удалось: ' . $e->getMessage());
        }


    }

    public function selectData(){
        $data = $this->pdo->query('SELECT category FROM category')->fetchAll(PDO::FETCH_COLUMN);
        print_r($data);
        return $data;
    }

}