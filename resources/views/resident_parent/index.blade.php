@extends('adminlte::page')

@section('title', 'Родственики')

@section('content_header')
    <h1>Родственики</h1>

    {{ Breadcrumbs::render('parent.index') }}
@stop

@section('content')
    <div class="card card-solid">
        <div class="card-body pb-0">
            @if ($parents->count() > 0)
                <div class="row d-flex align-items-stretch">
                    @each('resident_parent.component.card', $parents, 'parent')
                </div>
            @else
                <p class="text-center">Данные отсутствуют</p>
            @endif
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            {{ $parents->links() }}
        </div>
        <!-- /.card-footer -->
    </div>
@stop
