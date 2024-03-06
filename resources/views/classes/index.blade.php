@extends('layouts.master')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 space-between-elements">
            <h2 class="mt-3">Aulas</h2>
            <ol class="breadcrumb mb-3 mt-3">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active">Cursos</li>
            </ol>
        </div>
        <div class="card mb-4">
            <div class="card-header space-between-elements">
                <span>Listar</span>
                <span>
                    <a href="{{ route('course.index') }}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list"></i> Cursos</a>
                    <a href="{{ route('classe.create', ['course' => $course->id]) }}" class="btn btn-success btn-sm"><i class="fa-regular fa-square-plus"></i> Cadastrar</a>
                </span>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <p style="color: #082">
                        {{ session('success') }}
                    </p>
                @endif
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Ordem</th>
                            <th>Curso</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($classes as $classe)
                            <tr>
                                <th>{{ $classe->id }}</th>
                                <td>{{ $classe->name }}</td>
                                <td>{{ $classe->order_classe }}</td>
                                <td>{{ $classe->course->name }}</td>
                                <td class="d-flex justify-content-center">

                                    <a href="{{ route('classe.show', ['classe' => $classe->id]) }}" class="btn btn-primary btn-sm me-1">
                                        <i class="fa-regular fa-eye"></i> Visualizar
                                    </a>

                                    <a href="{{ route('classe.edit', ['classe' => $classe->id]) }}" class="btn btn-warning btn-sm me-1">
                                        <i class="fa-solid fa-pen-to-square"></i> Editar
                                    </a>

                                    <form method="POST" action="{{ route('classe.destroy', ['classe' => $classe->id]) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm me-1"
                                            onclick="return confirm('Tem certeza que deseja apagar este registro?')"><i class="fa-regular fa-trash-can"></i> Apagar</button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">Nenhuma aula encontrada!</div>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection