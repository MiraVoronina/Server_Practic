<h2 class="page-title">Добавить оценку</h2>

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

    <form method="post" action="<?= app()->route->getUrl('/grades/add') ?>" class="form-style">
        <input type="hidden" name="csrf_token" value="<?= \Src\Auth\Auth::generateCSRF() ?>">

        <label>Занятие:
            <select name="schedule_id" required>
                <option value="">-- Выберите занятие --</option>
                <?php foreach ($schedule as $item): ?>
                    <option value="<?= $item->id ?>"
                        <?= (isset($old['schedule_id']) && $old['schedule_id'] == $item->id) ? 'selected' : '' ?>>
                        ID: <?= $item->id ?> - <?= htmlspecialchars($item->date) ?> - Ауд. <?= htmlspecialchars($item->classroom) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>

        <label>Студент:
            <select name="student_id" required>
                <option value="">-- Выберите студента --</option>
                <?php foreach ($students as $student): ?>
                    <option value="<?= $student->id ?>"
                        <?= (isset($old['student_id']) && $old['student_id'] == $student->id) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($student->last_name . ' ' . $student->first_name . ' ' . $student->middle_name) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>

        <label>Тип оценки:
            <select name="type" required>
                <option value="">-- Выберите тип --</option>
                <option value="exam" <?= (isset($old['type']) && $old['type'] == 'exam') ? 'selected' : '' ?>>Экзамен (Exam)</option>
                <option value="credit" <?= (isset($old['type']) && $old['type'] == 'credit') ? 'selected' : '' ?>>Зачет (Credit)</option>
                <option value="test" <?= (isset($old['type']) && $old['type'] == 'test') ? 'selected' : '' ?>>Контрольная (Test)</option>
                <option value="coursework" <?= (isset($old['type']) && $old['type'] == 'coursework') ? 'selected' : '' ?>>Курсовая (Coursework)</option>
            </select>
        </label>

        <label>Оценка:
            <select name="grade" required>
                <option value="">-- Выберите оценку --</option>
                <option value="5" <?= (isset($old['grade']) && $old['grade'] == '5') ? 'selected' : '' ?>>5 (Отлично)</option>
                <option value="4" <?= (isset($old['grade']) && $old['grade'] == '4') ? 'selected' : '' ?>>4 (Хорошо)</option>
                <option value="3" <?= (isset($old['grade']) && $old['grade'] == '3') ? 'selected' : '' ?>>3 (Удовлетворительно)</option>
                <option value="2" <?= (isset($old['grade']) && $old['grade'] == '2') ? 'selected' : '' ?>>2 (Неудовлетворительно)</option>
            </select>
        </label>

        <label>Часы:
            <input type="number" name="hours" value="<?= $old['hours'] ?? '' ?>" min="1" required>
        </label>

        <button type="submit" class="btn">Сохранить</button>
        <a href="<?= app()->route->getUrl('/grades') ?>" class="btn btn-secondary">Отмена</a>
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
