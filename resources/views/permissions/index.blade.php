@extends('adminlte::page')
@section('title', 'Permissões')

@section('content')
    <div class="row mb-2">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Gerenciamento de Permissões</h2>
            </div>
            <div class="pull-right">
                @can('permissao-create')
                    <a class="btn btn-success" href="{{ route('permissions.create') }}"> Criar nova Permissão</a>
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

    <table class="table table-bordered table-sm table-striped table-hover table-valign-middle">
        <thead class="thead-dark ">
            <tr>
                <th class="text-center" width="5%">No</th>
                <th>Nome</th>
                <th class="text-center" width="10%">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permissions as $key => $permission)
                <tr>
                    <td class="text-center font-weight-bold"> {{ ++$i }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>
                        <div class="btn-group float-right">
                            <button type="button" class="btn btn-default">Ações</button>
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu" role="menu" style="">
                                <a class="dropdown-item" href="{{ route('permissions.show', $permission->id) }}"><i
                                        class="fas fa-info mr-2"></i>Detalhes</a>
                                @can('permissao-edit')
                                    <a class="dropdown-item" href="{{ route('permissions.edit', $permission->id) }}"><i
                                            class="fas fa-edit mr-2"></i>Editar</a>
                                @endcan

                                @can('permissao-delete')
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id], 'style' => 'display:inline']) !!}
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

    {!! $permissions->render() !!}

@endsection
