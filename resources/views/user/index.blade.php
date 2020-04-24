@extends('adminlte::page')

@section('title', 'Команда')

@section('content_header')
    <div class="row mb-2">
        <div class="col-6">
            <h1>Команда</h1>
        </div>
        <div class="col-6">
            <div class="text-right">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-user-create">Создать</button>
            </div>
        </div>
    </div>

    {{ Breadcrumbs::render('user.index') }}
@stop

@section('content')
    <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="row d-flex align-items-stretch">
                @each('user.component.card', $users, 'user')
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            {{ $users->links() }}
        </div>
        <!-- /.card-footer -->
    </div>

    <!-- User Create modal -->
    <form class="modal fade" id="modal-user-create">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Новый член команды</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="user-create-email">E-mail</label>
                            <input name="email" type="email" class="form-control" id="user-create-email" placeholder="example@example.com">
                        </div>
                        <div class="form-group">
                            <label for="user-create-firstname">Имя</label>
                            <input name="firstname" type="text" class="form-control" id="user-create-firstname" placeholder="Иван">
                        </div>
                        <div class="form-group">
                            <label for="user-create-lastname">Фамилия</label>
                            <input name="lastname" type="text" class="form-control" id="user-create-lastname" placeholder="Иванов">
                        </div>
                        <div class="form-group">
                            <label for="user-create-patronymic">Отчество</label>
                            <input name="patronymic" type="text" class="form-control" id="user-create-patronymic" placeholder="Иванович">
                        </div>
                        <div class="form-group">
                            <label for="user-create-role">Должность</label>
                            <input name="role" type="text" class="form-control" id="user-create-role" placeholder="консультант">
                        </div>
                        <div class="form-group">
                            <label for="user-create-phone">Телефон</label>
                            <input name="phone" type="text" class="form-control" id="user-create-phone" placeholder="+380123456789">
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-success btn-create">Создать</button>
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
        $(function () {
            let $modalUserCreate = $('#modal-user-create');

            $modalUserCreate.validate({
                submitHandler: function () {
                    $.ajax({
                        url : '{{ route('users.store') }}',
                        method : 'POST',
                        data : $modalUserCreate.serialize(),
                        success : function (data) {
                            location.reload();
                        }
                    })
                },
                rules: {
                    email: {
                        required: true,
                    },
                    firstname: {
                        required: true,
                    },
                    lastname: {
                        required: true,
                    },
                    patronymic: {
                        required: true,
                    },
                    role: {
                        required: true,
                    },
                    phone: {
                        required: true,
                    },
                },
                messages: {
                    email: {
                        required: "Пожалуйста, введите E-mail"
                    },
                    firstname: {
                        required: "Пожалуйста, введите имя"
                    },
                    lastname: {
                        required: "Пожалуйста, введите фамилию"
                    },
                    patronymic: {
                        required: "Пожалуйста, введите отчество"
                    },
                    role: {
                        required: "Пожалуйста, введите должность"
                    },
                    phone: {
                        required: "Пожалуйста, введите телефон"
                    },
                }
            });
        });
    </script>
@stop
