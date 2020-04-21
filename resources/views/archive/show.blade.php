@extends('adminlte::page')

@section('title', $resident->fullname)

@section('content_header')
    <div class="row">
        <div class="col-md-6">
            {{ Breadcrumbs::render('archive.show', $resident) }}
        </div>
        <div class="col-md-6">
            <div class="text-right">
                <button type="button" class="btn btn-success" onclick="fromArchive({{ $resident->id }})">Из архива</button>
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
            <h2 class="lead">Назначения врачей</h2>
            <table id="doctor-appointment" class="table table-bordered table-hover dataTable dtr-inline collapsed">
                <thead>
                <tr>
                    <th>Врач</th>
                    <th>Препарат</th>
                    <th>Схема приёма</th>
                </tr>
                </thead>
                <tbody>
                @foreach($resident->doctorAppointments as $doctorAppointment)
                    <tr>
                        <td>{{ $doctorAppointment->doctor }}</td>
                        <td>{{ $doctorAppointment->drug }}</td>
                        <td>{{ $doctorAppointment->reception_schedule }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Врач</th>
                    <th>Препарат</th>
                    <th>Схема приёма</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Взыскания -->
    <div class="card bg-light w-100">
        <div class="card-body">
            <h2 class="lead">Взыскания</h2>
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
            <h2 class="lead">Обязанности</h2>
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
            <h2 class="lead">Задания</h2>
            <table id="tasks" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Заголовок</th>
                    <th>Дата сдачи</th>
                </tr>
                </thead>
                <tbody>
                @foreach($resident->tasks as $task)
                    <tr>
                        <td><a href="{{ route('tasks.show', [$task->id]) }}">{{ $task->title }}</a></td>
                        <td>{{ $task->pivot->finished_at ?? '-' }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Заголовок</th>
                    <th>Дата сдачи</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <!-- Родственики -->
    <div class="card bg-light w-100">
        <div class="card-body">
            <h2 class="lead">Родственики</h2>
            <div class="row d-flex align-items-stretch">
                @each('resident_parent.component.card', $resident->parents, 'parent')
            </div>
        </div>
    </div>

    <!-- Заметки -->
    <div class="card bg-light w-100">
        <div class="card-body">
            <h2 class="lead">Заметки</h2>

            @foreach($resident->notes->take(5) as $note)
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
        <div class="card-footer text-center">
            <a href="#">Показать все</a>
        </div>
    </div>


@stop

@section('js')
    <script>

        function fromArchive(residentId) {
            $.ajax({
                url : `/archive/${residentId}`,
                method : 'PUT',
                success : function () {
                    window.location = `/residents/${residentId}`;
                }
            });
        }

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
