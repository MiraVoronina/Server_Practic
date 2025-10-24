    <!DOCTYPE html>
    <html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Создать заказ - Service Center</title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/orders.css') }}">
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
                    <li><a href="/orders" class="nav-link active">Мои заказы</a></li>
                    @auth
                        <li>
                            <span class="user-badge client-badge">{{ Auth::user()->Login }}</span>
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
                <h1 class="page-title">Создать заказ</h1>
                <a href="{{ route('orders.index') }}" class="btn-create">← Назад к заказам</a>
            </div>

            @if(session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif

            <div class="order-form-card">
                <form method="POST" action="{{ route('orders.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="equipment_type_id">
                            <span class="label-icon">💻</span>
                            Тип оборудования
                        </label>
                        <select name="equipment_type_id" id="equipment_type_id" class="form-control" required onchange="this.style.color='#2c2e47'">
                            <option value="" disabled selected>Выберите тип оборудования</option>
                            @isset($equipmentTypes)
                                @foreach($equipmentTypes as $type)
                                    <option value="{{ $type->ID_Equipment }}">{{ $type->Name_Of_Equipment_Type }}</option>
                                @endforeach
                            @endisset
                        </select>
                        @error('equipment_type_id')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="brand_id">
                            <span class="label-icon">🏷️</span>
                            Бренд
                        </label>
                        <select name="brand_id" id="brand_id" class="form-control" required onchange="this.style.color='#2c2e47'">
                            <option value="" disabled selected>Выберите бренд</option>
                            @isset($brands)
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->ID_Brand }}">{{ $brand->Brand_Name }}</option>
                                @endforeach
                            @endisset
                        </select>
                        @error('brand_id')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="equipment_name">
                            <span class="label-icon">📱</span>
                            Модель оборудования
                        </label>
                        <input type="text" name="equipment_name" id="equipment_name" class="form-control" required placeholder="Например: MacBook Pro 13">
                        @error('equipment_name')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="breakdown_id">
                            <span class="label-icon">🔧</span>
                            Тип поломки
                        </label>
                        <select name="breakdown_id" id="breakdown_id" class="form-control" required onchange="this.style.color='#2c2e47'">
                            <option value="" disabled selected>Выберите тип поломки</option>
                            @isset($breakdowns)
                                @foreach($breakdowns as $breakdown)
                                    <option value="{{ $breakdown->ID_Type_Of_Breakdown }}">{{ $breakdown->Name_of_Breakdown }}</option>
                                @endforeach
                            @endisset
                        </select>
                        @error('breakdown_id')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">
                            <span class="label-icon">📝</span>
                            Описание проблемы
                        </label>
                        <textarea name="description" id="description" class="form-control" rows="5" required placeholder="Подробно опишите проблему..."></textarea>
                        @error('description')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="photo">
                            <span class="label-icon">📷</span>
                            Фото (необязательно)
                        </label>
                        <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
                        @error('photo')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn-submit">✓ Создать заказ</button>
                </form>
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
