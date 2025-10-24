<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакты - Service Center</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contacts.css') }}">
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
                <li><a href="/services" class="nav-link">Услуги</a></li>
                <li><a href="/contacts" class="nav-link active">Контакты</a></li>
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

<section class="contacts-hero">
    <div class="container">
        <h1 class="hero-title">Наши контакты</h1>
        <p class="hero-description">
            Вы можете связаться с нами через любой удобный способ, указанный ниже. Мы всегда готовы ответить на ваши вопросы.
        </p>
    </div>
</section>

<section class="contacts-main">
    <div class="container">
        <div class="contacts-layout">
            <div class="contacts-info">
                <div class="contact-block">
                    <h3>Email</h3>
                    <p>info@Servicecenter.com</p>
                </div>

                <div class="contact-block">
                    <h3>Адрес</h3>
                    <p>123 Main St. Tomsk, Russia</p>
                </div>

                <div class="contact-block">
                    <h3>Телефон</h3>
                    <p>+1 (555) 555-5555</p>
                </div>

                <div class="contact-block">
                    <h3>Часы работы</h3>
                    <p>Понедельник — Пятница: 9:00 — 18:00</p>
                    <p>Суббота — Воскресенье: выходной</p>
                </div>
            </div>

            <div class="contacts-map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2251.829866473743!2d84.95807091591431!3d56.47209308050603!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x432695ba96b1e155%3A0x8f5b7c8a5f8e8f5b!2z0YPQu9C40YbQsCDQk9C10YDRhtC10L3QsCwgMTgsINCi0L7QvNGB0LosINCi0L7QvNGB0LrQsNGPINC-0LHQuy4sIDYzNDAyOQ!5e0!3m2!1sru!2sru!4v1634567890123!5m2!1sru!2sru"
                    width="100%"
                    height="100%"
                    style="border:0; border-radius: 12px;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
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
