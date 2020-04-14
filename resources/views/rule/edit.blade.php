@extends('adminlte::page')

@section('title', $rule->title)

@section('content_header')
    <h1>{{ $rule->title }}</h1>

    {{ Breadcrumbs::render('rule.edit', $rule) }}
@stop

@section('content')
    <form id="rule-edit-form">
        <div class="card bg-light w-100">
            <div class="card-body pt-3">
                <div class="form-group">
                    <label for="rule-title-input">Заголовок</label>
                    <input type="text" name="title" id="rule-title-input" class="form-control" value="{{ $rule->title }}">
                </div>
                <div class="form-group">
                    <label for="rule-content-input">Содержимое</label>
                    <textarea class="summernote" name="content" id="rule-content-input">{!! $rule->content !!}</textarea>
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
            let $ruleEditForm = $('#rule-edit-form');

            $ruleEditForm.submit(function (e) {
                $.ajax({
                    url : '/rules/{{ $rule->id }}',
                    method : 'PUT',
                    data : $ruleEditForm.serialize(),
                    success : function (data) {
                        // location.reload();
                        window.location = '{{ route('rules.show', [$rule->id]) }}';
                    }
                });

                return false;
            });

            $('.summernote').summernote();
        });
    </script>
@stop
