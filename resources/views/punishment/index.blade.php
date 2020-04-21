@extends('adminlte::page')

@section('title', 'Взыскания')

@section('content_header')
    <h1>Взыскания</h1>

    {{ Breadcrumbs::render('punishment.index') }}
@stop

@section('content')
    <div class="card card-solid">
        <div class="card-body pb-3">
            <table id="punishments" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Резидент</th>
                    <th>Кем выдано</th>
                    <th>Описание</th>
                    <th>Дата выдачи</th>
                    <th>Дата завершения</th>
                    <th>Дата сдачи</th>
                </tr>
                </thead>
                <tbody>
                @foreach($punishments as $punishment)
                    <tr>
                        <td>
                            @if ($punishment->resident)
                                <a href="{{ route('residents.show', [$punishment->resident->id]) }}">{{ $punishment->resident->fullname }}</a>
                            @else
                                В архиве
                            @endif
                        </td>
                        <td>
                            @if ($punishment->user)
                                <a href="{{ route('users.show', [$punishment->user->id]) }}">{{ $punishment->user->fullname }}</a>
                            @else
                                Удалён
                            @endif
                        </td>
                        <td>
                            {{ $punishment->description }}
                        </td>
                        <td>{{ $punishment->start_at }}</td>
                        <td>{{ $punishment->end_at }}</td>
                        <td>{{ $punishment->finished_at }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Резидент</th>
                    <th>Кем выдано</th>
                    <th>Описание</th>
                    <th>Дата выдачи</th>
                    <th>Дата завершения</th>
                    <th>Дата сдачи</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            {{ $punishments->links() }}
        </div>
        <!-- /.card-footer -->
    </div>
@stop

@section('js')
    <script>
        $(function () {
            $('#punishments').DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "order" : [[ 3, "desc"]],
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
