<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная - Service Center</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
@if(session('error'))
    <div style="background: #f8d7da; color: #721c24; padding: 15px; margin: 20px; border-radius: 5px; max-width: 800px; margin-left: auto; margin-right: auto;">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div style="background: #d4edda; color: #155724; padding: 15px; margin: 20px; border-radius: 5px; max-width: 800px; margin-left: auto; margin-right: auto;">
        {{ session('success') }}
    </div>
@endif
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
                <li><a href="/" class="nav-link active">Главная</a></li>
                <li><a href="/about" class="nav-link">О нас</a></li>
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

<section class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">
            <span class="accent-color">Решаем</span> любые
            <span class="accent-color">проблемы</span> с вашим компьютером
            <span class="accent-color">быстро и надежно</span>
        </h1>
        <p class="hero-description">
            Ваш надежный помощник в мире цифровых технологий! Наша команда опытных
            специалистов готова оперативно решить любые проблемы с вашим компьютером.
        </p>
    </div>
</section>

<section class="about-section">
    <div class="container">
        <h2 class="section-title">О нас</h2>
        <p class="section-text">
            В Service center мы понимаем важность исправной работы бытовой техники для комфортной
            жизни каждого человека. Именно поэтому мы стремимся предоставлять нашим клиентам
            ремонтные услуги высочайшего качества, которым можно доверять.
        </p>
        <p class="section-text">
            На протяжении многих лет мы накапливали богатый опыт в диагностике и ремонте различных
            видов техники от телефонов до компьютеров.
        </p>
    </div>
</section>

<section class="features-section">
    <div class="container">
        <h2 class="section-title">Почему выбирают нас?</h2>

        <div class="features-grid">
            <div class="feature-card">
                <h3 class="feature-title">Профессионализм</h3>
                <ul class="feature-list">
                    <li>Команда опытных мастеров с многолетним опытом ремонта техники</li>
                    <li>Глубокие знания устройства и принципов работы различных видов техники</li>
                </ul>
            </div>

            <div class="feature-card">
                <h3 class="feature-title">Качество</h3>
                <ul class="feature-list">
                    <li>Использование оригинальных запчастей и современного оборудования</li>
                    <li>Гарантия на все виды выполненных работ</li>
                </ul>
            </div>

            <div class="feature-card">
                <h3 class="feature-title">Оперативность</h3>
                <ul class="feature-list">
                    <li>Быстрая диагностика и ремонт в кратчайшие сроки</li>
                    <li>Возможность срочного ремонта по договоренности</li>
                </ul>
            </div>

            <div class="feature-card">
                <h3 class="feature-title">Доступные цены</h3>
                <ul class="feature-list">
                    <li>Прозрачное ценообразование без скрытых платежей</li>
                    <li>Бесплатная диагностика при ремонте</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="services-section">
    <div class="container">
        <h2 class="section-title">Наши услуги</h2>
        <div class="services-grid">
            <div class="service-card">
                <h3>Диагностика и ремонт ПК</h3>
                <p>Диагностика и устранение неисправностей комплектующих</p>
            </div>
            <div class="service-card">
                <h3>Ремонт ноутбуков</h3>
                <p>Определение и решение проблем с материнской платой, дисплеем</p>
            </div>
            <div class="service-card">
                <h3>Установка ПО</h3>
                <p>Установка операционных систем и программного обеспечения</p>
            </div>
            <div class="service-card">
                <h3>Восстановление данных</h3>
                <p>Извлечение данных с поврежденных накопителей</p>
            </div>
        </div>
    </div>
</section>

<section class="reviews-section">
    <div class="container">
        <h2 class="section-title">Отзывы наших клиентов</h2>
        <p class="section-description">
            В Service center мы стремимся предоставлять нашим клиентам исключительные услуги по ремонту техники.
            Но не просто верьте нашим словам - послушайте, что говорят о нас наши довольные клиенты:
        </p>

        <div class="reviews-grid">
            <div class="review-card">
                <div class="review-author">Алексей М.</div>
                <div class="review-text">
                    "После падения мой ноутбук перестал включаться. Я обратился в Service center, и ребята смогли
                    восстановить все мои важные данные. Ремонт был выполнен качественно и в кратчайшие сроки.
                    Теперь я постоянный клиент этого сервиса!"
                </div>
            </div>

            <div class="review-card">
                <div class="review-author">Мария К.</div>
                <div class="review-text">
                    "Мой старый компьютер постоянно зависал и тормозил. Ребята из Service center быстро выявили
                    проблему, заменили неисправные комплектующие. Теперь компьютер работает как новый, я очень довольна!"
                </div>
            </div>

            <div class="review-card">
                <div class="review-author">Дмитрий С.</div>
                <div class="review-text">
                    "Я очень боялся, что мой производительный игровой ПК не удастся восстановить. Но специалисты
                    Service center вернули технику в идеальное состояние, я в восторге!"
                </div>
            </div>

            <div class="review-card">
                <div class="review-author">Елена Т.</div>
                <div class="review-text">
                    "Мой смартфон упал и разбил экран. Я переживала, что придется покупать новый, но в Service center
                    быстро и качественно заменили дисплей. Теперь телефон работает как новый, а стоимость ремонта
                    оказалась намного ниже, чем я ожидала."
                </div>
            </div>
        </div>
    </div>
</section>

<section class="contacts-section">
    <div class="container">
        <h2 class="section-title">Контакты</h2>

        <div class="contacts-grid-map">
            <div class="contact-info">
                <div class="contact-item">
                    <h3>Адрес</h3>
                    <p>г. Томск, ул. Герцена, 18</p>
                </div>
                <div class="contact-item">
                    <h3>Телефон</h3>
                    <p>+7 (900) 123-45-67</p>
                </div>
                <div class="contact-item">
                    <h3>Email</h3>
                    <p>info@Servicecenter.com</p>
                </div>
                <div class="contact-item">
                    <h3>Режим работы</h3>
                    <p>Пн-Пт: 9:00 - 18:00<br>Сб-Вс: Выходной</p>
                </div>
            </div>

            <div class="contact-map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2251.829866473743!2d84.95807091591431!3d56.47209308050603!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x432695ba96b1e155%3A0x8f5b7c8a5f8e8f5b!2z0YPQu9C40YbQsCDQk9C10YDRhtC10L3QsCwgMTgsINCi0L7QvNGB0LosINCi0L7QvNGB0LrQsNGPINC-0LHQuy4sIDYzNDAyOQ!5e0!3m2!1sru!2sru!4v1634567890123!5m2!1sru!2sru"
                    width="100%"
                    height="450"
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
