@extends('adminlte::page')
@section('title', 'Configurações')

@section('breadcrumb')
    {{ Breadcrumbs::render('logo.create') }}
@stop

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading"><h2>Logo da Instituição</h2></div>
            <div class="panel-body">

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                {{-- @dd(Session::get('image')) --}}

                @foreach (Session::get('image') as $image)
                    <span><img src="/images/logo/{{ $image }}" width="80"></span>
                @endforeach
            @endif

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('logo.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="formFile" class="form-label">Logo</label>
                        <input type="file" name="file_logo" id="file_logo" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
