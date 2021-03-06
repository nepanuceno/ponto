@extends('adminlte::page')

@section('breadcrumb')
    {{ Breadcrumbs::render('roles.create') }}
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Criar Novo Perfil</h2>
            </div>
            <div class="pull-right float-right">
                <a class="btn btn-secondary" href="{{ route('roles.index') }}"><i class="fas fa-arrow-left mr-1"></i> Voltar</a>
            </div>
        </div>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismiss">
            <strong>Whoops!</strong> Houve erros nos dados.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::open(['route' => 'roles.store', 'method' => 'POST']) !!}
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nome:</strong>
                {!! Form::text('name', null, ['placeholder' => 'Nome', 'class' => 'form-control']) !!}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permissões:</strong>
                <br />
                @foreach ($permission as $value)
                    <label>{{ Form::checkbox('permission[]', $value->id, false, ['class' => 'name']) }}
                        {{ $value->name }}</label>
                    <br />
                @endforeach
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>Cadastrar</button>
        </div>
    </div>

    {!! Form::close() !!}

@endsection
