
@extends('layouts.app')


@section('sidebar')
<div class="sidebar">
    <a class="active"  href="{{route('home')}}">Home</a>
    <a   href="{{route('estudiante')}}">Crear Estudiantes</a>
    <a   href="{{route('curso')}}">Crear Cursos</a>
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

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

