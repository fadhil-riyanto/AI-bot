<?php

namespace SastrawiTest\Trka\Finder;

use Sastrawi\Trka\Finder\HostnameFinderFactory;

class HostnameFinderFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->factory = new HostnameFinderFactory();
    }

    public function testCreate()
    {
        $this->assertInstanceOf('Sastrawi\Trka\Finder\Hostname', $this->factory->create());
    }
}
