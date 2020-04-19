@extends('adminlte::page')

@section('title', $parent->fullname)

@section('content_header')
    <div class="text-right">
        <button type="button" class="btn btn-danger" onclick="deleteParent({{ $parent->id }})">Удалить</button>
    </div>

    {{ Breadcrumbs::render('parent.show', $parent) }}
@stop

@section('content')
    <div class="card bg-light w-100">
        <div class="card-header text-muted border-bottom-0">
            {{ $parent->role }}
        </div>
        <div class="card-body pt-0">
            <h2 class="lead"><b>{{ $parent->fullname }}</b></h2>
            <ul class="ml-0 mb-0 fa-ul text-muted mb-2">
                <li>Пол: {{ $parent->gender_title }}</li>
                <li>Телефон: <a href="tel:{{ $parent->phone }}">{{ $parent->phone }}</a></li>
                <li>Дата рождения: {{ $parent->birthday }}</li>
                <li>О родственике: {{ $parent->about }}</li>
            </ul>
        </div>
    </div>

    <!-- Заметки -->
    <div class="card bg-light w-100">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-6">
                    <h2 class="lead">Заметки</h2>
                </div>
                <div class="col-6 text-right">
                    <button class="btn btn-success btn-sm" type="button" onclick="createNote({{ $parent->id }})"><i class="fas fa-lg fa-plus"></i></button>
                </div>
            </div>

            @foreach($parent->notes->take(5) as $note)
                <div class="post">
                    <div class="user-block">
                        <span class="username ml-0">
                            @if ($note->user)
                                <a href="{{ route('users.show', [$note->user->id]) }}">{{ $note->user->fullname }}</a>
                            @else
                                <span>Пользователь удалён</span>
                            @endif
                            <a class="float-right btn-tool" onclick="deleteNote({{ $parent->id }}, {{ $note->id }})"><i class="fas fa-times"></i></a>
                        </span>
                        <span class="description ml-0">{{ $note->created_at }}</span>
                    </div>
                    <!-- /.user-block -->
                    <p>
                        {{ $note->content }}
                    </p>
                </div>
            @endforeach
        </div>
        <div class="card-footer text-center">
            <a href="#">Показать все</a>
        </div>
    </div>

    <!-- Create Note modal -->
    <form class="modal fade" id="modal-note-create" novalidate="novalidate">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Создание заметки</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Содержимое</label>
                            <textarea name="content" class="form-control summernote" placeholder="решил бросить курить"></textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <input type="hidden" name="parent_id" value="">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-success">Создать</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>
    <!-- /.modal -->

    <!-- Delete Note modal -->
    <form class="modal fade" id="modal-note-delete">
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
                    <input type="hidden" name="parent_id" value="">
                    <input type="hidden" name="note_id" value="">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-danger btn-delete">Подтверждаю</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>
    <!-- /.modal -->

    <!-- Delete Parent modal -->
    <form class="modal fade" id="modal-parent-delete">
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
                    <input type="hidden" name="parent_id" value="">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-danger btn-delete">Подтверждаю</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>
    <!-- /.modal -->
@stop

@section('js')
    <script>
        function createNote(parentId) {
            let $modalNoteCreate = $('#modal-note-create');

            $modalNoteCreate.find('[name=parent_id]').val(parentId);

            $modalNoteCreate.modal('show');
        }

        function deleteNote(parentId, noteId) {
            let $modalNoteDelete = $('#modal-note-delete');

            $modalNoteDelete.find('[name=parent_id]').val(parentId);
            $modalNoteDelete.find('[name=note_id]').val(noteId);

            $modalNoteDelete.modal('show');
        }

        function deleteParent(parentId) {
            let $modalParentDelete = $('#modal-parent-delete');

            $modalParentDelete.find('[name=parent_id]').val(parentId);

            $modalParentDelete.modal('show');
        }

        $(function () {
            let $modalNoteCreate = $('#modal-note-create');
            let $modalNoteDelete = $('#modal-note-delete');
            let $modalParentDelete = $('#modal-parent-delete');

            $modalNoteCreate.validate({
                submitHandler: function () {
                    let parentId = $modalNoteCreate.find('[name=parent_id]').val();

                    $.ajax({
                        url : `/parents/${parentId}/notes`,
                        method : 'POST',
                        data : $modalNoteCreate.serialize(),
                        success : function () {
                            location.reload();
                        }
                    });
                },
                rules: {
                    content: {
                        required: true,
                    }
                },
                messages: {
                    content: {
                        required: "Пожалуйста введите содержимое",
                    }
                },
            });

            $modalNoteDelete.submit(function () {
                let noteId = $modalNoteDelete.find('[name=note_id]').val();
                let parentId = $modalNoteDelete.find('[name=parent_id]').val();

                $.ajax({
                    url : `/parents/${parentId}/notes/${noteId}`,
                    method : 'DELETE',
                    success : function () {
                        location.reload();
                    }
                });

                return false;
            });

            $modalParentDelete.submit(function () {
                let parentId = $modalParentDelete.find('[name=parent_id]').val();

                $.ajax({
                    url : `/parents/${parentId}`,
                    method : 'DELETE',
                    success : function () {
                        window.location = '/parents';
                    }
                });

                return false;
            });
        });
    </script>
@stop
