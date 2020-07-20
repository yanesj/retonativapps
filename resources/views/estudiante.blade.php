
@extends('layouts.app')


@section('sidebar')
<div class="sidebar">
	<a   href="{{route('home')}}">Home</a>
	<a class="active"  href="{{route('estudiante')}}">Crear Estudiantes</a>
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
	<form action="POST" name="regStudent" id="regStudent">
		<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"></input>
		<input type="hidden" name="token2" id="token2">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header"><strong>Información del Estudiante</strong></div>

					<div class="card-body">
						@if (session('status'))
						<div class="alert alert-success" role="alert">
							{{ session('status') }}
						</div>
						@endif

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="nombre">*Nombre</label>
									<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="apellido">*Apellido</label>
									<input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="edad">*Edad</label>
									<input type="number" class="form-control" id="edad" name="edad" placeholder="Edad">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="email">*Correo Electrónico</label>
									<input type="text" class="form-control" id="email" name="email" placeholder="Correo Electrónico">
								</div>
							</div>
						</div>


						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<button type="button" class="btn btn-primary" id="register_student" name="register_student">Registrar Estudiante</button>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		<br>

	</form>
</div>
<br/>
<script>
	function validateFieldsToSend(objects){
		var item,response=true;
		objects.forEach(function(object, index) {
			
			if($(object.container).val()==''){
				response= false;
			}
		});
		return response;
	}

	function resetform() {
		$("form select").each(function() { this.selectedIndex = 0 });
		$("form input[type=text] , form textarea, form input[type=number]").each(function() { this.value = '' });
	}

	$(document).ready(function() {
		$.ajaxSetup({
			headers: {'X-CSRF-Token': $('#_token').val()}
		});


		$("#register_student").bind( "click", function() {
			
			var estudiantes = [{"container": "#nombre"},{"container": "#apellido"},{"container": "#edad"},{"container": "#email"}];
			
			if(confirm("¿Desea registrar este estudiante en el sistema?")){
				if(validateFieldsToSend(estudiantes)){
					var nombre = $("#nombre").val();apellido=$("#apellido").val();edad=$("#edad").val();email= $("#email").val();
					$.ajax({
						type: "post",
						url: "/registrarEstudiante",
						data: {
							nombre:nombre,apellido:apellido,edad:edad,email:email
						},
						beforeSend: function()
						{
						        // setting a timeout
						        $("#register_student").prop('disabled', true);
						        $("#register_student").text('Enviando Datos...');
						    },
						    success: function (msg) {
						    	
						    	alert(msg.message);
						    	$("#register_student").prop('disabled', false);
						    	$("#register_student").text('Registrar Estudiante');
						    	resetform();
						    }
						});


				}
				else{
					alert('Los campos marcados con * son obligatorios.');
				}
			}
		});

	});
</script>
@endsection


