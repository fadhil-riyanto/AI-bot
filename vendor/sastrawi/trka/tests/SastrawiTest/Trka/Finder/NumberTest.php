<?php

namespace SastrawiTest\Trka\Finder;

use Sastrawi\Trka\Finder\Number;
use Sastrawi\Trka\Validator\Number as NumberValidator;

class NumberTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->finder = new Number(new NumberValidator());
    }

    public function testFind()
    {
        $text   = 'harganya 50.000,50 rupiah.';
        $tokens = $this->finder->find($text);

        $this->assertCount(1, $tokens);
        $this->assertEquals('50.000,50', $tokens[0]->getCoveredText($text));
    }

    public function testFind2()
    {
        $text   = 'harganya a2.3b 50.000,50.';
        $tokens = $this->finder->find($text);

        $this->assertCount(1, $tokens);
        $this->assertEquals('50.000,50', $tokens[0]->getCoveredText($text));
    }
}
