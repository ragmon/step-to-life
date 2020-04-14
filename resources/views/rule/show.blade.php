@extends('adminlte::page')

@section('title', $rule->title)

@section('content_header')
    <h1>{{ $rule->title }}</h1>

    {{ Breadcrumbs::render('rule.show', $rule) }}
@stop

@section('content')
    <div class="card bg-light w-100">
        <div class="card-header text-muted border-bottom-0">
            {{ $rule->created_at->format('d/m/Y') }}
        </div>
        <div class="card-body pt-0">
            {!! $rule->content !!}
        </div>
        <div class="card-footer text-right">
            <a class="btn btn-primary" href="{{ route('rules.edit', [$rule->id]) }}">Редактировать</a>
            <button class="btn btn-danger" type="button" onclick="deleterule({{ $rule->id }})">Удалить</button>
        </div>
    </div>

    <!-- Delete User modal -->
    <div class="modal fade" id="modal-rule-delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Подтвердите действие</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Подтвердите удаление</p>
                    <input type="hidden" name="rule_id" value="">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-danger btn-delete">Подтверждаю</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
@stop

@section('js')
    <script>
        function deleterule(ruleId) {
            let $modalruleDelete = $('#modal-rule-delete');

            $modalruleDelete.find('[name=rule_id]').val(ruleId);

            $modalruleDelete.modal('show');
        }

        $(function () {
            let $modalruleDelete = $('#modal-rule-delete');

            $modalruleDelete.find('.btn-delete').click(function () {
                let ruleId = $modalruleDelete.find('[name=rule_id]').val();

                $.ajax({
                    url : `/rules/${ruleId}`,
                    method : 'DELETE',
                    success : function () {
                        window.location = '{{ route('rules.index') }}';
                    }
                });
            });
        });
    </script>
@stop
