@extends('adminlte::page')

@section('title', 'Cadastro de Servidor')

@section('content_header')
    <h1>{{ isset($employeeCadastro) ? 'Edição de Servidor' : 'Cadastro de Servidor' }}</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismiss">
            {{ session('success') }}
        </div>
    @endif
    @if (session('danger'))
        <div class="alert alert-danger">
            {{ session('danger') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card card-info">
        <form action="{{ isset($employee) ? url('employees/' . $employee->id) : url('employees') }}" method="POST">
            <div class="card-body">
                @csrf
                @if (isset($employee))
                    @method('PUT')
                @endif

                <div class="form-group">
                    <div class="input-form">
                        <label class="form-label" for="employee">Servidor</label>
                        <input class="form-control" name="name" id="employee"
                            value="{{ isset($employee) ? $employee->name : old('name') }}" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-form">
                        <label class="form-label" for="email">E-Mail</label>
                        <input class="form-control" name="email" id="email"
                            value="{{ isset($employee) ? $employee->email : old('email') }}" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-form">
                        <label class="form-label" for="telephone">Telefone</label>
                        <input class="form-control" name="telephone" id="telephone"
                            value="{{ isset($employee) ? $employee->telephone : old('telephone') }}" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-form">
                        <label class="form-label" for="matriculation">Matrícula</label>
                        <input class="form-control" name="matriculation" id="matriculation"
                            value="{{ isset($employee) ? $employee->matriculation : old('matriculation') }}" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-form">
                        <label class="form-label" for="departament">Departamento</label>
                        <select class="form-control select2" name="departament" id="departament">
                            @foreach ($departaments as $item)
                                <option value="{{ $item->id }}"
                                    {{ isset($employee) ? ($employee->departament_id == $item->id ? 'selected=selected' : '') : '' }}>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-form">
                        <label class="form-label" for="position">Cargo</label>
                        <select class="form-control select2" name="position" id="position">
                            @foreach ($positions as $item)
                                <option value="{{ $item->id }}"
                                    {{ isset($employee) ? ($employee->position_id == $item->id ? 'selected=selected' : '') : '' }}>
                                    {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">{{ isset($employee) ? 'Salvar' : 'Cadastrar' }}</button>
                <a class="btn btn-secondary float-right" href="{{ route('employees.index') }}">Voltar</a>
            </div>
        </form>
    </div>
@stop
@section('js')
    <script>
        $('.select2').select2({
            placeholder: 'Select an option'
        });
    </script>
@stop
