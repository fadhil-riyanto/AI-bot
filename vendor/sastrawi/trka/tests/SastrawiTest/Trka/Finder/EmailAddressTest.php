<?php

namespace SastrawiTest\Trka\Finder;

use Sastrawi\Trka\Finder\EmailAddress;
use Sastrawi\Trka\Validator\EmailAddress as EmailAddressValidator;

class EmailAddressTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->finder = new EmailAddress(new EmailAddressValidator());
    }

    public function testFind()
    {
        $text   = 'kirim email ke andylibrian@gmail.com.';
        $tokens = $this->finder->find($text);

        $this->assertCount(1, $tokens);
        $this->assertEquals('andylibrian@gmail.com', $tokens[0]->getCoveredText($text));
    }

    public function testFind2()
    {
        $text   = 'kirim email ke andylibrian@gmail.com';
        $tokens = $this->finder->find($text);

        $this->assertCount(1, $tokens);
        $this->assertEquals('andylibrian@gmail.com', $tokens[0]->getCoveredText($text));
    }

    public function testFind3()
    {
        $text   = 'kirim email ke **##%%@xxx';
        $tokens = $this->finder->find($text);

        $this->assertCount(0, $tokens);
    }
}
