@extends('adminlte::page')

@section('breadcrumb')
    {{ Breadcrumbs::render('users.show', $user) }}
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                            src="https://www.seekpng.com/png/full/428-4287240_no-avatar-user-circle-icon-png.png"
                            alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">{{ $user->name }}</h3>
                    <p class="text-muted text-center">{{ $user->email }}</p>
                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            @if (!empty($user->getRoleNames()))
                                @foreach ($user->getRoleNames() as $v)
                                    <label class="badge badge-success">{{ $v }}</label>
                                @endforeach
                            @endif
                        </li>
                    </ul>
                    <a href="{{ route('users.index') }}" class="btn btn-primary btn-block"><b>Voltar</b></a>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection
