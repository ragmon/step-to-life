@extends('adminlte::page')

@section('title', 'Создание должностной инструкции')

@section('content_header')
    <h1>Создание должностной инструкции</h1>

    {{ Breadcrumbs::render('job_description.create') }}
@stop

@section('content')
    <form id="job-description-create-form">
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
            let $jobDescriptionCreateForm = $('#job-description-create-form');

            $jobDescriptionCreateForm.submit(function (e) {
                $.ajax({
                    url : '/job_descriptions',
                    method : 'POST',
                    data : $jobDescriptionCreateForm.serialize(),
                    success : function (data) {
                        window.location = `/job_descriptions/${data.id}`;
                    }
                });

                return false;
            });

            $('.summernote').summernote({
                height: 300,
                lang: 'ru-RU'
            });
        });
    </script>
@stop
