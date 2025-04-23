<?php

namespace App\Controller;

use Model\Post;
use Src\View;
use Model\User;
use Src\Auth\Auth;


class Site
{
    public function index(): string
    {
        $posts = Post::all();
        return (new View())->render('site.post', ['posts' => $posts]);
    }

    public function hello(): string
    {
        return new View('site.hello', ['message' => 'hello working']);
    }
    public function signup(Request $request): string
    {
        if ($request->method==='POST' && User::create($request->all())){
            return new View('site.signup', ['message'=>'Вы успешно зарегистрированы']);
        }
        return new View('site.signup');
    }
    public function login(Request $request): string
    {
        //Если просто обращение к странице, то отобразить форму
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        //Если удалось аутентифицировать пользователя, то редирект
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/hello');
        }
        //Если аутентификация не удалась, то сообщение об ошибке
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/hello');
    }
    public function students(): void
    {
        $students = \Model\Student::all();
        (new \Src\View('site', 'students', ['students' => $students]))->render();
    }
    public function disciplines(): void
    {
        $disciplines = \Model\Discipline::all();
        (new \Src\View('site', 'disciplines', ['disciplines' => $disciplines]))->render();
    }
    public function schedule(): void
    {
        $schedule = \Model\Schedule::all();
        (new \Src\View('site', 'schedule', ['schedule' => $schedule]))->render();
    }
    public function report(): void
    {
        $attendance = \Model\Attendance::all();
        $performance = \Model\Performance::all();
        (new \Src\View('site', 'report', [
            'attendance' => $attendance,
            'performance' => $performance
        ]))->render();
    }

}
