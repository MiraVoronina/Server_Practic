<h2 class="page-title">Добавить сотрудника</h2>

<div class="form-wrapper">
    <?php if (isset($errors) && count($errors) > 0): ?>
        <div class="error-messages">
            <?php foreach ($errors as $field => $fieldErrors): ?>
                <?php foreach ($fieldErrors as $error): ?>
                    <p class="error"><?= $error ?></p>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="post" action="<?= app()->route->getUrl('/employees/add') ?>" class="form-style">
        <input type="hidden" name="csrf_token" value="<?= \Src\Auth\Auth::generateCSRF() ?>">

        <label>Фамилия:
            <input type="text" name="last_name" value="<?= $old['last_name'] ?? '' ?>" required>
        </label>

        <label>Имя:
            <input type="text" name="first_name" value="<?= $old['first_name'] ?? '' ?>" required>
        </label>

        <label>Отчество:
            <input type="text" name="middle_name" value="<?= $old['middle_name'] ?? '' ?>" required>
        </label>

        <label>Телефон:
            <input type="text" name="phone" value="<?= $old['phone'] ?? '' ?>" placeholder="+7 (XXX) XXX-XX-XX" required>
        </label>

        <label>Логин:
            <input type="text" name="login" value="<?= $old['login'] ?? '' ?>" required>
        </label>

        <label>Пароль:
            <input type="password" name="password" required>
        </label>

        <label>Должность:
            <select name="position_id" required>
                <option value="">-- Выберите должность --</option>
                <?php foreach ($positions as $position): ?>
                    <option value="<?= $position->id ?>"
                        <?= (isset($old['position_id']) && $old['position_id'] == $position->id) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($position->name) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>

        <button type="submit" class="btn">Сохранить</button>
        <a href="<?= app()->route->getUrl('/employees') ?>" class="btn btn-secondary">Отмена</a>
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
    .form-style input,
    .form-style select {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    .btn {
        padding: 10px 20px;
        background-color: #f2e9e4;
        border: 2px solid #e0dcd7;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        margin-top: 10px;
        margin-right: 10px;
        transition: background-color 0.3s, transform 0.2s;
        border-radius: 6px;
    }
    .btn:hover {
        background-color: #e0dcd7;
        transform: scale(1.05);
    }
    .btn-secondary {
        background-color: #ddd;
        border-color: #ccc;
    }
    .btn-secondary:hover {
        background-color: #ccc;
    }
    .error-messages {
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 4px;
    }
    .error {
        margin: 5px 0;
    }
</style>
