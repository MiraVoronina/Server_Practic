<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Сайт</title>
    <link rel="stylesheet" href="/styles.css">
    <script src="/sort-table.js" defer></script>
    <script src="/Modal.js" defer></script>
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            justify-content: center;
            align-items: center;
        }
        .modal.visible {
            display: flex !important;
        }
    </style>
</head>
<body>

<header class="header">
    <div class="logo">
        <img src="/img/logo.svg" alt="Логотип" style="width:40px; height:40px; vertical-align:middle;">
    </div>
    <nav>
        <ul class="nav-menu">
            <li><a href="/home">Главная</a></li>
            <li><a href="/students">Студенты</a></li>
            <li><a href="/schedule">Расписание</a></li>
            <li><a href="/grades">Оценки</a></li>
            <li><a href="/employees">Сотрудники</a></li>
            <?php if (!app()->auth::check()): ?>
                <li><button class="open-modal">Авторизация</button></li>
            <?php else: ?>
                <li><?= app()->auth::user()->last_name ?> <?= app()->auth::user()->first_name ?> | <a href="/logout">Выйти</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<main>
    <?= $content ?? '<p style="color:red">Контент не найден</p>' ?>
</main>

<?php if (!app()->auth::check()): ?>
    <div id="modal-login" class="modal <?= isset($login_error) ? 'visible' : '' ?>">
        <div class="modal-content" style="background:white; padding:20px; border-radius:5px; max-width:400px; width:100%;">
            <span class="close-modal" style="cursor:pointer; float:right;">&times;</span>

            <?php if (isset($login_error)): ?>
                <div style="background:#ffe6e6; border-left:4px solid #ff4444; padding:10px; margin-bottom:15px; color:#721c24; clear:both;">
                    ⚠️ <?= htmlspecialchars($login_error) ?>
                </div>
            <?php endif; ?>

            <form method="post" action="<?= app()->route->getUrl('/login') ?>">
                <label>Логин <input type="text" name="login" required></label><br>
                <label>Пароль <input type="password" name="password" required></label><br>
                <button type="submit">Войти</button>
            </form>
        </div>
    </div>
<?php endif; ?>

</body>
</html>
