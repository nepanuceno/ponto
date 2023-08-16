@extends('adminlte::page')
@section('title', 'Configurações')

@section('breadcrumb')
    {{ Breadcrumbs::render('settings.index') }}
@stop

@section('content')
    <div class="col-md-4">
        <div class="card card-widget widget-user-2">
            <div class="widget-user-header bg-warning">
                <h3 class="widget-user-username">Nadia Carmichael</h3>
                <h5 class="widget-user-desc">Lead Developer</h5>
            </div>
            <div class="card-footer p-0">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="{{ route('logo.index') }}" class="nav-link">
                            Cadastrar Logo da Instituição <span class="float-right badge bg-primary">31</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Tasks <span class="float-right badge bg-info">5</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Completed Projects <span class="float-right badge bg-success">12</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Followers <span class="float-right badge bg-danger">842</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
