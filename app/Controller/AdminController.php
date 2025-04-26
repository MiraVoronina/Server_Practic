<?php

namespace Controller;

use Src\Request;
use Src\View;
use Src\Auth\Auth;
use Model\Employee;

class AdminController
{
    private function denyIfNotAdmin(): bool
    {
        if (!Auth::check()) {
            echo '<h2 style="text-align:center; margin-top:50px;">Необходима авторизация</h2>';
            return false;
        }

        if (Auth::user()->role !== 'admin') {
            echo '<h2 style="text-align:center; margin-top:50px;">Доступ запрещен</h2>';
            return false;
        }

        return true;
    }

    public function index(Request $request): string
    {
        return (new View())->render('site.admin', [
            'employees' => Employee::all(),
        ]);
    }

    public function addEmployee(Request $request): string
    {
        if (!$this->denyIfNotAdmin()) return '';

        if ($request->method === 'POST') {
            Employee::create($request->all());
            app()->route->redirect('/employees');
        }

        return (new View())->render('site.employees_add');
    }

    public function editEmployee(Request $request): string
    {
        if (!$this->denyIfNotAdmin()) return '';

        if ($request->method === 'POST') {
            $data = $request->all();
            $employee = Employee::find($data['id']);

            if ($employee) {
                if (!empty($data['first_name'])) $employee->first_name = $data['first_name'];
                if (!empty($data['last_name'])) $employee->last_name = $data['last_name'];
                if (!empty($data['position_id'])) $employee->position_id = $data['position_id'];
                $employee->save();
            }

            app()->route->redirect('/employees');
        }

        return (new View())->render('site.employees_edit');
    }

    public function deleteEmployee(Request $request): string
    {
        if (!$this->denyIfNotAdmin()) return '';

        if ($request->method === 'POST') {
            $employee = Employee::find($request->all()['id']);
            if ($employee) {
                $employee->delete();
            }

            app()->route->redirect('/employees');
        }

        return (new View())->render('site.employees_delete');
    }
}
