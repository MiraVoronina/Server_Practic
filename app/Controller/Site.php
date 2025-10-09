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
use Model\Position;

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
        app()->route->redirect('/');
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
            $data = $request->all();

            $validator = new \Src\Validator\Validator($data, [
                'date' => ['required'],
                'discipline_id' => ['required', 'numeric'],
                'classroom' => ['required', 'min:1'],
                'employee_id' => ['required', 'numeric'],
                'group_id' => ['required', 'numeric'],
            ]);

            if ($validator->fails()) {
                return (new View())->render('site.schedule_add', [
                    'errors' => $validator->errors(),
                    'old' => $data,
                    'disciplines' => Discipline::all(),
                    'employees' => Employee::all(),
                    'groups' => Group::all()
                ]);
            }

            Schedule::create($data);
            app()->route->redirect('/schedule');
        }

        return (new View())->render('site.schedule_add', [
            'disciplines' => Discipline::all(),
            'employees' => Employee::all(),
            'groups' => Group::all()
        ]);
    }

    public function editSchedule(Request $request): string
    {
        if (!$this->denyIfNotDeanery()) return '';

        if ($request->method === 'GET') {
            $id = $request->get('id');

            if (!$id) {
                return (new View())->render('site.schedule_edit', [
                    'schedule' => Schedule::all(),
                    'scheduleItem' => null,
                    'disciplines' => Discipline::all(),
                    'employees' => Employee::all(),
                    'groups' => Group::all()
                ]);
            }

            $scheduleItem = Schedule::find($id);

            if (!$scheduleItem) {
                return '<h2 style="text-align:center; margin-top:50px;">Расписание не найдено</h2>';
            }

            return (new View())->render('site.schedule_edit', [
                'schedule' => Schedule::all(),
                'scheduleItem' => $scheduleItem,
                'disciplines' => Discipline::all(),
                'employees' => Employee::all(),
                'groups' => Group::all()
            ]);
        }

        if ($request->method === 'POST') {
            $data = $request->all();

            $validator = new \Src\Validator\Validator($data, [
                'id' => ['required', 'numeric'],
                'date' => ['required'],
                'discipline_id' => ['required', 'numeric'],
                'classroom' => ['required', 'min:1'],
                'employee_id' => ['required', 'numeric'],
                'group_id' => ['required', 'numeric'],
            ]);

            if ($validator->fails()) {
                $scheduleItem = Schedule::find($data['id'] ?? null);
                return (new View())->render('site.schedule_edit', [
                    'schedule' => Schedule::all(),
                    'scheduleItem' => $scheduleItem,
                    'disciplines' => Discipline::all(),
                    'employees' => Employee::all(),
                    'groups' => Group::all(),
                    'errors' => $validator->errors()
                ]);
            }

            $scheduleItem = Schedule::find($data['id']);

            if ($scheduleItem) {
                $scheduleItem->update([
                    'date' => $data['date'],
                    'discipline_id' => $data['discipline_id'],
                    'classroom' => $data['classroom'],
                    'employee_id' => $data['employee_id'],
                    'group_id' => $data['group_id']
                ]);

                app()->route->redirect('/schedule');
            } else {
                return '<h2 style="text-align:center; margin-top:50px;">Расписание не найдено</h2>';
            }
        }

        return '';
    }

    public function deleteSchedule(Request $request): string
    {
        if (!$this->denyIfNotDeanery()) return '';

        if ($request->method === 'GET') {
            $id = $request->get('id');

            if (!$id) {
                return (new View())->render('site.schedule_delete', [
                    'schedule' => Schedule::all(),
                    'scheduleItem' => null,
                    'disciplines' => Discipline::all(),
                    'employees' => Employee::all(),
                    'groups' => Group::all()
                ]);
            }

            $scheduleItem = Schedule::find($id);

            if (!$scheduleItem) {
                return '<h2 style="text-align:center; margin-top:50px;">Расписание не найдено</h2>';
            }

            return (new View())->render('site.schedule_delete', [
                'schedule' => Schedule::all(),
                'scheduleItem' => $scheduleItem,
                'disciplines' => Discipline::all(),
                'employees' => Employee::all(),
                'groups' => Group::all()
            ]);
        }

        if ($request->method === 'POST') {
            $data = $request->all();

            $validator = new \Src\Validator\Validator($data, [
                'id' => ['required', 'numeric'],
            ]);

            if ($validator->fails()) {
                return (new View())->render('site.schedule_delete', [
                    'schedule' => Schedule::all(),
                    'scheduleItem' => null,
                    'disciplines' => Discipline::all(),
                    'employees' => Employee::all(),
                    'groups' => Group::all(),
                    'errors' => $validator->errors()
                ]);
            }

            $scheduleItem = Schedule::find($data['id']);

            if ($scheduleItem) {
                try {
                    // Удаляем связанные записи если есть
                    \Illuminate\Database\Capsule\Manager::table('attendance')
                        ->where('schedule_id', $scheduleItem->id)
                        ->delete();

                    $scheduleItem->delete();

                    app()->route->redirect('/schedule');
                } catch (\Exception $e) {
                    return (new View())->render('site.schedule_delete', [
                        'schedule' => Schedule::all(),
                        'scheduleItem' => $scheduleItem,
                        'disciplines' => Discipline::all(),
                        'employees' => Employee::all(),
                        'groups' => Group::all(),
                        'errors' => ['general' => ['Ошибка при удалении: ' . $e->getMessage()]]
                    ]);
                }
            } else {
                return '<h2 style="text-align:center; margin-top:50px;">Расписание не найдено</h2>';
            }
        }

        return '';
    }

    public function addStudent(Request $request): string
    {
        if ($request->method === 'POST') {
            $data = $request->all();

            $validator = new \Src\Validator\Validator($data, [
                'last_name' => ['required', 'min:2', 'max:100'],
                'first_name' => ['required', 'min:2', 'max:100'],
                'middle_name' => ['required', 'min:2', 'max:100'],
                'group_id' => ['required', 'numeric'],
                'address' => ['required', 'min:5'],
                'status' => ['required'],
            ]);

            if ($validator->fails()) {
                return (new View())->render('site.students_add', [
                    'errors' => $validator->errors(),
                    'old' => $data,
                    'groups' => Group::all()
                ]);
            }

            Student::create($data);
            app()->route->redirect('/students');
        }

        return (new View())->render('site.students_add', [
            'groups' => Group::all()
        ]);
    }

    public function editStudent(Request $request): string
    {
        if (!$this->denyIfNotDeanery()) return '';

        if ($request->method === 'GET') {
            $id = $request->get('id');

            if (!$id) {
                return (new View())->render('site.students_edit', [
                    'students' => Student::all(),
                    'student' => null,
                    'groups' => Group::all()
                ]);
            }

            $student = Student::find($id);

            if (!$student) {
                return '<h2 style="text-align:center; margin-top:50px;">Студент не найден</h2>';
            }

            return (new View())->render('site.students_edit', [
                'students' => Student::all(),
                'student' => $student,
                'groups' => Group::all()
            ]);
        }

        if ($request->method === 'POST') {
            $data = $request->all();

            $validator = new \Src\Validator\Validator($data, [
                'id' => ['required', 'numeric'],
                'last_name' => ['required', 'min:2', 'max:100'],
                'first_name' => ['required', 'min:2', 'max:100'],
                'middle_name' => ['required', 'min:2', 'max:100'],
                'group_id' => ['required', 'numeric'],
                'address' => ['required', 'min:5'],
                'status' => ['required'],
            ]);

            if ($validator->fails()) {
                $student = Student::find($data['id'] ?? null);
                return (new View())->render('site.students_edit', [
                    'students' => Student::all(),
                    'student' => $student,
                    'groups' => Group::all(),
                    'errors' => $validator->errors()
                ]);
            }

            $student = Student::find($data['id']);

            if ($student) {
                $student->update([
                    'last_name' => $data['last_name'],
                    'first_name' => $data['first_name'],
                    'middle_name' => $data['middle_name'],
                    'address' => $data['address'],
                    'group_id' => $data['group_id'],
                    'status' => $data['status']
                ]);

                app()->route->redirect('/students');
            } else {
                return '<h2 style="text-align:center; margin-top:50px;">Студент не найден</h2>';
            }
        }

        return '';
    }

    public function deleteStudent(Request $request): string
    {
        if (!$this->denyIfNotDeanery()) return '';

        if ($request->method === 'GET') {
            $id = $request->get('id');

            if (!$id) {
                return (new View())->render('site.students_delete', [
                    'students' => Student::all(),
                    'student' => null
                ]);
            }

            $student = Student::find($id);

            if (!$student) {
                return '<h2 style="text-align:center; margin-top:50px;">Студент не найден</h2>';
            }

            return (new View())->render('site.students_delete', [
                'students' => Student::all(),
                'student' => $student
            ]);
        }

        if ($request->method === 'POST') {
            $data = $request->all();

            $validator = new \Src\Validator\Validator($data, [
                'id' => ['required', 'numeric'],
            ]);

            if ($validator->fails()) {
                return (new View())->render('site.students_delete', [
                    'students' => Student::all(),
                    'student' => null,
                    'errors' => $validator->errors()
                ]);
            }

            $student = Student::find($data['id']);

            if ($student) {
                try {
                    \Illuminate\Database\Capsule\Manager::table('attendance')
                        ->where('student_id', $student->id)
                        ->delete();

                    \Illuminate\Database\Capsule\Manager::table('performance')
                        ->where('student_id', $student->id)
                        ->delete();

                    $student->delete();

                    app()->route->redirect('/students');
                } catch (\Exception $e) {
                    return (new View())->render('site.students_delete', [
                        'students' => Student::all(),
                        'student' => $student,
                        'errors' => ['general' => ['Ошибка при удалении: ' . $e->getMessage()]]
                    ]);
                }
            } else {
                return '<h2 style="text-align:center; margin-top:50px;">Студент не найден</h2>';
            }
        }

        return '';
    }

    public function addGrade(Request $request): string
    {
        if (!$this->denyIfNotDeanery()) return '';

        if ($request->method === 'POST') {
            $data = $request->all();

            $validator = new \Src\Validator\Validator($data, [
                'schedule_id' => ['required', 'numeric'],
                'student_id' => ['required', 'numeric'],
                'type' => ['required'],
                'grade' => ['required', 'numeric'],
                'hours' => ['required', 'numeric'],
            ]);

            if ($validator->fails()) {
                return (new View())->render('site.grades_add', [
                    'errors' => $validator->errors(),
                    'old' => $data,
                    'schedule' => Schedule::all(),
                    'students' => Student::all()
                ]);
            }

            Performance::create($data);
            app()->route->redirect('/grades');
        }

        return (new View())->render('site.grades_add', [
            'schedule' => Schedule::all(),
            'students' => Student::all()
        ]);
    }

    public function editGrade(Request $request): string
    {
        if (!$this->denyIfNotDeanery()) return '';

        if ($request->method === 'GET') {
            $id = $request->get('id');

            if (!$id) {
                return (new View())->render('site.grades_edit', [
                    'grades' => Performance::all(),
                    'gradeItem' => null,
                    'schedule' => Schedule::all(),
                    'students' => Student::all()
                ]);
            }

            $gradeItem = Performance::find($id);

            if (!$gradeItem) {
                return '<h2 style="text-align:center; margin-top:50px;">Оценка не найдена</h2>';
            }

            return (new View())->render('site.grades_edit', [
                'grades' => Performance::all(),
                'gradeItem' => $gradeItem,
                'schedule' => Schedule::all(),
                'students' => Student::all()
            ]);
        }

        if ($request->method === 'POST') {
            $data = $request->all();

            $validator = new \Src\Validator\Validator($data, [
                'id' => ['required', 'numeric'],
                'schedule_id' => ['required', 'numeric'],
                'student_id' => ['required', 'numeric'],
                'type' => ['required'],
                'grade' => ['required', 'numeric'],
                'hours' => ['required', 'numeric'],
            ]);

            if ($validator->fails()) {
                $gradeItem = Performance::find($data['id'] ?? null);
                return (new View())->render('site.grades_edit', [
                    'grades' => Performance::all(),
                    'gradeItem' => $gradeItem,
                    'schedule' => Schedule::all(),
                    'students' => Student::all(),
                    'errors' => $validator->errors()
                ]);
            }

            $gradeItem = Performance::find($data['id']);

            if ($gradeItem) {
                $gradeItem->update([
                    'schedule_id' => $data['schedule_id'],
                    'student_id' => $data['student_id'],
                    'type' => $data['type'],
                    'grade' => $data['grade'],
                    'hours' => $data['hours']
                ]);

                app()->route->redirect('/grades');
            } else {
                return '<h2 style="text-align:center; margin-top:50px;">Оценка не найдена</h2>';
            }
        }

        return '';
    }

    public function deleteGrade(Request $request): string
    {
        if (!$this->denyIfNotDeanery()) return '';

        if ($request->method === 'GET') {
            $id = $request->get('id');

            if (!$id) {
                return (new View())->render('site.grades_delete', [
                    'grades' => Performance::all(),
                    'gradeItem' => null,
                    'schedule' => Schedule::all(),
                    'students' => Student::all()
                ]);
            }

            $gradeItem = Performance::find($id);

            if (!$gradeItem) {
                return '<h2 style="text-align:center; margin-top:50px;">Оценка не найдена</h2>';
            }

            return (new View())->render('site.grades_delete', [
                'grades' => Performance::all(),
                'gradeItem' => $gradeItem,
                'schedule' => Schedule::all(),
                'students' => Student::all()
            ]);
        }

        if ($request->method === 'POST') {
            $data = $request->all();

            $validator = new \Src\Validator\Validator($data, [
                'id' => ['required', 'numeric'],
            ]);

            if ($validator->fails()) {
                return (new View())->render('site.grades_delete', [
                    'grades' => Performance::all(),
                    'gradeItem' => null,
                    'schedule' => Schedule::all(),
                    'students' => Student::all(),
                    'errors' => $validator->errors()
                ]);
            }

            $gradeItem = Performance::find($data['id']);

            if ($gradeItem) {
                try {
                    $gradeItem->delete();
                    app()->route->redirect('/grades');
                } catch (\Exception $e) {
                    return (new View())->render('site.grades_delete', [
                        'grades' => Performance::all(),
                        'gradeItem' => $gradeItem,
                        'schedule' => Schedule::all(),
                        'students' => Student::all(),
                        'errors' => ['general' => ['Ошибка при удалении: ' . $e->getMessage()]]
                    ]);
                }
            } else {
                return '<h2 style="text-align:center; margin-top:50px;">Оценка не найдена</h2>';
            }
        }

        return '';
    }


}
