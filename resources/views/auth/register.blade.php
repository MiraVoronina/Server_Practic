<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация - Service center</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
<div class="auth-wrapper">
    <div class="auth-box">
        <a href="/" class="back-home">← Вернуться на главную</a>

        <div class="logo-text">Service center</div>
        <h1 class="auth-heading">Регистрация</h1>

        @if($errors->any())
            <div class="error-message">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="auth-form">
            @csrf

            <div class="input-group">
                <label for="login" class="input-label">Логин</label>
                <input type="text" id="login" name="login" class="input-field" value="{{ old('login') }}" required autofocus>
            </div>

            <div class="form-row-group">
                <div class="input-group">
                    <label for="password" class="input-label">Пароль</label>
                    <input type="password" id="password" name="password" class="input-field" required>
                </div>

                <div class="input-group">
                    <label for="password_confirmation" class="input-label">Повторите пароль</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="input-field" required>
                </div>
            </div>

            <div class="form-row-group">
                <div class="input-group">
                    <label for="name" class="input-label">Имя</label>
                    <input type="text" id="name" name="name" class="input-field" value="{{ old('name') }}" required>
                </div>

                <div class="input-group">
                    <label for="surname" class="input-label">Фамилия</label>
                    <input type="text" id="surname" name="surname" class="input-field" value="{{ old('surname') }}" required>
                </div>
            </div>

            <div class="input-group">
                <label for="email" class="input-label">Email</label>
                <input type="email" id="email" name="email" class="input-field" value="{{ old('email') }}" required>
            </div>

            <div class="input-group">
                <label for="phone" class="input-label">Телефон</label>
                <input type="tel" id="phone" name="phone" class="input-field" value="{{ old('phone') }}" required>
            </div>

            <button type="submit" class="btn-auth">Зарегистрироваться</button>
        </form>

        <div class="auth-link-section">
            <p>Уже есть аккаунт? <a href="/login">Войти</a></p>
        </div>
    </div>
</div>
</body>
</html>
