@extends('adminlte::page')

@section('title', 'Команда')

@section('content_header')
{{--    <h1 class="m-0 text-dark">Команда</h1>--}}
    <div class="row mb-2">
        <div class="col-6">
            <h1>Команда</h1>
        </div>
        <div class="col-6">
            <div class="text-right">
                <a href="#" class="btn btn-success">Создать</a>
            </div>
        </div>
    </div>
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
@stop
