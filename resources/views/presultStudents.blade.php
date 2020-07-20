
<table class="table table-bordered">
    <thead>
        <tr>
            <th width="100px">Nombre</th>
            <th>Apellido</th>
            <th>Edad</th>
            <th>Email</th>
            <th>Acciones</th>

            


        </tr>
    </thead>
    <tbody>
        @foreach ($students as $value)
        <tr>
            <td>{{ $value->nombre }}</td>
            <td>{{ $value->apellido}}</td>
            <td>{{ $value->edad}}</td>
            <td>{{ $value->email }}</td>
            <td><a class="pickUp" style="cursor:pointer;text-decoration:none;color:blue; " id="{{$value->id}}" onclick="mostrar(this.id)">Editar</a>&nbsp;&nbsp;&nbsp;<a class="pickUp" style="cursor:pointer;text-decoration:none;color:blue; " id="{{$value->id}}" onclick="eliminar(this.id)">Eliminar</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
  
{!! $students->render() !!}


