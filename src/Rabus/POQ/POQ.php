<?php

namespace Rabus\POQ;

use ArrayIterator;
use InvalidArgumentException;
use IteratorAggregate;
use Traversable;

class POQ implements IteratorAggregate
{
    protected $collection;

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
     * @param Traversable $collection
     */
    protected function __construct(Traversable $collection)
    {
        $this->collection = $collection;
    }

    /**
     * @param array|Traversable $collection
     * @return self
     */
    public static final function from($collection)
    {
        static::assertValidCollection($collection);
        if (is_array($collection)) {
            $collection = new ArrayIterator($collection);
        }
        return new static($collection);
    }

    /**
     * @return Traversable
     */
    public function getIterator()
    {
        foreach ($this->collection as $key => $value) {
            yield $key => $value;
        }
    }

    public final function toArray()
    {
        return iterator_to_array($this);
    }

    /**
     * @param int $count
     * @return Query\Take
     */
    public final function take($count)
    {
        return new Query\Take($this, $count);
    }

    /**
     * @param int $count
     * @return Query\Skip
     */
    public final function skip($count)
    {
        return new Query\Skip($this, $count);
    }

    /**
     * @param callable $condition
     * @return Query\Where
     */
    public final function where(callable $condition)
    {
        return new Query\Where($this, $condition);
    }
}
