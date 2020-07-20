
@extends('layouts.app')


@section('sidebar')
<div class="sidebar">
    <a   href="{{route('home')}}">Home</a>
    <a   href="{{route('estudiante')}}">Crear Estudiantes</a>
    <a href="{{route('viewStudent')}}">Ver Estudiantes</a>
    <a   href="{{route('curso')}}">Crear Cursos</a>
    <a class="active"   href="{{route('viewCourses')}}">Ver Cursos</a>
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
    <div class="row clientList">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Lista de Cursos en el sistema</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div id="tag_container">
                     @include('presultCourses')
                 </div>
             </div>
         </div>
     </div>
 </div>
 <form action="POST" name="updateCourse" id="updateCourse" style="display: none">
    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}"></input>
    <input type="hidden" name="hidden2" id="hidden2"></input>
    
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
                                <button type="button" class="btn btn-primary" id="update_curso" name="update_curso">Actualizar Curso</button>
                                <button type="button" class="btn btn-primary" id="close_panel" name="close_panel">Cerrar Panel</button>
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



<script type="text/javascript">
    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            }else{
                getData(page);
            }
        }
    });

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
        $("form input[type=text] , form textarea, form input[type=number], form input[type=date],form input[type=select]").each(function() { this.value = '' });
    }
 
    function eliminar(id){

        if(confirm('¿Desea Eliminar este estudiante del sistema?')){
            $.ajax({
                    type: 'delete', //THIS NEEDS TO BE GET
                    url: "/deleteCurso/"+id,
                    success: function (data) {
                       alert(data.message);
                       if(data.class_name=='alert-success'){
                           location.reload();
                       }

                   },
                   error: function() { 
                    console.log(data);
                }
            });
        }        
    }
    
    $(document).ready(function()
    {
      $.ajaxSetup({
        headers: {'X-CSRF-Token': $('#_token').val()}
    });


      getDataForSelectBoxes("#horario",'{{route("getHorarios")}}');

      $("#update_curso").bind( "click", function() {

        var estudiantes = [{"container": "#nombre"},{"container": "#horario"},{"container": "#fecha_inicio"},{"container": "#fecha_fin"}];

        if(confirm("¿Desea actualizar este curso en el sistema?")){
            if(validateFieldsToSend(estudiantes)){
                var nombre = $("#nombre").val();horario=$("#horario").val();fecha_inicio=$("#fecha_inicio").val();fecha_fin= $("#fecha_fin").val();hidden=$("#hidden2").val();
                $.ajax({
                    type: "put",
                    url: "/actualizarCurso",
                    data: {
                        nombre:nombre,horario:horario,fecha_inicio:fecha_inicio,fecha_fin:fecha_fin,id:hidden
                    },
                    beforeSend: function()
                    {
                                // setting a timeout
                                $("#update_curso").prop('disabled', true);
                                $("#update_curso").text('Enviando Datos...');
                            },
                            success: function (msg) {

                                alert(msg.message);
                                $("#update_curso").prop('disabled', false);
                                $("#update_curso").text('Actualizar Curso');
                                resetform();
                            }
                        });


            }
            else{
                alert('Los campos marcados con * son obligatorios.');
            }
        }
    });

      $("#close_panel").bind( "click", function() {
            $(".clientList").fadeIn("medium");
              $("#updateCourse").fadeOut("medium");

          });



      $(document).on('click', '.pagination a',function(event)
      {
        event.preventDefault();

        $('li').removeClass('active');
        $(this).parent('li').addClass('active');

        var myurl = $(this).attr('href');
        var page=$(this).attr('href').split('page=')[1];

        getData(page);
    });
  });

    function mostrar(id){

        $(".clientList").fadeOut("medium");
        $("#updateCourse").fadeIn("medium");
        //
        $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: "/viewDetailedCourse/"+id,
            success: function (data) {
                $("#hidden2").val(data[0].id);
                $("#nombre").val(data[0].nombre);
                $.each(data[0]['horarios'], function(i,item){
                    $("#horario option[value="+data[0]['horarios'][i].id+"]").attr("selected",true);
                });
                $("#horario option[value="+data[0].horario+"]").attr("selected",true);
                $("#fecha_inicio").val(data[0].fecha_inicio);
                $("#fecha_fin").val(data[0].fecha_fin);


            },
            error: function() { 
                console.log(data);
            }
        });
    }

    function getData(page){
        $.ajax(
        {
            url: '?page=' + page,
            type: "get",
            datatype: "html"
        }).done(function(data){
            $("#tag_container").empty().html(data);
            location.hash = page;
        }).fail(function(jqXHR, ajaxOptions, thrownError){
          alert('No response from server');
      });
    }
</script>
@endsection

