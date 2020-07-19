<table class="table table-bordered">
    <thead>
        <tr>
            <th width="100px">Compañía/Cliente</th>
            <th>Nit/Rut</th>
            <th>Nombre de Contacto</th>
            <th>Email del Contacto</th>
            <th>Fecha de Creación</th>


        </tr>
    </thead>
    <tbody>
        @foreach ($clients as $value)
        <tr>
            <td>{{ $value->business_name }}</td>
            <td><a class="pickUp" style="cursor:pointer;text-decoration:none;color:blue; " id="{{$value->id}}" onclick="mostrar(this.id)">{{ $value->identification_number.'-'.$value->verification_digit }}</a></td>
            <td>{{ $value->contact_name }}</td>
            <td>{{ $value->contact_email }}</td>
            <td>{{ $value->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
  
{!! $clients->render() !!}


