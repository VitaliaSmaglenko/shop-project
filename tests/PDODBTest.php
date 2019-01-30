<?php
use App\PDODB;
use PHPUnit\Framework\TestCase;

class PDODBTest extends TestCase
{
    private $pdo;

    public function setUp()
    {
        $this->pdo = new PDODB();
    }


    public function testQueryDataIsCorrect()
    {

        $sql = "SELECT  name FROM products  WHERE id = 3 ";
        $result = $this->pdo->queryData($sql);
        $this->assertIsArray($result);
    }

    public function testPrepareDataFetchAllIsCorrect()
    {
        $data = array(':id' => 22);
        $sql = 'SELECT name FROM products  WHERE id = :id ';
        $result = $this->pdo->prepareData($sql, $data, 'fetchAll');
        $this->assertIsArray($result);
    }

    public function testPrepareDataFetchIsCorrect()
    {
        $data = array(':id' => 3);
        $sql = 'SELECT name FROM products WHERE id = :id ';
        $result = $this->pdo->prepareData($sql, $data, 'fetch');
        $this->assertIsArray($result);
     }

    public function testPrepareDataExecuteIsCorrect()
    {
         $data = array(':id' => 3);
         $sql = 'SELECT name FROM products WHERE id = :id ';
         $expect = true;
         $result = $this->pdo->prepareData($sql, $data, 'execute');
         $this->assertEquals($expect, $result);
    }


    public function testPrepareDataFetchIsIncorrect()
    {
        $data = array(':id' => 1000);
        $sql = 'SELECT name FROM products WHERE id = :id';
        $expect = false;
        $result = $this->pdo->prepareData($sql, $data, 'fetch');
        $this->assertEquals($expect, $result);
    }

    public function testPrepareDataFetchAllIsIncorrect()
    {
        $data = array(':id' => 1000);
        $sql = 'SELECT name FROM products WHERE id = :id ';
        $expect = array();
        $result = $this->pdo->prepareData($sql, $data, 'fetchAll');
        $this->assertEquals($expect, $result);
    }



}
