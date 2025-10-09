<?php

namespace Controller;

use Model\Position;
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
            $data = $request->all();

            $validator = new \Src\Validator\Validator($data, [
                'last_name' => ['required', 'min:2', 'max:100'],
                'first_name' => ['required', 'min:2', 'max:100'],
                'middle_name' => ['required', 'min:2', 'max:100'],
                'phone' => ['required', 'min:10'],
                'login' => ['required', 'min:3'],
                'password' => ['required', 'min:6'],
                'position_id' => ['required', 'numeric'],
            ]);

            if ($validator->fails()) {
                return (new View())->render('site.employees_add', [
                    'errors' => $validator->errors(),
                    'old' => $data,
                    'positions' => Position::all()
                ]);
            }

            // Хешируем пароль
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);

            Employee::create($data);
            app()->route->redirect('/employees');
        }

        return (new View())->render('site.employees_add', [
            'positions' => Position::all()
        ]);
    }

    public function editEmployee(Request $request): string
    {
        if (!$this->denyIfNotAdmin()) return '';

        if ($request->method === 'GET') {
            $id = $request->get('id');

            if (!$id) {
                return (new View())->render('site.employees_edit', [
                    'employees' => Employee::all(),
                    'employee' => null,
                    'positions' => Position::all()
                ]);
            }

            $employee = Employee::find($id);

            if (!$employee) {
                return '<h2 style="text-align:center; margin-top:50px;">Сотрудник не найден</h2>';
            }

            return (new View())->render('site.employees_edit', [
                'employees' => Employee::all(),
                'employee' => $employee,
                'positions' => Position::all()
            ]);
        }

        if ($request->method === 'POST') {
            $data = $request->all();

            $validator = new \Src\Validator\Validator($data, [
                'id' => ['required', 'numeric'],
                'last_name' => ['required', 'min:2', 'max:100'],
                'first_name' => ['required', 'min:2', 'max:100'],
                'middle_name' => ['required', 'min:2', 'max:100'],
                'phone' => ['required', 'min:10'],
                'login' => ['required', 'min:3'],
                'position_id' => ['required', 'numeric'],
            ]);

            if ($validator->fails()) {
                $employee = Employee::find($data['id'] ?? null);
                return (new View())->render('site.employees_edit', [
                    'employees' => Employee::all(),
                    'employee' => $employee,
                    'positions' => Position::all(),
                    'errors' => $validator->errors()
                ]);
            }

            $employee = Employee::find($data['id']);

            if ($employee) {
                $updateData = [
                    'last_name' => $data['last_name'],
                    'first_name' => $data['first_name'],
                    'middle_name' => $data['middle_name'],
                    'phone' => $data['phone'],
                    'login' => $data['login'],
                    'position_id' => $data['position_id']
                ];

                // Обновляем пароль только если он был указан
                if (!empty($data['password'])) {
                    $updateData['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
                }

                $employee->update($updateData);
                app()->route->redirect('/employees');
            } else {
                return '<h2 style="text-align:center; margin-top:50px;">Сотрудник не найден</h2>';
            }
        }

        return '';
    }

    public function deleteEmployee(Request $request): string
    {
        if (!$this->denyIfNotAdmin()) return '';  // Исправлено здесь

        if ($request->method === 'GET') {
            $id = $request->get('id');

            if (!$id) {
                return (new View())->render('site.employees_delete', [
                    'employees' => Employee::all(),
                    'employee' => null,
                    'positions' => Position::all()
                ]);
            }

            $employee = Employee::find($id);

            if (!$employee) {
                return '<h2 style="text-align:center; margin-top:50px;">Сотрудник не найден</h2>';
            }

            return (new View())->render('site.employees_delete', [
                'employees' => Employee::all(),
                'employee' => $employee,
                'positions' => Position::all()
            ]);
        }

        if ($request->method === 'POST') {
            $data = $request->all();

            $validator = new \Src\Validator\Validator($data, [
                'id' => ['required', 'numeric'],
            ]);

            if ($validator->fails()) {
                return (new View())->render('site.employees_delete', [
                    'employees' => Employee::all(),
                    'employee' => null,
                    'positions' => Position::all(),
                    'errors' => $validator->errors()
                ]);
            }

            $employee = Employee::find($data['id']);

            if ($employee) {
                try {
                    // Удаляем связанные записи расписания
                    \Illuminate\Database\Capsule\Manager::table('schedule')
                        ->where('employee_id', $employee->id)
                        ->delete();

                    $employee->delete();
                    app()->route->redirect('/employees');
                } catch (\Exception $e) {
                    return (new View())->render('site.employees_delete', [
                        'employees' => Employee::all(),
                        'employee' => $employee,
                        'positions' => Position::all(),
                        'errors' => ['general' => ['Ошибка при удалении: ' . $e->getMessage()]]
                    ]);
                }
            } else {
                return '<h2 style="text-align:center; margin-top:50px;">Сотрудник не найден</h2>';
            }
        }

        return '';
    }
}
