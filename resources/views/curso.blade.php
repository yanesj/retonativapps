
@extends('layouts.app')


@section('sidebar')
<div class="sidebar">
	<a   href="{{route('home')}}">Home</a>
	<a   href="{{route('estudiante')}}">Crear Estudiantes</a>
	 <a   href="{{route('viewStudent')}}">Ver Estudiantes</a>
	<a class="active"  href="{{route('curso')}}">Crear Cursos</a>
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
	<form action="POST" name="regCourse" id="regCourse">
		<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"></input>
		<input type="hidden" name="token2" id="token2">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header"><strong>Información del Curso</strong></div>

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
									<label for="horario">*Horario</label>
									<select class="form-control" id="horario" name="horario">
										<option selected="selected" value="">Escoja Opción</option>
										

									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="fecha_inicio">*Fecha Inicio</label>
									<input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="fecha_fin">*Fecha Fin</label>
									<input type="date" class="form-control" id="fecha_fin" name="fecha_fin">
								</div>
							</div>
						</div>


						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<button type="button" class="btn btn-primary" id="register_course" name="register_course">Registrar Curso</button>
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
	function getDataForSelectBoxes(id_container,path){
		$.ajax({
		    type: 'GET', //THIS NEEDS TO BE GET
		    url: path,
		    success: function (data) {
		    	$.each(data, function(i,item){
		    		$(id_container).append('<option value="'+data[i].id+'">'+data[i].description+'</option>');
		    		
		    	})
		    },
		    error: function() { 
		    	console.log(data);
		    }
		});
	}

	$(document).ready(function() {
		$.ajaxSetup({
			headers: {'X-CSRF-Token': $('#_token').val()}
		});
		getDataForSelectBoxes("#horario",'{{route("getHorarios")}}');

		function resetform() {
			$("form select").each(function() { this.selectedIndex = 0 });
			$("form input[type=text] , form textarea, form input[type=select],form input[type=date]").each(function() { this.value = '' });
		}


		$("#register_course").bind( "click", function() {
			
			var estudiantes = [{"container": "#nombre"},{"container": "#horario"},{"container": "#fecha_inicio"},{"container": "#fecha_fin"}];
			
			if(confirm("¿Desea registrar este curso en el sistema?")){
				if(validateFieldsToSend(estudiantes)){
					var nombre = $("#nombre").val();horario=$("#horario").val();fecha_inicio=$("#fecha_inicio").val();fecha_fin= $("#fecha_fin").val();
					$.ajax({
						type: "post",
						url: "/registrarCurso",
						data: {
							nombre:nombre,horario:horario,fecha_inicio:fecha_inicio,fecha_fin:fecha_fin
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


