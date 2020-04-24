@extends('adminlte::page')

@section('title', 'Резиденты')

@section('content_header')
    <div class="row">
        <div class="col-6">
            <h1>Обязанности</h1>
        </div>
        <div class="col-6">
            <div class="text-right">
                <button class="btn btn-success" onclick="createResponsibility()">Создать</button>
            </div>
        </div>
    </div>

    {{ Breadcrumbs::render('responsibility.index') }}
@stop

@section('content')
    <div class="card card-solid">
        <div class="card-body pb-0">
            <table id="responsibilities" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Название</th>
                    <td>Функция</td>
                </tr>
                </thead>
                <tbody>
                @foreach($responsibilities as $responsibility)
                    <tr>
                        <td>{{ $responsibility->name }}</td>
                        <td class="text-right">
                            <button class="btn btn-primary btn-sm btn-responsibility-edit" onclick="editResponsibility({{ $responsibility->id }})"><i class="fas fa-lg fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm btn-responsibility-delete" onclick="deleteResponsibility({{ $responsibility->id }})"><i class="fas fa-lg fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th>Название</th>
                    <td>Функция</td>
                </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            {{ $responsibilities->links() }}
        </div>
        <!-- /.card-footer -->
    </div>

    <!-- Create Responsibility modal -->
    <form class="modal fade" id="modal-responsibility-create" novalidate="novalidate">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Создание обязанности</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Название</label>
                            <input name="name" class="form-control" placeholder="Команата №2">
                        </div>
                        <div class="form-group">
                            <label>Описание</label>
                            <textarea name="about" rows="6" class="form-control summernote" placeholder="В обязанности входит поддержание порядка в комнате - порядок в шкафчиках резидентов, натертые зеркала, политы цветы"></textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->
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

    <!-- Edit Responsibility modal -->
    <form class="modal fade" id="modal-responsibility-edit" novalidate="novalidate">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Редактирование обязанности</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Название</label>
                            <input name="name" class="form-control" placeholder="Команата №2">
                        </div>
                        <div class="form-group">
                            <label>Описание</label>
                            <textarea name="about" rows="6" class="form-control summernote" placeholder="В обязанности входит поддержание порядка в комнате - порядок в шкафчиках резидентов, натертые зеркала, политы цветы"></textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <input type="hidden" name="id" value="">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-success">Редактировать</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>

    <!-- Delete Responsibility modal -->
    <form class="modal fade" id="modal-responsibility-delete">
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
                    <input type="hidden" name="responsibility_id" value="">
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

        function createResponsibility() {
            let $modalResponsibilityCreate = $('#modal-responsibility-create');

            $modalResponsibilityCreate.modal('show');
        }

        function editResponsibility(responsibilityId) {
            let $modalResponsibilityEdit = $('#modal-responsibility-edit');

            $.ajax({
                url : `/responsibilities/${responsibilityId}`,
                method : 'GET',
                success : function (data) {
                    populateForm($modalResponsibilityEdit[0], data);

                    $modalResponsibilityEdit.modal('show');
                }
            });
        }

        function deleteResponsibility(responsibilityId) {
            let $modalResponsibilityDelete = $('#modal-responsibility-delete');

            $modalResponsibilityDelete.find('[name=responsibility_id]').val(responsibilityId);

            $modalResponsibilityDelete.modal('show');
        }

        $(function () {
            let $modalResponsibilityCreate = $('#modal-responsibility-create');
            let $modalResponsibilityEdit = $('#modal-responsibility-edit');
            let $modalResponsibilityDelete = $('#modal-responsibility-delete');

            $modalResponsibilityCreate.submit(function () {
                $.ajax({
                    url : `/responsibilities`,
                    method : 'POST',
                    data : $modalResponsibilityCreate.serialize(),
                    success : function () {
                        location.reload();
                    }
                });
            });

            $modalResponsibilityEdit.submit(function () {
                let responsibilityId = $modalResponsibilityEdit.find('[name=id]').val();

                $.ajax({
                    url : `/responsibilities/${responsibilityId}`,
                    method : 'PUT',
                    data : $modalResponsibilityEdit.serialize(),
                    success : function () {
                        location.reload();
                    }
                });

                return false;
            });

            $modalResponsibilityDelete.submit(function () {
                let responsibilityId = $modalResponsibilityDelete.find('[name=responsibility_id]').val();

                $.ajax({
                    url : `/responsibilities/${responsibilityId}`,
                    method : 'DELETE',
                    success : function () {
                        location.reload();
                    }
                });

                return false;
            });

            // Datatables initializations
            // $('#responsibilities').DataTable({
            //     "paging": true,
            //     "lengthChange": false,
            //     "searching": false,
            //     "ordering": true,
            //     "info": false,
            //     "autoWidth": false,
            //     "responsive": true,
            //     "scrollX" : true,
            //     "language": {
            //         "url": "/datatable/Russian.json"
            //     }
            // });
        });
    </script>
@stop
