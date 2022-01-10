@extends('adminlte::page')

@section('title', 'Servidores')

@section('content_header')
    <h1>Servidores</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismiss">
            {{ session('success') }}
        </div>
    @endif
    @if (session('danger'))
        <div class="alert alert-danger alert-dismiss">
            {{ session('danger') }}
        </div>
    @endif

    @can('servidor-create')
        <a class="btn btn-primary mb-4" href="{{ route('employees.create') }}"><span class="fas fa-plus mr-1"></span>Novo</a>
    @endcan

    @if (count($employees) > 0)
        <div class="card">
            <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                    <thead>
                        <tr>
                            <th>Servidores</th>
                            @can('servidor-edit|servidor-delete')
                                <th>Ações</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td style="width: 80%">{{ $employee->name }}</td>
                                <td>
                                    @can('servidor-edit')
                                        <form action="{{ url('employees/' . $employee->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            {{-- <input type="hidden" name="departament_id" value="{{ $employee->id }}"/> --}}
                                            <button class="btn btn-app float-right disable"><i class="fas fa-trash"></i>
                                                Excluir</button>
                                        </form>
                                    @endcan
                                    @can('servidor-edit')
                                        <a class="btn btn-app float-right" href="employees/{{ $employee->id }}/edit">
                                            <i class="fas fa-edit"></i> Editar</a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $employees->links() }}
        </div>
    @else
        <div class="alert alert-info">Não existem Servidores ativos ou cadastrados</div>
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
                    text: "Esta ação poderá ser revertida",
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
