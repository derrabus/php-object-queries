<?php

namespace Rabus\POQ\Query;

use InvalidArgumentException;
use Traversable;

use Rabus\POQ\POQ;

class Take extends POQ
{
    /**
     * @var int
     */
    private $maxCount;

    /**
     * @param Traversable $collection
     * @param int $maxCount
     */
    protected function __construct(Traversable $collection, $maxCount)
    {
        $this->validateMaxCount($maxCount);
        parent::__construct($collection);
        $this->maxCount = intval($maxCount);
    }

    /**
     * @param mixed $maxCount
     * @throws InvalidArgumentException
     */
    private function validateMaxCount($maxCount)
    {
        if (!is_numeric($maxCount)) {
            throw new InvalidArgumentException(sprintf('Integer expected, %s given.', gettype($maxCount)));
        }
        if ($maxCount < 0) {
            throw new InvalidArgumentException(sprintf('Positive integer expected, %n given.', $maxCount));
        }
    }

    /**
     * @return Traversable
     */
    public function getIterator()
    {
        $counter = 0;
        foreach ($this->collection as $key => $value) {
            if (++$counter > $this->maxCount) {
                return;
            }
            yield $key => $value;
        }
    }
}
