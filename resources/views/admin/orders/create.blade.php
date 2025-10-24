<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создать заказ - Service Center</title>
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

<section class="admin-section">
    <div class="container">
        <div class="page-header">
            <h1 class="admin-title">Создать заказ</h1>
            <a href="{{ route('admin.dashboard') }}" class="btn-back">← Назад к панели</a>
        </div>

        <div class="admin-card">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.orders.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="order-type-selector">
                        <label class="type-option active" onclick="selectType('existing')">
                            <input type="radio" name="order_type" value="existing" checked>
                            <div class="type-title">Существующий клиент</div>
                            <div class="type-desc">Выбрать из базы</div>
                        </label>

                        <label class="type-option" onclick="selectType('guest')">
                            <input type="radio" name="order_type" value="guest">
                            <div class="type-title">Новый клиент</div>
                            <div class="type-desc">Гостевой заказ</div>
                        </label>
                    </div>

                    <div class="client-fields active">
                        <div class="client-selector-grid">
                            @foreach($users as $user)
                                <label class="client-card">
                                    <input type="radio" name="user_id" value="{{ $user->ID_User }}">
                                    <div class="client-avatar">{{ substr($user->userInfo->Full_name ?? $user->Login, 0, 1) }}</div>
                                    <div class="client-name">{{ $user->userInfo->Full_name ?? $user->Login }}</div>
                                    <div class="client-phone">{{ $user->userInfo->Phone ?? 'Телефон не указан' }}</div>
                                    <div class="client-checkmark">✓</div>
                                </label>
                            @endforeach
                        </div>
                        @error('user_id')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="guest-fields">
                        <div class="guest-form-grid">
                            <div class="form-group">
                                <label for="guest_name">ФИО клиента</label>
                                <input type="text" name="guest_name" id="guest_name" class="form-control" placeholder="Иванов Иван Иванович">
                                @error('guest_name')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="guest_phone">Телефон</label>
                                <input type="text" name="guest_phone" id="guest_phone" class="form-control" placeholder="+7 (900) 123-45-67">
                                @error('guest_phone')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="guest_email">Email (необязательно)</label>
                                <input type="email" name="guest_email" id="guest_email" class="form-control" placeholder="example@mail.com">
                                @error('guest_email')
                                <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="divider"></div>

                    <div class="equipment-grid">
                        <div class="form-group">
                            <label for="equipment_type_id">Тип оборудования</label>
                            <select name="equipment_type_id" id="equipment_type_id" class="form-control">
                                <option value="">Выберите тип оборудования</option>
                                @foreach($equipmentTypes as $type)
                                    <option value="{{ $type->ID_Equipment }}">{{ $type->Name_Of_Equipment_Type }}</option>
                                @endforeach
                            </select>
                            @error('equipment_type_id')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="brand_id">Бренд</label>
                            <select name="brand_id" id="brand_id" class="form-control">
                                <option value="">Выберите бренд</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->ID_Brand }}">{{ $brand->Brand_Name }}</option>
                                @endforeach
                            </select>
                            @error('brand_id')
                            <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="equipment_name">Модель оборудования</label>
                        <input type="text" name="equipment_name" id="equipment_name" class="form-control" placeholder="Например: MacBook Pro 13" required>
                        @error('equipment_name')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="breakdown_id">Тип поломки</label>
                        <select name="breakdown_id" id="breakdown_id" class="form-control">
                            <option value="">Выберите тип поломки</option>
                            @foreach($breakdowns as $breakdown)
                                <option value="{{ $breakdown->ID_Type_Of_Breakdown }}">{{ $breakdown->Name_of_Breakdown }}</option>
                            @endforeach
                        </select>
                        @error('breakdown_id')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Описание проблемы</label>
                        <textarea name="description" id="description" class="form-control" rows="5" required placeholder="Подробно опишите проблему..."></textarea>
                        @error('description')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="photo">Фото (необязательно)</label>
                        <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
                        @error('photo')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn-submit">Создать заказ</button>
                </form>
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

<script>
    function selectType(type) {
        document.querySelectorAll('.type-option').forEach(opt => opt.classList.remove('active'));
        event.currentTarget.classList.add('active');

        document.querySelectorAll('input[name="order_type"]').forEach(radio => {
            if (radio.value === type) radio.checked = true;
        });

        if (type === 'existing') {
            document.querySelector('.client-fields').classList.add('active');
            document.querySelector('.guest-fields').classList.remove('active');
        } else {
            document.querySelector('.client-fields').classList.remove('active');
            document.querySelector('.guest-fields').classList.add('active');
        }
    }
</script>
</body>
</html>
