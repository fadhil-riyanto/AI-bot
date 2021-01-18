<?php

namespace SastrawiTest\Trka\Finder;

use Sastrawi\Trka\Finder\Abbreviation;
use Sastrawi\Trka\Validator\Abbreviation as AbbreviationValidator;

class AbbreviationTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->finder = new Abbreviation(new AbbreviationValidator(array('jl.', 'kh.')));
    }

    public function testFind()
    {
        $text   = 'Jl. KH. mukmin no. 67.';
        $tokens = $this->finder->find($text);

        $this->assertCount(2, $tokens);
        $this->assertEquals('Jl.', $tokens[0]->getCoveredText($text));
        $this->assertEquals('KH.', $tokens[1]->getCoveredText($text));
    }
}
