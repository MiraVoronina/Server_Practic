<h2 class="page-title">Сотрудники</h2>
<div class="table-wrapper">
    <table class="styled-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Фамилия</th>
            <th>Имя</th>
            <th>Отчество</th>
            <th>Телефон</th>
            <th>Должность</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($employees)): ?>
            <?php foreach ($employees as $employee): ?>
                <tr>
                    <td><?= $employee->id ?></td>
                    <td><?= $employee->last_name ?></td>
                    <td><?= $employee->first_name ?></td>
                    <td><?= $employee->middle_name ?></td>
                    <td><?= $employee->phone ?></td>
                    <td><?= $employee->position_name ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="6" style="text-align: center;">Нет данных</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

    <div class="table-buttons">
        <a href="<?= app()->route->getUrl('/employees/add') ?>" class="btn">Добавить сотрудника</a>
        <a href="<?= app()->route->getUrl('/employees/edit') ?>" class="btn">Редактировать</a>
        <a href="<?= app()->route->getUrl('/employees/delete') ?>" class="btn">Удалить</a>
    </div>
</div>
