@extends('adminlte::page')

@section('title', "$user->firstname $user->lastname $user->patronymic - $user->role")

{{--@section('content_header')--}}
{{--    <h1>{{ "$user->firstname $user->lastname $user->patronymic - $user->role" }}</h1>--}}
{{--@stop--}}

@section('content')
    <div class="card bg-light w-100">
        <div class="card-header text-muted border-bottom-0">
            {{ $user->role }}
        </div>
        <div class="card-body pt-0">
            <h2 class="lead"><b>{{ "$user->firstname $user->lastname $user->patronymic" }}</b></h2>
            <ul class="ml-4 mb-0 fa-ul text-muted mb-2">
                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-at"></i></span> E-mail: <a
                        href="mailto:{{ $user->email }}">{{ $user->email }}</a></li>
                <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Телефон: <a
                        href="tel:{{ $user->phone }}">{{ $user->phone }}</a></li>
            </ul>
            <div class="text-right">
                <a href="#" class="btn btn-sm btn-default">
                    <i class="fas fa-edit"></i> Редактировать
                </a>
                <a href="#" class="btn btn-sm btn-danger">
                    <i class="fas fa-trash"></i> Удалить
                </a>
            </div>
            <hr>

            <h2 class="lead">Взыскания</h2>
            <table id="punishments" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Кому</th>
                    <th>Описание</th>
                    <th>Дата выдачи</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Иванову Ивану Ивановичу</td>
                    <td>очень жестко ругался лютым матом</td>
                    <td>04/03/2019</td>
                </tr>
                <tr>
                    <td>Иванову Ивану Ивановичу</td>
                    <td>ругался матом</td>
                    <td>04/03/2019</td>
                </tr>
                <tr>
                    <td>Иванову Ивану Ивановичу</td>
                    <td>ругался матом</td>
                    <td>04/03/2019</td>
                </tr>
                <tr>
                    <td>Иванову Ивану Ивановичу</td>
                    <td>ругался матом</td>
                    <td>04/03/2019</td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>Кому</th>
                    <th>Описание</th>
                    <th>Дата выдачи</th>
                </tr>
                </tfoot>
            </table>
            <hr>

            <div class="row mb-3">
                <div class="col-6">
                    <h2 class="lead">Штрафы</h2>
                </div>
                <div class="col-6 text-right">
                    <a href="#" class="btn btn-success btn-sm"><i class="fas fa-lg fa-plus"></i></a>
                </div>
            </div>
            <table id="punishments" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>За что</th>
                    <th>Сумма</th>
                    <th>Функция</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>ругался матом</td>
                    <td>250грн</td>
                    <td class="text-right">
                        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-lg fa-edit"></i></a>
                        <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-lg fa-trash"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>ругался матом</td>
                    <td>250грн</td>
                    <td class="text-right">
                        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-lg fa-edit"></i></a>
                        <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-lg fa-trash"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>ругался матом</td>
                    <td>250грн</td>
                    <td class="text-right">
                        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-lg fa-edit"></i></a>
                        <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-lg fa-trash"></i></a>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>За что</th>
                    <th>Сумма</th>
                    <th>Функция</th>
                </tr>
                </tfoot>
            </table>
            <hr>

            <div class="row mb-3">
                <div class="col-6">
                    <h2 class="lead">Задания</h2>
                </div>
                <div class="col-6 text-right">
                    <a href="#" class="btn btn-success btn-sm"><i class="fas fa-lg fa-plus"></i></a>
                </div>
            </div>
            <table id="punishments" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Заголовок</th>
                    <th>Функция</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>письменное задание</td>
                    <td class="text-right">
                        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-lg fa-edit"></i></a>
                        <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-lg fa-trash"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>письменное задание</td>
                    <td class="text-right">
                        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-lg fa-edit"></i></a>
                        <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-lg fa-trash"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>письменное задание</td>
                    <td class="text-right">
                        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-lg fa-edit"></i></a>
                        <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-lg fa-trash"></i></a>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>Заголовок</th>
                    <th>Функция</th>
                </tr>
                </tfoot>
            </table>
            <hr>

            <div class="row mb-3">
                <div class="col-6">
                    <h2 class="lead">Отчёты</h2>
                </div>
                <div class="col-6 text-right">
                    <a href="#" class="btn btn-success btn-sm"><i class="fas fa-lg fa-plus"></i></a>
                </div>
            </div>
            <table id="punishments" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Заголовок</th>
                    <th>Функция</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>письменное задание</td>
                    <td class="text-right">
                        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-lg fa-edit"></i></a>
                        <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-lg fa-trash"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>письменное задание</td>
                    <td class="text-right">
                        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-lg fa-edit"></i></a>
                        <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-lg fa-trash"></i></a>
                    </td>
                </tr>
                <tr>
                    <td>письменное задание</td>
                    <td class="text-right">
                        <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-lg fa-edit"></i></a>
                        <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-lg fa-trash"></i></a>
                    </td>
                </tr>
                </tbody>
                <tfoot>
                <tr>
                    <th>Заголовок</th>
                    <th>Функция</th>
                </tr>
                </tfoot>
            </table>
        </div>
{{--        <hr>--}}
{{--        <div class="card-footer">--}}

{{--        </div>--}}
    </div>
@stop

@section('js')
    <script>
        // $('#punishments').DataTable({
        //     "paging": true,
        //     "lengthChange": false,
        //     "searching": false,
        //     "ordering": true,
        //     "info": true,
        //     "autoWidth": false,
        //     "responsive": true,
        // });
    </script>
@stop
