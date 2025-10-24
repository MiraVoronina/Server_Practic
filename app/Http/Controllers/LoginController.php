<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $ip = $request->ip();
        $attemptKey = 'login_attempts_' . $ip;
        $timeKey = 'login_blocked_until_' . $ip;

        if (session()->has($timeKey)) {
            $blockedUntil = session($timeKey);
            if (time() < $blockedUntil) {
                $seconds = $blockedUntil - time();
                return back()->withErrors([
                    'throttle' => "Слишком много попыток входа. Пожалуйста, попробуйте через $seconds секунд."
                ])->withInput($request->only('login'));
            } else {
                session()->forget([$attemptKey, $timeKey]);
            }
        }

        $request->validate([
            'login' => 'required|min:3|max:50|regex:/^[a-zA-Z0-9_]+$/',
            'password' => 'required|min:6',
        ], [
            'login.required' => 'Логин обязателен для заполнения',
            'login.min' => 'Логин должен содержать минимум 3 символа',
            'login.regex' => 'Логин может содержать только латинские буквы, цифры и подчеркивание',
            'password.required' => 'Пароль обязателен для заполнения',
            'password.min' => 'Пароль должен содержать минимум 6 символов',
        ]);

        $user = User::where('Login', $request->login)->first();

        if ($user && Hash::check($request->password, $user->Password)) {
            session()->forget([$attemptKey, $timeKey]);
            Auth::login($user);
            return redirect('/')->with('success', 'Вы успешно вошли!');
        }

        $attempts = session($attemptKey, 0) + 1;
        session()->put($attemptKey, $attempts);

        if ($attempts >= 5) {
            $blockTime = time() + 60;
            session()->put($timeKey, $blockTime);
            return back()->withErrors([
                'throttle' => "Слишком много попыток входа. Пожалуйста, попробуйте через 60 секунд."
            ])->withInput($request->only('login'));
        }

        return back()->withErrors(['login' => 'Неверный логин или пароль'])->withInput($request->only('login'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Вы вышли из системы');
    }
}
