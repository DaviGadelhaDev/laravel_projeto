@extends('master')
@section('content')
    @if (session('success'))
        <span>{{ session('success') }}</span>
    @endif
    <h2>Listagem - Aulas</h2>
    @if (session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif
    <a href="{{ route('classe.create', ['course' => $course->id]) }}">Cadastrar</a>
    
    @forelse ($classes as $classe)
    <table>
        <thead>
            <tr>
                <th>ID: </th>
                <th>Name: </th>
                <th>Course: </th>
                <th>Created_at: </th>
                <th>Updated_at: </th>
            </tr>
        </thead>
                <tbody>
                    <tr>
                        <td>{{ $classe->id }}</td>
                        <td>{{ $classe->name }}</td>
                        <td>{{ $classe->course->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($classe->created_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s') }}</td>
                        <td>{{ \Carbon\Carbon::parse($classe->updated_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s') }}</td>
                        <td><a href="{{ route('classe.show', ['classe' => $classe->id]) }}">Visualizar</a></td>
                        <td><a href="{{ route('classe.edit', ['classe' => $classe->id]) }}">Editar</a></td>
                        <td>
                            <form action="{{ route('classe.destroy', ['classe' => $classe->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick=" return confirm('Are you sure you want to delete?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            @empty
                <span style="color: red;">No classes found</span>
            @endforelse
    </table>
@endsection