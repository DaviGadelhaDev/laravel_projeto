<h2>Detalhes da Aula</h2>
<table>
    <thead>
        <tr>
            <th>ID: </th>
            <th>Name: </th>
            <th>Description: </th>
            <th>Order: </th>
            <th>Course: </th>
            <th>Created_at: </th>
            <th>Updated_at: </th>
        </tr>
    </thead>
            <tbody>
                <tr>
                    <td>{{ $classe->id }}</td>
                    <td>{{ $classe->name }}</td>
                    <td>{{ $classe->description }}</td>
                    <td>{{ $classe->order_classe }}</td>
                    <td>{{ $classe->course->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($classe->created_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s') }}</td>
                    <td>{{ \Carbon\Carbon::parse($classe->updated_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s') }}</td>
                    <td><a href="{{ route('course.index') }}">Voltar</a></td>
                </tr>
            </tbody>
</table>