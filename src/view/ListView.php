<table class="table">
    <thead>
    <tr>
        <th>№</th>
        <th>ФИО</th>
        <th>Группа</th>
    </tr>
    </thead>
    <tbody>
    <tr class="student-row">
        <td class="col-md-1">--</td>
        <td class="col-md-9"><a href="/student/add/">Добавить нового студента</a></td>
        <td class="col-md-2">--</td>
    </tr>
    <? if (count($students) > 0): ?>
        <? foreach ($students as $index => $student): ?>
            <tr class="student-row">
                <td class="col-md-1"><? echo $index + 1; ?></td>
                <td class="col-md-9"><a class="student-name" href="/student/edit/<? echo $student->getId(); ?>"><? echo $student->getName(); ?></a>
                    <a class="edit-options" href="/student/remove/<? echo $student->getId(); ?>"><i   >[Удалить]</i></a>
                </td>
                <td class="col-md-2"><? echo $student->getGroup(); ?></td>
            </tr>
        <? endforeach; ?>
    <? else: ?>
        <tr class="student-row">
            <td class="col-md-1"></td>
            <td class="col-md-9">Список студентов пуст</td>
            <td class="col-md-2"></td>
        </tr>
    <? endif; ?>
    </tbody>
</table>