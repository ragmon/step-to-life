<div class="modal fade" id="modal-user-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Редактирование члена команды</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="user-edit-email">E-mail</label>
                            <input name="email" type="email" class="form-control" id="user-edit-email" placeholder="example@example.com">
                        </div>
                        <div class="form-group">
                            <label for="user-edit-firstname">Имя</label>
                            <input name="firstname" type="text" class="form-control" id="user-edit-firstname" placeholder="Имя">
                        </div>
                        <div class="form-group">
                            <label for="user-edit-lastname">Фамилия</label>
                            <input name="lastname" type="text" class="form-control" id="user-edit-lastname" placeholder="Фамилия">
                        </div>
                        <div class="form-group">
                            <label for="user-edit-patronymic">Отчество</label>
                            <input name="patronymic" type="text" class="form-control" id="user-edit-patronymic" placeholder="Отчество">
                        </div>
                        <div class="form-group">
                            <label for="user-edit-role">Роль</label>
                            <input name="role" type="text" class="form-control" id="user-edit-role" placeholder="консультант">
                        </div>
                        <div class="form-group">
                            <label for="user-edit-phone">Телефон</label>
                            <input name="phone" type="text" class="form-control" id="user-edit-phone" placeholder="+3546734454">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <input name="id" type="hidden" value="">
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-success btn-edit">Сохранить</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@section('js')
    <script>
        function editUser(userId) {
            let $modalUserEdit = $('#modal-user-edit');
            let $editForm = $modalUserEdit.find('form');

            $.ajax({
                url : '/users/' + userId,
                method : 'GET',
                success : function (data) {
                    populateForm($editForm[0], data);
                }
            });

            $modalUserEdit.modal('show');
        }

        $(function () {
            let $modalUserEdit = $('#modal-user-edit');
            let $form = $modalUserEdit.find('form');

            $modalUserEdit.find('.btn-edit').click(function () {
                let userId = $form.find('[name=id]').val();

                $.ajax({
                    url : '/users/' + userId,
                    method : 'PUT',
                    data : $modalUserEdit.find('form').serialize(),
                    success : function (data) {
                        location.reload();
                    }
                })
            });
        });
    </script>
@stop
