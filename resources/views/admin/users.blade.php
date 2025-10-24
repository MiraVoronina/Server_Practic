<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление пользователями - Service Center</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
<header class="top-header">
    <div class="contact-info-top">
        <div class="contact-group">
            <div class="email">info@Servicecenter.com</div>
            <div class="address">г. Томск, ул. Герцена, 18</div>
            <div class="divider"></div>
        </div>
        <div class="phone-number">+7 (900) 123-45-67</div>
    </div>
    <nav class="main-nav">
        <div class="nav-content">
            <div class="brand">Service center</div>
            <ul class="nav-links">
                <li><a href="/" class="nav-link">Главная</a></li>
                <li><a href="{{ route('orders.index') }}" class="nav-link">Заказы</a></li>
                <li><a href="{{ route('admin.dashboard') }}" class="nav-link">Админ-панель</a></li>
                <li>
                    <span class="user-badge admin-badge">{{ Auth::user()->Login }}</span>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" class="nav-link">Выход</a>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
</header>

<div class="admin-section">
    <div class="admin-container">
        <div class="page-header-admin">
            <h1 class="admin-title">Управление пользователями</h1>
            <a href="{{ route('admin.dashboard') }}" class="btn-back">← Назад</a>
        </div>

        <div class="section-card">
            <div class="section-body">
                <div class="table-wrapper">
                    <table class="users-table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Логин</th>
                            <th>ФИО</th>
                            <th>Телефон</th>
                            <th>Email</th>
                            <th>Заказов</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td><strong>{{ $user->ID_User }}</strong></td>
                                <td>{{ $user->Login }}</td>
                                <td>{{ $user->userInfo->Full_name ?? 'Не указано' }}</td>
                                <td>{{ $user->userInfo->Phone ?? 'Не указан' }}</td>
                                <td>{{ $user->userInfo->Email ?? 'Не указан' }}</td>
                                <td><span class="count-badge">{{ $user->orders_count }}</span></td>
                                <td>
                                    <a href="{{ route('orders.index', ['user' => $user->ID_User]) }}" class="btn-action">Заказы</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="site-footer">
    <div class="footer-content">
        <div class="footer-brand">
            <h2 class="footer-logo">Service center</h2>
            <p class="footer-tagline">Решаем любые проблемы с вашим компьютером быстро и надежно</p>
        </div>
        <div class="footer-contact">
            <h3 class="footer-title">Связаться с нами</h3>
            <ul class="footer-list">
                <li>г. Томск, ул. Герцена, 18</li>
                <li>+7 (900) 123-45-67</li>
                <li>info@Servicecenter.com</li>
            </ul>
        </div>
    </div>
</footer>
</body>
</html>
