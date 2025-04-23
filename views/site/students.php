<h1>Список студентов</h1>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>ФИО</th>
        <th>Пол</th>
        <th>Дата рождения</th>
        <th>ID группы</th>
    </tr>
    <?php foreach ($students as $student): ?>
        <tr>
            <td><?= $student->ID_студента ?></td>
            <td><?= $student->ФИО ?></td>
            <td><?= $student->Пол ?></td>
            <td><?= $student->Дата_рождения ?></td>
            <td><?= $student->ID_группы ?></td>
        </tr>
    <?php endforeach; ?>
</table>
