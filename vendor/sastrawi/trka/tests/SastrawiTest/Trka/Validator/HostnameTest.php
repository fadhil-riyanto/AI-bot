<?php

namespace SastrawiTest\Trka\Validator;

use Sastrawi\Trka\Validator\Hostname;

class HostnameTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->validator = new Hostname();
    }

    public function testIsValidReturnTrue()
    {
        $this->assertTrue($this->validator->isValid('sastrawi.github.io'));
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
