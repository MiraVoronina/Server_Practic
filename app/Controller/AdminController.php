<?php

namespace Controller;

use Model\Employee;
use Src\View;
use Src\Request;

class AdminController
{
    public function index(Request $request): string
    {
        $employees = Employee::all();
        return (new View())->render('site.admin', ['employees' => $employees]);
    }
}
