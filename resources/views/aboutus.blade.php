<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>О нас - Service Center</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aboutus.css') }}">
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
                <li><a href="/about" class="nav-link active">О нас</a></li>
                <li><a href="/services" class="nav-link">Услуги</a></li>
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

<section class="about-hero">
    <div class="container">
        <h1 class="hero-title">О нас</h1>
        <p class="hero-description">
            Добро пожаловать в наш сервис по ремонту компьютерной техники! Мы — команда профессионалов с более чем 10-летним опытом, и наша цель — предоставить вам высококачественные услуги, которые гарантируют надёжность и долговечность вашей техники.
        </p>
    </div>
</section>

<section class="why-us-section">
    <div class="container">
        <h2 class="section-title">Почему выбирают нас?</h2>
        <p class="section-description">
            В Service center мы всегда ориентированы на ваш комфорт и оперативность. Мы понимаем, как важно для вас, чтобы техника работала без сбоев, и вот почему мы выделяемся среди других сервисов:
        </p>

        <div class="benefits-grid">
            <div class="benefit-card">
                <h3 class="benefit-title">Профессионализм</h3>
                <ul class="benefit-list">
                    <li>Команда опытных мастеров с многолетним опытом ремонта техники</li>
                    <li>Глубокие знания устройства и принципов работы различных видов техники</li>
                </ul>
            </div>

            <div class="benefit-card">
                <h3 class="benefit-title">Качество</h3>
                <ul class="benefit-list">
                    <li>Использование оригинальных запчастей и современного оборудования</li>
                    <li>Гарантия на все виды выполненных работ</li>
                </ul>
            </div>

            <div class="benefit-card">
                <h3 class="benefit-title">Оперативность</h3>
                <ul class="benefit-list">
                    <li>Быстрая диагностика и ремонт в кратчайшие сроки</li>
                    <li>Возможность срочного ремонта по договоренности</li>
                </ul>
            </div>

            <div class="benefit-card">
                <h3 class="benefit-title">Доступные цены</h3>
                <ul class="benefit-list">
                    <li>Прозрачное ценообразование без скрытых платежей</li>
                    <li>Бесплатная диагностика при ремонте</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="team-section">
    <div class="container">
        <h2 class="section-title">Наша команда</h2>
        <p class="section-description">
            Каждый специалист в нашей команде прошел строгий отбор и обладает уникальными знаниями и навыками. Мы гордимся тем, что наши эксперты способны решить самые сложные задачи и предоставить клиентам отличный сервис.
        </p>

        <div class="team-grid">
            <div class="team-member">
                <div class="member-avatar">АП</div>
                <h3 class="member-name">Алексей Петров</h3>
                <p class="member-role">Главный инженер</p>
                <p class="member-description">
                    В опыте более 8 лет. Профессионал в диагностике и ремонте комплектующих.
                </p>
            </div>

            <div class="team-member">
                <div class="member-avatar">ЕС</div>
                <h3 class="member-name">Екатерина Смирнова</h3>
                <p class="member-role">Системный администратор</p>
                <p class="member-description">
                    Настройка и устранение сбоев в ПО, установка ОС и программ.
                </p>
            </div>

            <div class="team-member">
                <div class="member-avatar">ДК</div>
                <h3 class="member-name">Дмитрий Ковалев</h3>
                <p class="member-role">Специалист по восстановлению данных</p>
                <p class="member-description">
                    Помогает клиентам восстановить важную информацию с жестких дисков и SSD.
                </p>
            </div>

            <div class="team-member">
                <div class="member-avatar">МВ</div>
                <h3 class="member-name">Мария Волкова</h3>
                <p class="member-role">Мастер по ремонту мобильных устройств</p>
                <p class="member-description">
                    Специализируется на восстановлении и ремонте смартфонов и планшетов.
                </p>
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
