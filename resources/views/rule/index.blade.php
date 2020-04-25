@extends('adminlte::page')

@section('title', 'Правила')

@section('content_header')
    <div class="row">
        <div class="col-6">
            <h1>Правила</h1>
        </div>
        <div class="col-6">
            <div class="text-right">
                <a href="{{ route('rules.create') }}" class="btn btn-success">Создать</a>
            </div>
        </div>
    </div>

    {{ Breadcrumbs::render('rule.index') }}
@stop

@section('content')
    <div class="card card-solid">
        <div class="card-body pb-3">
            @if ($rules->count() > 0)
                <table id="punishments" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Заголовок</th>
                        <th>Дата создания</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rules as $rule)
                        <tr>
                            <td><a href="{{ route('rules.show', [$rule->id]) }}">{{ $rule->title }}</a></td>
                            <td>{{ $rule->created_at->format('d.m.Y H:i:s') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Заголовок</th>
                        <th>Дата создания</th>
                    </tr>
                    </tfoot>
                </table>
            @else
                <p class="text-center">Данные отсутствуют</p>
            @endif
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            {{ $rules->links() }}
        </div>
        <!-- /.card-footer -->
    </div>
@stop

@section('js')

@stop
