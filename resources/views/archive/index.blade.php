@extends('adminlte::page')

@section('title', 'Архив')

@section('content_header')
    <h1>Архив</h1>

    {{ Breadcrumbs::render('archive.index') }}
@stop

@section('content')
    <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="row d-flex align-items-stretch">
                @each('archive.component.card', $residents, 'resident')
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            {{ $residents->links() }}
        </div>
        <!-- /.card-footer -->
    </div>
@stop
