@extends('layouts.master')
@section('content')
    <a href="{{ route('classe.index', ['course' => $classe->course_id]) }}">
        <button type="button">Listar</button>
    </a><br><br>

    <a href="{{ route('classe.edit', ['classe' => $classe->id]) }}">
        <button type="button">Editar</button>
    </a><br><br>

    <form method="POST" action="{{ route('classe.destroy', ['classe' => $classe->id]) }}">
        @csrf
        @method('delete')
        <button type="submit" onclick="return confirm('Tem certeza que deseja apagar este registro?')">Apagar</button>
    </form>

    <h2>Detalhes da Aula</h2>

    @if (session('success'))
        <p style="color: #082">
            {{ session('success') }}
        </p>
    @endif

    ID: {{ $classe->id }}<br>
    Nome: {{ $classe->name }}<br>
    Descrição: {{ $classe->description }}<br>
    Ordem: {{ $classe->order_classe }}<br>
    Curso: {{ $classe->course->name }}<br>

    Cadastrado: {{ \Carbon\Carbon::parse($classe->created_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s') }}<br>
    Editado:
    {{ \Carbon\Carbon::parse($classe->updated_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s') }}<br><br>
@endsection
