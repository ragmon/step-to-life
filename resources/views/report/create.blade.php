@extends('adminlte::page')

@section('title', 'Создание отчёта')

@section('content_header')
    <h1>Создание отчёта</h1>

    {{ Breadcrumbs::render('report.create') }}
@stop

@section('content')
    <form id="report-create-form">
        <div class="card bg-light w-100">
            <div class="card-body pt-3">
                <div class="form-group">
                    <label for="report-title-input">Заголовок</label>
                    <input type="text" name="title" id="report-title-input" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label for="report-content-input">Содержимое</label>
                    <textarea class="summernote" name="content" id="report-content-input"></textarea>
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
            let $reportCreateForm = $('#report-create-form');

            $reportCreateForm.submit(function (e) {
                $.ajax({
                    url : '/reports',
                    method : 'POST',
                    data : $reportCreateForm.serialize(),
                    success : function (data) {
                        window.location = `/reports/${data.id}`;
                    }
                });

                return false;
            });

            $('.summernote').summernote();
        });
    </script>
@stop
