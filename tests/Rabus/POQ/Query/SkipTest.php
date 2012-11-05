<?php

namespace Rabus\POQ\Query;

use PHPUnit_Framework_TestCase;
use StdClass;

use Rabus\POQ\POQ;

class SkipTest extends PHPUnit_Framework_TestCase
{
    public function testSkipZeroOfTwo() {
        $collection = ['foo' => 'bar', 'foobar' => 'barfoo'];

        $take = POQ::from($collection)->skip(0);

        $this->assertEquals($collection, iterator_to_array($take));
    }

    public function testSkipOneOfTwo() {
        $collection = ['foo' => 'bar', 'foobar' => 'barfoo'];
        $expected = ['foobar' => 'barfoo'];

        $take = POQ::from($collection)->skip(1);

        $this->assertEquals($expected, iterator_to_array($take));
    }

    public function testSkipTwoOfTwo() {
        $collection = ['foo' => 'bar', 'foobar' => 'barfoo'];

        $take = POQ::from($collection)->skip(2);

        $this->assertEquals([], iterator_to_array($take));
    }

    public function testSkipThreeOfTwo() {
        $collection = ['foo' => 'bar', 'foobar' => 'barfoo'];

        $take = POQ::from($collection)->skip(3);

        $this->assertEquals([], iterator_to_array($take));
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
