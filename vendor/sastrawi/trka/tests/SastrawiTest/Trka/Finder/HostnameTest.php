<?php

namespace SastrawiTest\Trka\Finder;

use Sastrawi\Trka\Finder\Hostname;
use Sastrawi\Trka\Validator\Hostname as HostnameValidator;

class HostnameTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->finder = new Hostname(new HostnameValidator());
    }

    public function testFind()
    {
        $text   = 'coba buka sastrawi.github.io';
        $tokens = $this->finder->find($text);

        $this->assertCount(1, $tokens);
        $this->assertEquals('sastrawi.github.io', $tokens[0]->getCoveredText($text));
    }

    public function testFind2()
    {
        $text   = 'coba buka sastrawi.github.io.';
        $tokens = $this->finder->find($text);

        $this->assertCount(1, $tokens);
        $this->assertEquals('sastrawi.github.io', $tokens[0]->getCoveredText($text));
    }
}
