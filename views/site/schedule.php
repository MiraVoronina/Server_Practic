<h1>Расписание занятий</h1>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Дата</th>
        <th>Время</th>
        <th>Дисциплина</th>
        <th>Аудитория</th>
        <th>Преподаватель</th>
        <th>Группа</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($schedule as $lesson): ?>
        <tr>
            <td><?= $lesson->id ?></td>
            <td><?= $lesson->date ?></td>
            <td><?= $lesson->time ?></td>
            <td><?= $lesson->discipline_id ?></td>
            <td><?= $lesson->auditorium ?></td>
            <td><?= $lesson->employee_id ?></td>
            <td><?= $lesson->group_id ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
