@extends('adminlte::page')

@section('title', $report->title)

@section('content_header')
    <h1>{{ $report->title }}</h1>

    {{ Breadcrumbs::render('report.show', $report) }}
@stop

@section('content')
    <div class="card bg-light w-100">
        <div class="card-header text-muted border-bottom-0">
            {{ $report->created_at->format('d/m/Y') }}
        </div>
        <div class="card-body pt-0">
            {!! $report->content !!}
        </div>
        <div class="card-footer text-right">
            <a class="btn btn-primary" href="{{ route('reports.edit', [$report->id]) }}">Редактировать</a>
            <button class="btn btn-danger" type="button" onclick="deleteReport({{ $report->id }})">Удалить</button>
        </div>
    </div>
@stop

@section('js')

@stop
