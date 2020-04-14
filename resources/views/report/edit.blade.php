@extends('adminlte::page')

@section('title', $report->title)

@section('content_header')
    <h1>{{ $report->title }}</h1>

    {{ Breadcrumbs::render('report.edit', $report) }}
@stop

@section('content')
    <form id="report-edit-form">
        <div class="card bg-light w-100">
            <div class="card-body pt-3">
                <div class="form-group">
                    <label for="report-title-input">Заголовок</label>
                    <input type="text" name="title" id="report-title-input" class="form-control" value="{{ $report->title }}">
                </div>
                <div class="form-group">
                    <label for="report-content-input">Содержимое</label>
                    <textarea class="summernote" name="content" id="report-content-input">{!! $report->content !!}</textarea>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success">Сохранить</button>
                <a href="{{ route('reports.index') }}" class="btn btn-default">Закрыть</a>
            </div>
        </div>
    </form>
@stop

@section('js')
    <script>
        $(function () {
            let $reportEditForm = $('#report-edit-form');

            $reportEditForm.submit(function (e) {
                $.ajax({
                    url : '/reports/{{ $report->id }}',
                    method : 'PUT',
                    data : $reportEditForm.serialize(),
                    success : function (data) {
                        // location.reload();
                        window.location = '{{ route('reports.show', [$report->id]) }}';
                    }
                });

                return false;
            });

            $('.summernote').summernote();
        });
    </script>
@stop
