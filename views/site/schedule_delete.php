<h2 class="page-title">Удалить запись расписания</h2>

<div class="form-wrapper">
    <?php if (!isset($scheduleItem)): ?>
        <div class="select-form">
            <h3>Выберите занятие для удаления:</h3>
            <form method="get" action="<?= app()->route->getUrl('/schedule/delete') ?>">
                <label>Выберите занятие:
                    <select name="id" onchange="this.form.submit()" required>
                        <option value="">-- Выберите занятие --</option>
                        <?php foreach ($schedule as $item): ?>
                            <?php
                            $discipline = null;
                            $employee = null;
                            $group = null;

                            foreach ($disciplines as $d) {
                                if ($d->id == $item->discipline_id) {
                                    $discipline = $d;
                                    break;
                                }
                            }

                            foreach ($employees as $e) {
                                if ($e->id == $item->employee_id) {
                                    $employee = $e;
                                    break;
                                }
                            }

                            foreach ($groups as $g) {
                                if ($g->id == $item->group_id) {
                                    $group = $g;
                                    break;
                                }
                            }
                            ?>
                            <option value="<?= $item->id ?>">
                                <?= htmlspecialchars($item->date) ?> -
                                <?= $discipline ? htmlspecialchars($discipline->name) : 'N/A' ?> -
                                Ауд. <?= htmlspecialchars($item->classroom) ?> -
                                <?= $group ? htmlspecialchars($group->name) : 'N/A' ?>
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
            <p>Вы действительно хотите удалить это занятие?</p>

            <div class="info-box">
                <?php
                $discipline = null;
                $employee = null;
                $group = null;

                foreach ($disciplines as $d) {
                    if ($d->id == $scheduleItem->discipline_id) {
                        $discipline = $d;
                        break;
                    }
                }

                foreach ($employees as $e) {
                    if ($e->id == $scheduleItem->employee_id) {
                        $employee = $e;
                        break;
                    }
                }

                foreach ($groups as $g) {
                    if ($g->id == $scheduleItem->group_id) {
                        $group = $g;
                        break;
                    }
                }
                ?>
                <p><strong>Дата:</strong> <?= htmlspecialchars($scheduleItem->date) ?></p>
                <p><strong>Дисциплина:</strong> <?= $discipline ? htmlspecialchars($discipline->name) : 'N/A' ?></p>
                <p><strong>Аудитория:</strong> <?= htmlspecialchars($scheduleItem->classroom) ?></p>
                <p><strong>Преподаватель:</strong> <?= $employee ? htmlspecialchars($employee->last_name . ' ' . $employee->first_name . ' ' . $employee->middle_name) : 'N/A' ?></p>
                <p><strong>Группа:</strong> <?= $group ? htmlspecialchars($group->name) : 'N/A' ?></p>
            </div>

            <p class="warning-text">Это действие нельзя будет отменить!</p>

            <form method="post" action="<?= app()->route->getUrl('/schedule/delete') ?>" class="form-style">
                <input type="hidden" name="csrf_token" value="<?= \Src\Auth\Auth::generateCSRF() ?>">
                <input type="hidden" name="id" value="<?= $scheduleItem->id ?>">

                <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены, что хотите удалить эту запись?');">Удалить</button>
                <a href="<?= app()->route->getUrl('/schedule/delete') ?>" class="btn btn-secondary">Выбрать другое</a>
                <a href="<?= app()->route->getUrl('/schedule') ?>" class="btn btn-secondary">Отмена</a>
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
