<?php
use PHPUnit\Framework\TestCase;
use Model\Cart;

class CartTest extends TestCase
{
    /**
     * @var Cart
     */
    private $cart;

    public function setUp()
    {
        $this->cart = new Cart();
    }

    public function testCountProductIsIncorrect()
    {
        $expect = 0;
        $result = $this->cart->countProducts();
        $this->assertEquals($expect, $result);
    }

    public function testGetProductsIsIncorrect()
    {
        $expect = false;
        $result = $this->cart->getProducts();
        $this->assertEquals($expect, $result);
    }

    public function testisCartIsIncorrect()
    {
        $expect = false;
        $result = $this->cart->isCart();
        $this->assertEquals($expect, $result);
    }

    public function testisCartIsCorrect()
    {
        $expect = true;
        $_SESSION['products'] = 3;
        $result = $this->cart->isCart();
        $this->assertEquals($expect, $result);
    }


    public function testIsProductIncorrect()
    {
        $expect = false;
        $result = $this->cart->isProduct($id = 5);
        $this->assertEquals($expect, $result);
    }


    public function testIsProductCorrect()
    {
        $expect = true;
        $_SESSION['products'] = array('5' => '2');
        $result = $this->cart->isProduct($id = 5);
        $this->assertEquals($expect, $result);
    }


    public function testCountProductIsCorrect()
    {
        $expect = 2;
        $result = $this->cart->countProducts();
        $this->assertEquals($expect, $result);
    }

    public function testAddProductIsCorrect()
    {
        $id = 10;
        $expect = true;
        $result = $this->cart->addProduct($id);
        $this->assertEquals($expect, $result);
    }

    public function testGetProductsIsCorrect()
    {

        $expect = array('5' => '2', '10' => '1');
        $result = $this->cart->getProducts();
        $this->assertEquals($expect, $result);
    }

    public function testGetPriceIsCorrect()
    {
        $product = new Model\Products;
        $ids = array('5', '10');
        $product = $product->getByIds($ids);
        $expect = 7459;
        $result = $this->cart->getPrice($product);
        $this->assertEquals($expect, $result);
    }
}
