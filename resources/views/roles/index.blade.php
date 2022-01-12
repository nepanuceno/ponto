@extends('adminlte::page')
@section('title', 'Perfis')
@section('content')
    <div class="row mb-2">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Gerenciamento de Perfis</h2>
            </div>
            <div class="pull-right">
                @can('perfil-create')
                    <a class="btn btn-success" href="{{ route('roles.create') }}"> Criar novo Perfil</a>
                @endcan
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

    <table class="table table-bordered table-sm table-striped">
        <thead class="thead-dark ">
            <tr>
                <th class="text-center" width="5%">No</th>
                <th>Nome</th>
                <th width="10%">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $key => $role)
                <tr>
                    <td class="text-center font-weight-bold">{{ ++$i }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <div class="btn-group float-right">
                            <button type="button" class="btn btn-default">Ações</button>
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu" style="">
                                <a class="dropdown-item" href="{{ route('roles.show', $role->id) }}"><i
                                        class="fas fa-info mr-2"></i>Detalhes</a>
                                @can('perfil-edit')
                                    <a class="dropdown-item" href="{{ route('roles.edit', $role->id) }}"><i
                                            class="fas fa-edit mr-2"></i>Editar</a>
                                @endcan
                                @can('perfil-delete')
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style' => 'display:inline']) !!}
                                    {!! Form::button('<i class="fas fa-trash mr-2"></i>Excluir', ['type' => 'submit', 'class' => 'dropdown-item']) !!}
                                    {!! Form::close() !!}
                                @endcan
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $roles->render() !!}
@endsection
