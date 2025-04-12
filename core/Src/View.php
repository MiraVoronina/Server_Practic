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

    //Полный путь до директории с представлениями
    private function getRoot(): string
    {
        global $app;

        $root = $app->settings->path['views'] ?? 'views';

        return realpath(__DIR__ . '/../../' . $root);
    }


    //Путь до основного файла с шаблоном сайта
    private function getPathToMain(): string
    {
        return $this->root . $this->layout;
    }

    //Путь до текущего шаблона
    private function getPathToView(string $view = ''): string
    {
        $view = str_replace('.', '/', $view);
        return $this->getRoot() . "/$view.php";
    }

    public function render(string $view = '', array $data = []): string
    {
        $path = $this->getPathToView($view);

        if (file_exists($this->getPathToMain()) && file_exists($path)) {

            extract($data, EXTR_PREFIX_SAME, '');
            ob_start();
            require $path;
            $content = ob_get_clean();

            ob_start();                        // начинаем буферизацию
            require $this->getPathToMain();   // подключаем шаблон
            return ob_get_clean();            // возвращаем его как строку
        }

        throw new \Exception('Error render');
    }

    public function __toString(): string
    {
        return $this->render($this->view, $this->data);
    }

}