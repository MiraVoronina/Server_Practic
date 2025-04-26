<h2 class="page-title">Редактировать расписание</h2>

<div class="form-wrapper">
    <form method="post" action="<?= app()->route->getUrl('/schedule/edit') ?>" class="form-style">
        <input type="hidden" name="csrf_token" value="<?= \Src\Auth\Auth::generateCSRF() ?>">

        <label>ID занятия:
            <input type="number" name="id" required>
        </label>

        <label>Дата:
            <input type="date" name="date" required>
        </label>

        <label>Дисциплина ID:
            <input type="number" name="discipline_id" required>
        </label>

        <label>Аудитория:
            <input type="text" name="classroom" required>
        </label>

        <label>Преподаватель ID:
            <input type="number" name="employee_id" required>
        </label>

        <label>Группа ID:
            <input type="number" name="group_id" required>
        </label>

        <button type="submit" class="btn">Сохранить изменения</button>
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