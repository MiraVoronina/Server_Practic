<?php

namespace Controller;

use Src\View;
use Src\Request;
use Src\Auth\Auth;
use Model\Student;
use Model\Schedule;
use Model\Performance;
use Model\Employee;
use Model\Discipline;
use Model\Group;

class Site
{
    public function index(Request $request): string
    {
        return (new View())->render('site.index');
    }

    public function login(Request $request): string
    {
        if ($request->method === 'POST' && Auth::attempt($request->all())) {
            app()->route->redirect('/home');
        }

        return '<h2 style="text-align:center; margin-top:50px;">Необходима авторизация</h2>';
    }

    public function signup(Request $request): string
    {
        if ($request->method === 'POST' && \Model\User::create($request->all())) {
            app()->route->redirect('/login');
        }
        return (new View())->render('site.signup');
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/home');
    }

    public function hello(Request $request): string
    {
        return (new View())->render('site.hello');
    }

    public function home(Request $request): string
    {
        return (new View())->render('site.home');
    }

    public function students(Request $request): string
    {
        return (new View())->render('site.students', [
            'students' => Student::all(),
        ]);
    }

    public function schedule(Request $request): string
    {
        return (new View())->render('site.schedule', [
            'schedule' => Schedule::all(),
        ]);
    }

    public function grades(Request $request): string
    {
        return (new View())->render('site.grades', [
            'grades' => Performance::all(),
        ]);
    }

    public function employees(Request $request): string
    {
        return (new View())->render('site.admin', [
            'employees' => Employee::all(),
        ]);
    }

    private function denyIfNotDeanery(): bool
    {
        if (!Auth::check()) {
            echo '<h2 style="text-align:center; margin-top:50px;">Необходима авторизация</h2>';
            return false;
        }

        if (Auth::user()->role !== 'deanery') {
            echo '<h2 style="text-align:center; margin-top:50px;">Доступ запрещен</h2>';
            return false;
        }

        return true;
    }

    public function addSchedule(Request $request): string
    {
        if (!$this->denyIfNotDeanery()) return '';
        if ($request->method === 'POST') {
            \Model\Schedule::create($request->all());
            app()->route->redirect('/schedule');
        }
        return (new View())->render('site.schedule_add');
    }

    public function editSchedule(Request $request): string
    {
        if (!$this->denyIfNotDeanery()) return '';
        return (new View())->render('site.schedule_edit');
    }

    public function deleteSchedule(Request $request): string
    {
        if (!$this->denyIfNotDeanery()) return '';
        return (new View())->render('site.schedule_delete');
    }

    public function addStudent(Request $request): string
    {
        if ($request->method === 'POST') {
            $data = $request->all();

            $validator = new \Src\Validator($data, [
                'last_name' => ['required'],
                'first_name' => ['required'],
                'middle_name' => ['required'],
                'group_id' => ['required'],
                'address' => ['required'],
                'status' => ['required'],
            ]);

            if (!$validator->passes()) {
                return (new View())->render('site.students_add', [
                    'errors' => $validator->errors()
                ]);
            }

            \Model\Student::create($data);
            app()->route->redirect('/students');
        }

        return (new View())->render('site.students_add');
    }


    public function editStudent(Request $request): string
    {
        if (!$this->denyIfNotDeanery()) return '';
        return (new View())->render('site.students_edit');
    }

    public function deleteStudent(Request $request): string
    {
        if (!$this->denyIfNotDeanery()) return '';
        return (new View())->render('site.students_delete');
    }

    public function addGrade(Request $request): string
    {
        if (!$this->denyIfNotDeanery()) return '';
        if ($request->method === 'POST') {
            \Model\Performance::create($request->all());
            app()->route->redirect('/grades');
        }
        return (new View())->render('site.grades_add');
    }

    public function editGrade(Request $request): string
    {
        if (!$this->denyIfNotDeanery()) return '';
        return (new View())->render('site.grades_edit');
    }

    public function deleteGrade(Request $request): string
    {
        if (!$this->denyIfNotDeanery()) return '';
        return (new View())->render('site.grades_delete');
    }
}
