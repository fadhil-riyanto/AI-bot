<?php

namespace SastrawiTest\Trka\Validator;

use Sastrawi\Trka\Validator\Url;

class UrlTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->validator = new Url();
    }

    public function testIsValidReturnTrue()
    {
        $this->assertTrue($this->validator->isValid('http://sastrawi.github.io'));
    }

    public function testIsValidReturnFalse()
    {
        $this->assertFalse($this->validator->isValid('invalid-hostname'));
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf('Sastrawi\Trka\Validator\ValidatorInterface', $this->validator);
    }
}
