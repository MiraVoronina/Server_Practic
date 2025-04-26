<h2>Редактировать оценку</h2>

<div class="form-wrapper">
    <form method="post" action="<?= app()->route->getUrl('/grades/edit') ?>" class="form-style">
        <input type="hidden" name="csrf_token" value="<?= \Src\Auth\Auth::generateCSRF() ?>">

        <label>ID оценки:
            <input type="number" name="id" required>
        </label>

        <label>Schedule ID:
            <input type="number" name="schedule_id" required>
        </label>

        <label>Student ID:
            <input type="number" name="student_id" required>
        </label>

        <label>Тип:
            <input type="text" name="type" placeholder="exam или credit" required>
        </label>

        <label>Оценка:
            <input type="number" name="grade" required>
        </label>

        <label>Часы:
            <input type="number" name="hours" required>
        </label>

        <button type="submit">Сохранить изменения</button>
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
    .form-style button {
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #e0dcd7;
        border: none;
        cursor: pointer;
        font-size: 16px;
        border-radius: 6px;
    }
    .form-style button:hover {
        background-color: #d6cfc9;
    }
</style>
