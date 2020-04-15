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
                <li>Пол: {{ $resident->gender }}</li>
                <li>Телефон: <a href="tel:{{ $resident->phone }}">{{ $resident->phone }}</a></li>
                <li>День рождения: {{ $resident->birthday }}</li>
                <li>Дата регистрации: {{ $resident->registered_at }}</li>
                <li>Источник поступления: {{ $resident->source }}</li>
                <li>О резиденте: {{ $resident->about }}</li>
            </ul>
            <hr>

            <!-- Назначения врачей -->
            <div class="row mb-3">
                <div class="col-6">
                    <h2 class="lead">Назначения врачей</h2>
                </div>
                <div class="col-6 text-right">
                    <button class="btn btn-success btn-sm" type="button" onclick="createDoctorAppointment()"><i class="fas fa-lg fa-plus"></i></button>
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
                            <button class="btn btn-primary btn-sm btn-doctor-appointment-edit" onclick="editDoctorAppointment({{ $doctorAppointment->id }})"><i class="fas fa-lg fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm btn-doctor-appointment-delete" onclick="deleteDoctorAppointment({{ $doctorAppointment->id }})"><i class="fas fa-lg fa-trash"></i></button>
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
            <hr>

            <!-- Взыскания -->
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
            <hr>

            <!-- Ответственности -->
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
                    <th>Функция</th>
                </tr>
                </thead>
                <tbody>
                @foreach($resident->responsibilities as $responsibility)
                    <tr>
                        <td>{{ $responsibility->name }}</td>
                        <td class="text-right">
                            <button class="btn btn-danger btn-sm btn-task-delete" onclick="deleteResponsibility({{ $responsibility->id }})"><i class="fas fa-lg fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Название</th>
                    <th>Функция</th>
                </tr>
                </tfoot>
            </table>
            <hr>

            <!-- Задания -->
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
            <hr>

            <!-- Родственики -->
            <div class="row mb-3">
                <div class="col-6">
                    <h2 class="lead">Родственики</h2>
                </div>
                <div class="col-6 text-right">
                    <button class="btn btn-success btn-sm" type="button" onclick="createParent()"><i class="fas fa-lg fa-plus"></i></button>
                </div>
            </div>
            <div>

            </div>

        </div>
    </div>
@stop

@section('js')
    <script>
        $(function () {

            // Datatables initializations

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
