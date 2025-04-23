<h1>Посещаемость</h1>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>ID студента</th>
        <th>ID расписания</th>
        <th>Статус</th>
    </tr>
    <?php foreach ($attendance as $a): ?>
        <tr>
            <td><?= $a->ID_посещаемости ?></td>
            <td><?= $a->ID_студента ?></td>
            <td><?= $a->ID_расписания ?></td>
            <td><?= $a->Статус ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<h1 style="margin-top: 40px;">Успеваемость</h1>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>ID студента</th>
        <th>ID дисциплины</th>
        <th>Оценка</th>
    </tr>
    <?php foreach ($performance as $p): ?>
        <tr>
            <td><?= $p->ID_успеваемости ?></td>
            <td><?= $p->ID_студента ?></td>
            <td><?= $p->ID_дисциплины ?></td>
            <td><?= $p->Оценка ?></td>
        </tr>
    <?php endforeach; ?>
</table>
