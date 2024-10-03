<?php

declare(strict_types=1);

namespace App;

class InvoiceCollection implements \Iterator
{
    // You can also use a 'key' or 'pointer' property or whatever you want
    // to name to keep track of the current item in the element.
    // Here we are using the PHP's inbuilt functions.
    public function __construct(
        public array $invoices
    )
    {

    }

    public function current(): Invoice {
        echo __METHOD__ . '<br/>';

        // PHP's built-in function that returns the 
        // current element in an iterable (array or object)
        return current($this->invoices);
    }

    public function next(): void {
        echo __METHOD__ . '<br/>';

        // PHP's built-in function that moves the pointer in an
        // iterable to the next element
        next($this->invoices);
    }

    public function key(): mixed {
        echo __METHOD__ . '<br/>';

        return key($this->invoices);
    }

    public function valid(): bool {
        echo __METHOD__ . '<br/>';

        return current($this->invoices) !== false;
    }

    public function rewind(): void {
        echo __METHOD__ . '<br/>';


        reset($this->invoices);
    }

}