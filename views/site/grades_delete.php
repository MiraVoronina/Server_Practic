<h2 class="page-title">Удалить оценку</h2>

<div class="form-wrapper">
    <?php if (!isset($gradeItem)): ?>
        <div class="select-form">
            <h3>Выберите оценку для удаления:</h3>
            <form method="get" action="<?= app()->route->getUrl('/grades/delete') ?>">
                <label>Выберите оценку:
                    <select name="id" onchange="this.form.submit()" required>
                        <option value="">-- Выберите оценку --</option>
                        <?php foreach ($grades as $item): ?>
                            <option value="<?= $item->id ?>">
                                ID: <?= $item->id ?> - Студент ID: <?= $item->student_id ?> -
                                Оценка: <?= $item->grade ?> - Тип: <?= $item->type ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>
            </form>
        </div>
    <?php else: ?>
        <?php if (isset($errors) && count($errors) > 0): ?>
            <div class="error-messages">
                <?php foreach ($errors as $field => $fieldErrors): ?>
                    <?php foreach ($fieldErrors as $error): ?>
                        <p class="error"><?= $error ?></p>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="confirmation-box">
            <h3 class="warning-title">⚠️ Подтверждение удаления</h3>
            <p>Вы действительно хотите удалить эту оценку?</p>

            <div class="info-box">
                <?php
                $student = null;
                foreach ($students as $s) {
                    if ($s->id == $gradeItem->student_id) {
                        $student = $s;
                        break;
                    }
                }

                $scheduleItem = null;
                foreach ($schedule as $item) {
                    if ($item->id == $gradeItem->schedule_id) {
                        $scheduleItem = $item;
                        break;
                    }
                }
                ?>
                <p><strong>ID оценки:</strong> <?= $gradeItem->id ?></p>
                <p><strong>Студент:</strong> <?= $student ? htmlspecialchars($student->last_name . ' ' . $student->first_name . ' ' . $student->middle_name) : 'N/A' ?></p>
                <p><strong>Занятие:</strong> <?= $scheduleItem ? htmlspecialchars($scheduleItem->date . ' - Ауд. ' . $scheduleItem->classroom) : 'N/A' ?></p>
                <p><strong>Тип:</strong> <?= htmlspecialchars($gradeItem->type) ?></p>
                <p><strong>Оценка:</strong> <?= htmlspecialchars($gradeItem->grade) ?></p>
                <p><strong>Часы:</strong> <?= htmlspecialchars($gradeItem->hours) ?></p>
            </div>

            <p class="warning-text">Это действие нельзя будет отменить!</p>

            <form method="post" action="<?= app()->route->getUrl('/grades/delete') ?>" class="form-style">
                <input type="hidden" name="csrf_token" value="<?= \Src\Auth\Auth::generateCSRF() ?>">
                <input type="hidden" name="id" value="<?= $gradeItem->id ?>">

                <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены, что хотите удалить эту оценку?');">Удалить</button>
                <a href="<?= app()->route->getUrl('/grades/delete') ?>" class="btn btn-secondary">Выбрать другую</a>
                <a href="<?= app()->route->getUrl('/grades') ?>" class="btn btn-secondary">Отмена</a>
            </form>
        </div>
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
    .select-form {
        text-align: center;
    }
    .select-form h3 {
        margin-bottom: 20px;
    }
    .select-form label {
        display: block;
        margin-bottom: 15px;
        font-weight: bold;
    }
    .select-form select {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    .confirmation-box {
        text-align: center;
    }
    .warning-title {
        color: #d32f2f;
        margin-bottom: 15px;
        font-size: 24px;
    }
    .info-box {
        background: #fff;
        padding: 15px;
        border-radius: 4px;
        margin: 20px 0;
        text-align: left;
        border: 2px solid #e0dcd7;
    }
    .info-box p {
        margin: 10px 0;
    }
    .warning-text {
        color: #d32f2f;
        font-weight: bold;
        margin: 15px 0;
    }
    .form-style {
        margin-top: 20px;
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
    .btn-danger {
        background-color: #f44336;
        color: white;
        border-color: #d32f2f;
    }
    .btn-danger:hover {
        background-color: #d32f2f;
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
