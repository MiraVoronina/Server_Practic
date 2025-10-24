<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель управления - Service Center</title>
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
                <li><a href="/#about" class="nav-link">О нас</a></li>
                <li><a href="/#services" class="nav-link">Услуги</a></li>
                <li><a href="/#contacts" class="nav-link">Контакты</a></li>
                @auth
                    <li><a href="{{ route('orders.index') }}" class="nav-link">
                            @if(Auth::user()->ID_User_Role == 1)
                                Заказы
                            @else
                                Мои заказы
                            @endif
                        </a></li>
                    @if(Auth::user()->ID_User_Role == 1)
                        <li><a href="{{ route('admin.dashboard') }}" class="nav-link active">Админ-панель</a></li>
                    @endif
                    <li>
                        <span class="user-badge {{ Auth::user()->ID_User_Role == 1 ? 'admin-badge' : 'client-badge' }}">
                            {{ Auth::user()->Login }}
                        </span>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" class="nav-link">Выход</a>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}" class="nav-link">Вход</a></li>
                    <li><a href="{{ route('register') }}" class="nav-link">Регистрация</a></li>
                @endauth
            </ul>
        </div>
    </nav>
</header>

<div class="admin-section">
    <div class="admin-container">
        <h1 class="admin-title">Панель управления</h1>

        @if(session('success'))
            <div class="alert alert-success" style="padding: 15px; background: #d4edda; color: #155724; border-radius: 4px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="stats-grid">
            <div class="stat-card stat-total">
                <div class="stat-content">
                    <h3>{{ $totalOrders }}</h3>
                    <p>Всего заказов</p>
                </div>
            </div>

            <div class="stat-card stat-new">
                <div class="stat-content">
                    <h3>{{ $newOrders }}</h3>
                    <p>Новые заказы</p>
                </div>
            </div>

            <div class="stat-card stat-progress">
                <div class="stat-content">
                    <h3>{{ $inProgressOrders }}</h3>
                    <p>В работе</p>
                </div>
            </div>

            <div class="stat-card stat-completed">
                <div class="stat-content">
                    <h3>{{ $completedOrders }}</h3>
                    <p>Завершено</p>
                </div>
            </div>

            <div class="stat-card stat-users">
                <div class="stat-content">
                    <h3>{{ $totalUsers }}</h3>
                    <p>Пользователей</p>
                </div>
            </div>
        </div>

        <div class="section-card">
            <div class="section-header">
                <h2 class="section-title">Последние заказы</h2>
            </div>
            <div class="section-body">
                @if($recentOrders->isEmpty())
                    <div class="empty-state">Заказов пока нет</div>
                @else
                    <div class="table-wrapper">
                        <table class="orders-table">
                            <thead>
                            <tr>
                                <th>№</th>
                                <th>Клиент</th>
                                <th>Оборудование</th>
                                <th>Статус</th>
                                <th>Дата</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($recentOrders as $order)
                                <tr>
                                    <td><strong>{{ $order->ID_Order }}</strong></td>
                                    <td>{{ $order->user->Login ?? $order->Guest_Name ?? 'Неизвестен' }}</td>
                                    <td>{{ $order->equipment->Equipment_Name ?? 'Не указано' }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('admin.orders.updateStatus', $order->ID_Order) }}" style="display: inline;">
                                            @csrf
                                            <select name="status" onchange="this.form.submit()" style="padding: 5px 10px; border-radius: 4px; border: 1px solid #ddd; background: white; cursor: pointer;">
                                                @foreach($statuses as $status)
                                                    <option value="{{ $status->ID_Status }}"
                                                        {{ $order->ID_Status == $status->ID_Status ? 'selected' : '' }}>
                                                        {{ $status->Order_Status_Name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </form>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($order->Created_at)->format('d.m.Y H:i') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <div class="section-card">
            <div class="section-header">
                <h2 class="section-title">Статистика по статусам</h2>
            </div>
            <div class="section-body">
                @if($ordersByStatus->isEmpty())
                    <div class="empty-state">Данных пока нет</div>
                @else
                    <div class="status-stats">
                        @foreach($ordersByStatus as $status)
                            <div class="status-stat-item">
                                <div class="status-stat-bar" style="width: {{ ($status->orders_count / $totalOrders) * 100 }}%"></div>
                                <div class="status-stat-info">
                                    <span class="status-stat-name">{{ $status->Order_Status_Name }}</span>
                                    <span class="status-stat-count">{{ $status->orders_count }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <div class="section-card">
            <div class="section-header">
                <h2 class="section-title">Быстрые действия</h2>
            </div>
            <div class="section-body">
                <div class="actions-grid">
                    <a href="{{ route('admin.users') }}" class="action-card">
                        <h3>Управление пользователями</h3>
                        <p>Просмотр и редактирование пользователей</p>
                    </a>

                    <a href="{{ route('orders.index') }}" class="action-card">
                        <h3>Все заказы</h3>
                        <p>Просмотр всех заказов в системе</p>
                    </a>

                    <a href="{{ route('admin.orders.create') }}" class="action-card">
                        <h3>Создать заказ</h3>
                        <p>Добавить новый заказ для клиента</p>
                    </a>
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
