@extends('adminlte::page')

@section('title', 'Задания')

@section('content_header')

    <div class="row">
        <div class="col-6">
{{--            <h2 class="lead">Задания</h2>--}}
            <h1>Задания</h1>
        </div>
        <div class="col-6 text-right">
            <button class="btn btn-success btn-sm" type="button" onclick="createTask()"><i class="fas fa-lg fa-plus"></i></button>
        </div>
    </div>

    {{ Breadcrumbs::render('task.index') }}
@stop

@section('content')
    <div class="card card-solid">
        <div class="card-body">
            <table id="tasks" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Заголовок</th>
                    <th>Дата сдачи</th>
                    <th>Функция</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td><a href="{{ route('tasks.show', [$task->id]) }}">{{ $task->title }}</a></td>
                        <td>{{ $task->pivot->finished_at ?? '-' }}</td>
                        <td class="text-right">
                            <button class="btn btn-primary btn-sm btn-task-edit" onclick="editTask({{ $task->id }})"><i class="fas fa-lg fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm btn-task-delete" onclick="deleteTask({{ $task->id }})"><i class="fas fa-lg fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Заголовок</th>
                    <th>Дата сдачи</th>
                    <th>Функция</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            {!! $tasks->links() !!}
        </div>
        <!-- /.card-footer -->
    </div>

    <!-- Create Task modal -->
    <div class="modal fade" id="modal-task-create">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Создание задания</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form">
                        <div class="card-body">
                            <div class="form-group residents">
                                <label>Резиденты</label>
                                <button type="button" class="btn btn-default btn-xs btn-residents-select-all">Выбрать всех</button>
                                @foreach($residents as $resident)
                                    <div class="form-check">
                                        <input name="resident[]" id="task-create-resident-{{ $resident->id }}" type="checkbox" class="form-check-input" value="{{ $resident->id }}">
                                        <label class="form-check-label" for="task-create-resident-{{ $resident->id }}">{{ $resident->fullname }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group users">
                                <label>Команда</label>
                                <button type="button" class="btn btn-default btn-xs btn-users-select-all">Выбрать всех</button>
                                @foreach($users as $_user)
                                    <div class="form-check">
                                        <input name="user[]" id="task-create-user-{{ $_user->id }}" type="checkbox" class="form-check-input" value="{{ $_user->id }}">
                                        <label class="form-check-label" for="task-create-user-{{ $_user->id }}">{{ $_user->fullname }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="user-edit-description">Заголовок</label>
                                <input name="title" type="text" class="form-control" id="user-edit-description" placeholder="курение в кабинете">
                            </div>
                            <div class="form-group">
                                <label for="user-edit-sum">Описание</label>
                                <textarea name="description" class="form-control" id="user-edit-sum" placeholder="Убрать дом"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Дата начала:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input name="start_at" type="date" class="form-control float-right">
                                </div>
                                <!-- /.input group -->
                            </div>
                            <div class="form-group">
                                <label>Дата завершения:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input name="end_at" type="date" class="form-control float-right">
                                </div>
                                <!-- /.input group -->
                            </div>
                            <div class="form-group">
                                <label>Дата сдачи:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input name="finished_at" type="date" class="form-control float-right">
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-success btn-create">Создать</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- Edit task modal -->
    <div class="modal fade" id="modal-task-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Редактирование задания</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form">
                        <div class="card-body">
                            <div class="form-group residents">
                                <label>Резиденты</label>
                                <button type="button" class="btn btn-default btn-xs btn-residents-select-all">Выбрать всех</button>
                                @foreach($residents as $resident)
                                    <div class="form-check">
                                        <input name="resident[]" id="task-edit-resident-{{ $resident->id }}" type="checkbox" class="form-check-input" value="{{ $resident->id }}">
                                        <label class="form-check-label" for="task-edit-resident-{{ $resident->id }}">{{ $resident->fullname }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group users">
                                <label>Команда</label>
                                <button type="button" class="btn btn-default btn-xs btn-users-select-all">Выбрать всех</button>
                                @foreach($users as $_user)
                                    <div class="form-check">
                                        <input name="user[]" id="task-edit-user-{{ $_user->id }}" type="checkbox" class="form-check-input" value="{{ $_user->id }}">
                                        <label class="form-check-label" for="task-edit-user-{{ $_user->id }}">{{ $_user->fullname }}</label>
                                    </div>
                                @endforeach
                            </div>
                            <hr>
                            <div class="form-group">
                                <label for="user-edit-description">Заголовок</label>
                                <input name="title" type="text" class="form-control" id="user-edit-description" placeholder="курение в кабинете">
                            </div>
                            <div class="form-group">
                                <label for="user-edit-sum">Описание</label>
                                <textarea name="description" class="form-control" id="user-edit-sum" placeholder="Убрать дом"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Дата начала:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input name="start_at" type="date" class="form-control float-right">
                                </div>
                                <!-- /.input group -->
                            </div>
                            <div class="form-group">
                                <label>Дата завершения:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input name="end_at" type="date" class="form-control float-right">
                                </div>
                                <!-- /.input group -->
                            </div>
                            {{--                            <div class="form-group">--}}
                            {{--                                <label>Дата сдачи:</label>--}}
                            {{--                                <div class="input-group">--}}
                            {{--                                    <div class="input-group-prepend">--}}
                            {{--                                        <span class="input-group-text">--}}
                            {{--                                            <i class="far fa-calendar-alt"></i>--}}
                            {{--                                        </span>--}}
                            {{--                                    </div>--}}
                            {{--                                    <input name="finished_at" type="date" class="form-control float-right">--}}
                            {{--                                </div>--}}
                            {{--                                <!-- /.input group -->--}}
                            {{--                            </div>--}}
                        </div>
                        <!-- /.card-body -->
                        <input type="hidden" name="id" value="">
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-success btn-edit">Редактировать</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!-- Delete Task modal -->
    <div class="modal fade" id="modal-task-delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Подтвердите действие</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Подтвердите удаление</p>
                    <input type="hidden" name="task_id" value="">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-danger btn-delete">Подтверждаю</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@stop

@section('js')
    <script>

        function createTask() {
            let $modalTaskCreate = $('#modal-task-create');

            $modalTaskCreate.find('form')[0].reset();

            $modalTaskCreate.modal('show');
        }

        function editTask(taskId) {
            let $modalTaskEdit = $('#modal-task-edit');

            $modalTaskEdit.find('form')[0].reset();
            $modalTaskEdit.find('[name=id]').val(taskId);

            $.ajax({
                url : `/tasks/${taskId}`,
                method : 'GET',
                success : function (data) {
                    for (resident of data.residents) {
                        $modalTaskEdit.find(`.residents input[type=checkbox][value=${resident.id}]`).prop('checked', true);
                    }
                    for (user of data.users) {
                        $modalTaskEdit.find(`.users input[type=checkbox][value=${user.id}]`).prop('checked', true);
                    }

                    populateForm($modalTaskEdit.find('form')[0], data);

                    $modalTaskEdit.modal('show');
                }
            });
        }

        function deleteTask(taskId) {
            let $modalTaskDelete = $('#modal-task-delete');

            $modalTaskDelete.find('[name=task_id]').val(taskId);

            $modalTaskDelete.modal('show');
        }


        $(function () {

            let $modalCreateTask = $('#modal-task-create');
            let $modalEditTask = $('#modal-task-edit');
            let $modalTaskDelete = $('#modal-task-delete');

            // Create

            $modalCreateTask.find('.btn-create').click(function () {
                $.ajax({
                    url : `/tasks`,
                    method : 'POST',
                    data : $modalCreateTask.find('form').serialize(),
                    success : function () {
                        location.reload();
                    }
                });
            });

            $modalCreateTask.find('.btn-residents-select-all').click(function () {
                let $checkboxes = $modalCreateTask.find('.residents input[name=resident\\[\\]]');
                $checkboxes.prop('checked', !$checkboxes.prop("checked"));
            });
            $modalCreateTask.find('.btn-users-select-all').click(function () {
                let $checkboxes = $modalCreateTask.find('.users input[name=user\\[\\]]');
                $checkboxes.prop('checked', !$checkboxes.prop("checked"));
            });
            // $modalCreateTask.find('[name=description]').summernote();

            // Edit

            $modalEditTask.find('.btn-edit').click(function () {
                let taskId = $modalEditTask.find('[name=id]').val();

                $.ajax({
                    url : `/tasks/${taskId}`,
                    method : 'PUT',
                    data : $modalEditTask.find('form').serialize(),
                    success : function () {
                        location.reload();
                    }
                });
            });

            $modalEditTask.find('.btn-residents-select-all').click(function () {
                let $checkboxes = $modalEditTask.find('.residents input[name=resident\\[\\]]');
                $checkboxes.prop('checked', !$checkboxes.prop("checked"));
            });
            $modalEditTask.find('.btn-users-select-all').click(function () {
                let $checkboxes = $modalEditTask.find('.users input[name=user\\[\\]]');
                $checkboxes.prop('checked', !$checkboxes.prop("checked"));
            });
            // $modalEditTask.find('[name=description]').summernote();

            $modalTaskDelete.find('.btn-delete').click(function () {
                let taskId = $modalTaskDelete.find('[name=task_id]').val();

                $.ajax({
                    url : `/tasks/${taskId}`,
                    method : 'DELETE',
                    success : function () {
                        location.reload();
                    }
                });
            });

            // Datatables initializations

            $('#tasks').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": false,
                "autoWidth": false,
                "responsive": true,
                "scrollX" : true,
                "language": {
                    "url": "/datatable/Russian.json"
                }
            });
        });
    </script>
@stop