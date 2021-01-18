<?php

namespace SastrawiTest\Trka\Validator;

use Sastrawi\Trka\Validator\EmailAddress;

class EmailAddressTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->validator = new EmailAddress();
    }

    public function testIsValidReturnTrue()
    {
        $this->assertTrue($this->validator->isValid('andylibrian@gmail.com'));
    }

    public function testIsValidReturnFalse()
    {
        $this->assertFalse($this->validator->isValid('invalid-email'));
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf('Sastrawi\Trka\Validator\ValidatorInterface', $this->validator);
    }
}
