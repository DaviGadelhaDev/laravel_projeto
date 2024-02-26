@extends('master')
@section('content')
    @if (session('success'))
        <span>{{ session('success') }}</span>
    @endif
    <h2>Listagem</h2>
    @if (session('success'))
    <p style="color: green;">
        {{ session('success') }}
    </p>
    @endif
    <a href="{{ route('course.create') }}">Cadastrar</a>
    @forelse ($courses as $course)
    <table>
        <thead>
            <tr>
                <th>ID: </th>
                <th>Name: </th>
                <th>Price: </th>
                <th>Created_at: </th>
                <th>Updated_at: </th>
            </tr>
        </thead>
                <tbody>
                    <tr>
                        <td>{{ $course->id }}</td>
                        <td>{{ $course->name }}</td>
                        <td>{{ 'R$'. number_format($course->price, 2, ',', '.' )}}</td>
                        <td>{{ \Carbon\Carbon::parse($course->created_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s') }}</td>
                        <td>{{ \Carbon\Carbon::parse($course->updated_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s') }}</td>
                        <td><a href="{{ route('course.show', ['course' => $course->id]) }}"><button type="button">Visualizar</button></a></td>
                        <td><a href="{{ route('classe.index', ['course' => $course->id])}}"><button type="button">Aulas</button></a></td>
                        <td><a href="{{ route('course.edit', ['course' => $course->id]) }}"><button type="button">Editar</button></a></td>
                        <td>
                            <form action="{{ route('course.destroy', $course->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete?')">Excuir</button>
                            </form></td>
                    </tr>
                </tbody>
            @empty
                <span style="color: red;">No courses found</span>
            @endforelse
    </table>
    {{ $courses->links() }}
@endsection