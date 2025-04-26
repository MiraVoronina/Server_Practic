<h2 class="page-title">Добавить сотрудника</h2>
<div class="form-wrapper form-style">
    <form method="post" action="<?= app()->route->getUrl('/employees/add') ?>">
        <label>Фамилия: <input type="text" name="last_name" required></label>
        <label>Имя: <input type="text" name="first_name" required></label>
        <label>Отчество: <input type="text" name="middle_name" required></label>
        <label>Телефон: <input type="text" name="phone" required></label>
        <label>Логин: <input type="text" name="login" required></label>
        <label>Пароль: <input type="password" name="password" required></label>
        <label>Должность (ID): <input type="number" name="position_id" required></label>
        <button type="submit">Сохранить</button>
    </form>
</div>
<style>
    .form-wrapper {
        max-width: 600px;
        margin: 30px auto;
        background: #f2e9e4;
        padding: 20px;
        border-radius: 8px;
    }
    .form-style label {
        display: block;
        margin-bottom: 15px;
        font-weight: bold;
    }
    .form-style input {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
    }
    .btn {
        padding: 10px 20px;
        background-color: #f2e9e4;
        border: 2px solid #e0dcd7;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        margin-top: 10px;
        transition: background-color 0.3s, transform 0.2s;
        border-radius: 6px;
    }
    .btn:hover {
        background-color: #e0dcd7;
        transform: scale(1.05);
    }