<?php
use PHPUnit\Framework\TestCase;
use Model\User;

class UserTest extends TestCase
{
    private static $user;

    public function setUp()
    {
        self::$user = new User;
    }

    public function testGetByIdIsCorrect()
    {
        $id = 15;
        $objUser = new User;
        $objUser->setEmail('dream@gmail.com');
        $objUser->setFirstName('Fox');
        $objUser->setLastName('Dream');
        $objUser->setPassword('301fdb4ab42afde8b70c0395b507907c');
        $objUser->setId(15);
        $objUser->setUserName('DreamFoxxy');
        $objUser->setPhone('+380501700086');
        $objUser->setRole('admin');
        $expect = $objUser;
        $result =  self::$user->getById($id);
        $this->assertEquals($expect, $result);
    }

    public function testCreateUserIsCorrect()
    {

        self::$user->setUserName('TestUser');
        self::$user->setFirstName('User');
        self::$user->setLastName('Test');
        self::$user->setEmail('testuser@gmail.com');
        self::$user->setPassword(hash("md5", 'tetsuser'));
        self::$user->setPhone('+380500000006');
        $expect = true;
        $result = self::$user->createUser();
        $this->assertEquals($expect, $result);
       // self::$user->delete();
    }


    public function testGetIsCorrect()
    {

        self::$user->setEmail('testuser@gmail.com');
        self::$user->setPassword(hash("md5", 'tetsuser'));
        $result = self::$user->get();
        $this->assertIsObject($result = new User);
    }

/*
    public function testUpdateUser()
    {
        $id = 17;
        $objUser = new User;
        $objUser->setFirstName('NewtestUser');
        $objUser->setLastName('test');
        $objUser->setPassword((hash("md5", 'testuser')));
        $objUser->setPhone('+380501700086');
        $expect = true;
        $result = $this->user->updateUser($id);
        $this->assertEquals($expect, $result);
    }
*/



    public static function tearDownAfterClass()
    {
        self::$user->delete();
    }
}
