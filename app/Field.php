<?php

declare(strict_types=1);

namespace App;

abstract class Field implements RenderableInterface
{
    public function __construct(protected string $name)
    {

    }

    abstract public function render(): string;

    // You can also have a bunch of non-abstract classes
}