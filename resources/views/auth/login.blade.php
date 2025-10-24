<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход - Service center</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
@if(session('error'))
    <div style="background: #f8d7da; color: #721c24; padding: 15px; margin: 20px; border-radius: 5px;">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div style="background: #d4edda; color: #155724; padding: 15px; margin: 20px; border-radius: 5px;">
        {{ session('success') }}
    </div>
@endif

@if($errors->has('throttle'))
    <div style="background: #f8d7da; color: #721c24; padding: 15px; margin: 20px; border-radius: 5px;">
        {{ $errors->first('throttle') }}
    </div>
@endif

<div class="auth-wrapper">
    <div class="auth-box">
        <a href="/" class="back-home">← Вернуться на главную</a>

        <div class="logo-text">Service center</div>
        <h1 class="auth-heading">Вход в систему</h1>

        @if($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="auth-form">
            @csrf

            <div class="input-group">
                <label for="login" class="input-label">Логин</label>
                <input type="text" id="login" name="login" class="input-field" value="{{ old('login') }}" required autofocus>
            </div>

            <div class="input-group">
                <label for="password" class="input-label">Пароль</label>
                <input type="password" id="password" name="password" class="input-field" required>
            </div>

            <button type="submit" class="btn-auth">Войти</button>
        </form>

        <div class="auth-link-section">
            <p>Нет аккаунта? <a href="/register">Зарегистрироваться</a></p>
        </div>
    </div>
</div>
</body>
</html>
