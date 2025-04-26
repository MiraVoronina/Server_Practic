<h2>Удалить оценку</h2>

<div class="form-wrapper">
    <form method="post" action="<?= app()->route->getUrl('/grades/delete') ?>" class="form-style">
        <input type="hidden" name="csrf_token" value="<?= \Src\Auth\Auth::generateCSRF() ?>">

        <label>ID оценки для удаления:
            <input type="number" name="id" required>
        </label>

        <button type="submit">Удалить</button>
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
        background-color: #f2b5a8;
        border: none;
        cursor: pointer;
        font-size: 16px;
        border-radius: 6px;
    }
    .form-style button:hover {
        background-color: #e99e8e;
    }
</style>
