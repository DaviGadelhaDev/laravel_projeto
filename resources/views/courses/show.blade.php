@extends('layouts.master')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 space-between-elements">
            <h2 class="mt-3">Curso</h2>
            <ol class="breadcrumb mb-3 mt-3">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('course.index') }}">Cursos</a></li>
                <li class="breadcrumb-item active">Curso</li>
            </ol>
        </div>

        <div class="card mb-4">
            <div class="card-header space-between-elements">
                <span>Visualizar</span>
                <span class="d-flex">

                    <a href="{{ route('classe.index', ['course' => $course->id]) }}" class="btn btn-info btn-sm me-1"><i
                            class="fa-solid fa-list"></i> Aulas</a>

                    <a href="{{ route('course.edit', ['course' => $course->id]) }}" class="btn btn-warning btn-sm me-1"><i
                            class="fa-solid fa-pen-to-square"></i> Editar
                    </a>

                    <form method="POST" action="{{ route('course.destroy', ['course' => $course->id]) }}">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm me-1"
                            onclick="return confirm('Tem certeza que deseja apagar este registro?')"><i
                                class="fa-regular fa-trash-can"></i> Apagar</button>
                    </form>
                </span>
            </div>
            <div class="card-body">

                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <dl class="row">

                    <dt class="col-sm-3">ID: </dt>
                    <dd class="col-sm-9">{{ $course->id }}</dd>

                    <dt class="col-sm-3">Nome: </dt>
                    <dd class="col-sm-9">{{ $course->name }}</dd>

                    <dt class="col-sm-3">Preço: </dt>
                    <dd class="col-sm-9">{{ 'R$ ' . number_format($course->price, 2, ',', '.') }}</dd>

                    <dt class="col-sm-3">Cadastrado: </dt>
                    <dd class="col-sm-9">
                        {{ \Carbon\Carbon::parse($course->created_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s') }}
                    </dd>

                    <dt class="col-sm-3">Editado: </dt>
                    <dd class="col-sm-9">
                        {{ \Carbon\Carbon::parse($course->updated_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s') }}
                    </dd>

                </dl>
            </div>
        </div>
    </div>
@endsection
