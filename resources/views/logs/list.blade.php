@extends('adminlte::page')
@section('title', 'Logs')
@section('content_header')
    <h1>Logs</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="timeline">
                @foreach ($logs as $log)
                    <div class="time-label">
                        <span class="bg-red">
                            {{ formatDateInFull($log->created_at) }}
                        </span>
                    </div>
                    <div>
                        <i class="fas fa-user bg-green"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i>
                                {{ diffDateInFull($log->created_at) }}
                            </span>
                            <h3 class="timeline-header no-border"><a
                                    href="#">{{ App\Models\User::find($log->causer_id)->name }}</a>
                                <span class="comment-text">{!! $log->description !!}</span>
                            </h3>
                        </div>
                    </div>
                @endforeach
                <div>
                    <i class="fas fa-clock bg-gray"></i>
                </div>
            </div>
        </div>
    </div>
@stop
