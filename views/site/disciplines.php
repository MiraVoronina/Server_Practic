<h1>Список дисциплин</h1>

<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Название</th>
    </tr>
    <?php foreach ($disciplines as $discipline): ?>
        <tr>
            <td><?= $discipline->ID_дисциплины ?></td>
            <td><?= $discipline->Название ?></td>
        </tr>
    <?php endforeach; ?>
</table>
