@extends('adminlte::page')

@section('title', 'Создание правила')

@section('content_header')
    <h1>Создание правила</h1>

    {{ Breadcrumbs::render('rule.create') }}
@stop

@section('content')
    <form id="rule-create-form">
        <div class="card bg-light w-100">
            <div class="card-body pt-3">
                <div class="form-group">
                    <label for="rule-title-input">Заголовок</label>
                    <input type="text" name="title" id="rule-title-input" class="form-control" value="">
                </div>
                <div class="form-group">
                    <label for="rule-content-input">Содержимое</label>
                    <textarea class="summernote" name="content" id="rule-content-input"></textarea>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success">Сохранить</button>
                <a href="{{ route('rules.index') }}" class="btn btn-default">Закрыть</a>
            </div>
        </div>
    </form>
@stop

@section('js')
    <script>
        $(function () {
            let $ruleCreateForm = $('#rule-create-form');

            $ruleCreateForm.submit(function (e) {
                $.ajax({
                    url : '/rules',
                    method : 'POST',
                    data : $ruleCreateForm.serialize(),
                    success : function (data) {
                        window.location = `/rules/${data.id}`;
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
