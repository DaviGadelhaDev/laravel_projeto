@extends('layouts.master')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 space-between-elements">
            <h2 class="ms-2 mt-3 me-3">Curso</h2>
            <ol class="breadcrumb mb-3 mt-3">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('course.index') }}">Cursos</a></li>
                <li class="breadcrumb-item active">Curso</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header space-between-elements">
                <span>Editar</span>
                <span class="d-flex">

                    <a href="{{ route('course.index') }}" class="btn btn-info btn-sm me-1"><i class="fa-solid fa-list"></i>
                        Listar</a>

                    <a href="{{ route('course.show', ['course' => $course->id]) }}" class="btn btn-primary btn-sm me-1"><i
                            class="fa-regular fa-eye"></i> Visualizar
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

                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('course.update', ['course' => $course->id]) }}" method="POST" class="row g-3">
                    @csrf
                    @method('PUT')

                    <div class="col-12">
                        <label for="name" class="form-label">Nome: </label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Nome do curso"
                            value="{{ old('name', $course->name) }}">
                    </div>

                    <div class="col-12">
                        <label for="price" class="form-label">Preço: </label>
                        <input type="text" name="price" id="price" class="form-control"
                            placeholder="Usar '.' separar real do centavo" value="{{ old('price', $course->price) }}">
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-warning bt-sm">Salvar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
