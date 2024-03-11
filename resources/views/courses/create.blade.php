@extends('layouts.master')

@section('content')
    <div class="container-fluid px-4">
        <div class="mb-1 space-between-elements">
            <h2 class="ms-2 mt-3 me-3">Curso</h2>
            <ol class="breadcrumb mb-3 mt-3 p-1 bg-light rounded">
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('course.index') }}">Cursos</a></li>
                <li class="breadcrumb-item active">Curso</li>
            </ol>
        </div>

        <div class="card mb-4 border-light shadow">
            <div class="card-header space-between-elements">
                <span>Cadastrar</span>
                <span class="d-flex">

                    <a href="{{ route('course.index') }}" class="btn btn-secondary btn-sm me-1"><i class="fa-solid fa-arrow-left"></i>
                        Voltar</a>

                </span>
            </div>
            <div class="card-body">
                <x-alert/>
                <form action="{{ route('course.store') }}" method="POST" class="row g-3">
                    @csrf
                    @method('POST')

                    <div class="col-12">
                        <label for="name" class="form-label">Nome: </label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Nome do curso"
                            value="{{ old('name') }}">
                    </div>

                    <div class="col-12">
                        <label for="price" class="form-label">Preço: </label>
                        <input type="text" name="price" id="price" class="form-control"
                        value="{{ old('price') }}">
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-success bt-sm">Cadastrar</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
