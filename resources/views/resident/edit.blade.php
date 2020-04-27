@extends('adminlte::page')

@section('title', 'Редактирование резидента')

@section('content_header')
    {{ Breadcrumbs::render('resident.edit', $resident) }}
@stop

@section('content')
    <form id="edit-resident-form" class="card bg-light w-100" action="{{ route('residents.update', [$resident->id]) }}" method="post">
        <div class="card-body">
            <h2 class="lead"><b>Редактирование резидента</b></h2>

            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="form-group">
                        <label>Имя</label>
                        <input class="form-control" name="firstname" type="text" value="{{ $resident->firstname }}" placeholder="Иван">
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="form-group">
                        <label>Фамилия</label>
                        <input class="form-control" name="lastname" type="text" value="{{ $resident->lastname }}" placeholder="Иванов">
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="form-group">
                        <label>Отчество</label>
                        <input class="form-control" name="patronymic" type="text" value="{{ $resident->patronymic }}" placeholder="Василиевич">
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="form-group">
                        <label>Статус</label>
                        <div class="form-check">
                            <input class="form-check-input" name="status" type="checkbox" value="1" id="resident-status" {{ $resident->status ? 'checked' : '' }}>
                            <label class="form-check-label" for="resident-status">прошел реабилитацию</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="form-group">
                        <label>Источник поступления</label>
                        <input class="form-control" name="source" type="text" value="{{ $resident->source }}" placeholder="Клиника Благо">
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="form-group">
                        <label>Баланс</label>
                        <input class="form-control" name="balance" type="text" value="{{ $resident->balance }}" placeholder="500">
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="form-group">
                        <label>Пол</label>
                        <div class="form-check">
                            <input class="form-check-input" name="gender" type="radio" value="1" id="gender-1" {{ $resident->gender == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="gender-1">мужской</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="gender" type="radio" value="0" id="gender-0" {{ $resident->gender == 0 ? 'checked' : '' }}>
                            <label class="form-check-label" for="gender-0">женский</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="form-group">
                        <label>Дата рождения</label>
                        <input class="form-control" name="birthday" type="date" value="{{ $resident->birthday->format('Y-m-d') }}">
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="form-group">
                        <label>Дата регистрации</label>
                        <input class="form-control" name="registered_at" type="date" value="{{ $resident->registered_at->format('Y-m-d') }}">
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="form-group">
                        <label>Дополнительная информация</label>
                        <textarea class="form-control" name="about" placeholder="Иностранец">{{ $resident->about }}</textarea>
                    </div>
                </div>
                <div class="col-md-12 text-right">
                    <button class="btn btn-success" type="submit">Редактировать</button>
                </div>
            </div>
        </div>

        <input type="hidden" name="resident_id" value="{{ $resident->id }}">
    </form>
@stop

@section('js')
    <script>
        $(function () {
            let $editResidentForm = $('#edit-resident-form');

            $editResidentForm.validate({
                submitHandler: function () {
                    let residentId = $editResidentForm.find('[name=resident_id]').val();

                    $.ajax({
                        url : `/residents/${residentId}`,
                        method : 'PUT',
                        data : $editResidentForm.serialize(),
                        success : function (data) {
                            window.location = `/residents/${data.id}`;
                        }
                    });
                },
                rules: {
                    firstname: {
                        required: true,
                    },
                    lastname: {
                        required: true
                    },
                    patronymic: {
                        required: true
                    },
                    source: {
                        required: true
                    },
                    gender: {
                        required: true
                    },
                    role: {
                        required: true
                    },
                    birthday: {
                        required: true
                    },
                    balance: {
                        required: true
                    },
                    registered_at: {
                        required: true,
                    },
                    status: {
                        required: false,
                    },
                },
                messages: {
                    firstname: {
                        required: "Пожалуйста, введите имя",
                    },
                    lastname: {
                        required: "Пожалуйста, введите фамилию",
                    },
                    patronymic: {
                        required: "Пожалуйста, введите отчество",
                    },
                    source: {
                        required: "Пожалуйста, введите источник поступления"
                    },
                    gender: {
                        required: "Пожалуйста, выберете пол",
                    },
                    role: {
                        required: "Пожалуйста, введите кем приходится",
                    },
                    birthday: {
                        required: "Пожалуйста, введите дату рождения",
                    },
                    balance: {
                        required: "Пожалуйста, введите баланс",
                    },
                    registered_at: {
                        required: "Пожалуйста, введите баланс",
                    },
                    status: {
                        required: "Пожалуйста, выберете статус резидента",
                    },
                },
            });
        });
    </script>
@stop
