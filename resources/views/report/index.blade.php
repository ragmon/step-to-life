@extends('adminlte::page')

@section('title', 'Отчёты')

@section('content_header')
    <div class="row">
        <div class="col-6">
            <h1>Отчёты</h1>
        </div>
        <div class="col-6">
            <div class="text-right">
                <a href="{{ route('reports.create') }}" class="btn btn-success">Создать</a>
            </div>
        </div>
    </div>

    {{ Breadcrumbs::render('report.index') }}
@stop

@section('content')
    <div class="card card-solid">
        <div class="card-body pb-3">
            @if ($reports->count() > 0)
                <table id="punishments" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Заголовок</th>
                        <th>Дата создания</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reports as $report)
                        <tr>
                            <td><a href="{{ route('reports.show', [$report->id]) }}">{{ $report->title }}</a></td>
                            <td>{{ $report->created_at->format('d.m.Y H:i:s') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Заголовок</th>
                        <th>Дата создания</th>
                    </tr>
                    </tfoot>
                </table>
            @else
                <p class="text-center">Данные отсутствуют</p>
            @endif
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            {{ $reports->links() }}
        </div>
        <!-- /.card-footer -->
    </div>
@stop
