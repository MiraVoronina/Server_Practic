<h2 class="page-title">Редактировать студента</h2>

<div class="form-wrapper">
    <?php if (!isset($student) || $student === null): ?>
        <form method="get" action="<?= app()->route->getUrl('/students/edit') ?>" class="form-style">
            <label>Выберите студента для редактирования:
                <select name="id" required>
                    <option value="">-- Выберите студента --</option>
                    <?php foreach($students as $s): ?>
                        <option value="<?= $s->id ?>">
                            <?= htmlspecialchars($s->last_name) ?>
                            <?= htmlspecialchars($s->first_name) ?>
                            <?= htmlspecialchars($s->middle_name) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>
            <button type="submit" class="btn">Выбрать студента</button>
        </form>
    <?php else: ?>
        <form method="post" action="<?= app()->route->getUrl('/students/edit') ?>" class="form-style">
            <input type="hidden" name="csrf_token" value="<?= \Src\Auth\Auth::generateCSRF() ?>">
            <input type="hidden" name="id" value="<?= $student->id ?>">

            <div style="margin-bottom: 15px;">
                <strong>ID студента:</strong> <?= $student->id ?>
            </div>

            <label>Фамилия:
                <input type="text" name="last_name" value="<?= htmlspecialchars($student->last_name) ?>" required>
            </label>

            <label>Имя:
                <input type="text" name="first_name" value="<?= htmlspecialchars($student->first_name) ?>" required>
            </label>

            <label>Отчество:
                <input type="text" name="middle_name" value="<?= htmlspecialchars($student->middle_name) ?>" required>
            </label>

            <label>Адрес:
                <input type="text" name="address" value="<?= htmlspecialchars($student->address) ?>" required>
            </label>

            <label>Группа:
                <select name="group_id" required>
                    <option value="">-- Выберите группу --</option>
                    <?php foreach($groups as $group): ?>
                        <option value="<?= $group->id ?>" <?= ($student->group_id == $group->id) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($group->name ?? $group->group_name ?? "Группа {$group->id}") ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>

            <label>Статус:
                <select name="status" required>
                    <option value="studying" <?= $student->status === 'studying' ? 'selected' : '' ?>>Учится</option>
                    <option value="dismissed" <?= $student->status === 'dismissed' ? 'selected' : '' ?>>Отчислен</option>
                    <option value="academic_leave" <?= $student->status === 'academic_leave' ? 'selected' : '' ?>>Академический отпуск</option>
                </select>
            </label>

            <?php if (isset($errors) && count($errors) > 0): ?>
                <div style="color: red; margin-bottom: 15px;">
                    <ul>
                        <?php foreach($errors as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <button type="submit" class="btn">Сохранить изменения</button>
            <a href="<?= app()->route->getUrl('/students/edit') ?>" class="btn">Выбрать другого студента</a>
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
</style>
