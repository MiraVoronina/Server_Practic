<h2 class="page-title">Удалить студента</h2>

<div class="form-wrapper">
    <?php if (!isset($student) || $student === null): ?>
        <form method="get" action="<?= app()->route->getUrl('/students/delete') ?>" class="form-style">
            <label>Выберите студента для удаления:
                <select name="id" required>
                    <option value="">-- Выберите студента --</option>
                    <?php foreach($students as $s): ?>
                        <option value="<?= $s->id ?>">
                            <?= htmlspecialchars($s->last_name) ?>
                            <?= htmlspecialchars($s->first_name) ?>
                            <?= htmlspecialchars($s->middle_name) ?>
                            (Группа: <?= $s->group_id ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>
            <button type="submit" class="btn">Выбрать студента</button>
        </form>
    <?php else: ?>
        <div class="warning-message">
            <p><strong>⚠️ Внимание!</strong></p>
            <p>Вы действительно хотите удалить студента?</p>
        </div>

        <div class="student-info">
            <h3>Информация о студенте:</h3>
            <p><strong>ID:</strong> <?= $student->id ?></p>
            <p><strong>ФИО:</strong> <?= htmlspecialchars($student->last_name) ?>
                <?= htmlspecialchars($student->first_name) ?>
                <?= htmlspecialchars($student->middle_name) ?></p>
            <p><strong>Адрес:</strong> <?= htmlspecialchars($student->address) ?></p>
            <p><strong>Группа:</strong> <?= $student->group_id ?></p>
            <p><strong>Статус:</strong> <?= $student->status ?></p>
        </div>

        <form method="post" action="<?= app()->route->getUrl('/students/delete') ?>" class="form-style">
            <input type="hidden" name="csrf_token" value="<?= \Src\Auth\Auth::generateCSRF() ?>">
            <input type="hidden" name="id" value="<?= $student->id ?>">

            <?php if (isset($errors) && count($errors) > 0): ?>
                <div style="color: red; margin-bottom: 15px; background: #ffe6e6; padding: 10px; border-radius: 5px;">
                    <strong>Ошибки:</strong>
                    <ul style="margin: 5px 0; padding-left: 20px;">
                        <?php foreach($errors as $field => $fieldErrors): ?>
                            <?php foreach($fieldErrors as $error): ?>
                                <li><?= htmlspecialchars($error) ?></li>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="button-group">
                <button type="submit" class="btn btn-danger">Да, удалить</button>
                <a href="<?= app()->route->getUrl('/students/delete') ?>" class="btn btn-secondary">Отмена</a>
                <a href="<?= app()->route->getUrl('/students') ?>" class="btn btn-secondary">Вернуться к списку</a>
            </div>
        </form>
    <?php endif; ?>
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

    .form-style input, .form-style select {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .warning-message {
        background: #fff3cd;
        border: 2px solid #ffc107;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
        text-align: center;
    }

    .warning-message p {
        margin: 5px 0;
        color: #856404;
    }

    .student-info {
        background: #fff;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 20px;
        border: 1px solid #ddd;
    }

    .student-info h3 {
        margin-top: 0;
        color: #333;
    }

    .student-info p {
        margin: 8px 0;
    }

    .button-group {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
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

    .btn-danger {
        background-color: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
    }

    .btn-danger:hover {
        background-color: #f5c6cb;
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
