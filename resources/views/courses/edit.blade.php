@extends('master')
@section('content')
<a href="{{ route('course.index') }}">
    <button type="button">Listar</button>
</a><br><br>
<a href="{{ route('course.show', ['course' => $course->id]) }}">
    <button type="button">Visualizar</button>
</a><br><br>

<form method="POST" action="{{ route('course.destroy', ['course' => $course->id]) }}">
    @csrf
    @method('delete')
    <button type="submit" onclick="return confirm('Tem certeza que deseja apagar este registro?')">Apagar</button>
</form>

<h2>Editar o Curso</h2>    

@if ($errors->any())
    <span style="color: #f00">
        @foreach ($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
    </span>
@endif
<br>

<form action="{{ route('course.update', ['course' => $course->id]) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nome: </label>
    <input type="text" name="name" id="name" placeholder="Nome do curso"
        value="{{ old('name', $course->name) }}" ><br><br>

    <label>Preço: </label>
    <input type="text" name="price" id="price" placeholder="Usar '.' separar real do centavo"
        value="{{ old('price', $course->price) }}" ><br><br>

    <button type="submit">Salvar</button>

</form>
@endsection

   


