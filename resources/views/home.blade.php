
@extends('layouts.app')


@section('sidebar')
<div class="sidebar">
    <a class="active"  href="{{route('home')}}">Home</a>
    <a   href="{{route('estudiante')}}">Crear Estudiantes</a>
    <a   href="{{route('viewStudent')}}">Ver Estudiantes</a>
    <a   href="{{route('curso')}}">Crear Cursos</a>
    <a   href="{{route('viewCourses')}}">Ver Cursos</a>
    <a   href="{{route('asigCurso')}}">Asignar Cursos</a>
    <a class="dropdown-item" href="{{ route('logout') }}"
    onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
    Salir
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
  @csrf
</form>
</div>
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                            <tr align="center">
                                <th colspan="2" >TOP DE LOS 3 CURSOS CON MÁS ESTUDIANTES EN LOS ÚLTIMOS 6 MESES</th>
                            </tr>
                            <tr>
                                <th>Cursos</th>
                                <th>Cantidad de Estudiantes</th>
                            </tr>

                        </thead>
                        <tbody>
                         @foreach ($cursos as $value)
                         <tr>
                           <td>{{$value->materia}}</td>
                           <td>{{$value->cant_estud}}</td>
                       </tr>
                       @endforeach
                   </tbody>
               </table>
           </div>
       </div>
   </div>
</div>
</div>
@endsection

