<?php

declare(strict_types=1);

namespace App;

class Collection implements \IteratorAggregate
{
    
    public function __construct(
        private array $items
    ) {}

    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->items);
    }
}