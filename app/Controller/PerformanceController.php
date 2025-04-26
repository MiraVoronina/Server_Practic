<?php

namespace Controller;

use Src\View;
use Src\Request;
use Model\Performance;

class PerformanceController
{
    public function index(Request $request): string
    {
        $grades = Performance::all();
        return (new View())->render('site.grades', ['grades' => $grades]);
    }
}
