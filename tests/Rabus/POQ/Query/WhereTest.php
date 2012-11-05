<?php

namespace Rabus\POQ\Query;

use PHPUnit_Framework_TestCase;

use Rabus\POQ\POQ;

class WhereTest extends PHPUnit_Framework_TestCase
{
    public function testWithConditionAlwaysTrue()
    {
        $collection = ['foo' => 'bar', 'foobar' => 'barfoo'];
        $where = POQ::from($collection)
            ->where(function () { return true; });

        $this->assertEquals($collection, iterator_to_array($where));
    }

    public function testWithConditionAlwaysFalse()
    {
        $collection = ['foo' => 'bar', 'foobar' => 'barfoo'];
        $where = POQ::from($collection)
            ->where(function () { return false; });

        $this->assertEquals(array(), iterator_to_array($where));
    }

    public function testEvenNumbers()
    {
        $collection = [-2, -1, 0, 1, 2];
        $condition = function ($i) {
            return $i % 2 == 0;
        };
        $expected = [0 => -2, 2 => 0, 4 => 2];

        $where = POQ::from($collection)->where($condition);

        $this->assertEquals($expected, iterator_to_array($where));
    }
}
