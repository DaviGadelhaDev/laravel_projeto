@extends('master')
@section('content')
<a href="{{ route('course.index') }}">Listar</a><br>

<h2>Cadastrar Curso</h2>

@if ($errors->any())
    <span style="color: #f00">
        @foreach ($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
    </span>
@endif
<br>

<form action="{{ route('course.store') }}" method="POST">
    @csrf
    @method('POST')

    <label>Nome: </label>
    <input type="text" name="name" id="name" placeholder="Nome do curso"
        value="{{ old('name') }}"><br><br>

    <label>Preço: </label>
    <input type="text" name="price" id="price" placeholder="Usar '.' separar real do centavo"
        value="{{ old('price') }}"><br><br>

    <button type="submit">Cadastrar</button>

</form>
@endsection

    
