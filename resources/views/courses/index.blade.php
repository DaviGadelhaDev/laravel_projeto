@extends('layouts.master')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 space-between-elements">
            <h2 class="ms-2 mt-3 me-3">Cursos</h2>
            <ol class="breadcrumb mb-3 mt-3 p-1 bg-light rounded">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Cursos</li>
            </ol>
        </div>

        <div class="card  mb-4 border-light shadow">
            <div class="card-header space-between-elements">
                <span>Listar</span>
                <span>
                    <a href="{{ route('course.create') }}" class="btn btn-success btn-sm"><i
                            class="fa-regular fa-square-plus"></i> Cadastrar</a>
                </span>
            </div>
            <div class="card-body">
                <x-alert/>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th class="d-none d-md-table-cell">Preço</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($courses as $course)
                            <tr>
                                <th>{{ $course->id }}</th>
                                <td>{{ $course->name }}</td>
                                <td class="d-none d-md-table-cell">{{ 'R$ ' . number_format($course->price, 2, ',', '.') }}</td>
                                <td class="d-md-flex justify-content-center">
                                    <a href="{{ route('classe.index', ['course' => $course->id]) }}"
                                        class="btn btn-info btn-sm me-1 mb-1">
                                        <i class="fa-solid fa-list"></i> Aulas
                                    </a>

                                    <a href="{{ route('course.show', ['course' => $course->id]) }}"
                                        class="btn btn-primary btn-sm me-1 mb-1">
                                        <i class="fa-regular fa-eye"></i> Visualizar
                                    </a>

                                    <a href="{{ route('course.edit', ['course' => $course->id]) }}"
                                        class="btn btn-warning btn-sm me-1 mb-1">
                                        <i class="fa-solid fa-pen-to-square"></i> Editar
                                    </a>

                                    <form method="POST" action="{{ route('course.destroy', ['course' => $course->id]) }}">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm me-1 mb-1"
                                            onclick="return confirm('Tem certeza que deseja apagar este registro?')"><i
                                                class="fa-regular fa-trash-can"></i> Apagar</button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger" role="alert">Nenhum curso encontrado!</div>
                        @endforelse

                    </tbody>
                </table>

                    {{ $courses->onEachSide(0)->links() }}

            </div>
        </div>
    </div>
@endsection
