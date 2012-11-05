<?php

namespace Rabus\POQ;

use InvalidArgumentException;
use PHPUnit_Framework_TestCase;
use StdClass;

class POQTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException InvalidArgumentException
     */
    public function testNonTraversableObjectsShouldFail()
    {
        /** @noinspection PhpParamsInspection */
        POQ::from(new StdClass);
    }

    public function testTheCollectionShouldBeWrapped()
    {
        $collection = array('foo' => 'bar', 'foobar' => 'barfoo');
        $poq = POQ::from($collection);

        $this->assertEquals($collection, iterator_to_array($poq));
    }

    public function testToArray()
    {
        $collection = array('foo' => 'bar', 'foobar' => 'barfoo');
        $poq = POQ::from($collection);

        $this->assertEquals($collection, $poq->toArray());
    }
}
