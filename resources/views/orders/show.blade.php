<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Заказ #{{ $order->Order_Number }}</title>
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
</head>
<body>
<div class="container">
    <a href="{{ route('admin.dashboard') }}" class="back-btn">
        ← Назад к панели
    </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    <div class="order-header">
        <div>
            <h1 class="order-title">Заказ #{{ $order->Order_Number }}</h1>
            <p class="tracking-number">Трекинг: {{ $order->Tracking_Number }}</p>
        </div>
        <div class="status-badge status-{{ $order->ID_Status }}">
            {{ $order->status->Order_Status_Name ?? 'Не указан' }}
        </div>
    </div>

    <!-- ФОРМА СМЕНЫ СТАТУСА ДЛЯ АДМИНА -->
    @if(Auth::user()->ID_User_Role == 1)
        <div style="margin: 20px 0; padding: 15px; background: #f8f9fa; border-radius: 8px; border: 1px solid #dee2e6;">
            <form method="POST" action="{{ route('orders.updateStatus', $order->ID_Order) }}">
                @csrf
                @method('PUT')
                <label style="font-weight: bold; margin-right: 10px; font-size: 16px;">Изменить статус:</label>
                <select name="status" onchange="this.form.submit()" style="padding: 10px 20px; border-radius: 4px; border: 1px solid #ced4da; font-size: 14px; cursor: pointer; background: white; min-width: 200px;">
                    @foreach($statuses as $status)
                        <option value="{{ $status->ID_Status }}"
                            {{ $order->ID_Status == $status->ID_Status ? 'selected' : '' }}>
                            {{ $status->Order_Status_Name }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
    @endif

    <div class="content-grid">
        <!-- Информация о заказе -->
        <div class="info-card">
            <h2 class="card-title">Информация о заказе</h2>
            <div class="info-list">
                <div class="info-item">
                    <span class="label">Дата создания:</span>
                    <span class="value">{{ \Carbon\Carbon::parse($order->Created_at)->format('d.m.Y H:i') }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Тип поломки:</span>
                    <span class="value">{{ $order->breakdown->Name_of_Breakdown ?? 'Не указан' }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Номер заказа:</span>
                    <span class="value">#{{ $order->Order_Number }}</span>
                </div>
            </div>
        </div>

        <!-- Информация о клиенте -->
        <div class="info-card">
            <h2 class="card-title">Информация о клиенте</h2>
            <div class="info-list">
                @if($order->ID_User)
                    <div class="info-item">
                        <span class="label">ФИО:</span>
                        <span class="value">{{ $order->user->userInfo->Full_name ?? $order->user->Login ?? 'Не указано' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="label">Телефон:</span>
                        <span class="value">{{ $order->user->userInfo->Phone ?? 'Не указан' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="label">Email:</span>
                        <span class="value">{{ $order->user->userInfo->Email ?? 'Не указан' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="label">Логин:</span>
                        <span class="value">{{ $order->user->Login ?? 'Не указан' }}</span>
                    </div>
                @else
                    <div class="info-item">
                        <span class="label">Имя:</span>
                        <span class="value">{{ $order->Guest_Name ?? 'Не указано' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="label">Телефон:</span>
                        <span class="value">{{ $order->Guest_Phone ?? 'Не указан' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="label">Email:</span>
                        <span class="value">{{ $order->Guest_Email ?? 'Не указан' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="label">Тип клиента:</span>
                        <span class="value" style="color: #6c757d; font-style: italic;">Гостевой заказ</span>
                    </div>
                @endif
            </div>
        </div>

        <!-- Информация об оборудовании -->
        <div class="info-card full-width">
            <h2 class="card-title">Информация об оборудовании</h2>
            <div class="equipment-grid">
                <div class="info-item">
                    <span class="label">Название оборудования:</span>
                    <span class="value">{{ $order->equipment->Equipment_Name ?? 'Не указано' }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Тип оборудования:</span>
                    <span class="value">{{ $order->equipment->typeOfEquipment->Type_Name ?? 'Не указан' }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Бренд:</span>
                    <span class="value">{{ $order->equipment->brand->Brand_Name ?? 'Не указан' }}</span>
                </div>
                <div class="info-item">
                    <span class="label">Серийный номер:</span>
                    <span class="value">{{ $order->equipment->Serial_Number ?? 'Не указан' }}</span>
                </div>
            </div>
        </div>

        <!-- Описание проблемы -->
        <div class="info-card full-width">
            <h2 class="card-title">Описание проблемы</h2>
            <div class="description-box">
                {{ $order->Description }}
            </div>
        </div>

        <!-- Фото оборудования -->
        @if($order->Equipment_Photo)
            <div class="info-card full-width">
                <h2 class="card-title">Фото оборудования</h2>
                <div class="photo-container">
                    <img src="{{ asset('uploads/equipment/' . $order->Equipment_Photo) }}" alt="Фото оборудования">
                </div>
            </div>
        @endif

        <!-- Комментарии -->
        <div class="info-card full-width">
            <h2 class="card-title">Комментарии ({{ $order->comments->count() }})</h2>

            <!-- Форма добавления комментария -->
            <div class="comment-form">
                <form method="POST" action="{{ route('orders.comments.store', $order->ID_Order) }}">
                    @csrf
                    <div class="form-group">
                        <textarea name="comment" class="comment-textarea" placeholder="Напишите комментарий..." rows="4" required></textarea>
                        @error('comment')
                        <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn-submit-comment">Добавить комментарий</button>
                </form>
            </div>

            <!-- Список комментариев -->
            <div class="comments-list">
                @if($order->comments->isEmpty())
                    <p class="no-comments">Комментариев пока нет</p>
                @else
                    @foreach($order->comments as $comment)
                        <div class="comment-item">
                            <div class="comment-header">
                                <div class="comment-author">
                                    <span class="author-avatar">{{ substr($comment->user->userInfo->Full_name ?? $comment->user->Login, 0, 1) }}</span>
                                    <div class="author-info">
                                        <strong>{{ $comment->user->userInfo->Full_name ?? $comment->user->Login }}</strong>
                                        <span class="comment-date">{{ \Carbon\Carbon::parse($comment->Created_at)->diffForHumans() }}</span>
                                    </div>
                                </div>
                                @if($comment->ID_User == Auth::id() || Auth::user()->ID_User_Role == 1)
                                    <form method="POST" action="{{ route('comments.destroy', $comment->ID_Comment) }}" onsubmit="return confirm('Удалить комментарий?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete-comment">Удалить</button>
                                    </form>
                                @endif
                            </div>
                            <div class="comment-text">
                                {{ $comment->Comment_Text }}
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <!-- Действия -->
    <div class="actions">
        @if(Auth::user()->ID_User_Role == 1 || $order->ID_User == Auth::id())
            <form action="{{ route('orders.destroy', $order->ID_Order) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить этот заказ?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">
                    Удалить заказ
                </button>
            </form>
        @endif
    </div>
</div>
</body>
</html>
