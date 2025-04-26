<h2 class="page-title">Редактировать студента</h2>

<div class="form-wrapper">
    <form method="post" action="<?= app()->route->getUrl('/students/edit') ?>" class="form-style">
        <label>ID студента:
            <input type="number" name="id" required>
        </label>

        <label>Фамилия:
            <input type="text" name="last_name" required>
        </label>

        <label>Имя:
            <input type="text" name="first_name" required>
        </label>

        <label>Отчество:
            <input type="text" name="middle_name" required>
        </label>

        <label>Адрес:
            <input type="text" name="address" required>
        </label>

        <label>Группа ID:
            <input type="number" name="group_id" required>
        </label>

        <label>Статус:
            <select name="status" required>
                <option value="studying">Учится</option>
                <option value="dismissed">Отчислен</option>
                <option value="academic_leave">Академический отпуск</option>
            </select>
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