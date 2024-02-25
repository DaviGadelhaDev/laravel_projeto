<table>
    <thead>
        <tr>
            <th>ID: </th>
            <th>Name: </th>
            <th>Created_at: </th>
            <th>Updated_at: </th>
        </tr>
    </thead>
            <tbody>
                <tr>
                    <td>{{ $course->id }}</td>
                    <td>{{ $course->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($course->created_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s') }}</td>
                    <td>{{ \Carbon\Carbon::parse($course->updated_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s') }}</td>
                    <td><a href="{{ route('course.index') }}">Voltar</a></td>
                </tr>
            </tbody>
</table>