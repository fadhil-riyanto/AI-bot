<?php

namespace SastrawiTest\Trka\Validator;

use Sastrawi\Trka\Validator\Number;

class NumberTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->validator = new Number();
    }

    public function testIsValidReturnTrue()
    {
        $this->assertTrue($this->validator->isValid('5000'));
        $this->assertTrue($this->validator->isValid('5.000'));
        $this->assertTrue($this->validator->isValid('5.000,25'));
    }

    public function testIsValidReturnFalse()
    {
        $this->assertFalse($this->validator->isValid('invalid-number'));
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf('Sastrawi\Trka\Validator\ValidatorInterface', $this->validator);
    }
}
