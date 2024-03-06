@extends('layouts.master')
@section('content')
    <br>
    <a href="{{ route('classe.index', ['course' => $course->id]) }}">
        <button type="button">
            Listar
        </button>
    </a><br>

    <h2>Cadastrar Aula</h2>

    @if (session('error'))
        <p style="color: #f00">
            {{ session('error') }}
        </p>
    @endif

    @if ($errors->any())
        <span style="color: #f00">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </span>
    @endif
    <br>

    <form action="{{ route('classe.store') }}" method="POST">
        @csrf
        @method('POST')

        <input type="hidden" name="course_id" id="course_id" value="{{ $course->id }}">

        <label>Nome: </label>
        <input type="text" name="name" id="name" placeholder="Nome da aula" value="{{ old('name') }}"><br><br>

        <label>Descrição: </label>
        <textarea name="description" rows="4" cols="30" id="description">{{ old('description') }}</textarea><br><br>

        <button type="submit">Cadastrar</button>

    </form>
@endsection
