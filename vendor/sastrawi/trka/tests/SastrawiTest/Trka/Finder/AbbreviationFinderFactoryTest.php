<?php

namespace SastrawiTest\Trka\Finder;

use Sastrawi\Trka\Finder\AbbreviationFinderFactory;

class AbbreviationFinderFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->factory = new AbbreviationFinderFactory();
    }

    public function testCreate()
    {
        $this->assertInstanceOf('Sastrawi\Trka\Finder\Abbreviation', $this->factory->create());
    }

    public function testAddAbbreviations()
    {
        $count = count($this->factory->getAbbreviations());
        $this->factory->addAbbreviations(array('abcdefghijklmn'));
        $this->assertCount($count+1, $this->factory->getAbbreviations());
        $this->factory->addAbbreviations(array('abcdefghijklmn'));
        $this->assertCount($count+1, $this->factory->getAbbreviations());
    }
}
