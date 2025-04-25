<?php

namespace Controller;

use Src\View;
use Src\Request;
use Src\Auth\Auth;

class Site
{
    public function index(Request $request): string
    {
        return (new View())->render('site.index');
    }

    public function login(Request $request): string
    {
        if ($request->method === 'GET') {
            return (new View())->render('site.login');
        }

        if (Auth::attempt($request->all())) {
            app()->route->redirect('/hello');
        }

        return (new View())->render('site.login', ['message' => 'Неверный логин или пароль']);
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
        app()->route->redirect('/login');
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
        return (new View())->render('site.students');
    }

    public function schedule(Request $request): string
    {
        return (new View())->render('site.schedule');
    }

    public function grades(Request $request): string
    {
        return (new View())->render('site.grades');
    }
}
