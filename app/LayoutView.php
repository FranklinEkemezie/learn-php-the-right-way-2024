<?php

namespace App;

class LayoutView extends View
{
    public const INDEX = 'index';
    protected const VIEW_DIR = LAYOUT_DIR;

    public function renderi(): string
    {
        // A valid layout must have at leat a 'content' placeholder
        $layoutViewContent = parent::render();

        preg_match_all("/\{\{ *([a-zA-Z_0-9]*) *\}\}/", $layoutViewContent, $layoutParams);

        if (! in_array('content', $layoutParams[1],)) {
            throw new \Exception('Layout is not a valid layout');
        }

        return $layoutViewContent;

    }

}