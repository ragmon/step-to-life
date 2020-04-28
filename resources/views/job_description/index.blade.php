@extends('adminlte::page')

@section('title', 'Должностные инструкции')

@section('content_header')
    <div class="row">
        <div class="col-6">
            <h1>Должностные инструкции</h1>
        </div>
        <div class="col-6">
            <div class="text-right">
                <a href="{{ route('job_descriptions.create') }}" class="btn btn-success">Создать</a>
            </div>
        </div>
    </div>

    {{ Breadcrumbs::render('job_description.index') }}
@stop

@section('content')
    <div class="card card-solid">
        <div class="card-body pb-3">
            @if ($jobDescriptions->count() > 0)
                <table id="punishments" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Заголовок</th>
                        <th>Дата создания</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($jobDescriptions as $jobDescription)
                        <tr>
                            <td><a href="{{ route('job_descriptions.show', [$jobDescription->id]) }}">{{ $jobDescription->title }}</a></td>
                            <td>{{ $jobDescription->created_at->format('d.m.Y H:i:s') }}</td>
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
            {{ $jobDescriptions->links() }}
        </div>
        <!-- /.card-footer -->
    </div>
@stop
