<h1>Список сотрудников</h1>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>Отчество</th>
        <th>Логин</th>
        <th>Телефон</th>
        <th>Должность</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($employees as $employee): ?>
        <tr>
            <td><?= $employee->id ?></td>
            <td><?= $employee->first_name ?></td>
            <td><?= $employee->last_name ?></td>
            <td><?= $employee->middle_name ?></td>
            <td><?= $employee->login ?></td>
            <td><?= $employee->phone ?></td>
            <td><?= $employee->position_id ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
