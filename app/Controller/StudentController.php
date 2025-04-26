<?php

namespace Controller;

use Src\View;
use Src\Request;
use Model\Student;

class StudentController
{
    public function index(Request $request): string
    {
        $students = Student::all();
        return (new View())->render('site.students', ['students' => $students]);
    }
}
