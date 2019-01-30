<?php

use PHPUnit\Framework\TestCase;
use App\Router;

class RouterTest extends TestCase
{
    /**
     * @var Router
     */
    private $router;

    public function setUp()
    {
        $this->router = new Router();
    }

    /**
     * Checks method run
     */
    public function testRunIsCorrect():void
    {
        $uri = 'admin/product/add';
        $_SERVER['REQUEST_URI']=$uri;
        $expect = array('controllerName' => 'AdminProductController',
            'actionName' => 'actionCreate', 'parameters' => array());


        $result=$this->router->run();
        $this->assertEquals($expect, $result);
    }

    public function testRunIsIncorrect():void
    {
        $uri = 'sdasdasd';
        $_SERVER['REQUEST_URI']=$uri;
        $expect = array('controllerName' => 'SiteController',  'actionName' => 'actionNotFound',
            'parameters' => array());
        $result=$this->router->run();
        $this->assertEquals($expect, $result);
    }
}
