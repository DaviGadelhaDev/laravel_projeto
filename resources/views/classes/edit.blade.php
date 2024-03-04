@extends('master')
@section('content')
<a href="{{ route('classe.index', ['course' => $classe->course_id ]) }}">
    <button type="button">Listar</button>
</a><br><br>

<a href="{{ route('classe.show', ['classe' => $classe->id]) }}">
    <button type="button">Visualizar</button>
</a><br><br>

<h2>Editar a Aula</h2> 

@if ($errors->any())
    <span style="color: #f00">
        @foreach ($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
    </span>
@endif
<br> 

<form action="{{ route('classe.update', ['classe' => $classe->id]) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nome: </label>
    <input type="text" name="name" id="name" placeholder="Nome da aula"
        value="{{ old('name', $classe->name) }}" ><br><br>

    <label>Descrição: </label>
    <textarea name="description" rows="4" cols="30" id="description">{{ old('description', $classe->description) }}</textarea><br><br>

    <button type="submit">Salvar</button>

</form>
@endsection

    

