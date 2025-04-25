<h1>Список студентов</h1>
<table>
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
    <?php foreach ($students as $student): ?>
        <tr>
            <td><?= $student->id ?></td>
            <td><?= $student->last_name ?></td>
            <td><?= $student->first_name ?></td>
            <td><?= $student->middle_name ?></td>
            <td><?= $student->group_id ?></td>
            <td><?= $student->address ?></td>
            <td><?= $student->status ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
