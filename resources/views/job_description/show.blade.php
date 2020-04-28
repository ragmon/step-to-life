@extends('adminlte::page')

@section('title', $jobDescription->title)

@section('content_header')
    <h1>{{ $jobDescription->title }}</h1>

    {{ Breadcrumbs::render('job_description.show', $jobDescription) }}
@stop

@section('content')
    <div class="card bg-light w-100">
        <div class="card-header text-muted border-bottom-0">
            {{ $jobDescription->created_at->format('d/m/Y') }}
        </div>
        <div class="card-body pt-0">
            {!! $jobDescription->content !!}
        </div>
        <div class="card-footer text-right">
            <a class="btn btn-primary" href="{{ route('job_descriptions.edit', [$jobDescription->id]) }}">Редактировать</a>
            <button class="btn btn-danger" type="button" onclick="deleteJobDescription({{ $jobDescription->id }})">Удалить</button>
        </div>
    </div>

    <!-- Delete Job Description modal -->
    <div class="modal fade" id="modal-job-description-delete">
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
                    <input type="hidden" name="job_description_id" value="">
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
        function deleteJobDescription(jobDescriptionId) {
            let $modalJobDescriptionDelete = $('#modal-job-description-delete');

            $modalJobDescriptionDelete.find('[name=job_description_id]').val(jobDescriptionId);

            $modalJobDescriptionDelete.modal('show');
        }

        $(function () {
            let $modalJobDescriptionDelete = $('#modal-job-description-delete');

            $modalJobDescriptionDelete.find('.btn-delete').click(function () {
                let jobDescriptionId = $modalJobDescriptionDelete.find('[name=job_description_id]').val();

                $.ajax({
                    url : `/job_descriptions/${jobDescriptionId}`,
                    method : 'DELETE',
                    success : function () {
                        window.location = '{{ route('job_descriptions.index') }}';
                    }
                });
            });
        });
    </script>
@stop
