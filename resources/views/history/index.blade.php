@extends('adminlte::page')

@section('title', 'История')

@section('content_header')
    <h1>История</h1>

    {{ Breadcrumbs::render('history.index') }}
@stop

@section('content')
    <div class="timeline">

        @foreach($events as $publishAt => $_events)
            <!-- timeline time label -->
            <div class="time-label">
                <span class="bg-red">{{ $publishAt }}</span>
            </div>
            <!-- /.timeline-label -->
            @foreach($_events as $event)
                <!-- timeline item -->
                <div>
                    <i class="{{ $event->icon }} bg-{{ $event->color }}"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fas fa-clock"></i> {{ $event->created_at->format('d.m.Y H:i:s') }}</span>
                        <h3 class="timeline-header">{!! $event->title !!}</h3>

                        @if ($event->description)
                            <div class="timeline-body">
                                {!! $event->description !!}
                            </div>
                        @endif
                    </div>
                </div>
                <!-- END timeline item -->
            @endforeach
        @endforeach

        <div>
            <i class="fas fa-clock bg-gray"></i>
        </div>
    </div>
@stop
