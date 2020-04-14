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

    <!-- Delete User modal -->
    <div class="modal fade" id="modal-report-delete">
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
                    <input type="hidden" name="report_id" value="">
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
        function deleteReport(reportId) {
            let $modalReportDelete = $('#modal-report-delete');

            $modalReportDelete.find('[name=report_id]').val(reportId);

            $modalReportDelete.modal('show');
        }

        $(function () {
            let $modalReportDelete = $('#modal-report-delete');

            $modalReportDelete.find('.btn-delete').click(function () {
                let reportId = $modalReportDelete.find('[name=report_id]').val();

                $.ajax({
                    url : `/reports/${reportId}`,
                    method : 'DELETE',
                    success : function () {
                        window.location = '{{ route('reports.index') }}';
                    }
                });
            });
        });
    </script>
@stop
