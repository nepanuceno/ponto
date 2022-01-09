@extends('adminlte::page')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Gerenciamento de Permissões</h2>
            </div>
            <div class="pull-right">
                @can('permission-create')
                    <a class="btn btn-success" href="{{ route('permissions.create') }}"> Criar nova Permissão</a>
                @endcan
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
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
                    @can('permission-edit')
                        <a class="btn btn-primary" href="{{ route('permissions.edit', $permission->id) }}">Editar</a>
                    @endcan

                    @can('permission-delete')
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
