<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Center</title>
    <link rel="stylesheet" href="css/service%20center.css">
</head>
<body>
<div class="help-section">
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
                    <li><a href="{{ url('/') }}" class="nav-link">Главная</a></li>
                    <li><a href="{{ url('/aboutus') }}" class="nav-link">О нас</a></li>
                    <li><a href="{{ url('/services') }}" class="nav-link">Услуги</a></li>
                    <li><a href="{{ url('/service-center') }}" class="nav-link">Консультация</a></li>
                    <li><a href="{{ url('/contacts') }}" class="nav-link">Контакты</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <main class="problem-section">
        <h1 class="section-title">Опишите вашу проблему</h1>
        <form class="problem-form">
            <div class="problem-list">
                <div class="problem-item">
                    <input type="radio" id="problem1" name="problem" class="visually-hidden">
                    <label for="problem1" class="problem-label">включается, загрузка не происходит, экран остается черным</label>
                </div>
                <div class="problem-item">
                    <input type="radio" id="problem2" name="problem" class="visually-hidden">
                    <label for="problem2" class="problem-label">не включается, не реагирует на кнопку включения</label>
                </div>
                <div class="problem-item">
                    <input type="radio" id="problem3" name="problem" class="visually-hidden">
                    <label for="problem3" class="problem-label">работает медленнее обычного</label>
                </div>
                <div class="problem-item">
                    <input type="radio" id="problem4" name="problem" class="visually-hidden">
                    <label for="problem4" class="problem-label">сильно нагревается</label>
                </div>
                <div class="problem-item">
                    <input type="radio" id="problem5" name="problem" class="visually-hidden">
                    <label for="problem5" class="problem-label">начинается загрузка, но сразу же появляется "синий экран"</label>
                </div>
                <div class="problem-item">
                    <input type="radio" id="problem6" name="problem" class="visually-hidden">
                    <label for="problem6" class="problem-label">после запуска работает некоторое время, а потом выключается</label>
                </div>
                <div class="problem-item">
                    <input type="radio" id="problem7" name="problem" class="visually-hidden">
                    <label for="problem7" class="problem-label">самопроизвольно выключается</label>
                </div>
                <div class="problem-item">
                    <input type="radio" id="problem8" name="problem" class="visually-hidden">
                    <label for="problem8" class="problem-label">не работает клавиатура</label>
                </div>
                <div class="problem-item">
                    <input type="radio" id="problem9" name="problem" class="visually-hidden">
                    <label for="problem9" class="problem-label">пропадает изображение</label>
                </div>
                <div class="problem-item">
                    <input type="radio" id="problem10" name="problem" class="visually-hidden">
                    <label for="problem10" class="problem-label">появляется логотип ОС, но дальше не загружается</label>
                </div>
                <div class="problem-item">
                    <input type="radio" id="other" name="problem" class="visually-hidden">
                    <label for="other" class="problem-label">другое</label>
                </div>
            </div>
            <button type="submit" class="submit-btn">
                Продолжить
                <img src="img/line.png" alt="" class="arrow-icon">
            </button>
        </form>
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
</div>
<div class="footer-divider"></div>
</footer>
</div>
</body>
</html>
