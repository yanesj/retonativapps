<table class="table table-bordered">
    <thead>
        <tr>
            <th width="600px">Nombre</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>acciones</th>
            


        </tr>
    </thead>
    <tbody>
        @foreach ($info as $value)
        <tr>
            
            <td>{{ $value['description']}}</td>
            <td>{{ $value['fecha_inicio']}}</td>
            <td>{{ $value['fecha_fin']}}</td>
              <td><a class="pickUp" style="cursor:pointer;text-decoration:none;color:blue; " id="{{$value['id']}}" onclick="mostrar(this.id)">Editar</a>&nbsp;&nbsp;&nbsp;<a class="pickUp" style="cursor:pointer;text-decoration:none;color:blue; " id="{{$value['id']}}" onclick="eliminar(this.id)">Eliminar</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
  
{!! $curso->render() !!}


