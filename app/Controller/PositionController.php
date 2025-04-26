<?php

namespace Controller;

use Model\Position;
use Src\View;

class PositionController
{
    public function index(): string
    {
        $positions = Position::all();  // Получаем все позиции
        return (new View())->render('site.position', ['positions' => $positions]);
    }
}
