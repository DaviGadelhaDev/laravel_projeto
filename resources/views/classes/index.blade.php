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
                    </tr>
                </tbody>
            @empty
                <span style="color: red;">No classes found</span>
            @endforelse
    </table>
@endsection