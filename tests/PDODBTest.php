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

        $sql = "SELECT  user_name FROM user  WHERE id = 22 ";
        $expect = array('0' => array('user_name' => 'new name'));
        $result = $this->pdo->queryData($sql);
        $this->assertEquals($expect, $result);
    }

    public function testPrepareDataFetchAllIsCorrect()
    {
        $data = array(':id' => 22);
        $sql = 'SELECT  user_name FROM user  WHERE id = :id ';
        $expect = array('0' => array('user_name' => 'new name'));
        $result = $this->pdo->prepareData($sql, $data, 'fetchAll');
        $this->assertEquals($expect, $result);
    }

    public function testPrepareDataFetchIsCorrect()
    {
        $data = array(':id' => 22);
        $sql = 'SELECT  user_name FROM user  WHERE id = :id ';
        $expect = array('user_name' => 'new name');
        $result = $this->pdo->prepareData($sql, $data, 'fetch');
        $this->assertEquals($expect, $result);
    }

    public function testPrepareDataExecuteIsCorrect()
    {
        $data = array(':id' => 22);
        $sql = 'UPDATE user SET user_name = "new name" WHERE id = :id ';
        $expect = true;
        $result = $this->pdo->prepareData($sql, $data, 'execute');
        $this->assertEquals($expect, $result);
    }


    public function testPrepareDataFetchIsIncorrect()
    {
        $data = array(':id' => 1000);
        $sql = 'UPDATE user SET user_name = "new name" WHERE id = :id ';
        $expect = false;
        $result = $this->pdo->prepareData($sql, $data, 'fetch');
        $this->assertEquals($expect, $result);
    }

    public function testPrepareDataFetchAllIsIncorrect()
    {
        $data = array(':id' => 1000);
        $sql = 'UPDATE user SET user_name = "new name" WHERE id = :id ';
        $expect = array();
        $result = $this->pdo->prepareData($sql, $data, 'fetchAll');
        $this->assertEquals($expect, $result);
    }



}
