@extends('adminlte::page')

@section('title', $resident->fullname)

@section('content_header')
    <div class="row">
        <div class="col-md-6">
            {{ Breadcrumbs::render('resident.show', $resident) }}
        </div>
        <div class="col-md-6">
            <div class="text-right">
                <button type="button" class="btn btn-warning" onclick="toArchive({{ $resident->id }})">В архив</button>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="card bg-light w-100">
        <div class="card-header text-muted border-bottom-0">
            Баланс: {{ $resident->balance }}
        </div>
        <div class="card-body pt-0">
            <h2 class="lead"><b>{{ $resident->fullname }}</b></h2>
            <ul class="ml-0 mb-0 fa-ul text-muted mb-2">
                <li>Статус: {{ $resident->status }}</li>
                <li>Пол: {{ $resident->gender_title }}</li>
                <li>День рождения: {{ $resident->birthday }}</li>
                <li>Дата регистрации: {{ $resident->registered_at }}</li>
                <li>Источник поступления: {{ $resident->source }}</li>
                <li>О резиденте: {{ $resident->about }}</li>
            </ul>
        </div>
    </div>

    <!-- Назначения врачей -->
    <div class="card bg-light w-100">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6">
                    <h2 class="lead">Назначения врачей</h2>
                </div>
                <div class="col-6 text-right">
                    <button class="btn btn-success btn-sm" type="button" onclick="createDoctorAppointment({{ $resident->id }})"><i class="fas fa-lg fa-plus"></i></button>
                </div>
            </div>
            <table id="doctor-appointment" class="table table-bordered table-hover dataTable dtr-inline collapsed">
                <thead>
                <tr>
                    <th>Врач</th>
                    <th>Препарат</th>
                    <th>Схема приёма</th>
                    <th>Функция</th>
                </tr>
                </thead>
                <tbody>
                @foreach($resident->doctorAppointments as $doctorAppointment)
                    <tr>
                        <td>{{ $doctorAppointment->doctor }}</td>
                        <td>{{ $doctorAppointment->drug }}</td>
                        <td>{{ $doctorAppointment->reception_schedule }}</td>
                        <td class="text-right">
                            <button class="btn btn-primary btn-sm btn-doctor-appointment-edit" onclick="editDoctorAppointment({{ $doctorAppointment->id }}, {{ $resident->id }})"><i class="fas fa-lg fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm btn-doctor-appointment-delete" onclick="deleteDoctorAppointment({{ $doctorAppointment->id }}, {{ $resident->id }})"><i class="fas fa-lg fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Врач</th>
                    <th>Препарат</th>
                    <th>Схема приёма</th>
                    <th>Функция</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Взыскания -->
    <div class="card bg-light w-100">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6">
                    <h2 class="lead">Взыскания</h2>
                </div>
                <div class="col-6 text-right">
                    <button class="btn btn-danger btn-sm" type="button" onclick="createPunishment({{ $resident->id }})"><i class="fas fa-lg fa-skull-crossbones"></i> Взыскать</button>
                </div>
            </div>
            <table id="punishments" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Описание</th>
                    <th>Дата выдачи</th>
                    <th>Дата окончания</th>
                    <th>Дата сдачи</th>
                    <th>Функция</th>
                </tr>
                </thead>
                <tbody>
                @foreach($resident->punishments as $punishment)
                    <tr>
                        <td>{{ $punishment->description }}</td>
                        <td>{{ $punishment->start_at }}</td>
                        <td>{{ $punishment->end_at }}</td>
                        <td>{{ $punishment->finished_at }}</td>
                        <td class="text-right">
                            <button class="btn btn-success btn-sm btn-punishment-finished" onclick="finishPunishment({{ $resident->id }}, {{ $punishment->id }})"><i class="fas fa-lg fa-check-circle"></i></button>
                            <button class="btn btn-primary btn-sm btn-punishment-edit" onclick="editPunishment({{ $resident->id }}, {{ $punishment->id }})"><i class="fas fa-lg fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm btn-punishment-delete" onclick="deletePunishment({{ $resident->id }}, {{ $punishment->id }})"><i class="fas fa-lg fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Описание</th>
                    <th>Дата выдачи</th>
                    <th>Дата окончания</th>
                    <th>Дата сдачи</th>
                    <th>Функция</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Ответственности -->
    <div class="card bg-light w-100">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6">
                    <h2 class="lead">Обязанности</h2>
                </div>
                <div class="col-6 text-right">
                    <button class="btn btn-primary btn-sm" type="button" onclick="editResponsibilities({{ $resident->id }})"><i class="fas fa-lg fa-edit"></i></button>
                </div>
            </div>
            <table id="responsibilities" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Название</th>
                    <td>Описание</td>
                </tr>
                </thead>
                <tbody>
                @foreach($resident->responsibilities as $responsibility)
                    <tr>
                        <td>{{ $responsibility->name }}</td>
                        <td>{{ $responsibility->about }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Название</th>
                    <td>Описание</td>
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
                @foreach($resident->tasks as $task)
                    <tr>
                        <td><a href="{{ route('tasks.show', [$task->id]) }}">{{ $task->title }}</a></td>
                        <td>{{ $task->pivot->finished_at ?? '-' }}</td>
                        <td class="text-right">
                            <button class="btn btn-success btn-sm btn-task-finish" onclick="finishTask({{ $task->id }}, {{ $resident->id }})"><i class="fas fa-lg fa-check-circle"></i></button>
                            <button class="btn btn-primary btn-sm btn-task-edit" onclick="editTask({{ $task->id }})"><i class="fas fa-lg fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm btn-task-delete" onclick="deleteTask({{ $task->id }}, {{ $resident->id }})"><i class="fas fa-lg fa-trash"></i></button>
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

    <!-- Родственики -->
    <div class="card bg-light w-100">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6">
                    <h2 class="lead">Родственики</h2>
                </div>
                <div class="col-6 text-right">
                    <button class="btn btn-success btn-sm" type="button" onclick="createParent({{ $resident->id }})"><i class="fas fa-lg fa-plus"></i></button>
                </div>
            </div>
            <div class="row d-flex align-items-stretch">
                @each('resident_parent.component.card', $resident->parents, 'parent')
            </div>
        </div>
    </div>

    <!-- Заметки -->
    <div class="card bg-light w-100">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6">
                    <h2 class="lead">Заметки</h2>
                </div>
                <div class="col-6 text-right">
                    <button class="btn btn-success btn-sm" type="button" onclick="createNote({{ $resident->id }})"><i class="fas fa-lg fa-plus"></i></button>
                </div>
            </div>

            @foreach($resident->notes as $note)
                <div class="post">
                    <div class="user-block">
                        <span class="username ml-0">
                            @if ($note->user)
                                <a href="{{ route('users.show', [$note->user->id]) }}">{{ $note->user->fullname }}</a>
                            @else
                                <span>Пользователь удалён</span>
                            @endif
                            <a class="float-right btn-tool" onclick="deleteNote({{ $resident->id }}, {{ $note->id }})"><i class="fas fa-times"></i></a>
                        </span>
                        <span class="description ml-0">{{ $note->created_at }}</span>
                    </div>
                    <!-- /.user-block -->
                    <p>
                        {{ $note->content }}
                    </p>
                </div>
            @endforeach
        </div>
{{--        <div class="card-footer text-center">--}}
{{--            <a href="#">Показать все</a>--}}
{{--        </div>--}}
    </div>

    <!-- Create Doctor Appointment modal -->
    <form class="modal fade" id="modal-doctor-appointment-create" novalidate="novalidate">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Добавление назначения врача</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Доктор</label>
                            <input name="doctor" type="text" class="form-control" placeholder="Иван Михалыч">
                        </div>
                        <div class="form-group">
                            <label>Препарат</label>
                            <input name="drug" type="text" class="form-control" placeholder="респалепт">
                        </div>
                        <div class="form-group">
                            <label>Схема приёма</label>
                            <textarea name="reception_schedule" class="form-control" placeholder="0.25"></textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <input type="hidden" name="resident_id" value="">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-success">Добавить</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>

    <!-- Edit Doctor Appointment modal -->
    <form class="modal fade" id="modal-doctor-appointment-edit" novalidate="novalidate">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Редактирование назначения врача</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Доктор</label>
                            <input name="doctor" type="text" class="form-control" placeholder="Иван Михалыч">
                        </div>
                        <div class="form-group">
                            <label>Препарат</label>
                            <input name="drug" type="text" class="form-control" placeholder="респалепт">
                        </div>
                        <div class="form-group">
                            <label>Схема приёма</label>
                            <textarea name="reception_schedule" class="form-control" placeholder="0.25"></textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <input type="hidden" name="doctor_appointment_id" value="">
                    <input type="hidden" name="resident_id" value="">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-success">Редактировать</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>

    <!-- Delete Doctor Appointment modal -->
    <form class="modal fade" id="modal-doctor-appointment-delete">
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
                    <input type="hidden" name="resident_id" value="">
                    <input type="hidden" name="doctor_appointment_id" value="">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-danger btn-delete">Подтверждаю</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>
    <!-- /.modal -->

    <!-- Create Punishment modal -->
    <form class="modal fade" id="modal-punishment-create" novalidate="novalidate">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Добавление взыскания</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Описание</label>
                            <textarea name="description" class="form-control" placeholder="не выключил свет в туалете"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Дата начала</label>
                            <input name="start_at" type="date" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Дата завершения</label>
                            <input name="end_at" type="date" class="form-control" placeholder="">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <input type="hidden" name="resident_id" value="">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-success">Добавить</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>

    <!-- Edit Punishment modal -->
    <form class="modal fade" id="modal-punishment-edit" novalidate="novalidate">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Редактирование взыскания</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Описание</label>
                            <textarea name="description" class="form-control" placeholder="не выключил свет в туалете"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Дата начала</label>
                            <input name="start_at" type="date" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Дата завершения</label>
                            <input name="end_at" type="date" class="form-control" placeholder="">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <input type="hidden" name="resident_id" value="">
                    <input type="hidden" name="punishment_id" value="">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-success">Редактировать</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>

    <!-- Delete Punishment modal -->
    <form class="modal fade" id="modal-punishment-delete">
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
                    <input type="hidden" name="resident_id" value="">
                    <input type="hidden" name="punishment_id" value="">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-danger btn-delete">Подтверждаю</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>
    <!-- /.modal -->

    <!-- Edit Responsibilities modal -->
    <form class="modal fade" id="modal-responsibilities-edit" novalidate="novalidate">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Редактирование обязанностей</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <button type="button" class="btn btn-default btn-xs btn-responsibilities-select-all">Выбрать всех</button>
                        </div>
                        @foreach($responsibilities as $responsibility)
                            <div class="form-check">
                                <input type="checkbox" value="{{ $responsibility->id }}" id="responsibility-{{ $responsibility->id }}" name="responsibility[]" class="form-check-input">
                                <label class="form-check-label" for="responsibility-{{ $responsibility->id }}">{{ $responsibility->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    <!-- /.card-body -->
                    <input type="hidden" name="resident_id" value="">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-success">Редактировать</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>

    <!-- Create Task modal -->
    <form class="modal fade" id="modal-task-create">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Создание задания</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
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
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-success btn-create">Создать</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>

    <!-- Edit task modal -->
    <form class="modal fade" id="modal-task-edit">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Редактирование задания</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
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
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-success btn-edit">Редактировать</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>

    <!-- Create Parent modal -->
    <form class="modal fade" id="modal-parent-create" novalidate="novalidate">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Создание родственика</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Имя</label>
                            <input name="firstname" class="form-control" placeholder="Иван">
                        </div>
                        <div class="form-group">
                            <label>Фамилия</label>
                            <input name="lastname" class="form-control" placeholder="Иванов">
                        </div>
                        <div class="form-group">
                            <label>Отчество</label>
                            <input name="patronimyc" class="form-control" placeholder="Иванович">
                        </div>
                        <div class="form-group">
                            <label>Пол</label>
                            <div class="form-check">
                                <input value="1" class="form-check-input" type="radio" name="gender" id="modal-parent-create-gender-male">
                                <label class="form-check-label" for="modal-parent-create-gender-male">мужской</label>
                            </div>
                            <div class="form-check">
                                <input value="0" class="form-check-input" type="radio" name="gender" id="modal-parent-create-gender-female">
                                <label class="form-check-label" for="modal-parent-create-gender-female">женский</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Кем приходится</label>
                            <input name="role" class="form-control" placeholder="мать">
                        </div>
                        <div class="form-group">
                            <label>День рождения</label>
                            <input name="birthday" type="date" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label>Телефон</label>
                            <input name="phone" class="form-control" placeholder="+380123456789">
                        </div>
                        <div class="form-group">
                            <label>Дополнительная информация</label>
                            <textarea name="about" class="form-control" placeholder="созависимая"></textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <input type="hidden" name="resident_id" value="">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-success">Редактировать</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>

    <!-- Create Note modal -->
    <form class="modal fade" id="modal-note-create" novalidate="novalidate">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Создание заметки</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Содержимое</label>
                            <textarea name="content" class="form-control summernote" placeholder="решил бросить курить"></textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <input type="hidden" name="resident_id" value="">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-success">Создать</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>

    <!-- Delete Note modal -->
    <form class="modal fade" id="modal-note-delete">
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
                    <input type="hidden" name="resident_id" value="">
                    <input type="hidden" name="note_id" value="">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-danger btn-delete">Подтверждаю</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>
    <!-- /.modal -->

    <!-- Resident To Archive confirmation modal -->
    <form class="modal fade" id="modal-to-archive">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Подтвердите действие</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Подтвердите перемещение в архив</p>
                    <input type="hidden" name="resident_id" value="">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-danger btn-delete">Подтверждаю</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>
    <!-- /.modal -->
@stop

@section('js')
    <script>

        // Doctor appointments
        function createDoctorAppointment(residentId) {
            let $modalDoctorAppointmentCreate = $('#modal-doctor-appointment-create');

            $modalDoctorAppointmentCreate[0].reset();
            $modalDoctorAppointmentCreate.find('[name=resident_id]').val(residentId);

            $modalDoctorAppointmentCreate.modal('show');
        }

        function editDoctorAppointment(doctorAppointmentId, residentId) {
            let $modalDoctorAppointmentEdit = $('#modal-doctor-appointment-edit');

            $modalDoctorAppointmentEdit[0].reset();
            $modalDoctorAppointmentEdit.find('[name=doctor_appointment_id]').val(doctorAppointmentId);
            $modalDoctorAppointmentEdit.find('[name=resident_id]').val(residentId);

            $.ajax({
                url : `/residents/${residentId}/doctor_appointment/${doctorAppointmentId}`,
                method : 'GET',
                success : function (data) {
                    populateForm($modalDoctorAppointmentEdit[0], data);

                    $modalDoctorAppointmentEdit.modal('show');
                }
            });
        }

        function deleteDoctorAppointment(doctorAppointmentId, residentId) {
            let $modalDoctorAppointmentDelete = $('#modal-doctor-appointment-delete');

            $modalDoctorAppointmentDelete.find('[name=doctor_appointment_id]').val(doctorAppointmentId);
            $modalDoctorAppointmentDelete.find('[name=resident_id]').val(residentId);

            $modalDoctorAppointmentDelete.modal('show');
        }

        $(function () {
            let $modalDoctorAppointmentCreate = $('#modal-doctor-appointment-create');
            let $modalDoctorAppointmentEdit = $('#modal-doctor-appointment-edit');
            let $modalDoctorAppointmentDelete = $('#modal-doctor-appointment-delete');

            $modalDoctorAppointmentCreate.validate({
                submitHandler: function () {
                    let residentId = $modalDoctorAppointmentCreate.find('[name=resident_id]').val();

                    $.ajax({
                        url : `/residents/${residentId}/doctor_appointment`,
                        method : 'POST',
                        data : $modalDoctorAppointmentCreate.serialize(),
                        success : function () {
                            location.reload();
                        }
                    });
                },
                rules: {
                    doctor: {
                        required: true,
                    },
                    drug: {
                        required: true,
                    },
                    reception_schedule: {
                        required: true,
                    },
                },
                messages: {
                    doctor: {
                        required: "Пожалуйста, введите доктора",
                    },
                    drug: {
                        required: "Пожалуйста, введите препорат",
                    },
                    reception_schedule: {
                        required: "Пожалуйста, введите схему приёма",
                    }
                },
            });

            $modalDoctorAppointmentEdit.validate({
                submitHandler: function () {
                    let residentId = $modalDoctorAppointmentEdit.find('[name=resident_id]').val();
                    let doctorAppointmentId = $modalDoctorAppointmentEdit.find('[name=doctor_appointment_id]').val();

                    $.ajax({
                        url : `/residents/${residentId}/doctor_appointment/${doctorAppointmentId}`,
                        method : 'PUT',
                        data : $modalDoctorAppointmentEdit.serialize(),
                        success : function () {
                            location.reload();
                        }
                    });
                },
                rules: {
                    doctor: {
                        required: true,
                    },
                    drug: {
                        required: true,
                    },
                    reception_schedule: {
                        required: true,
                    },
                },
                messages: {
                    doctor: {
                        required: "Пожалуйста, введите доктора",
                    },
                    drug: {
                        required: "Пожалуйста, введите препорат",
                    },
                    reception_schedule: {
                        required: "Пожалуйста, введите схему приёма",
                    }
                },
            });

            $modalDoctorAppointmentDelete.submit(function () {
                let doctorAppointmentId = $modalDoctorAppointmentDelete.find('[name=doctor_appointment_id]').val();
                let residentId = $modalDoctorAppointmentDelete.find('[name=resident_id]').val();

                $.ajax({
                    url : `/residents/${residentId}/doctor_appointment/${doctorAppointmentId}`,
                    method : 'DELETE',
                    success : function () {
                        location.reload();
                    }
                });

                return false;
            });
        });

        // Punishments

        function createPunishment(residentId) {
            let $modalPunishmentCreate = $('#modal-punishment-create');

            $modalPunishmentCreate.find('[name=resident_id]').val(residentId);

            $modalPunishmentCreate.modal('show');
        }

        function editPunishment(residentId, punishmentId) {
            let $modalPunishmentEdit = $('#modal-punishment-edit');

            $modalPunishmentEdit.find('[name=resident_id]').val(residentId);
            $modalPunishmentEdit.find('[name=punishment_id]').val(punishmentId);

            $.ajax({
                url : `/residents/${residentId}/punishments/${punishmentId}`,
                method : 'GET',
                success : function (data) {
                    populateForm($modalPunishmentEdit[0], data);

                    $modalPunishmentEdit.modal('show');
                }
            });
        }

        function deletePunishment(residentId, punishmentId) {
            let $modalPunishmentDelete = $('#modal-punishment-delete');

            $modalPunishmentDelete.find('[name=resident_id]').val(residentId);
            $modalPunishmentDelete.find('[name=punishment_id]').val(punishmentId);

            $modalPunishmentDelete.modal('show');
        }

        function finishPunishment(residentId, punishmentId) {
            $.ajax({
                url : `/residents/${residentId}/punishments/${punishmentId}/update_finished_at`,
                method : 'PUT',
                success: function (data) {
                    location.reload();
                }
            });
        }

        $(function () {
            let $modalPunishmentCreate = $('#modal-punishment-create');
            let $modalPunishmentEdit = $('#modal-punishment-edit');
            let $modalPunishmentDelete = $('#modal-punishment-delete');

            $modalPunishmentCreate.validate({
                submitHandler: function () {
                    let residentId = $modalPunishmentCreate.find('[name=resident_id]').val();

                    $.ajax({
                        url : `/residents/${residentId}/punishments`,
                        method : 'POST',
                        data : $modalPunishmentCreate.serialize(),
                        success : function () {
                            location.reload();
                        }
                    });
                },
                rules: {
                    description: {
                        required: true,
                    },
                    start_at: {
                        required: true
                    },
                    end_at: {
                        required: true
                    }
                },
                messages: {
                    description: {
                        required: "Пожалуйста, введите описание",
                    },
                    start_at: {
                        required: "Пожалуйста, введите дату начала",
                    },
                    // end_at: {
                    //     required: "Пожалуйста, введите дату окончания",
                    // },
                },
            });

            $modalPunishmentEdit.validate({
                submitHandler: function () {
                    let residentId = $modalPunishmentEdit.find('[name=resident_id]').val();
                    let punishmentId = $modalPunishmentEdit.find('[name=punishment_id]').val();

                    $.ajax({
                        url : `/residents/${residentId}/punishments/${punishmentId}`,
                        method : 'PUT',
                        data : $modalPunishmentEdit.serialize(),
                        success : function () {
                            location.reload();
                        }
                    });
                },
                rules: {
                    description: {
                        required: true,
                    },
                    start_at: {
                        required: true
                    },
                    end_at: {
                        required: true
                    }
                },
                messages: {
                    description: {
                        required: "Пожалуйста, введите описание",
                    },
                    start_at: {
                        required: "Пожалуйста, введите дату начала",
                    },
                    end_at: {
                        required: "Пожалуйста, введите дату окончания",
                    },
                },
            });

            $modalPunishmentDelete.submit(function () {
                let punishmentId = $modalPunishmentDelete.find('[name=punishment_id]').val();
                let residentId = $modalPunishmentDelete.find('[name=resident_id]').val();

                $.ajax({
                    url : `/residents/${residentId}/punishments/${punishmentId}`,
                    method : 'DELETE',
                    success : function () {
                        location.reload();
                    }
                });

                return false;
            });
        });

        // Responsibilities

        function editResponsibilities(residentId) {
            let $modalResponsibilitiesEdit = $('#modal-responsibilities-edit');

            $.ajax({
                url : `/residents/${residentId}/responsibilities`,
                method : 'GET',
                success : function (data) {
                    $modalResponsibilitiesEdit.find('[name=resident_id]').val(residentId);
                    for (responsibility of data) {
                        $modalResponsibilitiesEdit.find(`input[type=checkbox][value=${responsibility.id}]`).prop('checked', true);
                    }

                    $modalResponsibilitiesEdit.modal('show');
                }
            });
        }

        $(function () {
            let $modalResponsibilitiesEdit = $('#modal-responsibilities-edit');

            $modalResponsibilitiesEdit.find('.btn-responsibilities-select-all').click(function () {
                let $checkboxes = $modalResponsibilitiesEdit.find('input[name=responsibility\\[\\]]');
                $checkboxes.prop('checked', !$checkboxes.prop("checked"));
            });

            $modalResponsibilitiesEdit.submit(function () {
                let residentId = $modalResponsibilitiesEdit.find('[name=resident_id]').val();

                // sync resident responsibilities
                $.ajax({
                    url : `/residents/${residentId}/responsibilities`,
                    method : 'POST',
                    data : $modalResponsibilitiesEdit.serialize(),
                    success : function () {
                        location.reload();
                    }
                });

                return false;
            });
        });

        // Tasks

        function createTask() {
            let $modalTaskCreate = $('#modal-task-create');

            $modalTaskCreate[0].reset();

            $modalTaskCreate.modal('show');
        }

        function editTask(taskId) {
            let $modalTaskEdit = $('#modal-task-edit');

            $modalTaskEdit[0].reset();
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

        function deleteTask(taskId, residentId) {
            let $modalTaskDelete = $('#modal-task-delete');

            $modalTaskDelete.find('[name=task_id]').val(taskId);
            $modalTaskDelete.find('[name=resident_id]').val(residentId);

            $modalTaskDelete.modal('show');
        }

        function finishTask(taskId, residentId) {
            $.ajax({
                url : `/residents/${residentId}/tasks/${taskId}`,
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

            $modalCreateTask.validate({
                submitHandler: function () {
                    $.ajax({
                        url : `/tasks`,
                        method : 'POST',
                        data : $modalCreateTask.serialize(),
                        success : function () {
                            location.reload();
                        }
                    });
                },
                rules: {
                    title: {
                        required: true
                    },
                    description: {
                        required: true
                    },
                    start_at: {
                        required: true
                    },
                    end_at: {
                        required: true
                    },
                },
                messages: {
                    title: {
                        required: "Пожалуйста, введите заголовок"
                    },
                    description: {
                        required: "Пожалуйста, введите описание"
                    },
                    start_at: {
                        required: "Пожалуйста, выберете дату начала"
                    },
                    end_at: {
                        required: "Пожалуйста, выберете дату окончания"
                    },
                }
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

            $modalEditTask.validate({
                submitHandler: function () {
                    let taskId = $modalEditTask.find('[name=id]').val();

                    $.ajax({
                        url : `/tasks/${taskId}`,
                        method : 'PUT',
                        data : $modalEditTask.serialize(),
                        success : function () {
                            location.reload();
                        }
                    });
                    return false;
                },
                rules: {
                    title: {
                        required: true
                    },
                    description: {
                        required: true
                    },
                    start_at: {
                        required: true
                    },
                    end_at: {
                        required: true
                    },
                },
                messages: {
                    title: {
                        required: "Пожалуйста, введите заголовок"
                    },
                    description: {
                        required: "Пожалуйста, введите описание"
                    },
                    start_at: {
                        required: "Пожалуйста, выберете дату начала"
                    },
                    end_at: {
                        required: "Пожалуйста, выберете дату окончания"
                    },
                }
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
                let residentId = $modalTaskDelete.find('[name=resident_id]').val();

                $.ajax({
                    url : `/residents/${residentId}/tasks/${taskId}`,
                    method : 'DELETE',
                    success : function () {
                        location.reload();
                    }
                });
            });
        });

        // Parents

        function createParent(residentId) {
            let $modalParentCreate = $('#modal-parent-create');

            $modalParentCreate.find('[name=resident_id]').val(residentId);

            $modalParentCreate.modal('show');
        }

        $(function () {
            let $modalParentCreate = $('#modal-parent-create');

            $modalParentCreate.validate({
                submitHandler: function () {
                    let residentId = $modalParentCreate.find('[name=resident_id]').val();

                    $.ajax({
                        url : `/residents/${residentId}/parents`,
                        method : 'POST',
                        data : $modalParentCreate.serialize(),
                        success : function () {
                            location.reload();
                        }
                    });
                },
                rules: {
                    firstname: {
                        required: true,
                    },
                    lastname: {
                        required: true
                    },
                    patronimyc: {
                        required: true
                    },
                    gender: {
                        required: true
                    },
                    role: {
                        required: true
                    },
                    birthday: {
                        required: true
                    },
                    phone: {
                        required: true
                    },
                    // about: {
                    //     required: true
                    // }
                },
                messages: {
                    firstname: {
                        required: "Пожалуйста, введите имя",
                    },
                    lastname: {
                        required: "Пожалуйста, введите фамилию",
                    },
                    patronimyc: {
                        required: "Пожалуйста, введите отчество",
                    },
                    gender: {
                        required: "Пожалуйста, выберете пол",
                    },
                    role: {
                        required: "Пожалуйста, введите кем приходится",
                    },
                    birthday: {
                        required: "Пожалуйста, введите дату рождения",
                    },
                    phone: {
                        required: "Пожалуйста, введите номер телефона",
                    },
                    // about: {
                    //     required: "Пожалуйста, введите ",
                    // },
                },
            });
        });


        // Notes

        function createNote(residentId) {
            let $modalNoteCreate = $('#modal-note-create');

            $modalNoteCreate.find('[name=resident_id]').val(residentId);

            $modalNoteCreate.modal('show');
        }

        function deleteNote(residentId, noteId) {
            let $modalNoteCreate = $('#modal-note-delete');

            $modalNoteCreate.find('[name=note_id]').val(noteId);
            $modalNoteCreate.find('[name=resident_id]').val(residentId);

            $modalNoteCreate.modal('show');
        }

        $(function () {
            let $modalNoteCreate = $('#modal-note-create');
            let $modalNoteDelete = $('#modal-note-delete');

            // $modalNoteCreate.find('.summernote').summernote();

            $modalNoteCreate.validate({
                submitHandler: function () {
                    let residentId = $modalNoteCreate.find('[name=resident_id]').val();

                    $.ajax({
                        url : `/residents/${residentId}/notes`,
                        method : 'POST',
                        data : $modalNoteCreate.serialize(),
                        success : function () {
                            location.reload();
                        }
                    });
                },
                rules: {
                    content: {
                        required: true,
                    }
                },
                messages: {
                    content: {
                        required: "Пожалуйста, введите содержимое",
                    }
                },
            });

            $modalNoteDelete.submit(function () {
                let noteId = $modalNoteDelete.find('[name=note_id]').val();
                let residentId = $modalNoteDelete.find('[name=resident_id]').val();

                $.ajax({
                    url : `/residents/${residentId}/notes/${noteId}`,
                    method : 'DELETE',
                    success : function () {
                        location.reload();
                    }
                });

                return false;
            });
        });

        // Archive

        function toArchive(residentId) {
            let $modalToArchive = $('#modal-to-archive');

            $modalToArchive.find('[name=resident_id]').val(residentId);

            $modalToArchive.modal('show');
        }

        $(function () {
            let $modalToArchive = $('#modal-to-archive');

            $modalToArchive.submit(function () {
                let residentId = $modalToArchive.find('[name=resident_id]').val();

                $.ajax({
                    url : `/residents/${residentId}`,
                    method : 'DELETE',
                    success : function () {
                        window.location = `/archive/${residentId}`;
                    }
                });

                return false;
            });
        });


        // Datatables initializations

        $(function () {
            $('#punishments').DataTable({
                "paging": true,
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

            $('#responsibilities').DataTable({
                "paging": true,
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

            $('#doctor-appointment').DataTable({
                "paging": true,
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
