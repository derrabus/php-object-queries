<?php

namespace Rabus\POQ\Query;

use Traversable;

use Rabus\POQ\POQ;

class Where extends POQ
{
    /**
     * @var callable
     */
    private $condition;

    /**
     * @param Traversable $collection
     * @param callable $condition
     */
    protected function __construct(Traversable $collection, callable $condition) {
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
