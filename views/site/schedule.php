<?php

use Model\Discipline;
use Model\Group;
use Model\Employee;
?>

<h2 class="page-title">Расписание</h2>

<div class="table-wrapper">
    <table class="styled-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Дата</th>
            <th>Дисциплина</th>
            <th>Аудитория</th>
            <th>Преподаватель</th>
            <th>Группа</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($schedule)): ?>
            <?php foreach ($schedule as $lesson): ?>
                <tr>
                    <td><?= $lesson->id ?></td>
                    <td><?= $lesson->date ?></td>
                    <td><?= Discipline::find($lesson->discipline_id)->name ?? 'Нет данных' ?></td>
                    <td><?= $lesson->classroom ?></td>
                    <td>
                        <?php
                        $employee = Employee::find($lesson->employee_id);
                        echo $employee ? $employee->last_name . ' ' . $employee->first_name : 'Нет данных';
                        ?>
                    </td>
                    <td><?= Group::find($lesson->group_id)->name ?? 'Нет данных' ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="6" style="text-align: center;">Нет данных</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

    <div class="table-buttons">
        <a href="<?= app()->route->getUrl('/schedule/add') ?>" class="btn">Добавить расписание</a>
        <a href="<?= app()->route->getUrl('/schedule/edit') ?>" class="btn">Редактировать</a>
        <a href="<?= app()->route->getUrl('/schedule/delete') ?>" class="btn">Удалить</a>
    </div>
</div>
