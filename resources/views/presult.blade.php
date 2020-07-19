<table class="table table-bordered">
    <thead>
        <tr>
            <th width="100px">Nombre</th>
            <th>Email</th>
            <th>Fecha de Creación</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $value)
        <tr>
            <td>{{ $value->name }}</td>
            <td>{{ $value->email }}</td>
            <td>{{ $value->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
  
{!! $users->render() !!}