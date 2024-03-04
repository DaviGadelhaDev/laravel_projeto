@extends('master')
@section('content')
<a href="{{ route('course.create') }}">
    <button type="button" class="btn btn-success">Cadastrar</button>
</a><br>

<h2>Listar os Cursos</h2>

@if (session('success'))
    <p style="color: #082">
        {{ session('success') }}
    </p>
@endif

@if (session('error'))
    <p style="color: #f00">
        {{ session('error') }}
    </p>
@endif

@forelse ($courses as $course)
    ID: {{ $course->id }}<br>
    Nome: {{ $course->name }}<br>
    Preço: {{ 'R$ ' . number_format($course->price, 2, ',', '.') }}<br>
    Cadastrado: {{ \Carbon\Carbon::parse($course->created_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s') }}<br>
    Editado:
    {{ \Carbon\Carbon::parse($course->updated_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s') }}<br><br>

    <a href="{{ route('classe.index', ['course' => $course->id]) }}">
        <button type="button">Aulas</button>
    </a><br><br>

    <a href="{{ route('course.show', ['course' => $course->id]) }}">
        <button type="button">Visualizar</button>
    </a><br><br>

    <a href="{{ route('course.edit', ['course' => $course->id]) }}">
        <button type="button">Editar</button>
    </a><br><br>

    <form method="POST" action="{{ route('course.destroy', ['course' => $course->id]) }}">
        @csrf
        @method('delete')
        <button type="submit"
            onclick="return confirm('Tem certeza que deseja apagar este registro?')">Apagar</button>
    </form>
    
    <hr>
@empty
    <p style="color: #f00;">Nenhum curso encontrado!</p>
@endforelse

{{ $courses->links() }}
@endsection
   

