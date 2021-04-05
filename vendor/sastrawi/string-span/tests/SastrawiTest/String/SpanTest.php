<?php

namespace SastrawiTest\String\Span;

use Sastrawi\String\Span\Span;

class SpanTest extends \PHPUnit_Framework_TestCase
{
    public function testImplementsInterface()
    {
        $span = new Span(0, 3);
        $this->assertInstanceOf('Sastrawi\String\Span\SpanInterface', $span);
    }

    public function testConstructorParamsCanBeRetrieved()
    {
        $span = new Span(0, 3, 'type');

        $this->assertEquals(0, $span->getStart());
        $this->assertEquals(3, $span->getEnd());
        $this->assertEquals('type', $span->getType());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testStartMustBeZeroOrGreater()
    {
        $span = new Span(-1, 2);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testEndMustBeZeroOrGreater()
    {
        $span = new Span(1, -2);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testStartCannotBeGreaterThanEnd()
    {
        $span = new Span(4, 1);
    }

    public function testGetLength()
    {
        $span = new Span(1, 4);
        $this->assertEquals(3, $span->getLength());
    }

    public function testGetCoveredText()
    {
        $span = new Span(1, 3);
        $this->assertEquals('bc', $span->getCoveredText('abcdefghijklmn'));
    }

    public function testContains()
    {
        $span1 = new Span(1, 10);
        $span2 = new Span(5, 7);
        $this->assertTrue($span1->contains($span2));

        $span3 = new Span(0, 3);
        $this->assertFalse($span1->contains($span3));
    }

    public function testContainsIndex()
    {
        $span1 = new Span(1, 10);
        $this->assertTrue($span1->containsIndex(5));
        $this->assertFalse($span1->containsIndex(12));
    }

    public function testStartsWith()
    {
        $span1 = new Span(1, 10);
        $span2 = new Span(1, 3);
        $span3 = new Span(2, 4);

        $this->assertTrue($span1->startsWith($span2));
        $this->assertFalse($span1->startsWith($span3));
    }

    public function testIntersects()
    {
        $span1 = new Span(5, 10);
        $span2 = new Span(5, 7);
        $span3 = new Span(0, 1);

        $this->assertTrue($span1->intersects($span2));
        $this->assertTrue($span2->intersects($span1));
        $this->assertFalse($span1->intersects($span3));
    }

    public function testCrosses()
    {
        $span1 = new Span(5, 10);
        $span2 = new Span(2, 7);
        $span3 = new Span(0, 1);

        $this->assertTrue($span1->crosses($span2));
        $this->assertTrue($span2->crosses($span1));
        $this->assertFalse($span1->crosses($span3));
    }

    public function testToString()
    {
        $span1 = new Span(1, 10, 'type');
        $this->assertEquals('[1..10) type', $span1->__toString());
    }
}
