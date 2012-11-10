<?php

namespace Rabus\POQ\Query;

use Traversable;

class Where extends Query
{
    /**
     * @var callable
     */
    private $condition;

    /**
     * @param Traversable $collection
     * @param callable $condition
     */
    public function __construct(Traversable $collection, callable $condition) {
        parent::__construct($collection);

        $this->condition = $condition;
    }

    /**
     * @return Traversable
     */
    public function getIterator()
    {
        foreach ($this->collection as $key => $value) {
            if (call_user_func($this->condition, $value)) {
                yield $key => $value;
            }
        }
    }
}
