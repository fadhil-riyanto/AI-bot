<?php

namespace SastrawiTest\Trka\Validator;

use Sastrawi\Trka\Validator\Abbreviation;

class AbbreviationTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->validator = new Abbreviation(array('jl.'));
    }

    public function testInstanceOf()
    {
        $this->assertInstanceOf('Sastrawi\Trka\Validator\ValidatorInterface', $this->validator);
    }

    public function testIsValidReturnTrue()
    {
        $this->assertTrue($this->validator->isValid('jl.'));
    }

    public function testIsValidReturnFalse()
    {
        $this->assertFalse($this->validator->isValid('unknown-abbr'));
    }
}
