<?php

declare(strict_types=1);

namespace App;
use App\Exception\ViewNotFoundException;

class View
{
    protected const VIEW_DIR = VIEW_DIR;

    private ?string $layoutView = null;
    private array $layoutParams = [];

    protected function __construct(
        private string $view,
        private array $params,
    ) {}

    public static function make(
        string $view,
        array $params=[],
    ): static
    {
        return new static($view, $params);
    }

    public function useLayout(?string $layoutView=null, array $layoutParams=[]): static
    {
        $this->layoutView = $layoutView;
        $this->layoutParams = $layoutParams;

        return $this;
    }

    public function render(): string
    {
        $viewPath = $this::VIEW_DIR . $this->view . '.php';
        if (! file_exists($viewPath)) {
            throw new ViewNotFoundException();
        }

        // Get the content of the view content
        ob_start();
        include $viewPath;
        $viewContent = ob_get_clean();

        // Use the layout if available
        if ($this->layoutView !== null) {
            $this->layoutParams['content'] = $viewContent;
            $layoutViewContent = (string) LayoutView::make($this->layoutView, $this->layoutParams);

            $viewContent = $layoutViewContent;
        }

        // Retrieve all the placeholders
        preg_match_all("/\{\{ *([a-zA-Z_0-9]*) *\}\}/", $viewContent, $matches);
        [$placeholders, $params] = $matches;

        // Look for the placeholders and replace them accordingly
        foreach($placeholders as $index => $placeholder) {
            $param = $params[$index];
            if (! isset($this->params[$param])) {
                throw new \Exception("No value for placeholder '$param'");
            }

            $viewContent = str_replace($placeholder, $this->params[$param], $viewContent);
        }

        return $viewContent;
    }

    public function __toString()
    {
        return $this->render();
    }

}