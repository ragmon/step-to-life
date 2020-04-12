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
                            <input type="email" class="form-control" id="user-create-email" placeholder="example@example.com">
                        </div>
                        <div class="form-group">
                            <label for="user-create-firstname">Имя</label>
                            <input type="password" class="form-control" id="user-create-firstname" placeholder="Имя">
                        </div>
                        <div class="form-group">
                            <label for="user-create-lastname">Фамилия</label>
                            <input type="text" class="form-control" id="user-create-lastname" placeholder="Фамилия">
                        </div>
                        <div class="form-group">
                            <label for="user-create-patronymic">Отчество</label>
                            <input type="text" class="form-control" id="user-create-patronymic" placeholder="Отчество">
                        </div>
                        <div class="form-group">
                            <label for="user-create-role">Роль</label>
                            <input type="text" class="form-control" id="user-create-role" placeholder="консультант">
                        </div>
                    </div>
                    <!-- /.card-body -->
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-success">Создать</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
