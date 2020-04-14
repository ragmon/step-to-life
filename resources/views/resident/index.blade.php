@extends('adminlte::page')

@section('title', 'Резиденты')

@section('content_header')
    <div class="row">
        <div class="col-6">
            <h1>Резиденты</h1>
        </div>
        <div class="col-6">
            <div class="text-right">
                <a href="{{ route('residents.create') }}" class="btn btn-success">Создать</a>
            </div>
        </div>
    </div>

    {{ Breadcrumbs::render('resident.index') }}
@stop

@section('content')
    <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="row d-flex align-items-stretch">
                @each('resident.component.card', $residents, 'resident')
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            {{ $residents->links() }}
        </div>
        <!-- /.card-footer -->
    </div>
@stop
