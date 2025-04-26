<?php

namespace Src;

use Exception;

class View
{
    private string $view = '';
    private array $data = [];
    private string $root = '';
    private string $layout = '/layouts/main.php';

    public function __construct(string $view = '', array $data = [])
    {
        $this->root = $this->getRoot();
        $this->view = $view;
        $this->data = $data;
    }

    private function getRoot(): string
    {
        global $app;
        $root = $app->settings->getRootPath();
        $path = $app->settings->getViewsPath();
        return realpath(__DIR__ . "/../../views");

    }

    private function getPathToMain(): string
    {
        return $this->root . $this->layout;
    }

    private function getPathToView(string $view = ''): string
    {
        $view = str_replace('.', '/', $view);
        return $this->getRoot() . "/$view.php";
    }

    public function render(string $view = '', array $data = []): string
    {
        $path = $this->getPathToView($view);

        if (file_exists($this->getPathToMain()) && file_exists($path)) {
            extract($data, EXTR_SKIP);

            // Получаем контент из шаблона
            ob_start();
            require $path;
            $content = ob_get_clean();

            ob_start();
            $content = $content ?? '';
            include $this->getPathToMain();
            return ob_get_clean();

        }

        throw new \Exception('Error render: шаблон не найден');
    }

    public function __toString(): string
    {
        try {
            return $this->render($this->view, $this->data);
        } catch (\Throwable $e) {
            return 'Ошибка отображения: ' . $e->getMessage();
        }
    }
}
