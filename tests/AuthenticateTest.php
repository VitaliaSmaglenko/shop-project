<?php
use PHPUnit\Framework\TestCase;
use Model\Authenticate;

class AuthenticateTest extends TestCase
{
    /*
     * @var Authenticate
     */
    private $auth;

    public function setUp()
    {
        $this->auth = new Authenticate;
    }

    public function testCheckLoggedIsIncorrect()
    {
        $result = $this->auth->checkLogged();
        $this->assertFalse($result);
    }
    public function testIsAuthIsIncorrect()
    {
        $result = $this->auth->isAuth();
        $this->assertFalse($result);
    }

    public function testIsAuthIsCorrect()
    {
        $_SESSION['userId'] = 1;
        $result = $this->auth->isAuth();
        $this->assertNotFalse($result);
    }

    public function testCheckLoggedIsCorrect()
    {
        $result = $this->auth->checkLogged();
        $this->assertIsInt($result);
    }
}
