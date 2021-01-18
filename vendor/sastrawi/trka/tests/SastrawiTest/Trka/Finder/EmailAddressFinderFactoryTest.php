<?php

namespace SastrawiTest\Trka\Finder;

use Sastrawi\Trka\Finder\EmailAddressFinderFactory;

class EmailAddressFinderFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->factory = new EmailAddressFinderFactory();
    }

    public function testCreate()
    {
        $this->assertInstanceOf('Sastrawi\Trka\Finder\EmailAddress', $this->factory->create());
    }
}
