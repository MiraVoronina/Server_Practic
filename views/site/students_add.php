<h2 class="page-title">Добавить студента</h2>

<div class="form-wrapper">
    <?php if (isset($errors) && count($errors) > 0): ?>
        <div class="error-message">
            <strong>Ошибки валидации:</strong>
            <ul>
                <?php foreach($errors as $field => $fieldErrors): ?>
                    <?php foreach($fieldErrors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" action="<?= app()->route->getUrl('/students/add') ?>" class="form-style">
        <input type="hidden" name="csrf_token" value="<?= \Src\Auth\Auth::generateCSRF() ?>">

        <label>Фамилия:
            <input type="text" name="last_name" value="<?= htmlspecialchars($old['last_name'] ?? '') ?>" required>
        </label>

        <label>Имя:
            <input type="text" name="first_name" value="<?= htmlspecialchars($old['first_name'] ?? '') ?>" required>
        </label>

        <label>Отчество:
            <input type="text" name="middle_name" value="<?= htmlspecialchars($old['middle_name'] ?? '') ?>" required>
        </label>

        <label>Адрес:
            <input type="text" name="address" value="<?= htmlspecialchars($old['address'] ?? '') ?>" required>
        </label>

        <label>Группа:
            <select name="group_id" required>
                <option value="">-- Выберите группу --</option>
                <?php foreach($groups as $group): ?>
                    <option value="<?= $group->id ?>" <?= (($old['group_id'] ?? '') == $group->id) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($group->name ?? $group->group_name ?? "Группа {$group->id}") ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>

        <label>Статус:
            <select name="status" required>
                <option value="">-- Выберите статус --</option>
                <option value="studying" <?= (($old['status'] ?? '') === 'studying') ? 'selected' : '' ?>>Учится</option>
                <option value="expelled" <?= (($old['status'] ?? '') === 'expelled') ? 'selected' : '' ?>>Отчислен</option>
                <option value="academic" <?= (($old['status'] ?? '') === 'academic') ? 'selected' : '' ?>>Академический отпуск</option>
            </select>
        </label>

        <div class="button-group">
            <button type="submit" class="btn">Сохранить</button>
            <a href="<?= app()->route->getUrl('/students') ?>" class="btn btn-secondary">Отмена</a>
        </div>
    </form>
</div>

<style>
    .page-title {
        text-align: center;
        margin: 20px 0;
    }

    .form-wrapper {
        max-width: 600px;
        margin: 30px auto;
        background: #f2e9e4;
        padding: 20px;
        border-radius: 8px;
    }

    .error-message {
        background: #ffe6e6;
        border: 2px solid #ff4444;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
        color: #721c24;
    }

    .error-message strong {
        display: block;
        margin-bottom: 10px;
    }

    .error-message ul {
        margin: 0;
        padding-left: 20px;
    }

    .error-message li {
        margin: 5px 0;
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

    .form-style input:focus,
    .form-style select:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
    }

    .button-group {
        display: flex;
        gap: 10px;
        margin-top: 20px;
    }

    .btn {
        padding: 10px 20px;
        background-color: #f2e9e4;
        border: 2px solid #e0dcd7;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: background-color 0.3s, transform 0.2s;
        border-radius: 6px;
        font-weight: bold;
    }

    .btn:hover {
        background-color: #e0dcd7;
        transform: scale(1.05);
    }

    .btn-secondary {
        background-color: #e2e3e5;
        border-color: #d6d8db;
        color: #383d41;
    }

    .btn-secondary:hover {
        background-color: #d6d8db;
    }
</style>
