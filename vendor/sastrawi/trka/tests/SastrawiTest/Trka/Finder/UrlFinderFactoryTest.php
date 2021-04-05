<?php

namespace SastrawiTest\Trka\Finder;

use Sastrawi\Trka\Finder\UrlFinderFactory;

class UrlFinderFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->factory = new UrlFinderFactory();
    }

    public function testCreate()
    {
        $this->assertInstanceOf('Sastrawi\Trka\Finder\Url', $this->factory->create());
    }
}
