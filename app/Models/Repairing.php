<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    // Обработка входа
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('Login', $request->login)->first();

        if ($user && Hash::check($request->password, $user->Password)) {
            Auth::login($user);

            if ($user->ID_User_Role == 1) {
                return redirect('/admin/orders'); // Админ
            }
            return redirect('/'); // Клиент
        }

        return back()->withErrors(['login' => 'Неверный логин или пароль']);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'login' => 'required|unique:Users,Login|min:3',
            'password' => 'required|min:3|confirmed',
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:User_Info,Email',
            'phone' => 'required',
        ]);

        $user = User::create([
            'ID_User_Role' => 2, // Клиент
            'Login' => $request->login,
            'Password' => Hash::make($request->password),
        ]);


        UserInfo::create([
            'ID_User' => $user->ID_User,
            'Name' => $request->name,
            'Surname' => $request->surname,
            'Email' => $request->email,
            'Phone_Number' => $request->phone,
        ]);

        Auth::login($user);

        return redirect('/')->with('success', 'Регистрация успешна!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
