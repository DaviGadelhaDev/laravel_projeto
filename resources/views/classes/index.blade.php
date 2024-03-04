@extends('master')
@section('content')
<br>
<a href="{{ route('course.index') }}">
    <button type="button">Cursos</button>
</a><br><br>

<a href="{{ route('classe.create', ['course' => $course->id ]) }}">
    <button type="button">Cadastrar</button>
</a>

<h2>Listar as Aulas</h2>

@if (session('success'))
    <p style="color: #082">
        {{ session('success') }}
    </p>
@endif

@forelse ($classes as $classe)
    ID: {{ $classe->id }}<br>
    Nome: {{ $classe->name }}<br>
    Ordem: {{ $classe->order_classe }}<br>
    Curso: {{ $classe->course->name }}<br>

    Cadastrado: {{ \Carbon\Carbon::parse($classe->created_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s') }}<br>
    Editado:
    {{ \Carbon\Carbon::parse($classe->updated_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s') }}<br><br>
    
    <a href="{{ route('classe.show', ['classe' => $classe->id]) }}">
        <button type="button">Visualizar</button>
    </a><br><br>
    
    <a href="{{ route('classe.edit', ['classe' => $classe->id]) }}">
        <button type="button">Editar</button>
    </a><br><br>

    <form method="POST" action="{{ route('classe.destroy', ['classe' => $classe->id])}}">
        @csrf
        @method('delete')
        <button type="submit" onclick="return confirm('Tem certeza que deseja apagar este registro?')">Apagar</button>
    </form>

    <hr>
@empty
    <p style="color: #f00;">Nenhuma aula encontrada!</p>
@endforelse

@endsection
   

