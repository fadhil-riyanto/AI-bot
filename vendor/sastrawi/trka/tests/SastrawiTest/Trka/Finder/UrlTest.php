<?php

namespace SastrawiTest\Trka\Finder;

use Sastrawi\Trka\Finder\Url;
use Sastrawi\Trka\Validator\Url as UrlValidator;

class UrlTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->finder = new Url(new UrlValidator());
    }

    public function testFind()
    {
        $text   = 'coba buka http://sastrawi.github.io';
        $tokens = $this->finder->find($text);

        $this->assertCount(1, $tokens);
        $this->assertEquals('http://sastrawi.github.io', $tokens[0]->getCoveredText($text));
    }

    public function testFind2()
    {
        $text   = 'coba buka http://sastrawi.github.io.';
        $tokens = $this->finder->find($text);

        $this->assertCount(1, $tokens);
        $this->assertEquals('http://sastrawi.github.io', $tokens[0]->getCoveredText($text));
    }
}
