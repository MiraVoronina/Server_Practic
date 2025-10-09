<h2 class="page-title">Добавить расписание</h2>

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

    <form method="post" action="<?= app()->route->getUrl('/schedule/add') ?>" class="form-style">
        <input type="hidden" name="csrf_token" value="<?= \Src\Auth\Auth::generateCSRF() ?>">

        <label>Дата:
            <input type="date" name="date" value="<?= $old['date'] ?? '' ?>" required>
        </label>

        <label>Дисциплина:
            <select name="discipline_id" required>
                <option value="">-- Выберите дисциплину --</option>
                <?php foreach ($disciplines as $discipline): ?>
                    <option value="<?= $discipline->id ?>"
                        <?= (isset($old['discipline_id']) && $old['discipline_id'] == $discipline->id) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($discipline->name) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>

        <label>Аудитория:
            <input type="text" name="classroom" value="<?= $old['classroom'] ?? '' ?>" required>
        </label>

        <label>Преподаватель:
            <select name="employee_id" required>
                <option value="">-- Выберите преподавателя --</option>
                <?php foreach ($employees as $employee): ?>
                    <option value="<?= $employee->id ?>"
                        <?= (isset($old['employee_id']) && $old['employee_id'] == $employee->id) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($employee->last_name . ' ' . $employee->first_name . ' ' . $employee->middle_name) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>

        <label>Группа:
            <select name="group_id" required>
                <option value="">-- Выберите группу --</option>
                <?php foreach ($groups as $group): ?>
                    <option value="<?= $group->id ?>"
                        <?= (isset($old['group_id']) && $old['group_id'] == $group->id) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($group->name) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>

        <button type="submit" class="btn">Сохранить</button>
        <a href="<?= app()->route->getUrl('/schedule') ?>" class="btn btn-secondary">Отмена</a>
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
