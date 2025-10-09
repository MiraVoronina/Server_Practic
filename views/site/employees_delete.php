<h2 class="page-title">Удалить сотрудника</h2>

<div class="form-wrapper">
    <?php if (!isset($employee)): ?>
        <div class="select-form">
            <h3>Выберите сотрудника для удаления:</h3>
            <form method="get" action="<?= app()->route->getUrl('/employees/delete') ?>">
                <label>Выберите сотрудника:
                    <select name="id" onchange="this.form.submit()" required>
                        <option value="">-- Выберите сотрудника --</option>
                        <?php foreach ($employees as $emp): ?>
                            <option value="<?= $emp->id ?>">
                                <?= htmlspecialchars($emp->last_name . ' ' . $emp->first_name . ' ' . $emp->middle_name) ?>
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
            <p>Вы действительно хотите удалить этого сотрудника?</p>

            <div class="info-box">
                <?php
                $position = null;
                foreach ($positions as $pos) {
                    if ($pos->id == $employee->position_id) {
                        $position = $pos;
                        break;
                    }
                }
                ?>
                <p><strong>ФИО:</strong> <?= htmlspecialchars($employee->last_name . ' ' . $employee->first_name . ' ' . $employee->middle_name) ?></p>
                <p><strong>Телефон:</strong> <?= htmlspecialchars($employee->phone) ?></p>
                <p><strong>Логин:</strong> <?= htmlspecialchars($employee->login) ?></p>
                <p><strong>Должность:</strong> <?= $position ? htmlspecialchars($position->name) : 'N/A' ?></p>
            </div>

            <p class="warning-text">Внимание! Будут также удалены все связанные записи расписания!</p>

            <form method="post" action="<?= app()->route->getUrl('/employees/delete') ?>" class="form-style">
                <input type="hidden" name="csrf_token" value="<?= \Src\Auth\Auth::generateCSRF() ?>">
                <input type="hidden" name="id" value="<?= $employee->id ?>">

                <button type="submit" class="btn btn-danger" onclick="return confirm('Вы уверены, что хотите удалить этого сотрудника?');">Удалить</button>
                <a href="<?= app()->route->getUrl('/employees/delete') ?>" class="btn btn-secondary">Выбрать другого</a>
                <a href="<?= app()->route->getUrl('/employees') ?>" class="btn btn-secondary">Отмена</a>
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
