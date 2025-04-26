<h2 class="page-title">Студенты</h2>
<div class="table-wrapper">
    <table class="styled-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Отчество</th>
            <th>Группа</th>
            <th>Адрес</th>
            <th>Статус</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($students)): ?>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= (int)$student->id ?></td>
                    <td><?= htmlspecialchars($student->last_name, ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($student->first_name, ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($student->middle_name, ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($student->group_id, ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($student->address, ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars($student->status, ENT_QUOTES, 'UTF-8') ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="7" style="text-align: center;">Нет данных</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

    <div class="table-buttons">
        <a href="<?= app()->route->getUrl('/students/add') ?>" class="btn">Добавить студента</a>
        <a href="<?= app()->route->getUrl('/students/edit') ?>" class="btn">Редактировать</a>
        <a href="<?= app()->route->getUrl('/students/delete') ?>" class="btn">Удалить</a>
    </div>
</div>
