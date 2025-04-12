<?php

namespace Controller;

use Src\View;

class Site
{
    public function index(): string
    {
        return (new View())->render('site.hello', ['message' => 'index working']);
    }

    public function hello(): string
    {
        return (new View())->render('site.hello', ['message' => 'hello working']);
    }

}
