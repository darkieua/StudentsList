<form class="form-horizontal" method="POST" action="/student/save/<? echo $student->getId(); ?>">
    <div class="form-group">
        <input type="hidden" name="id" value="<? echo $student->getId(); ?>">
        <label class="control-label col-sm-2" for="name">ФИО:</label>
        <div class="col-sm-10">
            <input required type="text" class="form-control" name="name" id="name" maxlength="50" placeholder="Фамилия, имя, отчество студента" value="<? echo $student->getName(); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="group">Группа:</label>
        <div class="col-sm-10">
            <input required type="text" class="form-control" name="group" id="group" maxlength="20" placeholder="Группа студента" value="<? echo $student->getGroup(); ?>">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Сохранить</button>
        </div>
    </div>
</form>