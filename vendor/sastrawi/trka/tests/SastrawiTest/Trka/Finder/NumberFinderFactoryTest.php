<?php

namespace SastrawiTest\Trka\Finder;

use Sastrawi\Trka\Finder\NumberFinderFactory;

class NumberFinderFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->factory = new NumberFinderFactory();
    }

    public function testCreate()
    {
        $this->assertInstanceOf('Sastrawi\Trka\Finder\Number', $this->factory->create());
    }
}
