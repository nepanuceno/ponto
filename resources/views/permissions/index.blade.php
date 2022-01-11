@extends('adminlte::page')
@section('title', 'Permissões')

@section('content')
    <div class="row">
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

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nome</th>
            <th width="280px">Ações</th>
        </tr>

        @foreach ($permissions as $key => $permission)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $permission->name }}</td>
                <td>
                    <a class="btn btn-info" href="{{ route('permissions.show', $permission->id) }}">Detalhes</a>
                    @can('permissao-edit')
                        <a class="btn btn-primary" href="{{ route('permissions.edit', $permission->id) }}">Editar</a>
                    @endcan

                    @can('permissao-delete')
                        {!! Form::open(['method' => 'DELETE', 'route' => ['permissions.destroy', $permission->id], 'style' => 'display:inline']) !!}
                        {!! Form::submit('Desativar', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    @endcan
                </td>
            </tr>
        @endforeach
    </table>

    {!! $permissions->render() !!}

@endsection
