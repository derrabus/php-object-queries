<?php

namespace Rabus\POQ;

use ArrayIterator, InvalidArgumentException, Traversable;

use Rabus\POQ\Query\Query;

abstract class POQ
{
    /**
     * @param mixed $collection
     * @throws InvalidArgumentException
     */
    private static function assertValidCollection($collection)
    {
        if (!is_array($collection) && !($collection instanceof Traversable)) {
            throw new InvalidArgumentException('The given collection is not traversable.');
        }
    }

    /**
     * @param array|Traversable $collection
     * @return Query
     */
    public static final function from($collection)
    {
        static::assertValidCollection($collection);
        if (is_array($collection)) {
            $collection = new ArrayIterator($collection);
        }
        return new Query($collection);
    }
}
