<h1>Успеваемость студентов</h1>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Занятие</th>
        <th>Студент</th>
        <th>Вид сдачи</th>
        <th>Оценка</th>
        <th>Часы</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($grades as $grade): ?>
        <tr>
            <td><?= $grade->id ?></td>
            <td><?= $grade->schedule_id ?></td>
            <td><?= $grade->student_id ?></td>
            <td><?= $grade->type ?></td>
            <td><?= $grade->grade ?></td>
            <td><?= $grade->hours ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
