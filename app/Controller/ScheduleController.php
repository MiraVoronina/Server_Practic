<?php

namespace Controller;

use Src\View;
use Src\Request;
use Model\Schedule;

class ScheduleController
{
    public function index(Request $request): string
    {
        $schedule = Schedule::all();
        return (new View())->render('site.schedule', ['schedule' => $schedule]);
    }
}
