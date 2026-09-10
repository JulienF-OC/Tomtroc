<?php

class View
{
    private string $viewName;

    public function __construct(string $viewName)
    {
        $this->viewName = $viewName;
    }

    public function render(array $data = []): void
    {
        extract($data);

        $viewPath = __DIR__ . '/../views/' . $this->viewName . '.php';

        if (!file_exists($viewPath)) {
            throw new Exception('La vue demandée n\'existe pas.');
        }

        ob_start();

        require $viewPath;

        $content = ob_get_clean();

        require __DIR__ . '/../templates/main.php';
    }
}