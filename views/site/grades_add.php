<h2 class="page-title">Добавить оценку</h2>

<div class="form-wrapper">
    <form method="post" action="<?= app()->route->getUrl('/grades/add') ?>" class="form-style">
        <input type="hidden" name="csrf_token" value="<?= \Src\Auth\Auth::generateCSRF() ?>">

        <label>Schedule ID:
            <input type="number" name="schedule_id" required>
        </label>

        <label>Student ID:
            <input type="number" name="student_id" required>
        </label>

        <label>Тип (например, "exam" или "credit"):
            <input type="text" name="type" required>
        </label>

        <label>Оценка:
            <input type="number" name="grade" required>
        </label>

        <label>Часы:
            <input type="number" name="hours" required>
        </label>

        <button type="submit" class="btn">Сохранить</button>
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
    .btn {
        padding: 10px 20px;
        background-color: #f2e9e4;
        border: 2px solid #e0dcd7;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        margin-top: 10px;
        transition: background-color 0.3s, transform 0.2s;
        border-radius: 6px;
    }
    .btn:hover {
        background-color: #e0dcd7;
        transform: scale(1.05);
    }
</style>
