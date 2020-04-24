@extends('adminlte::page')

@section('title', 'Создание резидента')

@section('content_header')
    {{ Breadcrumbs::render('resident.create') }}
@stop

@section('content')
    <form id="create-resident-form" class="card bg-light w-100" action="{{ route('residents.store') }}" method="post">
        <div class="card-body">
            <h2 class="lead"><b>Создание резидента</b></h2>

            <div class="row">
                <div class="col-md-6 col-xl-3">
                    <div class="form-group">
                        <label>Имя</label>
                        <input class="form-control" name="firstname" type="text" value="{{ old('firstname') }}" placeholder="Иван">
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="form-group">
                        <label>Фамилия</label>
                        <input class="form-control" name="lastname" type="text" value="{{ old('lastname') }}" placeholder="Иванов">
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="form-group">
                        <label>Отчество</label>
                        <input class="form-control" name="patronymic" type="text" value="{{ old('patronymic') }}" placeholder="Василиевич">
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="form-group">
                        <label>Статус</label>
                        <div class="form-check">
                            <input class="form-check-input" name="status" type="checkbox" value="1" id="resident-status">
                            <label class="form-check-label" for="resident-status">прошел реабилитацию</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="form-group">
                        <label>Источник поступления</label>
                        <input class="form-control" name="source" type="text" value="{{ old('source') }}" placeholder="Клиника Благо">
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="form-group">
                        <label>Баланс</label>
                        <input class="form-control" name="balance" type="text" value="{{ old('balance') }}" placeholder="500">
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="form-group">
                        <label>Пол</label>
                        <div class="form-check">
                            <input class="form-check-input" name="gender" type="radio" value="1" id="gender-1">
                            <label class="form-check-label" for="gender-1">мужской</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="gender" type="radio" value="0" id="gender-0">
                            <label class="form-check-label" for="gender-0">женский</label>
                        </div>
                    </div>
                </div>
{{--                <div class="col-md-6 col-xl-3">--}}
{{--                    <div class="form-group">--}}
{{--                        <label>Телефон</label>--}}
{{--                        <input class="form-control" name="phone" type="tel" value="{{ old('phone') }}" placeholder="+3 (756) 54 453">--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="col-md-6 col-xl-3">
                    <div class="form-group">
                        <label>Дата рождения</label>
                        <input class="form-control" name="birthday" type="date" value="{{ old('birthday') }}">
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="form-group">
                        <label>Дата регистрации</label>
                        <input class="form-control" name="registered_at" type="date" value="{{ old('registered_at') }}">
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="form-group">
                        <label>Дополнительная информация</label>
                        <textarea class="form-control" name="about" placeholder="Иностранец">{{ old('about') }}</textarea>
                    </div>
                </div>
                <div class="col-md-12 text-right">
                    <button class="btn btn-success" type="submit">Создать</button>
                </div>
            </div>
        </div>
    </form>
@stop

@section('js')
    <script>
        $(function () {
            let $createResidentForm = $('#create-resident-form');

            $createResidentForm.validate({
                submitHandler: function () {
                    $.ajax({
                        url : `/residents`,
                        method : 'POST',
                        data : $createResidentForm.serialize(),
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
                    // phone: {
                    //     required: true
                    // },
                    balance: {
                        required: true
                    },
                    registered_at: {
                        required: true,
                    },
                    status: {
                        // required: true,
                    },
                    // about: {
                    //     required: true
                    // }
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
                    // phone: {
                    //     required: "Пожалуйста, введите номер телефона",
                    // },
                    balance: {
                        required: "Пожалуйста, введите баланс",
                    },
                    registered_at: {
                        required: "Пожалуйста, введите баланс",
                    },
                    status: {
                        required: "Пожалуйста, выберете статус резидента",
                    },
                    // about: {
                    //     required: "Пожалуйста введите ",
                    // },
                },
            });
        });
    </script>
@stop
