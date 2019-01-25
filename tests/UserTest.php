<?php
use PHPUnit\Framework\TestCase;
use Model\User;

class UserTest extends TestCase
{
    private $user;

    public function setUp()
    {
        $this->user = new User;
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
        $result = $this->user->getById($id);
        $this->assertEquals($expect, $result);
    }

    public function testCreateUserIsCorrect()
    {
        $userObj = new User();
        $userObj->setUserName('TestUser');
        $userObj->setFirstName('User');
        $userObj->setLastName('Test');
        $userObj->setEmail('testuser@gmail.com');
        $userObj->setPassword(hash("md5", 'tetsuser'));
        $userObj->setPhone('+380500000006');
        $expect = true;
        $result = $this->user->createUser();
        $this->assertEquals($expect, $result);
    }

    /*
    public function testGetIsCorrect()
    {
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

        $userTest = new User();
        $userTest->setEmail('usertest@gmail.com');
        $userTest->setPassword(hash("md5", 'testuser'));
        $result = $this->user->get();
        $this->assertEquals($expect, $result);
    }
    */

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


}
