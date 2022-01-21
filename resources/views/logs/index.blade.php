@extends('adminlte::page')

@section('title', 'Logs')

@section('content_header')
    <h1>Consulta de Logs</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-md-6">
            <form action="" method="POST" name="logs">
                <div class="form-group">
                    <label for="user_id">Usuário</label>
                    <select class="form-control select2" id="user_id">
                      @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                      @endforeach
                    </select>
                  </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Intervalo de Data e hora:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-clock"></i></span>
                  </div>
                  <input type="text" class="form-control float-right" id="dates">
                </div>
              </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(function() {
            moment.locale('pt-br');
            $('#dates').daterangepicker({
                timePicker: true,
                timePickerIncrement: 30,
                locale: {
                    format: 'MM/DD/YYYY hh:mm A'
                }
            })
        })
    </script>

@stop
