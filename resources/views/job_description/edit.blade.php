@extends('adminlte::page')

@section('title', $jobDescription->title)

@section('content_header')
    <h1>{{ $jobDescription->title }}</h1>

    {{ Breadcrumbs::render('job_description.edit', $jobDescription) }}
@stop

@section('content')
    <form id="job-description-edit-form">
        <div class="card bg-light w-100">
            <div class="card-body pt-3">
                <div class="form-group">
                    <label for="report-title-input">Заголовок</label>
                    <input type="text" name="title" id="report-title-input" class="form-control" value="{{ $jobDescription->title }}">
                </div>
                <div class="form-group">
                    <label for="report-content-input">Содержимое</label>
                    <textarea class="summernote" name="content" id="report-content-input">{!! $jobDescription->content !!}</textarea>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success">Сохранить</button>
                <a href="{{ route('job_descriptions.index') }}" class="btn btn-default">Закрыть</a>
            </div>
        </div>
    </form>
@stop

@section('js')
    <script>
        $(function () {
            let $jobDescriptionEditForm = $('#job-description-edit-form');

            $jobDescriptionEditForm.submit(function (e) {
                $.ajax({
                    url : '/job_descriptions/{{ $jobDescription->id }}',
                    method : 'PUT',
                    data : $jobDescriptionEditForm.serialize(),
                    success : function (data) {
                        // location.reload();
                        window.location = '{{ route('job_descriptions.show', [$jobDescription->id]) }}';
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
