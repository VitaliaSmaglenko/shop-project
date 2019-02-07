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
    private static $logger;
    private static $pdo;

    /**
     * PDODB constructor.
     */
    public function __construct()
    {
        self::$logger = new Log('pdo');
    }

    /**
     * Establishes a database connection
     * @return PDO
     */

    public static function connect()
    {
        $conf = include('config/db.php');
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
            self::$pdo = new PDO($dsn, $user, $pass, $opt);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return self::$pdo;
        } catch (PDOException $e) {
            die('Подключение не удалось: ' . self::$logger->error($e->getMessage()));
        }
    }

    /**
     * @return PDO
     */
    public static function getPDO():pdo
    {
        if (self::$pdo != null) {
            return self::$pdo;
        }
        self::$pdo = self::connect();
        return self::$pdo;
    }

    /**
     * Executes queries
     * @param $sql
     * @param string $method
     * @return array
     */
    public static function queryData(string $sql, string $method = ''):array
    {
        $pdo = self::getPDO();
        try {
            $result = $pdo->query($sql);
            if ($method == "setFetchMode") {
                $result->setFetchMode(PDO::FETCH_ASSOC);
            }
            return $result->fetchAll();
        } catch (PDOException $e) {
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
    public static function prepareData(string $sql, array $data, string $method)
    {
        $pdo = self::getPDO();
        try {
            $result = $pdo->prepare($sql);
            foreach ($data as $k => $v) {
                $result->bindValue($k, $v);
            }
            if ($result->execute()) {
                if ($method == 'fetchAll') {
                      return $result->fetchAll();
                } elseif ($method == 'fetch') {
                       return $result->fetch();
                } elseif ($method == 'fetchColumn') {
                        return $result->fetchColumn();
                } elseif ($method == 'lastId') {
                        return $pdo->lastInsertId();
                } elseif ($method == 'setFetchMode') {
                    $result->setFetchMode(PDO::FETCH_ASSOC);
                    return $result->fetch();
                }
                return true;
            }
            return false;
        } catch (PDOException $e) {
            die("You have errors: {$e->getMessage()}\n");
        }
    }
}
