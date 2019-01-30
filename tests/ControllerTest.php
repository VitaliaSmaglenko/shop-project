<?php
use PHPUnit\Framework\TestCase;
use App\Controller;

class ControllerTest extends TestCase
{
    /**
     * @var Controller;
     */
    private $controller;

    public function setUp()
    {
        $this->controller = new Controller();
    }

    /**
     *  @expectedException
     */
    public function testStartIsCorrect():void
    {

//        $this->expectException(\InvalidArgumentException::class);
        $result = array('controllerName' => 'example',
            'actionName' => 'example', 'parameters' => array());
        $this->controller ->start($result);
    }
}
