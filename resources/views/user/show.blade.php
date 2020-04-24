@extends('adminlte::page')

@section('title', "$user->fullname - $user->role")

@section('content_header')
{{--    <h1>{{ "$user->firstname $user->lastname $user->patronymic - $user->role" }}</h1>--}}

    {{ Breadcrumbs::render('user.show', $user) }}
@stop

@section('content')
    <div class="card bg-light w-100">
        <div class="card-header text-muted border-bottom-0">
            {{ $user->role }}
        </div>
        <div class="card-body pt-0">
            <h2 class="lead"><b>{{ "$user->fullname" }}</b></h2>
            <ul class="ml-4 mb-0 fa-ul text-muted mb-2">
                <li><span class="fa-li"><i class="fas fa-lg fa-at"></i></span> E-mail: <a
                        href="mailto:{{ $user->email }}">{{ $user->email }}</a></li>
                <li><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Телефон: <a
                        href="tel:{{ $user->phone }}">{{ $user->phone }}</a></li>
            </ul>
            <div class="text-right">
                <button class="btn btn-sm btn-default" onclick="editUser({{ $user->id }})">
                    <i class="fas fa-edit"></i> Редактировать
                </button>
                <button class="btn btn-sm btn-danger" onclick="deleteUser({{ $user->id }})">
                    <i class="fas fa-trash"></i> Удалить
                </button>
            </div>
        </div>
    </div>

    <!-- Взыскания -->
    <div class="card bg-light w-100">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-12">
                    <h2 class="lead">Взыскания</h2>
                </div>
            </div>

            <table id="punishments" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Кому</th>
                    <th>Описание</th>
                    <th>Дата выдачи</th>
                </tr>
                </thead>
                <tbody>
                @foreach($user->punishments as $punishment)
                    <tr>
                        <td>
                            @if ($punishment->resident)
                                <a href="{{ route('residents.show', [$punishment->resident->id]) }}">{{ $punishment->resident->fullname }}</a>
                            @else
                                В архиве
                            @endif
                        </td>
                        <td>{{ $punishment->description }}</td>
                        <td>{{ $punishment->start_at }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Кому</th>
                    <th>Описание</th>
                    <th>Дата выдачи</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Штрафы -->
    <div class="card bg-light w-100">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6">
                    <h2 class="lead">Штрафы</h2>
                </div>
                <div class="col-6 text-right">
                    <button class="btn btn-success btn-sm" onclick="createFine({{ $user->id }})"><i class="fas fa-lg fa-plus"></i></button>
                </div>
            </div>

            <table id="fines" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>За что</th>
                    <th>Сумма</th>
                    <th>Функция</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($user->fines as $fine)
                    <tr>
                        <td>{{ $fine->description }}</td>
                        <td>{{ $fine->sum }} грн</td>
                        <td class="text-right">
                            <button class="btn btn-primary btn-sm btn-fine-edit" onclick="editFine({{ $fine->id }})"><i class="fas fa-lg fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm btn-fine-delete" onclick="deleteFine({{ $fine->id }})"><i class="fas fa-lg fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>За что</th>
                    <th>Сумма</th>
                    <th>Функция</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Задания -->
    <div class="card bg-light w-100">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6">
                    <h2 class="lead">Задания</h2>
                </div>
                <div class="col-6 text-right">
                    <button class="btn btn-success btn-sm" type="button" onclick="createTask()"><i class="fas fa-lg fa-plus"></i></button>
                </div>
            </div>
            <table id="tasks" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Заголовок</th>
                    <th>Дата сдачи</th>
                    <th>Функция</th>
                </tr>
                </thead>
                <tbody>
                @foreach($user->tasks as $task)
                    <tr>
                        <td><a href="{{ route('tasks.show', [$task->id]) }}">{{ $task->title }}</a></td>
                        <td>{{ $task->pivot->finished_at ?? '-' }}</td>
                        <td class="text-right">
                            <button class="btn btn-success btn-sm btn-task-finish" onclick="finishTask({{ $task->id }}, {{ $user->id }})"><i class="fas fa-lg fa-check-circle"></i></button>
                            <button class="btn btn-primary btn-sm btn-task-edit" onclick="editTask({{ $task->id }})"><i class="fas fa-lg fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm btn-task-delete" onclick="deleteTask({{ $task->id }}, {{ $user->id }})"><i class="fas fa-lg fa-trash"></i></button>
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
    </div>

    <!-- Отчёты -->
    <div class="card bg-light w-100">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6">
                    <h2 class="lead">Отчёты</h2>
                </div>
                <div class="col-6 text-right">
                    @if (Auth::id() == $user->id)
                        <a href="{{ route('reports.create') }}" class="btn btn-success btn-sm"><i class="fas fa-lg fa-plus"></i></a>
                    @endif
                </div>
            </div>
            <table id="reports" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Заголовок</th>
                    <th>Функция</th>
                </tr>
                </thead>
                <tbody>
                @foreach($user->reports as $report)
                    <tr>
                        <td><a href="{{ route('reports.show', [$report->id]) }}">{{ $report->title }}</a></td>
                        <td class="text-right">
                            <a href="{{ route('reports.edit', [$report->id]) }}" class="btn btn-primary btn-sm btn-report-edit"><i class="fas fa-lg fa-edit"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Заголовок</th>
                    <th>Функция</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Edit User modal -->
    <div class="modal fade" id="modal-user-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Редактирование члена команды</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="user-edit-email">E-mail</label>
                                <input name="email" type="email" class="form-control" id="user-edit-email" placeholder="example@example.com">
                            </div>
                            <div class="form-group">
                                <label for="user-edit-firstname">Имя</label>
                                <input name="firstname" type="text" class="form-control" id="user-edit-firstname" placeholder="Имя">
                            </div>
                            <div class="form-group">
                                <label for="user-edit-lastname">Фамилия</label>
                                <input name="lastname" type="text" class="form-control" id="user-edit-lastname" placeholder="Фамилия">
                            </div>
                            <div class="form-group">
                                <label for="user-edit-patronymic">Отчество</label>
                                <input name="patronymic" type="text" class="form-control" id="user-edit-patronymic" placeholder="Отчество">
                            </div>
                            <div class="form-group">
                                <label for="user-edit-role">Должность</label>
                                <input name="role" type="text" class="form-control" id="user-edit-role" placeholder="консультант">
                            </div>
                            <div class="form-group">
                                <label for="user-edit-phone">Телефон</label>
                                <input name="phone" type="text" class="form-control" id="user-edit-phone" placeholder="+380123456789">
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <input name="id" type="hidden" value="">
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-success btn-edit">Сохранить</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Delete User modal -->
    <div class="modal fade" id="modal-user-delete">
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
                    <input type="hidden" name="user_id" value="">
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

    <!-- Edit Fine modal -->
    <form class="modal fade" id="modal-fine-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Редактирование штрафа</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="user-edit-description">За что</label>
                            <input name="description" type="text" class="form-control" id="user-edit-description" placeholder="курение в кабинете">
                        </div>
                        <div class="form-group">
                            <label for="user-edit-sum">Сумма (грн)</label>
                            <input name="sum" type="text" class="form-control" id="user-edit-sum" placeholder="500">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <input name="id" type="hidden" value="">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-success btn-edit">Сохранить</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>

    <!-- Delete Fine modal -->
    <div class="modal fade" id="modal-fine-delete">
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
                    <input type="hidden" name="id" value="">
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

    <!-- Create Fine modal -->
    <form class="modal fade" id="modal-fine-create">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Выдача штрафа</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="user-edit-description">За что</label>
                            <input name="description" type="text" class="form-control" id="user-edit-description" placeholder="курение в кабинете">
                        </div>
                        <div class="form-group">
                            <label for="user-edit-sum">Сумма (грн)</label>
                            <input name="sum" type="text" class="form-control" id="user-edit-sum" placeholder="500">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <input type="hidden" name="user_id" value="">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-success btn-create">Выдать</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>

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
                                <input name="title" type="text" class="form-control" id="user-edit-description" placeholder="Что меня сюда привело?">
                            </div>
                            <div class="form-group">
                                <label for="user-edit-sum">Описание</label>
                                <textarea name="description" class="form-control" id="user-edit-sum" placeholder="Описать причины, факторы, мотивы которые заставили меня приехать в РЦ."></textarea>
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
                                <input name="title" type="text" class="form-control" id="user-edit-description" placeholder="Что меня сюда привело?">
                            </div>
                            <div class="form-group">
                                <label for="user-edit-sum">Описание</label>
                                <textarea name="description" class="form-control" id="user-edit-sum" placeholder="Описать причины, факторы, мотивы которые заставили меня приехать в РЦ."></textarea>
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
                    <input type="hidden" name="user_id" value="">
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

        // Edit user

        function editUser(userId) {
            let $modalUserEdit = $('#modal-user-edit');
            let $editForm = $modalUserEdit.find('form');

            $.ajax({
                url : `/users/${userId}`,
                method : 'GET',
                success : function (data) {
                    populateForm($editForm[0], data);
                }
            });

            $modalUserEdit.modal('show');
        }

        $(function () {
            let $modalUserEdit = $('#modal-user-edit');
            let $form = $modalUserEdit.find('form');

            $modalUserEdit.find('.btn-edit').click(function () {
                let userId = $form.find('[name=id]').val();

                $.ajax({
                    url : `/users/${userId}`,
                    method : 'PUT',
                    data : $modalUserEdit.find('form').serialize(),
                    success : function (data) {
                        location.reload();
                    }
                })
            });
        });

        // Delete user

        function deleteUser(userId) {
            let $modalUserDelete = $('#modal-user-delete');

            $modalUserDelete.find('[name=user_id]').val(userId);

            $modalUserDelete.modal('show');
        }

        $(function () {
            let $modalUserDelete = $('#modal-user-delete');

            $modalUserDelete.find('.btn-delete').click(function () {
                let userId = $modalUserDelete.find('[name=user_id]').val();

                $.ajax({
                    url : `/users/${userId}`,
                    method : 'DELETE',
                    success : function () {
                        window.location.replace('/users');
                    }
                });
            });
        });

        /* Fines */

        // Edit fine

        function editFine(fineId) {
            let $modalFineEdit = $('#modal-fine-edit');

            $.ajax({
                url : `/fines/${fineId}`,
                method : 'GET',
                success : function (data) {
                    populateForm($modalFineEdit[0], data);

                    $modalFineEdit.modal('show');
                }
            });
        }

        $(function () {
            let $modalFineEdit = $('#modal-fine-edit');

            $modalFineEdit.validate({
                submitHandler: function () {
                    let fineId = $modalFineEdit.find('[name=id]').val();

                    $.ajax({
                        url : `/fines/${fineId}`,
                        method : 'PUT',
                        data : $modalFineEdit.serialize(),
                        success : function (data) {
                            location.reload();
                        }
                    })
                },
                rules: {
                    description: {
                        required: true
                    },
                    sum: {
                        required: true,
                        digits: true
                    }
                },
                messages: {
                    description: {
                        required: "Пожалуйста, введите за что"
                    },
                    sum: {
                        required: "Пожалуйста, введите сумму",
                        digits: "Пожалуйста, введите целое число от 0 до 999999"
                    }
                }
            });
        });

        // Delete fine
        function deleteFine(fineId) {
            let $modalFineDelete = $('#modal-fine-delete');

            $modalFineDelete.find('[name=id]').val(fineId);

            $modalFineDelete.modal('show');
        }

        function createFine(userId) {
            let $modalFineCreate = $('#modal-fine-create');

            $modalFineCreate.find('[name=user_id]').val(userId);

            $modalFineCreate.modal('show');
        }

        $(function () {
            let $modalFineDelete = $('#modal-fine-delete');
            let $modalFineCreate = $('#modal-fine-create');

            $modalFineDelete.find('.btn-delete').click(function () {
                let fineId = $modalFineDelete.find('[name=id]').val();

                $.ajax({
                    url : `/fines/${fineId}`,
                    method : 'DELETE',
                    success : function () {
                        location.reload();
                    }
                });
            });

            $modalFineCreate.validate({
                submitHandler: function () {
                    $.ajax({
                        url : `/fines`,
                        method : 'POST',
                        data : $modalFineCreate.serialize(),
                        success : function () {
                            location.reload();
                        }
                    });
                },
                rules: {
                    description: {
                        required: true
                    },
                    sum: {
                        required: true,
                        digits: true
                    }
                },
                messages: {
                    description: {
                        required: "Пожалуйста, введите за что"
                    },
                    sum: {
                        required: "Пожалуйста, введите сумму",
                        digits: "Пожалуйста, введите целое число от 0 до 999999"
                    }
                }
            });

        });

        /* Tasks */

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

        function deleteTask(taskId, userId) {
            let $modalTaskDelete = $('#modal-task-delete');

            $modalTaskDelete.find('[name=task_id]').val(taskId);
            $modalTaskDelete.find('[name=user_id]').val(userId);

            $modalTaskDelete.modal('show');
        }

        function finishTask(taskId, userId) {
            $.ajax({
                url : `/users/${userId}/tasks/${taskId}`,
                method : 'PUT',
                success : function () {
                    location.reload();
                }
            });
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
                let userId = $modalTaskDelete.find('[name=user_id]').val();

                $.ajax({
                    url : `/users/${userId}/tasks/${taskId}`,
                    method : 'DELETE',
                    success : function () {
                        location.reload();
                    }
                });
            });
        });


        // Datatables initializations

        $('#punishments').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "order": [[ 2, "desc" ]],
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "scrollX" : true,
            "language": {
                "url": "/datatable/Russian.json"
            }
        });

        $('#fines').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "scrollX" : true,
            "language": {
                "url": "/datatable/Russian.json"
            }
        });

        $('#tasks').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "scrollX" : true,
            "language": {
                "url": "/datatable/Russian.json"
            }
        });

        $('#reports').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "scrollX" : true,
            "language": {
                "url": "/datatable/Russian.json"
            }
        });
    </script>
@stop
