@extends('adminlte::page')

@section('title', $resident->fullname)

@section('content_header')
    {{ Breadcrumbs::render('resident.show', $resident) }}
@stop

@section('content')
    <div class="card bg-light w-100">
        <div class="card-header text-muted border-bottom-0">
            Баланс: {{ $resident->balance }}
        </div>
        <div class="card-body pt-0">
            <h2 class="lead"><b>{{ "$resident->fullname" }}</b></h2>
            <ul class="ml-0 mb-0 fa-ul text-muted mb-2">
                <li>Статус: {{ $resident->status }}</li>
                <li>Пол: {{ $resident->gender_title }}</li>
                <li>Телефон: <a href="tel:{{ $resident->phone }}">{{ $resident->phone }}</a></li>
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
                    <button class="btn btn-danger btn-sm" type="button" onclick="createPunishments()"><i class="fas fa-lg fa-skull-crossbones"></i> Взыскать</button>
                </div>
            </div>
            <table id="punishments" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Описание</th>
                    <th>Дата выдачи</th>
                </tr>
                </thead>
                <tbody>
                @foreach($resident->punishments as $punishment)
                    <tr>
                        <td>{{ $punishment->description }}</td>
                        <td>{{ $punishment->start_at }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Описание</th>
                    <th>Дата выдачи</th>
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
                    <button class="btn btn-primary btn-sm" type="button" onclick="editResponsibilities()"><i class="fas fa-lg fa-edit"></i></button>
                </div>
            </div>
            <table id="responsibilities" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Название</th>
                </tr>
                </thead>
                <tbody>
                @foreach($resident->responsibilities as $responsibility)
                    <tr>
                        <td>{{ $responsibility->name }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Название</th>
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
                    <button class="btn btn-success btn-sm" type="button" onclick="createParent()"><i class="fas fa-lg fa-plus"></i></button>
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
                    <button class="btn btn-success btn-sm" type="button" onclick="createNote()"><i class="fas fa-lg fa-plus"></i></button>
                </div>
            </div>

            @foreach($resident->notes->take(5) as $note)
                <div class="post">
                    <div class="user-block">
                        <span class="username ml-0">
                              <a href="{{ route('users.show', [$note->user->id]) }}">{{ $note->user->fullname }}</a>
                              <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
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
        <div class="card-footer text-center">
            <a href="#">Показать все</a>
        </div>
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

    <!-- Delete Task modal -->
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
                        required: "Пожалуйста введите доктора",
                    },
                    drug: {
                        required: "Пожалуйста введите препорат",
                    },
                    reception_schedule: {
                        required: "Пожалуйста введите схему приёма",
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
                        required: "Пожалуйста введите доктора",
                    },
                    drug: {
                        required: "Пожалуйста введите препорат",
                    },
                    reception_schedule: {
                        required: "Пожалуйста введите схему приёма",
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
