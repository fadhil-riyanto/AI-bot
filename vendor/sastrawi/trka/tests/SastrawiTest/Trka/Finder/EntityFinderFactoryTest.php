<?php

namespace SastrawiTest\Trka\Finder;

use Sastrawi\Trka\Finder\EntityFinderFactory;

class EntityFinderFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->factory = new EntityFinderFactory();
    }

    public function testCreate()
    {
        $this->assertInstanceOf('Sastrawi\Trka\Finder\Entity', $this->factory->create());
    }
}
