<?php

namespace Rabus\POQ\Query;

use IteratorAggregate, Traversable;

class Query implements IteratorAggregate
{
    protected $collection;

    /**
     * @param Traversable $collection
     */
    public function __construct(Traversable $collection)
    {
        $this->collection = $collection;
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
     * @return Take
     */
    public final function take($count)
    {
        return new Take($this, $count);
    }

    /**
     * @param int $count
     * @return Skip
     */
    public final function skip($count)
    {
        return new Skip($this, $count);
    }

    /**
     * @param callable $condition
     * @return Where
     */
    public final function where(callable $condition)
    {
        return new Where($this, $condition);
    }
}
