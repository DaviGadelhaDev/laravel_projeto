@extends('master')
@section('content')
    @if (session('success'))
        <span>{{ session('success') }}</span>
    @endif
    <h2>Listagem</h2>
    <table>
        <thead>
            <tr>
                <th>Name: </th>
                <th>Created_at: </th>
                <th>Updated_at: </th>
            </tr>
        </thead>
        @forelse ($courses as $course)
                <tbody>
                    <tr>
                        <td>{{ $course->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($course->created_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s') }}</td>
                        <td>{{ \Carbon\Carbon::parse($course->updated_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s') }}</td>
                    </tr>
                </tbody>
            @empty
                <span style="color: red;">No courses found</span>
            @endforelse
    </table>
@endsection