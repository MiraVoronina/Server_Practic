<h2 class="page-title">Оценки</h2>
<div class="table-wrapper">
    <table class="styled-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Schedule ID</th>
            <th>Student ID</th>
            <th>Тип</th>
            <th>Оценка</th>
            <th>Часы</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($grades)): ?>
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
        <?php else: ?>
            <tr><td colspan="6" style="text-align: center;">Нет данных</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

    <div class="table-buttons">
        <a href="<?= app()->route->getUrl('/grades/add') ?>" class="btn">Добавить оценку</a>
        <a href="<?= app()->route->getUrl('/grades/edit') ?>" class="btn">Редактировать</a>
        <a href="<?= app()->route->getUrl('/grades/delete') ?>" class="btn">Удалить</a>
    </div>
</div>
