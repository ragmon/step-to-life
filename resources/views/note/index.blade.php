@extends('adminlte::page')

@section('title', 'Заметки')

@section('content_header')
    <h1>Заметки</h1>

    {{ Breadcrumbs::render('note.index') }}
@stop

@section('content')
    <div class="card card-solid">
        <div class="card-body">
            @if ($notes->count() > 0)
                @foreach ($notes as $note)
                    <div class="post">
                        <div class="user-block">
                            <span class="username ml-0">
                                @if ($note->user)
                                    <a href="{{ route('users.show', [$note->user->id]) }}">{{ $note->user->fullname }}</a>
                                @else
                                    <span>Пользователь удалён</span>
                                @endif
                                >
                                @if ($note->notable)
                                    <a href="{{ $note->notable->link }}">{{ $note->notable->fullname }}</a>
                                @else
                                    <span>Удалён или в архиве</span>
                                @endif
                                <a class="float-right btn-tool" onclick="deleteNote({{ $note->id }})"><i class="fas fa-times"></i></a>
                            </span>
                            <span class="description ml-0">{{ $note->created_at->format('d.m.Y H:i:s') }}</span>
                        </div>
                        <!-- /.user-block -->
                        <div class="note-content">
                            {{ $note->content }}
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-center">Данные отсутствуют</p>
            @endif
        </div>
        <div class="card-footer">
            {!! $notes->links() !!}
        </div>
        <!-- /.card-footer -->
    </div>

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
@stop

@section('js')
    <script>

        function deleteNote(noteId) {
            let $modalNoteDelete = $('#modal-note-delete');

            $modalNoteDelete.find('[name=note_id]').val(noteId);

            $modalNoteDelete.modal('show');
        }

        $(function () {
            let $modalNoteDelete = $('#modal-note-delete');

            $modalNoteDelete.submit(function () {
                let noteId = $modalNoteDelete.find('[name=note_id]').val();

                $.ajax({
                    url : `/notes/${noteId}`,
                    method : 'DELETE',
                    success : function () {
                        location.reload();
                    }
                });

                return false;
            });
        });
    </script>
@stop
