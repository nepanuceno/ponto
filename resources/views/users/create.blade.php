@extends('adminlte::page')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Criar Novo Usuário</h2>
        </div>

        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Voltar</a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>Whoops!</strong> Houve algum problema com os dados.<br><br>
    <ul>
       @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
       @endforeach
    </ul>
  </div>
@endif

{!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nome:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Nome','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Senha:</strong>
            {!! Form::password('password', array('placeholder' => 'Senha','class' => 'form-control')) !!}
        </div>

    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Confirme a senha:</strong>
            {!! Form::password('confirm-password', array('placeholder' => 'Senha','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Perfil:</strong>
            {!! Form::select('roles[]', $roles,[], array('class' => 'form-control select2','multiple')) !!}
        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </div>
</div>

{!! Form::close() !!}
@endsection
