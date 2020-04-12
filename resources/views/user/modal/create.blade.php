<div class="modal fade" id="modal-user-create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Новый член команды</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="user-create-email">E-mail</label>
                            <input name="email" type="email" class="form-control" id="user-create-email" placeholder="example@example.com">
                        </div>
                        <div class="form-group">
                            <label for="user-create-firstname">Имя</label>
                            <input name="firstname" type="text" class="form-control" id="user-create-firstname" placeholder="Имя">
                        </div>
                        <div class="form-group">
                            <label for="user-create-lastname">Фамилия</label>
                            <input name="lastname" type="text" class="form-control" id="user-create-lastname" placeholder="Фамилия">
                        </div>
                        <div class="form-group">
                            <label for="user-create-patronymic">Отчество</label>
                            <input name="patronymic" type="text" class="form-control" id="user-create-patronymic" placeholder="Отчество">
                        </div>
                        <div class="form-group">
                            <label for="user-create-role">Роль</label>
                            <input name="role" type="text" class="form-control" id="user-create-role" placeholder="консультант">
                        </div>
                        <div class="form-group">
                            <label for="user-create-phone">Телефон</label>
                            <input name="phone" type="text" class="form-control" id="user-create-phone" placeholder="+3546734454">
                        </div>
                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-success btn-create">Создать</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@section('js')
    <script>
        $(function () {
            let $modalUserCreate = $('#modal-user-create');

            $modalUserCreate.find('.btn-create').click(function () {
                $.ajax({
                    url : '{{ route('users.store') }}',
                    method : 'POST',
                    data : $modalUserCreate.find('form').serialize(),
                    success : function (data) {
                        location.reload();
                    },
                    error : function (jqXHR, textStatus) {
                        alert(`Ошибка #${jqXHR.status}`);
                    }
                })
            });
        });
    </script>
@stop