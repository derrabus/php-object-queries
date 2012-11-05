<?php

namespace Rabus\POQ\Query;

use InvalidArgumentException;
use Traversable;

use Rabus\POQ\POQ;

class Skip extends POQ
{
    /**
     * @var int
     */
    private $skipCount;

    /**
     * @param Traversable $collection
     * @param int $skipCount
     */
    protected function __construct(Traversable $collection, $skipCount)
    {
        $this->validateSkipCount($skipCount);
        parent::__construct($collection);
        $this->skipCount = intval($skipCount);
    }

    /**
     * @param mixed $maxCount
     * @throws InvalidArgumentException
     */
    private function validateSkipCount($maxCount)
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
            if ($counter++ < $this->skipCount) {
                continue;
            }
            yield $key => $value;
        }
    }
}
