<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сайт</title>
    <link rel="stylesheet" href="/styles.css">
    <script src="/sort-table.js" defer></script>
    <script src="/Modal.js" defer></script>
</head>
<body>

<header class="header">
    <div class="logo">
        <img src="/logo.png" alt="Логотип">
    </div>
    <nav>
        <ul class="nav-menu">
            <li><a href="/home">Главная</a></li>
            <li><a href="/students">Студенты</a></li>
            <li><a href="/schedule">Расписание</a></li>
            <li><a href="/grades">Оценки</a></li>
            <li><a href="/employees">Сотрудники</a></li>
            <li><button class="open-modal">Авторизация</button></li>
        </ul>
    </nav>
</header>

<main>
    <?= $content ?? '<p style="color:red">Контент не найден</p>' ?>
</main>

<!-- Модалка -->
<div id="modal-login" class="modal" style="display:none; position:fixed; z-index:1000; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); justify-content:center; align-items:center;">
    <div class="modal-content" style="background:white; padding:20px; border-radius:5px; max-width:400px; width:100%;">
        <span class="close-modal" style="cursor:pointer; float:right;">&times;</span>
        <form method="post" action="<?= app()->route->getUrl('/login') ?>">
            <label>Логин <input type="text" name="login" required></label><br>
            <label>Пароль <input type="password" name="password" required></label><br>
            <button type="submit">Войти</button>
        </form>
    </div>
</div>

</body>
</html>
