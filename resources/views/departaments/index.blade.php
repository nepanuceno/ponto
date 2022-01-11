@extends('adminlte::page')

@section('title', 'Departamentos')

@section('content_header')
    <h1>Departamentos</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('danger'))
        <div class="alert alert-danger">
            {{ session('danger') }}
        </div>
    @endif

    @can('servidor-create')
        <a class="btn btn-primary mb-4" href="{{ route('departaments.create') }}"><span class="fas fa-plus mr-1"></span>Novo</a>
    @endcan
    @if (count($departaments) > 0)
        <div class="card">
            <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                    <thead>
                        <tr>
                            <th>Departamentos</th>
                            @can(['servidor-edit', 'servidor-delete'])
                                <th class="text-center">Departamento</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departaments as $departament)
                            <tr>
                                <td style="width: 78%">{{ $departament->name }}</td>
                                @can(['servidor-edit', 'servidor-delete'])

                                    <td>
                                        <form action="{{ url('departaments/' . $departament->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            {{-- <input type="hidden" name="departament_id" value="{{ $departament->id }}"/> --}}
                                            <button class="btn btn-app float-right disable"><i class="fas fa-trash"></i>
                                                Excluir</button>
                                        </form>
                                        <a class="btn btn-app float-right" href="departaments/{{ $departament->id }}/edit">
                                            <i class="fas fa-edit"></i> Editar</a>
                                    </td>
                                @endcan
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $departaments->links() }}
        </div>
    @else
        <div class="alert alert-info">Não existem departamentos cadastrados</div>
    @endif
@stop

@section('js')
    <script>
        var a = document.querySelectorAll('.disable')
        a.forEach(element => {
            element.addEventListener('click', function disable(e) {
                console.log(this.parentElement)
                e.preventDefault()

                Swal.fire({
                    title: 'Confirma?',
                    text: "Está ação poderá ser revertida",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, desativar!'
                }).then((result) => {
                    if (result.value) {
                        this.parentElement.submit()
                    } else {
                        return false
                    }
                })
            })
        });
    </script>
@stop
