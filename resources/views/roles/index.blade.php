@extends('adminlte::page')

@section('title', 'Perfis')

@section('content')

    <div class="row">

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


    <table class="table table-bordered">

        <tr>

            <th>No</th>

            <th>Nome</th>

            <th width="280px">Ações</th>

        </tr>

        @foreach ($roles as $key => $role)

            <tr>

                <td>{{ ++$i }}</td>

                <td>{{ $role->name }}</td>

                <td>

                    <a class="btn btn-info" href="{{ route('roles.show', $role->id) }}">Detalhes</a>

                    @can('perfil-edit')

                        <a class="btn btn-primary" href="{{ route('roles.edit', $role->id) }}">Editar</a>

                    @endcan

                    @can('perfil-delete')

                        {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style' => 'display:inline']) !!}

                        {!! Form::submit('Desativar', ['class' => 'btn btn-danger']) !!}

                        {!! Form::close() !!}

                    @endcan

                </td>

            </tr>

        @endforeach

    </table>


    {!! $roles->render() !!}

@endsection
