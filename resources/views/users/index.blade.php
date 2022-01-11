@extends('adminlte::page')
@section('title', 'Usuários')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Gerencimento de Usuários</h2>
            </div>

            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('users.create') }}"> Criar Novo Usuário</a>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismiss d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                <use xlink:href="#check-circle-fill" />
            </svg>
            <div class="ml-2">
                {{ session('success') }}
            </div>
        </div>
    @endif
    @if (session('danger'))
        <div class="alert alert-danger alert-dismiss d-flex align-items-center" role="alert">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                <use xlink:href="#exclamation-triangle-fill" />
            </svg>
            <div class="ml-2">
                {{ session('danger') }}
            </div>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Perfis</th>
            <th width="280px">Ações</th>
        </tr>

        @foreach ($data as $key => $user)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if (!empty($user->getRoleNames()))
                        @foreach ($user->getRoleNames() as $v)
                            <label class="badge badge-success">{{ $v }}</label>
                        @endforeach
                    @endif
                </td>
                <td>
                    <a class="btn btn-info" href="{{ route('users.show', $user->id) }}">Detalhes</a>
                    <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Editar</a>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>

    {!! $data->render() !!}
@endsection
