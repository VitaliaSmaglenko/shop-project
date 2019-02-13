<?php

use PHPUnit\Framework\TestCase;
use Model\Products;

class ProductsTest extends TestCase
{
    /**
     * @var Products
     */
    private $product;

    public function setUp()
    {
        $this->product = new Products;
    }

    public function testGetByCategoryIsCorrect()
    {
        $id = 15;
        $result = $this->product->getByCategory($id);
        $this->assertIsArray($result);
    }

    public function testGetByCategoryIsInCorrect()
    {
        $result = $this->product->getByCategory();
        $expect = array();
        $this->assertEquals($expect, $result);
    }

    public function testGetIsCorrect()
    {
        $result = $this->product->get();
        $this->assertIsArray($result);
    }

    public function getSearchDataProvider()
    {
        return array(
            array('apple'),
            array('Apple'),
            array('APPLE'),
            array('ApPLE')
        );
    }

    /**
     * @dataProvider  getSearchDataProvider
     */
    public function testGetSearchIsCorrect($search)
    {
        $result = $this->product->getSearch($search);
        $this->assertIsArray($result);
    }

    public function getSearchIncorrectDataProvider()
    {
        return array(
            array('noproducts'),
            array('1234'),
            array('apdfs'),
        );
    }
    /**
     * @dataProvider  getSearchIncorrectDataProvider
     */
    public function testGetSearchIsInCorrect($search)
    {
        $result = $this->product->getSearch($search);
        $expect = array();
        $this->assertEquals($expect, $result);
    }

    public function testGetCatalogIsCorrect()
    {
        $result = $this->product->getCatalog();
        $this->assertIsArray($result);
    }

    public function testGetAdminIsCorrect()
    {
        $result = $this->product->getAdmin();
        $this->assertIsArray($result);
    }

    public function testGetByIdIsCorrect()
    {
        $id = 15;
        $this->product->getById($id);
        $this->assertIsObject($result = new Products);
    }

    public function testGetByIdsIsCorrect()
    {
        $ids = array(9, 15, 20);
        $result = $this->product->getByIds($ids);
        $this->assertIsArray($result);
    }

    public function testGetByIdsIsInCorrect()
    {
        $ids = array(0);
        $result = $this->product->getByIds($ids);
        $expect = array();
        $this->assertEquals($expect, $result);
    }

    public function testGetTotalProductByIdIsCorrect()
    {
        $id = 9;
        $result = $this->product->getTotalProductById($id);
        $this->assertIsInt($result);
    }

    public function testGetTotalProductIsCorrect()
    {
        $result = $this->product->getTotalProduct();
        $this->assertIsInt($result);
    }

    public function testGetTotalSearchIsCorrect()
    {
        $search = 'apple';
        $result = $this->product->getTotalSearch($search);
        $this->assertIsInt($result);
    }

    public function testGetSortingByPrice()
    {
        $result = $this->product->getSortingByPrice();
        $this->assertIsArray($result);
    }
}
