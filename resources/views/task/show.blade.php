@extends('adminlte::page')

@section('title', 'Задания')

@section('content_header')
    <h1>{{ $task->title }}</h1>

    {{ Breadcrumbs::render('task.show', $task) }}
@stop

@section('content')
    <div class="card bg-light w-100">
        <div class="card-header text-muted border-bottom-0">
            Автор:
            @if ($task->user)
                <a href="{{ route('users.show', [$task->user->id]) }}">{{ $task->user->fullname }}</a>
            @else
                <span>Пользователь удалён</span>
            @endif
        </div>
        <div class="card-body pt-0">
            <h2 class="lead"><b>{{ $task->title }}</b></h2>
            <div class="row">
                @if ($task->users->count() > 0)
                    <div class="col-md-6">
                        <b>Членам команды</b>
                        <ul>
                            @foreach ($task->users as $user)
                                <li><a href="{{ route('users.show', $user->id) }}">{{ $user->fullname }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if ($task->residents->count() > 0)
                    <div class="col-md-6">
                        <b>Резидентам</b>
                        <ul>
                            @foreach ($task->residents as $resident)
                                <li><a href="{{ route('residents.show', $resident->id) }}">{{ $resident->fullname }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="task-description">
                {!! $task->description !!}
            </div>
            <ul class="ml-0 mb-0 mt-2 fa-ul text-muted">
                <li class="small"> Дата создания: {{ $task->created_at->format('d.m.Y') }}</li>
                <li class="small"> Дата начала: {{ $task->start_at->format('d.m.Y') }}</li>
                <li class="small"> Дата завершения: {{ $task->end_at->format('d.m.Y') }}</li>
            </ul>
        </div>
    </div>
@stop
