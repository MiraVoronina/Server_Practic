<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@if(Auth::user()->ID_User_Role == 1) Все заказы @else Мои заказы @endif - Service center</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/orders.css">
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
                <li>
                    <a href="/orders" class="nav-link active">
                        @if(Auth::user()->ID_User_Role == 1)
                            Заказы
                        @else
                            Мои заказы
                        @endif
                    </a>
                </li>
                @if(Auth::user()->ID_User_Role == 1)
                    <li><a href="{{ route('admin.dashboard') }}" class="nav-link">Админ-панель</a></li>
                @endif
                @auth
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
                @endauth
            </ul>
        </div>
    </nav>
</header>

<section class="orders-section">
    <div class="container">
        <div class="orders-header">
            <h1 class="page-title">
                @if(Auth::user()->ID_User_Role == 1)
                    Все заказы
                @else
                    Мои заказы
                @endif
            </h1>
            @if(Auth::user()->ID_User_Role == 2)
                <a href="{{ route('orders.create') }}" class="btn-create">+ Создать заказ</a>
            @elseif(Auth::user()->ID_User_Role == 1)
                <a href="{{ route('admin.orders.create') }}" class="btn-create">+ Создать заказ</a>
            @endif
        </div>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <div class="filter-panel">
            <form method="GET" action="{{ route('orders.index') }}" class="filter-form">
                <div class="filter-row">
                    <div class="filter-group">
                        <label class="filter-label">Поиск</label>
                        <input type="text" name="search" class="filter-input"
                               placeholder="Номер заказа или трекинг"
                               value="{{ request('search') }}">
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">Статус</label>
                        <select name="status" class="filter-select">
                            <option value="">Все статусы</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status->ID_Status }}"
                                    {{ request('status') == $status->ID_Status ? 'selected' : '' }}>
                                    {{ $status->Order_Status_Name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-group">
                        <label class="filter-label">Сортировка</label>
                        <select name="sort" class="filter-select">
                            <option value="date_asc" {{ request('sort', 'date_asc') == 'date_asc' ? 'selected' : '' }}>От старых к новым</option>
                            <option value="date_desc" {{ request('sort') == 'date_desc' ? 'selected' : '' }}>От новых к старым</option>
                        </select>
                    </div>

                    <div class="filter-actions">
                        <button type="submit" class="btn-filter">Применить</button>
                        @if(request()->hasAny(['search', 'status', 'sort']))
                            <a href="{{ route('orders.index') }}" class="btn-reset">Сбросить</a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        @if($orders->isEmpty())
            <div class="empty-state">
                <p>@if(Auth::user()->ID_User_Role == 1) Заказов пока нет @else У вас пока нет заказов @endif</p>
                @if(Auth::user()->ID_User_Role == 2)
                    <a href="{{ route('orders.create') }}" class="btn-create">Создать первый заказ</a>
                @elseif(Auth::user()->ID_User_Role == 1)
                    <a href="{{ route('admin.orders.create') }}" class="btn-create">Создать первый заказ</a>
                @endif
            </div>
        @else
            <div class="orders-grid">
                @foreach($orders as $order)
                    <div class="order-card">
                        <div class="order-header">
                            <h3 class="order-number">
                                @if(Auth::user()->ID_User_Role == 1)
                                    Заказ №{{ $order->ID_Order }}
                                @else
                                    Заказ №{{ $order->Order_Number }}
                                @endif
                            </h3>
                            <span class="order-status status-{{ $order->ID_Status ?? '0' }}">
                                {{ $order->status->Order_Status_Name ?? 'Неизвестен' }}
                            </span>
                        </div>

                        <div class="order-body">
                            @if(Auth::user()->ID_User_Role == 1)
                                <div class="order-info">
                                    <div class="info-label">Клиент:</div>
                                    <div class="info-value">
                                        @if($order->ID_User)
                                            {{ $order->user->Login ?? 'Неизвестен' }}
                                        @else
                                            <span style="color: #5BB543; font-weight: 600;">{{ $order->Guest_Name }}</span>
                                            <small style="display: block; color: #868686; font-size: 13px; margin-top: 4px;">
                                                📞 {{ $order->Guest_Phone }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <div class="order-info">
                                <div class="info-label">Номер отслеживания:</div>
                                <div class="info-value">{{ $order->Tracking_Number }}</div>
                            </div>

                            <div class="order-info">
                                <div class="info-label">Оборудование:</div>
                                <div class="info-value">{{ $order->equipment->Equipment_Name ?? 'Не указано' }}</div>
                            </div>

                            <div class="order-info">
                                <div class="info-label">Тип поломки:</div>
                                <div class="info-value">{{ $order->breakdown->Name_of_Breakdown ?? 'Не указан' }}</div>
                            </div>

                            <div class="order-info">
                                <div class="info-label">Дата создания:</div>
                                <div class="info-value">{{ $order->Created_at ? $order->Created_at->format('d.m.Y H:i') : 'Не указана' }}</div>
                            </div>

                            <div class="order-info">
                                <div class="info-label">Описание:</div>
                                <div class="info-value">{{ Str::limit($order->Description, 50) }}</div>
                            </div>
                        </div>

                        <div class="order-footer">
                            <a href="{{ route('orders.show', $order->ID_Order) }}" class="btn-view">Подробнее</a>
                            <form method="POST" action="{{ route('orders.destroy', $order->ID_Order) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete-small" onclick="return confirm('Вы уверены?')">Удалить</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>

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
