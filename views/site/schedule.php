<h1>Расписание занятий</h1>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>ID дисциплины</th>
        <th>ID группы</th>
        <th>ID сотрудника</th>
        <th>Дата</th>
        <th>Время</th>
    </tr>
    <?php foreach ($schedule as $lesson): ?>
        <tr>
            <td><?= $lesson->ID_расписания ?></td>
            <td><?= $lesson->ID_дисциплины ?></td>
            <td><?= $lesson->ID_группы ?></td>
            <td><?= $lesson->ID_сотрудника ?></td>
            <td><?= $lesson->Дата ?></td>
            <td><?= $lesson->Время ?></td>
        </tr>
    <?php endforeach; ?>
</table>
