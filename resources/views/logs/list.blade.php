@extends('adminlte::page')

@section('title', 'Logs')

@section('content_header')
    <h1>Logs</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- The time line -->
            <div class="timeline">
                @foreach ($logs as $log)
                    <!-- timeline time label -->
                    <div class="time-label">
                        <span class="bg-red">
                            {{ str_replace('º ', ' de ', Carbon\Carbon::createFromIsoFormat('YYYY-MM-DD HH:mm:ss', $log->created_at, 'UTC')->isoFormat('Do MMM. YYYY [as] hh:mm:ss')) }}
                        </span>
                    </div>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <div>
                        <i class="fas fa-user bg-green"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="fas fa-clock"></i>
                                {{ Carbon\Carbon::parse('2019-08-03')->diffForHumans(Carbon\Carbon::now(), Carbon\CarbonInterface::DIFF_RELATIVE_TO_NOW) }}
                            </span>
                            <h3 class="timeline-header no-border"><a
                                    href="#">{{ App\Models\User::find($log->causer_id)->name }}</a>
                                <span class="comment-text">{!! $log->description !!}</span>
                            </h3>
                        </div>
                    </div>
                    <!-- END timeline item -->
                @endforeach
                <div>
                    <i class="fas fa-clock bg-gray"></i>
                </div>
            </div>
        </div>
        <!-- /.col -->
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
