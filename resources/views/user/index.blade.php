@extends('adminlte::page')

@section('title', 'Команда')

@section('content_header')
    <div class="row mb-2">
        <div class="col-6">
            <h1>Команда</h1>
        </div>
        <div class="col-6">
            <div class="text-right">
                <button href="#" class="btn btn-success" data-toggle="modal" data-target="#modal-user-create">Создать</button>
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

    @include('user.modal.create')
@stop
