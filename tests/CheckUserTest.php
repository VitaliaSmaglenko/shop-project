<?php
use PHPUnit\Framework\TestCase;
use Model\CheckUser;

class CheckUserTest extends TestCase
{
    private $check;

    public function setUp()
    {
        $this->check = new CheckUser();
    }

    public function testCheckUserExistsIsCorrect()
    {
        $email = 'usertest@gmail.com';
        $password =  hash("md5", 'usertest');
        $expect = true;
        $result = $this->check->checkUserExists($email, $password);
        $this->assertEquals($expect, $result);
    }

    public function testCheckUserExistsIsIncorrect()
    {
        $email = 'usertest@gmail.com';
        $password =  hash("md5", '');
        $expect = false;
        $result = $this->check->checkUserExists($email, $password);
        $this->assertEquals($expect, $result);
    }

    public function testCheckUserNameExistsIsIncorrect()
    {
        $name = 'example';

        $expect = true;
        $result = $this->check->checkUserNameExists($name);
        $this->assertEquals($expect, $result);
    }

    public function testCheckUserNameExistsIsCorrect()
    {
        $name = 'new name';

        $expect = false;
        $result = $this->check->checkUserNameExists($name);
        $this->assertEquals($expect, $result);
    }

    public function testCheckEmailExistsIsIncorrect()
    {
        $email = 'usertest1@gmail.com';

        $expect = true;
        $result = $this->check->checkEmailExists($email);
        $this->assertEquals($expect, $result);
    }

    public function testCheckEmailExistsExistsIsCorrect()
    {
        $email = 'usertest@gmail.com';

        $expect = false;
        $result = $this->check->checkEmailExists($email);
        $this->assertEquals($expect, $result);
    }

    public function testCheckPhoneIsIncorrect()
    {
        $phone = '+38005';

        $expect = false;
        $result = $this->check->checkPhone($phone);
        $this->assertEquals($expect, $result);
    }

    public function testCheckPhoneExistsIsCorrect()
    {
        $phone = '+380501717000';

        $expect = true;
        $result = $this->check->checkPhone($phone);
        $this->assertEquals($expect, $result);
    }

    public function testCheckPasswordIsIncorrect()
    {
        $password = 'asmds';

        $expect = false;
        $result = $this->check->checkPassword($password);
        $this->assertEquals($expect, $result);
    }

    public function testCheckPasswordExistsIsCorrect()
    {
        $password= 'aslpdksdk';
        $expect = true;
        $result = $this->check->checkPassword($password);
        $this->assertEquals($expect, $result);
    }

    public function testCheckEmailIsIncorrect()
    {
        $email = 'test.gmail.com';
        $expect = false;
        $result = $this->check->checkEmail($email);
        $this->assertEquals($expect, $result);
    }

    public function testCheckEmailExistsIsCorrect()
    {
        $email = 'test@gmail.com';
        $expect = true;
        $result = $this->check->checkEmail($email);
        $this->assertEquals($expect, $result);
    }

    public function testCheckFirstNameIsIncorrect()
    {
        $name = 'V';
        $expect = false;
        $result = $this->check->checkFirstName($name);
        $this->assertEquals($expect, $result);
    }

    public function testCheckFirstNameExistsIsCorrect()
    {
        $name = 'Vitalia';
        $expect = true;
        $result = $this->check->checkFirstName($name);
        $this->assertEquals($expect, $result);
    }

    public function testCheckLastNameIsIncorrect()
    {
        $name = 'V';
        $expect = false;
        $result = $this->check->checkLastName($name);
        $this->assertEquals($expect, $result);
    }

    public function testCheckLastNameExistsIsCorrect()
    {
        $name = 'Lastname';
        $expect = true;
        $result = $this->check->checkLastName($name);
        $this->assertEquals($expect, $result);
    }

    public function testCheckUserNameIsIncorrect()
    {
        $name = 'Kot';
        $expect = false;
        $result = $this->check->checkUserName($name);
        $this->assertEquals($expect, $result);
    }

    public function testCheckUserNameIsCorrect()
    {
        $name = 'Kotik';
        $expect = true;
        $result = $this->check->checkUserName($name);
        $this->assertEquals($expect, $result);
    }

    public function testCheckCheckoutIsCorrect()
    {
        $name = 'Kotik';
        $lastName = 'Lovely';
        $phone = '+380501717000';
        $expect = array();
        $result = $this->check->checkCheckout($name, $lastName, $phone);
        $this->assertEquals($expect, $result);
    }

    public function testCheckCheckoutIsIncorrect()
    {
        $name = 'Kotik';
        $lastName = 'Lovely';
        $phone = '+38050';
        $expect = array('0' => 'Invalid phone number');
        $result = $this->check->checkCheckout($name, $lastName, $phone);
        $this->assertEquals($expect, $result);
    }

    public function testCheckEditIsCorrect()
    {
        $password = 'my_kotik';
        $name = 'Kotik';
        $lastName = 'Lovely';
        $phone = '+380501717000';
        $expect = array();
        $result = $this->check->checkEdit($password, $name, $lastName, $phone);
        $this->assertEquals($expect, $result);
    }

    public function testCheckEditIsIncorrect()
    {
        $password= 'my_kotik';
        $name = 'Kotik';
        $lastName = 'Lovely';
        $phone = '+38050';
        $expect = array('0' => 'Invalid phone number');
        $result = $this->check->checkEdit($password, $name, $lastName, $phone);
        $this->assertEquals($expect, $result);
    }

    public function testCheckAuthorisationIsCorrect()
    {
        $email = 'usertest@gmail.com';
        $password =  hash("md5", 'usertest');
        $expect = array();
        $result = $this->check->checkAuthorisation($email, $password);
        $this->assertEquals($expect, $result);
    }

    public function testCheckAuthorisationIsIncorrect()
    {
        $email = 'usertest@gmail.com';
        $password =  hash("md5", 'user1234');
        $expect = array('0' => 'Wrong email or password');
        $result = $this->check->checkAuthorisation($email, $password);
        $this->assertEquals($expect, $result);
    }

    public function testCheckRegistrationIsCorrect()
    {
        $email = 'usertest1@gmail.com';
        $password =  hash("md5", 'usertest');
        $userName = 'Lovely11';
        $name = 'Kotik';
        $lastName = 'Lovely';
        $phone = '+380501717000';
        $expect = array();
        $result = $this->check->checkRegistration($email, $password, $userName, $name, $lastName, $phone);
        $this->assertEquals($expect, $result);
    }

    public function testCheckRegistrationIsIncorrect()
    {
        $email = 'usertest@gmail.com';
        $password =  hash("md5", 'usertest');
        $userName = 'Lovely11';
        $name = 'Kotik';
        $lastName = 'Lovely';
        $phone = '+380501717000';
        $password =  hash("md5", 'user1234');
        $expect = array('0' => 'This email already exists.');
        $result = $this->check->checkRegistration($email, $password, $userName, $name, $lastName, $phone);
        $this->assertEquals($expect, $result);
    }


}