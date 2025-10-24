<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Услуги - Service Center</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/services_page.css') }}">
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
                <li><a href="/about" class="nav-link">О нас</a></li>
                <li><a href="/services" class="nav-link active">Услуги</a></li>
                <li><a href="/contacts" class="nav-link">Контакты</a></li>
                @auth
                    <li><a href="{{ route('orders.index') }}" class="nav-link">
                            @if(Auth::user()->ID_User_Role == 1)
                                Заказы
                            @else
                                Мои заказы
                            @endif
                        </a></li>
                    @if(Auth::user()->ID_User_Role == 1)
                        <li><a href="{{ route('admin.dashboard') }}" class="nav-link">Админ-панель</a></li>
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

<section class="services-hero">
    <div class="container">
        <h1 class="hero-title">Комплексные Услуги для Ваших Потребностей</h1>
        <p class="hero-description">
            Мы предлагаем широкий спектр профессиональных услуг для решения любых технических задач.
        </p>
    </div>
</section>

<section class="services-list">
    <div class="container">
        <div class="services-grid">
            <div class="service-item">
                <h3>Диагностика и ремонт настольных компьютеров</h3>
                <ul>
                    <li>Диагностика и устранение неисправностей комплектующих</li>
                    <li>Восстановление работоспособности после сбоя или вируса</li>
                    <li>Замена вышедших из строя деталей</li>
                </ul>
            </div>

            <div class="service-item">
                <h3>Диагностика и ремонт ноутбуков</h3>
                <ul>
                    <li>Определение и решение проблем с материнской платой, дисплеем</li>
                    <li>Восстановление работы аккумулятора и системы охлаждения</li>
                </ul>
            </div>

            <div class="service-item">
                <h3>Установка и настройка программного обеспечения</h3>
                <ul>
                    <li>Извлечение данных с физически поврежденных накопителей</li>
                    <li>Восстановление файлов после форматирования или удаления</li>
                </ul>
            </div>

            <div class="service-item">
                <h3>Восстановление данных с жестких дисков и SSD</h3>
                <ul>
                    <li>Извлечение важных данных с жестких дисков и накопителей SSD</li>
                    <li>Восстановление файлов после форматирования или вирусной атаки</li>
                </ul>
            </div>

            <div class="service-item">
                <h3>Чистка и профилактическое обслуживание компьютеров</h3>
                <ul>
                    <li>Очистка от пыли и загрязнений внутренних компонентов</li>
                    <li>Оптимизация работы системы охлаждения</li>
                </ul>
            </div>

            <div class="service-item">
                <h3>Модернизация и апгрейд оборудования</h3>
                <ul>
                    <li>Установка более мощных процессоров, оперативной памяти, SSD</li>
                    <li>Замена видеокарт, блоков питания, корпусов</li>
                </ul>
            </div>
        </div>
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
