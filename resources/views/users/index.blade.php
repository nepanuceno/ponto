@extends('adminlte::page')
@section('title', 'Usuários')

@section('breadcrumb')
    {{ Breadcrumbs::render('users.index') }}
@stop

@section('content')
    <div class="row mb-2">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Gerencimento de Usuários</h2>
            </div>

            <div class="pull-right">
                <a class="btn btn-secondary float-right" href="{{ route('users.create') }}"><i class="fas fa-user-plus"></i> Criar Novo Usuário</a>
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
    <div class="table-responsive-sm table-responsive-md">
        <table class="table table-bordered table-sm table-striped table-hover">
            <thead class="thead-dark ">
                <tr>
                    <th class="text-center" width="5%">No</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Perfis</th>
                    <th class="text-center" width="10%">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $user)
                    <tr>
                        <td class="text-center font-weight-bold">{{ ++$i }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if (!empty($user->getRoleNames()))
                                @foreach ($user->getRoleNames() as $v)
                                    <label class="badge badge-info">{{ $v }}</label>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            <div class="btn-group float-right">
                                <button type="button" class="btn btn-default">Ações</button>
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                    aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu" style="">
                                    <a class="dropdown-item" href="{{ route('users.show', $user->id) }}">
                                        <i class="fas fa-info mr-2"></i>Detalhes</a>
                                    <a class="dropdown-item" href="{{ route('users.edit', $user->id) }}">
                                        <i class="fas fa-edit mr-2"></i>Editar</a>
                                    <div class="dropdown-divider"></div>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline']) !!}
                                    {{ Form::button('<i class="fas fa-trash mr-2"></i>Excluir', ['type' => 'submit', 'class' => 'dropdown-item']) }}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {!! $data->render() !!}
@endsection
