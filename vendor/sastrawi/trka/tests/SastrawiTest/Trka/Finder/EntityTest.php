<?php

namespace SastrawiTest\Trka\Finder;

use Sastrawi\Trka\Finder\Entity;
use Sastrawi\Trka\Finder\UrlFinderFactory;
use Sastrawi\Trka\Finder\HostnameFinderFactory;

class EntityTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $urlFinderFactory = new UrlFinderFactory();
        $hostnameFinderFactory = new HostnameFinderFactory();

        $urlFinder = $urlFinderFactory->create();
        $hostnameFinder = $hostnameFinderFactory->create();

        $this->finder = new Entity(array($urlFinder, $hostnameFinder));
    }

    public function testFind()
    {
        $text   = 'coba buka http://sastrawi.github.io atau sastrawi.github.io.';
        $tokens = $this->finder->find($text);

        $this->assertCount(2, $tokens);
        $this->assertEquals('http://sastrawi.github.io', $tokens[0]->getCoveredText($text));
        $this->assertEquals('sastrawi.github.io', $tokens[1]->getCoveredText($text));
    }
}
