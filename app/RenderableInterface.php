<?php

declare(strict_types=1);

namespace App;

interface RenderableInterface
{
    public function render(): string;
}