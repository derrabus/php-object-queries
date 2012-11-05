<?php

namespace Rabus\POQ\Query;

use PHPUnit_Framework_TestCase;
use StdClass;

use Rabus\POQ\POQ;

class TakeTest extends PHPUnit_Framework_TestCase
{
    public function testTakeZeroOfTwo() {
        $collection = ['foo' => 'bar', 'foobar' => 'barfoo'];

        $take = POQ::from($collection)->take(0);

        $this->assertEquals([], iterator_to_array($take));
    }

    public function testTakeOneOfTwo() {
        $collection = ['foo' => 'bar', 'foobar' => 'barfoo'];
        $expected = ['foo' => 'bar'];

        $take = POQ::from($collection)->take(1);

        $this->assertEquals($expected, iterator_to_array($take));
    }

    public function testTakeTwoOfTwo() {
        $collection = ['foo' => 'bar', 'foobar' => 'barfoo'];

        $take = POQ::from($collection)->take(2);

        $this->assertEquals($collection, iterator_to_array($take));
    }

    public function testTakeThreeOfTwo() {
        $collection = ['foo' => 'bar', 'foobar' => 'barfoo'];

        $take = POQ::from($collection)->take(3);

        $this->assertEquals($collection, iterator_to_array($take));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidCountShouldFail()
    {
        POQ::from([])->take(new StdClass);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testNegativeCountShouldFail()
    {
        POQ::from([])->take(-1);
    }
}
