<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8" />
    <title>Service Center</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css?family=Manrope:400,600,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=DM+Sans:400,700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/servisces_page.css') }}">
    <link rel="stylesheet" href="{{ asset('css/service-center.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aboutus.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contacts.css') }}">

    @stack('styles')
</head>
<body>

<header class="top-header">
    <div class="contact-info-top">
        <div class="contact-group">
            <div class="email">info@Servicecenter.com</div>
            <div class="address">123 Main St. Tomsk, Russia</div>
            <div class="divider"></div>
        </div>
        <div class="phone-number">+1 (555) 555-5555</div>
    </div>
    <nav class="main-nav">
        <div class="nav-content">
            <div class="brand">Service center</div>
            <ul class="nav-links">
                <li><a href="{{ url('/') }}" class="nav-link {{ Request::is('/') ? 'active' : '' }}">Главная</a></li>
                <li><a href="{{ url('/aboutus') }}" class="nav-link {{ Request::is('aboutus') ? 'active' : '' }}">О нас</a></li>
                <li><a href="{{ url('/services') }}" class="nav-link {{ Request::is('services') ? 'active' : '' }}">Услуги</a></li>
                <li><a href="{{ url('/service-center') }}" class="nav-link {{ Request::is('service-center') ? 'active' : '' }}">Консультация</a></li>
                <li><a href="{{ url('/contacts') }}" class="nav-link {{ Request::is('contacts') ? 'active' : '' }}">Контакты</a></li>
            </ul>
        </div>
    </nav>
</header>

<main>
    @yield('content')
</main>

<footer class="site-footer">
    <div class="footer-content">
        <div class="footer-brand">
            <h2 class="footer-logo">Service center</h2>
            <p class="footer-tagline">Решаем любые проблемы с вашим компьютером быстро и надежно</p>
        </div>
        <div class="footer-contact">
            <h3 class="footer-title">Связаться с нами</h3>
            <ul class="footer-list">
                <li>123 Main St. Tomsk, Russia</li>
                <li>+1 (111) 111-1111</li>
                <li>info@Servicecenter.com</li>
            </ul>
        </div>
    </div>
    <div class="footer-divider"></div>
</footer>

</body>
</html>
