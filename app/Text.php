<?php

declare(strict_types=1);

namespace App;

class Text extends Field
{
    public function render(int $x = 1): string
    {
        return <<<HTML
        <input type="text" name="{$this->name}" />
        HTML;
    }
}