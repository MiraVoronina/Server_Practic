<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'login' => [
                'required',
                'unique:users,Login',
                'min:3',
                'max:50',
                'regex:/^[a-zA-Z0-9_]+$/'
            ],
            'password' => [
                'required',
                'min:6',
                'max:8',
                'confirmed',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d)[A-Za-z\d]{6,8}$/'
            ],
            'name' => [
                'required',
                'min:2',
                'max:100',
                'regex:/^[а-яА-ЯёЁa-zA-Z\s-]+$/u'
            ],
            'surname' => [
                'required',
                'min:2',
                'max:100',
                'regex:/^[а-яА-ЯёЁa-zA-Z\s-]+$/u'
            ],
            'email' => [
                'required',
                'email',
                'unique:user_info,Email',
                'max:255'
            ],
            'phone' => [
                'required',
                'digits:11',
                'regex:/^[78]\d{10}$/',
            ],
        ], [
            'login.required' => 'Логин обязателен для заполнения',
            'login.unique' => 'Такой логин уже занят',
            'login.min' => 'Логин должен содержать минимум 3 символа',
            'login.regex' => 'Логин может содержать только латинские буквы, цифры и подчеркивание',

            'password.required' => 'Пароль обязателен для заполнения',
            'password.min' => 'Пароль должен содержать минимум 6 символов',
            'password.max' => 'Пароль должен содержать максимум 8 символов',
            'password.confirmed' => 'Пароли не совпадают',
            'password.regex' => 'Пароль должен содержать буквы и цифры (от 6 до 8 символов)',

            'name.required' => 'Имя обязательно для заполнения',
            'name.min' => 'Имя должно содержать минимум 2 символа',
            'name.regex' => 'Имя может содержать только буквы, пробелы и дефисы',

            'surname.required' => 'Фамилия обязательна для заполнения',
            'surname.min' => 'Фамилия должна содержать минимум 2 символа',
            'surname.regex' => 'Фамилия может содержать только буквы, пробелы и дефисы',

            'email.required' => 'Email обязателен для заполнения',
            'email.email' => 'Введите корректный email',
            'email.unique' => 'Этот email уже используется',

            'phone.required' => 'Телефон обязателен для заполнения',
            'phone.digits' => 'Телефон должен содержать ровно 11 цифр',
            'phone.regex' => 'Телефон должен начинаться с 7 или 8 и содержать 11 цифр (например: 89991234567)',
        ]);

        $user = new User();
        $user->ID_User_Role = 2;
        $user->Login = $request->login;
        $user->Password = Hash::make($request->password);
        $user->save();

        $userInfo = new UserInfo();
        $userInfo->ID_User = $user->ID_User;
        $userInfo->Name = $request->name;
        $userInfo->Surname = $request->surname;
        $userInfo->Email = $request->email;
        $userInfo->Phone_Number = $request->phone;
        $userInfo->save();

        Auth::login($user);

        return redirect('/')->with('success', 'Регистрация прошла успешно!');
    }
}
