@extends('adminlte::page')

@section('title', 'Задания')

@section('content_header')
    <h1>{{ $task->title }}</h1>

    {{ Breadcrumbs::render('task.show', $task) }}
@stop

@section('content')
    <div class="card bg-light w-100">
        <div class="card-header text-muted border-bottom-0">
            Автор: <a href="{{ route('users.show', [$task->user->id]) }}">{{ $task->user->fullname }}</a>
        </div>
        <div class="card-body pt-0">
            <h2 class="lead"><b>{{ $task->title }}</b></h2>
            <div class="row">
                <div class="col-md-6">
                    <b>Членам команды</b>
                    <ul>
                        @foreach ($task->users as $user)
                            <li><a href="{{ route('users.show', $user->id) }}">{{ $user->fullname }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-6">
                    <b>Резидентам</b>
                    <ul>
                        @foreach ($task->residents as $resident)
                            <li><a href="{{ route('residents.show', $resident->id) }}">{{ $resident->fullname }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="task-description">
                {!! $task->description !!}
            </div>
            <ul class="ml-0 mb-0 fa-ul text-muted text-right">
                <li class="small"> Дата создания: {{ $task->created_at }}</li>
                <li class="small"> Дата начала: {{ $task->start_at }}</li>
                <li class="small"> Дата завершения: {{ $task->end_at }}</li>
            </ul>
        </div>
{{--        <div class="card-footer text-right">--}}
{{--            <a class="btn btn-primary" href="{{ route('reports.edit', [$report->id]) }}">Редактировать</a>--}}
{{--            <button class="btn btn-danger" type="button" onclick="deleteReport({{ $report->id }})">Удалить</button>--}}
{{--        </div>--}}
    </div>
@stop
